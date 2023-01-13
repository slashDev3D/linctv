<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
//echo $bo_table;
//echo latest('theme/slide_thumb', $bo_table, 100, 99);
?>

<div id="boardView_tail">
<div class="view_latest">
<h2>전체회차 <span class="en"><?php echo $board['bo_count_write']; ?></span>화</h2>
    <ul class="board-tabs">
		<li class="active" rel="board-tab1">최신 컨텐츠</li>
		<li rel="board-tab2">첫회부터</li>
    </ul>
    <div class="board-tab_container">
        <div id="board-tab1" class="board-tab_content"><?php echo latest_multi("theme/slide_thumb_youtube", $bo_table, 100, 99, 0, "last_desc"); ?></div>
        <div id="board-tab2" class="board-tab_content"><?php echo latest_multi("theme/slide_thumb_youtube", $bo_table, 100, 99, 0, "last_asc"); ?></div>
    </div>
</div>

<?php echo latest('theme/slide_thumb', 'linc_event', 4, 33);?>

<?php
// 그룹 기준
$gr_where_sql =  "a.bo_device <> 'mobile' ";
$gr_where_sql .= "and a.bo_list_level <= '{$member['mb_level']}' "; # 회원레벨에 따른 출력제한
// $gr_where_sql .= "and a.bo_order != '0' "; # 게시판 출력순서 0  제외
$gr_where_sql .= "and a.bo_use_search != '0' "; # 검색 미사용 제외
//$gr_where_sql .= "and b.gr_id not in ('admin','03','05') "; # 그룹 제외 '05', '06'...
$gr_where_sql .= "and b.gr_id = 'linctv'"; # 그룹 제외 '05', '06'...
$gr_where_sql .= "and a.bo_table not in ('".$bo_table."') "; #  테이블 제외 'notice', 'tbname'
$gr_order .= " b.gr_order, "; # 그룹 출력순서에 따른 정렬 우선
$sql = " select bo_table from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)  where $gr_where_sql order by $gr_order a.bo_order ";

// 테이블 기준
/*
$tb_where_sql =  "bo_device <> 'mobile' ";
$tb_where_sql .= "and bo_list_level <= '{$member['mb_level']}' "; # 회원레벨에 따른 출력제한
$tb_where_sql .= "and bo_order != '0' "; # 게시판 출력순서 0 출력 제외
$tb_where_sql .= "and bo_table not in ('notice') "; # 제외 테이블  'notice', 'tbname'
$sql = " select bo_table, bo_subject from {$g5[board_table]} where $tb_where_sql order by bo_order ";
*/
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    //if ($i%2==1) $lt_style = "margin-left:20px";
   // else $lt_style = "";
?>
   
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        echo latest("theme/slide_thumb_youtube_bottom", $row['bo_table'], 5, 25);

        ?>
 
<?php
}
?>
<!-- } 최신글 끝 -->
</div>

<script>

	$(document).ready(function(){
		$(".board-tab_content").hide();
		$(".board-tab_content:first").show();
		$("ul.board-tabs li:first").addClass("active").css("color", "#000");

		$("ul.board-tabs li").click(function () {
			$("ul.board-tabs li").removeClass("active").css("color", "#999");
			//$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
			$(this).addClass("active").css("color", "#000");
			$(".board-tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn();
		
			$("#" + activeTab).find('.my-carousel').each(function() {
				$(this).slick('setPosition');
			});
		
		});
	});
</script>