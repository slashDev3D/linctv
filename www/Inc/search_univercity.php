<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<nav id="sch-contmenu" class="sch-contmenu">
          <ul>
		    <?
				$sql10 = " select * from {$g5['group_table']} where gr_id not in ('community','linctv','lincnews','lincevent') order by gr_order ";
				$result10 = sql_query($sql10);
				for ($i=0; $row10=sql_fetch_array($result10); $i++) { // gi 는 group index
			?>
            <li>
              <a href="#"><?php echo $row10['gr_subject']?></a>
              <div class="sch-contsub">
                <div class="sch-contsub-inner"> 
                  <div>
                    <ul>
						<?php
							$sql11 = " select *
										 from {$g5['board_table']}
										 where gr_id = '{$row10['gr_id']}'
										 and bo_list_level <= '{$member['mb_level']}'
										 and bo_device <> 'pc' ";

							if(!$is_admin)
							$sql11 .= " and bo_use_cert = '' ";
							$sql11 .= " order by bo_order ";
							$result11 = sql_query($sql11);

							for ($i=0; $row11=sql_fetch_array($result11); $i++) {
						?>
                      <li><a href="/bbs/board.php?bo_table=<?php echo $row11['bo_table']?>">#<?php echo $row11['bo_subject']?></a></li>
                       <? }  ?>
                    </ul>
                  </div>
                 
                </div><!-- /cbp-hrsub-inner -->
              </div><!-- /cbp-hrsub -->
            </li>
		<? }  ?>
		 <li>
           <a href="#">추천</a>
              <div class="sch-contsub">
				<div class="sch-contsub-inner"> 
                  <div>
                    <ul>
						<?php
						for ($i = 0; $i < count($contwordVal); $i++) {
						  if ($contwordVal[$i] != "") {?>
						 <li><a href="/bbs/search_contents.php?sfl=wr_subject%7C%7Cwr_content&sop=and&stx=<?php echo $contwordVal[$i];?>&lincsch=<?php echo $contwordVal[$i];?>"><span class="sch_num eng"><?php echo $i + 1;?>.</span> <?php echo $contwordVal[$i];?></a></li>
						 <? } } ?>
					</ul>
				</div>
				</div>
			  </div>
		 </li>
    </ul>  
 </nav>