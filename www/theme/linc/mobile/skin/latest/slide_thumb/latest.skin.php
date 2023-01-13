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
.lincprevlincevent {position:absolute;cursor:pointer;top:35%;left:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}
.lincnextlincevent {position:absolute;cursor:pointer;top:35%;right:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}
.swiper-pagination-lincevent {
	position: relative !important;
	bottom: -14px;
	right: auto !important;
	left: auto !important;
	width: 100% !important;
	text-align:center;
	margin: 0;
}
.swiper-pagination-lincevent span {margin-left:4px}
.swiper-father-lincevent {
  position: relative;
  border:0px solid red;
}
.dm-dark .lincprevlincevent {position:absolute;cursor:pointer;top:35%;left:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 0, 0, 0, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}
.dm-dark .lincnextlincevent {position:absolute;cursor:pointer;top:35%;right:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 0, 0, 0, 0.8 );text-align:center;font-size:16px;color:#ccc;border-radius:40px !important}
.dm-dark .swiper-pagination-lincevent span {margin-left:4px;background-color:#fff !important}


@media all and (max-width: 768px){

.lincprevlincevent {position:absolute;cursor:pointer;top:23%;left:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}
.lincnextlincevent {position:absolute;cursor:pointer;top:23%;right:-20px;z-index:90;width:40px !important;height:40px !important;line-height:40px !important;background-color: rgba( 255, 255, 255, 1 );text-align:center;font-size:16px;color:#666;border-radius:40px !important;border:1px solid #ddd}

}
</style>


<!-- Swiper 5.4.3 { -->
<script src="<?php echo $latest_skin_url ?>/js/swiper.js"></script>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/css/swiper.css">
<!-- } -->


<h2 class="mainTitle"><a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_title eng" style="font-weight:700">EVENT</a></h2>

<div class="swiper-father-lincevent">

<div class="swiper-container swiper-container-slide-lincevent">
<div class="swiper-wrapper">

        <?php
            for ($i=0; $i<$list_count; $i++) {
            $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

            if($list[$i]['icon_secret']) {
                $img = $latest_skin_url.'/img/sec.png';
            } else { 
                if($thumb['ori']) {
                    $img = $thumb['ori'];
                } else {
                    $img = $latest_skin_url.'/img/noimg.png';
                    $thumb['alt'] = '이미지가 없습니다.';
                }
            }
            $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
            $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
        ?>

        <div class="swiper-slide swiper-slide-slide eventimage">
            <a href="<?php echo $wr_href; ?>" style="border-radius:7px;display:block;background:url('<?php echo $thumb['ori']?>')no-repeat center center;background-size:cover;"></a>            
            <?php if ($list[$i]['icon_new']) { ?>
                <div class="slide_list_new">New</div>
            <?php } ?>
            <!--<div class="slide_gap">
                <ul>
                    <li class="slide_title cut"><a href="<?php echo $wr_href; ?>"><?php echo $list[$i]['subject'] ?></a></li>
                    <li class="slide_date">
                        <?php 
                            if($list[$i]['ca_name']) {
                                echo $list[$i]['ca_name']."　";
                            }
                            ?>
                        <?php echo $list[$i]['datetime'] ?>　
                        <?php
                            if ($list[$i]['comment_cnt']) {
					           echo "<span class='slide_comm'>+".$list[$i]['comment_cnt']."</span>";
                            }
                        ?>
                    </li>
                </ul>
            </div>-->
        </div>

        <?php } ?>

    </div>
</div>

<div class="swiper-pagination-lincevent"></div>
<div class="lincprevlincevent"><i class="xi-angle-left"></i></div>
<div class="lincnextlincevent"><i class="xi-angle-right"></i></div>

</div>

<script>
	  var menu = ['', '', '', '', '', '', '', '', '']
      var swiper = new Swiper(".swiper-container-slide-lincevent", {
        slidesPerView: 1,
		slidesPerGroup : 1,
        spaceBetween: 10,
	    touchRatio: 1, // 드래그 가능여부(1, 0)
		loop:false,
		autoplay:false,
		

        pagination: {
		  el: '.swiper-pagination-lincevent',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

		navigation: {
          nextEl: '.lincnextlincevent',
          prevEl: '.lincprevlincevent',
        },


        breakpoints: {
          640: {
            slidesPerView: 2,
			slidesPerGroup : 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
			slidesPerGroup : 2,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 2,
			slidesPerGroup : 2,
            spaceBetween: 30,
          },
        },
      });
</script>


<!--
<script>
	var menu = ['', '', '']
    var swiper = new Swiper('.swiper-container-slide-lincevent', {
     
        slidesPerView: 2, // 가로갯수
        spaceBetween: 30, // 간격
        touchRatio: 1, // 드래그 가능여부(1, 0)
		loop:true,
		slidesPerGroup : 2,
        autoplay: {
            delay: 4000 // 자동롤링 딜레이 (1000 = 1초)
        },


       // If we need pagination
		 pagination: {
		  el: '.swiper-pagination-lincevent',
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			},
		},

	   navigation: {
          nextEl: '.lincnextlincevent',
          prevEl: '.lincprevlincevent',
        },
			


        breakpoints: { // 반응형 처리
            1280: {
             
                slidesPerView: 2,
				slidesPerGroup : 2,
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
                slidesPerColumnFill: 'row',
                slidesPerView: 1,
                slidesPerColumn: 2,
                spaceBetween: 20
            }
        }

    });
</script>-->