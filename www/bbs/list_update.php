<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
alert($_POST['chk_wr_id']);
if(!$is_admin)
    alert('접근 권한이 없습니다.', G5_URL);
    //$list_count = $_POST['list_count'];
	$count = count($_POST['chk_wr_id']);
    for ($i=0; $i<=$count; $i++){
      $wr_id = $_POST['chk_wr_id'][$i];
       $wr_5 = $_POST['wr_5'][$i];
		// $wr_id = $_POST['chk_wr_id_'][$i];
        // $wr_1 = $_POST['wr_1'];
        $sql = " update $write_table set wr_5 = '$wr_5' where wr_id='$wr_id' ";
        $result = sql_query($sql);
    }
  alert($sql);
  goto_url('./board.php?bo_table='.$bo_table.'&subject='.$subject.'&page='.$page.$qstr); 
?>