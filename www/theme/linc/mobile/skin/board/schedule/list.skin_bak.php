<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
if($Ymd) {
	$mode = 3;
	$Ymd = $Ymd + 0;
}
$add_class = $yoil = array();
$yoil[1] = '월';
$yoil[2] = '화';
$yoil[3] = '수';
$yoil[4] = '목';
$yoil[5] = '금';
$yoil[6] = '토';
$yoil[7] = '일';
if(!$mode) $mode = 2;
$this_year = date("Y", G5_SERVER_TIME);
$this_month = date("m", G5_SERVER_TIME);
$this_day = date("d", G5_SERVER_TIME);
$this_yoilnum = date("N", G5_SERVER_TIME);
$this_weeknum = date("W", G5_SERVER_TIME);
$today = date('Ymd', G5_SERVER_TIME);
$end_i = 7;
if($mode == 1) { // 월요일부터 시작
	$k = 1; // 시작요일
	$tmp_day = $this_yoilnum - 1;
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24);
} else if($mode == 2) { // 어제 부터 시작
	$k = $this_yoilnum - 1;
	if(!$k) $k = 7;
	$tmp_day = 1;
	$start_time = G5_SERVER_TIME-($tmp_day*60*60*24);
	$end_i = 8;
} else if($mode == 3) { // 특정일/주 선택
	$k = 1;
	$select_time = strtotime($Ymd);
	$yoilnum = date("N", $select_time);
	$tmp_day = $yoilnum - 1;
	$start_time = $select_time-($tmp_day*60*60*24);
	$weeknum = date("W", $start_time);
}

$s_year = date("Y", $start_time);
$s_month = date("m", $start_time);
$s_day = date("d", $start_time);
$start_Ymd = date("Ymd", $start_time);
$end_Ymd = date("Ymd", $start_time + (7*60*60*24));
if($sql_search) $sql_search = ' and '.$sql_search;
$sql = "select wr_id, ca_name, wr_subject, wr_content, wr_1, wr_option from $write_table where wr_is_comment = 0 and wr_1 between '$start_Ymd' and '$end_Ymd' {$sql_search} order by wr_1, wr_2";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
	unset($tmp_list);
		$html = 0;
	if (strstr($row['wr_option'], 'html1'))
		$html = 1;
	else if (strstr($row['wr_option'], 'html2'))
		$html = 2;
	$tmp_list['wr_id'] = $row['wr_id'];
	if($row['ca_name'])	$tmp_list['ca_name'] = '['.$row['ca_name'].'] ';
	$tmp_list['subject'] = conv_subject($row['wr_subject'], $board['bo_subject_len'], '…');
	$tmp_list['wr_1'] = $row['wr_1'];
	if($board['bo_use_list_content']) $tmp_list['content'] = cut_str(conv_content($row['wr_content'], $html),50);
	$tmp_list['href'] = './board.php?bo_table='.$bo_table.'&wr_id='.$row['wr_id'];


	$info_list["{$row['wr_1']}"][] = $tmp_list;
}
$add_class[$today] .= ' today';
?>

<h2 id="title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
	<div class="toparea">
		<?php if ($is_checkbox) { ?>
		<div class="leftarea">
		<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca ?>">이번주</a>
		<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca.'&Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day-7, $s_year)) ?>">전주</a>
		<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca.'&Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day+7, $s_year)) ?>">다음주</a>
		
		</div>
		<?php } ?>

		<div class="rightarea">
		<input type="text" name="datepicker" value="<?php echo $Ymd; ?>" id="datepicker" class="frm_input" size="10" maxlength="8">
		<label for="datepicker" class="sound_only">시작일시</label>
	
		<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_b02">일정등록</a><?php } ?>
		</div>
	</div>
	<div style="clear:both"></div>


	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">
	<div class="scdtabs">
		<ul id="scdtabs-nav">
		<?php
		for($i = 0; $i < $end_i; $i++) {
			if($k == 8) {
				$k = 1;
			}
			$Ymd = date("Ymd", $start_time+($i*60*60*24));
			if($k == 6) $add_class[$Ymd] .= 'blue';
			if($k == 7) $add_class[$Ymd] .= 'red';
			if($Ymd < $today) $add_class[$Ymd] .= ' past';
		?>
			
			
			
			<?php if($Ymd == date("Ymd")) { ?>
				<li class="active">
			<?php } else {?>
				<li>
			<?php } ?>
		
				<a href="#<?php echo $Ymd?>">
				<?php echo $v['wr_1'] ?>
					<p class="eng"><?php echo date("m.d", $start_time+($i*60*60*24)); ?></p>
					<span class="smallyoil"><?php echo $yoil[$k] ?></span>
				</a>
			</li>
					
					
		<?php
			$k++;
		} // end for
		?>
		</ul>

		 <div id="scdtabs-content">
		<?php
		for($i = 0; $i < $end_i; $i++) {
			if($k == 8) {
				$k = 1;
			}
			$Ymd = date("Ymd", $start_time+($i*60*60*24));
			if($k == 6) $add_class[$Ymd] .= 'blue';
			if($k == 7) $add_class[$Ymd] .= 'red';
			if($Ymd < $today) $add_class[$Ymd] .= ' past';
		?>

		
		<!--<?php if($Ymd == $Ymd) { ?>
		<dl style="border:3px solid red;display:block;" id="<?php echo date("Ymd", $start_time+($i*60*60*24)); ?>" class="scdtab-content">
		<?php } else { ?>
		<dl style="border:3px solid red" id="<?php echo date("Ymd", $start_time+($i*60*60*24)); ?>" class="scdtab-content">
		<?php }  ?>-->


	
				


			<dl style="border:3px solid red" id="<?php echo date("Ymd", $start_time+($i*60*60*24)); ?>" class="scdtab-content">

			
				<dd class="info_list">
					<?php if($info_list[$Ymd]) { foreach ($info_list[$Ymd] as $v) { ?>
					<ul>
						<li>
						
							<?php if ($is_checkbox) { ?>
							<label for="chk_wr_id_<?php echo $v['wr_id'] ?>" class="sound_only"><?php echo $v['subject'] ?></label>
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $v['wr_id'] ?>" id="chk_wr_id_<?php echo $v['wr_id'] ?>">
							<?php } ?>
							ㅇ <a href="<?php echo $v['href'] ?>"><?php echo $v['ca_name'].$v['subject'] ?></a>
							<span><?php echo $v['content'] ?></span>
						</li>
					</ul>
					<?php } } // end foreach, end if ?>
				</dd>
				<div style="clear:both"></div>
			</dl>


		<?php
			$k++;
		} // end for
		?>
		</div>
		



			<div style="clear:both"></div>
			
			</div>
	</form>
</div>
<div id="start"></div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>


<?php if($Ymd) { ?>
<script>
$(document).ready(function(){
// Show the first tab and hide the rest
//$('#scdtabs-nav li:first-child').addClass('active');
$('.scdtab-content').hide();
$('#<?php echo $v[wr_1] ?>').show();

// Click function
$('#scdtabs-nav li').click(function(){
  $('#scdtabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.scdtab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
});

</script>
<?php } else {?>
<script>
$(document).ready(function(){
// Show the first tab and hide the rest
$('#scdtabs-nav li:first-child').addClass('active');
$('.scdtab-content').hide();
$('.scdtab-content:first').show();

// Click function
$('#scdtabs-nav li').click(function(){
  $('#scdtabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.scdtab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
});

</script>

<?php } ?>



<script>
$(function(){
	$("#datepicker").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $board_skin_url; ?>/img/calendar.png",
		buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true, yearRange: "c-99:c+99",
		onSelect: function() {
			var date = $(this).val();
			window.location.replace("<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca.'&Ymd=' ?>" + date);
	    }
	});
});
</script>
<!-- 페이지 -->
<?php // echo $write_pages;  ?>

<!-- 게시판 검색 시작 { -->
<!--fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>일정명</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>일정명+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset-->
<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
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
<!-- } 게시판 목록 끝 -->
