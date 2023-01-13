<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<?php for ($i=4; $i<6; $i++) { ?>
 <ul class="linc-new-video-button img_link" id="vimeos-<?php echo $list[$i]['wr_10']?>" data-video="<?php echo $list[$i]['wr_10']?>" data-video-id='<?php echo $list[$i]['wr_10']?>' data-channel="vimeo">
							<img id="vimeo-<?php echo $list[$i]['wr_10']?>" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("<?php echo $list[$i]['wr_10']?>");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>	
 </ul>
<?php } ?>