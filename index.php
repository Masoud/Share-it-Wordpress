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

    function sharei_wp_register_options_page() {
        add_options_page('تنظیمات افزونه Share it Wordpress', 'Share it Wordpress', 'manage_options', 'share-it-wordpress', 'sharei_wp_options_page');
      }
      add_action('admin_menu', 'sharei_wp_register_options_page');
      include( plugin_dir_path( __FILE__ ) . 'options.php');
    $botToken = '707484338:AAG65u_DtSA4Liv6lGep6WlsOhCkX6tWdf8';
    $headers = ['Accept' => 'application/json'];
    function salam($post_ID){
      $title = get_the_title($post_ID);
      $content_post = get_post($post_ID);
      $content = $content_post->post_content;
      $content = apply_filters('the_content', $content);
      $text1 = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
      $text1=str_replace('<p>','',$text1);
      $text1=str_replace('</p>','',$text1);
      $href = get_permalink($post_ID);
      $whatToSay='موضوع: '.$title.'
      متن: '.$text1.'
      لینک: '.$href.'
      ';
      $text = [
        'chat_id' => 74415978,
        'text' => $whatToSay,
        'parse_mode' => 'html',
      ];
      Unirest\Request::post('https://api.telegram.org/bot' . $GLOBALS['botToken'] . '/sendMessage', $GLOBALS['headers'], $text);
    }
    include( plugin_dir_path( __FILE__ ) . 'columns.php');