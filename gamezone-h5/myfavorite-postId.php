<?php
session_start(); 
require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-load.php' );
global $wpdb;
$user_id = $_POST['user_id'];
$username = isset($_POST['name']) ? $_POST['name'] : '';
$avatar = isset($_POST['avatar']) ? $_POST['avatar'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$login_type = isset($_POST['login_type']) ? $_POST['login_type'] : '';
$action = $_POST['action'];
$postid = isset($_POST['postid']) ? $_POST['postid'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$reg = "/^[a-zA-Z0-9_][a-zA-Z0-9_]{4,15}$/";
function forbidden($session_name,$interval) {
  if (isset($_SESSION[$session_name])) { 
    if (time() - $_SESSION[$session_name] < $interval) 
    { 
      exit(); 
    } 
    else { 
      $_SESSION[$session_name] = time(); 
    } 
  } 
  else { 
    $_SESSION[$session_name] = time(); 
  } 
}
$results = '';
switch ($action) {
  case 'check':
    if(is_numeric($user_id)) {
      $results = $wpdb->get_results($wpdb->prepare("SELECT `favorite` FROM `wp_myFavorite` WHERE `user_id`=%d",$user_id)); 
    }
    if($results) {
      foreach ($results as $result) {  
        echo $result->favorite;
      }
    }
    break;
  case 'del':
    if(is_numeric($user_id)) {
      $results = $wpdb->get_results($wpdb->prepare("SELECT `favorite` FROM `wp_myFavorite` WHERE `user_id`=%d",$user_id)); 
    }
    if($results) {
      foreach ($results as $result) {
          $arr = explode(",",$result->favorite);
          $key = array_search($postid, $arr);
          if ($key !== false){
            array_splice($arr, $key, 1);
          }
          $arr = implode(",", $arr);      
          $wpdb->query($wpdb->prepare("UPDATE `wp_myFavorite` SET `favorite`=%s WHERE `user_id`=%d",$arr,$user_id));
      }
    }
    break;
  case 'add':
    forbidden("session_add","1");
    if(is_numeric($user_id)) {
      $results = $wpdb->get_results($wpdb->prepare("SELECT `favorite` FROM `wp_myFavorite` WHERE `user_id`=%d",$user_id)); 
    }
    if($results) {
      foreach ($results as $result) {
          if($result->favorite){
            $arr = explode(",",$result->favorite);
            if(count($arr) > 100) {
              array_pop($arr);
            }
            $key = array_search($postid, $arr);
            if ($key !== false){
              array_splice($arr, $key, 1);
              echo "已收藏过";
            } else {      
              echo "收藏成功";
            }
          } else {
            $arr = array();
            echo "收藏成功";
          }
          array_unshift($arr,$postid);
          $arr = implode(",", $arr);      
          $wpdb->query($wpdb->prepare("UPDATE `wp_myFavorite` SET `favorite`=%s WHERE `user_id`=%d",$arr,$user_id));    
      }
    }
    break;
  case 'login':
    forbidden("session_login","1");
    if(!preg_match($reg,$username)){
      exit("unvalid username");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      exit("unvalid email");
    }
    if(is_numeric($user_id)) {
      $results = $wpdb->get_results($wpdb->prepare("SELECT `name`,`avatar` FROM `wp_myFavorite` WHERE `user_id`=%d",$user_id)); 
    }
    if(!$results) {
        if(!preg_match("/^\d{4}\-\d{1,2}\-\d{1,2}\s(\d{1}|1\d{1}|2[0-3]):(\d{1}|[0-5]\d{1}):(\d{1}|[0-5]\d{1})$/",$time)){
          exit("unvalid time");
        }
        if(strlen($nickname) > 16) {
          exit("unvalid nickname");
        }
        $wpdb->query($wpdb->prepare("INSERT INTO wp_myFavorite (name, avatar,first_login_time,last_login_time, nickname,user_id, email) VALUES (%s,%s,%s,%s, %s,%d,%s)",$username,$time,$time,$nickname,$user_id,$email));  
    } else {
      $wpdb->query($wpdb->prepare("UPDATE `wp_myFavorite` SET `avatar`=%s,`nickname`=%s WHERE `user_id`=%d",$avatar,$nickname,$user_id));
    }
    break;
  default:
    # code...
    break;
}
?>