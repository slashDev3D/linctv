<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 297;
$thumb_height = 212;
$list_count = (is_array($list) && $list) ? count($list) : 0;

$is_images = true;//true:이미지출력, false:이미지숨김

$caption = 2; //0:캡션없음, 1:캡션숨김, 2:일반캡션, 3:호버캡션
$is_caption = ($caption == "1") ? false : true;

$img_wrap = ($thumb_width > 0 && $thumb_height > 0) ? round(($thumb_height / $thumb_width) * 100, 2) : 75;
?>
	<div class="pic_box_list box">
		<div class="in_box">
			<div class="middle_box">
				<div class="in_middle_box">
					<h2 class="h2_widget">
						<?php echo $bo_subject ?>
						<a class="h2_widget_a" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span>more</span><i class="fa fa18 fa-plus"></i></a>
					</h2>
					<div class="in_widget<?php echo ($caption == "3") ? ' is-hover' : ''; // 호버캡션 ?>">
						<div class="widget-wrapper " style="">
							<div class="WrapWidget_D">
								<div class="wrap_widgetDW">
									<div class="widgetTable_DW">
										
											<?php
											for ($i=0; $i<$list_count; $i++) {

												$tr_class = ($i%2==0)?'dw':'';

												$caption_html = '';

												if( $is_images && $i === 0 ) {
													$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

													if($thumb['src']) {
														$img = $thumb['src'];
														$img_content = run_replace('thumb_image_tag', '<img src="'.$img.'" alt="'.$thumb['alt'].'" class="wr-img">', $thumb);
													} else {
														$img_content = '<div class="thumb-icon"><div class="wr-fa"><i class="fa fa-picture-o"></i></div></div>';
													}

													if($is_caption && $caption) { $caption_html = '<div class="in-subject ellipsis">'.$list[$i]['subject'].'</div>'; }

													echo '<li class=""><td colspan="2"><a href="'.$list[$i]['href'].'"><div class="post-image"><div class="img-wrap" style="padding-bottom:'.$img_wrap.'%;"><div class="img-item">'.$img_content.$caption_html.'</div></div></div></a></li>';

											
											?>
											
											<div class="listarea">
											<li class="<?php echo $tr_class;?>">
												<td class="title">
													<div class="in_title">
														<?php
														if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

														echo "<a href=\"".$list[$i]['href']."\" class=\"pic_li_tit\"> ";
														if ($list[$i]['is_notice'])
															echo "<strong>".$list[$i]['subject']."</strong>";
														else
															echo $list[$i]['subject'];

														echo "</a>";

														if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
														if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";

														// if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
														// if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

														//echo $list[$i]['icon_reply']." ";
														// if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
														//if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

														if ($list[$i]['comment_cnt'])  echo "<span class=\"lt_cmt\">".$list[$i]['wr_comment']."</span>";

														?>
													</div>
												</td>
												<td class="time"><span class="date dw_date"><?php echo $list[$i]['datetime2'] ?>333</span></td>
											</li>

											
										
											<?php
												}?>
											<? }
											for ($s=$i; $s < $rows; $s++) {
												$tr_class = ($s%2==0)?'dw':'';

												if($is_images && $s === 0){
													echo '<li class=""><td colspan="2"><a href="#"><div class="post-image"><div class="img-wrap" style="padding-bottom:'.$img_wrap.'%;"><div class="thumb-icon"><div class="wr-fa"><i class="fa fa-picture-o"></i></div></div></div></div></a></li>';
												}else{

													echo '<li class="'.$tr_class.'">
													<td class="title">
														<div class="in_title">&nbsp;</div>
													</td>
													<td class="time"><span class="date dw_date">&nbsp;</span></td>
													</li>';
												}
											}
											?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
