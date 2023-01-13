<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
//$wr_3 = "$option1[0],$option1[1],$option1[2]"; // 옵션1
$wr_3 = "$option1[0]|$option1[1]|$option1[2]"; // 옵션2
sql_query("update $write_table set wr_3 = '$wr_3' where wr_id = '$wr_id'");

alert("update $write_table set wr_3 = '$wr_3' where wr_id = '$wr_id'");
?>

