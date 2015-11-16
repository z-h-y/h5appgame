<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-load.php' );
global $wpdb;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$postid = isset($_GET['postid']) ? $_GET['postid'] : '';
$results = '';
$posttype = '';
if(!is_numeric($user_id) || !is_numeric($postid)) {
  exit("wrong1");
}
$post = get_post($postid);
if(in_category(101,$post)) {
  $posttype = 1;
  $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM (SELECT user_id,score,@curRank:=@curRank+1 AS rank FROM `wp_post_score`,(SELECT @curRank:=0) AS t WHERE post_id=%d ORDER BY score DESC) AS p WHERE user_id=%d",$postid,$user_id));
} else if(in_category(100,$post)) {
  $posttype = 2;
  $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM (SELECT user_id,level,@curRank:=@curRank+1 AS rank FROM `wp_post_score`,(SELECT @curRank:=0) AS t WHERE post_id=%d ORDER BY level DESC) AS p WHERE user_id=%d",$postid,$user_id));
} else if(in_category(102,$post)) {
  $posttype = 3;   
  $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM (SELECT user_id,level,score,@curRank:=@curRank+1 AS rank FROM `wp_post_score`,(SELECT @curRank:=0) AS t WHERE post_id=%d ORDER BY level DESC,score DESC) AS p WHERE user_id=%d",$postid,$user_id));
}  
if($results) {
  foreach ($results as $result) {
    echo $result->rank;
  }
} else {
  exit("wrong2");
}
?>