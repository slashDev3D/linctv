<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<div class="topuvMenu-wrap">
<div class="topuvMenu">
  <?
	$sql5 = " select *
						 from {$g5['board_table']}
						 where gr_id = '{$gr_id}'
						 and bo_list_level <= '{$member['mb_level']}'
						 and bo_device <> 'pc' ";

			if(!$is_admin)
			$sql5 .= " and bo_use_cert = '' ";
			$sql5 .= " order by bo_order ";
			$result5 = sql_query($sql5);


			for ($i=0; $row5=sql_fetch_array($result5); $i++) {
			
			?>

			<?php if ($bo_table == $row5['bo_table']) { ?>
			<li class="active">
				<a href="/bbs/board.php?bo_table=<?php echo $row5['bo_table']?>"><?php echo $row5['bo_subject']?></a>
			</li>
			<? } else { ?>
			<li>
				<a href="/bbs/board.php?bo_table=<?php echo $row5['bo_table']?>"><?php echo $row5['bo_subject']?></a>
			</li>
			<?} ?>

	<?} ?>
</div>
</div>
