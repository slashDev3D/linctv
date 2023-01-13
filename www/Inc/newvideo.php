<!--<style>
p { padding:0; margin:0; }
article { position:relative; font-family:'Nanum Barun Gothic', sans-serif; width:329px; height:172px; padding:28px 30px; margin:0 15px 15px 0; border-right:solid 1px #e4e4e4; border-bottom:solid 1px #c6c6c6; background:#fff; }
article > h1 { margin:0; font-size:18.5px; font-weight:700; color:#555; letter-spacing:-0.4px; }
.mct_more { position:absolute; top:29px; right:30px; font-size:14.5px; font-weight:700; color:#adadad !important; line-height:19px; padding:2px 21px 0 0; background:url('./icon_more.jpg') right 1px no-repeat; }

.ltst_01 { padding-bottom:16px; border-bottom:solid 1px #e4e4e4; }
.ltst_01 > p { margin-top:14px; font-size:16px; font-weight:400; line-height:24px; letter-spacing:-0.35px; color:#4a4a4a; }
.ltst_01 > p > u { text-decoration:none; margin-left:-2px; }
.ltst_01 > p > a { color:#4a4a4a; }
.ltst_01 > span { display:inline-block; margin-top:4px; font-size:12px; font-weight:400; letter-spacing:-0.5px; color:#9a9a9a; }

.ltst_02 { list-style:none; line-height:23px; font-size:12px; font-weight:400; padding:0; margin:12px 0 0 -3px; }
.ltst_02 > li { color:#767676; }
.ltst_02 > li > nobr > a { color:#767676; }
</style>

<article>

	<h1>최신</h1>

	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="mct_more mct_more_ltst">MORE</a>

	<?php
	$row_lat_0 = sql_fetch(" select a.*, b.bo_subject, c.gr_subject, c.gr_id from g5_board_new a, g5_board b, g5_group c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and c.gr_id = 'linctv' order by a.bn_id desc limit 0, 1 ");
	$row_lat_00 = sql_fetch(" select wr_id, wr_subject, wr_datetime from g5_write_{$row_lat_0['bo_table']} where wr_id = '{$row_lat_0['wr_id']}' ");
	?>
	<div class="ltst_01">
		<p><u>[<?php echo $row_lat_0['bo_subject']; ?>]</u><br><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row_lat_0['bo_table']; ?>&wr_id=<?php echo $row_lat_00['wr_id']; ?>"><nobr><?php echo cut_str($row_lat_00['wr_subject'],'26','…'); ?></nobr></a></p>
		<span><?php echo date('Y-m-d', strtotime($row_lat_00['wr_datetime'])); ?></span>
	</div>

	<ul class="ltst_02">
	
	<?php
	$sql_lat_1 = " select a.*, b.bo_subject, c.gr_subject, c.gr_id from g5_board_new a, g5_board b, g5_group c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and c.gr_id = 'linctv' order by a.bn_id desc limit 1, 2 ";
	$rst_lat_1 = sql_query($sql_lat_1);
	for ($i=0; $row_lat_1=sql_fetch_array($rst_lat_1); $i++){

		$row_lat_11 = sql_fetch(" select wr_id, wr_subject from g5_write_{$row_lat_1['bo_table']} where wr_id = '{$row_lat_1['wr_id']}' ");
	?>

		<li><nobr>• <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row_lat_1['bo_table']; ?>&wr_id=<?php echo $row_lat_1['wr_id']; ?>">[<?php echo $row_lat_1['bo_subject']; ?>] <?php echo cut_str($row_lat_11['wr_subject'],'28','…'); ?></nobr></a></li>

	<?php } ?>

	</ul>

</article>-->
<!-- 최신글 시작 { -->
