<?php
header("Access-Control-Allow-Origin:http://h5.static.myappgame.com");
require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-load.php' );
global $wpdb;
$user_id = $_POST['user_id'];
$level = isset($_POST['level']) ? $_POST['level'] : 0;
$postid = isset($_POST['postid']) ? $_POST['postid'] : '';
$score = isset($_POST['score']) ? $_POST['score'] : '';
$sign = isset($_POST['sign']) ? $_POST['sign'] : '';
$post_title = $_SERVER['HTTP_REFERER'];
$results = '';
$posttype = '';
$checksign = md5($user_id.'&'.$postid.'&'.$level.'&'.$score);
if(!$postid) {
  $start = 'http://h5.static.myappgame.com/';
  $end = substr($post_title, strlen($start)+strpos($post_title, $start));
  $substr = substr($end, 0,(strlen($end) - strpos($end, '/'))*(-1));
  $substr = "http://h5.appgame.com/".$substr;
  $posts = get_posts("category=2,8&numberposts=30000");
  foreach ($posts as $post) {
    if(strtolower(get_the_permalink()) == strtolower($substr)) {
      $postid = get_the_ID();
      if(in_category(101)) {
        $posttype = 1;
      } else if(in_category(100)) {
        $posttype = 2;
      } else if(in_category(102)) {
        $posttype = 3;   
      }
      break;
    }
  }
}

if(!$postid || !is_numeric($user_id) || !$posttype || $sign != $checksign) {
  exit(json_encode(array('error'=>'wrong data')));
}
$results = $wpdb->get_results($wpdb->prepare("SELECT `user_id` FROM `wp_myFavorite` WHERE `user_id`=%d",$user_id)); 
if(!$results) {
  exit(json_encode(array('error'=>'no_user')));
}
$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_post_score` WHERE `user_id`=%d AND `post_id`=%d",$user_id,$postid)); 
if($results) {
  foreach ($results as $result) {
    if(($result->level == $level && $result->score < $score) || $result->level < $level) {
      $wpdb->query($wpdb->prepare("UPDATE `wp_post_score` SET `post_id`=%d,`level`=%d,`score`=%d WHERE `user_id`=%d",$postid,$level,$score,$user_id));
      echo json_encode(array('id'=>$user_id,'postid'=>$postid,'level'=>$level,'score'=>$score));
    } else {
      echo json_encode(array('id'=>$user_id,'postid'=>$postid,'level'=>$result->$level,'score'=>$result->$score));
    }
  }
} else {
  $wpdb->query($wpdb->prepare("INSERT INTO wp_post_score (user_id, post_id,type,level,score) VALUES (%d,%d,%d,%d,%d)",$user_id,$postid,$posttype,$level,$score));
  echo json_encode(array('id'=>$user_id,'postid'=>$postid,'level'=>$level,'score'=>$score));
}
?>