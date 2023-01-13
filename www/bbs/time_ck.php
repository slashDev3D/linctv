<?php
include_once('./_common.php');



$wr_2     = trim($_REQUEST['wr_2']);
$bo_table = trim($_REQUEST['bo_table']);
//echo $wr_1.$wr_2.$bo_table;

    $sql = " SELECT * FROM  `g5_write_".$bo_table."` WHERE  `wr_1` = '".$wr_1."' AND  `wr_2` =  '".$wr_2."' ";
    $row = sql_fetch($sql);

   if($row[wr_id]){
     echo "y";
   }else{
     echo "n";   
   }


?>