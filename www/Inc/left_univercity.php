<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div id="pcNew">
<div class="uvMenu">
  <?
	$sql = " select * from {$g5['group_table']} where gr_id not in ('community','linctv','lincnews','lincevent') order by gr_order ";
    $result = sql_query($sql);
	for ($gi=0; $row=sql_fetch_array($result); $gi++) { // gi 는 group index
			$sql2 = " select count(*) as cnt from {$g5['board_table']} where gr_id = '{$row['gr_id']}' ";
			$row2 = sql_fetch($sql2);
			
			?>
			<li>
				<?php if ($gr_id == $row['gr_id']) { ?>
				<a href="/bbs/group_univercity.php?gr_id=<?php echo $row['gr_id']?>" class="active"><?php echo $row['gr_subject']?></a>
				<span class="uvCnt_ac eng"><?php echo $row2['cnt'] ?></span>
				<? } else { ?>
				<a href="/bbs/group_univercity.php?gr_id=<?php echo $row['gr_id']?>"><?php echo $row['gr_subject']?></a>
				<span class="uvCnt eng"><?php echo $row2['cnt'] ?></span>
				<?} ?>
			</li>
		<? //} ?>
	<?} ?>
</div>
</div>


<div id="mobileNew">
<div id="uvNav">

<a class="dropdown-toggle-linc" href="#"><?php echo $group["gr_subject"];?> <i class="xi-angle-down-min"></i></a>
<ul class="dropdown-linc">
	<?
	$sql = " select * from {$g5['group_table']} where gr_id not in ('community','linctv','lincnews','lincevent') order by gr_order ";
    $result = sql_query($sql);

	for ($gi=0; $row=sql_fetch_array($result); $gi++) { // gi 는 group index
			$sql2 = " select count(*) as cnt from {$g5['board_table']} where gr_id = '{$row['gr_id']}' ";
			$row2 = sql_fetch($sql2);
			
			?>

			<li>
				<?php if ($gr_id == $row['gr_id']) { ?>
				<a href="/bbs/group_univercity.php?gr_id=<?php echo $row['gr_id']?>" class="active"><?php echo $row['gr_subject']?></a>
				<span class="uvCnt_ac eng"><?php echo $row2['cnt'] ?></span>
				<? } else { ?>
				<a href="/bbs/group_univercity.php?gr_id=<?php echo $row['gr_id']?>"><?php echo $row['gr_subject']?></a>
				<span class="uvCnt eng"><?php echo $row2['cnt'] ?></span>
				<?} ?>
			</li>
		<? } ?>
	
</ul>

</div>
</div>