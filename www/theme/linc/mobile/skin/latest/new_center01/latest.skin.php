<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
    <?php
            for ($i=0; $i<count($list); $i++) {
            $thumb = get_list_thumbnail($list[$i]['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);
			$image = urlencode($list[$i][file][0][file]);
            if($list[$i]['icon_secret']) {
                $img = $latest_skin_url.'/img/sec.png';
            } else { 
                if($image) {
                    $img = '/data/file/'.$list[$i]['bo_table'].'/'.$image.'';

				} else if ($list[$i]['wr_10']){
					$img = 'https://img.youtube.com/vi/'.$list[$i]['wr_10'].'/0.jpg';
                } else {
                    $img = $latest_skin_url.'/img/noimg.png';
                    $thumb['alt'] = '이미지가 없습니다.';
                }
            }
            $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
            $wr_href = get_pretty_url($list[$i]['bo_table'], $list[$i]['wr_id']);
        ?>
	<ul class="linc-new-video-button img_link" data-video="<?php echo $list[$i]['wr_10']?>" style="background:url('<?php echo $img ?>')no-repeat center center;background-size:cover;" data-video-id='<?php echo $list[$i]['wr_10']?>'>
		<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
	</ul>
  <?php } ?>