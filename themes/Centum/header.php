<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<!-- Basic Page Needs
	================================================== -->

	<meta charset ="<?php bloginfo('charset'); ?>" />
	<title><?php  wp_title('',true);  ?></title>
<?php if(!strstr($_SERVER['REQUEST_URI'],'/page/')):?>
<?php	$page_type=get_post_type();
			if($page_type=='post'){
					if(strstr($_SERVER['REQUEST_URI'],'?lang=en')){
						
						//$this->title=the_title();
						//$new_title=the_title();
						//$this->metadesc =$new_title;
						$new_desc =get_the_title();
						echo '<meta name="description" content="', 'News 2TM: '.$new_desc.' - Read more on the website', '"/>', "\n";
					}elseif(strstr($_SERVER['REQUEST_URI'],'?lang=uk')){
						$new_desc =get_the_title();
						echo '<meta name="description" content="', 'Новини 2TM: '.$new_desc.' - Детальніше читайте на сайті', '"/>', "\n";
					}else{
						
						$new_desc =get_the_title();
						echo '<meta name="description" content="', 'Наши новости: '.$new_desc.' - подробнее читать на сайте 2ТМ', '"/>', "\n";
					}
				
			}?>
<?php endif;?>
	
<meta name='yandex-verification' content='74c311479bba3b08' />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ot_get_option('incr_favicon_upload', get_template_directory_uri().'/images/favicon.ico')?>" />
<!-- Mobile Specific
================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
	================================================== -->
	<link rel="stylesheet" media="screen, print" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php
	 $style = get_theme_mod( 'centum_layout_style', 'boxed' ) ;
	 $scheme = get_theme_mod( 'centum_scheme_switch', 'light' ) ;
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/<?php echo $scheme.$style; ?>.css" type="text/css" media="screen" id="layout"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Java Script
	================================================== -->

	<?php if (is_singular()) wp_enqueue_script('comment-reply');

	wp_enqueue_script('jquery');
	wp_head(); ?>
<!-- Vk Pixel Code -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
<!-- Vk Pixel Code END -->

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '443375689205682');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=443375689205682&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>
  <body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Wrapper Start -->
<div id="wrapper">


<!-- Header
================================================== -->
<?php
$alt='';

 if (ICL_LANGUAGE_CODE == 'ru'){
	$alt='Компания 2ТМ: переезд в Словению без проблем';
 }

?>
<!-- 960 Container -->
<div class="container ie-dropdown-fix">

<!-- Header -->
	<div id="header">
		<?php
				$logo_area_width = ot_get_option('logo_area_width',8);
				$menu_area_width = 16 - $logo_area_width;
			?>
		<!-- Logo -->
		<div class="<?php echo incr_number_to_width($logo_area_width); ?>  columns">
			<div id="logo">
				<?php  $logo = ot_get_option( 'logo_upload' );
				if($logo) { ?>
					<?php 
						$about_link['ru'] = '/';
						$about_link['en'] = '/?lang=en';
						$about_link['sl'] = '/?lang=sl';
						$about_link['uk'] = '/?lang=uk';
						
					?>
					<?php if(is_front_page()){ ?>
					<a href="<?php echo $about_link[ICL_LANGUAGE_CODE]; ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php echo $logo; ?>" width="55px" alt="<?php if (ICL_LANGUAGE_CODE == 'ru'){ echo $alt;}else{ bloginfo('name');} ?>"/>
					</a>
					<?php } else { ?>
					<a href="<?php echo $about_link[ICL_LANGUAGE_CODE]; ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php echo $logo; ?>" width="55px" alt="<?php if (ICL_LANGUAGE_CODE == 'ru'){ echo $alt;}else{ bloginfo('name');} ?>"/>
					</a>
					<?php } ?>
						
				<?php } else { ?>
					<?php if(is_front_page()) { ?>
						<div class="logo">
							<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						</div>
					<?php } else { ?>
						<h2 class="logo">
							<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						</h2>
					<?php } ?>
				<?php } ?>
				<?php if(get_theme_mod('centum_tagline_switch','show') == 'show') { ?><div id="tagline"><?php echo get_bloginfo ( 'description' ); ?></div><?php } ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php if($menu_area_width != 0){ ?>
		<!-- Social / Contact -->
		<div class="<?php echo incr_number_to_width($menu_area_width); ?>  columns">
			
			<?php /* get the slider array */
				$footericons = ot_get_option( 'headericons', array() );
				if ( !empty( $footericons ) ) {
					echo '<ul class="social-icons">';
					foreach( $footericons as $icon ) {
						if ($icon['title'] == "facebook" && ICL_LANGUAGE_CODE == 'en' || $icon['title'] == "facebook" && ICL_LANGUAGE_CODE == 'sl'){

							$icon['icons_url'] = "https://www.facebook.com/2TM-Education-in-Slovenia-143815762618594/?fref=nf";
						}
						echo '<li class="' . $icon['icons_service'] . '"><a  target="_blank" title="' . $icon['title'] . '" href="' . $icon['icons_url'] . '">' . $icon['icons_service'] . '</a></li>';
					}
					echo '</ul>';
				}
			?>
			<?php /* construct button based on Language */
				$popup_id = '2610';
				$btn_text = 'Ask a question';
				if(ICL_LANGUAGE_CODE == 'ru'){
					$popup_id = '2600';
					$btn_text = 'Получить консультацию';
                                }
				if(ICL_LANGUAGE_CODE == 'sl'){
					$popup_id = '2616';
					$btn_text = 'Postavite vprašanje';
                                }
				if(ICL_LANGUAGE_CODE == 'uk'){
					$popup_id = '3649';
					$btn_text = 'Отримати консультацію';
                                }
			?>
			<button class="popmake-button popmake-<?=$popup_id?>"><i class="fa fa-paper-plane"></i> <?=$btn_text?></button>

			<div class="clear"></div>
			<?php
			if(ot_get_option( 'centum_contact_details') == 'yes') {
				$email = ot_get_option( 'centum_cdetails_email');
				$phone = ot_get_option( 'centum_cdetails_phone');
			?>
			<!-- Contact Details -->
			<div id="contact-details">
				<ul>
					<li><?php do_action('wpml_add_language_selector'); ?></li>
					<?php if($email) { ?><li><img src="http://2tm.si/wp-content/uploads/2015/02/skype.png" width="18px" class="skype-image"></i><?php echo $email ;?></li><?php } ?>
					
				</ul>
			</div>
			<?php } ?>
			<?php if(ot_get_option('centum_wpml_switcher') == "yes")  do_action('icl_language_selector'); ?>
		</div>
		<?php } ?>

<!-- Stickers Language courses
	================================================== -->
<!-- 
	<?php if(ICL_LANGUAGE_CODE == 'ru'): ?>
	<div class="sticker">
		<p href="/pages?module=privat" class="popmake-12627">Языковые<br/>курсы </p>
	</div>
	<?php endif ?>

	<?php if(ICL_LANGUAGE_CODE == 'ru'): ?>
	<div class="sticker">
		<p href="/pages?module=privat" class="popmake-5138">Языковые<br/>курсы </p>
	</div>
	<?php endif ?>
	<?php if(ICL_LANGUAGE_CODE == 'uk'): ?>
	<div class="sticker">

		<p href="/pages?module=privat" class="popmake-5524"><br/>Мовні<br/>курси</p>
	</div>
	<?php endif ?>
	<?php if(ICL_LANGUAGE_CODE == 'en'): ?>
	<div class="sticker">

		<p href="/pages?module=privat" class="popmake-6470"><br/>Language<br/>courses</p>
	</div>
	<?php endif ?>
 -->
	</div>
	<!-- Header / End -->

<!-- Navigation -->
	<!--div class="sixteen columns"-->

		<div id="navigation">
			<?php
					$menu = wp_nav_menu(
						array(
							'theme_location' => 'mainmenu',
							'echo' => 0,
							'menu_class' => 'dropmenu main-menu',
							'container_id' => 'mainmenu-cont',
							'fallback_cb' => 'magnovus_menu_fb')
						);

					$menu = str_replace("\n", "", $menu);
					$menu = str_replace("\r", "", $menu);
					echo $menu; ?>
			<?php
				wp_nav_menu(array(
					'theme_location' => 'mainmenu',
					'walker'         => new Walker_Nav_Menu_Dropdown(),
					'items_wrap'     => '<select class="selectnav"><option value="/">'.__('Select Page','purepress').'</option>%3$s</select>',
					'container' => false,
					'menu_class' => 'selectnav',

					)); ?>

			<!-- Search Form -->
		<?php if(ot_get_option('centum_search') != "disable") { ?>
			<div class="search-form">
				<form action=" <?php echo home_url(); ?> " id="searchform" method="get">
					<input type="text" class="search-text-box"   name="s">
				</form>
			</div>
			<?php } ?>
		</div>
		<div class="clear"></div>

	<!--/div-->
	<!-- Navigation / End -->
</div>
<!-- 960 Container / End -->