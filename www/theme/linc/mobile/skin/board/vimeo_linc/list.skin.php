<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>

<!-- 커스텀 { -->
<script src="<?php echo $board_skin_url ?>/swiper/swiper.js"></script>
<link rel="stylesheet" href="<?php echo $board_skin_url ?>/swiper/swiper.css">
<link rel="stylesheet" href="<?php echo $board_skin_url ?>/css/magic-check.css">
<!-- } -->
<style>
.swiper-container {overflow:visible}
#contents {overflow:visible}
</style>

<div class="linc_wrap">
 <h2 class="boTitle"><?php echo $board['bo_subject'] ?></h2>
		<!-- 게시판 검색 시작 { -->
		<fieldset id="bo_sch">
			<legend>게시물 검색</legend>
			<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">
			<label for="sfl" class="sound_only">검색대상</label>
			<select name="sfl" id="sfl" style="display:none">
				<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
				<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
				<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
			</select>
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="영상검색" autocomplete="off">
			<button type="submit" value="검색" class="sch_btn"><i class="xi-search"></i><span class="sound_only">검색</span></button>
			</form>
		</fieldset>
		<!-- } 게시판 검색 끝 --> 
	

        <div class="cate_div">
            <?php if ($is_category) { ?>
            <style>
                .cate_div {
                    margin-bottom: 20px;
                }

                .cate_div ul li {
                    margin-right: 0px;
                    margin-right: 15px;
                }
            </style>
            <ul class="fl">
                <?php echo $category_option ?>
            </ul>
            <?php } ?>
            <?php if ($is_checkbox) { ?>
            <ul class="top_chks">
                <input class="magic-checkbox" type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
                <label for="chkall"></label>
            </ul>
            <?php } ?>
            <div class="cb"></div>
        </div>
        <!-- } -->

		

        <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="spt" value="<?php echo $spt ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="sw" value="">

		


            <div class="swiper-container swiper-container-ga">
                <div class="swiper-wrapper swiper-wrapper-ga">
                    <table>
                        <?php
                        $now_row = '';
                        for ($i=0; $i<count($list); $i++) {
							
							$vimeoShare = "https://vimeo.com/".$list[$i]['wr_10']."";
                            $now_row = $list[$i]['wr_id'];
                            $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
                                if($list[$i]['icon_secret']) {
                                    $img_content = $board_skin_url.'/img/sec.png';
                                } else { 
                                    if($thumb['src']) {
                                        $img_content = $thumb['src'];
                                    } else if ($list[$i]['wr_10']){
										$img_content = $movieimg;
                                    } else {
                                        $img_content = $board_skin_url.'/img/no_img.png';
                                    }
                                }
                        ?>

                        <div class="swiper-slide swiper-slide-ga">
							 <div class="listNumber eng"><?php echo $i+1 ?></div>
							 <ul class="linc-new-video-button img_link" id="vimeo-<?php echo $list[$i]['wr_10'] ?>" data-video="<?php echo $list[$i]['wr_10']; ?>"  data-video-id="<?php echo $list[$i]['wr_10'] ?>" data-channel="vimeo" data-wr_id="<?php echo $list[$i]['wr_id'] ?>">
								<img id="vimeo-<?php echo $list[$i]['wr_10'] ?>" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("<?php echo $list[$i]['wr_10'] ?>");
								});
								</script>
                                <?php if ($list[$i]['icon_new']) { ?>
                                <li class="main_lists_new">New</li>
                                <?php } ?>
							</ul>
                            <ul>
                                <li class="main_lists_tit cut">
                                    <a data-video="<?php echo $list[$i]['wr_10']; ?>" class="popyt mov_b2 titles_list">
                                        <?php echo $list[$i]['wr_subject'] ?>
                                    </a>
									
                                </li>
                                <li class="main_lists_date eng">
                                    <?=date("Y-m-d", strtotime($list[$i][wr_datetime]))?>  | HIT : <?php echo $list[$i]['wr_hit'] ?>
									<?php if ($is_admin) { ?><br><a href="<?php echo $list[$i]['href'] ?>">EDIT</a><?php } ?>

									<p id="p1_<?php echo $list[$i]['wr_10'] ?>" style="display:none"><?php echo $vimeoShare?></p>
									<span class="clipBtn eng" onclick="copyToClipboard('#p1_<?php echo $list[$i]['wr_10'] ?>')"><i class="xi-share-alt-o"></i> 영상공유</span>

									<script>
									function copyToClipboard(element) {
									var $temp = $("<input>");
									  $("body").append($temp);
									  $temp.val($(element).text()).select();
									  document.execCommand("copy");
									  $temp.remove();
									  alert("영상주소가 복사되었습니다."); //Optional Alert, 삭제해도 됨
									}
									</script>
                                </li>
                            </ul>

                            <?php if ($is_checkbox) { ?>
                            <div class="chk_boxs">
                                <input class="magic-checkbox" name="chk_wr_id[]" type="checkbox" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                                <label for="chk_wr_id_<?php echo $i ?>"></label>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <?php if (count($list) == 0) { echo "<div style='width:100%; text-align:center; font-size:12px; padding-top:100px; padding-bottom:100px; color:#999;'>등록된 게시물이 없습니다.</div>"; } ?>
                    </table>
                </div>
            </div>

            <div class="pageing_div">
                <div class="list_btns">
                    <?php if ($write_href) { ?>
                    <button type="button" onclick="location.href='<?php echo $write_href ?>';" title="등록" class="bbs_adm_btn">
                        <img src="<?php echo $board_skin_url ?>/img/edit.svg">
                    </button>
                    <?php } ?>
                    <?php if ($is_checkbox) { ?>　
                    <button type="submit" name="btn_submit" onclick="document.pressed=this.value" value="선택삭제" title="선택삭제" class="bbs_adm_btn">
                        <img src="<?php echo $board_skin_url ?>/img/trash.svg">
                    </button>
                    <?php } ?>
                    <?php if ($is_checkbox) { ?>　
                    <button type="submit" name="btn_submit" onclick="document.pressed=this.value" value="선택복사" title="선택복사" class="bbs_adm_btn">
                        <img src="<?php echo $board_skin_url ?>/img/copy.svg">
                    </button>
                    <?php } ?>
                </div>
                <?php echo $write_pages;  ?>
            </div>
        </form>

		<script>
			$(".linc-new-video-button").click(function() {
				var _bo = '<?php echo $bo_table ?>';
				//var _id = '<?php echo $wr_id ?>';
				var _id = $(this).data('wr_id');
				$.ajax({
					url: '<?php echo $board_skin_url ?>/ajax_hit.php',
					type: 'POST',
					data: {bo_table : _bo, wr_id : _id},
					success: function(data) {
						//alert(data);
					}
				});
			});
		</script>


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
			var idimg = $(id_img).attr('src',data[0].thumbnail_large);
			var src = $(idimg).attr("src");
			$(id_img).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + src + ')'
			});

		}

		</script>

        <?php if ($is_checkbox) { ?>
        <script>
            function all_checked(sw) {
                var f = document.fboardlist;

                for (var i = 0; i < f.length; i++) {
                    if (f.elements[i].name == "chk_wr_id[]")
                        f.elements[i].checked = sw;
                }
            }

            function fboardlist_submit(f) {
                var chk_count = 0;

                for (var i = 0; i < f.length; i++) {
                    if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                        chk_count++;
                }

                if (!chk_count) {
                    alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
                    return false;
                }

                if (document.pressed == "선택복사") {
                    select_copy("copy");
                    return;
                }

                if (document.pressed == "선택이동") {
                    select_copy("move");
                    return;
                }

                if (document.pressed == "선택삭제") {
                    if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
                        return false;

                    f.removeAttribute("target");
                    f.action = "./board_list_update.php";
                }

                return true;
            }

            // 선택한 게시물 복사 및 이동
            function select_copy(sw) {
                var f = document.fboardlist;

                if (sw == "copy")
                    str = "복사";
                else
                    str = "이동";

                var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

                f.sw.value = sw;
                f.target = "move";
                f.action = "./move.php";
                f.submit();
            }
        </script>
        <?php } ?>
    </div>