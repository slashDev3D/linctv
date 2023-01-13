<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_SKIN_URL.'/banner/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_SKIN_URL.'/banner/slide/css/swiper.min.css">', 0);
add_stylesheet('<script src="'.G5_SKIN_URL.'/banner/slide/js/swiper.min.js"></script>', 0);
?>

<?php

for ($i=0; $row=sql_fetch_array($result); $i++) {
    
    if ($i==0) echo '<div class="swiper-container slide_bn"><div class="swiper-wrapper">'.PHP_EOL;

    // 테두리 옵션
    $bn_border  = ($row['bn_border']) ? ' slide_bn_border' : '';
    
    // 새창 옵션
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    
    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);
        echo '<div class="swiper-slide mb-0 swiper-slide-slide_bn">'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_BBS_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" alt="'.get_text($row['bn_alt']).'" width="100%" class="'.$bn_border.'">';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</div>'.PHP_EOL;
    }
}

if ($i>0) echo '</div></div>'.PHP_EOL;

?>


                <script>
                    var slide_bn = new Swiper('.slide_bn', {
                        slidesPerView: 1, // 영역내 보여질 배너 갯수
                        loop: true, // 반복옵션 true, false
                        autoplay: 4000, // 자동롤링 1000:1초
                        spaceBetween: 0, // 배너간격
                        
                        // 반응형 세팅
                        // 필요시 설정하시면 됩니다.
                        breakpoints: {
                            1024: { // 가로 1024px 이상
                                slidesPerView: 1, // 보여질 배너 갯수
                                spaceBetween: 0 // 배너간격
                            },
                            768: { // 가로 768px 이하
                                slidesPerView: 1, // 보여질 배너 갯수
                                spaceBetween: 0 // 배너간격
                            },
                            640: { // 가로 640px 이하
                                slidesPerView: 1, // 보여질 배너 갯수
                                spaceBetween: 0 // 배너간격
                            },
                            450: { // 가로 450px 이하
                                slidesPerView: 1, // 보여질 배너 갯수
                                spaceBetween: 0 // 배너간격
                            }
                        }
                    });
                </script>
