<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);


?>
<form action="#" method="post">
<input type="hidden" name="page_no" value="1">
<input type="hidden" name="total_page" value="<?=ceil($board['bo_count_write']/$rows)?>">
<input type="hidden" name="rows" value="<?=$rows?>">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="skin_dir" value="<?=$skin_dir?>">
<input type="hidden" name="bbs_path" value="<?=G5_BBS_PATH?>">
<input type="hidden" name="subject_len" value="<?=$subject_len?>">


<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt">
    <!-- <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong> -->
    <ul class="latest_content">
    <?php for ($i=0; $i<count($list); $i++) {  

	$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['src']) {
        $img = $thumb['src'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
	
	?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\" target='_blank'>";
            if ($list[$i]['is_notice']){?>
                <p class="">
				<?
                echo "<strong>".$list[$i]['subject']."</strong>";
				if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
				if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
				if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
				if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
				if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
				echo "<span>".$list[$i]['wr_content']."</span>";
				?>
				</p>
			<?}else{?>
                <p class="latest_line">
				<a href="<?php echo $wr_href; ?>" class="lt_img"><?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?></a>
				<?

				echo "1111";
				echo "<strong>".$list[$i]['subject']."</strong>";
				if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
				if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
				if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
				if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
				if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
				echo "<br/>";
				echo "<span>".$list[$i]['wr_content']."</span>";
				?>
				</p>
			<?}

            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            
             ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <!-- <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" target="_blank"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div> -->

    <?php  if (ceil($board['bo_count_write'] / $rows) > 1) { ?>
	<div id="news_atc_page" class="page">
	<a href="javascript:;" title="이전" class="pre" onclick="latest_paging(this,'pre')"><span class="blind">이전</span></a>
	<span class="num" style="">
		<strong>
			<?php  
			for ($x = 1; $x <=  ceil($board['bo_count_write']/$rows); $x++) {
			  ?>
			  <a href="javascript:;" title="<?php echo $x ;?> 페이지" onclick="latest_paging(this,<?php echo $x ;?>)"><?php echo $x ;?></a>
			  <?
			}
			?>  
		</strong>
		<!-- <em class="cur_page">1</em> / 
		<span><?=ceil($board['bo_count_write']/$rows)?></span> -->
	</span>
	<a href="javascript:;" title="다음" class="next" onclick="latest_paging(this,'next')"><span class="blind">다음</span></a>
	</div>
    <?php } ?>
</form>
</div>
<script>
function latest_paging(t,flag)
{

	var frm = $(t).parents('form');
	
	var page_no = $("[name='page_no']",frm).val();
	var total_page = $("[name='total_page']",frm).val();
	if(flag == "pre")
	{
		if(page_no==1) return;

		page_no--;
		//alert(page_no);
		$("[name='page_no']",frm).val(page_no);

	}else if(flag == "next")
	{
		if(page_no==total_page) return;

		page_no++;
		//alert(page_no);
		$("[name='page_no']",frm).val(page_no);

	}else
	{
		//if(page_no==1) return;
		//if(page_no==total_page) return;
		
		page_no=flag;
		//alert(page_no);
		$("[name='page_no']",frm).val(page_no);
	}
	$(".cur_page",frm).html(page_no);

	$.ajax({
		type:	'post',
		url:	"<?=$latest_skin_url?>/get_list_content.php",
		data:	frm.serialize(),
		success: function(xhr)
		{
			console.log('111')
			$(".latest_content",frm).html(xhr);
		}
	});		
}
</script>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->