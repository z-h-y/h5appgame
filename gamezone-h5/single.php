<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

  <div class="content">
  
  	<div class="body">
    
    <?php while ( have_posts() ) : the_post(); ?>
    
    <div class="content-top cf" postid="<?php the_ID();?>">
      <?php if(!in_category(33)) {?>
    	<div class="content-top-left">
	<h1 class="mobile mbname"><?php the_title(); ?></h1>
	<h2 class="mobile mbkind"></h2>
  <a href="javascript:void(0);" class="mobile appgame-comments">评论</a>
      	<div id="screenshot">
         <div class="sshot"></div>
        </div>
      </div>
      <div class="content-top-right getImg">
      	<h1 class="web"><?php the_title(); ?><a href="javascript:void(0);" class="appgame-comments">评论</a></h1>
      	<?php the_content(); ?>
      </div>     
    </div>
    <div id="code"></div>
      <?php } else {?>
      <?php $json = json_decode(get_the_content());?>
      <div id="content-top-common" class="content-top-common cf"> 
        <a href="javascript:void(0);" class="appgame-comments">评论</a>
        <?php
	if($json->img) {echo '<img src='.$json->img.' />';} 
        else {
	if ( has_post_thumbnail(get_the_ID())) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail');echo '<img src='.$large_image_url[0].' />';}}?>
        <?php echo '<p class="content-top-common-title">'.$json->title.'</p><span>'.$json->intro.'</span>';?>
      </div>
      <div class="content-top-question" id="content-top-question">     
      <?php
      switch($json->type) {
        case '1' :
        if($json->question) {
          echo '<div class="type_1"><label>请输入名字</label><input type="text" class="skin-text-willwhite" name="my_nick" id="my_nick" ></div><div class="type_1"><label>'.$json->question.'</label><input type="text" id="my_value" class="skin-text-willwhite s_value"></div>';
        } else {
          echo '<div class="type_1"><label>请输入名字</label><input type="text" class="skin-text-willwhite s_value" name="my_nick" id="my_nick"></div>';
        }
        echo '<div class="type_1"><a class="q_'.$json->type.'" href="javascript:void(0);"><img src="http://h5.appgame.com/wp-content/themes/gamezone-h5/images/start_t.gif" width="170"></a></div>';
        break;
        case '2' :
        case '3' :
        echo '<div class="questionList">';
        for($i = 0, $q_len = count($json->questionList); $i < $q_len; $i++) {
          echo '<div class="question"><h3>'.$json->questionList[$i]->question.'</h3><div class="question_label">';
          for($j = 0, $a_len = count($json->questionList[$i]->answer); $j < $a_len; $j++) {
            echo '<label for=a'.$i.$j.'><input name="radio" class="q_'.$json->type.'" type="radio" value='.$json->questionList[$i]->score[$j].' id=a' .$i.$j. '>' . $json->questionList[$i]->answer[$j] . '</label>';
          }
          echo '</div></div>';
        }
        echo '</div>';
        break;
        case '4' :
        echo '<div><label>请输入名字</label><input type="text" class="skin-text-willwhite" name="my_nick" id="my_nick"></div><div class="questionList">';
        for($i = 0, $q_len = count($json->questionList); $i < $q_len; $i++) {
          echo '<div class="question"><h3>' .$json->questionList[$i]->question . '</h3><div class="question_label">';
          for($j = 0, $a_len = count($json->questionList[$i]->answer); $j < $a_len; $j++) {
            echo '<label for=a'.$i.$j.'><input name="radio" class="q_'.$json->type.'" type="radio" value=' . $json->questionList[$i]->score[$j] . ' id=a' .$i.$j. '>' . $json->questionList[$i]->answer[$j] . '</label>';
          }
          echo '</div></div>';
        }
        echo '</div>';
        break;
        case '5' :
        echo '<div class="questionList">';
        for($i = 0, $q_len = count($json->questionList); $i < $q_len; $i++) {
          echo '<div class="question"><h3>' .$json->questionList[$i]->question . '<img src="http://h5.appgame.com/wp-content/uploads/2015/10/loading_64.gif" src-data="'.$json->questionList[$i]->img.'" /></h3><div class="question_label">';
          for($j = 0, $a_len = count($json->questionList[$i]->answer); $j < $a_len; $j++) {
            echo '<label for=a'.$i.$j.'><input name="radio" class="q_2" type="radio" value=' . $json->questionList[$i]->score[$j] . ' id=a' .$i.$j. '>' . $json->questionList[$i]->answer[$j] . '</label>';
          }
          echo '</div></div>';
        }
        echo '</div>';
        break;
        case '6':
        echo '<div class="type_1"><label>'.$json->question.'</label><input type="text" id="my_value" class="skin-text-willwhite s_value"></div><div class="questionList">';
        for($i = 0, $q_len = count($json->questionList); $i < $q_len; $i++) {
          echo '<div class="question"><h3>' . $json->questionList[$i]->question .'</h3><div class="question_label">';
          for($j = 0, $a_len = count($json->questionList[$i]->answer); $j < $a_len; $j++) {
            echo '<label for=a'.$i.$j.'><input name="radio" class="q_6" type="radio" value=' . $json->questionList[$i]->score[$j] . ' id=a' .$i.$j. '>'. $json->questionList[$i]->answer[$j] .'</label>';
          }
          echo '</div></div>';
        }
        echo  '</div>';
        break;
      } 
      ?> 
      </div>  
      <div id='results' class='hide'>
        <?php 
        echo "<div class=c_result>";
        switch($json->resultType) {
          case '2': 
          echo "<div class=img_result><h3>您的测试结果是</h3><ul>";
          for($i = 0, $len = count($json->result); $i < $len; $i++) {
            echo "<li score=".$json->result[$i]->score.">";
            for($j = 0, $r_len = count($json->result[$i]->trueResult); $j < $r_len; $j++) {
              if($json->result[$i]->trueResult[$j]) {
                echo "<p>" . $json->result[$i]->trueResult[$j] . "</p>";
              }
            }
            if($json->result[$i]->img) {
              echo "<img src='http://h5.appgame.com/wp-content/uploads/2015/10/loading_64.gif' src-data=".$json->result[$i]->img." />";
            }
            echo "</li>";
          }
          echo "</ul></div></div>"; 
          break;
          case '3': 
          echo "<div class=t_result><div class=t_result_hd><h3>您的测试结果是</h3></div><div class=t_result_bd><ul>";
          for($i = 0, $len = count($json->result); $i < $len; $i++) {
            echo "<li score=".$json->result[$i]->score.">";
            if($json->resultName) {
              echo "<span class=my_nickname></span>";
            } else {
              echo "";
            }
            $r_len = count($json->result[$i]->trueResult);
            echo $json->result[$i]->trueResult[0];
            echo number_format(mt_rand($json->result[$i]->trueResult[1],$json->result[$i]->trueResult[$r_len-1]));
            echo "</li>";
          }
          echo "</ul></div></div></div>";   
          break; 
          default : 
          echo "<div class=t_result><div class=t_result_hd><h3>您的测试结果是</h3></div><div class=t_result_bd><ul>";
          for($i = 0, $len = count($json->result); $i < $len; $i++) {
            echo "<li score=".$json->result[$i]->score.">";
            if($json->resultName) {
              echo "<span class=my_nickname></span>";
            } else {
              echo "";
            }
            for($j = 0, $r_len = count($json->result[$i]->trueResult); $j < $r_len; $j++) {
              echo $json->result[$i]->trueResult[$j] . "<br />";
            }
            echo "</li>";
          }
          echo "</ul></div></div></div>";               
        }
        ?>
        <div class="bdsharebuttonbox myshare">
          <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
        </div>
      </div>
    </div>
    <?php } ?>
<div class="bdshare cf">
  <div class="bdsharebuttonbox bdshare_bg">
    <span class="bdshare_txt">分享：</span>
    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
  </div>
  <div class="shoucang">收藏：<em class="sc_ico" onclick="myfavorite(<?php the_ID();?>)"></em></div>
</div>
    
    
    <?php comments_template(); ?>
    <?php endwhile; // end of the loop. ?>

  </div>
  <!-- #content --> 
</div>
<!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>