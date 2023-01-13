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
		<div class="tab_infotitle">
			<h2><?php echo $row2['bo_subject']?></h2>
			<span class="snsWrap">

			<?php if($row2['bo_5']) { ?>
				<a href="<?php echo $row2['bo_5']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/facebook_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/facebook.png"></a>
			<? } ?>

			<?php if($row2['bo_6']) { ?>
				<a href="<?php echo $row2['bo_6']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/instargram_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/instargram.png"></a>
			<? } ?>

			<?php if($row2['bo_7']) { ?>
				<a href="<?php echo $row2['bo_7']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/twitter_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/twitter.png"></a>
			<? } ?>

			<?php if($row2['bo_8']) { ?>
				<a href="<?php echo $row2['bo_8']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/kakaoch_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/kakaoch.png"></a>
			<? } ?>
				
				
				
			</span>
		</div>
		<div class="tab_infoarea">
			<a href="<?php echo $row2['bo_1']?>" target="_blank">
			<div class="infoarea_img">
				<img src="<?php echo $himg?>">
				<span class="blackLabel">홈페이지 바로가기 <i class="xi-external-link"></i></span>
			</div>
			</a>
			<div class="infoarea_text">
				<li>
					<label>사업</label>
					<span><?php echo $row2['bo_2']?></span>
				</li>
				<li>
					<label>권역</label>
					<span><?php echo $group['gr_subject'];?></span>
				</li>
				<li>
					<label class="eng">E-MAIL</label>
					<span class="eng"><?php echo $row2['bo_3']?></span>
				</li>
				<li>
					<label class="eng">TEL</label>
					<span class="eng"><?php echo $row2['bo_4']?></span>
				</li>
				
				
			</div>
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
	  <button class="closeBox hideUnivercity"><i class="xi-close"></i></button>    
	  <div id="<?php echo $row4['bo_table']?>" class="">	
		<div class="toggle-univercity-infotitle">
			<h2><?php echo $row4['bo_subject']?></h2>
		</div>

		<div class="tab_infoarea">
			<a href="<?php echo $row4['bo_1']?>" target="_blank">
			<div class="toggle-infoarea-img">
				<img src="<?php echo $himg4?>">
				<span class="toggle-infoarea-blackLabel">홈페이지 바로가기 <i class="xi-external-link"></i></span>
			</div>
			</a>
			<div class="toggle-infoarea-text">
				<li>
					<label>사업</label>
					<span><?php echo $row4['bo_2']?></span>
				</li>
				<li>
					<label>권역</label>
					<span><?php echo $group['gr_subject'];?></span>
				</li>
				<li>
					<label class="eng">E-MAIL</label>
					<span class="eng"><?php echo $row4['bo_3']?></span>
				</li>
				<li>
					<label class="eng">TEL</label>
					<span class="eng"><?php echo $row4['bo_4']?></span>
				</li>
			</div>
		</div>
	  </div>

	  <span class="snsWrap">

			<?php if($row4['bo_5']) { ?>
				<a href="<?php echo $row2['bo_5']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/facebook_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/facebook.png"></a>
			<? } ?>

			<?php if($row4['bo_6']) { ?>
				<a href="<?php echo $row2['bo_6']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/instargram_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/instargram.png"></a>
			<? } ?>

			<?php if($row4['bo_7']) { ?>
				<a href="<?php echo $row2['bo_7']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/twitter_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/twitter.png"></a>
			<? } ?>

			<?php if($row4['bo_8']) { ?>
				<a href="<?php echo $row2['bo_8']?>" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/kakaoch_on.png"></a>
			<? } else { ?>
				<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/kakaoch.png"></a>
			<? } ?>
			</span>

  <!--<button class="hideUnivercity nextUnivercity" id="Univercitytab-">Next</button> 
  <button class="hideUnivercity prevUnivercity" id="Univercitytab-">Prev</button>-->
  
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
  })

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
