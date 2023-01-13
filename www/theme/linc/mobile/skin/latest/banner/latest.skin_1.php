<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
global $is_admin; 
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);

$thumb_width = 300;
$thumb_height = 200;
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt_bn">
    <ul>
    <?php
    for ($i=0; $i<count($list); $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['ori']) {
        $img = $thumb['ori'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    ?>
        <li class="list_<?php echo $i ?>">
            <div class="bg" style="background:url('<?php echo $img; ?>')no-repeat center center;background-size:cover;">
			<div class="bn_txt">
                <div class="txt_wr">
						<span class="small_tit"><?php echo $list[$i]['wr_1']; ?></span>
                        <?php
                        echo "<a href=\"".$list[$i]['wr_link1']."\"  class=\"bn_tit\">";
                            echo $list[$i]['subject'];
                        echo "</a>";
                        ?>

                        <div class="bn_detail"> <?php echo get_text(cut_str(strip_tags($list[$i]['wr_content']), 50), 1); ?></div>

                        <?php
                        echo "<a href=\"".$list[$i]['wr_link1']."\" class=\"bn_view\">프로그램 보러가기&nbsp;&nbsp;&nbsp;<i class=\"xi-angle-right-min\"></i></a>";
                        ?>
                </div>
            </div>
			</div>
            
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    
</div>


<script>
$('.lt_bn ul').show().bxSlider({
    pager:false,
    controls:true,
    auto:true
});
</script>

<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->