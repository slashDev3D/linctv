<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
// 선택삭제으로 인해 셀합치기가 가변적으로 변함
$colspan = 4;
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$new_skin_url.'/style.css">', 0);
?>

<?php
                    //echo latest_group2("최신글스킨", "그룹ID", 게시물수, 제목글자수, 본문글자수,"옵션","카테고리","정렬방식");
                    //echo latest_group2("theme/maingroup", "linctv", 6, 13, 10,"","","");
                    ?>


<!-- 전체게시물 목록 시작 { -->
<div id="bo_list" style="width:100%">
<div id="mainList">
    <?php
    for ($i=0; $i<count($list); $i++)
    {
        $num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;
        $bo_subject = mb_substr($list[$i]['bo_subject'],0,8,"utf-8"); // 게시판명 글자수
        $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 35)); // 게시물제목 글자수
    ?>
	<li><?php echo $wr_subject ?></li>
    <!--<tr>
        <td class="td_board"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $list[$i]['bo_table'] ?>"><?php echo $bo_subject ?></a></td>
        <td class="td_subject"><?php echo $list[$i]['comment'] ?><a href="<?php echo $list[$i]['href'] ?>"><?php echo $wr_subject ?></a><? if ($list[$i]['datetime'] >= date("Y-m-d", G5_SERVER_TIME - (24 * 3600))) echo '<img src="'.$new_skin_url.'/img/icon_new.gif" alt="새글">'; ?></td>
        <td class="td_name"><div><?php echo $list[$i]['wr_name'] ?></div></td>
        <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
    </tr>-->
    <?php }  ?>

    <?php if ($i == 0)
       // echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>';
    ?>
</div>
</div>
</div>
<div id="div1"><?php
                    //echo latest_group2("최신글스킨", "그룹ID", 게시물수, 제목글자수, 본문글자수,"옵션","카테고리","정렬방식");
                    //echo latest_group2("theme/maingroup", "linctv", 1, 13, 10,"","","");
                    ?></div>
<?php// echo $write_pages ?>
<!-- } 전체게시물 목록 끝 -->

<script type="text/javascript">
//$(function(){
  //var n = Math.floor(Math.random() * $("#writeContents img").size()) + 1;
  //$("#div1").insertBefore("#writeContents img:eq(" + n + ")");

 //var n = $("#mainList li").size();
 // if (n >= 3) $("#div1").insertBefore("#mainList li:nth-child(3n+1)");
  //else $("#div1").html("");
///});
</script>