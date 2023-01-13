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

//$sql = "select wr_id, ca_name, wr_subject, wr_content, wr_1, wr_option from $write_table where wr_is_comment = 0 and wr_1 between '$start_Ymd' and '$end_Ymd' {$sql_search} order by wr_1, wr_2";

$sql = "select * from $write_table where wr_is_comment = 0 and wr_1 between '$start_Ymd' and '$end_Ymd' {$sql_search} order by wr_1";
$result = sql_query($sql);

while($row = sql_fetch_array($result)) {
	unset($tmp_list);
		$html = 0;
	if (strstr($row['wr_option'], 'html1'))
		$html = 1;
	else if (strstr($row['wr_option'], 'html2'))
		$html = 2;

	$tmp_list['bo_table'] = $row['bo_table'];	
	$tmp_list['wr_id'] = $row['wr_id'];
	//$tmp_list['wr_id'] = $rowt[$i][file][0][file];

	if($row['ca_name'])	$tmp_list['ca_name'] = '['.$row['ca_name'].'] ';
	$tmp_list['subject'] = conv_subject($row['wr_subject'], $board['bo_subject_len'], '…');
	$tmp_list['wr_1'] = $row['wr_1'];
	$tmp_list['wr_2'] = $row['wr_2'];
	$tmp_list['wr_3'] = $row['wr_3'];

	if($board['bo_use_list_content']) $tmp_list['content'] = cut_str(conv_content($row['wr_content'], $html),50);
	$tmp_list['href'] = './board.php?bo_table='.$bo_table.'&wr_id='.$row['wr_id'];
	$info_list["{$row['wr_1']}"][] = $tmp_list;

	$wr_content = $tmp_list['content'];
	$matches = get_editor_image($wr_content, false);
	$con_img1 = $matches[1][0];
	$con_img2 = $matches[1][1];

	//$option1 = explode(',', $tmp_list['wr_3']);

	//for ($i=0; $i<count($option1); $i++) {
		//$option1_list = trim($option1[$i]);
		//if ($option1_list=='') continue;
		//$option_view .= '<li>'.$option1_list.'</li>';
	//}

	 //echo $option_view;


	

	//echo $s_name;
	//echo $tel1;



}

$add_class[$today] .= ' today';


?>
<!-- 필수 JS/CSS { -->

<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- } -->
<style>
#contents {margin:120px auto 200px auto}
.force {display:block !important}

.ui-widget-header {
border: 0px solid #dddddd;
background: #fff;
}

.ui-datepicker-calendar>thead>tr>th {
font-size: 11px !important;
}

.ui-datepicker .ui-datepicker-header {
position: relative;
padding: 10px 0;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
border: 0px solid #c5c5c5;
background-color: transparent;
font-weight: normal;
color: #454545;
text-align: center;
}

.ui-datepicker .ui-datepicker-title {
margin: 0 0em;
line-height: 16px;
text-align: center;
font-size: 11px;
padding: 0px;
font-weight: bold;
color:#666;
}

.ui-datepicker {
display: none;
background-color: #fff;
border-radius: 4px;
margin-top: 30px;
margin-left: -250px;
margin-right: 0px;
padding: 20px;
padding-bottom: 10px;
width: 300px;
box-shadow: 10px 10px 40px rgba(0,0,0,0.1);
}
    
.ui-widget.ui-widget-content {
    border: 1px solid #eee;
}

#datepicker:focus>.ui-datepicker {
display: block;
}

.ui-datepicker-prev,
.ui-datepicker-next {
cursor: pointer;
}

.ui-datepicker-next {
float: right;
}

.ui-state-disabled {
cursor: auto;
color: hsla(0, 0%, 80%, 1);
}

.ui-datepicker-title {
text-align: center;
padding: 10px;
font-weight: 100;
font-size: 20px;
}

.ui-datepicker-calendar {
width: 100%;
}

.ui-datepicker-calendar>thead>tr>th {
padding: 5px;
font-size: 11px;
font-weight: 400;
color:#888;
}

.ui-datepicker-calendar>tbody>tr>td>a {
color: #000;
font-size: 12px !important;

text-decoration: none;
}

.ui-datepicker-calendar>tbody>tr>.ui-state-disabled:hover {
cursor: auto;
background-color: #fff;
}
    
.ui-datepicker-calendar>tbody>tr>td {
    border-radius:0;
    width: 42px;
    height: 38px;
    cursor: pointer;
    padding: 5px;
    font-weight: 100;
    text-align: center;
    font-size: 12px;
	background-color:#FAFAFA;
	border:1px solid #fff;
	color:#333;

}
    
.ui-datepicker-calendar>tbody>tr>td:hover {
    background-color: transparent;
    opacity: 0.6;
}

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus,
.ui-button:hover,
.ui-button:focus {
border: 0px solid #cccccc;
background-color: transparent;
font-weight: normal;
color: #2b2b2b;
}

.ui-widget-header .ui-icon {
background-image: url('<?php echo $board_skin_url?>/img/btns.png');
}
.ui-icon-circle-triangle-e {
background-position: -20px 0px;
background-size: 36px;
}

.ui-icon-circle-triangle-w {
background-position: -0px -0px;
background-size: 36px;
}
    
.ui-datepicker-calendar>tbody>tr>td:first-child a{

}
    
.ui-datepicker-calendar>tbody>tr>td:last-child a{

}
    
.ui-datepicker-calendar>thead>tr>th:first-child {

}
    
.ui-datepicker-calendar>thead>tr>th:last-child {
 
}

.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
    border: 0px;
   
    padding-top: 10px;
    padding-bottom: 10px;
	color:#000;
	font-weight:bold;
}

.ui-datepicker-buttonpane {display:none !important}



@media all and (max-width: 1024px){

#contents {margin:60px auto 100px auto}
.ui-datepicker {
display: none;
background-color: #fff;
border-radius: 4px;
margin-top: 30px;
margin-left: -30px;
margin-right: 0px;
padding: 20px;
padding-bottom: 10px;
width: 300px;
box-shadow: 10px 10px 40px rgba(0,0,0,0.1);
}

}
</style>

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
		<!--<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca ?>">이번주</a>
		<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca.'&Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day-7, $s_year)) ?>">전주</a>
		<a href="<?php echo $_SERVER['PHP_SELF'].'?bo_table='.$bo_table.'&sca='.$sca.'&Ymd='.date("Ymd", mktime(0,0,0, $s_month, $s_day+7, $s_year)) ?>">다음주</a>
		-->
		
		</div>
		<?php } ?>

		<div class="rightarea">
		<input type="hidden" name="datepicker" value="<?php echo $Ymd; ?>" id="datepicker" class="frm_input" size="10" maxlength="8" class="datepicker inp">
		<!--<input type="text" name="datepicker" value="<?php echo $tmp_list['wr_1']; ?>" id="datepicker" class="frm_input" size="10" maxlength="8">-->
		<label for="datepicker" class="sound_only">시작일시</label>
	
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
			$YmdBigo = date("Ymd", $start_time+($i*60*60*24));
			if($k == 6) $add_class[$Ymd] .= 'blue';
			if($k == 7) $add_class[$Ymd] .= 'red';
			if($Ymd < $today) $add_class[$Ymd] .= ' past';
		?>
			
			

		  <li class="<?php echo $Ymd?>">
				<a href="#<?php echo $Ymd?>">
					<p class="eng"><?php echo date("m.d", $start_time+($i*60*60*24)); ?></p>
					<span class="smallyoil"><?php echo $yoil[$k] ?></span>
					<input type="hidden" value="<?php echo $Ymd?>">
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


		<dl id="<?php echo date("Ymd", $start_time+($i*60*60*24)); ?>" class="scdtab-content">
				<dd class="info_list">
					<?php if($info_list[$Ymd]) { foreach ($info_list[$Ymd] as $v) { 

					$v['file'] = get_file($bo_table, $v['wr_id']);
					$file_img1 = $v['file'][0]['path'].'/'.$v['file'][0]['file'];
					$file_img2 = $v['file'][1]['path'].'/'.$v['file'][1]['file'];

					$v['wr_3'] = explode('|',$v['wr_3']);
					$v01 =  $v['wr_3'][0]; 
					$v02 =  $v['wr_3'][1]; 
					$v03 =  $v['wr_3'][2]; 

					
					
					?>
					<ul id="pcNew">
						<li>
							<dd class="info_time eng"><?php echo $v['wr_2'] ?></dd>
							<dd class="info_img">	
									<img src="<?php echo $file_img1;?>" onerror="this.style.display='none'">
							</dd>
							<dd class="info_subject">
								<?php if ($is_checkbox) { ?>
								<label for="chk_wr_id_<?php echo $v['wr_id'] ?>" class="sound_only"><?php echo $v['subject'] ?></label>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $v['wr_id'] ?>" id="chk_wr_id_<?php echo $v['wr_id'] ?>">
								<?php } ?>
								<?php if ($is_admin) { ?>
									<a href="<?php echo $v['href'] ?>"><?php echo $v['ca_name'].$v['subject'] ?></a>
								<?php } else {?>
									<?php echo $v['ca_name'].$v['subject'] ?>
								<?php } ?>
							</dd>
							<dd class="info_icon">
								<?php if ($v01) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img1.gif">
								<?php } ?>
								<?php if ($v02) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img2.gif">
								<?php } ?>
								<?php if ($v03) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img3.gif">
								<?php } ?>
							</dd>
							<dd class="info_logo">
							
								<img src="<?php echo $file_img2;?>" onerror="this.style.display='none'">
						
							</dd>
						</li>
						<input type="hidden" value="<?php echo $v['wr_1'] ?>">
					</ul>

					<ul id="mobileNew">
						<li>
							
							<dd class="info_img">	
						
									<img src="<?php echo $file_img1;?>" onerror="this.style.display='none'">
							</dd>
							
							<dd class="info_subject">
								<span class="info_logo">
								<img src="<?php echo $file_img2;?>" onerror="this.style.display='none'">
							</span>
							
							<?php if ($is_checkbox) { ?>
								<label for="chk_wr_id_<?php echo $v['wr_id'] ?>" class="sound_only"><?php echo $v['subject'] ?></label>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $v['wr_id'] ?>" id="chk_wr_id_<?php echo $v['wr_id'] ?>">
								<?php } ?>
								<?php if ($is_admin) { ?>
									<a href="<?php echo $v['href'] ?>"><?php echo $v['ca_name'].$v['subject'] ?></a>
								<?php } else {?>
									<?php echo $v['ca_name'].$v['subject'] ?>
								<?php } ?>
							</dd>
							<dd class="info_time eng">
							<?php echo $v['wr_2'] ?>
							<span class="info_icon">
								<?php if ($v01) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img1.gif">
								<?php } ?>
								<?php if ($v02) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img2.gif">
								<?php } ?>
								<?php if ($v03) { ?>
									<img src="<?php echo $board_skin_url?>/img/scd_img3.gif">
								<?php } ?>
							</span>
							
							</dd>
							
							
						</li>
						<input type="hidden" value="<?php echo $v['wr_1'] ?>">
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
			<?php if ($write_href) { ?><a href="<?php echo $write_href ?>">일정등록</a><?php } ?>
			</div>
	</form>
</div>
<div id="start"></div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>
<script>
$(document).ready(function(){

var datevalue = $('#datepicker').val();
$('#scdtabs-nav li').each(function(index,element){
	var livalue = $(this).find('input').val();
	
	if(livalue == datevalue) {
		$(this).addClass("active");
	}
});

$('#scdtabs-content dl').each(function(index,element){
	var livaluecont = $(this).attr('id');

	if(livaluecont == datevalue) {
		$(this).addClass("force");
		//$('.scdtab-content:first').hide();
	} else {

		//$('.scdtab-content:first').show();
	}
});


$('.scdtab-content').hide();

// Click function
$('#scdtabs-nav li').click(function(){
  $('#scdtabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.scdtab-content').hide();
  $('.scdtab-content').removeClass('force');
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
});
</script>

<?php if ($Ymd == '') { ?>
<script>
$('#scdtabs-nav li:first-child').addClass('active');
$('.scdtab-content:first-child').show();
</script>
<? } ?>
<!-- 캘린더 옵션 { -->
	<script>
    $.datepicker.setDefaults({
      //closeText: "닫기",
      prevText: "이전달",
      nextText: "다음달",
      currentText: "오늘",
      monthNames: ["1월", "2월", "3월", "4월", "5월", "6월",
        "7월", "8월", "9월", "10월", "11월", "12월"
      ],
      monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월",
        "7월", "8월", "9월", "10월", "11월", "12월"
      ],
      dayNames: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"],
      dayNamesShort: ["일", "월", "화", "수", "목", "금", "토"],
      dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"],
      weekHeader: "주",
      dateFormat: "yy.m.d", // 날짜형태 예)yy년 m월 d일
      firstDay: 0,
      isRTL: false,
	  showBottonPanel:false,
      showMonthAfterYear: true,
      yearSuffix: "년"
    })

    $(".datepicker").datepicker({
      minDate: 0
    })
	</script>
	<!-- } -->



<script>
$(function(){
	$("#datepicker").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $board_skin_url; ?>/img/sc_calendar.jpg",
		buttonImageOnly: true, 
			showOtherMonths: true, 
		changeMonth: false, 
		changeYear: false, 
		dateFormat: "yymmdd", 
		 showBottonPanel:false,
		yearRange: "c-99:c+99",
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
