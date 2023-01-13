<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
// 선택삭제으로 인해 셀합치기가 가변적으로 변함
$colspan = 4;
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$new_skin_url.'/style.css">', 0);
?>

<!-- Swiper 5.4.3 { -->
<script src="<?php echo $new_skin_url ?>/js/swiper.js"></script>
<link rel="stylesheet" href="<?php echo $new_skin_url ?>/css/swiper.css">
<!-- } -->

<style>
.lincprev-new {position:absolute;cursor:pointer;top:25%;left:-20px;z-index:999;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}
.lincnext-new {position:absolute;cursor:pointer;top:25%;right:-20px;z-index:999;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}

.swiper-pagination-new {
	position: absolute !important;
	top: -40px;
	right: 0px;
	width: auto !important;
	left: auto !important;
	margin: 0;
}
.swiper-pagination-new span {margin-left:4px}


.swiper-father-new {
  position: relative;
}


.dm-dark .swiper-pagination-new span {margin-left:4px;background-color:#fff !important}
</style>

<!-- 전체게시물 목록 시작 { -->
<div class="swiper-father-new">
<div class="swiper-pagination-new"></div>

<div class="swiper-container swiper-container-slide-new">
<div class="swiper-wrapper">


	 <div class="swiper-slide swiper-slide-slide">
		<div class="mainnewWrap">
			<div class="sideLeft">
			 <ul class="popyt mov_b2 img_link" id="vimeo-559852356" data-video="559852356">
				<img id="vimeo-559852356" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559852356");
								});
								</script>
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
					
			 </ul>
			 <ul class="popyt mov_b2 img_link" id="vimeo-559832364" data-video="559832364">
				<img id="vimeo-559832364" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832364");
								});
								</script>  
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>

			<div class="sideCenter">
				<ul class="popyt_youtube mov_b2 img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;">
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>

			<div class="sideRight">
			 <ul class="popyt mov_b2 img_link" id="vimeo-559832314" data-video="559832314">
				<img id="vimeo-559832314" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832314");
								});
								</script>       
			 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>

			  <ul class="popyt mov_b2 img_link" id="vimeo-559832288" data-video="559832288">
				<img id="vimeo-559832288" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832288");
								});
								</script>
                               
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>
		</div>
	</div>

	<!--두번째 슬라이드 시작-->


	 <div class="swiper-slide swiper-slide-slide">
		<div class="mainnewWrap">
			<div class="sideLeft">
			 <ul class="popyt mov_b2 img_link" id="vimeo-559832214" data-video="559832214">
				<img id="vimeo-559832214" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832214");
								});
								</script>
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
					
			 </ul>
			 <ul class="popyt mov_b2 img_link" id="vimeo-559832135" data-video="559832135">
				<img id="vimeo-559832135" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832135");
								});
								</script>  
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>

			<div class="sideCenter">
				<ul class="popyt_youtube mov_b2 img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;">
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>

			<div class="sideRight">
			 <ul class="popyt mov_b2 img_link" id="vimeo-559832080" data-video="559832080">
				<img id="vimeo-559832080" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832080");
								});
								</script>       
			 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>

			  <ul class="popyt mov_b2 img_link" id="vimeo-559832029" data-video="559832029">
				<img id="vimeo-559832029" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("559832029");
								});
								</script>
                               
				<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
			 </ul>
			</div>
		</div>
	 </div>



</div>
</div>

</div>


	<!-- 팝업 레이어 -->
    <div class="video-popup" id="video-popup-closer2">
        <div class="video-popup-closer" id="video-popup-closer2"></div>
    </div>
    <!-- 팝업 레이어 -->

	<!-- 팝업 레이어 -->
    <div class="video-popup_youtube" id="video-popup-closer3">
        <div class="video-popup-closer3" id="video-popup-closer2"></div>
    </div>
    <!-- 팝업 레이어 -->
    
    
		<!-- 스크립트 -->
		<script>
			$(".popyt").click(function() {
				$(".video-popup").addClass("reveal"),
					$(".video-popup .video-wrapper").remove(),
					$(".video-popup").append("<div class='video-wrapper'><div class='video-wrapper_div2'><div class='video-wrapper_div'><div class='close_vimeo'><i class='fa fa-times' aria-hidden='true'></i></div><iframe width='1000' height='563' src='https://player.vimeo.com/video/" + $(this).data("video") + "?rel=0&playsinline=1&autoplay=0' allow='accelerometer; gyroscope; picture-in-picture; encrypted-media' allowfullscreen style='position: absolute; width:100%; height:100%;'></iframe></div></div></div>")
			})

		</script>
		<script>
			$(".video-popup-closer").click(function() {
				$(".video-popup .video-wrapper").remove(),
					$(".video-popup").removeClass("reveal")
			});

			$("#video-popup-closer2").click(function() {
				$(".video-popup .video-wrapper").remove(),
					$(".video-popup").removeClass("reveal")
			});

		</script>
		<!-- //스크립트 -->


		<!-- 스크립트 -->
		<script>
			$(".popyt_youtube").click(function() {
				$(".video-popup_youtube").addClass("reveal"),
					$(".video-popup_youtube .video-wrapper").remove(),
					$(".video-popup_youtube").append("<div class='video-wrapper'><div class='video-wrapper_div2'><div class='video-wrapper_div'><div class='close_vimeo'><i class='fa fa-times' aria-hidden='true'></i></div><iframe width='1000' height='563' src='https://www.youtube.com/embed/" + $(this).data("video") + "?rel=0&playsinline=1&autoplay=0' allow='accelerometer; gyroscope; picture-in-picture; encrypted-media' allowfullscreen style='position: absolute; width:100%; height:100%;'></iframe></div></div></div>")
			})

		</script>
		<script>
			$(".video-popup-closer3").click(function() {
				$(".video-popup_youtube .video-wrapper").remove(),
					$(".video-popup_youtube").removeClass("reveal")
			});

			$("#video-popup-closer2").click(function() {
				$(".video-popup_youtube .video-wrapper").remove(),
					$(".video-popup_youtube").removeClass("reveal")
			});

		</script>
		<!-- //스크립트 -->

  <script>
		function vimeoLoadingThumb(id){    
			var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb";
			  
			var id_img = "#vimeo-" + id;
			var script = document.createElement( 'script' );
			script.type = 'text/javascript';
			script.src = url;

			$(id_img).before(script);
		}

		function showThumb(data){
			var id_img = "#vimeo-" + data[0].id;
			//$(id_img).attr('src',data[0].thumbnail_large);
			var idimg = $(id_img).attr('src',data[0].thumbnail_large);
			var src = $(idimg).attr("src");
			//console.log(src);

			// var getImageSrc = id_img;
			// style background image
			$(id_img).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + src + ')'
			});

		}

		</script>


<script>
var menu = ['', '', '']
var swiper = new Swiper('.swiper-container-slide-new', {
     
        slidesPerView: 1, // 가로갯수
        spaceBetween: 30, // 간격
        touchRatio: 1, // 드래그 가능여부(1, 0)
		slidesPerGroup : 1,
        autoplay: {
            delay: 4000 // 자동롤링 딜레이 (1000 = 1초)
        },

        // If we need pagination
		 pagination: {
		  el: '.swiper-pagination-new',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

		/*******
		 navigation: {
          nextEl: '.lincnext-new',
          prevEl: '.lincprev-new',
        },
		*/
			

        breakpoints: { // 반응형 처리
            1280: {
                slidesPerView: 1,
				slidesPerGroup : 1,
                spaceBetween: 30
            },
            1024: {
               
                slidesPerView: 3,
               
                spaceBetween: 30
            },
            768: {
               
                slidesPerView: 2,
              
                spaceBetween: 30
            },
            480: {
       
                slidesPerView: 2,
              
                spaceBetween: 20
            },
            10: {
             
                slidesPerView: 1,
             
                spaceBetween: 20
            }
        }



    });


</script>