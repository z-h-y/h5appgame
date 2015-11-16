<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<?php if(!is_home()) { ?>
</div>
<!-- #main -->
</div>
<!-- #page -->
<?php } ?>


<div id="h5-footer">
  <div class="h5-footer cf"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo"><img src="http://h5.appgame.com/wp-content/uploads/sites/83/2014/08/logo-h5.png"></a>
    <div class="footer-link">
      <p class="footer-link-top"><a href="http://h5.appgame.com/">首页</a><a href="http://h5.appgame.com/category/arcade/">街机</a><a href="http://h5.appgame.com/category/action/">动作</a><a href="http://h5.appgame.com/category/sports/">运动</a><a href="http://h5.appgame.com/category/shooting/">射击</a><a href="http://h5.appgame.com/category/chess/">棋牌</a><a href="http://h5.appgame.com/category/puzzle/">益智</a><a href="http://h5.appgame.com/category/role/">角色扮演</a></p>
      <p class="footer-link-bottom">All Rights Reserved by AppGame © <a href="http://www.appgame.com" target="_blank">任玩堂</a> | <a href="http://www.appgame.com/archives/category/game-type/mmorpg" target="_blank">手机网游</a> | <a href="http://jp.appgame.com" target="_blank">日系手机游戏</a> | <a href="http://gl.appgame.com" target="_blank">手游攻略大全</a> | <a href="http://h5.appgame.com/statement">免责声明</a> | <a href="http://bbs.appgame.com" target="_blank">玩家论坛</a></p>
    </div>
  </div>
</div>
<script type="text/javascript">
function setCookie(cname,cvalue,exdays)
{
var d = new Date();
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();
document.cookie = cname + "=" + cvalue + "; path=/; " + expires;
}

function getCookie(cname)
{
var name = cname + "=";
var ca = document.cookie.split(';');
for(var i=0; i<ca.length; i++) 
  {
  var c = ca[i].trim();
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
}
return "";
}
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fittext.js"></script>
<script type="text/javascript">
//<![CDATA[
var user_id = '';
(function($) {
    var passportUrl = "http://passport.appgame.com";
    var siteId = "9";
    var ssoToken = "3987d3accc1967a3bff1a2e21ec76fbe";
    var link = $('.gNavIcon li.login');
    var mb_link = $('.mobile .mb-h5-login');
    if (passportUrl && passportUrl.length) {
        $.ajax({
            url: passportUrl+'/sso',
            type: 'get',
            dataType: "jsonp",
            data: {
                sso_action: "check",
                sso_token: ssoToken,
                site_id: siteId,
                format: "json"
            },
            success: function(res) {
                if (res && res.username) {
                    var msg = "<img src='"+res.avatar+"' alt='头像'/>"+res.username;
                    //var msg = res.username;
                    link.replaceWith('<li  class="logout">' + msg + '<div><a href="http://h5.appgame.com/myfavorite">收藏盒</a><a href="http://passport.appgame.com/sso?sso_action=logout&return_url='+ location.href +'">退出</a></div></li>');
                    mb_link.replaceWith('<div class="mb-h5-logout">'+msg+'<div><a href="http://h5.appgame.com/myfavorite">收藏盒</a><a href="http://passport.appgame.com/sso?sso_action=logout&return_url='+ location.href +'">退出</a></div></div>');
                    user_id = res.user_id;
                    <?php if(is_page(5118)) { ?>
                    getFavorite(res.user_id);  
                    <?php } ?>
                    <?php if(is_single() && in_category(array(100,101,102))) { ?>
                    getMyRanking(res.user_id);  
                    <?php } ?>
                    var d = new Date();
                    var now = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
                    setLogin(res,now); 
                } else {
                    link.replaceWith('<li class="login"><a href="http://passport.appgame.com/sso?sso_action=login&return_url='+ location.href +'" class="personalIcon">登录</a>|<a href="https://passport.appgame.com/user/create" target="_blank">注册</a></li>');
                    mb_link.replaceWith('<a href="http://passport.appgame.com/sso?sso_action=login&return_url='+ location.href +'" class="mb-h5-login"><img src="http://avatar.static.appgame.com/uploads/avatar/rq/Mg/4tzi.png"></a>');
                    <?php if(is_page(5118)) { ?>
                      checkck('myfavorite','delmf');
                    <?php } ?>
                }
            }
        });
    }
    function setLogin(res,time) {
      if(!res.nickname) {res.nickname='';}
      $.ajax({
        url:"<?php echo get_template_directory_uri(); ?>/myfavorite-postId.php",
        type: 'POST',
        data: 'action=login&name='+res.username+'&avatar='+res.avatar+'&user_id='+res.user_id+'&email='+res.email+'&time='+time+'&nickname='+res.nickname,
        success:function(data){
          console.log(data);
        }   
      });     
    }
    <?php if(is_single() && in_category(array(100,101,102))) { ?>
        function getMyRanking(user_id) {
          $.ajax({
            url:"<?php echo get_template_directory_uri(); ?>/getMyRanking.php",
            type: 'GET',
            data: 'user_id='+user_id+'&postid='+"<?php echo $post->ID; ?>",
            success:function(data){
                if(!isNaN(data)) {
                  $('.ranking-list').before('<p class="myranking">我的排名：第<em>'+data+'</em>名</p>');
                }               
            }   
          }); 
        }
    <?php } ?>
})(jQuery);
//]]>
$(document).on('mouseover mouseout','.logout',function(event){
    var logout_list = $('.logout div');
    if(event.type == "mouseover"){
      logout_list.show();
    }else if(event.type == "mouseout"){
      logout_list.hide();
    }
});
$(document).on('click','.mb-h5-logout',function(e){
    var menu = $('.mb-h5-logout div');
    menu.toggle();
    $(document).one("click", function(){
            menu.hide();
        });
    e.stopPropagation();
});
$(document).on('click','.mb-h5-logout div',function(e){
    e.stopPropagation();
});
<?php if(is_home() || is_category() || is_page(5116)) { ?>
function getHtml(json,type) {
  var json = $.parseJSON(json);
  var html = '';
  var len = 0;
  if(json.more) {
    len = json.title.length;      
    for(var i = 0; i < len; i++) {
      html += '<div class="h5-game"><a href=';
      html += json.link[i];
      html += ' class="h5-game-content cf"><img class="h5-game-icon" src="';
      if(json.thumbnail[i] != '') {
        html += json.thumbnail[i];
      }
      html += '" alt="';
      html += json.title[i];
      html += '" /><div class="h5-game-body"><h3 class="h5-game-name">';
      html += json.title[i];
      html += '</h3><span class="h5-game-kind">分类：';
      html += json.type[i];
      html += '</span><p class="h5-game-detail"><span>';
      html += json.views[i];
      html += '</span> 人玩过</p></div></a>';
      if(type == 0) {
        html += '<a href="';
        html += json.play_link[i];
        html += '" class="h5-game-link" postid=';
        html += json.id[i];
        html += ' target="_blank">开始玩</a>';
      }
      html += '</div>';
    }
  }
  return html; 
}
<?php } ?>
</script>
<?php if(is_home()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.js"></script>
    <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        directionNav: false,
        slideshowSpeed: 3000,
        pauseOnHover: true
      });
    });
  </script>
  <script type="text/javascript">
  $('.refresh').hover(function(){
    $(this).addClass("red-color");
    $('.ico-refresh').addClass('ico-refresh-active');
  },function(){
    $(this).removeClass("red-color");
    $('.ico-refresh').removeClass('ico-refresh-active');
  });
  $(".refresh").on('touchstart',function(){
    $(".refresh").unbind("hover");
    $(this).removeClass("red-color");
    $('.ico-refresh').removeClass('ico-refresh-active');
  });
  var h5BlockNav = $('.h5-block-nav li');
  h5BlockNav.click(function() {
    h5BlockNav.removeClass('active');
    $(this).addClass('active');
    var index = $(this).index();
    $('.h5-block-nav').siblings('.h5-body').addClass('hide').eq(index).toggleClass('hide');
  });
  var r_offset = 0;
  $('.disclick').click(function() {
    $('.h5-game-recommend').css({ visibility: "hidden" });
    $('.ico-loading-64').show();
    $(this).removeClass('disclick');
    $.ajax({
      type:"POST",
      url: location.href,
      data: "action=refresh_action&offset="+r_offset,
      success: function(html){$('.ico-loading-64').hide();$('.recommend-list').html(html);$('.refresh').addClass('disclick');},
      error:function(){$('.ico-loading-64').hide();$('.h5-game-recommend').css({ visibility: "visible" });$('.refresh').addClass('disclick');}
    });
  });
  var load_hot = false;
  $('.hot_li').one('click',function(){
    $('.loadimg').show();
      $.ajax({
        type: "POST",
        url: location.href,
        data: "action=hot_action&offset=0",
        success: function(html){
          $('.h5-body-second').append(html);
          load_hot = true;
          $('.loadimg').hide();
        },
        error:function(){
          load_hot = true;
          $('.loadimg').hide();
        }
      });
  });
  $(document).ready(function(){
    var maxCount1 = 10;
    var maxCount2 = 10;
    var load1 = false;
    var load2 = false;
    $(window).scroll(function() {
      if($('.h5-body-first').is(':visible')) {
       var offset = $('.h5-body-first .h5-game').length;
       if ($(document).scrollTop() >= $(document).height() - $(window).height()-60 && maxCount1 > 0 && !load1) {
        load1 = true;
        $('.loadimg').show();
        maxCount1 --;
        tempCount1 = offset;
        var st = $(document).scrollTop();
          $.ajax({
            type: "POST",
            url: location.href,
            data: "action=new_action&category=8&offset="+offset,
            success: function(json){
              var html = getHtml(json,0);
              $('.h5-body-first .h5-game').last().after(html);
              $(document).scrollTop(st);
              $('.loadimg').hide();
              load1 = false;
            },
            error:function(){
              $('.loadimg').hide();
              maxCount1 ++;
              load1 = false;
            }
          });
        }
      } else if($('.h5-body-second').is(':visible') && load_hot) {
         var offset = $('.h5-body-second .h5-game').length;
         if ($(document).scrollTop() >= $(document).height() - $(window).height()-60 && maxCount2 > 0 && !load2) {
          var st = $(document).scrollTop();
          load2 = true;
          maxCount2 --;
          $('.loadimg').show();
            $.ajax({
              type: "POST",
              url: location.href,
              data: "action=hot_action&offset="+offset,
              success: function(html){
                $('.h5-body-second .h5-game').last().after(html);
                $(document).scrollTop(st);
                $('.loadimg').hide();
                load2 = false;
              },
              error:function(){
                $('.loadimg').hide();
                load2 = false;
                maxCount2 ++;
              }
            });
          }        
      }
    });
  });
  </script>
<?php } else if(is_single()) {?>
<?php if(in_category(33)){?>
 <script src=<?php echo get_template_directory_uri()."/js/question_json.js?v=".filemtime( get_stylesheet_directory()."/js/question_json.js");?>></script>
<?php }?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.qrcode.min.js"></script>
<script type="text/javascript" src="http://h5.static.myappgame.com/common/WeixinApi.js"></script>
<script>
var imgurl = "<?php if ( has_post_thumbnail(get_the_ID())) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail');echo $large_image_url[0];}?>";
window._bd_share_config={
"share":{
"bdText": "",
"bdMini":"2",
"bdMiniList":false,
"bdPic":imgurl,
"bdStyle":"0",
"bdSize":"24",
}
};
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
$(document).ready(function(){
    window.shareTimeline=function(){
      var title = document.title;
      var url = location.href;
      if(/(iPad|iPhone|iPod)/i.test(ua)){
          ucbrowser.web_share(title, imgurl, url, 'kWeixinFriend', '', '', '');
      }else{
          ucweb.startRequest("shell.page_share", [title, imgurl, url, 'WechatTimeline', '', '', '']);
      };
  }
  var ua = navigator.userAgent.toLowerCase();
  if(ua.match(/MicroMessenger/i)=="micromessenger") {
    $('.bds_weixin').removeAttr('data-cmd').attr('onclick',"alert(\'请点击当前屏幕右上角按钮进行分享。\')");
    $('.myshare a').removeAttr('data-cmd').attr({onclick :"alert(\'请点击当前屏幕右上角按钮进行分享。\')", style:"background:url(http://h5.appgame.com/wp-content/themes/gamezone-h5/images/share_py.gif) no-repeat"});
  }
  //只有UC浏览器支持调用分享到朋友圈
  if(/UCBrowser/i.test(ua)){
      $('.bds_weixin').removeAttr('data-cmd').attr('onclick',"shareTimeline();");
  } 
});
$(window).load(function(){
  var iframe = $("iframe#commentics-iframe");
  if(iframe.height() < 300) {
    iframe.height(410);
  }
})
var wxData = {
  appId:'' ,//appid，可不用这项
  imgUrl:imgurl, // 缩略图地址
  link: location.href,// 链接地址
  title: '<?php the_title(); ?>',// 标题
  desc: '' // 详细描述
  }
WeixinApi.ready(function (Api) {
  // 分享的回调
  var wxCallbacks = {
    ready : function() {
      },
    cancel : function(resp) {
      },
    fail : function(resp) {
      },
    confirm : function(resp) {
      },
    all : function(resp) {
      }
    };
  Api.generalShare(wxData, wxCallbacks);
  Api.shareToFriend(wxData, wxCallbacks); 
  Api.shareToTimeline(wxData, wxCallbacks); 
  Api.shareToWeibo(wxData, wxCallbacks);
});
</script>
<script type="text/javascript">
function myfavorite(id){
  var id = id.toString();
  if($('.gNavIcon .logout').length != 0) {
    $.ajax({
      url:"<?php echo get_template_directory_uri(); ?>/myfavorite-postId.php",
      type: 'POST',
      data: 'action=add&user_id='+user_id+'&postid='+id,
      success:function(data){
        alert(data);   
      }
    });
  } else {
    var mf=getCookie("myfavorite");
    if(mf!='') {
      var arr = mf.split(",");
      if(arr.length>100) {
        arr.pop();
      }
      if($.inArray(id,arr) != -1) {
        alert("已收藏过");
        arr.splice(arr.indexOf(id),1);
      } else {
        alert("收藏成功");
      } 
      arr.unshift(id);
      setCookie("myfavorite",arr.join(','),30);
    } else {
        setCookie("myfavorite",id,30);
        alert("收藏成功");
    }
  }
}
$('.appgame-comments').on('click',function(){
  var comments = $("#commentics-container");
  if(comments.length != 0) {
    $("html,body").animate({scrollTop:comments.offset().top},500);
  }  
});
$("#code").qrcode({ 
    render: "canvas", //table方式 
    width: 110, //宽度 
    height:110, //高度 
    text: location.href //任意内容 
});
</script>
    <script>
    var img='';
    for(var i=0;i<$('.getImg img').length;i++){
    img +='<img src="'+$('.getImg img')[i].src+'" />';
    }
    $('.sshot').append(img).attr('',function(){

$('.sshot img').load(function(e) {
    var imgNum=$('.sshot img').index();
    var imgForm=0;
    for(var i=0;i<=imgNum;i++){
      imgForm+=$('.sshot').find('img').eq(i).width();
      }
    imgForm+=(imgNum+1)*3;
    $('.sshot').css('width',imgForm);
  });

});

$('.mbkind').text($('.content-top-right h2').html());
$('.content-top-right a').parent('p').addClass('p-fixed');
    </script>
<?php } else if(is_category()){?>
<script type="text/javascript">
$(document).ready(function(){
  var load = false;
  $(window).scroll(function() {
    var offset = $('.h5-body .h5-game').length;
     if ($(document).scrollTop() >= $(document).height() - $(window).height()-60 && !load) {
      var st = $(document).scrollTop();
      $('.loadimg').show();
      load = true;
        $.ajax({
          type: "POST",
          url: location.href,
          data: "action=new_action&category=<?php echo get_cat_ID(single_cat_title('', false));?>&offset="+offset,
          success: function(json){
            var html = getHtml(json,0);
            $('.h5-body .h5-game').last().after(html);
            $(document).scrollTop(st);
            load = false;
            $('.loadimg').hide();
            if(html == ''){
              load = true;
              $('.h5-block').append('<h3 class="txt_cen">已加载完所有游戏</h3>')
            }
          },
          error:function(){
            load = false;
            $('.loadimg').hide();
          }
        });
      }
  });
});
</script>
<?php } else if(is_page()){ ?>
<?php if ( is_page(890)) { ?>
<script>(function($){$.fn.appgamePages=function(options){var opts=$.extend({},$.fn.appgamePages.defaults,options);return this.each(function(){var $this=$(this);var $PagesClass=opts.PagesClass;var $AllMth=$this.find($PagesClass).length;var $Mth=opts.PagesMth;var $NavMth=opts.PagesNavMth;var $PagesNum=opts.PagesNum;var $PagesTotal=opts.PagesTotal;var PagesNavHtml="<div class=\"Pagination\"><a href=\"javascript:;\" class=\"homePage\">首页</a><a href=\"javascript:;\" class=\"PagePrev\">上一页</a><span class=\"Ellipsis\"><b>...</b></span><span class=\"pagesnum\"></span><span class=\"Ellipsis\"><b>...</b></span><a href=\"javascript:;\" class=\"PageNext\">下一页</a><a href=\"javascript:;\" class=\"lastPage\">尾页</a></div>";if($AllMth>$Mth){var relMth=$Mth-1;$this.find($PagesClass).filter(":gt("+relMth+")").hide();var PagesMth=Math.ceil($AllMth/$Mth);var PagesMthTxt;if($PagesTotal){PagesMthTxt="<span>共<b>"+$AllMth+"</b>条，共<b>"+PagesMth+"</b>页</span>"}else{PagesMthTxt=""}$this.append(PagesNavHtml).find(".Pagination").append(PagesMthTxt);var PagesNavNum="";for(var i=1;i<=PagesMth;i++){PagesNavNum=PagesNavNum+"<a href=\"javascript:;\">"+i+"</a>"};if($PagesNum){$('.Ellipsis,.pagesnum').css('display','inline')}else{$('.Ellipsis,.pagesnum').css('display','none')}$this.find(".pagesnum").append(PagesNavNum).find("a:first").addClass("PageCur");if($NavMth<PagesMth){$this.find("span.Ellipsis:last").show();var relNavMth=$NavMth-1;$this.find(".pagesnum a").filter(":gt("+relNavMth+")").hide()}else{$this.find("span.Ellipsis:last").hide()};var $input=$this.find(".Pagination #PageNum");var $submit=$this.find(".Pagination .PageNumOK");$input.keyup(function(){var pattern_d=/^\d+$/;if(!pattern_d.exec($input.val())){alert("请填写正确的数字！");$input.focus().val("");return false}});$submit.click(function(){if($input.val()==""){alert("请填写您要跳转到第几页！");$input.focus().val("");return false}if($input.val()>PagesMth){alert("您跳转的页面不存在！");$input.focus().val("");return false}else{showPages($input.val())}});var $PagesNav=$this.find(".pagesnum a");var $PagesFrist=$this.find(".homePage");var $PagesLast=$this.find(".lastPage");var $PagesPrev=$this.find(".PagePrev");var $PagesNext=$this.find(".PageNext");$PagesNav.click(function(){var NavTxt=$(this).text();showPages(NavTxt);$('html,body').animate({scrollTop:$(opts.PagesClass).parent().offset().top},500)});$PagesFrist.click(function(){showPages(1);$('html,body').animate({scrollTop:$(opts.PagesClass).parent().offset().top},500)});$PagesLast.click(function(){showPages(PagesMth);$('html,body').animate({scrollTop:$(opts.PagesClass).parent().offset().top},500)});$PagesPrev.click(function(){var OldNav=$this.find(".pagesnum a[class=PageCur]");if(OldNav.text()==1){alert("已经是首页啦！")}else{var NavTxt=parseInt(OldNav.text())-1;showPages(NavTxt);$('html,body').animate({scrollTop:$(opts.PagesClass).parent().offset().top},500)}});$PagesNext.click(function(){var OldNav=$this.find(".pagesnum a[class=PageCur]");if(OldNav.text()==PagesMth){alert("已经是最后一页啦！")}else{var NavTxt=parseInt(OldNav.text())+1;showPages(NavTxt);$('html,body').animate({scrollTop:$(opts.PagesClass).parent().offset().top},500)}});function showPages(page){$PagesNav.each(function(){var NavText=$(this).text();if(NavText==page){$(this).addClass("PageCur").siblings().removeClass("PageCur")}});var AllMth=PagesMth/$NavMth;for(var i=1;i<=AllMth;i++){if(page>(i*$NavMth)){$PagesNav.filter(":gt("+(i*$NavMth-1)+")").show();$PagesNav.filter(":gt("+(i*$NavMth-1+$NavMth)+")").hide();$PagesNav.filter(":lt("+(i*$NavMth)+")").hide();$this.find("span.Ellipsis:first").show()};if(page<=$NavMth){$PagesNav.filter(":gt("+($NavMth-1)+")").hide();$PagesNav.filter(":lt("+$NavMth+")").show();$this.find("span.Ellipsis:first").hide()}};var LeftPage=$Mth*(page-1);var NowPage=$Mth*page;$this.find($PagesClass).hide();$this.find($PagesClass).filter(":lt("+(NowPage)+")").show();$this.find($PagesClass).filter(":lt("+(LeftPage)+")").hide()}}})};$.fn.appgamePages.defaults={PagesClass:'.item',PagesMth:10,PagesNavMth:4,PagesNum:true,PagesTotal:true};$.fn.appgamePages.setDefaults=function(settings){$.extend($.fn.appgamePages.defaults,settings)}})(jQuery);</script>
<script>
$(function(){
  $('#h5-col').appgamePages({
    PagesClass:'.h5-col', //需要分页的元素
    PagesMth:12, //每页显示个数   
    PagesNavMth:3, //显示导航个数
    PagesTotal:false,
    PagesNum:true
    });
  });
</script>
<?php } else if ( is_page(5116)) { ?>
<script type="text/javascript">
$(document).ready(function(){
  var load = false;
  $(window).scroll(function() {
    var offset = $('.h5-body .h5-game').length;
     if ($(document).scrollTop() >= $(document).height() - $(window).height()-60 && !load) {
      var st = $(document).scrollTop();
      $('.loadimg').show();
      load = true;
        $.ajax({
          type: "POST",
          url: location.href,
          data: "action=new_action&category=33&offset="+offset,
          success: function(json){
            var html = getHtml(json,1);
            $('.h5-body .h5-game').last().after(html);
            $(document).scrollTop(st);
            load = false;
            $('.loadimg').hide();
            if(html == ''){
              load = true;
              $('.h5-block').append('<h3 class="txt_cen">已加载完所有游戏</h3>')
            }
          },
          error:function(){
            load = false;
            $('.loadimg').hide();
          }
        });
      }
  });
});
</script>
<?php } else if ( is_page(5118)) { ?>
<script type="text/javascript">
  $('.h5-block-nav li').click(function() {
    $('.h5-block-nav li').removeClass('active');
    $(this).addClass('active');
    var index = $(this).index();
    $('.h5-block-nav').siblings('.h5-body').addClass('hide').eq(index).toggleClass('hide');
  });
  function getFavorite(name,login_type) {
    $.ajax({
      url:"<?php echo get_template_directory_uri(); ?>/myfavorite-postId.php",
      type: 'POST',
      data: 'action=check&user_id='+user_id,
      success:function(data){
        if(data) {
          var arr = data.split(',');
          cookies['myfavorite'] = [];
          for(var i = 0; i<arr.length; i+=15) {
            cookies['myfavorite'].push(arr.slice(i,i+15).join(','));
            getData('myfavorite',cookies['myfavorite'][0],'delmf');
          }
        } else {
          $('.myfavorite').find('.norecord').show();
        }   
      }
    });
  }
  var cookies = {};
  function checkck(name,delname){
    cookies[name] = [];
    if(!getCookie(name)) {
      $('.'+name).find('.norecord').show();
    } else {
      var arr = getCookie(name).split(',');
    
      for(var i = 0; i<arr.length; i+=15) {
        cookies[name].push(arr.slice(i,i+15).join(','));
      }
      getData(name,cookies[name][0],delname);
    }
  }
  function getData(name,dataId,delname){
    $('.loadimg').show();
      $.ajax({
        type: "POST",
        url: location.href,
        data: "action=myfavorite_action&offset="+dataId+'&category='+delname,
        success: function(html){
          $('.'+name+' .norecord').before(html);
          $('.loadimg').hide();
        },
        error:function(){
          $('.loadimg').hide();
        }
      });
  }
  var mh = 1;
  var mf = 1;
  $(window).scroll(function() {
    if ($(document).scrollTop() >= $(document).height() - $(window).height()-60) {
      if($('.myfavorite').is(':visible') && cookies['myfavorite'][mf]) {
          getData('myfavorite',cookies['myfavorite'][mf],'delmf');
          mf++;      
      }
      if($('.myhistory').is(':visible') && cookies['myhistory'][mh]) {
          getData('myhistory',cookies['myhistory'][mh],'delmh');
          mh++;      
      }      
    }
  });
  //checkck('myfavorite','delmf');
  checkck('myhistory','delmh');
  $(document).on('click','.delck',function(){
    var id = $(this).attr('postid');
    var mycookie = '';
    if($(this).hasClass('delmf')) {
      mycookie = 'myfavorite';
      if($('.'+mycookie+' .h5-game').length < 16 && cookies['myfavorite'][mf]){
        getData('myfavorite',cookies['myfavorite'][mf],'delmf');
        mf++; 
      }
    } else if($(this).hasClass('delmh')) {
      mycookie = 'myhistory';
      if($('.'+mycookie+' .h5-game').length < 16 && cookies['myhistory'][mh]){
        getData('myhistory',cookies['myhistory'][mh],'delmh');
        mh++; 
      }
    } 
    if($('.gNavIcon .logout').length != 0) {
      var that = $(this); 
      $.ajax({
        url:"<?php echo get_template_directory_uri(); ?>/myfavorite-postId.php",
        type: 'POST',
        data: 'action=del&user_id='+user_id+'&postid='+id,
        success:function(data){
          that.parent().fadeOut(500);
        }   
      });
      return;
    }  
    var allId = getCookie(mycookie).split(",");
    var index = allId.indexOf(id);
    if(index > -1){allId.splice(index, 1);}
    allId = allId.join(',');
    setCookie(mycookie,allId,7);
    $(this).parent().fadeOut(500);
    if(!getCookie(mycookie)) {
      $('.'+mycookie).find('.norecord').show();
    }
  });
</script>
<?php }} ?>
<a href="javascript:$('html,body').animate({scrollTop:0},500);" class="gotoTop mobile"></a>

<script type="text/javascript">
	$(document).ready(function(){ 
	  $(document).on('click','.h5-game-link, .content-top .p-fixed a',function(){
       if($(this).attr('postid')){
        var id = $(this).attr('postid').toString();         
       } else {
         var id = $('.content-top').attr('postid').toString();
       }        
        var mf=getCookie("myhistory");
        if(mf!='') {
          var arr = mf.split(",");
          if(arr.length>100) {
            arr.pop();
          }
          if($.inArray(id,arr) != -1) {
            arr.splice(arr.indexOf(id),1);
          } 
          arr.unshift(id);
          setCookie("myhistory",arr.join(','),7);
        } else {
            setCookie("myhistory",id,7);
        }
      });
    });
</script>
<div class="hide">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F3bb4de6086a0ea218cc71f62c9c502c2' type='text/javascript'%3E%3C/script%3E"));
</script>
<script src="http://img01.static.appgame.com/libs/jsCommon/analytics/appgame-analytics.js"></script>
</div>
<?php wp_footer(); ?>
</body></html>