<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 148;
$thumb_height = 108;
?>
<form action="#" method="post">
<input type="hidden" name="page_no" value="1">
<input type="hidden" name="total_page" value="<?=ceil($board['bo_count_write']/$rows)?>">
<input type="hidden" name="total_data" value="<?=ceil($board['bo_count_write'])?>">
<input type="hidden" name="rows" value="<?=$rows?>">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="skin_dir" value="<?=$skin_dir?>">
<input type="hidden" name="bbs_path" value="<?=G5_BBS_PATH?>">
<input type="hidden" name="subject_len" value="<?=$subject_len?>">

<div class="lt">
	<?php if ($GLOBALS['is_admin']){ ?>
	<p class="latest_more con_read_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="txt"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a><span class="arrow"></span></p>
	<?php } ?>
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
            echo "<a href=\"".$list[$i]['href']."\">";
            if ($list[$i]['is_notice']){?>
                <p class="img_box"><?php echo $img_content; ?></p>
                <p class="latest_line txt_box">
				<?
                echo "<strong>".$list[$i]['subject']."</strong>";
				?>
				</p>
				<p class="latest_more_view"><img src="<?php echo G5_THEME_IMG_URL;?>/ico_latest_more_view.png" alt=""></p>
			<?}else{?>
                <p class="img_box"><?php echo $img_content; ?></p>
                <p class="latest_line txt_box">
				aaaaaaaaaa
				<?
				echo "<strong>".$list[$i]['subject']."</strong>";
				?>
				</p>
				<p class="latest_more_view"><img src="<?php echo G5_THEME_IMG_URL;?>/ico_latest_more_view.png" alt=""></p>
			<?}
            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];
            echo "</a>";
             ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
	<?php 
	get_paging($write_pages, $cur_page, $total_page, $url, $add="");
	?>
    <?php  if (ceil($board['bo_count_write'] / $rows) > 1) { 
	$totalPage = ceil($board['bo_count_write']/$rows);
	$blockPage = 10;
	$nowPage = ceil($totalPage / $blockPage);
	?>
	<div id="letest_atc_page" class="page">
		<div class="num" style="">
			<div id="paging"></div>
		</div>
	</div>
    <?php } ?>
</form>
</div>
<script>
var currentPage = $("[name='page_no']").val();
var totalPage = $("[name='total_page']").val();
var totalData = $("[name='total_data']").val();
var dataPerPage = $("[name='rows']").val();
if(totalPage>10){
	var pageCount = 10;
}else{
	var pageCount = 5;
}
var dataPerPage = 3;
    
    function paging(totalData, dataPerPage, pageCount, currentPage){
        
        console.log("currentPage : " + currentPage);
        
        var dataPage = Math.ceil(totalData/dataPerPage);
        var pageGroup = Math.ceil(currentPage/pageCount);
        
        console.log("pageGroup : " + pageGroup);
        
        var last = pageGroup * pageCount;
        if(last > dataPage)
            last = dataPage;
        var first = last - (pageCount-1);
        var start = 1;
		var next = last+1;
        var prev = first-1;
        var end = totalPage;
        
        console.log("last : " + last);
        console.log("first : " + first);
        console.log("next : " + next);
        console.log("prev : " + prev);
 
        var $pingingView = $("#paging");
        
        var html = "";
        
        if(first > 1){
			html += "<a href='javascript:;' title='start' class='start' onclick='latest_paging(this,\"start\")' id='start'><span class='blind'>start</span></a>"
			html += "<a href='javascript:;' title='prev' class='pre' onclick='latest_paging(this,\"pre\")' id='prev'><span class='blind'>prev</span></a>"
		}
        for(var i=first; i <= last; i++){
			if( i>0 ){
			html += "<a href='javascript:;' title='"+ i +" 페이지' onclick='latest_paging(this,"+ i +")' id=" + i + ">" + i + "</a>";
			}
        }
        if(next > pageCount && last < dataPage){
			html += "<a href='javascript:;' title='next' class='next' onclick='latest_paging(this,\"next\")' id='next'><span class='blind'>next</span></a>"
			html += "<a href='javascript:;' title='end' class='end' onclick='latest_paging(this,\"end\")' id='end'><span class='blind'>end</span></a>"
		}
        $("#paging").html(html);    // 페이지 목록 생성
        $("#paging a").removeClass("active");
        $("#paging a#" + currentPage).addClass("active");    // 현재 페이지 표시
        $("#paging a").click(function(){
            var $item = $(this);
            var $id = $item.attr("id");
            var selectedPage = $item.text();
            
            if($id == "start")    selectedPage = start;
			if($id == "next")    selectedPage = next;
            if($id == "prev")    selectedPage = prev;
            if($id == "end")    selectedPage = end;
            
            paging(totalData, dataPerPage, pageCount, selectedPage);
        });
    }
    $("document").ready(function(){        
        paging(totalData, dataPerPage, pageCount, 1);
    });
function latest_paging(t,flag)
{
	var frm = $(t).parents('form');
	
	var page_no = $("[name='page_no']",frm).val();
	var total_page = $("[name='total_page']",frm).val();
	
	if(flag == "pre"){
		if(page_no==1) return;
		page_no--;
		$("[name='page_no']",frm).val(page_no);
	}else if(flag == "next"){
		if(page_no==total_page) return;
		page_no++;
		$("[name='page_no']",frm).val(page_no);
	}else if(flag == "start"){
		if(page_no==1) return;
		page_no=1;
		$("[name='page_no']",frm).val(page_no);
	}else if(flag == "end"){
		if(page_no==total_page) return;
		page_no=totalPage;
		$("[name='page_no']",frm).val(page_no);
	}else{
		page_no=flag;
		$("[name='page_no']",frm).val(page_no);
	}
	$(".cur_page",frm).html(page_no);
	$.ajax({
		type:	'post',
		url:	"<?=$latest_skin_url?>/get_list_content.php",
		data:	frm.serialize(),
		success: function(xhr)
		{
			$(".latest_content",frm).html(xhr);
		}
	});		
}
</script>
