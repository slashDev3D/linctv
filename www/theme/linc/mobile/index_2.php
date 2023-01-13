<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_MOBILE_PATH.'/head_main.php');
?>

<!-- 배너 최신글 -->
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/banner', 'banner', 5, 33);
?>


<div class="main_contents">
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/tab', 'maintab', 1, 33);

//echo $PHP_SELF;
?>



<div class="maintabs">
	<h2>조회수 <font class="eng">TOP 10</font></h2>
		<ul id="maintabs-nav">
			<li><a href="#all">ALL</a></li>
			<li><a href="#linctv01">위클링클</a></li>
			<li><a href="#linctv02">링모지</a></li>
			<li><a href="#linctv03">링크씨가 간다</a></li>
		</ul>

		<div id="all" class="maintab-content">
			<?php echo latest_all('theme/slide_thumb_youtube_main_tab', '전체게시판', 10, 24 ,array('news','schedule','banner','linc_event','event','maintab')); ?>
		</div>

		<div id="linctv01" class="maintab-content">
		<?php
			echo latest_main('theme/slide_thumb_youtube_main_tab', 'linctv01', 10, 33);
		?>
		</div>
		<div id="linctv02" class="maintab-content">
		<?php
			echo latest_main('theme/slide_thumb_youtube_main_tab', 'linctv02', 10, 33);
		?>
		</div>

		<div id="linctv03" class="maintab-content">
		<?php
			echo latest_main('theme/slide_thumb_youtube_main_tab', 'linctv03', 10, 33);
		?>
		</div>
</div>



<h2 class="mainTitle">최신 콘텐츠</h2>
<?php include_once(G5_BBS_PATH.'/new_main.php');?>
<?php echo latest('theme/slide_thumb', 'linc_event', 4, 33);?>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv01', 8, 33);?>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv02', 8, 33);?>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv03', 8, 33);?>
<?php echo latest_group("theme/slide_thumb_youtube_main_linctv", "linctv", 8, 25, 50,"","","");?>
<?php echo latest_newmain_uni('theme/slide_thumb_youtube_main_univercity', '', 8, 24 ,array('banner','linctv01','linctv02','linctv03','linc_event','event','news','schedule','maintab','vimeo_gallery')); ?>
</div>

<div id="pcNew" class="mainfootBanner_space">
<?php echo display_banner('개별', '5'); ?>
</div>
<div id="mobileNew" class="mainfootBanner_space">
<?php echo display_banner('개별', '6'); ?>
</div>


<div class="idx_wrap_lt">
<div class="idx_lt">
    <div class="lt_wr">
     <?php
		$options = array( 'thumb_width' => 140, 'thumb_height' => 105, 'box_width' => 400, 'thumb_arrange' => 'h' );
		echo latest("theme/newsletter", "news", 6, 100, 0, $options);
	?>

    </div>
    <div class="lt_wr time">
      <?php echo latest('theme/main_schedule_new', 'schedule', 3, 100);?>
    </div>
</div>
</div>


<script>
$(document).ready(function(){
// Show the first tab and hide the rest
$('#maintabs-nav li:first-child').addClass('active');
$('.maintab-content').hide();
$('.maintab-content:first').show();

// Click function
$('#maintabs-nav li').click(function(){
  $('#maintabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.maintab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
});

</script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail_main.php');
?>