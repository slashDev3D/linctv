<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<div>
    <img src="http://도메인주소/skin/latest/basic_red2/img/title_latest.gif" align="absmiddle" alt="" />
    &nbsp;<b>추천수 Best</b>
    &nbsp;
    <a href="<?=$g5[bbs_path]?>/bbs/board.php?bo_table=<?=$bo_table?>"><img src="http://도메인주소/skin/latest/basic_red2/img/btn_more.gif" align="absmiddle" alt="" /></a>
</div>
<div style="margin:3px 0 5px 10px; background:#ffffff; height:1px;"></div>

<table width=100% cellpadding=0 cellspacing=0>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td width="5" align=center>
        <img src='http://도메인주소/skin/latest/basic_red2/img/dot_red.gif' align=absmiddle>
    </td>
    <td style="padding-left:5px;">
       
        <img src="http://도메인주소/skin/latest/basic_red2/img/btn<?=$titles?>_<?=$i+1?>.gif" class="subject img"> 
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\">";
            if ($list[$i]['is_notice'])
                echo "<font style='font-family:돋움; font-size:9pt; color:#2C88B9;'><strong>{$list[$i]['subject']}</strong></font>";
            else
                echo "<font style='font-family:돋움; font-size:9pt; color:#6A6A6A;'>{$list[$i]['subject']}</font>";

            if ($list[$i]['comment_cnt'])
                echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:10pt; color:#6cb7e0;'>[{$list[$i]['comment_cnt']}]</span></a>";

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
            ?>
            
        
        
    </td>
</tr>
<tr>
    <td colspan="3">
        <div style="margin:3px 0 5px 10px; background:url(http://도메인주소/skin/latest/basic_red2/img/bg_dot.gif); height:5px;"></div>
    </td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A>게시물이 없습니다.</a></td></tr><? } ?>

</table>
