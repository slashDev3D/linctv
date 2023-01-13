<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div id="new_lat">
    <strong class="lat_title"><?php if (!$is_comment) { ?><a href="<?php echo G5_BBS_URL ?>/new.php">최근 등록된 게시글</a><?php } else { ?><a href="<?php echo G5_BBS_URL ?>/new.php?view=c">최근 등록된 코멘트<?php } ?></a></strong>
    <div class="tbl_head_lt">
    <table>
    <?php
    $count = count($list);
    for ($i=0; $i<$count; $i++) {
        $bo_subject = mb_substr($list[$i]['bo_subject'],0,10,"utf-8"); // 게시판명 글자수
    ?>
    <tr>
        <td class="td_subject">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table'] ?>" class="lat_board_link">[<?php echo $bo_subject; ?>]</a> <a href="<?php echo $list[$i]['href']; ?>"><?php echo $list[$i]['wr_subject']?><?php if ($list[$i]['comment_cnt']) { ?><span class="new_cmt"><?php echo $list[$i]['comment_cnt']; ?></span><?php } ?></a>
            <?php
            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
            ?>
		</td>
        <td class="td_name"><?php echo $list[$i]['wr_name'] ?></td>
        <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
    </tr>
    <?php } ?>
    <?php if ($i == 0) echo '<tr><td colspan="3" class="empty_table">게시물이 없습니다.</td></tr>'; ?>
    </table>
    </div>
</div>
