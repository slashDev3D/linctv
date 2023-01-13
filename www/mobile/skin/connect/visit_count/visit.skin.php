<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$visit_skin_url.'/style.css">', 0);
?>

<!-- 접속자집계 시작 { -->
<section id="visit">
    <h2><i class="fa fa-users" aria-hidden="true"></i>  접속자집계</h2>
    <dl>
        <dt><span class="color_1"></span> 오늘</dt>
        <dd><strong class="color_1" id="countup1"></strong></dd>
        <dt><span class="color_2"></span> 어제</dt>
        <dd><strong class="color_2" id="countup2"></strong></dd>
        <dt><span class="color_3"></span> 최대</dt>
        <dd><strong class="color_3" id="countup3"></strong></dd>
        <dt><span class="color_4"></span> 전체</dt>
        <dd><strong class="color_4" id="countup4"></strong></dd>
    </dl>
    <?php if ($is_admin == "super") {  ?><a href="<?php echo G5_ADMIN_URL ?>/visit_list.php" class="btn_admin">상세보기</a><?php } ?>
</section>

<script src="<?=G5_URL?>/js/countUp.min.js"></script>
<script>
var options = {
    useEasing: true, 
    useGrouping: true, 
    separator: ',', 
    decimal: '.', 
};
var countup1 = new CountUp('countup1', 0, <?php echo number_format($visit[1]) ?>, 0, 2.5,options);
countup1.start();
var countup2 = new CountUp('countup2', 0, <?php echo number_format($visit[2]) ?>, 0, 2.5,options);
countup2.start();
var countup3 = new CountUp('countup3', 0, <?php echo number_format($visit[3]) ?>, 0, 2.5,options);
countup3.start();
var countup4 = new CountUp('countup4', 0, <?php echo number_format($visit[4]) ?>, 0, 2.5,options);
countup4.start();
</script>
<!-- } 접속자집계 끝 -->