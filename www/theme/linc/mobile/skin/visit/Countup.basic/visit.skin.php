<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$visit_skin_url.'/style.css">', 0);
?>

<!-- 접속자집계 시작 { -->
<aside id="visit">
    <ul>
        <li class=tod>
            <b>오늘</b>
            <span class="counter eng" data-count="<?php echo $visit[1] ?>">0</span>
        </li>
        <li class="tot">
            <b>전체</b>
            <span class="counter eng" data-count="<?php echo $visit[4] ?>">0</span>
        </li>
    </ul>

    <!--
    <dl>
        <dt>오늘</dt>
        <dd class="counter eng" data-count="<?php echo $visit[1] ?>">0</dd>
        <dt>어제</dt>
        <dd class="counter" data-count="<?php echo $visit[2] ?>">0</dd>
        <dt>최대</dt>
        <dd class="counter" data-count="<?php echo $visit[3] ?>">0</dd>
        <dt>전체</dt>
        <dd class="counter eng" data-count="<?php echo $visit[4] ?>">0</dd>
    </dl>
    -->

</aside>

<script src="<?=$visit_skin_url?>/increment-numeric-counter/counter.js"></script>
<script>
$(document).ready(function(){

	  $('.counter').each(function() {
	    var $this = $(this),
	        countTo = $this.attr('data-count');

	    $({ countNum: $this.text()}).animate({
	      countNum: countTo
	    },

	    {

	      duration: 3000,
	      easing:'linear',
	      step: function() {
	        $this.text(Math.floor(this.countNum));
	      },
	      complete: function() {
	        $this.text(this.countNum);
	      }
	    });
	  });

	});
</script>