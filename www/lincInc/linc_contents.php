<?php
include_once('_common.php');
$g5['title'] = "링크+ TV소개";
include_once('_head.php');
?>

<style>
#contents {margin-top:120px;overflow:visible}
#content_event .mainTitle {font-size:0px}

@media all and (max-width: 768px){
#contents {margin-top:0px;overflow:visible;margin-bottom:80px}

}
</style>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv01', 8, 33);?>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv02', 8, 33);?>
<?php echo latest('theme/slide_thumb_youtube_main', 'linctv03', 8, 33);?>
<div id="content_event">
<?php echo latest('theme/slide_thumb', 'linc_event', 4, 33);?>
</div>
<?php
include_once('_tail.php');
?>