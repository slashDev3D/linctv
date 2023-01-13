<?php
//include_once('../../../../common.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/common.php');
$write_table = $g5['write_prefix'] . $bo_table;
//$result = sql_query(" update {$write_table} set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ");
//echo " update {$write_table} set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ";
$result = sql_query(" update {$write_table} set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ");
//echo $result;
?>
