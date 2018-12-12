    <?php

    /*

    Plugin Name:  Share it Wordpress
    Description:  این افزونه به شما کمک می‌کند تا هر پست خود را به انتخاب در تلگرام ارسال کنید
    Version:      0.1
    Author:       Masoud Nikoomanesh
    Author URI:   https://hipdesign.ir

    */

    // Error Logs
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // Load Libraries
    require_once 'vendor/autoload.php';

    define('sharei-wp', '0.1');

    define('sharei-wp_PLUGIN_URL', plugin_dir_url(__FILE__));
    define('sharei-wp_PLUGIN_PATH', plugin_dir_path(__FILE__));
    define('sharei-wp_PLUGIN_BASENAME', plugin_basename(__FILE__));

    add_action( 'admin_init', 'sharei_wp_settings_username' );
    function sharei_wp_register_options_page() {
        add_options_page('تنظیمات افزونه Share it Wordpress', 'Share it Wordpress', 'manage_options', 'share-it-wordpress', 'sharei_wp_options_page');
      }
      add_action('admin_menu', 'sharei_wp_register_options_page');


      function sharei_wp_settings_token() {
        add_option( 'sharei_wp_option_token', '');
        register_setting( 'sharei_wp_options_group','sharei_wp_option_token', 'sharei_wp_callback' );
    }
    add_action( 'admin_init', 'sharei_wp_settings_token' );
    function sharei_wp_settings_username() {
        add_option( 'sharei_wp_option_username', '');
        register_setting( 'sharei_wp_options_group','sharei_wp_option_username', 'sharei_wp_callback' );
    }
    ?>
    <?php
        function sharei_wp_options_page()
    {
    ?>
      <div>
      <?php screen_icon(); ?>
      <h2>تنظیمات افزونه Share it Wordpress</h2>
      <form method="post" action="options.php">
      <?php settings_fields( 'sharei_wp_options_group' ); ?>
      <p>شما در اینجا میتونید تنظیمات توکن تلگرام و فلان و این چیزا را انجام دهید</p>
      <table>
      <tr valign="top">
      <th scope="row"><label for="sharei_wp_option_token">توکن</label></th>
      <td><input type="text" id="sharei_wp_option_token" name="sharei_wp_option_token" value="<?php echo get_option('sharei_wp_option_token'); ?>" /></td>
      </tr>
      <tr valign="top">
      <th scope="row"><label for="sharei_wp_option_username">یوزرنیم</label></th>
      <td><input type="text" id="sharei_wp_option_username" name="sharei_wp_option_username" value="<?php echo get_option('sharei_wp_option_username'); ?>" /></td>
      </tr>
      </table>
      <?php  submit_button(); ?>
      </form>
      </div>
    <?php
    } 
    $botToken = '707484338:AAG65u_DtSA4Liv6lGep6WlsOhCkX6tWdf8';
    $headers = ['Accept' => 'application/json'];

    function salam($post_ID){
      // print_r('hi');die();

      $title = get_the_title($post_ID);
      $content_post = get_post($post_ID);
      $content = $content_post->post_content;
      // $content = apply_filters('the_excerpt', $content);
      // $content = str_replace(']]>', ']]&gt;', $content);
      $href = get_permalink($post_ID);
      // return $href;
      $whatToSay='موضوع: '.$title.'
      لینک: '.$href.'
      ';
      $text = [
        'chat_id' => 74415978,
        'text' => $whatToSay,
        'parse_mode' => 'html',
      ];
      Unirest\Request::post('https://api.telegram.org/bot' . $GLOBALS['botToken'] . '/sendMessage', $GLOBALS['headers'], $text);
    }

    function sharei_wp_columns_head($defaults) {
      $defaults['first_column']  = 'Share it Wordpress';
      return $defaults;
    }
    function sharei_wp_columns_content($column_name, $post_ID) {
      if ($column_name == 'first_column') {
        echo '<button wpfc-clear-column="'.$post_ID.'" class="button wpfc-clear-column-action">
        <span>Clear</span>
    </button>';
      }
    }

    add_action('manage_posts_columns', 'sharei_wp_columns_head');
    add_action('manage_posts_custom_column', 'sharei_wp_columns_content', 10, 2);
    if( isset($_POST['id']) ){
      salam($_POST['id']);
    }
    ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>

    <script>
    jQuery(document).ready(function(){
            jQuery("button.button.wpfc-clear-column-action:visible").click(function(e){
              console.log('hi');
              $.ajax({
                type: 'post',
                              data: {id: jQuery(e.currentTarget).attr("wpfc-clear-column")},
          success: function(response){
          $('#response').text('name : ' + response);
          }
    });
    });
            });
      </script>