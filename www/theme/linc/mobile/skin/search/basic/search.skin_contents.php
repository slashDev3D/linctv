<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH .'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
?>

<div id="search">
	<ul id="sch_res_board">
	    <li><a href="<?php echo G5_BBS_URL ?>/search_tv.php?<?php echo $search_query?>" class="eng">LINC + TV</a></li>
	    <li class="sch_on"><a href="<?php echo G5_BBS_URL ?>/search_contents.php?<?php echo $search_query?>" class="eng">CONTENTS</a></li>
	 </ul>
	<section id="sch_res_ov">
		<h2 class="eng">CONTENTS</h2>
	    <dl>
	        <dt></dt>
	        <dd><strong class="sch_word eng"><?php echo number_format($total_count) ?></strong>개</dd>
	    </dl>
	</section>
	<div id="sch_result">
	    <?php
	    if ($stx) {
	        if ($board_count) {
	     ?>
	   
	    <?php
	        } else {
	     ?>
	    <div class="empty_list">
			<div class="empty_inner">
				<img src="<?php echo G5_THEME_IMG_URL ?>/emptyList.png">
				<br>"<span><?php echo $stx ?>"</span> 검색결과가 없습니다.
			</div>
		</div>
	    <?php } }  ?>
	
	    <div>
	    <?php if ($stx && $board_count) { ?>
	    <section class="sch_res_list">
	    <?php }  ?>
		<ul>
	    <?php
	    $k=0;
	    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {

	     ?>      
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
					 <ul class="linc-new-video-button img_link" id="vimeo-<?php echo $list[$idx][$i]['wr_10'] ?>" data-video-id="<?php echo $list[$idx][$i]['wr_10']; ?>" style="cursor:pointer" data-channel="vimeo">
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
	            </li>
	        <?php }  ?>
	      
	
	    <?php }  ?>
			  </ul>
	    <?php if ($stx && $board_count) {  ?></section><?php }  ?>
	    </div>
	    <?php echo $write_pages ?>
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
			console.log(src);

			// var getImageSrc = id_img;
			// style background image
			$(id_img).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + src + ')'
			});

		}
</script>