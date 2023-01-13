<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/css/style.css">', 0);
$thumb_width = 600;
$thumb_height = 300;
$list_count = (is_array($list) && $list) ? count($list) : 0;

?>


<script src="<?php echo $latest_skin_url ?>/js/slick.js"></script>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/css/slick.css">
<link href="<?php echo $latest_skin_url ?>/css/slick-theme.min.css" rel="stylesheet"/>

<div class="my-carousel">
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
        ?>

		<div>
			<div class="inner_carousel">
			<div class="item" style="background-image:url('<?php echo $img ?>');background-size:cover;background-position:center center" onclick="location.href='<?php echo $list[$i]['href'] ?>';">1</div>
			  <div class="slide_gap">
                <ul>
                    <li class="slide_title cut"><a href="<?php echo $wr_href; ?>"><?php echo $list[$i]['subject'] ?></a></li>
					<li class="slide_cont ellipsis2"><?php echo $list[$i]['wr_content'] ?></li>
                    <li class="slide_date eng">
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
            </div>
			</div>

		</div>
	<?php } ?>
</div>



<script>
$(function() {
var myCarousel = $(".my-carousel").not('.slick-initialized').slick({
//var myCarousel = $('.my-carousel').slick({
  arrows: false,
  dots: true,
  slidesPerRow: 2, 
  rows: 3,
	  responsive: [
		{
			breakpoint: 1200,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 1008,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 800,
			settings: {
				 slidesPerRow: 1, 
				 rows: 3,
			}
			// settings: "unslick"
		}

	]
});

myCarousel.slick( 'slickSetOption', {
  slidesPerRow: 2, 
  rows: 3
}, true );

//myCarousel.slick("unslick");
});

</script>
