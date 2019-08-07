<?php

  function pageBanner($args = NULL){
      if(!$args['title']){
        $args['title'] = get_the_title();
      }

      if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
      }

      if(!$args['photo']){
        if(get_field('page_banner_background_image')){
          $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else{
          $args['photo'] = get_theme_file_uri('/images/sky.jpg');
        }
      }

    ?>

    <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
    <div class="page-banner__intro">
      <p><?php echo $args['subtitle']; ?></p>
    </div>
  </div>
</div>

    <?php
  }

  //Requiring ACF Plugin

  require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

  function require_plugins(){
    $plugins = array(
      array(
  'name'               => 'Advanced Custom Fields',
  'slug'               => 'advanced-custom-fields',
  'source'             => get_stylesheet_directory() . '/plugins/advanced-custom-fields.zip',
  'required'           => true, // If false, the plugin is only 'recommended' instead of required.
  'version'            => '5.8.2',
  'force_activation'   => true,
  'force_deactivation' => false,
  // 'external_url'       => '',
  // 'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
)
    //   array(
		// 	'name'         => 'Advanced Custom Fields',
		// 	'slug'         => 'advanced-custom-fields',
		// 	'source'       => 'https://downloads.wordpress.org/plugin/advanced-custom-fields.5.8.2.zip', // The plugin source.
		// 	'required'     => false,
		// 	// 'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader',
		// )
    );
    $config = array(

		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',    // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

  }

  add_action('tgmpa_register', 'require_plugins');

  function uni_files(){
    //Disabling caching while developinh
    // wp_enqueue_script('uni-main-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_script('uni-main-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    // wp_enqueue_style('uni_main_styles', get_stylesheet_uri());
    wp_enqueue_style('uni_main_styles', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_style('custom_google_font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  }

  function uni_features(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 480, 260, true );
    add_image_size('professorPortrait', 400, 650, true );
    add_image_size('pageBanner', 1500, 350, true);
    register_nav_menu('headerMenu', 'Header Menu');
    register_nav_menu('footerOne', 'Footer 1');
    register_nav_menu('footerTwo', 'Footer 2');
  }



  add_action('wp_enqueue_scripts', 'uni_files');
  add_action('after_setup_theme', 'uni_features');

  function uni_post_types(){
//Register Event type
    register_post_type('event', array(
      'rewrite' => array('slug' => 'events'),
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt'),
      'public' => true,
      'menu_icon' => 'dashicons-calendar-alt',
      'labels' => array(
        'name' => 'Events',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'all_items' => 'All Events',
        'singular_name' => 'Event'
      )
    ));

    //Register Program type

    register_post_type('program', array(
      'rewrite' => array('slug' => 'programs'),
      'has_archive' => true,
      'supports' => array('title', 'editor'),
      'public' => true,
      'menu_icon' => 'dashicons-awards',
      'labels' => array(
        'name' => 'Programs',
        'add_new_item' => 'Add New Program',
        'edit_item' => 'Edit Program',
        'all_items' => 'All Programs',
        'singular_name' => 'Program'
      )
    ));

    //Register Professor type

    register_post_type('professor', array(
      'rewrite' => array('slug' => 'professors'),
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'public' => true,
      'menu_icon' => 'dashicons-welcome-learn-more',
      'labels' => array(
        'name' => 'Professors',
        'add_new_item' => 'Add New Professor',
        'edit_item' => 'Edit Professor',
        'all_items' => 'All Professors',
        'singular_name' => 'Professor'
      )
    ));



  }

  add_action('init', 'uni_post_types');

  function uni_adjust_queries($query){

    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page', -1);


    }
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
      $today = date('Ymd');
      $query->set('meta_key', 'event_date');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
        array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
      ));
    }
  }


  add_action('pre_get_posts', 'uni_adjust_queries');

//Highlight "Programs" in menu Bar when user is viewing All Programs Page

  function add_nav_menu_classes($classes, $item){
     if( is_post_type_archive('program') && ($item->title == "Programs") ){
        $classes[] = 'current-menu-item';
     }

     return $classes;
  }

  add_filter('nav_menu_css_class' , 'add_nav_menu_classes' , 10 , 2);




 ?>
