<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

switch($bo_table){
    case "notice" : $img = "notice";  break;
    case "review" : $img = "notice";  break;
    case "menu" : $img = "notice"; break;
}
switch($co_id){
    case "about" : $img = "review";  break;
    case "fee" : $img = "review";  break;
    case "guide" : $img = "review";  break;
}

$c_file = basename($_SERVER['SCRIPT_NAME']);
switch($c_file){
    case "group_univercity.php" : $img = "guide" ;  break;    
}
?>

<header id="hd" class="top">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

 
	 <div id="tnb">
    	<div class="inner">
			<ul id="hd_qnb">
	            <li><a href="#">이벤트</a></li>
	            <li><a href="#">편성표</a></li>
				<li><a href="#" class="eng">NEWS LETTER</a></li>
	          
	        </ul>
		</div>
    </div>
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/m_logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
        <div id="hd_btn">
            <!--<button type="button" class="hd_menu_btn"><span class="menu-icon"></span><span class="sound_only">전체메뉴</span></button>-->
            <button type="button" class="hd_sch_btn"><span class="search-icon"></span><span class="sound_only">검색열기</span></button>
            <?php //echo outlogin('theme/basic'); // 외부 로그인 ?>
        </div>
        <div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어(필수)" required maxlength="20">
                <button type="submit" value="검색" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </form>

                <script>
                function fsearchbox_submit(f)
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

                    return true;
                }
                </script>
                <button type="button" class="btn_close"><i class="fa fa-times-circle"></i><span class="sound_only">검색</span></button>
            </div>
        </div>

        <div id="gnb">

            <ul id="gnb_1dul">
            <?php
            $menu_datas = get_menu_db(1, true);
			$i = 0;
			foreach( $menu_datas as $row ){
				if( empty($row) ) continue;
            ?>
                <li class="gnb_1dli">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){
						if( empty($row2) ) continue;

                        if($k == 0)
                            echo '<button type="button" class="btn_gnb_op">하위분류</button><ul class="gnb_2dul">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li>
                    <?php
					$k++;
                    }	//end foreach $row2

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
            <?php
			$i++;
            }	//end foreach $row

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
            <?php } ?>
            </ul>

        </div>

     
        <script>
        $(function () {
            //폰트 크기 조정 위치 지정
            var font_resize_class = get_cookie("ck_font_resize_add_class");
            if( font_resize_class == 'ts_up' ){
                $("#text_size button").removeClass("select");
                $("#size_def").addClass("select");
            } else if (font_resize_class == 'ts_up2') {
                $("#text_size button").removeClass("select");
                $("#size_up").addClass("select");
            }

            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });


            $(".btn_gnb_op").click(function(){
                $(this).toggleClass("btn_gnb_cl").next(".gnb_2dul").slideToggle(300);
                
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });

            $(".hd_sch_btn").on("click", function() {
                $("#hd_sch").show();
            });

            $("#hd_sch .btn_close").on("click", function() {
                $("#hd_sch").hide();
            });


        });
        </script>
        
    </div>

    <div id="al_menu">
        <div class="bg"></div>
        <div class="menu_wr">
            <ul id="menu">
            <?php
            $menu_datas = get_menu_db(1, true);
			$i = 0;
			foreach( $menu_datas as $row ){
				if( empty($row) ) continue;
            ?>
                <li class="menu_li">
                    <h2><a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="menu_a"><?php echo $row['me_name'] ?></a></h2>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){
						if( empty($row2) ) continue;

                        if($k == 0)
                            echo '<button type="button" class="btn_menu_op"><span class="sound_only">하위분류</span><i class="fa fa-chevron-down"></i></button><ul class="sub_menu">'.PHP_EOL;
                    ?>
                        <li class="sb_menu_li"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="sb_menu_a"><span></span><?php echo $row2['me_name'] ?></a></li>
                    <?php
					$k++;
                    }	//end foreach $row2

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
            <?php
			$i++;
            }	//end foreach $row

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
            <?php } ?>
            </ul>
            <button type="button" class="btn_close"><i class="fa fa-times"></i><span class="sound_only">닫기</span></button>
        </div>
        <script>
        $(".btn_menu_op").click(function(){
            $(this).next(".sub_menu").slideToggle(300);
        });
        $("#al_menu .btn_close").click(function(){
            $("#al_menu").hide();
        });
        $(".hd_menu_btn").click(function(){
            $("#al_menu").show();
        });
        </script>
    </div>
</header>



<div id="wrapper">



    <?php if (!defined("_INDEX_") && !$wr_id) { ?>
	
	<h2 id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>">
	<?php //echo get_head_title($g5['title']); ?>
	<?php echo $img; ?>
	</h2>

	<?php } ?>
<?php
if(!defined("_INDEX_")) {
    //중간 메뉴 정의
    $lMenu = get_middle_navi();
?>
<!-- 서브 중간 시작 { -->
        <div id="contentBOX" class="SUBskin Fclear">
			<div class="subtop">

				<div class="location">
					<ul class="Fclear">
						<li class="home"><a href="<?php echo(G5_URL);?>" class="home">home</a></li>
						<li><a href="<?php echo($lMenu['gLink']);?>"><?php echo($lMenu['gTitle']);?>11</a></li>
                        <?php if($lMenu['pTitle']) { ?>
						<li><?php echo($lMenu['pTitle']);?>22</li>
                        <?php } ?>
					</ul>
					<div class="page_title">aaa</div>
				</div>
			</div><!--// subtop -->


			<!--// <div id="submenu" class="Fleft padd_right30">
				<dl class="lnb">
					<dt><?php echo($lMenu['gTitle']);?></dt>
                    <?php
                    if($lMenu['cnt']) {
                        for($i=0; $i<$lMenu['cnt']; $i++) {
                            $lm = $lMenu[$i];

                            if($co_id)
                                $sel = strstr($lm['me_link'],$co_id)?" class='select' ":"";
                            if($bo_table)
                                $sel = strstr($lm['me_link'],$bo_table)?" class='select' ":"";
                    ?>
					<dd <?php echo($sel);?>><a href="<?php echo($lm['me_link']);?>"><?php echo($lm['me_name']);?></a></dd>
                    <?php
                        }
                    }
                    ?>
				</dl>
			</div>submenu -->


<?php
}
?>

 <!-- 
	<ul class="navbar-nav">
		<?php
		$sql = " select *
		from {$g5['menu_table']}
		where me_use = '1'
		and length(me_code) = '2'
		order by me_order, me_id ";

		$result = sql_query($sql, false);

	
		
		for ($i=0; $row=sql_fetch_array($result); $i++) {

		$li_view1 = $i+1; // #2 각각의 메뉴명을 추가하기위해 설정
		$cur_url = 'https://linctv.cafe24.com'.$_SERVER['REQUEST_URI']; // #1 현재위치 설정용으로 추가
		$linkme = $row['me_link'];
 
		echo $li_view1;	
		//echo $row['me_link'];
		//echo "<br>".$cur_url;
		//echo "<br>".$row['me_link']."==".$cur_url; //두 변수의 값이 같나요?
		//$var_active = strpos($cur_url, $row['me_link']);
		//echo $var_active;

		//if(strpos($cur_url,$linkme) !== false) {  
			//echo "포함되어 있습니다만...";  
		//} else {  
			//echo "없군요.";  
		//}  

		?>
		 <?php if(strpos($cur_url,$linkme) !== false) {  ?>
			<li>
				<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>">
					<div class="name">
					<?php echo $row['me_name'] ?>
					</div>
					<div class="dot"></div>
				</a>
			</li>
		
		<?php }else if($bo_table) { ?>
aaaaaa

		<?php } ?>
		<?php } ?>
	</ul>

   현재 위치 표시
        <i class="fas fa-arrows-alt"></i> 현재위치 : <a href="<?php echo G5_URL ?>">Home</a>
		<? if($gr_id) { ?><?php echo $group['gr_subject'];?><?}?>
        <?
		echo $gr_id;
            if($bo_table) 
            {  //게시판에 들어 갔을 경우
            if($group[gr_subject]!='') { 
                echo " > <a href='$g5[path]/group/$group[gr_id]'>$group[gr_subject]</a>"; } // 그룹 이름 출력
            if($board[bo_subject]!='') { // 게시판 이름 출력
            echo " > <a href='$g5[path]/$board[bo_table]'>$board[bo_subject]</a>";
			}


            if ($sca) {
            echo " > $sca";     } // 카테고리 이름 출력
                } else { 
            echo " > $g5[title]"; 
			
			} //일반페이지에 접속했을 경우
            //echo " > ";
            //echo cut_str($write[wr_subject], 25);  // 게시물 제목 출력, 현재는 미표시, #제거하면 표시
        ?>-->

	<div id="contents">

	<?php if (!defined("_INDEX_") && $gr_id && !$bo_table) { ?>
	<div id="aside">
	<?php if ($gr_id) { ?>
	<? include_once('../Inc/left_univercity.php');?>
	<?php } ?>
    </div>
	<?php } ?>

	<?php if (!defined("_INDEX_") && $gr_id && !$bo_table) { ?>
	<?php echo $bo_table?>
		<div id="contents_inner">
	<?php } else  { ?>
	
		<div id="contents_wide">
	<?php } ?>
