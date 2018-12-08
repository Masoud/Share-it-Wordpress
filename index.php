<?php

/*

Plugin Name:  Share it Wordpress
Description:  این افزونه به شما کمک می‌کند تا هر پست خود را به انتخاب در تلگرام ارسال کنید
Version:      0.1
Author:       Masoud Nikoomanesh
Author URI:   https://hipdesign.ir

*/

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
} ?>