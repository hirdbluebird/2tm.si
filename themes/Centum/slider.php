<!-- 960 Container -->
<div class="container">

	<!-- Flexslider -->
	<div class="sixteen columns">
		<section class="slider">
			<div class="flexslider home">
				<ul class="slides">
					<?php
					if ( function_exists( 'ot_get_option' ) ) {
						$slides = ot_get_option( 'mainslider', array() );
						if (!empty( $slides ) ) {
							$i = 0;
							foreach( $slides as $slide ) {
								$slideurl = $slide['slider_url'];
								if(!empty($slideurl)){
									echo '<li><a href="'.$slideurl.'"><img src="' . $slide['slider_image_upload'] . '" alt="' . $slide['title'] . '" />';
								} else {
									echo '<li><img src="' . $slide['slider_image_upload'] . '" alt="' . $slide['title'] . '" />';
								}

								$i++;
									if( $slide['slider_empty'] != "yes" ) {
											if (function_exists('icl_register_string')) {
												icl_register_string('Flex slider title'.$i,'flextitle'.$i, $slide['title']);
												icl_register_string('Flex slider content'.$i,'flexcontent'.$i, $slide['slider_description']);
											}
										echo '<div class="slide-caption">';
										if (function_exists('icl_register_string')) {
											if(!empty($slide['title'])) echo '<h3>' . icl_t('Flex slider title'.$i,'flextitle'.$i, $slide['title']) . '</h3>';
											if(!empty($slide['slider_description'])) echo '<p>' . do_shortcode(icl_t('Flex slider content'.$i,'flexcontent'.$i, $slide['slider_description'])) . '</p>';
										} else {
											if(!empty($slide['title'])) echo '<h3>'.  $slide['title'] .'</h3>';
											if(!empty($slide['slider_description'])) echo '<p>'. do_shortcode($slide['slider_description']) . '</p>';
										}
										echo '</div>';
									}
								if(!empty($slideurl)) {
									echo '</a></li>';
								} else {
									echo '</li>';
								}
							}
						}
					}
					?>
					<!-- Slide -->
				</ul>
			</div>
		</section>
	</div>
	<!-- Flexslider / End -->

</div>
<!-- 960 Container / End -->
