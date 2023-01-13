<?php
$g5_path = "../../../.."; // common.php 의 상대 경로
include_once("$g5_path/common.php");

$page_no	= $_POST['page_no'];
$skin_dir	= $_POST['skin_dir'];
$bo_table			= $_POST['bo_table'];
$rows				= $_POST['rows'];
$subject_len        = $_POST['subject_len'];

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
<?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\" target='_blank'>";
            if ($list[$i]['is_notice']){?>
                <p class="">
				<?
                echo "<strong>".$list[$i]['subject']."</strong>";
				if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
				if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
				if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
				if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
				if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
				echo "<span>".$list[$i]['wr_content']."</span>";
				?>
				</p>
			<?}else{?>
                <p class="latest_line">
				<?
				echo "<strong>".$list[$i]['subject']."</strong>";
				if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
				if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
				if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
				if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
				if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
				echo "<br/>";
				echo "<span>".$list[$i]['wr_content']."</span>";
				?>
				</p>
			<?}

            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
             ?>
        </li>
<?php }  ?>



