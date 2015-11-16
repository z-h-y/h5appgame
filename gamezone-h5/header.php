<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="baidu-site-verification" content="QJRRNQGJyy" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); echo '?v='.filemtime( get_stylesheet_directory() . '/style.css'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" href="http://www.appgame.com/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.appgame.com/favicon.ico" type="image/x-icon" />
<?php 
if(is_single()) {
  global $post;
  $description = get_post_meta($post->ID, "_aioseop_description", true); 
  if(!$description) {
    $title = get_the_title($post->ID);
    if(!in_category(33)) {
      $description =  "任玩堂小游戏为您提供".$title."在线玩，无需下载".$title."游戏，".$title."游戏攻略秘籍，更多精彩的".$title."HTML5手机游戏尽在任玩H5小游戏,好玩记得告诉你的朋友哦!";
    } else {
      $description =  $title.",H5,小游戏,好玩,有趣,测一测,好玩记得告诉你的朋友哦!";
    }
    echo '<meta name="description" content="'.$description.'" />';
  }
}
?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>


<body <?php body_class(); ?>>
<header id="topHeader">
    <nav id="globarNav" class="cf">
      <ul class="gNavLink floatL">
        <li><a href="http://www.appgame.com" target="_blank">任玩堂</a></li>
        <li><a href="http://www.appgame.com/archives/category/hot-video" target="_blank">视频</a></li>
        <li><a href="http://app.appgame.com/" target="_blank">游戏库</a></li>
        <li><a href="http://jp.appgame.com" target="_blank">11区</a></li>
        <li class="select"><a href="http://h5.appgame.com/">小游戏</a></li>
        <li><a href="http://hd.appgame.com/" target="_blank">活动</a></li>
        <li><a href="http://shop.appgame.com" target="_blank">商城</a></li>
        <li><a href="http://gl.appgame.com/" target="_blank">攻略大全</a></li>
        <li><a href="http://bbs.appgame.com" target="_blank">论坛</a></li>
      </ul>
      <ul class="gNavIcon floatR">
        <li class="login"><a href="http://passport.appgame.com/sso?sso_action=login&return_url=http://h5.appgame.com" class="personalIcon">登录</a>|<a href="https://passport.appgame.com/user/create" target="_blank">注册</a></li>
      </ul>
    </nav>
</header>

<div id="h5-header">
  <div class="h5-header-top">
    <div class="h5-header cf"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="h5-logo"><img src="http://h5.appgame.com/wp-content/uploads/sites/83/2014/08/logo-h5.png"></a>
      <div class="h5-search">
        <form action="http://h5.appgame.com/" method="get" id="search-form">
        <input id="q1" type="text" name="s" value="" hidden="true" class="hide" />
        <input id="search_input_frame1" type="text" value="请输入搜索关键词" onClick="this.value=''" class="searchText" />
        <a onclick='document.getElementById("q1").value = document.getElementById("search_input_frame1").value;document.getElementById("search-form").submit()' class="searchSubmit"></a>
        </form>
      </div>
      <?php /*?><div class="h5-header-ad"><a href='http://ramoney.appgame.com/www/dlv/ck.asp?n=a17bee50&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://ramoney.appgame.com/www/dlv/avw.asp?zoneid=26&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a17bee50&amp;ct0=INSERT_ENCODED_CLICKURL_HERE' border='0' alt='' /></a></div><?php */?>
    </div>
  </div>
  <div class="h5-header-bottom">
    <div class="h5-header h5-header-nav">
      <ul class="cf">
        <li<?php if ( is_home()) { ?> class="active"<?php } ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页</a></li>
        <li<?php if ( is_page(5116) || (is_single() && in_category(33))) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/cece">测测</a></li>
        <li<?php if ( is_category('30')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/action/">动作</a></li>
        <li<?php if ( is_category('23')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/sports/">运动</a></li>
        <li<?php if ( is_category('31')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/shooting/">射击</a></li>
        <li<?php if ( is_category('13')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/puzzle/">益智</a></li>
        <li<?php if ( is_category('32')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/chess/">棋牌</a></li>
        <li<?php if ( is_category('19')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/role/">角色扮演</a></li>
        <li<?php if ( is_category('18')) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/category/arcade/">街机</b></a></li>
	<li<?php if ( is_page(890)) { ?> class="active"<?php } ?> id="game-col"><a href="http://h5.appgame.com/game-col">合集</a></li>
        <li <?php if ( is_page(5118)) { ?> class="active"<?php } ?>><a href="http://h5.appgame.com/myfavorite">收藏盒</a></li>
      </ul>
    </div>
  </div>
  <div class="mobile mb-h5-logo cf">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mb-h5-logo-icon"><img src="http://h5.appgame.com/wp-content/uploads/sites/83/2014/08/mb-h5-logo.png" class="autoimg"></a>
    <a href="http://passport.appgame.com/sso?sso_action=login&return_url=http://h5.appgame.com" class="mb-h5-login"><img src="http://avatar.static.appgame.com/uploads/avatar/rq/Mg/4tzi.png"></a>
  </div>
  <div class="mobile mb-h5-hb" id="fittext">
  	<ul class="cf">
      <?php if(is_single()){$category = get_the_category();$parent_catid=$category[0]->category_parent;if($parent_catid==2 || $parent_catid==8){$parent_catid=true;}} else {$parent_catid=false;} ?>
    	<li><a href="http://h5.appgame.com/"<?php if ( is_home() || is_category() || $parent_catid) { ?> class="active"<?php } ?>>H5小游戏</a></li>
      <li><a href="http://h5.appgame.com/cece" <?php if ( is_page(5116) || (is_single() && in_category(33))) { ?> class="active"<?php } ?>>测测</a></li>
      <li><a href="http://h5.appgame.com/myfavorite" <?php if ( is_page(5118)) { ?> class="active"<?php } ?>>收藏盒</a></li>
      <li><a href="javascript:;" class="kind-a no-border">搜索</a></li>
    </ul>
    <div class="kind-list">
      <div class="kind-list-search cf">
        <form action="http://h5.appgame.com/" method="get">
        <input id="q" type="text" name="s" value="" hidden="true" class="hide" />
        <input id="search_input_frame" type="text" value="请输入搜索关键词" onClick="this.value=''" class="kls-text" />
        <input type="submit" onclick='document.getElementById("q").value = document.getElementById("search_input_frame").value' value="" class="kls-submit"  />
        </form>
      </div>
    </div> 
  </div>
</div>


<?php if(!is_home()) { ?>
<div id="page" <?php if(is_category()){?>class="categoryPage"<?php } else if(is_single()) { ?>class="singlePage"<?php } ?>>
<div id="main" class="cf">
<?php } ?>