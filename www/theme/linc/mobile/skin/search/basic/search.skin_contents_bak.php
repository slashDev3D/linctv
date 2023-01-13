<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH .'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
//echo get_pretty_url($search_table[$idx], '', $search_query);
//echo $search_query;

?>
    <style>
    /* 팝업 */

.reveal {
     position: fixed;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     z-index: 99998;
}

.video-wrapper {
    width: 100%;
    z-index: 99999;
}

.video-wrapper_div2 {
   width: 1000px;
   margin: 150px auto;
}


.close_vimeo {position:absolute;top:-40px;right:0px;color:#fff;font-size:24px;z-index:99999;cursor:pointer}

.video-wrapper_div {
   position: relative;
   height: 0;
   padding-bottom: 56.25%;
}

.video-wrapper iframe {
   border: 0px;
   box-shadow: 30px 30px 50px rgba(0, 0, 0, 0.2);
   z-index: 99999;
}

.reveal .video-popup-closer {
   position: fixed;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background: rgba(0, 0, 0, 0.5);
   z-index: 99998;
}

/*팝업 */
        

        

 /* 동영상 영역 768px 이하 100% */
@media all and (max-width: 768px) {

   .video-wrapper_div2 {
       width: 100%;
       margin-top: 30px;
    }


}
/* 동영상 영역 768px 이하 100% */
    </style>
<div id="search">
	<!--<form name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
	<input type="hidden" name="srows" value="<?php echo $srows ?>">
	<fieldset id="sch_res_detail">
	    <legend>상세검색</legend>
	    <div class="sch_wr">
	        <?php echo $group_select ?>
	        <script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>
	
	        <label for="sfl" class="sound_only">검색조건</label>
	        <select name="sfl" id="sfl">
	            <option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
	            <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
	            <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
	            <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
	            <option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
	        </select>
	
	        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	        <div class="sch_ipt">
	        	<input type="text" name="stx" id="stx" value="<?php echo $text_stx ?>" class="frm_input" required  maxlength="20">
	        	<button type="submit" class="btn_sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i></button>
			</div>
	        <script>
	        function fsearch_submit(f)
	        {
	            if (f.stx.value.length < 2) {
	                alert("검색어는 두글자 이상 입력하십시오.");
	                f.stx.select();
	                f.stx.focus();
	                return false;
	            }
	
	            // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
	            var cnt = 0;
	            for (var i=0; i<f.stx.value.length; i++) {
	                if (f.stx.value.charAt(i) == ' ')
	                    cnt++;
	            }
	
	            if (cnt > 1) {
	                alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
	                f.stx.select();
	                f.stx.focus();
	                return false;
	            }
	
	            f.action = "";
	            return true;
	        }
	        </script>
	    </div>
	    <div class="sch_opt_radio">
	        <input type="radio" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop">
	        <label for="sop_or">OR</label>
	        <input type="radio" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop">
	        <label for="sop_and">AND</label>
	    </div>
	</fieldset>
	</form>-->
	
	<ul id="sch_res_board">
	    <li><a href="<?php echo G5_BBS_URL ?>/search_tv.php?<?php echo $search_query?>" class="eng">LINC + TV</a></li>
	    <li class="sch_on"><a href="<?php echo G5_BBS_URL ?>/search_contents.php?<?php echo $search_query?>" class="eng">CONTENTS</a></li>
	 </ul>


	<?php
	if ($stx) {
	    if ($board_count) {
	?>
	<section id="sch_res_ov">
		<h2 class="eng">CONTENTS</h2>
	    <dl>
	        <!--<dt>게시판</dt>
	        <dd class="division-bg"><strong class="sch_word"><?php echo $board_count ?>개</strong></dd>-->
	        <dt></dt>
	        <dd><strong class="sch_word eng"><?php echo number_format($total_count) ?></strong>개</dd>
	    </dl>
	</section>
	<?php
	    }
	}
	?>
	
	<div id="sch_result">
		<!--<p><?php echo number_format($page) ?>/<?php echo number_format($total_page) ?> 페이지 열람 중</p>
	    <?php
	    if ($stx) {
	        if ($board_count) {
	     ?>
	    <ul id="sch_res_board">
	        <li><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>>전체게시판</a></li>
	        <?php echo $str_board_list; ?>
	    </ul>
	    <?php
	        } else {
	     ?>
	    <div class="empty_list">검색된 자료가 하나도 없습니다.</div>
	    <?php } }  ?>-->
	
	    <div>
	    <?php if ($stx && $board_count) { ?>
	    <section class="sch_res_list">
	    <?php }  ?>
	    <?php
	    $k=0;
	    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {

	     ?>
		<div class="sch_result_div">     
	        <!--<h2><a href="<?php echo get_pretty_url($search_table[$idx], '', $search_query); ?>"><?php echo $bo_subject[$idx] ?> 게시판 내 결과</a></h2>-->
	        <ul>
	        <?php
	        for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {

			 $thumb_info=get_list_thumbnail($search_table[$idx], $list[$idx][$i]['wr_id'],100,100);
			 $search_thums=$thumb_info['src'];


			 $file_img['file']=get_file($search_table[$idx], $list[$idx][$i]['wr_id']);
			 $search_file=$file_img['file']['0']['source'];
			 $iimg=($search_file) ? '<img src="'. $search_thums .'">' : '이미지 없음';


	            if ($list[$idx][$i]['wr_is_comment'])
	            {
	                $comment_def = '<span class="cmt_def"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="sound_only">댓글</span></span> ';
	                $comment_href = '#c_'.$list[$idx][$i]['wr_id'];
	            }
	            else
	            {
	                $comment_def = '';
	                $comment_href = '';
	            }
	         ?>
	            <li>
	            	
					 <ul class="popyt mov_b2 img_link" id="vimeo-<?php echo $list[$idx][$i]['wr_10'] ?>" data-video="<?php echo $list[$idx][$i]['wr_10']; ?>" style="cursor:pointer">
								<img id="vimeo-<?php echo $list[$idx][$i]['wr_10'] ?>" style="display:none"/>
								<script>
								$(function() {
									vimeoLoadingThumb("<?php echo $list[$idx][$i]['wr_10'] ?>");
								});
								</script>
                                <?php if ($list[$i]['icon_new']) { ?>
                                <li class="main_lists_new">New</li>
                                <?php } ?>
                                <!--<?php if ($list[$i]['wr_10']) { ?>
                                <li class="mov_ico">
                                    <img src="<?php echo $board_skin_url ?>/img/favicon_144-vfliLAfaB.png"> 
                                </li>
                                <?php } ?>-->
							</ul>
							<div class="sch_res_title">
	                    <span class="sch_res_tit cut"><?php echo $list[$idx][$i]['subject'] ?></span>
	                    <span class="sch_res_new"><i class="xi-external-link"></i></span>
	                </div>
	                <!--<p>
					
					<?php echo $list[$idx][$i]['content'] ?>
					</p>
	                <div class="sch_res_info">
	                    <?php echo $list[$idx][$i]['name'] ?>
						
	                    <span class="sch_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$idx][$i]['wr_datetime'] ?></span>
	                </div>-->
	            </li>
	        <?php }  ?>
	        </ul>
	    </div>
	    <?php }  ?>
	
	    <?php if ($stx && $board_count) {  ?></section><?php }  ?>
	    </div>
	
	    <?php echo $write_pages ?>
	</div>
</div>

 
    <!-- 팝업 레이어 -->
    <div class="video-popup" id="video-popup-closer2">
		
        <div class="video-popup-closer" id="video-popup-closer2"></div>
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
			console.log(src);

			// var getImageSrc = id_img;
			// style background image
			$(id_img).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + src + ')'
			});

		}

		</script>