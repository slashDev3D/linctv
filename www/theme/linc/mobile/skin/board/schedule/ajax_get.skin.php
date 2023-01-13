<?php
//$g5_path = '../../..';
$g5_path = '../../../../../..';// 테마스킨으로 넣을 경우
include_once($g5_path.'/common.php');
if(!$bo_table) exit;
if($Ymd) {
	$mode = 3;
	$Ymd = $Ymd + 0;
}
$add_class = $yoil = array();
$yoil[1] = '월요일';
$yoil[2] = '화요일';
$yoil[3] = '수요일';
$yoil[4] = '목요일';
$yoil[5] = '금요일';
$yoil[6] = '토요일';
$yoil[7] = '일요일';
if(!$mode) $mode = 2;

$this_year = date("Y", G5_SERVER_TIME);
$this_month = date("m", G5_SERVER_TIME);
$this_day = date("d", G5_SERVER_TIME);
$this_yoilnum = date("N", G5_SERVER_TIME);
$this_weeknum = date("W", G5_SERVER_TIME);
$today = date('Ymd', G5_SERVER_TIME);
$end_i = 7;

if($mode == 1) { // 월요일부터 시작
	$k = 1; // 시작요일
	$tmp_day = $this_yoilnum - 1;
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24);
} else if($mode == 2) { // 어제 부터 시작
	$k = $this_yoilnum - 1;
	if(!$k) $k = 7;
	$tmp_day = 1;
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24);
	$end_i = 8;
} else if($mode == 3) { // 특정일/주 선택
	$k = 1;
	$select_time = strtotime($Ymd);
	$yoilnum = date("N", $select_time);
	$tmp_day = $yoilnum - 1;
	$start_time = $select_time-($tmp_day*60*60*24);
	$weeknum = date("W", $start_time);
}

$s_year = date("Y", $start_time);
$s_month = date("m", $start_time);
$s_day = date("d", $start_time);
$start_Ymd = date("Ymd", $start_time);
$end_Ymd = date("Ymd", $start_time + (7*60*60*24));
$sql_search = get_sql_search($sca, $sfl, $stx, $sop);
if($sql_search) $sql_search = ' and '.$sql_search;
$sql = "select wr_id, ca_name, wr_subject, wr_content, wr_1, wr_option from $write_table where wr_is_comment = 0 and wr_1 between '$start_Ymd' and '$end_Ymd' {$sql_search} order by wr_1";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
	unset($tmp_list);
		$html = 0;
	if (strstr($row['wr_option'], 'html1'))
		$html = 1;
	else if (strstr($row['wr_option'], 'html2'))
		$html = 2;
	$tmp_list['wr_id'] = $row['wr_id'];
	if($row['ca_name'])	$tmp_list['ca_name'] = '['.$row['ca_name'].'] ';
	$tmp_list['subject'] = conv_subject($row['wr_subject'], $board['bo_subject_len'], '…');
	if($board['bo_use_list_content']) $tmp_list['content'] = cut_str(conv_content($row['wr_content'], $html),50);
	$tmp_list['href'] = './board.php?bo_table='.$bo_table.'&wr_id='.$row['wr_id'];
	$info_list["{$row['wr_1']}"][] = $tmp_list;
}
$add_class[$today] .= ' today ';

for($i = 0; $i < $end_i; $i++) {
    if($k == 8) {
        $k = 1;
    }
    $Ymd = date("Ymd", $start_time+($i*60*60*24));
    if($k == 6) $add_class[$Ymd] .= ' blue ';
    if($k == 7) $add_class[$Ymd] .= ' red ';
    if($Ymd < $today) $add_class[$Ymd] .= ' past';
?>
    <dl class="<?php echo $add_class[$Ymd] ?>" id="board_week_<?php echo $bo_table ?>">
        <dt>
            <?php echo $yoil[$k] ?>
            <p><?php echo date("y.m.d", $start_time+($i*60*60*24)); ?></p>
        </dt>
        <dd class="info_list">
            <?php if($info_list[$Ymd]) { foreach ($info_list[$Ymd] as $v) { ?>
            <ul>
                <li>
                    <?php if ($is_admin) { ?>
                    <label for="chk_wr_id_<?php echo $v['wr_id'] ?>" class="sound_only"><?php echo $v['subject'] ?></label>
                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $v['wr_id'] ?>" id="chk_wr_id_<?php echo $v['wr_id'] ?>">
                    <?php } ?>
                    ㅇ <a href="<?php echo $v['href'] ?>"><?php echo $v['ca_name'].$v['subject'] ?></a>
                    <span><?php echo $v['content'] ?></span>
                </li>
            </ul>
            <?php } } // end foreach, end if ?>
        </dd>
        <div style="clear:both"></div>
    </dl>
<?php
    $k++;
} // end for
?>
<script>
<?php
echo 'var lastweek_'.$bo_table.' = '.date("Ymd", mktime(0,0,0, $s_month, $s_day-7, $s_year)).';';
echo 'var nextweek_'.$bo_table.' = '.date("Ymd", mktime(0,0,0, $s_month, $s_day+7, $s_year)).';';
?>
</script>
