<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<?php // 게시판 관리의 상단 내용
if (G5_IS_MOBILE) {
   // echo '<div class="bo_top_img">';
    // 모바일의 경우 설정을 따르지 않는다.
   // echo html_purifier(stripslashes($board['bo_mobile_content_head']));
   //  echo '</div>';

} 
?>

<style>
.topuvMenu-wrap {display:none}
</style>

<article id="bo_v">
    <header>
        <h2 class="sound_only">
            <?php if ($category_name) { ?>
                <span class="bo_v_cate"><?php echo $view['ca_name']; // 분류 출력 끝 ?></span> 
            <?php } ?>
            <span class="bo_v_tit">
            <?php
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?></span>
        </h2>

    </header>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        
        <div id="bo_v_con">
            <div class="team_name"><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력?></div>
            <ul class="team_sub">

                <?php if ($category_name || $view['wr_1'] || $view['wr_2'] || $view['wr_3'] ) { ?>
                <li class="tp">
                    <?php if ($category_name) { ?>사업분야 : <?php echo $view['ca_name']?><span class="bar"></span><?php } ?>
                    <?php if ($view['wr_1']) { ?>작성일 : <?php echo date("Y-m-d", strtotime($view['wr_1'])) ?><span class="bar"></span><?php } ?>
                    <?php if ($view['wr_2']) { ?>업로드일 : <?php echo date("Y-m-d", strtotime($view['wr_2'])) ?><span class="bar"></span><?php } ?>
                    담당자 : <?php echo $view['wr_3'];?><?php if ($view['wr_6']) { ?>/<?php echo $view['wr_6'];?><?php } ?><span class="bar"></span>
                    
                </li>
                <?php } ?>
                
                <li class="bt">
                    출처 : <?php echo $view['wr_3'];?> 
                    <?php if ( $view['wr_5'] != '' && $view['wr_5'] != '-') { ?>
                        <a href="<?php echo $view['wr_5'] ?>" target="_blank">[참고출처 바로가기]</a>
                    <?php } ?>
                </li>
            
            </ul>

            <div class="team_font">
                <button type="button" id="fontdown">가</button>
                <button type="button" id="fontup">가</button>
            </div>

            <!-- 
            <?php //if ($view['wr_4']) { ?>
                <div class="tean_con">
                    <?php //echo $view['wr_4']?>
                </div>
            <? //} ?> 
            -->
			<div class="cont_inner"><?php echo nl2br($view['content']); ?></div>

		<?php
		if ($view['file']['count']) {
			$cnt = 0;
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
					$cnt++;
			}
		}
		 ?>
		<?php if($cnt) { ?>
			<tr>
				<th>첨부파일</th>
				<td>
				<?php
				// 가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
				 ?>
					<span>
						<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
							<i class="fa fa-download" aria-hidden="true"></i>
							<strong><?php echo $view['file'][$i]['source'] ?></strong>
							<?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
						</a>
						<!--<span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span> |
						<span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>-->
					</span>
				<?php
					}
				}
				 ?>
				 </td>
			</tr>
		<?php } ?>




        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";
            for ($i=1; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>


    

		
			
		</div>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>


        
    
    </section>



    <?php if(isset($view['link'][1]) && $view['link'][1]) { ?>
    <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>

    <div id="bo_v_share">
        <?php include_once(G5_SNS_PATH."/view.sns.skin.php");?>
    </div>
    


    <?php if ( $good_href || $nogood_href) { ?>
    <div id="bo_v_act">
        <?php if ($good_href) { ?>
        <span class="bo_v_act_gng">
            <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button"  class="bo_v_good btn_m btn_b01"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="sound_only">추천</span><strong><?php echo number_format($view['wr_good']) ?></strong></a>
            <b id="bo_v_act_good">이 글을 추천하셨습니다</b>
        </span>
        <?php } ?>
        <?php if ($nogood_href) { ?>
        <span class="bo_v_act_gng">
            <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="bo_v_nogood btn_m btn_b01"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <span class="sound_only">비추천</span><strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
            <b id="bo_v_act_nogood"></b>
        </span>
        <?php } ?>
    </div>
    <?php } else {
        if($board['bo_use_good'] || $board['bo_use_nogood']) {
    ?>
    <div id="bo_v_act">
        <?php if($board['bo_use_good']) { ?><span class="bo_v_good btn_m btn_b01"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="sound_only">추천</span><strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
        <?php if($board['bo_use_nogood']) { ?><span class="bo_v_nogood btn_m btn_b01"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <span class="sound_only">비추천</span> <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
    </div>
    <?php
        }
    }
    ?>



    <?php if ($prev_href || $next_href) { ?>
    <ul class="bo_v_nb">
        <?php if ($prev_href) { ?><li class="bo_v_prev"><a href="<?php echo $prev_href ?>"><i class="fa fa-chevron-up" aria-hidden="true"></i> <span class="t">PREV</span><span class="bar"></span><?php echo $prev_wr_subject;?></a></li><?php } ?>
        <?php if ($next_href) { ?><li class="bo_v_next"><a href="<?php echo $next_href ?>"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span class="t">NEXT</span><span class="bar"></span><?php echo $next_wr_subject;?></a></li><?php } ?>

    </ul>
    <?php } ?>

  
    <div id="bo_v_top">
        <ul class="bo_v_left">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01 btn_m">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 btn_m" onclick="del(this.href); return false;"> 삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_b01 btn_m" onclick="board_move(this.href); return false;"> 복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_b01 btn_m" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01 btn_m">검색</a></li><?php } ?>

        </ul>
        <div class="bo_v_right"> 
            <a href="<?php echo $list_href ?>" class="btn_b01 btn_m">목록</a>
            <?php if ($reply_href) { ?><a href="<?php echo $reply_href ?>" class="btn_b01 btn_m">답변</a><?php } ?>
            <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_b02 btn_m">글쓰기</a><?php } ?>

        </div>
    </div>

  
    <?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

</article>

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<!-- 게시글 보기 끝 -->

<script>
$(function() {


    $("#fontup").click(function () {
        var size = parseFloat($(".cont_inner").css("font-size"), 10);
        var up = size+1;
        if( up <= 30){
            $( ".cont_inner" ).css( "font-size",  up);
        }
    });

    $("#fontdown").click(function () {
        var size = parseFloat($(".cont_inner").css("font-size"), 10);
        var down = size-1;
        if( down >= 12){
            $( ".cont_inner" ).css( "font-size",  down);
        }
    });


    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}



</script>