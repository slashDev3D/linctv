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

<!-- Swiper 5.4.3 { -->
<script src="<?php echo $latest_skin_url ?>/js/swiper.js"></script>
<link rel="stylesheet" href="<?php echo $latest_skin_url ?>/css/swiper.css">
<!-- } -->

<div class="swiper-container swiper-container-slide" style="padding-bottom:50px;">
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
        ?>

        <div class="swiper-slide swiper-slide-slide">
            <div class="slide_img" id="vimeo_latest-<?php echo $list[$i]['wr_10'] ?>" style="height:132px;" onclick="location.href='<?php echo $list[$i]['href'] ?>';">
			<img id="vimeo_latest-<?php echo $list[$i]['wr_10'] ?>" style="display:none"/>
			<script>
				$(function() {
					vimeoLoadingThumb_latest("<?php echo $list[$i]['wr_10'] ?>");
				});
			</script>
          
			</div>
            
            <?php if ($list[$i]['icon_new']) { ?>
                <div class="slide_list_new">New</div>
            <?php } ?>
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
        <?php } ?>
    </div>
	<div class="swiper-pagination eng"></div>
</div>
<script>
		function vimeoLoadingThumb_latest(id){    
			var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb_latest";
			var id_img = "#vimeo_latest-" + id;
			var script = document.createElement( 'script' );
			script.type = 'text/javascript';
			script.src = url;

			$(id_img).before(script);
			//console.log(url);
		}

		function showThumb_latest(data){
			var id_img = "#vimeo_latest-" + data[0].id;
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