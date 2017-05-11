<?php
//wp_set_password( 'password', 1 );

$shortname = "icrd";
define('PPTNAME', $shortname);

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );


/**
 * Theme Options
 */
include_once( 'theme-options.php' );
include_once( 'meta-boxes.php' );


require_once( 'backend/widgets.php' );
require_once( 'backend/helpers.php' );
require_once( 'backend/tinymce.php' );
require_once( 'backend/shortcodes.php' );
require_once( 'backend/cssjs.php' );
require_once ('backend/sidebars.php'); // Unlimited sidebars generator
require_once ('backend/tgmpa.php'); // Unlimited sidebars generator
//require_once ('revslider/revslider.php'); // Revolution Slider



add_theme_support( 'woocommerce' );


add_editor_style( 'editor-style.css' );
add_action('after_setup_theme', 'purepress_setup');
if (!function_exists('purepress_setup')):

    function purepress_setup() {

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Make theme available for translation
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain('purepress', get_template_directory() . '/languages');

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if (is_readable($locale_file))
            require_once( $locale_file );

        // This theme uses wp_nav_menu() in one location.
        add_theme_support('menus');
        register_nav_menus(array(
            'mainmenu' => 'Menu'
            )
        );

        // This theme allows users to set a custom background
        if ( ! isset( $content_width ) ) $content_width = 960;

        add_theme_support( 'post-formats', array( 'gallery','video','audio' ) );
        add_post_type_support( 'post', 'post-formats' );
    }

endif; // function_exists

$args = array(
    'default-color' => 'ffffff',
    'default-image' => get_template_directory_uri() . '/images/bg/noise.png',
);
add_theme_support( 'custom-background', $args );

add_filter('widget_text', 'do_shortcode');

// Register and enquee scripts

if (!function_exists('pp_scripts')) {
    function pp_scripts() {

        wp_enqueue_style( 'pp-woocommerce', get_template_directory_uri().'/css/woocommerce.css' );


        wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'twitter', get_template_directory_uri() . '/js/twitter.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/js/tooltip.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'effects', get_template_directory_uri() . '/js/effects.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        $centumfonts = build_webfonts_links();
        if(!empty($centumfonts)) {
            $protocol = is_ssl() ? 'https' : 'http';
            $font_query_args = array(
                'family' => $centumfonts['fonts'],
                'subset' => $centumfonts['subsets'],
            );

            wp_enqueue_style('centum-gfont',
                add_query_arg($font_query_args, "$protocol://fonts.googleapis.com/css" ),
                array(), null
            );
        }

    }
    add_action('wp_enqueue_scripts', 'pp_scripts');
}


function build_webfonts_links() {
    $fonts_options = ot_get_option( 'phantom_font', array(
        "Open Sans" => array(
            'font-name'=> 'Open Sans',
            'variants' => 'regular,400,300,600,700,',
            'subsets' => 'latin'
            )
        ));
   if(!empty($fonts_options)) {
    $phantomfonts = array();

    //building googlefonts link:
    $googlefontsarray = array();
    $output = array();
    foreach ($fonts_options as $key) {
        if(isset($key['font-name'])) { $font = $key['font-name']; } else { $font = ''; }
        if(isset($key['subsets'])) { $subsets = $key['subsets']; } else { $subsets = ''; }
        if(isset($key['variants'])) { $variants = $key['variants']; } else { $variants = ''; }
        if(!empty($variants)) {
            $ready_variants = ":".$variants;
        } else {
            $ready_variants = '';
        }
        if(!empty($subsets)) {
            $ready_subsets = $subsets;
        } else {
            $ready_subsets = '';
        }
            $font = str_replace(' ', '+', $font);
            $googlefontsarray['fonts'][] = $font.$ready_variants;
            $googlefontsarray['subsets'][] = $ready_subsets;
    }

    $output['fonts'] = implode("|", $googlefontsarray['fonts']);
    $output['subsets'] = implode(",", $googlefontsarray['subsets']);
    //let's clean duplicated subsets
    $arr = explode( "," , $output['subsets'] );
    $arr = array_unique( $arr );
    $output['subsets'] = implode("," , $arr);
    return $output;
    }
}


function phantom_build_googlefont_link() {
    $gf = ot_get_option( 'phantom_font',array() );
    $gfh = ot_get_option( 'phantom_header_font',array() );
    if($gf['font-family'] == $gfh['font-family']) {
        $fonts = array( $gf );
    } else {
        $fonts = array( $gf , $gfh );
    }
    $outputarray = array();

    foreach ($fonts as $key) {
        if(isset($key['font-family'])) { $font = $key['font-family']; } else { $font = ''; }
        if(isset($key['subsets'])) { $subsets = $key['subsets']; } else { $subsets = ''; }
        if(isset($key['variants'])) { $variants = $key['variants']; } else { $variants = ''; }

        if(!empty($variants)) {
            $variants = implode(",",$variants);
            $ready_variants = ":".$variants;
        } else {
            $ready_variants = '';
        }
        if(!empty($subsets)) {
            $subsets = implode(",",$subsets);
            $ready_subsets = $subsets;
        } else {
            $ready_subsets = '';
        }
        if(!empty($fonts)) {
            $font = str_replace(' ', '+', $font);
            $outputarray['fonts'][] = $font.$ready_variants;
            $outputarray['subsets'][] = $ready_subsets;
        }
    }
    $output['fonts'] = implode("|", $outputarray['fonts']);
    $output['subsets'] = implode(",", $outputarray['subsets']);
    return $output;
}

function phantom_build_brickfont_link() {
    $gf = ot_get_option( 'phantom_font',array() );
    $gfh = ot_get_option( 'phantom_header_font',array() );
    if($gf['font-family'] == $gfh['font-family']) {
        $fonts = array( $gf );
    } else {
        $fonts = array( $gf , $gfh );
    }
    $outputarray = array();

    foreach ($fonts as $key) {
        if(isset($key['font-family'])) { $font = $key['font-family']; } else { $font = ''; }
        if(isset($key['variants'])) { $variants = $key['variants']; } else { $variants = ''; }

        if(!empty($variants)) {
            $variants = implode(",",$variants);
            $ready_variants = ":".$variants;
        } else {
            $ready_variants = '';
        }

        if(!empty($fonts)) {
            $font = str_replace(' ', '+', $font);
            $outputarray['fonts'][] = $font.$ready_variants;
        }
    }
    $output = implode("/", $outputarray['fonts']);
    //Roboto+Slab:300,400,700/Noto+Serif:400,700,400i,700i

    return $output;
}

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(700, 330, true); //size of thumbs
    add_image_size('small-thumb', 49, 49, true);
    add_image_size('slider', 372, 255, true);

    //set to 472
    add_image_size('portfolio-main', 940, 0, true);
    add_image_size('portfolio-medium', 460, 290, true);
    add_image_size('portfolio-thumb', 300, 200, true);



/*
 * Footer
*/
function centum_widgets_init() {
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => 'Sidebar Area',
        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin" id="tes29"><div class="widjetH4-sidebar">',
        'after_title' => '</div></div>',
        ));
    if ( function_exists('woocommerce_get_page_id') ) {

     register_sidebar(array(
        'id' => 'shop',
        'name' => 'Shop',
        'before_widget' => '<div id="%1$s" class="widget  %2$s" id="tes30">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin"><h4>',
        'after_title' => '</h4></div>',
        ));
    }
    register_sidebar(array(
        'id' => 'footer1st',
        'name' => 'Footer 1st Column',
        'description' => '1st column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s" id="tes31">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><div class="wasH4-footer" id="tes52">',
        'after_title' => '</div></div>',
        ));
     register_sidebar(array(
        'id' => 'footer2nd',
        'name' => 'Footer 2nd Column',
        'description' => '2nd column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s" id="tes32">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><div class="wasH4-footer" id="tes53">',
        'after_title' => '</div></div>',
        ));
     register_sidebar(array(
        'id' => 'footer3rd',
        'name' => 'Footer 3rd Column',
        'description' => '3rd column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s" id="tes33">',
        'after_widget' => '</div>',
         'before_title' => '<div class="footer-headline"><div class="wasH4-footer" id="tes54"> ',
        'after_title' => '</div></div>',
        ));
     register_sidebar(array(
        'id' => 'footer4th',
        'name' => 'Footer 4th Column',
        'description' => '4th column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s" id="tes34">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><div class="wasH4-footer" id="tes55">',
        'after_title' => '</div></div>',
        ));
    register_sidebar(array(
        'id' => 'educationpanel',
        'name' => 'Education widget panel',
        'before_widget' => '<div id="%1$s" class="widget  %2$s" id="tes35">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin" id="tes36"><div class="widjetH4-sidebar">',
        'after_title' => '</div></div>',
        ));		
    register_sidebar(array(
        'id' => 'homepagepanel',
        'name' => 'Homepage widget panel',
        'before_widget' => '<div id="%1$s" class="widget  %2$s" id="tes36">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin"><h4>',
        'after_title' => '</h4></div>',
        ));		
    register_sidebar(array(
        'id' => 'immigrationpanel',
        'name' => 'Immigration widget panel',
        'before_widget' => '<div id="%1$s" class="widget  %2$s" id="tes37">',
        'after_widget' => '</div>',
		 'before_title' => '<div class="headline no-margin"><h4>',
        'after_title' => '</h4></div>',
        ));		
}
if (ot_get_option('incr_sidebars')):
    $pp_sidebars = ot_get_option('incr_sidebars');
    foreach ($pp_sidebars as $pp_sidebar) {

    register_sidebar(array(
        'name' => $pp_sidebar["title"],
        'id' => $pp_sidebar["id"],

          'before_widget' => '<div id="%1$s" class="widget  %2$s" id="tes38">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin"><h4>',
        'after_title' => '</h4></div>',
        ));
}

endif;
}
add_action( 'widgets_init', 'centum_widgets_init' );

/**
 *
 * @global <type> $GLOBALS['allowedposttags']
 * @name $allowedposttags
 */
$allowedposttags["li"] = array(
        "data-feature" => array(),

);


/**
 * Add to extended_valid_elements for TinyMCE
 *
 * @param $init assoc. array of TinyMCE options
 * @return $init the changed assoc. array
 */
function change_mce_options( $init ) {
    //code that adds additional attributes to the pre tag
    $ext = 'li[data-feature]';

    //if extended_valid_elements alreay exists, add to it
    //otherwise, set the extended_valid_elements to $ext
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    //important: return $init!
    return $init;
}
add_filter('tiny_mce_before_init', 'change_mce_options');

add_filter('comment_form_defaults', 'my_comment_defaults');
function my_comment_defaults($defaults) {
    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->display_name;
    $defaults = array(
        'fields' => array(
            'author' => '<div><label for="author">' . __('Name','purepress') . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author"  type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
            'url' => '<div><label for="url">' . __('Email','purepress') . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
            'email' => '<div><label for="email">' . __('Url','purepress') . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="url" name="url" type="text"   value="' . esc_attr($commenter['comment_author_url']) . '" size="30"' . $aria_req . ' /></div>'
            ),
        'comment_field' => '<div><label for="comment">' . __('Comment', 'purepress') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'comment_notes_before' => '<fieldset>',
        'comment_notes_after' => '</fieldset>',
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => __('Leave a Comment','purepress'),
        'title_reply_to' => __('Leave a Reply %s','purepress'),
        'cancel_reply_link' => __('Cancel reply','purepress'),
        'label_submit' => __('Comment','purepress'),
        );

return $defaults;
}

/*
 * Custom comments
*/

function purepress_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
    case '' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comments">
            <div class="avatar"><?php  echo get_avatar($comment, 50); ?></div>
            <div class="comment-des">
                <div class="comment-by">
                    <strong><?php printf(__('%s ', 'boilerplate'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?></strong>
                    <span class="reply"><span style="color:#aaa">/ </span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
                    <span class="date"> <?php
                    /* translators: 1: date, 2: time */
                    printf(__('%1$s at %2$s', 'boilerplate'), get_comment_date(), get_comment_time());
                    ?> </span></div>

                    <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', 'purepress'); ?></em>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
        </article><!-- #comment-##  -->
        <?php
        break;
        case 'pingback' :
        case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e('Pingback:', 'boilerplate'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'boilerplate'), ' '); ?></p>
            <?php
            break;
            endswitch;
        }

    /**
     * Collects our theme options
     *
     * @return array
     */
    function purepress_get_global_options() {

        $purepress_option = array();

        $purepress_option = get_option('purepress_options');

        return $purepress_option;
    }

    /**
     * Call the function and collect in variable
     *
     * Should be used in template files like this:
     * <?php echo $purepress_option['purepress_txt_input']; ?>
     *
     * Note: Should you notice that the variable ($purepress_option) is empty when used in certain templates such as header.php, sidebar.php and footer.php
     * you will need to call the function (copy the line below and paste it) at the top of those documents (within php tags)!
     */
    $purepress_option = purepress_get_global_options();




/* ----------------------------------------------------- */
/* Work Custom Post Type */
/* ----------------------------------------------------- */


add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

    $labels = array(
        'name' => __( 'Education','purepress'),
        'singular_name' => __( 'Portfolio','purepress'),
        'add_new' => __( 'Add New','purepress' ),
        'add_new_item' => __( 'Add New Work','purepress' ),
        'edit_item' => __( 'Edit Work','purepress'),
        'new_item' => __( 'New Work','purepress'),
        'view_item' => __( 'View Work','purepress'),
        'search_items' => __( 'Search Portfolio','purepress'),
        'not_found' => __( 'No portfolio found','purepress'),
        'not_found_in_trash' => __( 'No works found in Trash','purepress'),
        'parent_item_colon' => __( 'Parent work:','purepress'),
        'menu_name' => __( 'Portfolio','purepress'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Display your works by filters',
        'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,

        //'menu_icon' => TEMPLATE_URL . 'work.png',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'blog' ),
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

/* ----------------------------------------------------- */
/* Filter Taxonomy */
/* ----------------------------------------------------- */

add_action( 'init', 'register_taxonomy_filters' );

function register_taxonomy_filters() {

    $labels = array(
        'name' => __( 'Filters', 'purepress' ),
        'singular_name' => __( 'Filter', 'purepress' ),
        'search_items' => __( 'Search Filters', 'purepress' ),
        'popular_items' => __( 'Popular Filters', 'purepress' ),
        'all_items' => __( 'All Filters', 'purepress' ),
        'parent_item' => __( 'Parent Filter', 'purepress' ),
        'parent_item_colon' => __( 'Parent Filter:', 'purepress' ),
        'edit_item' => __( 'Edit Filter', 'purepress' ),
        'update_item' => __( 'Update Filter', 'purepress' ),
        'add_new_item' => __( 'Add New Filter', 'purepress' ),
        'new_item_name' => __( 'New Filter', 'purepress' ),
        'separate_items_with_commas' => __( 'Separate Filters with commas', 'purepress' ),
        'add_or_remove_items' => __( 'Add or remove Filters', 'purepress' ),
        'choose_from_most_used' => __( 'Choose from the most used Filters', 'purepress' ),
        'menu_name' => __( 'Filters', 'purepress' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'filters', array('portfolio'), $args );
}


/*
 * Adds terms from a custom taxonomy to post_class
 */
add_filter( 'post_class', 'theme_t_wp_taxonomy_post_class', 10, 3 );

function theme_t_wp_taxonomy_post_class( $classes, $class, $ID ) {
    $taxonomy = 'filters';
    $terms = get_the_terms( (int) $ID, $taxonomy );
    if( !empty( $terms ) ) {
        foreach( (array) $terms as $order => $term ) {
            if( !in_array( $term->slug, $classes ) ) {
                $classes[] = $term->slug;
            }
        }
    }
    return $classes;
}

/* ----------------------------------------------------- */
/* EOF */




/*
Plugin Name: OptionTree Attachments Checkbox
 ----------------------------------------------------- */



/*
Plugin Name: OptionTree Gallery Manager
author: purethemes.net
----------------------------------------------------- */

function ot_type_puregallery( $args = array() ) {
    /* turns arguments array into variables */
    extract( $args );
    global $post;

    $current_post_id = $post->ID;

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-post_attachments_checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

    /* description */
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . ' <br/><a href="#" class="delete-gallery">Delete gallery</a></div>' : '';

    /* format setting inner wrapper */
    echo '<div class="format-setting-inner">';

    /* setup the post types */
    $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
    global $pagenow;
    if($pagenow == 'themes.php' ) {
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'post_mime_type' => 'image',
            'post__in' => explode( ",", $field_value),
            'posts_per_page' => '-1',
            'orderby' => 'post__in'
            );
    } else {
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'post__in' => explode( ",", $field_value),
            'post_mime_type' => 'image',
            'posts_per_page' => '-1',
            'orderby' => 'post__in'
            );
    }

    /* query posts array */
    $query = new WP_Query( $args  );

    /* has posts */ echo '<input type="hidden" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';
    if ( $query->have_posts() ) {
        echo '<ul style="margin:0px" id="option-tree-gallery-list">';
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<li>';
                $thumbnail = wp_get_attachment_image_src( $query->post->ID, 'thumbnail');
                echo '<img  src="' . $thumbnail[0] . '" width="60" height="60" />';
                echo '</li>';

            }
        echo "</ul>";
        echo '<a title="Add images" class="option-tree-attachments-update option-tree-ui-button blue right hug-right addgallery" href="#">Edit Slider Gallery</a>';

    } else {
        echo '<ul style="margin:0px" id="option-tree-gallery-list"></ul><p>' . __( 'No Gallery', 'option-tree' ) . '</p>';
        echo '<a title="Add images" class="option-tree-attachments-update option-tree-ui-button blue right hug-right addgallery" href="#">Create Slider Gallery</a>';
    }

    echo '</div>';

    echo '</div>';
}
//fake and dirty shortcode for stupid media uploader
function media_view_settings($settings, $post ) {
    if (!is_object($post)) return $settings;
    $shortcode = '[gallery ';
    $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
    $ids = explode(",", $ids);

    if (is_array($ids))
        $shortcode .= 'ids = "' . implode(',',$ids) . '"]';
    else
        $shortcode .= "id = \"{$post->ID}\"]";
    $settings['neviagallery'] = array('shortcode' => $shortcode);
    return $settings;

}
add_filter( 'media_view_settings','media_view_settings', 10, 2 );


function ot_type_attachments_ajax_update() {
    if ( !empty( $_POST['ids'] ) )  {
            $args = array(
                   'post_type' => 'attachment',
                    'post_status' => 'inherit',
                    'post__in' => $_POST['ids'],
                    'post_mime_type' => 'image',
                    'posts_per_page' => '-1',
                    'orderby' => 'post__in'
                );
            $return = '';
                /* query posts array */
    $query = new WP_Query( $args  );
    $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
    /* has posts */
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $return .= '<li>';
            $thumbnail = wp_get_attachment_image_src( $query->post->ID, 'thumbnail');
            $return .=  '<img  src="' . $thumbnail[0] . '" width="60" height="60" />';
            $return .=  '</li>';

        }

    } else {
        $return .=  '<p>' . __( 'No Posts Found', 'option-tree' ) . '</p>';
    }
            echo $return;
            exit();
    }
}

add_action( 'wp_ajax_attachments_update', 'ot_type_attachments_ajax_update' );






//woocommerce

//define( 'WOOCOMMERCE_USE_CSS', false );
 add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/*
** WOOCOMMERCE
*/

remove_action( 'woocommerce_before_main_content',    'woocommerce_breadcrumb', 20, 0);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
 }


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;
        $output = '';
        if ( ! $placeholder_width )
            $placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
        if ( ! $placeholder_height )
            $placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
            $output .= '<a href="'.get_permalink().'">';
            if ( has_post_thumbnail() ) {
                $output .= get_the_post_thumbnail( $post->ID, 'shop_catalog' );
            } else {
                $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            }
            $output .= '</a>';
            return $output;
    }
 }

/**
 * Replace WooCommerce Default Pagination with WP-PageNavi Pagination
 *
 * @author WPSnacks.com
 * @link http://www.wpsnacks.com
 */
if(function_exists('wp_pagenavi')) {
    remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
    function woocommerce_pagination() {
        wp_pagenavi();
    }
    add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);
}
remove_action('woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );


/**
 * Custom Add To Cart Messages
 *
 **/
add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
    global $woocommerce;

    // Output success messages
    if (get_option('woocommerce_cart_redirect_after_add')=='yes') :

        $return_to  = get_permalink(woocommerce_get_page_id('shop'));

        $message    = sprintf('<p id="added_cart_info">%s</p> <a href="%s" style="float:right; margin-right: -15px;" class="button color">%s</a>', __('Product successfully added to your cart.', 'woocommerce'), $return_to, __('Continue Shopping &rarr;', 'woocommerce') );

    else :

        $message    = sprintf('<div class="notification closeable success"><p id="added_cart_info">%s</p> <a href="%s" style="float:right; margin-right: -15px;" class="button color">%s</a> </div>', __('Product successfully added to your cart.', 'woocommerce'), get_permalink(woocommerce_get_page_id('cart')), __('View Cart &rarr;', 'woocommerce') );

    endif;

        return $message;
}

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'astrum_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function astrum_woocommerce_image_dimensions() {
    $catalog = array(
        'width'     => '400',   // px
        'height'    => '340',   // px
        'crop'      => 1        // true
        );

    $single = array(
        'width'     => '650',   // px
        'height'    => '550',   // px
        'crop'      => 1        // true
        );

    $thumbnail = array(
        'width'     => '130',   // px
        'height'    => '130',   // px
        'crop'      => 1        // false
        );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}

/* Change number of items */
function astrum_woocommerce_catalog_page_ordering() {
$wooitems = ot_get_option('pp_wooitems','9');
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$wooitems.';' ), 20 );

}
add_action( 'woocommerce_pagination','astrum_woocommerce_catalog_page_ordering');
/* remove comments if you want to get rid of sorting and results counter
remove_filter( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );*/
remove_filter( 'woocommerce_before_shop_loop', 'woocommerce_result_count',20 );


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

add_filter( 'pre_get_shortlink', '__return_false' );

//replace placeholder image
add_action( 'init', 'custom_fix_thumbnail' );

function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

    function custom_woocommerce_placeholder_img_src( $src ) {

    $src = get_template_directory_uri() . '/images/placeholder.jpg';

    return $src;
    }
}

    if (function_exists('set_revslider_as_theme')) {
        set_revslider_as_theme();
    }

function mayak_widget_php($widget_content) {
if (strpos($widget_content, '<' . '?') !== false) {
ob_start();
eval('?' . '>' . $widget_content);
$widget_content = ob_get_contents();
ob_end_clean();
}
return $widget_content;
}
add_filter('widget_text', 'mayak_widget_php', 99);
?>