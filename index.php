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
} 
// function add_sticky_column($columns) {
//   return array_merge( $columns, 
//             array('sticky' => __('Salam')) );
// }
// add_filter('manage_posts_columns' , 'add_sticky_column');
// add_filter('manage_posts_columns', 'my_columns');
// function my_columns($columns) {
//     $columns['views'] = 'Views';
//     return $columns;
// }
function ST4_columns_head($defaults) {
  $defaults['first_column']  = 'Share it Wordpress';
  return $defaults;
}

function salam($post_ID){
  return 'hi'.$post_ID.'joon';
}

function ST4_columns_content($column_name, $post_ID) {
  if ($column_name == 'first_column') {
      // echo 'The post ID is: ' . $post_ID;
      echo '<a href="'.salam($post_ID).'">click here</a>';
  }
}

add_filter('manage_posts_columns', 'ST4_columns_head');
add_filter('manage_posts_custom_column', 'ST4_columns_content', 10, 2);