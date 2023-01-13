<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//echo $bo_table;

if ($bo_table == "university01"){
    $active_univercity = "0";//slide 0
}else if ($bo_table == "university02"){
    $active_univercity = "1";//slide 0
}else if ($bo_table == "university03"){
    $active_univercity = "2";//slide 0
}else if ($bo_table == "university04"){
    $active_univercity = "3";//slide 0
}else if ($bo_table == "university05"){
    $active_univercity = "4";//slide 0
}else if ($bo_table == "university06"){
    $active_univercity = "5";//slide 0
}else if ($bo_table == "university07"){
    $active_univercity = "6";//slide 0
}else if ($bo_table == "university08"){
    $active_univercity = "7";//slide 0
}else if ($bo_table == "university09"){
    $active_univercity = "8";//slide 0
}else if ($bo_table == "university10"){
    $active_univercity = "9";//slide 0
}else if ($bo_table == "university11"){
    $active_univercity = "10";//slide 0
}else if ($bo_table == "university12"){
    $active_univercity = "0";//slide 0
}else if ($bo_table == "university13"){
    $active_univercity = "1";//slide 0
}else if ($bo_table == "university14"){
    $active_univercity = "2";//slide 0
}else if ($bo_table == "university15"){
    $active_univercity = "3";//slide 0
}else if ($bo_table == "university16"){
    $active_univercity = "4";//slide 0
}else if ($bo_table == "university17"){
    $active_univercity = "5";//slide 0
}else if ($bo_table == "university18"){
    $active_univercity = "6";//slide 0
}else if ($bo_table == "university19"){
    $active_univercity = "7";//slide 0
}else if ($bo_table == "university20"){
    $active_univercity = "8";//slide 0
}else if ($bo_table == "university21"){
    $active_univercity = "9";//slide 0
}else if ($bo_table == "university22"){
    $active_univercity = "10";//slide 0
}else if ($bo_table == "university23"){
    $active_univercity = "11";//slide 0
}else if ($bo_table == "university24"){
    $active_univercity = "0";//slide 0
}else if ($bo_table == "university25"){
    $active_univercity = "1";//slide 0
}else if ($bo_table == "university26"){
    $active_univercity = "2";//slide 0
}else if ($bo_table == "university27"){
    $active_univercity = "3";//slide 0
}else if ($bo_table == "university28"){
    $active_univercity = "4";//slide 0
}else if ($bo_table == "university29"){
    $active_univercity = "5";//slide 0
}else if ($bo_table == "university30"){
    $active_univercity = "6";//slide 0
}else if ($bo_table == "university31"){
    $active_univercity = "7";//slide 0
}else if ($bo_table == "university32"){
    $active_univercity = "8";//slide 0
}else if ($bo_table == "university33"){
    $active_univercity = "9";//slide 0
}else if ($bo_table == "university34"){
    $active_univercity = "10";//slide 0
}else if ($bo_table == "university35"){
    $active_univercity = "0";//slide 0
}else if ($bo_table == "university36"){
    $active_univercity = "1";//slide 0
}else if ($bo_table == "university37"){
    $active_univercity = "2";//slide 0
}else if ($bo_table == "university38"){
    $active_univercity = "3";//slide 0
}else if ($bo_table == "university39"){
    $active_univercity = "4";//slide 0
}else if ($bo_table == "university40"){
    $active_univercity = "5";//slide 0
}else if ($bo_table == "university41"){
    $active_univercity = "6";//slide 0
}else if ($bo_table == "university42"){
    $active_univercity = "7";//slide 0
}else if ($bo_table == "university43"){
    $active_univercity = "8";//slide 0
}else if ($bo_table == "university44"){
    $active_univercity = "9";//slide 0
}else if ($bo_table == "university45"){
    $active_univercity = "0";//slide 0
}else if ($bo_table == "university46"){
    $active_univercity = "1";//slide 0
}else if ($bo_table == "university47"){
    $active_univercity = "2";//slide 0
}else if ($bo_table == "university48"){
    $active_univercity = "3";//slide 0
}else if ($bo_table == "university49"){
    $active_univercity = "4";//slide 0
}else if ($bo_table == "university50"){
    $active_univercity = "5";//slide 0
}else if ($bo_table == "university51"){
    $active_univercity = "6";//slide 0
}else if ($bo_table == "university52"){
    $active_univercity = "7";//slide 0
}else if ($bo_table == "university53"){
    $active_univercity = "8";//slide 0
}else if ($bo_table == "university54"){
    $active_univercity = "9";//slide 0
}else if ($bo_table == "university55"){
    $active_univercity = "10";//slide 0
}else{
    $active_univercity = "0";//slide 0
}
?>

<style>
.slick-center {border:1px solid #005FBB !important;}
.topUni-slider .topUni-wrapper .topUni {overflow:hidden}
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<div class="topuvMenu-wrap">
<div class="topuvMenu">
  <?
	$sql = " select * from {$g5['group_table']} where gr_id not in ('community','linctv','lincnews','lincevent') order by gr_order ";
    $result = sql_query($sql);
	for ($gi=0; $row=sql_fetch_array($result); $gi++) { // gi 는 group index
	
		//$sql2 = " select * from {$g5['board_table']} where gr_id = '{$row['gr_id']}' and bo_device <> 'mobile' order by bo_order ";
		//$result2 = sql_query($sql2);
		//for ($bi=0; $row2=sql_fetch_array($result2); $bi++) { // bi 는 board index	
			//$board_table = $g5['write_prefix'] . $row2['bo_table'];

			//$latest_count =  sql_fetch(" select count(*) as cnt from {$board_table} where wr_datetime > '".date('Y-m-d H:i:s', time() - (3600 * $new_time))."'");
			
			//$groupmenu[$bi]['bo_table'] = $row2['bo_table'];
			//$groupmenu[$bi]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row2['bo_table'];
			//$groupmenu[$bi]['subject'] = $row2['bo_subject'];
			//$groupmenu[$bi]['cnt'] = $latest_count['cnt'];

			 // 게시판수
			$sql2 = " select count(*) as cnt from {$g5['board_table']} where gr_id = '{$row['gr_id']}' ";
			$row2 = sql_fetch($sql2);


			if($row['gr_id'] == "lincArea01") {
				$gLink = "/bbs/board.php?bo_table=university01";
			} else if($row['gr_id'] == "lincArea02") {
				$gLink = "/bbs/board.php?bo_table=university12";
			} else if($row['gr_id'] == "lincArea03") {
				$gLink = "/bbs/board.php?bo_table=university24";
			} else if($row['gr_id'] == "lincArea04") {
				$gLink = "/bbs/board.php?bo_table=university35";
			} else if($row['gr_id'] == "lincArea05") {
				$gLink = "/bbs/board.php?bo_table=university45";
			}
			

			?>
			<?php if ($gr_id == $row['gr_id']) { ?>
			<li class="active">
				<a href="<?php echo $gLink?>"><?php echo $row['gr_subject']?></a>
			</li>
			<? } else { ?>
			<li>
				<a href="<?php echo $gLink?>"><?php echo $row['gr_subject']?></a>
			</li>
			<?} ?>
		<? //} ?>
	<?} ?>
</div>
</div>

 <div class="page-wrapper" style="position:relative;">
      <!--page slider -->
      <div class="topUni-slider">
		
		<i class="xi-angle-right next"></i>
        <i class="xi-angle-left prev"></i> 
        

        <div class="topUni-wrapper">
		<?php

			$sql3 = " select *
						 from {$g5['board_table']}
						 where gr_id = '{$gr_id}'
						 and bo_list_level <= '{$member['mb_level']}'
						 and bo_device <> 'pc' ";

			if(!$is_admin)
			$sql3 .= " and bo_use_cert = '' ";
			$sql3 .= " order by bo_order ";
			$result3 = sql_query($sql3);


			for ($i=0; $row3=sql_fetch_array($result3); $i++) {

			$himg_src3 = "/data/file/".$row3['bo_table']."/".$row3['bo_table']."_bo_image_head";
			$himg3 = "<img src='".$himg_src3."'>";


			$is_f3 = file_exists("".G5_PATH."/data/file/".$row3['bo_table']."/".$row3['bo_table']."_bo_image_head");
			if($is_f3){
			?>
			  <div class="topUni">
				<a href="/bbs/board.php?bo_table=<?php echo $row3['bo_table']?>"><?php echo $himg3?></a>
			  </div>
         <? } } ?>	

        </div>
      </div>
      <!--post slider-->
    </div>

	<script>


	//$(".topUni-wrapper").not('.slick-initialized').slick({
	$('.topUni-wrapper').slick({
	  centerMode: true,
	  initialSlide: <?php echo $active_univercity ?>,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  rows: 1,
      mobileFirst:false,//add this one
	  autoplay: false,
	  autoplaySpeed: 2000,
	  nextArrow:$('.next'),
	  prevArrow:$('.prev'),

		responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
	  slidesToScroll: 2,
	  rows: 1,
      mobileFirst:false,//add this one
	  autoplay: false,
	  autoplaySpeed: 2000,
	  nextArrow:$('.next'),
	  prevArrow:$('.prev'),
        }
      }
    ]
	});
	



  </script>