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

.swiper-pagination-new-pc {
	position: absolute !important;
	top: -40px;
	right: 0px;
	width: auto !important;
	left: auto !important;
	margin: 0;
}
.swiper-pagination-new-pc span {margin-left:4px}

.swiper-pagination-new-mobile {
	position: absolute !important;
	top: -40px;
	right: 0px;
	width: auto !important;
	left: auto !important;
	margin: 0;
}
.swiper-pagination-new-mobile span {margin-left:4px}



.swiper-father-new {
  position: relative;
}


.dm-dark .swiper-pagination-new span {margin-left:4px;background-color:#fff !important}

</style>

<!-- 전체게시물 목록 시작 { -->
<div class="swiper-father-new">

	<div id="pcNew">
	<div class="swiper-pagination-new-pc"></div>
		<div class="swiper-container swiper-container-slide-new-pc">
			<div class="swiper-wrapper">
				 <div class="swiper-slide swiper-slide-slide">
					<div class="mainnewWrap">
						<div class="sideLeft">
						 <ul class="linc-new-video-button img_link" id="vimeo-559852356" data-video="559852356"  data-video-id='559852356' data-channel="vimeo">
							<img id="vimeo-559852356" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumb("559852356");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
								
						 </ul>
						 <ul class="linc-new-video-button img_link" id="vimeo-559832364" data-video="559832364" data-video-id='559832364' data-channel="vimeo">
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
							<ul class="linc-new-video-button img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;" data-video-id='K6LPkZpim00'>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>

						<div class="sideRight">
						 <ul class="linc-new-video-button img_link" id="vimeo-559832314" data-video="559832314" data-video-id='559832314' data-channel="vimeo">
							<img id="vimeo-559832314" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumb("559832314");
											});
											</script>       
						 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>

						  <ul class="linc-new-video-button img_link" id="vimeo-559832288" data-video="559832288" data-video-id='559832288' data-channel="vimeo">
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
						 <ul class="linc-new-video-button img_link" id="vimeo-559832214" data-video="559832214" data-video-id='559832214' data-channel="vimeo">
							<img id="vimeo-559832214" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumb("559832214");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
								
						 </ul>
						 <ul class="linc-new-video-button img_link" id="vimeo-559832135" data-video="559832135" data-video-id='559832135' data-channel="vimeo">
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
							<ul class="linc-new-video-button img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;" data-video-id='K6LPkZpim00'>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>

						<div class="sideRight">
						 <ul class="linc-new-video-button img_link" id="vimeo-559832080" data-video="559832080" data-video-id='559832080' data-channel="vimeo">
							<img id="vimeo-559832080" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumb("559832080");
											});
											</script>       
						 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>

						  <ul class="linc-new-video-button img_link" id="vimeo-559832029" data-video="559832029" data-video-id='559832029' data-channel="vimeo">
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


	<div id="mobileNew">
		<div class="swiper-pagination-new-mobile"></div>
		<div class="swiper-container swiper-container-slide-new-mobile">
			<div class="swiper-wrapper">

				 <div class="swiper-slide swiper-slide-slide">
					<div class="mainnewWrap">

						<div class="sideCenter">
							<ul class="linc-new-video-button img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;" data-video-id='K6LPkZpim00'>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>


						<div class="sideLeft">
						
						 <ul class="linc-new-video-button img_link" id="vimeos-559852356" data-video="559852356"  data-video-id='559852356' data-channel="vimeo">
							<img id="vimeo-559852356" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559852356");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
								
						 </ul>
						
						 <ul class="linc-new-video-button img_link" id="vimeos-559832364" data-video="559832364" data-video-id='559832364' data-channel="vimeo">
							<img id="vimeo-559832364" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832364");
											});
											</script>  
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>

						<div class="sideRight">
						 <ul class="linc-new-video-button img_link" id="vimeos-559832314" data-video="559832314" data-video-id='559832314' data-channel="vimeo">
							<img id="vimeo-559832314" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832314");
											});
											</script>       
						 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>

						  <ul class="linc-new-video-button img_link" id="vimeos-559832288" data-video="559832288" data-video-id='559832288' data-channel="vimeo">
							<img id="vimeo-559832288" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832288");
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

						<div class="sideCenter">
							<ul class="linc-new-video-button img_link" data-video="K6LPkZpim00" style="background:url('https://img.youtube.com/vi/K6LPkZpim00/0.jpg')no-repeat center center;background-size:cover;" data-video-id='K6LPkZpim00'>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>


						<div class="sideLeft">
						 <ul class="linc-new-video-button img_link" id="vimeos-559832214" data-video="559832214" data-video-id='559832214' data-channel="vimeo">
							<img id="vimeo-559832214" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832214");
											});
											</script>
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
								
						 </ul>
						 <ul class="linc-new-video-button img_link" id="vimeos-559832135" data-video="559832135" data-video-id='559832135' data-channel="vimeo">
							<img id="vimeo-559832135" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832135");
											});
											</script>  
							<span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>
						</div>
						<div class="sideRight">
						 <ul class="linc-new-video-button img_link" id="vimeos-559832080" data-video="559832080" data-video-id='559832080' data-channel="vimeo">
							<img id="vimeo-559832080" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832080");
											});
											</script>       
						 <span class="playon"><img src="<?php echo G5_IMG_URL ?>/playon.png"></span>
						 </ul>

						  <ul class="linc-new-video-button img_link" id="vimeos-559832029" data-video="559832029" data-video-id='559832029' data-channel="vimeo">
							<img id="vimeo-559832029" style="display:none"/>
											<script>
											$(function() {
												vimeoLoadingThumbMobile("559832029");
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

</div>



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
		function vimeoLoadingThumbMobile(id){    
			var urls = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumbMobile";
			  
			var id_imgs = "#vimeos-" + id;
			var scripts = document.createElement( 'script' );
			scripts.type = 'text/javascript';
			scripts.src = urls;

			$(id_imgs).before(scripts);
		}

		function showThumbMobile(data){
			var id_imgs = "#vimeos-" + data[0].id;
			//$(id_img).attr('src',data[0].thumbnail_large);
			var idimgs = $(id_imgs).attr('src',data[0].thumbnail_large);
			var srcs = $(idimgs).attr("src");
			//console.log(src);

			// var getImageSrc = id_img;
			// style background image
			$(id_imgs).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + srcs + ')'
			});

		}

  </script>


<script>
var menu = ['', '', '']
var swiper = new Swiper('.swiper-container-slide-new-pc', {
     
        slidesPerView: 1, // 가로갯수
        spaceBetween: 30, // 간격
        touchRatio: 1, // 드래그 가능여부(1, 0)
		slidesPerGroup : 1,
        autoplay: {
            delay: 4000 // 자동롤링 딜레이 (1000 = 1초)
       },

		 pagination: {
		  el: '.swiper-pagination-new-pc',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

        breakpoints: { // 반응형 처리
            1280: {
                slidesPerView: 1,
				slidesPerGroup : 1,
                spaceBetween: 30,
            },

            1024: {
               
                slidesPerView: 1, // 가로갯수
				spaceBetween: 30, // 간격
				touchRatio: 1, // 드래그 가능여부(1, 0)
				slidesPerGroup : 1,
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


<script>
var menu = ['', '', '']
var swiper = new Swiper('.swiper-container-slide-new-mobile', {
     
        slidesPerView: 1, // 가로갯수
        spaceBetween: 30, // 간격
        touchRatio: 1, // 드래그 가능여부(1, 0)
		slidesPerGroup : 1,
        autoplay: {
            delay: 4000 // 자동롤링 딜레이 (1000 = 1초)
       },

		 pagination: {
		  el: '.swiper-pagination-new-mobile',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

        breakpoints: { // 반응형 처리
            1280: {
                slidesPerView: 1,
				slidesPerGroup : 1,
                spaceBetween: 30,
            },

            1024: {
               
                slidesPerView: 1, // 가로갯수
				spaceBetween: 30, // 간격
				touchRatio: 1, // 드래그 가능여부(1, 0)
				slidesPerGroup : 1,
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