<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$tvwordVal = explode("|", $config['cf_1']);
$contwordVal = explode("|", $config['cf_2']);
//print_r ($chbVal);
?>
</div>
</div>
    </div>
</div>

<div class="darkmodeLinc">
    <button id="mode-remover" class="btn hidden" title="Clear saved mode">
      &times;
    </button>
    <button id="mode-toggler" class="btn"><span class="darkbtn"></span></button>
	<!--<button id="mode-toggler" class="btn">🌙 <span class="darkbtn">다크모드</span></button>-->
</div>

<script src="<?php echo G5_THEME_URL;?>/js/darkmode.js"></script>
<script>
    // Plugin Initialization
    var options = {
			light: '<?php echo G5_THEME_CSS_URL?>/color/light.css',
			dark: '<?php echo G5_THEME_CSS_URL?>/color/dark.css',
    }
    var DarkMode = new DarkMode(options)

    // Remove mode from LocalStorage if button clicked
    var ModeRemover = document.getElementById('mode-remover')
    ModeRemover.onclick = function() {
      DarkMode.clearSavedMode()
      changeTogglerText()
      getModeRemoverState()
    }

    // Detects mode on LocalStorage, if `true` – display a button
    getModeRemoverState()
    function getModeRemoverState() {
      if(DarkMode.isModeSaved())
        ModeRemover.classList.remove('hidden')
      else
        ModeRemover.classList.add('hidden')
    }
    
    // Function for `mode-toggler` button
    var ModeToggler = document.getElementById('mode-toggler')
	  changeTogglerText()
	  ModeToggler.onclick = function() {
      DarkMode.toggleMode()
      changeTogglerText()
	   //ModeToggler.addClass('abc')

    }
    
    // Changes `mode-toggler` text on mode changing
    function changeTogglerText() {
      getModeRemoverState()
      var currentMode = DarkMode.getMode()
     // ModeToggler.textContent = currentMode === 'light'  ? '<span>🌙 다크모드' : '☀️ 라이트 모드'
	 // ModeToggler.innerHTML = currentMode === 'light'  ? '🌙 <span>다크모드</span>' : '☀️ <span>라이트 모드</span>'
	 ModeToggler.innerHTML = currentMode === 'light'  ? '<span class="darkbtn"></span>' : '<span class="lightbtn"></span>'
	 //ModeToggler.addClass("")
    }

</script>

<div id="ft">
    <div class="ft_wr">
            <div>
                <div id="ft_company">
                    <!--
                    <div class="floatL">
                        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
                        <a href="#">자동 이메일 수집거부</a>
                        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
                    </div>
                    -->
                    
                    <div class="floatR">
                        <ul class="dropdown en">
                                <li><a href="#">Family Site <i class="xi-angle-up-min"></i></a>
                                    <ul class="sub_menu">
                                        <li><a href="http://lincpluson.or.kr/html/main.php">LINC+</a></li>
                                        <li><a href="https://lincplus.nrf.re.kr/">LINC+ 사업단 협의회</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="footer_sns">
                                <li>
                                    <a href="ttps://www.youtube.com/channel/UCLXFkJr1mEY-ZUxym7__bZw" target="_blank"><i class="xi-youtube-play"></i><!--img src="<?php echo G5_THEME_URL ?>/img/facebook.png"--></a>
                                </li>
                            </ul>
                    </div>
                </div>
                <div class="footerlogo">
                    <li><a href="https://www.moe.go.kr/" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/footerlogo01.png"></a></li>
                    <li><a href="https://www.nrf.re.kr/" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/footerlogo02.png"></a></li>
                    <li class="footerlinc"><a href="https://lincplus.nrf.re.kr/" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/footerlogo04.png"></a></li>
                    <li><a href="https://www.uicc.re.kr/member/mainlogin.do" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/footerlogo03.png"></a></li>
                </div>
            </div>
            <div id="ft_copy" class="eng">
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
                <div class="cp">
                법인명 : 주식회사 몽규<span></span>대표자 : 박성호<span></span>사업자번호 : 865-86-01676<br />
                주소 : 서울특별시 마포구 성미산로 22길 18, 3층(연남동)<span></span>대표번호 : 02-6404-9204
                </div>
                <div class="cpb">Copyright &copy; <b>링크TV</b> All rights reserved.</div>
            </div>
    </div>

	<a href="https://www.youtube.com/channel/UCLXFkJr1mEY-ZUxym7__bZw" id="youtb_btn" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/ic_youtube.png"></a>
	<a href="http://pf.kakao.com/_sUzns" id="kakao_btn" target="_blank"><img src="<?php echo G5_THEME_URL ?>/img/ic_kakao_pluse.png"></a>
    <button type="button" id="top_btn"><i class="xi-long-arrow-up"></i><span class="sound_only">상단으로</span></button>


    <?php
    if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
    <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
    <?php
    }

    if ($config['cf_analytics']) {
        echo $config['cf_analytics'];
    }
    ?>
</div>

<section class="modal modalWindow" id="popupOne">  
	<section class="modalWrapper">
		<div id="sch-tab-menu">
		  <div id="sch-tab-btn">
			<ul>
			  <li class="active"><a href="#" class="eng">CONTENTS</a></li>
			  <li><a href="#" class="eng">TV</a></li>
			</ul>
		  </div>

		  <div id="sch-tab-cont">


		<!--컨텐츠검색시작-->

		<div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search_contents.php" onsubmit="return fsearchbox_submit(this);" method="get">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력해주세요" required maxlength="20" autocomplete="off" class="contsch">
                <button type="submit" value="검색" id="sch_submit"><i class="xi-search"></i><span class="sound_only">검색</span></button>

				<div class="dropdown-keyword" style="position:absolute;top:-15px;right:20px;width: 100%; ">
				  <div class="cont-keyword-dropdown">
					<div class="cont-keyword-select">
					  <span>추천</span>
					 <i class="xi-caret-down-min"></i>
					</div>
					<input type="hidden" name="lincsch">
					<ul class="cont-keyword-dropdown-menu">
					<?php
						for ($i = 0; $i < count($contwordVal); $i++) {
						  if ($contwordVal[$i] != "") {?>
						 <li id="<?php echo $contwordVal[$i];?>"><span class="eng"><?php echo $i + 1;?></span> <?php echo $contwordVal[$i];?></li>
						 <? } } ?>
					</ul>
				  </div>			  
				<span class="msg"></span>
				</div>
				<div class="recommend_keyword">
				<li class="rkeyword_title">권역별<li>
				<li class="rkeyword">
				<? include_once('./Inc/search_univercity.php');?>
				</div>


				<div id="sch_bottom">
					<button class="erase" onclick="clearInputCont()">지우기</button>
					<input type='button' value='검색' onclick='return submitEtcCont(this.form);' class="etcSearch">
				</div>

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
            
            </div>
			
        </div>
		<!--컨텐츠검색끝-->

		
		  <!--TV검색시작-->
			<div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
				 <!--<form method="get" name="fsearchbox">-->
               <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search_tv.php" onsubmit="return fsearchbox_submit(this);" method="get" class="multiple_form_sender">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력해주세요" required maxlength="20" autocomplete="off" class="tvsch">
			
				<div class="dropdown-keyword" style="position:absolute;top:-15px;right:20px;width: 100%; ">
				  <div class="tv-keyword-dropdown">
					<div class="tv-keyword-select">
					  <span>추천</span>
					  <i class="xi-caret-down-min"></i>
					</div>
					<input type="hidden" name="lincsch">
					<ul class="tv-keyword-dropdown-menu">
					<?php
						for ($i = 0; $i < count($tvwordVal); $i++) {
						  if ($tvwordVal[$i] != "") {?>
						 <li id="<?php echo $tvwordVal[$i];?>"><span class="eng"><?php echo $i + 1;?></span> <?php echo $tvwordVal[$i];?></li>
							
						 <? } } ?>
					</ul>
				  </div>			  
				<span class="msg"></span>
				</div>
				
				
				<div class="recommend_keyword">
				<li class="rkeyword_title">추천키워드<li>
				<li class="rkeyword">
				
				  <?
					$sql9 = " select * from {$g5['board_table']} where gr_id = 'linctv' and bo_device <> 'mobile' order by bo_order ";
					$result9 = sql_query($sql9);
					for ($i=0; $row9=sql_fetch_array($result9); $i++) { // bi 는 board index	
					?>
					<span><a href="/bbs/board.php?bo_table=<?php echo $row9['bo_table']?>"><?php echo $row9['bo_subject']?></a></span>
				<? } ?>
					<div id="sch-contmenu" class="sch-contmenu sch-contmenu-tv">
					<ul>
					  <li>
						<a href="#">추천</a>
						  <div class="sch-contsub">
							<div class="sch-contsub-inner"> 
							  <div>
								<ul>
									<?php
									for ($i = 0; $i < count($tvwordVal); $i++) {
									  if ($tvwordVal[$i] != "") {?>
									 <li><a href="/bbs/search_tv.php?sfl=wr_subject%7C%7Cwr_content&sop=and&stx=<?php echo $tvwordVal[$i];?>&lincsch=<?php echo $tvwordVal[$i];?>"><span class="sch_num eng"><?php echo $i + 1;?>.</span> <?php echo $tvwordVal[$i];?></a></li>
									 <? } } ?>
								</ul>
								</div>
							</div>
						  </div>
						</li>
					</ul>
				   </div>
				</li>
			 </div>

				<!--<button type="submit" value="검색" onclick="javascript:fsearchbox.action='<?php echo G5_BBS_URL ?>/search_tv.php';" id="sch_submit"/>111</button>-->
                <button type="submit" value="검색" id="sch_submit"><i class="xi-search"></i><span class="sound_only">검색</span></button>
				
				<div id="sch_bottom">
				<button class="erase" onclick="clearInputTv()">지우기</button>
				<input type='button' value='검색' onclick='return submitEtc(this.form);' class="etcSearch">
				</div>
				
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
            </div>

			
        </div>
		<!--TV검색끝-->

	
	</div>
	
</section>

<a class="closeBtn"><i class="xi-close"></i></a>

</section>
<section class="modal overlay"></div>

<script>
function clearInputCont(){
var el = document.getElementsByClassName('contsch');
	for(var i=0; i<el.length; i++){
		el[i].value = '';
	}
}

function clearInputTv(){
var el = document.getElementsByClassName('tvsch');
	for(var i=0; i<el.length; i++){
		el[i].value = '';
	}
}
</script>



<script> 
  function submitEtc(frm) { 
    frm.action='<?php echo G5_BBS_URL ?>/search_tv.php'; 
    frm.submit(); 
    return true; 
  } 

    function submitEtcCont(frm) { 
    frm.action='<?php echo G5_BBS_URL ?>/search_contents.php'; 
    frm.submit(); 
    return true; 
  } 
</script> 


<script>
jQuery(function($) {

    $( document ).ready( function() {
                
        //상단고정
        if( $(".top").length ){
            var jbOffset = $(".top").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '.top' ).addClass( 'fixed' );
                }
                else {
                    $( '.top' ).removeClass( 'fixed' );
                }
            });
        }

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
        
        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

    });
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>