<?php
include_once('./_common.php');

$count = (isset($_POST['chk_wr_id']) && is_array($_POST['chk_wr_id'])) ? count($_POST['chk_wr_id']) : 0;
$post_btn_submit = isset($_POST['btn_submit']) ? clean_xss_tags($_POST['btn_submit'], 1, 1) : '';

if(!$count) {
    alert(addcslashes($post_btn_submit, '"\\/').' 하실 항목을 하나 이상 선택하세요.');
}

if($post_btn_submit === '선택삭제') {
    include './delete_all.php';
} else if($post_btn_submit === '선택복사') {
    $sw = 'copy';
    include './move.php';
} else if($post_btn_submit === '선택이동') {
    $sw = 'move';
    include './move.php';

} else if($_POST['btn_submit'] == '승인완료') { // 추가되는 소스

    $wr_id_list = '';
    if ($wr_id)
        $wr_id_list = $wr_id;
    else {
        $comma = '';
        for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
            $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
            $comma = ',';
        }
    }

    $wr_id_list = preg_replace('/[^0-9\,]/', '', $wr_id_list);
    $sql = " update $write_table set wr_5 = 'Y' where wr_id in ({$wr_id_list}) ";

    sql_query($sql);

    alert('완료 되었습니다');


	} else if($_POST['btn_submit'] == '승인취소') { // 추가되는 소스

	$wr_id_list = '';
    if ($wr_id)
        $wr_id_list = $wr_id;
    else {
        $comma = '';
        for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
            $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
            $comma = ',';
        }
    }
    $wr_id_list = preg_replace('/[^0-9\,]/', '', $wr_id_list);
    $sql = " update $write_table set wr_5 = 'N' where wr_id in ({$wr_id_list}) ";

    sql_query($sql);

    alert('완료 되었습니다');


} else if($_POST['btn_submit'] == '순위입력') { // 추가되는 소스


	$wr_id_list = '';
	$wr_6 = '';

		if ($wr_id)
			$wr_id_list = $wr_id;
		else {
			$comma = '';

			for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
				$wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
				$comma = ',';
			}
		}

		if ($wr_6)

			$wr_6_list = $wr_6;

		else {
			$wr_6comma = '';
			for ($j=0; $j<count($_POST['wr_6']); $j++) {

				$wr_6_list .= $comma . $_POST['wr_6'][$i];
				$comma = ',';

	

			}
		}

	
		$wr_id_list = preg_replace('/[^0-9\,]/', '', $wr_id_list);
		$wr_6_list = preg_replace('/[^0-9\,]/', '', $wr_6_list);
		//$wr_6 = implode(',', $wr_6_list);

		$sql = " update $write_table set wr_6 in ({$wr_6_list}) where wr_id in ({$wr_id_list}) ";

		sql_query($sql);

		echo $sql;

		alert('완료 되었습니다');


/*
for ($i=0; $i<count($_POST['chk_wr_id']); $i++){ 
        $k = $_POST['chk_wr_id'][$i]; 
        $j = $_POST['wr_6'][$i]; 
      
        $sql = " update $write_table set wr_6='$j' where wr_id='$k' "; 
		//$sql = " update $write_table set wr_6='$_POST[wr_6][$i]', wr_16='$_POST[wr_16][$i]' where wr_id='$_POST[chk_wr_id][$i]' "; 
        $result = sql_query($sql); 
		echo $sql;
    } 
	*/
} else {
    alert('올바른 방법으로 이용해 주세요.');
}
?>