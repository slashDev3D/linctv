<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width  = isset($options['thumb_width']) ? $options['thumb_width'] : $board['bo_gallery_width'];
$thumb_height = isset($options['thumb_height']) ? $options['thumb_height'] : $board['bo_gallery_height'];
$thumb_arrange = isset($options['thumb_arrange']) ? $options['thumb_arrange'] : "v";
//$box_width = isset($options['box_width']) ? $options['box_width'] : 280;

$thumb_width = abs($thumb_width) > 0 ? abs($thumb_width) : 240;
$thumb_height = abs($thumb_height) > 0 ? abs($thumb_height) : 180;
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div style="clear:both;width:<?php echo $box_width; ?>px;">
<div class="lt_box">

<div class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">편성표</a></div>
<!--
<div class="lt_table">

	<?php
	for ($i=0; $i<1; $i++) {
		$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height);
		if($thumb['ori']) {
			$img_content = '<img src="'.$thumb['ori'].'" alt="'.$thumb['alt'].'">';
		} else {
			if($thumb['ori']) {
				$img_content_ori = '<img src="'.$thumb['ori'].'" alt="'.$thumb['alt'].'">';
			} else {
				$img_content = '';
			}
		}
		if ($img_content) {
			?>
			<div class="ltimg"><a href="<?php echo $list[$i]['href']; ?>" class="lt_image"><?php echo $img_content; ?></a><br><span class="ltsubject"><?php echo $list[$i]['subject']?></span></div>
			<?php
		}
	}
	?>

<div class="ltlist">
<?php for ($i=0; $i<count($list); $i++) { ?>

	<div class="list">
		<?
		echo $list[$i][icon_reply] . "";
		echo "<a href='{$list[$i][href]}' class='ellipsis'>";
		if ($list[$i][is_notice])
			echo "<span style='color:#5A61B1;'><strong>{$list[$i][subject]}</strong></span>";
		else
			echo "<span>{$list[$i][subject]}</span>";
		echo "</a>";

		if ($list[$i][comment_cnt])
		echo " <a href=\"{$list[$i][comment_href]}\"><span style='font-size:8pt; color:#9A9A9A;'>{$list[$i][comment_cnt]}</span></a>";

		// if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
		// if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

		if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
		//if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
		//if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
		//if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
		//if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
		?>
		<span class="datetime eng"><?php echo $list[$i]['datetime2'] ?></span>
	</div>

<?php } ?>
</div>

<?php if(count($list) == 0){ ?>게시물이 없습니다.<? } ?>

</div>-->

</div>
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
