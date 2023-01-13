<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin && $group['gr_device'] == 'pc')
    alert($group['gr_subject'].' 그룹은 PC에서만 접근할 수 있습니다.');

include_once(G5_THEME_MOBILE_PATH.'/head.php');

//  최신글
$sql = " select *
            from {$g5['board_table']}
            where gr_id = '{$gr_id}'
            and bo_list_level <= '{$member['mb_level']}'
            and bo_device <> 'pc' ";

if(!$is_admin)
$sql .= " and bo_use_cert = '' ";
$sql .= " order by bo_order ";
$result = sql_query($sql);



//  최신글
$sql2 = "select bo_subject, bo_table, bo_1, bo_2, bo_3, bo_4, bo_5, bo_6, bo_7, bo_8, bo_9, bo_10
            from {$g5['board_table']}
            where gr_id = '{$gr_id}'
            and bo_list_level <= '{$member['mb_level']}'
            and bo_device <> 'pc' ";

if(!$is_admin)
$sql2 .= " and bo_use_cert = '' ";
$sql2 .= " order by bo_order ";
$result2 = sql_query($sql2);



//  최신글
$sql3 = " select *
            from {$g5['board_table']}
            where gr_id = '{$gr_id}'
            and bo_list_level <= '{$member['mb_level']}'
            and bo_device <> 'pc' ";

if(!$is_admin)
$sql3 .= " and bo_use_cert = '' ";
$sql3 .= " order by bo_order ";
$result3 = sql_query($sql3);



//  최신글
$sql4 = "select bo_subject, bo_table, bo_1, bo_2, bo_3, bo_4, bo_5, bo_6, bo_7, bo_8, bo_9, bo_10
            from {$g5['board_table']}
            where gr_id = '{$gr_id}'
            and bo_list_level <= '{$member['mb_level']}'
            and bo_device <> 'pc' ";

if(!$is_admin)
$sql4 .= " and bo_use_cert = '' ";
$sql4 .= " order by bo_order ";
$result4 = sql_query($sql4);



?>


<div id="pcNew">
<ul class="tabs">
	<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {

		$himg_src = "/data/file/".$row['bo_table']."/".$row['bo_table']."_bo_image_head";
		$himg = "<img src='".$himg_src."'>";
		//echo $himg;
		//echo G5_PATH;

		$is_f = file_exists("".G5_PATH."/data/file/".$row['bo_table']."/".$row['bo_table']."_bo_image_head");
		if($is_f){
	?>
	<!--<li class="tab-link current" data-tab="tab-1">tab1</li>-->
	<li class="tab-link" data-tab="tab-<?php echo $row['bo_table']?>"><?php echo $himg?></li>
	<? } } ?>	
</ul>
	
	<?php
		for ($i=0; $row2=sql_fetch_array($result2); $i++) {
		$himg = "/data/file/".$row2['bo_table']."/".$row2['bo_table']."_bo_image_head";
	?>	
        <!--<div id="tab-1" class="tab-content current">tab content1</div>-->
        <div id="tab-<?php echo $row2['bo_table']?>" class="tab-content">	
            <div class="tab-inner">
                <div class="pc-tab-close pc_btnClose"><i class="xi-close"></i></div>
                <div class="tab_logobox" style="background-image:url(<?php echo $himg?>)"></div>
                <div class="tab_contentbox">
                    <div class="tab_title">
                        <h2><?php echo $row2['bo_subject']?> 사업단</h2>
                        <ul>
                            <li><a href="<?php echo $row2['bo_1']?>" target="_blank">사업단 홈페이지 바로가기</a></li>
                            <?php if($row2['bo_8']) {?><li><a href="<?php echo $row2['bo_8']?>" target="_blank">대학 홈페이지 바로가기</a></li><?php } ?>
                        </ul>
                    </div>
                    <div class="tab_sns">
                        <a href="<?php echo $row2['bo_5']?>" class="<?php if(!$row2['bo_5']) { ?>none<? }?>"  target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_facebook.png"></a>

                        <a href="<?php echo $row2['bo_6']?>" class="<?php if(!$row2['bo_6']) { ?>none<? }?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_insta.png"></a>

                        <a href="<?php echo $row2['bo_7']?>" class="<?php if(!$row2['bo_7']) { ?>none<? }?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_youtube.png"></a>
                    </div>
                </div>
                <ul class="tab_btnbox">
                    <li><a href="<?php echo $row2['bo_1']?>">사업단 홈페이지 바로가기</a></li>
                    <li class="pc-tab-close tab_close">닫기</li>
                </ul>
            </div>
        </div>
	<? } ?>
</div>



<div id="mobileNew">
<ul class="toggle-univercity-tabs">
	<?php
		for ($i=0; $row3=sql_fetch_array($result3); $i++) {

		$himg_src3 = "/data/file/".$row3['bo_table']."/".$row3['bo_table']."_bo_image_head";
		$himg3 = "<img src='".$himg_src3."'>";
		//echo $himg;
		//echo G5_PATH;

		$is_f3 = file_exists("".G5_PATH."/data/file/".$row3['bo_table']."/".$row3['bo_table']."_bo_image_head");
		if($is_f3){
	?>
	<!--<li class="tab-link current" data-tab="tab-1">tab1</li>-->
	<button class="hideUnivercity openerUnivercity" id="Univercitytab-"><?php echo $himg3?></button> 

	<? } } ?>	
</ul>
	
	<?php
		for ($i=0; $row4=sql_fetch_array($result4); $i++) {
		$himg4 = "/data/file/".$row4['bo_table']."/".$row4['bo_table']."_bo_image_head";
	?>	
        <div class="toggle-univercity toggleHidden" id="toggle-univercity-Univercitytab-">
            <div id="<?php echo $row4['bo_table']?>" class="tab-inner">
                <div class="tab_close closeBox hideUnivercity"><i class="xi-close"></i></div>
                <div class="tab_logobox" style="background-image:url(<?php echo $himg4?>)"></div>
                <div class="tab_contentbox">
                    <div class="tab_title">
                        <h2><?php echo $row4['bo_subject']?> 사업단</h2>
                        <ul>
                            <li><a href="<?php echo $row4['bo_1']?>" target="_blank">사업단 홈페이지 바로가기</a></li>
                            <?php if($row4['bo_8']) {?><li><a href="<?php echo $row4['bo_8']?>" target="_blank">대학 홈페이지 바로가기</a></li><?php } ?>
                        </ul>
                    </div>
                    <div class="tab_sns">
                        <a href="<?php echo $row4['bo_5']?>" class="<?php if(!$row4['bo_5']) { ?>none<? }?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_facebook.png"></a>

                        <a href="<?php echo $row4['bo_6']?>" class="<?php if(!$row4['bo_6']) { ?>none<? }?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_insta.png"></a>

                        <a href="<?php echo $row4['bo_7']?>" class="<?php if(!$row4['bo_7']) { ?>none<? }?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/sns_box_youtube.png"></a>
                    </div>
                </div>
                <ul class="tab_btnbox">
                    <li><a href="<?php echo $row4['bo_1']?>">사업단 홈페이지 바로가기</a></li>
                    <li class="tab_close closeBox hideUnivercity">닫기</li><!-- closeBox -->
                </ul>
            </div>
        </div>
	<? } ?>
</div>

<div class="overlayUnivercity hideit"></div>
<script>
$(document).ready(function(){
  
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  });

  $('.pc-tab-close').click(function () {
    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');
  });

  $('.tab_contentbox a.none').click(function (e) {
      e.preventDefault();
  });

})


$(function(){

	$(".openerUnivercity")
		.each(
		function(index) {
		$(this)
		.attr("id", this.id + index);
	});
	  
	$(".toggle-univercity")
		.each(
		function(index) {
		$(this)
		.attr("id", this.id + index);
	});  
	 
	  
	$('.nextUnivercity').each(function(index) {
		index=index+1;
		$(this)
		.attr("id", this.id + index);
	});
	  
	$('.prevUnivercity').each(function(index) {
		index=index-1;
		$(this)
		.attr("id", this.id + index);
	});
  
  
      $('.toggle-univercity').addClass('toggleHidden');
      $('.hideUnivercity').click(function() {
          var x =  $(this).attr("id");
          var $item = $('div#toggle-univercity-' + x);
          if (!$item.hasClass('toggleVisible')) $('.toggle-univercity').removeClass('toggleVisible');

     $('div#toggle-univercity-' + x).toggleClass('toggleVisible');

            if ( $( this ).is( ".boxOpen" ) ) {
                $( this ).removeClass( "boxOpen" );  
                $('.overlayUnivercity' ).removeClass( "overlayUnivercityVisible" );
            } else {
                $('.hideUnivercity').removeClass("boxOpen");
                $('.overlayUnivercity' ).addClass( "overlayUnivercityVisible" );
                $( this ).addClass( "boxOpen" );
            };
        
            if ( $( this ).is( ".overlayUnivercityVisible" ) ) {
                $( this ).removeClass( "overlayUnivercityVisible" );  
                $('.toggleVisible' ).removeClass( "boxOpen" );
            }
        
            if ( $( this ).is( ".closeBox" ) ) {
                $('.overlayUnivercityVisible' ).removeClass( "overlayUnivercityVisible" );  
                $('.toggleVisible' ).removeClass( "toggleVisible" );
            }

          return false;
      });
 
});
</script>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
