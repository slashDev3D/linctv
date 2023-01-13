<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
<div>
    <img src="http://도메인주소/skin/latest/basic_red/img/title_latest.gif" width="4" height="14" align="absmiddle" alt="" />
    &nbsp;<b>최신글 참</b>
    &nbsp;
    <a href="<?php echo G5_BBS_URL ?>/new.php?gr_id=<?php echo $gr_id ?>"><img src="http://도메인주소/skin/latest/basic_red/img/btn_more.gif" align="absmiddle" alt="" /></a>
</div>
<div style="margin:3px 0 5px 10px; background:#ffffff; height:1px;"></div>

<table width=100% cellpadding=0 cellspacing=0>
<?php for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td width="5" align=center>
        <img src='http://도메인주소/skin/latest/basic_red/img/dot_red.gif' width="4" height="4" align=absmiddle>
    </td>
    <td style="padding-left:5px;">
         <?php
            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
            if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
            if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
 
            echo "<a href=\"".$list[$i]['href']."\"> ";
            //기존그룹명칭불러오는곳  echo "[".$list[$i]['bo_subject']."] ";
			
            if ($list[$i]['is_notice'])
            echo "<font style='font-family:돋움; font-size:9pt; color:#2C88B9;'><strong>{$list[$i]['subject']}</strong></font>";
        else
            echo "<font style='font-family:돋움; font-size:9pt; color:#6A6A6A;'>{$list[$i]['subject']}</font>";
        echo "</a>";

            if ($list[$i]['comment_cnt']) 
            echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:10pt; color:#6cb7e0;'>[{$list[$i]['comment_cnt']}]</span></a>";
            ?>
           <span class="lt_date"><?php //날짜불러오는곳 echo $list[$i]['datetime2'] ?></span>
    </td>
</tr>
<tr>
    <td colspan="3">
        <div style="margin:3px 0 5px 10px; background:url(http://도메인주소/skin/latest/basic_red/img/bg_dot.gif); height:5px;"></div>
    </td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A>게시물이 없습니다.</a></td></tr><? } ?>

</table>
