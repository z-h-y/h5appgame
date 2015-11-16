function getResult(type,score) {
	var id = $('.content-top').attr('postid').toString();
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
	if(type == 1 || type == 4) {
		var nick= $('#my_nick').val();
		localStorage.setItem('ceceAppgameNickName',nick);
		if(nick==''){alert('该字段不能为空哦~~');$('#my_nick').focus();return false;}  
	}
	if(type == 1) {
		var nick= $('#my_value').val();
		if(nick==''){alert('该字段不能为空哦~~');$('#my_value').focus();return false;} 
		var len = $('#results li').length;
		if(isNaN(score)) {
			score = Math.round(Math.random()*10*len);
		}
	}
	if(type == 6) {
		var nick= $('#my_value').val();
		if(nick==''){alert('该字段不能为空哦~~');$('#my_value').focus();return false;} 
		var scoreLen = $("#results li[score="+score+"]").length;
	}
	$('#content-top-question').hide();
	$('.t_result .my_nickname').html(localStorage.getItem('ceceAppgameNickName'));	
	$('#results').show();
	var r_li = $("#results li");
	var r_li_len = r_li.length;
	var r_default = 0;
	var share_result = '';
	for(var i = 0; i < r_li_len; i++) {
		var sc = isNaN(parseInt(r_li.eq(i).attr("score"))) ? r_li.eq(i).attr("score") : parseInt(r_li.eq(i).attr("score"));
		if(score <= sc) {
			if(type == 6 && scoreLen-1 > 0) {
				if(Math.round(Math.random()*scoreLen)>=1) {
					r_default++;
					scoreLen--;
					continue;
				}
			}
			r_li.eq(i).show().siblings().hide();
			showImg(r_li.eq(i));
			share_result=r_li.eq(i).text();
			break;
		}
		r_default++;
	}
	if(r_default == r_li_len) {
		r_li.eq(r_default-1).show().siblings().hide();
		showImg(r_li.eq(r_default-1));
		share_result = r_li.eq(r_default-1).text();
	}
	window._bd_share_config.share.bdText = share_result;
	wxData.title = share_result;
	$('#shareWap').show();
}	
function showImg(node){
	var img = node.find('img');
	var src = img.attr('src-data');
	if(src) {
		img.attr('src',src);
	}
}
$(document).ready(function(){ 
	showImg($('.questionList .question').first());
	$('#my_nick').val(localStorage.getItem('ceceAppgameNickName'));
	$(document).on('click', '.q_1', function () {
		getResult(1,$('.s_value').val());
    });
	var all_score = 0;
	$(document).on('click', '.q_2', function () {
		all_score += parseInt($(this).val());
		var parNode = $(this).parents('.question');
		var parNodeNext = parNode.next();
		if(parNodeNext.length){
			showImg(parNodeNext);
			parNode.hide(300);
			parNodeNext.show(300).siblings().hide();
		} else {
			getResult(2,all_score);
		}
    });
    var next_score = 1;
	$(document).on('click', '.q_3', function () {
		next_score = $(this).val();
		if(!isNaN(next_score)){
			$(this).parents('.question').hide(300);
			$('.question').eq(next_score-1).show(300).siblings().hide();
		} else {
			getResult(3,next_score);
		}
    });  
    $(document).on('click', '.q_4', function () {
		getResult(4,$(this).val());
    });   
    $(document).on('click', '.q_6', function () {
		getResult(6,$(this).val());
    });
    $(document).on('mouseover touchstart', '.question label', function () {
		$(this).addClass('question_hover').siblings('label').removeClass('question_hover');
    });
    $(document).on('mouseout', '.question label', function () {
		$(this).removeClass('question_hover');
    });
});