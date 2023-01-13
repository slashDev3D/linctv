<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_MOBILE_PATH.'/head_main.php');
?>




<div class="idx_wrap_lt">
<div class="idx_lt">
    <div class="lt_wr">
     <?php
		$options = array( 'thumb_width' => 140, 'thumb_height' => 105, 'box_width' => 400, 'thumb_arrange' => 'h' );
		echo latest("theme/newsletter", "news", 6, 100, 0, $options);
	?>

    </div>
    <div class="lt_wr time">
      <?php echo latest('theme/main_schedule_new2', 'schedule', 3, 100);?>
    </div>
</div>
</div>


<script>
$(document).ready(function(){
// Show the first tab and hide the rest
$('#maintabs-nav li:first-child').addClass('active');
$('.maintab-content').hide();
$('.maintab-content:first').show();

// Click function
$('#maintabs-nav li').click(function(){
  $('#maintabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.maintab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
});

</script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail_main.php');
?>