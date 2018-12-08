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

function sharei_wp_register_settings() {
    add_option( 'sharei_wp_option_name', '');
    register_setting( 'sharei_wp_options_group', 'sharei_wp_option_name', 'sharei_wp_callback' );
 }
 add_action( 'admin_init', 'sharei_wp_register_settings' );
 function sharei_wp_register_options_page() {
    add_options_page('تنظیمات افزونه Share it Wordpress', 'Share it Wordpress', 'manage_options', 'share-it-wordpress', 'sharei_wp_options_page');
  }
  add_action('admin_menu', 'sharei_wp_register_options_page');
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
  <th scope="row"><label for="sharei_wp_option_name">توکن</label></th>
  <td><input type="text" id="sharei_wp_option_name" name="sharei_wp_option_name" value="<?php echo get_option('sharei_wp_option_name'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>