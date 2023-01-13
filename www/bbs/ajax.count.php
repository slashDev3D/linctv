<?php
include_once('./_common.php');
//sql_query(" update $write_table set wr_hit = wr_hit + 1 where wr_id = '$wr_id' ");
//alert('aaa'); // 보내는 경로가 메인인 경우 G5_URL

sql_query("update g5_write_university02_test  set wr_hi = wr_hit + 1 where wr_id = '{$_POST['wr_id']}'");
alert(sql_query);
   // $sql = "update g5_write_university02_test set
          //  wr_hit = '".$_POST['idx'][1]."'
           // where wr_id = '".$_POST['idx'][0]."'";

    //sql_query($sql);

   // echo json_encode($sql);
?>