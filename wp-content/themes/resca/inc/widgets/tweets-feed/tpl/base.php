<?php
$consumer_key        = $instance['consumer_key'];
$consumer_secret     = $instance['consumer_secret'];
$access_token        = $instance['access_token'];
$access_token_secret = $instance['access_token_secret'];
$twitter_id          = $instance['twitter_id'];
$count               = (int) $instance['count'];

if ( $instance['title'] <> '' ) {
	echo ent2ncr( $args['before_title'] . $instance['title'] . '<i class="fa fa-twitter"></i>' . $args['after_title'] );
}

if ( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {
	$transName = 'list_tweets_' . $twitter_id;
	$cacheTime = 10;
	if ( false === ( $twitterData = get_transient( $transName ) ) ) {
		$token = get_option( 'cfTwitterToken_' . $twitter_id );
		// get a new token anyways
		delete_option( 'cfTwitterToken_' . $twitter_id );
		// getting new auth bearer only if we don't have one
		if ( !$token ) {
			// preparing credentials
			$credentials = $consumer_key . ':' . $consumer_secret;
			$toSend      = base64_encode( $credentials );
			// http post arguments
			$args_twitter = array(
				'method'      => 'POST',
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Authorization' => 'Basic ' . $toSend,
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
				),
				'body'        => array( 'grant_type' => 'client_credentials' )
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args_twitter );

			$keys = json_decode( wp_remote_retrieve_body( $response ) );

			if ( $keys ) {
				// saving token to wp_options table
				update_option( 'cfTwitterToken_' . $twitter_id, $keys->access_token );
				$token = $keys->access_token;
			}
		}
		// we have bearer token wether we obtained it from API or from options
		$args_twitter = array(
			'httpversion' => '1.1',
			'blocking'    => true,
			'headers'     => array(
				'Authorization' => "Bearer $token"
			)
		);

		add_filter( 'https_ssl_verify', '__return_false' );
		$api_url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $twitter_id . '&count=' . $count;
		$response = wp_remote_get( $api_url, $args_twitter );
		set_transient( $transName, wp_remote_retrieve_body( $response ), 60 * $cacheTime );
	}
	@$twitter = json_decode( get_transient( $transName ), true );

	if ( $twitter && is_array( $twitter ) ) {
		?>
		<ul class="tweet">
			<?php foreach ( $twitter as $tweet ):
				$twitterTime = strtotime( $tweet['created_at'] );
				?>
				<li><?php
					//					echo '<h4>'.$tweet['id'].'</h4>';
					//					var_dump($tweet);
					$latestTweet = $tweet['text'];
					$latestTweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet );
					$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet );
					echo ent2ncr( $latestTweet );
					echo '<span class="tweet-time">' . date( "M, j Y", $twitterTime ) . '</span>';
					?></li>
			<?php endforeach; ?>
		</ul>
	<?php
	}
}

