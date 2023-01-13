<?php
$base_filename = basename($_SERVER['PHP_SELF']);
if($base_filename == 'register.php')
  alert("현재 회원가입이 불가능합니다..", G5_URL);
?>