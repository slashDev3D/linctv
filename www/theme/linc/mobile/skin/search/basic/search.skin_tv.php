<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH .'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
?>

<div id="search">
	<ul id="sch_res_board">
	    <li class="sch_on"><a href="<?php echo G5_BBS_URL ?>/search_tv.php?<?php echo $search_query?>" class="eng">LINC + TV</a></li>
	    <li><a href="<?php echo G5_BBS_URL ?>/search_contents.php?<?php echo $search_query?>" class="eng">CONTENTS</a></li>
	 </ul>
	<section id="sch_res_ov">
		<h2 class="eng">LINC + TV</h2>
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
			 $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
                                if($list[$i]['icon_secret']) {
                                    $img_content = $board_skin_url.'/img/sec.png';
                                } else { 
                                    if($thumb['src']) {
                                        $img_content = $thumb['src'];
                                    } else if ($list[$idx][$i]['wr_10']){
										$img_content = 'https://img.youtube.com/vi/'.$list[$idx][$i]['wr_10'].'/0.jpg';
                                    } else {
                                        $img_content = $board_skin_url.'/img/no_img.png';
                                    }  
                 }


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
	            	
					 <ul class="img_link" style="background-image:url('<?php echo $img_content ?>');background-size:cover;background-position:center center;cursor:pointer" onclick="location.href='<?php echo $list[$idx][$i]['href'] ?>';">
                                <?php if ($list[$i]['icon_new']) { ?>
                                <li class="main_lists_new">New</li>
                                <?php } ?>
                            </ul>
							<div class="sch_res_title">
	                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" class="sch_res_tit cut"><?php echo $list[$idx][$i]['subject'] ?></a>
	                    <a href="<?php echo $list[$idx][$i]['href'] ?>" target="_blank" class="sch_res_new"><i class="xi-external-link"></i></a>
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
			var idimg = $(id_img).attr('src',data[0].thumbnail_large);
			var src = $(idimg).attr("src");
			console.log(src);
			$(id_img).css({
					'background-size' : 'cover',
					'background-image' : 'url(' + src + ')'
			});

		}

		</script>