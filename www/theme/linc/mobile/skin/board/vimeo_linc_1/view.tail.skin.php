<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
//echo $bo_table;
//echo latest('theme/slide_thumb', $bo_table, 100, 99);
?>

<div class="view_latest">
<h2>전체회차 <span class="en"><?php echo $board['bo_count_write']; ?></span>화</h2>

    <ul class="tabs">
        <li class="active" rel="tab1">최신 컨텐츠</li>
		
        <li rel="tab2">첫회부터</li>
    </ul>

    <div class="tab_container">
        <div id="tab1" class="tab_content"><?php echo latest_multi("theme/slide_thumb_vimeo", $bo_table, 100, 99, 0, "last_desc"); ?></div>
        <div id="tab2" class="tab_content"><?php echo latest_multi("theme/slide_thumb_vimeo_latest", $bo_table, 100, 99, 0, "last_asc"); ?></div>
    </div>

</div>



<script>

	$(function () {
		$(".tab_content").hide();
		$(".tab_content:first").show();
		$("ul.tabs li:first").addClass("active").css("color", "#000");

		$("ul.tabs li").click(function () {
			$("ul.tabs li").removeClass("active").css("color", "#999");
			//$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
			$(this).addClass("active").css("color", "#000");
			$(".tab_content").hide();
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn();
		});
	});


    var swiper = new Swiper('.swiper-container-slide', {
        slidesPerColumnFill: 'row',
        slidesPerView: 2, // 가로갯수
        slidesPerColumn: 3, // 세로갯수
        spaceBetween: 30, // 간격
		observer:true,
		observeParents:true,
		//slidesPerGroup: 6,
        touchRatio: 1, // 드래그 가능여부(1, 0)
        //autoplay: {
            //delay: 4000 // 자동롤링 딜레이 (1000 = 1초)
       // },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },

        breakpoints: { // 반응형 처리
            1280: {
                slidesPerColumnFill: 'row',
                slidesPerView: 2,
                slidesPerColumn: 3,
				observer:true,
				observeParents:true,
				slidesPerGroup: 2,
                spaceBetween: 30
            },
            1024: {
                slidesPerColumnFill: 'row',
                slidesPerView: 2,
                slidesPerColumn: 3,
                spaceBetween: 30
            },
            768: {
                slidesPerColumnFill: 'row',
                slidesPerView: 2,
                slidesPerColumn: 3,
                spaceBetween: 30
            },
            480: {
                slidesPerColumnFill: 'row',
                slidesPerView: 2,
                slidesPerColumn: 3,
                spaceBetween: 20
            },
            10: {
                slidesPerColumnFill: 'row',
                slidesPerView: 1,
                slidesPerColumn: 3,
                spaceBetween: 20
            }
        }

    });
</script>