<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_SKIN_URL.'/banner/style.css">', 0);
?>

<?php

for ($i=0; $row=sql_fetch_array($result); $i++) {
    
    if ($i==0) echo '<div class="default_bn">'.PHP_EOL;

    // 테두리 옵션
    $bn_border  = ($row['bn_border']) ? ' default_bn_border' : '';
    
    // 새창 옵션
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    
    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);
        echo '<ul>'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_BBS_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" alt="'.get_text($row['bn_alt']).'" width="100%" class="'.$bn_border.'">';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</ul>'.PHP_EOL;
    }
}

if ($i>0) echo '</div>'.PHP_EOL;

?>
