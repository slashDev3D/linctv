<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/css/style.css">', 0);
$thumb_width = 600;
$thumb_height = 300;
$list_count = (is_array($list) && $list) ? count($list) : 0;

//본문 추출시 아래코드 적절한 위치에 추가
//$wr_content = preg_replace("/<(.*?)\>/","",$list[$i]['wr_content']);
//$wr_content = preg_replace("/&nbsp;/","",$wr_content);
//$wr_content = cut_str(get_text($wr_content),120);
//echo $wr_content;

?>
<style>
.lincprev-tab-<?php echo $bo_table ?> {position:absolute;cursor:pointer;top:25%;left:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}
.lincnext-tab-<?php echo $bo_table ?> {position:absolute;cursor:pointer;top:25%;right:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}

.swiper-pagination-<?php echo $bo_table ?> {
	position: absolute !important;
	top: -50px;
	right: 0px;
	width: auto !important;
	left: auto !important;
	margin: 0;
}

.swiper-pagination-<?php echo $bo_table ?> span {margin-left:4px;width:8px !important;height:8px !important}



.dm-dark .lincprev-tab-<?php echo $bo_table ?> {position:absolute;cursor:pointer;top:25%;left:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 0, 0, 0, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}
.dm-dark .lincnext-tab-<?php echo $bo_table ?> {position:absolute;cursor:pointer;top:25%;right:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 0, 0, 0, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}
.dm-dark .swiper-pagination-<?php echo $bo_table ?> span {margin-left:4px;width:8px !important;height:8px !important;background-color:#fff !important}


@media all and (max-width: 768px){
.swiper-pagination-<?php echo $bo_table ?> {}
}

</style>

<!-- Swiper 5.4.3 { -->
<script src="<?php echo $latest_skin_url ?>/js/swiper.js"></script>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/css/tab-swiper.css">
<!-- } -->

<div class="swiper-father-tab">
<div class="swiper-pagination-<?php echo $bo_table ?>"></div>

            
<div class="swiper-container swiper-container-slide-tab-<?php echo $bo_table ?>">
	
    <div class="swiper-wrapper">

        <?php
            for ($i=0; $i<count($list); $i++) {
            $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

            if($list[$i]['icon_secret']) {
                $img = $latest_skin_url.'/img/sec.png';
            } else { 
                if($thumb['src']) {
                    $img = $thumb['src'];

				} else if ($list[$i]['wr_10']){
					$img = 'https://img.youtube.com/vi/'.$list[$i]['wr_10'].'/0.jpg';
                } else {
                    $img = $latest_skin_url.'/img/noimg.png';
                    $thumb['alt'] = '이미지가 없습니다.';
                }
            }
            $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
            $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);

			$rankTab = $i + 1;
        ?>

        <div class="swiper-slide swiper-slide-slide">
			<div class="tab_ranking"><?php echo $rankTab ?></div>
            <div class="linc-new-video-button tab_slide_img" style="background-image:url('<?php echo $img ?>');background-size:cover;background-position:center center" data-video-id="<?php echo $list[$i]['wr_10'] ?>">
			</div>
			
            <?php if ($list[$i]['icon_new']) { ?>
                <div class="tab_slide_list_new">New</div>
            <?php } ?>
            <div class="tab_slide_gap">
                <ul>
                    <li class="tab_slide_title cut"><a href="<?php echo $wr_href; ?>"><?php echo $list[$i]['subject'] ?></a></li>
                </ul>
            </div>
        </div>
		

        <?php } ?>
     </div>
     
</div>

<div class="lincprev-tab-<?php echo $bo_table ?>"><i class="xi-angle-left"></i></div>
<div class="lincnext-tab-<?php echo $bo_table ?>"><i class="xi-angle-right"></i></div>

</div>


<!-- Initialize Swiper -->
<script>
	  var menu = ['', '', '', '', '', '', '', '', '', '']
      var swiper = new Swiper(".swiper-container-slide-tab-<?php echo $bo_table ?>", {
        slidesPerView: 2,
		slidesPerGroup : 2,
        spaceBetween: 10,
	    touchRatio: 1, // 드래그 가능여부(1, 0)
		loop:false,
		autoplay: {delay: 4000},
		

        pagination: {
		  el: '.swiper-pagination-<?php echo $bo_table ?>',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

		navigation: {
          nextEl: '.lincnext-tab-<?php echo $bo_table ?>',
          prevEl: '.lincprev-tab-<?php echo $bo_table ?>',
        },


        breakpoints: {
          640: {
            slidesPerView: 2,
			slidesPerGroup : 2,
            spaceBetween: 20,
			touchRatio: 1, // 드래그 가능여부(1, 0)
          },

          768: {
            slidesPerView: 4,
			slidesPerGroup : 4,
            spaceBetween: 20,
			touchRatio: 1, // 드래그 가능여부(1, 0)
          },

          1024: {
            slidesPerView: 4,
			slidesPerGroup : 4,
            spaceBetween: 30,
			touchRatio: 1, // 드래그 가능여부(1, 0)
          },

		 1280: {
            slidesPerView: 5,
			slidesPerGroup : 5,
            spaceBetween: 30,
			touchRatio: 1, // 드래그 가능여부(1, 0)
          },
        },
      });
</script>