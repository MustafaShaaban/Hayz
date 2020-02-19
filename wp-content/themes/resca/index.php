<?php
if ( have_posts() ) :?>
	<div class="archive-content">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();
			get_template_part( 'content' );
		endwhile;
		thim_paging_nav();
		?>
	</div>
<?php
else :
	get_template_part( 'content', 'none' );
endif;