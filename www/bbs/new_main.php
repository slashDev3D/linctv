<?php
include_once('./_common.php');

$new_skin_path = G5_SKIN_PATH.'/new/main'; // 스킨절대경로
$new_skin_url = G5_SKIN_URL.'/new/main'; // 스킨경로

$rows = 8; // 목록수

$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and b.bo_use_search = 1 ";
$gr_id = isset($_GET['gr_id']) ? $_GET['gr_id'] : "";

if ($gr_id) {
    $sql_common .= " and b.gr_id = '$gr_id'";
	
	
}

$sql_common .= " and b.gr_id <> 'linctv' "; //noview는 1에서 만든 그룹아이다


//$extable="'linctv01','linctv02','linctv03'"; //제외할 게시판
//$sql_common .= " and a.bo_table NOT IN($extable) "; //<---a. 추가


$view = isset($_GET['view']) ? $_GET['view'] : "";

if ($view == "w")
    $sql_common .= " and a.wr_id = a.wr_parent ";
else if ($view == "c")
    $sql_common .= " and a.wr_id <> a.wr_parent ";

$mb_id = isset($_GET['mb_id']) ? strip_tags($_GET['mb_id']) : "";
if ($mb_id) {
    $sql_common .= " and a.mb_id = '{$mb_id}' ";
}
$sql_order = " order by a.bn_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();

$sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id not in ('lincArea01','community') {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

    if ($row['wr_id'] == $row['wr_parent']) {

        // 원글
        $comment = "";
        $comment_link = "";
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;

        $name = get_sideview($row2['mb_id'], get_text(cut_str($row2['wr_name'], $config['cf_cut_name'])), $row2['wr_email'], $row2['wr_homepage']);
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row2['wr_datetime'],0,10);
        $datetime2 = $row2['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,5,5);
        }

    } else {

        // 코멘트
        $comment = '<span class=new_comment>[코]</span> ';
        $comment_link = '#c_'.$row['wr_id'];
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
        $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;
        $list[$i]['wr_id'] = $row['wr_id'];
        $list[$i]['mb_id'] = $row3['mb_id'];
        $list[$i]['wr_name'] = $row3['wr_name'];
        $list[$i]['wr_email'] = $row3['wr_email'];
        $list[$i]['wr_homepage'] = $row3['wr_homepage'];

        $name = get_sideview($row3['mb_id'], get_text(cut_str($row3['wr_name'], $config['cf_cut_name'])), $row3['wr_email'], $row3['wr_homepage']);
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row3['wr_datetime'],0,10);
        $datetime2 = $row3['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,5,5);
        }

    }

    $list[$i]['gr_id'] = $row['gr_id'];
    $list[$i]['bo_table'] = $row['bo_table'];
    $list[$i]['name'] = $name;
    $list[$i]['comment'] = $comment;
    $list[$i]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row2['wr_id'].$comment_link;
    $list[$i]['datetime'] = $datetime;
    $list[$i]['datetime2'] = $datetime2;

    $list[$i]['gr_subject'] = $row['gr_subject'];
    $list[$i]['bo_subject'] = $row['bo_subject'];
    $list[$i]['wr_subject'] = $row2['wr_subject'];
}

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?gr_id=$gr_id&amp;view=$view&amp;mb_id=$mb_id&amp;page=");

include_once($new_skin_path.'/new.skin.php');

?>