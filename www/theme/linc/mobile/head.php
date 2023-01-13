<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$c_file = basename($_SERVER['SCRIPT_NAME']);
$sctoday = date('Ymd', G5_SERVER_TIME);
?>

<style>
#visit dd {color:#555 !important}
</style>

<div id="tnb">
    	<div class="inner">
			<ul style="float:left;"><?php echo visit('theme/Countup.basic');?></ul>
			<ul id="hd_qnb">
	            <li><a href="/bbs/board.php?bo_table=linc_event">이벤트</a></li>
	            <li><a href="/bbs/board.php?bo_table=schedule&sca=&Ymd=<?php echo $sctoday?>">편성표</a></li>
				<li><a href="/bbs/board.php?bo_table=news">소식지</a></li>
	        </ul>
		</div>
    </div>
<header id="hd" class="top">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

 

    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/m_logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
        <div id="hd_btn">
            <!--<button type="button" class="hd_menu_btn"><span class="menu-icon"></span><span class="sound_only">전체메뉴</span></button>-->
			<button type="button" class="hd_menu_btn"><span class="menu-icon"></span><span class="sound_only">전체메뉴</span></button>
            <button type="button" class="hd_sch_btn modalButton" data-popup="popupOne" id="mainSch">사업단을 검색해주세요<span class="search-icon"></span><span class="sound_only">검색열기</span></button>
            <?php //echo outlogin('theme/basic'); // 외부 로그인 ?>
        </div>

	 <div class="newmainMenu">
        <ul>
			 <li><a href="/lincInc/lincIntro.php">링크+TV</a>
				<ul>
					<li><a href="/lincInc/lincIntro.php">링크+ TV소개</a></li>
					<li><a href="/lincInc/linc_contents.php">링크+ TV콘텐츠</a></li>
				</ul>        
            </li>
			<li><a href="/bbs/board.php?bo_table=university01">성과영상 모아보기</a></li>
            <li><a href="/bbs/group_univercity.php?gr_id=lincArea01">LINC+사업단 바로가기</a></li>
            <li><a href="/bbs/board.php?bo_table=news">소식 모아보기</a>
				<ul>
					<li><a href="/bbs/board.php?bo_table=news">소식지</a></li>
					<li><a href="/bbs/board.php?bo_table=event">행사안내</a></li>
				</ul>
			</li>
			<li><a href="/bbs/board.php?bo_table=linc_event">이벤트</a></li>
        </ul>
    </div>
     
     

          <!--<div id="gnb">

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

        </div>-->

     
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
			/*
            $(".hd_sch_btn").on("click", function() {
                $("#hd_sch").show();
            });

            $("#hd_sch .btn_close").on("click", function() {
                $("#hd_sch").hide();
            });

			*/


        });
        </script>
        
    </div>

    <div id="al_menu">
        <div class="bg"></div>
        <div class="menu_wr">
		<div class="sidelogo">
			<img src="<?php echo G5_IMG_URL ?>/m_logo.png" alt="<?php echo $config['cf_title']; ?>">
			<br>
			<h2>학생과 대학, 그리고 기업을<br>
			모두 "<font class="eng">LINC</font>(링크)"해드릴게요!</h2>
			</div>
            <ul id="menu">
            <?php
            $menu_datas = get_menu_db(1, true);
			$i = 0;
			foreach( $menu_datas as $row ){
				if( empty($row) ) continue;
            ?>
                <li class="menu_li">
                    <h2><a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="menu_a"><?php echo $row['me_name'] ?></a></h2>
					
                   <!-- <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){
						if( empty($row2) ) continue;

                        if($k == 0)
                            echo ''.PHP_EOL;
                    ?>-->
					<?php if( $row['me_name'] == "링크+TV") {?>
						<button type="button" class="btn_menu_op"><span class="sound_only">하위분류</span><i class="xi-angle-down-min"></i></button>
						<ul class="sub_menu">
							<li class="sb_menu_li"><a href="/lincInc/lincIntro.php" class="sb_menu_a"><span></span>링크+ TV 소개</a></li>
							<li class="sb_menu_li"><a href="/lincInc/linc_contents.php" class="sb_menu_a"><span></span>링크+ TV 콘텐츠</a></li>
						</ul>
					<? } else if( $row['me_name'] == "소식 모아보기") { ?>
						<button type="button" class="btn_menu_op"><span class="sound_only">하위분류</span><i class="xi-angle-down-min"></i></button>
						<ul class="sub_menu">
							<li class="sb_menu_li"><a href="/bbs/board.php?bo_table=news" class="sb_menu_a"><span></span>소식지</a></li>
							<li class="sb_menu_li"><a href="/bbs/board.php?bo_table=event" class="sb_menu_a"><span></span>행사안내</a></li>
						</ul>

					<? } ?>
                   <!-- <?php
					$k++;
                    }?>

                    <? if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>-->
					
                </li>
            <?php
			$i++;
            }	//end foreach $row

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
            <?php } ?>
            </ul>
		
            <button type="button" class="btn_close"><i class="xi-close"></i><span class="sound_only">닫기</span></button>
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
<?php if (defined("_INDEX_")) { ?>

<? } ?>



    <?php if (!defined("_INDEX_") && !$wr_id) { 
		$lMenu = get_middle_navi();
		
		//$hTitle = ($lMenu['pTitle']?$lMenu['pTitle']:$lMenu['gTitle']);

		if ($c_file == "group_univercity.php") { 
			$hTitle = "LINC+사업단 바로가기";
		} else if ($c_file == "lincIntro.php") { 
			$hTitle = "링크+ TV 소개";
		} else if ($c_file == "linc_contents.php") { 
			$hTitle = "링크+ TV 콘텐츠";
		} else {
			$hTitle = ($lMenu['pTitle']?$lMenu['pTitle']:$lMenu['gTitle']);
		}
	?>
	



	<?php if (!defined("_INDEX_") && $stx) { ?>

	<div id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>">
		<div class="contain_inner_sch">
				<h2>"<strong><?php echo $stx ?></strong>"으로 <span>검색한 결과입니다.</span></h2>
		</div>
	</div>

	<? } else if ($gr_id == "linctv") { ?>
		<div id="container_title_linctv" class="top" title="<?php echo get_text($g5['title']); ?>">
		<div class="contain_inner_linctv">
				<h2><?php echo $hTitle ?></h2>
		</div>
	</div>
	<? } else { ?>

		<div id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>">

			<div class="sidearrow_prev">
				<?php if  ($c_file == "group_univercity.php") { ?>
					<span><a href="/bbs/board.php?bo_table=university01"><i class="xi-angle-left"></i>성과영상 모아보기</a></span>
				<?php } else if ($c_file == "lincIntro.php" || $c_file == "linc_contents.php") { ?>
					<span><a href="/bbs/board.php?bo_table=linc_event"><i class="xi-angle-left"></i> 이벤트</a></span>
				<?php } else if ($gr_id == "lincArea01" || $gr_id == "lincArea02" || $gr_id == "lincArea03" || $gr_id == "lincArea04" || $gr_id == "lincArea05") { ?>
					<span><a href="/lincInc/lincIntro.php"><i class="xi-angle-left"></i> 링크+ TV</a></span>
				<?php } else if ($gr_id == "lincnews") { ?>
					<span><a href="/bbs/group_univercity.php?gr_id=lincArea01"><i class="xi-angle-left"></i> LINC+사업단 바로가기</a></span>	
				<?php } else if ($gr_id == "lincevent") { ?>
					<span><a href="/bbs/board.php?bo_table=news"><i class="xi-angle-left"></i>소식 모아보기</a></span>
				<?php } ?>
			</div>


			<div class="sidearrow_next">
				<?php if  ($c_file == "group_univercity.php") { ?>
					<span><a href="/bbs/board.php?bo_table=news">소식 모아보기 <i class="xi-angle-right"></i></a></span>
				<?php } else if ($c_file == "lincIntro.php" || $c_file == "linc_contents.php") { ?>
					<span><a href="/bbs/board.php?bo_table=university01">성과영상 모아보기 <i class="xi-angle-right"></i></a></span>
				<?php } else if ($gr_id == "lincArea01" || $gr_id == "lincArea02" || $gr_id == "lincArea03" || $gr_id == "lincArea04" || $gr_id == "lincArea05") { ?>
					<span><a href="/bbs/group_univercity.php?gr_id=lincArea01"> LINC+사업단 바로가기 <i class="xi-angle-right"></i></a></span>	
				<?php } else if ($gr_id == "lincnews") { ?>
					<span><a href="/bbs/board.php?bo_table=linc_event">이벤트 <i class="xi-angle-right"></i></a></span>
				<?php } else if ($gr_id == "lincevent") { ?>
					<span><a href="/lincInc/lincIntro.php">링크+ TV <i class="xi-angle-right"></i></a></span>
				<?php } ?>
			</div>

			<div class="contain_inner">
				<h2><?php echo $hTitle ?></h2>
			</div>
					<div class="navpage">	
						<div class="location">
							<ul class="Fclear">
								<li class="homeactive"><a href="<?php echo(G5_URL);?>"><i class="xi-home-o"></i></a></li>

								<?php if  ($c_file == "group_univercity.php") { ?>
									<li><a href="<?php echo($lMenu['gLink']);?>">LINC+산학협력 고도화형<span class="sero_span"></span></a></li>
								<?php } else if ($gr_id == "lincArea01" || $gr_id == "lincArea02" || $gr_id == "lincArea03" || $gr_id == "lincArea04" || $gr_id == "lincArea05") { ?>
									<li><a href="<?php echo($lMenu['gLink']);?>">LINC+ 모아보기<span class="sero_span"></span></a></li>
								<?php } else if ($c_file == "lincIntro.php") { ?>
									<li><a href="<?php echo $G5_URL ?>/lincInc/lincIntro.php">링크+ TV 소개<span class="sero_span"></span></a></li>
									<li><a href="<?php echo $G5_URL ?>/lincInc/linc_contents.php">링크+ TV 콘텐츠</a></li>
								<?php } else if ($c_file == "linc_contents.php") { ?>
									<li><a href="<?php echo $G5_URL ?>/lincInc/lincIntro.php">링크+ TV 소개<span class="sero_span"></span></a></li>
									<li><a href="<?php echo $G5_URL ?>/lincInc/linc_contents.php">링크+ TV 콘텐츠</a></li>
								<?php } ?>
									<li><a href="<?php echo($lMenu['gLink']);?>"><?php echo($lMenu['gTitle']);?></a></li>
								<?php if($lMenu['pTitle']) { ?>
									<li class="unispan"><span class="sero_span_block"></span> <?php echo($lMenu['pTitle']);?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
		</div>
	<? } ?>



	<?php } ?>

		<?php if (($gr_id == "lincArea01" || $gr_id == "lincArea02" || $gr_id == "lincArea03" || $gr_id == "lincArea04" || $gr_id == "lincArea05") && $c_file !== "group_univercity.php") { ?>
			<? include_once('../Inc/top_univercity.php');?>
		<?php } ?>


		<?php if (($gr_id == "lincnews") && $c_file !== "group_univercity.php") { ?>
			<? include_once('../Inc/top_news.php');?>
		<?php } ?>



	<?php if ($bo_table == "linc_event") { ?>
	<div id="contents" style="max-width:100%;margin-top:0px">
	<?php } else { ?>
	<div id="contents">
	<?php } ?>


	<?php if (!defined("_INDEX_") && $gr_id && !$bo_table) { ?>
		<?php if ($gr_id == "lincArea01" || $gr_id == "lincArea02" || $gr_id == "lincArea03" || $gr_id == "lincArea04" || $gr_id == "lincArea05") { ?>
			<div id="aside">
				<? include_once('../Inc/left_univercity.php');?>
			</div>
		<?php } ?>
	<?php } ?>

	<?php if (!defined("_INDEX_")) { ?>
	<?php if ($c_file == "group_univercity.php") {  ?>
		<div id="contents_inner">
		<?php } else  { ?>
		<div id="contents_wide">

	<?php } ?>
	<?php } ?>

