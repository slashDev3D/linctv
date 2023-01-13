<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width = 210;
$thumb_height = 150;

$sql_chl = " select bo_category_list  from `g5_board` where `bo_table`='".$bo_table."'";
$row_chl = sql_fetch($sql_chl);
$categories = explode('|', $row_chl['bo_category_list']); // 구분자가 , 로 되어 있음
?>


<script>
	function latest_cname(k){
		var h=<?=count($categories)?>;
		var cass=".latest_<?=$bo_table?>_";

		for(i=0;i<h;i++){
			if(i==k){
			$(cass+i).css("display","");	 
				}else{
			$(cass+i).css("display","none");	

			}
		 }
	}	
	function getElementIndex(element, range) {
  	if (!!range) return [].indexOf.call(element, range);
  	return [].indexOf.call(element.parentNode.children, element);
	}
	function switchColors(element)  {  // sjm 210915
		// links=document.getElementsByClassName("spanBtn") ;  
		// for (var i = 0 ; i < links.length ; i ++)  
		// if($("body").hasClass("dm-dark") === true) {
		// 	links.item(i).style.color = '#ccc' ;  
		// 	element.style.color='#fff' ; 
		// } else {
		// 	links.item(i).style.color = '#999' ;  
		// 	element.style.color='#222' ;  
		// }
		links=$('.spanBtn');
		var idx = getElementIndex(document.querySelectorAll('.spanBtn'),element)
		var $this = $('.spanBtn').eq(idx)
		$('.spanBtn').removeClass('on')
		$this.addClass('on')
	}
	setTimeout(()=>{
	$('.spanBtn').eq(0).addClass('on')
	})
</script>


 

<div class="tab_pic_lt">
    <h2 class="tab_lat_title eng">
	   <?  for ($i=0; $i<count($categories); $i++) { ?> 
	   <span onClick='latest_cname("<?php echo $i ?>");switchColors(this);' class="spanBtn">
	   <?php echo $categories[$i] ?>
	   
	   	 <?php
			$sql_chl_top="select * from g5_write_$bo_table where ca_name = '".$categories[$i]."'  order by wr_num, wr_reply limit 0, 5";
			//echo $sql_chl_lis;
			$result_chl_top = sql_query($sql_chl_top);
			$j = 0;
			while ($row_chl_top = sql_fetch_array($result_chl_top))
			{

				//echo $row_chl_top['wr_3']."a<br>";
				//echo $row_chl_top['wr_4']."b<br>";
				//echo $row_chl_top['wr_5']."c<br>";

				$tv_time = date('H');
				//echo $tv_time."d<br>";
				//echo G5_TIME_YMD."e<br>";

				
				if($row_chl_top['wr_3'] == G5_TIME_YMD) {
						if($tv_time >= $row_chl_top['wr_4'] || $tv_time < $row_chl_top['wr_5']){
							echo "<span class='liveicon'></span>";	
							//echo "22222";
						}
				}
			?>
			
		<? } ?>
		
	   </span>	
	   <? } ?>
	</h2>
	<?
	   for ($ic=0; $ic<count($categories); $ic++) {
	   if($ic==0){$none='';}else{$none='none';}
	?>

    <ul class="latest_<?=$bo_table?>_<?=$ic?>"  style="display:<?=$none?>">
    <?php
    $sql_chl_lis="select * from g5_write_$bo_table where ca_name = '".$categories[$ic]."'  order by wr_num, wr_reply limit 0, 5";
    $result_chl_lis = sql_query($sql_chl_lis);

    $k = 0;

    while ($row_chl_lis = sql_fetch_array($result_chl_lis))
    {
		$row_chl_lis['file'] = get_file($bo_table, $row_chl_lis['wr_id']);
		$file_img1 = $row_chl_lis['file'][0]['path'].'/'.$row_chl_lis['file'][0]['file'];
		$file_img2 = $row_chl_lis['file'][1]['path'].'/'.$row_chl_lis['file'][1]['file'];


    ?>
        <li>
			<div class="tab_lt_img">
            <span data-video-id="<?php echo $row_chl_lis['wr_link1'] ?>"><img src="<?php echo $file_img1?>"></span>
			</div>
			<div class="tab_lt_text">
				<div class="lt_text_top">
					<span class="chimg"><img src="<?php echo $file_img2?>"></span><span class="chname"><?php echo $row_chl_lis['wr_1']?></span>
				</div>
				<span class="lt_titles ellipsis03"><?php echo cut_str(get_text($row_chl_lis['wr_subject']), 40); ?>   </span>
				<span class="tab_lt_detail ellipsis02"><?php echo nl2br($row_chl_lis['wr_content']); ?></span>
				<!--<span class="tab_lt_date eng"><?php echo $row_chl_lis['wr_2'] ?></span>-->
				<span class="linc-new-video-button tab_btn tabLink pcBtn" data-video-id="<?php echo $row_chl_lis['wr_link1'] ?>">라이브 바로보기 <i class="xi-angle-right-thin"></i></span>
				<span class="linc-new-video-button tab_btn tabLink_mobile mobileBtn" data-video-id="<?php echo $row_chl_lis['wr_link1'] ?>"><i class="xi-eye-o"></i> 바로보기</span>
				
			</div>
        </li>
    <?php }  ?>
    <?php if (count($row_chl_lis) == 0) { //게시물이 없을 때  ?>
    <?php }  ?>
    </ul>
    <?php }  ?>
   
</div>
