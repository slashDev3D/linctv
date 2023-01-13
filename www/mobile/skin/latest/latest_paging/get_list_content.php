<?php
$g5_path = "../../.."; // common.php 의 상대 경로
include_once("$g5_path/common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$page_no	= $_POST['page_no'];
$skin_dir	= $_POST['skin_dir'];
$bo_table			= $_POST['bo_table'];
$rows				= $_POST['rows'];
$subject_len        = $_POST['subject_len'];

$thumb_width = 148;
$thumb_height = 108;

$limit = (($page_no - 1) * $rows);
    if(G5_IS_MOBILE) {
        $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
    } else {
        $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
        $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
    }
$list = array();

$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

$sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit $limit, $rows ";

$result = sql_query($sql);

for ($i=0; $row = sql_fetch_array($result); $i++) {
    $list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);
}
?>
<?php for ($i=0; $i<count($list); $i++) {
	//$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height);

    if($thumb['src']) {
        $img = $thumb['src'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
?>
        <li>
            <?php
            echo "<a href=\"".$list[$i]['href']."\">";
			if ($list[$i]['is_notice']){?>
				<p class="img_box"><?php echo $img_content; ?></p>
                <p class="latest_line txt_box">
				<?
                echo "<strong>".$list[$i]['subject']."</strong>";
				?>
				</p>
				<p class="latest_more_view"><img src="<?php echo G5_THEME_IMG_URL;?>/ico_latest_more_view.png" alt=""></p>
			<?}else{?>
                <p class="img_box"><?php echo $img_content; ?></p>
                <p class="latest_line txt_box">
				<?
				echo "<strong>".$list[$i]['subject']."</strong>";
				?>
				</p>
				<p class="latest_more_view"><img src="<?php echo G5_THEME_IMG_URL;?>/ico_latest_more_view.png" alt=""></p>
			<?}
            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];

            echo "</a>";
             ?>
        </li>
<?php }  ?>



