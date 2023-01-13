<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
function roll_strcut_utf8($str, $len, $checkmb=false, $tail='...') {
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

    $m    = $match[0];
    $slen = strlen($str);  // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters
    
    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;
    
    $ret   = array();
    $count = 0;
    
    for ($i=0; $i < $len; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
    
        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }
    
    return join('', $ret).$tail;
}

$week = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"); 


?>
<script>
var global_roll_issue_top = 0;
var global_roll_auto_lock = false;
$(document).ready(function(){
	roll_issue_change("roll_issue_right_nav01",global_roll_issue_top);
	setInterval(function(){
	 if(global_roll_auto_lock == false){
	 global_roll_issue_top = global_roll_issue_top - 225;
	 if(global_roll_issue_top < -450) global_roll_issue_top = 0;
	 var o_code = '01';
	 if(global_roll_issue_top == 0) o_code = '01';
	 if(global_roll_issue_top == -225) o_code = '02';
	 if(global_roll_issue_top == -450) o_code = '03';
	 //if(global_roll_issue_top == -900) o_code = '04';
	 //if(global_roll_issue_top == -1200) o_code = '05';
	 //if(global_roll_issue_top == -1500) o_code = '06';
	 roll_issue_change("roll_issue_right_nav"+o_code,global_roll_issue_top);
	 }
	},3000);
});


function roll_issue_change(o_this,object){
 var img_width = $(".roll_issue_left_img").css('width');
 var damode = $("body").attr('class');


 $(".roll_resizeimg").css('width',img_width);
 $(".roll_resizeimg").css('min-height','225');

 if($("body").hasClass("dm-dark") === true) {
	 $(".roll_issue_right_nav").css('background','#3d3d3d');
	 $("."+o_this).css('background','#222');
	 $(".roll_issue_right_nav").animate({opacity : 1},100);

 } else {

	$(".roll_issue_right_nav").css('background','#ccc');
	$("."+o_this).css('background','#666');
	$(".roll_issue_right_nav").animate({opacity : 1},100);
 }

 $(".roll_issue_left_img_bottom").animate({opacity : 1 },0);
 $("."+o_this).animate({opacity : 1 },200);
  $(".roll_tc").animate({top : object},300);
  global_roll_issue_top = object;

  console.log(global_roll_issue_top);
  global_roll_auto_lock = true;
  setTimeout(function(){
    global_roll_auto_lock = false;
  },10000);
}
</script>
<style>

</style>
<div class="lt_box">

<div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span><i class="xi-plus-min"></i></a></div>
<div class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></div>

<div id="roll_issue">
<div class="roll_issue_right">
<?php 
  for ($i=0; $i<3; $i++) {
  $num = $i + 1;
  $object_top = $i*-225;
?>
    <div class="roll_issue_right_nav roll_issue_right_nav0<?php echo $num?>" onclick="roll_issue_change('roll_issue_right_nav0<?php echo $num?>','<?php echo $object_top?>');">
      <li class="roll_issue_right_nav_title">
	  <?php if($list[$i]['wr_1']){?>
	  <span class="eng"><?php echo ($week [date('w', strtotime($list[$i]['wr_1']))]);;?></span>
	  <?php //echo date("m.d", strtotime($list[$i]['wr_1'])); ?>
	  <span class="eng"><?php echo $list[$i]['wr_2'];?></span>
	  <? } ?>
	  </li>
      <!---<span class="roll_issue_right_nav_contents"><?php echo roll_strcut_utf8($list[$i]['wr_content'],35,'...');?></span>&nbsp;&nbsp;&nbsp;&nbsp;-->
    </div>
<? } ?>
  </div>
  <div class="roll_issue_left">
    <div class="roll_tc">
<?php 
  for ($i=0; $i<3; $i++) {
  $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], 800, 600);
  $image = urlencode($list[$i][file][0][file]);
  $wr_id = $list[$i]['wr_id'];
  $num = $i + 1;
  if($thumb['src']) {
  $img_src = $thumb['ori'];
  } else {
    $img_src = '';
  }
?>
      <div class="roll_issue_left_img roll_issue_img0<?php echo $num;?>" style="background:url('')no-repeat center center;background-size:cover">
        <div class="roll_issue_left_img_category">
		
        <?php
          //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
          //if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
         // if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
         // if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
        ?>
        </div>
        <div class="roll_resizeimg" /><img src="/data/file/<?php echo $list[$i]['bo_table']?>/<?php echo $image?>"></div>
        <a href="/bbs/board.php?bo_table=schedule&sca=&Ymd=<?php echo $list[$i]['wr_1'];?>">
		<?php if($list[$i]['wr_1']){?>
        <div class="roll_issue_left_img_bottom">
         <span class="roll_issue_left_img_bottom_title">
          <?php echo roll_strcut_utf8($list[$i]['subject'],40,'...');?>
          </span><br />
          <span class="roll_issue_left_img_bottom_contents">
          <?php echo roll_strcut_utf8($list[$i]['wr_content'],60,'...');?>
          </span>
        </div>
		<? } ?>
        </a>
      </div>
<? } ?>
    </div>
  </div>
  
</div>
</div>