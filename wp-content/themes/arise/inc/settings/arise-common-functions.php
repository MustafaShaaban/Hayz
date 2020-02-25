<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage arise
 * @since arise 1.0
 */

/****************** arise DISPLAY COMMENT NAVIGATION *******************************/
function arise_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'arise' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'arise' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;
				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'arise' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
/******************** Remove div and replace with ul**************************************/
add_filter('wp_page_menu', 'arise_wp_page_menu');
function arise_wp_page_menu($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass   = $matches[1];
	$replace    = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup;
}
/*******************************arise MetaBox *********************************************************/
global $arise_layout_options;
$arise_layout_options = array(
'default-sidebar'=> array(
						'id'			=> 'arise_sidebarlayout',
						'value' 		=> 'default',
						'label' 		=> __( 'Default Layout Set in', 'arise' ).' '.'<a href="'.wp_customize_url() .'?autofocus[section]=arise_layout_options" target="_blank">'.__( 'Customizer', 'arise' ).'</a>',
						'thumbnail' => ' '
					),
	'no-sidebar' 	=> array(
							'id'			=> 'arise_sidebarlayout',
							'value' 		=> 'no-sidebar',
							'label' 		=> __( 'No sidebar Layout', 'arise' )
						), 
	'full-width' => array(
									'id'			=> 'arise_sidebarlayout',
									'value' 		=> 'full-width',
									'label' 		=> __( 'Full Width Layout', 'arise' )
								),
	'left-sidebar' => array(
							'id'			=> 'arise_sidebarlayout',
							'value' 		=> 'left-sidebar',
							'label' 		=> __( 'Left sidebar Layout', 'arise' )
						),
	'right-sidebar' => array(
							'id' 			=> 'arise_sidebarlayout',
							'value' 		=> 'right-sidebar',
							'label' 		=> __( 'Right sidebar Layout', 'arise' )
						)
			);
/*************************** Add Custom Box **********************************/
function arise_add_custom_box() {
	add_meta_box(
		'siderbar-layout',
		__( 'Select layout for this specific Page only', 'arise' ),
		'arise_layout_options',
		'page', 'side', 'default'
	); 
	add_meta_box(
		'siderbar-layout',
		__( 'Select layout for this specific Post only', 'arise' ),
		'arise_layout_options',
		'post','side', 'default'
	);
}
add_action( 'add_meta_boxes', 'arise_add_custom_box' );
function arise_layout_options() {
	global $arise_layout_options;
	// Use nonce for verification  
	wp_nonce_field( basename( __FILE__ ), 'arise_custom_meta_box_nonce' ); // for security purpose ?>
	<?php
				foreach ($arise_layout_options as $field) {  
					$arise_layout_meta = get_post_meta( get_the_ID(), $field['id'], true );
					if(empty( $arise_layout_meta ) ){
						$arise_layout_meta='default';
					} ?>
				<input type="radio" class ="post-format" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $arise_layout_meta ); ?>/>
				&nbsp;&nbsp;<?php echo $field['label']; ?> <br/>
				<?php
				} // end foreach  ?>
<?php }
/******************* Save metabox data **************************************/
add_action('save_post', 'arise_save_custom_meta');
function arise_save_custom_meta( $post_id ) { 
	global $arise_layout_options, $post; 
	// Verify the nonce before proceeding.
	if ( !isset( $_POST[ 'arise_custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'arise_custom_meta_box_nonce' ], basename( __FILE__ ) ) )
		return;
	// Stop WP from clearing custom fields on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
		return;
	if ('page' == $_POST['post_type']) {  
		if (!current_user_can( 'edit_page', $post_id ) )  
			return $post_id;  
	} 
	elseif (!current_user_can( 'edit_post', $post_id ) ) {  
		return $post_id;  
	}
	foreach ($arise_layout_options as $field) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		}
	} // end foreach   
}
/***************Pass slider effect  parameters from php files to jquery file ********************/
function arise_slider_value() {
	$arise_settings = arise_get_theme_options();
	$arise_transition_effect   = esc_attr($arise_settings['arise_transition_effect']);
	$arise_transition_delay    = absint($arise_settings['arise_transition_delay'])*1000;
	$arise_transition_duration = absint($arise_settings['arise_transition_duration'])*1000;
	wp_localize_script(
		'arise_slider',
		'arise_slider_value',
		array(
			'transition_effect'   => $arise_transition_effect,
			'transition_delay'    => $arise_transition_delay,
			'transition_duration' => $arise_transition_duration,
		)
	);
}
/**************************** Display Header Title ***********************************/
function arise_header_title() {
	$format = get_post_format();
	if( is_archive() ) {
		if ( is_category() ) :
			$arise_header_title = single_cat_title( '', FALSE );
		elseif ( is_tag() ) :
			$arise_header_title = single_tag_title( '', FALSE );
		elseif ( is_author() ) :
			the_post();
			$arise_header_title =  sprintf( __( 'Author: %s', 'arise' ), '<span class="vcard">' . get_the_author() . '</span>' );
			rewind_posts();
		elseif ( is_day() ) :
			$arise_header_title = sprintf( __( 'Day: %s', 'arise' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			$arise_header_title = sprintf( __( 'Month: %s', 'arise' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif ( is_year() ) :
			$arise_header_title = sprintf( __( 'Year: %s', 'arise' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		elseif ( $format == 'audio' ) :
			$arise_header_title = __( 'Audios', 'arise' );
		elseif ( $format =='aside' ) :
			$arise_header_title = __( 'Asides', 'arise');
		elseif ( $format =='image' ) :
			$arise_header_title = __( 'Images', 'arise' );
		elseif ( $format =='gallery' ) :
			$arise_header_title = __( 'Galleries', 'arise' );
		elseif ( $format =='video' ) :
			$arise_header_title = __( 'Videos', 'arise' );
		elseif ( $format =='status' ) :
			$arise_header_title = __( 'Status', 'arise' );
		elseif ( $format =='quote' ) :
			$arise_header_title = __( 'Quotes', 'arise' );
		elseif ( $format =='link' ) :
			$arise_header_title = __( 'links', 'arise' );
		elseif ( $format =='chat' ) :
			$arise_header_title = __( 'Chats', 'arise' );
		elseif ( class_exists('WooCommerce') && (is_shop() || is_product_category()) ):
  			$arise_header_title = woocommerce_page_title( false );
  		elseif ( class_exists('bbPress') && is_bbpress()) :
  			$arise_header_title = get_the_title();
		else :
			$arise_header_title = get_the_archive_title();
		endif;
	} elseif (is_home()){
		$arise_header_title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$arise_header_title = __('Page NOT Found', 'arise');
	} elseif (is_search()) {
		$arise_header_title = __('Search Results', 'arise');
	} elseif (is_page_template()) {
		$arise_header_title = get_the_title();
	} else {
		$arise_header_title = get_the_title();
	}
	return $arise_header_title;
}

/********************* Header Image ************************************/
function arise_header_image_display(){
	$arise_settings = arise_get_theme_options();
	$arise_header_image = get_header_image();
	$arise_header_image_options = $arise_settings['arise_custom_header_options'];
	if($arise_header_image_options == 'homepage'){
		if(is_front_page() || (is_home() && is_front_page())) :
			if (!empty($arise_header_image)):
			if(($arise_settings['arise_header_primary_text']!='') || ($arise_settings['arise_header_secondary_text']!='') || ($arise_settings['arise_Header_description']!='')){ ?>
			<div class="header-cover padding-none">
				<div <?php if($arise_settings['arise_disable_header_image_only'] != 1): ?>style="background-image: url(<?php echo esc_url($arise_header_image);?>);" <?php endif; ?> class="header" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>">
			<div class="header-inner section-inner">
				<span>
					<?php if($arise_settings['arise_Header_description']!=''){ ?>
					<h2><a title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" href="<?php echo esc_url(home_url('/'));?>"><?php echo esc_attr($arise_settings['arise_Header_description']);?></a></h2>
					<?php }
					if($arise_settings['arise_header_primary_text']!=''){ 
					?>
					<a class="btn-default vivid" href="<?php echo esc_url($arise_settings['arise_header_primary_url']);?>" alt="<?php echo esc_attr($arise_settings['arise_header_primary_text']);?>"><?php echo esc_attr($arise_settings['arise_header_primary_text']);?> </a>
					<?php }
					if($arise_settings['arise_header_secondary_text']!=''){ ?>
					<a class="btn-default light" href="<?php echo esc_url($arise_settings['arise_Header_secondary_url']);?>" alt="<?php echo esc_attr($arise_settings['arise_header_secondary_text']);?>"><?php echo esc_attr($arise_settings['arise_header_secondary_text']);?> </a>
					<?php } ?>
				</span>
			</div> <!-- end .header-inner -->
			</div> 
				<!-- end .header -->
			</div>
			<!-- end .header-cover -->
			<?php } else{ ?>
			<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($arise_header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> </a>
			<?php }
			 endif;
		endif;
	}elseif($arise_header_image_options == 'enitre_site'){
		if (!empty($arise_header_image)):
			if(($arise_settings['arise_header_primary_text']!='') || ($arise_settings['arise_header_secondary_text']!='') || ($arise_settings['arise_Header_description']!='')){ ?>
			<div class="header-cover padding-none">
				<div <?php if($arise_settings['arise_disable_header_image_only'] != 1): ?>style="background-image: url(<?php echo esc_url($arise_header_image);?>);" <?php endif; ?> class="header" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>">
			<div class="header-inner section-inner">
				<span>
					<?php if($arise_settings['arise_Header_description']!=''){ ?>
					<h2><a title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" href="<?php echo esc_url(home_url('/'));?>"><?php echo esc_attr($arise_settings['arise_Header_description']);?></a></h2>
					<?php }
					if($arise_settings['arise_header_primary_text']!=''){ 
					?>
					<a class="btn-default vivid" href="<?php echo esc_url($arise_settings['arise_header_primary_url']);?>" alt="<?php echo esc_attr($arise_settings['arise_header_primary_text']);?>"><?php echo esc_attr($arise_settings['arise_header_primary_text']);?> </a>
					<?php }
					if($arise_settings['arise_header_secondary_text']!=''){ ?>
					<a class="btn-default light" href="<?php echo esc_url($arise_settings['arise_Header_secondary_url']);?>" alt="<?php echo esc_attr($arise_settings['arise_header_secondary_text']);?>"><?php echo esc_attr($arise_settings['arise_header_secondary_text']);?> </a>
					<?php } ?>
				</span>
			</div> <!-- end .header-inner -->
			</div> 
				<!-- end .header -->
			</div>
			<!-- end .header-cover -->
			<?php } else{ ?>
			<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($arise_header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> </a>
			<?php }
			 endif;
	}
}
add_action ('arise_header_image','arise_header_image_display');
/********************* Custom Header setup ************************************/
function arise_custom_header_setup() {
	$args = array(
		'default-text-color'     => '',
		'default-image'          => '',
		'height'                 => apply_filters( 'arise_header_image_height', 400 ),
		'width'                  => apply_filters( 'arise_header_image_width', 2500 ),
		'random-default'         => false,
		'max-width'              => 2500,
		'flex-height'            => true,
		'flex-width'             => true,
		'random-default'         => false,
		'header-text'				 => false,
		'uploads'				 => true,
		'wp-head-callback'       => '',
		'admin-preview-callback' => 'arise_admin_header_image',
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'arise_custom_header_setup' );