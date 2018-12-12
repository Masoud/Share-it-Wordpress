<?php
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