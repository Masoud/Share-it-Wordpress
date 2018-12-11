<?php
print_r('hi');die();
$botToken = '707484338:AAG65u_DtSA4Liv6lGep6WlsOhCkX6tWdf8';
$headers = ['Accept' => 'application/json'];

function salam($post_ID){
  $title = get_the_title($post_ID);
  $content_post = get_post($post_ID);
  $content = $content_post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $href = get_permalink($post_ID);
  // return $href;
  $text = [
    'chat_id' => 74415978,
    'text' => $post_ID,
    'parse_mode' => 'html',
  ];
  Unirest\Request::post('https://api.telegram.org/bot' . $GLOBALS['botToken'] . '/sendMessage', $GLOBALS['headers'], $text);
}
salam($_POST['id']);