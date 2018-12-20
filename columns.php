<?php

// Header title of plugin for column
function sharei_wp_columns_head($defaults) {
    $defaults['first_column']  = 'Share it Wordpress';
    return $defaults;
}

// Body text of plugin for column
function sharei_wp_columns_content($column_name, $post_ID) {
  if ($column_name == 'first_column') {
    echo '<button sharei-wp-column="'.$post_ID.'" class="button sharei-wp-column-action"><span>Telegram</span></button>';
  }
}
add_action('manage_posts_columns', 'sharei_wp_columns_head');
add_action('manage_posts_custom_column', 'sharei_wp_columns_content', 10, 2);

// If post request sent, Call Telegram Function
if( isset($_POST['id']) ){
  SendPost($_POST['id']);
}
?>

<!-- Call Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script>
  jQuery(document).ready(function(){
    jQuery("button.button.sharei-wp-column-action:visible").click(function(e){
      $.ajax({
        type: 'post',
          data: {id: jQuery(e.currentTarget).attr("sharei-wp-column")},
          success: function(response){
            $('#response').text('name : ' + response);
          }
      });
    });
  });
</script>