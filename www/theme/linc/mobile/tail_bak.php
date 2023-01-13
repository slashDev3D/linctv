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


<div id="ft">
    <div class="ft_wr">
			<div class="footerlogo"><img src="<?php echo G5_THEME_URL ?>/img/footerlogo.jpg"></div>
            <div id="ft_company">
				<div class="floatL">
					 <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
					 <a href="#">자동 이메일 수집거부</a>
					 <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
				</div>
				 <div class="floatR">
					<ul class="dropdown en">
							<li><a href="#">Family Site <i class="xi-angle-up-min"></i></a>
								<ul class="sub_menu">
									 <li><a href="#">aaa</a></li>
									 
								</ul>
							</li>
						</ul>
						<ul class="footer_sns">
							<li>
								<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/facebook.png"></a>
							</li>
							<li>
								<a href="#"><img src="<?php echo G5_THEME_URL ?>/img/instargram.png"></a>
							</li>
						</ul>
				 </div>

            </div>
            
			<div class="ft_cnt">
				<p class="ft_info">
					회사명 : 주식회사 몽규&nbsp;&nbsp;&nbsp;대표 : 박성호<br>
					주소  : 서울특별시 마포구 성미산로 22길 18, 1~3층(연남동, 프로젝트 에이)&nbsp;&nbsp;&nbsp;사업자 등록번호  : <font class="eng">865-86-01676</font><br>
					<font class="eng">TEL :  02-123-4567&nbsp;&nbsp;&nbsp;FAX  : 02-123-4568</font>
					
				</p>
			</div>
			<div id="ft_copy" class="eng">Copyright &copy; <b>링크TV</b> All rights reserved.</div>

    </div>
	
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
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
			  <li class="active"><a href="#" class="eng">TV</a></li>
			  <li><a href="#" class="eng">CONTENTS</a></li>
			</ul>
		  </div>

		  <div id="sch-tab-cont">

		  <!--TV검색시작-->
			<div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
				 <!--<form method="get" name="fsearchbox">-->
               <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search_tv.php" onsubmit="return fsearchbox_submit(this);" method="get" class="multiple_form_sender">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력해주세요" required maxlength="20" autocomplete="off" class="tvsch">
			
				<div class="dropdown-keyword" style="position:absolute;top:0px;right:70px;width: 100%; ">
				  <div class="tv-keyword-dropdown">
					<div class="tv-keyword-select">
					  <span>추천</span>
					  <i class="fa fa-caret-down" aria-hidden="true"></i>
					</div>
					<input type="hidden" name="gender">
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
				<input type='button' value='전송2' onclick='return submitEtc(this.form);'> 
				<!--<button type="submit" value="검색" onclick="javascript:fsearchbox.action='<?php echo G5_BBS_URL ?>/search_tv.php';" id="sch_submit"/>111</button>-->
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
				</li>
			</div>
        </div>
		<!--TV검색끝-->

		<!--컨텐츠검색시작-->

		<div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search_contents.php" onsubmit="return fsearchbox_submit(this);" method="get">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력해주세요" required maxlength="20" autocomplete="off" class="contsch">
                <button type="submit" value="검색" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>

				<div class="dropdown-keyword" style="position:absolute;top:0px;right:70px;width: 100%; ">
				  <div class="cont-keyword-dropdown">
					<div class="cont-keyword-select">
					  <span>추천</span>
					  <i class="fa fa-caret-down" aria-hidden="true"></i>
					</div>
					<input type="hidden" name="gender">
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
			<div class="recommend_keyword">
				<li class="rkeyword_title">권역별<li>
				<li class="rkeyword">
				<? include_once('../Inc/search_univercity.php');?>
			</div>
        </div>
		<!--컨텐츠검색끝-->

	
	</div>
	
</section>

<a class="closeBtn"><i class="xi-close"></i></a>

<div id="sch_bottom"><button class="multiple_form_sender" name="sub1">Submit</button>
</div>
</section>
<section class="modal overlay"></div>
<script>

</script>



<script> 
  function submitEtc(frm) { 
    frm.action='<?php echo G5_BBS_URL ?>/search_tv.php'; 
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