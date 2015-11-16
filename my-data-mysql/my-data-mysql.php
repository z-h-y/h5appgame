<?php
/**
 * @package my-data-mysql
 * @version 1.6
 */
/*
Plugin Name: my-data-mysql
Plugin URI: http://cece.appgame.com/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: z-h-y
Version: 1.0
Author URI: http://cece.appgame.com/
*/
function fengxl_admin_fstmenu()
{
    add_menu_page(__('主菜单'),__('设置测测文章'),8,__FILE__,'my_function_menu');
    add_submenu_page(__FILE__,'子菜单1','修改文章',8,'your-admin-sub-menu1','my_function_submenu1');
}
function addStyle() {
  echo "<style type=text/css>.widthAll,.r_q_value{width:100%;}.addSelect{margin-right:10px;}.question{margin:10px 0;}#json{width:100%;height:400px;}</style>";
}
function addScript() {
  echo '<script src="'.plugins_url('/js/jquery-1.7.2.min.js', __FILE__).'"></script>';
  echo "<script>
          $(document).ready(function(){ 
            $('#page_type').change(function(){ 
              var p1=$(this).children('option:selected').val(); 
              switch(p1) {
                case '1': $('.page_type').empty().append('<div><a class=addInput href=javascript:void(0);>添加输入框</a></div>');
                break;
                case '2':      
                case '3':
                case '4':
                case '5': $('.page_type').empty().append('<div><h3>文章问题</h3><ol class=questions><li class=question>文章问题：<input type=text name=question class=q_value />问题图片URL：<input type=text name=question_img class=q_img_value /><a class=addSelect href=javascript:void(0);>添加选项</a><a class=del href=javascript:void(0);>删除问题</a><br /> </li></ol><a class=addQuestion href=javascript:void(0);>添加问题</a>位置(默认加在最后)：<input type=text class=addQuestion_index /></div>');
                break;
              }
            });
          });
          $(document).on('click', '.addBr', function () {
              $(this).parent().append('<div><input class=r_q_value type=text name=result /><a class=del href=javascript:void(0);>删除换行</a></div>');
          });
          $(document).on('click', '.addInput', function () {
              $(this).parent().prepend('<div>输入框问题：<input type=text class=input_value /><a class=del href=javascript:void(0);>删除问题</a></div>');
          });
          $(document).on('click', '.addSelect', function () {
              $(this).parent().append('<div class=selects>选项：<input type=text name=selection class=q_s_value />分值/跳转：<input type=text name=score class=q_score_value /><a class=del href=javascript:void(0);>删除</a></div>');
          });
          $(document).on('click', '.del', function () {
              $(this).parent().remove();
          });
          $(document).on('click', '#getId', function () {
              $('#test_hidden').val('y');
          });
          $(document).on('click', '.addQuestion', function () {
              var index = $('.addQuestion_index').val();
              var len = $('.questions li').length;
              if(index && index < len+1) {
                $('.questions li').eq(index-1).before('<li class=question>文章问题：<input type=text name=question class=q_value />问题图片URL：<input type=text name=question_img class=q_img_value /><a class=addSelect href=javascript:void(0);>添加选项</a><a class=del href=javascript:void(0);>删除问题</a></li>');
              } else {
                $('.questions').append('<li class=question>文章问题：<input type=text name=question class=q_value />问题图片URL：<input type=text name=question_img class=q_img_value /><a class=addSelect href=javascript:void(0);>添加选项</a><a class=del href=javascript:void(0);>删除问题</a></li>');
              }        
          });
          $(document).on('click', '.addResult', function () {
              var index = $('.addResult_index').val();
              var len = $('.results li').length;
              if(index && index < len+1) {
                $('.results li').eq(index-1).before('<li class=result>分数/类型的答案：<input type=text name=s_score class=r_s_value value='+(index*10)+' />答案图片URL(无时留空)<input type=text name=i_score class=r_i_value /><a class=del href=javascript:void(0);>删除答案</a><br/>结果：<a class=addBr href=javascript:void(0);>添加换行</a><input class=r_q_value type=text name=result  /></li>');
              } else { $('.results').append('<li class=result>分数/类型的答案：<input type=text name=s_score class=r_s_value value='+(len+1)*10+' />答案图片URL(无时留空)<input type=text name=i_score class=r_i_value /><a class=del href=javascript:void(0);>删除答案</a><br/>结果：<a class=addBr href=javascript:void(0);>添加换行</a><input class=r_q_value type=text name=result /></li>');}     
          });
          $(document).on('click', '.single_submit,.create_json', function () {
            $('#data_hidden').val('y');
            var json = {};
            json.type = $('#page_type').val();
            json.resultType = $('#result_type').val();
            json.resultName = $('#result_name').val();
            json.title = $('#page_title').val();
	    json.img = $('#img').val();
	    if(!$('#page').val()) {alert('题目未定');return false;}
            json.intro = $('#page_intro').val();
            json.question = $('.input_value').val();
            if(json.type != 1) {
              json.questionList = new Array();
              var q_len = $('.question').length;
              for(var i = 0; i < q_len; i++) {
                var q_json = {};
                q_json.question = $('.question').eq(i).find('.q_value').val();
                var q_img = $('.question').eq(i).find('.q_img_value').val();
                  if(q_img) {
                    q_json.img = q_img;
                } 
                q_json.answer = new Array();
                q_json.score = new Array();
                var a_len = $('.question').eq(i).find('.selects').length;
                for(var j = 0; j < a_len; j++) {
                  q_json.answer[j] = $('.question').eq(i).find('.selects').eq(j).find('.q_s_value').val();
                  q_json.score[j] = $('.question').eq(i).find('.selects').eq(j).find('.q_score_value').val();
                }
                json.questionList[i] = q_json;
              }
            }
            json.result = new Array();
            var r_len = $('.result').length;
            for(var i = 0; i < r_len; i++) {
              var r_json = {};
              r_json.score = $('.result').eq(i).find('.r_s_value').val();
              var img = $('.result').eq(i).find('.r_i_value').val();
              if(img) {
                r_json.img = img;
              }    
              r_json.trueResult = new Array();
              var t_len = $('.result').eq(i).find('.r_q_value').length;
              for(var j = 0; j < t_len; j++) {
                r_json.trueResult[j] = $('.result').eq(i).find('.r_q_value').eq(j).val();
              }            
              json.result[i] = r_json;
            }
            $('#json').val(JSON.stringify(json));
          });
        </script>";
}
function commentHTML() {
echo '<form action="" method=post >
<h3>

<label for="page">文章标题：</label>

<input type="text" id="page" name="page" value="" />

</h3>
<h3>

<label for="img">文章图片URL（空时使用特色图）：</label>

<input type="text" id="img" name="img" value="" />

</h3>
<label for="page_title">文章题目：</label>

<input class="widthAll" type="text" id="page_title" name="page_title" value="" />
<label for="page_intro">文章介绍：</label>

<input class="widthAll" type="text" id="page_intro" name="page_intro" value="" />
<label for="page_type">文章问题类型：</label>
<select id="page_type" name="select">
<option value="1" selected="selected">名字+(一个输入框)</option>
<option value="2">顺序选择题</option>
<option value="3">跳转选择题</option>
<option value="4">名字+一个选择题</option>
<option value="5">图片题目的选择题</option>
</select>
<label for="result_type">答案显示类型：</label>
<select id="result_type" name="select">
<option value="1" selected="selected">文字</option>
<option value="2">(文字)+图片</option>
</select>
<label for="result_name">答案开头显示名字：</label>
<select id="result_name" name="select">
<option value="0" selected="selected">否</option>
<option value="1">是</option>
</select>
<div class=page_type>
  <div>
    <a class="addInput" href="javascript:void(0);">添加输入框</a>
  </div>
</div>
<h3>文章答案(请升序排列)</h3>
<ol class="results">
  <li class="result">
    分数/类型的答案：<input type=text name=s_score class=r_s_value />答案图片URL(无时留空)<input type=text name=i_score class=r_i_value /><a class=del href=javascript:void(0);>删除答案</a><br />
    结果：<a class="addBr" href="javascript:void(0);">添加换行</a><input class="r_q_value" type="text" name="result" value="" />
  </li>
</ol>
<a class="addResult" href="javascript:void(0);">添加答案</a>
位置(默认加在最后)：<input type=text class=addResult_index />
<p>
<input type=submit class=single_submit value=保存 />
<a href="javascript:void(0);" class="create_json">生成json</a>
 </p>
<input type=hidden name=data_hidden value=y />
<textarea id="json" name=textarea></textarea></form>';
}
function my_function_menu()
{
  addStyle();
  addScript();
  echo "<h2>添加文章</h2>";

  echo '<div class="wrap">';
  echo '<h2>添加数据</h2><p>在这里进行数据添加。</p>';
  commentHTML();
  echo '</div>';
  if(isset($_POST['data_hidden']) && $_POST['data_hidden'] == 'y') {
    $my_post = array(
      'post_title'    => $_POST['page'],
      'post_status'   => 'draft',
      'post_content'  => $_POST['textarea'],
      'post_category' => array(33) 
    );
    // Insert the post into the database
    wp_insert_post( $my_post );
  }
}
function my_function_submenu1()
{
  addStyle();
  addScript();
     if(isset($_POST['test_hidden']) && $_POST['test_hidden'] == 'y') {
    $id=$_POST['pageId'];}
   echo "<h2>子菜单设置一</h2>";
   echo "<form action='' method=post >文章ID(文章页的链接地址上可以看到，?p=后面的数字)：<input type=text name='pageId' value='".$id."' /><input id=getId type=submit value=获取文章数据 /><input type=hidden id=test_hidden name=test_hidden />";
   if(isset($_POST['test_hidden']) && $_POST['test_hidden'] == 'y') {
    $contents = get_post($id)->post_content;
    $content = json_decode($contents);
    if(!$content || !$content->type) {
      exit("找不到对应id的文章或者对应的文章不对");
    }
    echo '<h3><label for="page">文章标题：</label><input type="text" id="page" name="page" value="'.get_post($id)->post_title.'" /></h3><h3><label for="img">文章图片URL（空时使用特色图）：</label><input type="text" id="img" name="img" value="'.$content->img.'" /></h3>
          <label for="page_title">文章题目：</label><input class="widthAll" type="text" id="page_title" name="page_title" value="'.$content->title.'" />
          <label for="page_intro">文章介绍：</label><input class="widthAll" type="text" id="page_intro" name="page_intro" value="'.$content->intro.'" />';    
    $select = array();
    $select[$content->type] =' selected="selected"';
    echo '<label for="page_type">文章问题类型：</label><select id="page_type" name="select"><option value="1"'.$select[1].'>名字+(一个输入框)</option><option value="2"'.$select[2].'>顺序选择题</option><option value="3"'.$select[3].'>跳转选择题</option><option value="4"'.$select[4].'>名字+一个选择题</option><option value="5"'.$select[5].'>图片题目的选择题</option></select>';
    unset($select);
    $select[$content->resultType] =' selected="selected"';
    echo '<label for="result_type">答案显示类型：</label><select id="result_type" name="select"><option value="1"'.$select[1].'>文字</option><option value="2"'.$select[2].'>(文字)+图片</option></select>';
    unset($select);
    $select[$content->resultName] =' selected="selected"';
    echo '<label for="result_name">答案开头显示名字：</label><select id="result_name" name="select"><option value="0"'.$select[0].'>否</option><option value="1"'.$select[1].'>是</option></select>';
    echo '<div class=page_type>';
    switch($content->type) {
      case '1':
      echo '<div>';
      if($content->question) {
        echo '<div>输入框问题：<input type=text class=input_value value="'.$content->question.'" /><a class=del href=javascript:void(0);>删除问题</a></div>';
      }
      echo '<a class="addInput" href="javascript:void(0);">添加输入框</a></div>';
      break;
      case '2':
      case '3':
      case '4':
      case '5':
      echo '<div><h3>文章问题</h3><ol class=questions>';
      foreach ($content->questionList as $value) {
        echo '<li class=question>文章问题：<input type=text name=question class=q_value value="'.$value->question.'" />问题图片URL：<input type=text name=question_img class=q_img_value value="'.$value->img.'" /><a class=addSelect href=javascript:void(0);>添加选项</a><a class=del href=javascript:void(0);>删除问题</a>';
        for($i = 0; $i < count($value->answer); $i++) {
          echo '<div class=selects>选项：<input type=text name=selection class=q_s_value value="'.$value->answer[$i].'" />分值/跳转：<input type=text name=score class=q_score_value value="'.$value->score[$i].'" /><a class=del href=javascript:void(0);>删除</a></div>';
        }
        echo '</li>';
      } 
      echo '</ol><a class=addQuestion href=javascript:void(0);>添加问题</a>位置(默认加在最后)：<input type=text class=addQuestion_index /></div>';
      break;
    }
    echo '</div><h3>文章答案(请升序排列)</h3><ol class="results">';
    foreach ($content->result as $value) {
      echo '<li class="result">分数/类型的答案：<input type=text name=s_score class=r_s_value value="'.$value->score.'" />答案图片URL(无时留空)<input type=text name=i_score class=r_i_value value="'.$value->img.'" /><a class=del href=javascript:void(0);>删除答案</a><br />结果：<a class="addBr" href="javascript:void(0);">添加换行</a><input class="r_q_value" type="text" name="result" value="'.$value->trueResult[0].'" />';
      $arrlength=count($value->trueResult);
      for($i = 1; $i < $arrlength; $i++) {
        echo '<div><input class=r_q_value type=text name=result value="'.$value->trueResult[$i].'" /><a class=del href=javascript:void(0);>删除换行</a></div>';
      }
      echo '</li>';
    }
    echo '</ol><a class="addResult" href="javascript:void(0);">添加答案</a>位置(默认加在最后)：<input type=text class=addResult_index /><p><input type=submit class=single_submit value=保存 /></p><input type=hidden name=data_hidden id=data_hidden /><textarea id="json" name=textarea>'.$contents.'</textarea>';
   }
   echo '</form>';
  if(isset($_POST['data_hidden']) && $_POST['data_hidden'] == 'y') {
    $my_post = array(
        'ID'           => $_POST['pageId'],
        'post_title'   => $_POST['page'],
        'post_content' => $_POST['textarea']
    );

  // Update the post into the database
    wp_update_post( $my_post );
  }
}
add_action('admin_menu','fengxl_admin_fstmenu');

?>
