<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

    <?php for ($i=0; $i<2; $i++) { ?>
	<ul class="linc-new-video-button img_link" id="vimeo-559852356" data-video="559852356"  data-video-id='559852356' data-channel="vimeo">
							<img id="vimeo-559852356" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumb("559852356");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
								<?php echo $gr_subject ?><br><?php echo $bo_subject ?><br><?php echo $wr_subject ?>
						 </ul>
						 <?php echo $list[$i]['subject']?>

    <?php } ?>
  
