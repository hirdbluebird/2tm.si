
<?php
/**
 * Template Name: Immigration Page template
 *
 * A custom page template with sidebar.
 *
 * @package WordPress
 * @subpackage purepress
 * @since purepress 1.0
 */

get_header();



	$slider_on  = ot_get_option( 'slider_on' );
	$slider_type =  ot_get_option( 'incr_slider_home' );

	if ($slider_type == "flex") {
		$slides = ot_get_option( 'mainslider', array() );
		if ( $slider_on == 'yes' && !empty( $slides )) {
			get_template_part('slider');
		}
	}

	if ($slider_type == "revolution") {
		if ( $slider_on == 'yes') {
			$style = get_theme_mod( 'centum_layout_style', 'boxed' ) ;
			if (function_exists('icl_get_languages')) {
				  $languages = icl_get_languages('skip_missing=0&orderby=code');
				   if(!empty($languages)){
				   		foreach($languages as $l){

				   			if(ICL_LANGUAGE_CODE == $l['language_code']) {
				   			echo '<section class="slider">';
				   				if($style == 'boxed') { echo '<div class="container"><div class="sixteen columns">'; }
				   					putRevSlider(ot_get_option( 'incr_revo_slider'.$l['language_code']));
				   				if($style == 'boxed') { echo '</div></div>'; }
				   			echo "</section>";
				   			}
				   		}
				   }
			} else {

				echo '<section class="slider">';
				if($style == 'boxed') { echo '<div class="container"><div class="sixteen columns">'; }
					putRevSlider(ot_get_option( 'incr_revo_slider' ));
				if($style == 'boxed') { echo '</div></div>'; }
				echo "</section>";
			}
		}

	}


 while (have_posts()) : the_post(); ?>

 <!-- 960 Container -->
 
	<div class="container">
		<div class="sixteen columns">
			<?php
			if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
				 yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			}
			?>
		</div>
	</div>	
		<div class="container">
	<div <?php post_class('post home clearfix'); ?> id="post-<?php the_ID(); ?>" >
	</div>
	<!-- Post -->
<?php endwhile; // End the loop. Whew.  ?>

	<div class="four columns reverse">
		<?php if ( is_active_sidebar( 'immigrationpanel' ) ) : ?>
				<div class="blog-sidebar">
					<?php dynamic_sidebar( 'immigrationpanel' ); ?>
				</div>
			<?php endif; ?>	
		</div>	
<div class="<?php if ($width == 'full') {echo "sixteen"; } else { echo "twelve"; }?> columns tooltips">
<?php the_content() ?>


<?php get_footer(); ?>