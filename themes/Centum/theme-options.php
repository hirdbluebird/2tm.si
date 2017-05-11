<?php

$layers = array();
global $wpdb;
// Table name

$table_name = $wpdb->prefix . "revslider_sliders";
// Get sliders

if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
  $sliders = $wpdb->get_results( "SELECT alias, title FROM $table_name" );
} else {
  $sliders = '';
}


// Iterate over the sliders
if($sliders) {
  foreach($sliders as $key => $item) {
    $layers[] = array(
      'label' => $item->title,
      'value' => $item->alias
      );
  }
} else {
  $layers[] = array(
    'label' => 'No Sliders Found',
    'value' => ''
    );
}
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', '_custom_theme_options', 1 );


/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

  global $layers;
  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  /**
   * Create a custom settings array that we pass to
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
   'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
          )
        ),
      'sidebar'       => '<p>Sidebar content goes here!</p>'
      ),
    'sections'        => array(
      array(
        'title'       => 'Slider',
        'id'          => 'slider'
        ),
      array(
        'title'       => 'General',
        'id'          => 'general_default'
        ),
       array(
        'title'       => 'General II',
        'id'          => 'general2_default'
        ),
      array(
        'title'       => 'Blog options',
        'id'          => 'blog'
        ),
       array(
        'title'       => 'Portfolio options',
        'id'          => 'portfolio'
        ),
      array(
        'id'          => 'typo',
        'title'       => 'Typography'
        ),
      array(
        'id'          => 'sidebars',
        'title'       => 'Sidebars'
        ),

      array(
        'id'          => 'twitter',
        'title'       => 'Twitter oAuth'
        )
      ),
    'settings'        => array(
      array(
        'label'       => 'Enable slider',
        'id'          => 'slider_on',
        'type'        => 'select',
        'desc'        => 'Show slider on homepage',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
            ),
          array(
            'label'       => 'No',
            'value'       => 'no'
            )
          ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider'
        ),
      array(
        'label'       => 'Select slider for homepage',
        'id'          => 'incr_slider_home',
        'type'        => 'select',
        'desc'        => 'Select slider for homepage',
        'choices'     => array(
          array(
            'label'       => 'Flexslider',
            'value'       => 'flex'
            ),
          array(
            'label'       => 'Revolution Slider',
            'value'       => 'revolution'
            )
          ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider',
        'condition'   => 'slider_on:is(yes)'
        ),
      array(
        'label'       => 'Alias of Revolution Slider for homepage',
        'id'          => 'incr_revo_slider',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => $layers,
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider',
        'condition'   => 'incr_slider_home:is(revolution),slider_on:is(yes)'
        ),

      array(
        'id'          => 'slider_text',
        'label'       => 'About Slider',
        'desc'        => 'Below you can create slides for Flexslider.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => 'incr_slider_home:is(flex),slider_on:is(yes)'
        ),
      array(
        'label'       => 'Homepage Flexslider',
        'id'          => 'mainslider',
        'type'        => 'list-item',
        'desc'        => 'Add slides for homepage slider.',
        'settings'    => array(
          array(
            'label'       => 'Content of slide',
            'id'          => 'slider_description',
            'type'        => 'textarea',
            'desc'        => 'You can use shortcodes here.',
            'std'         => '',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
            ),
          array(
            'label'       => 'Empty slide?',
            'id'          => 'slider_empty',
            'type'        => 'select',
            'desc'        => 'Show just image',
            'choices'     => array(
              array(
                'label'       => 'No',
                'value'       => 'no'
                ),
              array(
                'label'       => 'Yes',
                'value'       => 'yes'
                )
              ),
            'std'         => 'no',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => '',

            ),
          array(
            'label'       => 'Upload Image',
            'id'          => 'slider_image_upload',
            'type'        => 'upload',
            'desc'        => 'Upload image for slide' ,
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
            ),
          array(
            'label'       => 'Optional linke for slide',
            'id'          => 'slider_url',
            'type'        => 'text',
            'desc'        => 'URL of slide' ,
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
            )
          ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider',
        'condition'   => 'incr_slider_home:is(flex),slider_on:is(yes)'
        ),

array(
  'label'       => 'Upload logo',
  'id'          => 'logo_upload',
  'type'        => 'upload',
  'desc'        => 'For best effect logo image should be transparent png, logo from live preview has 114x24px but you can use bigger, you will probably need to adjust some margins using options below ',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general_default'
  ),
array(
  'label'       => 'Logo area width',
  'id'          => 'logo_area_width',
  'type'        => 'select',
  'desc'        => 'Full width of top area is 16 columns. Logo area by default is 9 columns, while icons and contact details area is 6 columns wide. If you want to have bigger logo, please change here number of columns for logo. ',
  'choices'     => array(
    array('label'  => '1 column','value' => '1'),
    array('label'  => '2 columns','value' => '2'),
    array('label'  => '3 columns','value' => '3'),
    array('label'  => '4 columns','value' => '4'),
    array('label'  => '5 columns','value' => '5'),
    array('label'  => '6 columns','value' => '6'),
    array('label'  => '7 columns','value' => '7'),
    array('label'  => '8 columns','value' => '8'),
    array('label'  => '9 columns','value' => '9'),
    array('label'  => '10 columns','value' => '10'),
    array('label'  => '11 columns','value' => '11'),
    array('label'  => '12 columns','value' => '12'),
    array('label'  => '16 columns (full width)','value' => '16'),


    ),
  'std'         => '8',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general_default'
  ),
array(
  'label'       => 'Logo top margin',
  'id'          => 'logo_top_margin',
  'type'        => 'measurement',
  'desc'        => 'Set top margin for logo image',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general_default'
  ),array(
  'label'       => 'Logo bottom margin',
  'id'          => 'logo_bottom_margin',
  'type'        => 'measurement',
  'desc'        => 'Set bottom margin for logo image',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general_default'
  ),
  array(
    'label'       => 'Favicon ',
    'id'          => 'incr_favicon_upload',
    'type'        => 'upload',
    'desc'        => 'Upload favicon here (16x16)',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general_default'
    ),
  array(
    'label'       => 'Tagline top margin',
    'id'          => 'tagline_margin',
    'type'        => 'measurement',
    'desc'        => 'Set top margin for tagline to position it correctly (Tagline is set in Settings -> General -> Tagline).',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general_default'
    ),
  array(
    'label'       => 'Header social icons',
    'id'          => 'headericons',
    'type'        => 'list-item',
    'desc'        => 'Manage socials icons on header.',
    'settings'    => array(


      array(
        'id'          => 'icons_service',
        'label'       => 'Choose service',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array('value'=> 'amazon','label'=> 'Amazon','src'=> ''),
          array('value'=> 'behance','label' => 'Behance','src'=> ''),
          array('value'=> 'blogger','label' => 'Blogger','src'=> ''),
          array('value'=> 'deviantart','label' => 'DeviantArt','src'=> ''),
          array('value'=> 'dribbble','label' => 'Dribbble','src'=> ''),
          array('value'=> 'dropbox','label' => 'Dropbox','src'=> ''),
          array('value'=> 'evernote','label' => 'Evernote','src'=> ''),
          array('value'=> 'facebook','label' => 'Facebook','src'=> ''),
          array('value'=> 'forrst','label' => 'Forrst','src'=> ''),
          array('value'=> 'github','label' => 'Github','src'=> ''),
          array('value'=> 'googleplus','label' => 'Google+','src'=> ''),
          array('value'=> 'jolicloud','label' => 'JoliCloud','src'=> ''),
          array('value'=> 'last-fm','label' => 'LastFM','src'=> ''),
          array('value'=> 'linkedin','label' => 'LinkedIN','src'=> ''),
          array('value'=> 'picasa','label' => 'Picasa','src'=> ''),
          array('value'=> 'pintrest','label' => 'Pinterest','src'=> ''),
          array('value'=> 'rss','label' => 'RSS','src'=> ''),
          array('value'=> 'skype','label' => 'Skype','src'=> ''),
          array('value'=> 'spotify','label' => 'Spotify','src'=> ''),
          array('value'=> 'stumbleupon','label' => 'StumbleUpon','src'=> ''),
          array('value'=> 'tumblr','label' => 'Tumblr','src'=> ''),
          array('value'=> 'twitter','label' => 'Twitter','src'=> ''),
          array('value'=> 'vimeo','label' => 'Vimeo','src'=> ''),
          array('value'=> 'wordpress','label' => 'WordPress','src'=> ''),
          array('value'=> 'xing','label' => 'Xing','src'=> ''),
          array('value'=> 'yahoo','label' => 'Yahoo','src'=> ''),
          array('value'=> 'youtube','label' => 'YouTube','src'=> ''),
          ),
),
array(
  'label'       => 'URL to profile page',
  'id'          => 'icons_url',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  )

),
'std'         => '',
'rows'        => '',
'post_type'   => '',
'taxonomy'    => '',
'class'       => '',
'section'     => 'general_default'
),
array(
  'label'       => 'Search form in menu',
  'id'          => 'centum_search',
  'type'        => 'select',
  'desc'        => '',
  'choices'     => array(
    array(
      'label'       => 'Enable',
      'value'       => 'enable'
      ),
    array(
      'label'       => 'Disable',
      'value'       => 'disable'
      )
    ),
  'std'         => 'disable',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general_default'
  ),
array(
  'label'       => 'Enable breadcrumbs',
  'id'          => 'centum_breadcrumbs',
  'type'        => 'select',
  'desc'        => '',
  'choices'     => array(
    array(
      'label'       => 'No',
      'value'       => 'no'
      ),
    array(
      'label'       => 'Yes',
      'value'       => 'yes'
      )
    ),
  'std'         => 'no',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),

array(
  'label'       => 'Enable WPML language switcher in header',
  'id'          => 'centum_wpml_switcher',
  'type'        => 'select',
  'desc'        => 'Be sure to have installed <a href="http://wpml.org/?aid=27926&affiliate_key=LikrvB9gJOkU">WPML</a> plugin',
  'choices'     => array(
    array(
      'label'       => 'No',
      'value'       => 'no'
      ),
    array(
      'label'       => 'Yes',
      'value'       => 'yes'
      )
    ),
  'std'         => 'no',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Enable contact details in header',
  'id'          => 'centum_contact_details',
  'type'        => 'select',
  'desc'        => '',
  'choices'     => array(
    array(
      'label'       => 'No',
      'value'       => 'no'
      ),
    array(
      'label'       => 'Yes',
      'value'       => 'yes'
      )
    ),
  'std'         => 'no',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Header minimum height',
  'id'          => 'centum_minhh',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '100',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Contact details email',
  'id'          => 'centum_cdetails_email',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Contact details phone',
  'id'          => 'centum_cdetails_phone',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Disable comments on pages',
  'id'          => 'centum_page_comments',
  'type'        => 'on_off',
  'desc'        => '',
  'std'         => 'off',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),
array(
  'label'       => 'Copyrights text',
  'id'          => 'copyrights',
  'type'        => 'text',
  'desc'        => 'Text in footer',
  'std'         => '&copy; Copyright 2012 by <a href="http://themeforest.net/user/purethemes/portfolio?ref=purethemes">Purethemes.net</a>. All Rights Reserved.',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'general2_default'
  ),

array(
  'label'       => 'Blog layout',
  'id'          => 'blog_layout',
  'type'        => 'radio-image',
  'desc'        => 'Choose sidebar side on blog.',
  'std'         => 'right-sidebar',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
    'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
          )

        ),
  'class'       => '',
  'section'     => 'blog'
  ),
array(
  'label'       => 'Blog posts icons',
  'id'          => 'centum_blog_icons',
  'type'        => 'select',
  'desc'        => 'Enable/disable "post types" icons',
  'choices'     => array(
    array(
      'label'       => 'Enable',
      'value'       => 'enable'
      ),
    array(
      'label'       => 'Disable',
      'value'       => 'disable'
      )
    ),
  'std'         => 'enable',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'blog'
  ),
array(
  'label'       => 'Blog page title',
  'id'          => 'incr_blog_page',
  'type'        => 'text',
  'desc'        => '',
  'std'         => 'The Blog',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'blog'
  ),
  array(
        'id'          => 'flext_comments',
        'label'       => 'Disable comments for all posts',
        'desc'        => '',
        'std'         => 'no',

        'section'     => 'blog',
        'type'        => 'select',
        'desc'        => 'Enable/disable "post types" icons',
        'choices'     => array(
          array(
            'label'       => 'No',
            'value'       => 'no'
            ),
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
            )
          ),
      ),
array(
  'label'       => 'Portfolio columns layout',
  'id'          => 'portfolio_layout',
  'type'        => 'select',
  'desc'        => 'Choose number of columns for portfolio archive page',
  'choices'     => array(
    array(
      'label'       => '2 columns',
      'value'       => '2'
      ),
    array(
      'label'       => '3 columns',
      'value'       => '3'
      ),
    array(
      'label'       => '4 columns',
      'value'       => '4'
      )
    ),
  'std'         => '3',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),

array(
  'label'       => 'Portfolio page title',
  'id'          => 'incr_portfolio_page',
  'type'        => 'text',
  'desc'        => '',
  'std'         => 'Portfolio',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),


array(
  'label'       => 'Portfolio thumbnail behaviour',
  'id'          => 'portfolio_thumb',
  'type'        => 'select',
  'desc'        => 'Choose if you want to display thumbnails in portfolio as a link or in a lightbox',
  'choices'     => array(
    array(
      'label'       => 'Link',
      'value'       => 'link'
      ),
    array(
      'label'       => 'Lightbox',
      'value'       => 'lightbox'
      )
    ),
  'std'         => '3',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),
array(
  'label'       => 'For "video portfolio" items show image thumbnail or video in archive and /portfolio page',
  'id'          => 'portfolio_videothumb',
  'type'        => 'select',
  'desc'        => 'Choose if you want to display thumbnails as image or as small embeded video',
  'choices'     => array(
    array(
      'label'       => 'Video',
      'value'       => 'video'
      ),
    array(
      'label'       => 'Image thumbnail',
      'value'       => 'thumb'
      )
    ),
  'std'         => '3',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),
array(
  'label'       => 'Portfolio number of items to display',
  'id'          => 'portfolio_showpost',
  'type'        => 'select',
  'desc'        => 'Choose how many items to display on portfolio page',
  'choices'     => array(
    array('label'=> '3','value'=> '3'),
    array('label'=> '4','value'=> '4'),
    array('label'=> '5','value'=> '5'),
    array('label'=> '6','value'=> '6'),
    array('label'=> '7','value'=> '7'),
    array('label'=> '8','value'=> '8'),
    array('label'=> '9','value'=> '9'),
    array('label'=> '10','value'=> '10'),
    array('label'=> '11','value'=> '11'),
    array('label'=> '12','value'=> '12'),
    array('label'=> '13','value'=> '13'),
    array('label'=> '14','value'=> '14'),
    array('label'=> '15','value'=> '15'),
    array('label'=> '16','value'=> '16'),
    array('label'=> '32','value'=> '32'),
    array('label'=> '48','value'=> '48'),
    array('label'=> '99','value'=> '99')
    ),
  'std'         => '9',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),

array(
  'label'       => 'Portfolio text control',
  'id'          => 'centum_portfolio_text',
  'type'        => 'select',
  'desc'        => 'Choose "excerpt" to show content filled in excerpt field in portfolio item editor, or choose "limit words" to show only few
                    words from the content of portfolio item (the number of words can be changed in source code. More info on <a href="http://www.docs.purethemes.net/centum/">documentation</a>',
  'choices'     => array(
    array('label'=> 'Limit words','value'=> 'limit'),
    array('label'=> 'Excerpt','value'=> 'excerpt')
   ),
  'std'         => 'limit',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),
array(
  'label'       => 'Portfolio meta informations',
  'id'          => 'centum_pf_meta',
  'type'        => 'list-item',
  'desc'        => 'Manage meta information below portfolio.',
  'settings'    => array(
    array(
        'label'       => 'Type of field',
        'id'          => 'type',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array(
            'label'       => 'Text',
            'value'       => 'text'
            ),
          array(
            'label'       => 'Filters',
            'value'       => 'filters'
            ),
          array(
            'label'       => 'Date of publication',
            'value'       => 'dateofp'
            ),
          array(
            'label'       => 'Link to project (as a button)',
            'value'       => 'link'
            )
          ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    ),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),
array(
  'label'       => 'Enable portfolio from old Centum versions',
  'id'          => 'old_pf_type',
  'type'        => 'on_off',
  'desc'        => 'This is option for users who started using Centum before 2nd half of 2013, when the portfolio items were created in old way by attaching images. If you want to keep it switch this option to ON',
  'std'         => 'off',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'portfolio'
  ),
array(
  'id'          => 'sidebars_text',
  'label'       => 'About sidebars',
  'desc'        => 'All sidebars that you create here will appear both in the Appearance > Widgets, and then you can choose them for specific pages or posts.',
  'std'         => '',
  'type'        => 'textblock',
  'section'     => 'sidebars',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  ),
array(
  'label'       => 'Create Sidebars',
  'id'          => 'incr_sidebars',
  'type'        => 'list-item',
  'desc'        => 'Choose a unique title for each sidebar',
  'section'     => 'sidebars',
  'settings'    => array(
    array(
      'label'       => 'ID',
      'id'          => 'id',
      'type'        => 'text',
      'desc'        => 'Write a lowercase single world as ID (or number), without any spaces',
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
      )
    )
  ),
array(
  'id'          => 'incr_custom_css',
  'label'       => 'Custom CSS',
  'desc'        => 'To prevent problems with theme update, write here any custom css (or use child themes)',
  'std'         => '',
  'type'        => 'textarea-simple',
  'section'     => 'general2_default',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  ),
// array(
//   'id'          => 'incr_analytics',
//   'label'       => 'Analytics code',
//   'desc'        => 'Put here your  Analytics script code',
//   'std'         => '',
//   'type'        => 'textarea-simple',
//   'section'     => 'general2_default',
//   'rows'        => '',
//   'post_type'   => '',
//   'taxonomy'    => '',
//   'class'       => ''
//   ),
   array(
      'label'       => 'Fonts stack',
      'id'          => 'phantom_font',
      'type'        => 'googlefonts',
      'desc'        => '',
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => 'typo'
      ),
    array(
  'id'          => 'fonts_info',
  'label'       => 'Fonts stack info',
  'desc'        => 'You need to Save Changes after adding new fonts to your Google Fonts Stack to be able to select them in the typography fields below',
  'std'         => '',
  'type'        => 'textblock',
  'section'     => 'typo',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  ),
array(
  'label'       => 'Body Font',
  'id'          => 'centum_body_font',
  'type'        => 'typography',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Menu Font',
  'id'          => 'centum_menu_font',
  'type'        => 'typography',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Logo Font',
  'id'          => 'centum_logo_font',
  'type'        => 'typography',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Headers (h1..h6) Font',
  'id'          => 'centum_headers_font',
  'type'        => 'typography',
  'desc'        => 'Size and related to it settings will be ignored here.',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),



/*array(
  'label'       => 'Enable custom fonts',
  'id'          => 'incr_fonts_on',
  'type'        => 'select',
  'desc'        => 'Note that this is experimental feature, not all fonts might work properly.',
  'choices'     => array(
    array(
      'label'       => 'No',
      'value'       => 'no'
      ),
    array(
      'label'       => 'Yes',
      'value'       => 'yes'
      )
    ),
  'std'         => 'no',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Body font',
  'id'          => 'incr_body_font',
  'desc'        => 'Choose font for body (We recommend Open Sans).',
  'std'         => '',
  'type'        => 'select',
  'section'     => 'typo',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'choices'     => $google_fonts
  ),
array(
  'label'       => 'Body font size',
  'id'          => 'incr_body_size',
  'type'        => 'measurement',
  'desc'        => 'Set font-size for texts',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Headings font',
  'id'          => 'incr_h_font',
  'desc'        => 'Choose font for headers h1-h6.',
  'std'         => '',
  'type'        => 'select',
  'section'     => 'typo',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'choices'     => $google_fonts
  ),
array(
  'label'       => 'Enable custom typography for logo',
  'id'          => 'incr_logofonts_on',
  'type'        => 'select',
  'desc'        => 'Select "Yes" to enable custom typo',
  'choices'     => array(
    array(
      'label'       => 'No',
      'value'       => 'no'
      ),
    array(
      'label'       => 'Yes',
      'value'       => 'yes'
      )
    ),
  'std'         => 'no',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),
array(
  'label'       => 'Logo typography',
  'id'          => 'incr_logo_typo',
  'type'        => 'typography',
  'desc'        => 'If you are using text logo here you can set font options.',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'typo'
  ),*/

array(
  'id'          => 'twitter_info',
  'label'       => 'Twitter OAuth keys',
  'desc'        => 'From March 2013 Twitter requires authentication to access your tweets. Here are fields you need to fill if you want to use Nevia Twitter Widgets. How to do it you can find in documentation and on https://dev.twitter.com .',
  'std'         => '',
  'type'        => 'textblock',
  'section'     => 'twitter',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  ),
array(
  'label'       => 'Twitter Consumer Key',
  'id'          => 'pp_twitter_ck',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'twitter'
  ),
array(
  'label'       => 'Twitter Consumer Secret',
  'id'          => 'pp_twitter_cs',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'twitter'
  ),
array(
  'label'       => 'Twitter Access Token',
  'id'          => 'pp_twitter_at',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'twitter'
  ),
array(
  'label'       => 'Twitter Access Token Secret',
  'id'          => 'pp_twitter_ts',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => '',
  'section'     => 'twitter'
  )
)
);


if (function_exists('icl_get_languages')) {
  $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
      foreach($languages as $l){

         $custom_settings['settings'][]=
          array(
          'label'       => 'Alias of Revolution Slider for homepage with '.$l['native_name'].' language',
          'id'          => 'incr_revo_slider'.$l['language_code'],
          'type'        => 'text',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'slider'
          );
      }
  }
}

/*echo '<pre>';
print_r( $custom_settings['settings']);
echo '</pre>';*/
/* settings are not the same update the DB */
if ( $saved_settings !== $custom_settings ) {
  update_option( 'option_tree_settings', $custom_settings );
}

}

