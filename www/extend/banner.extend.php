<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 파일을 업로드 함
function upload_file($srcfile, $destfile, $dir)
{
    if ($destfile == "") return false;
    // 업로드 한후 , 퍼미션을 변경함
    @move_uploaded_file($srcfile, $dir.'/'.$destfile);
    @chmod($dir.'/'.$destfile, G5_FILE_PERMISSION);
    return true;
}

// 배너출력
function display_banner($position, $bnid='', $skin='')
{
    global $g5;

	if($position == "일반") {
		$skin = 'default_banner.skin.php';
	} else if($position == "슬라이드") {
		$skin = 'slide_banner.skin.php';
	} else if($position == "랜덤") {
		$skin = 'random_banner.skin.php';
	} else if($position == "개별") {
		$skin = 'each_banner.skin.php';
	}


    //if (!$position) $position = '사이드';
    //if (!$skin) $skin = 'boxbanner.skin.php';

    $skin_path = G5_SKIN_PATH.'/banner/'.$skin;

    if(file_exists($skin_path)) {
        // 접속기기
        $sql_device = " and ( bn_device = 'both' or bn_device = 'pc' ) ";
        if(G5_IS_MOBILE)
            $sql_device = " and ( bn_device = 'both' or bn_device = 'mobile' ) ";

        // 배너 출력
        
        if($position == "개별") {
            $sql = " select * from {$g5['banner_table']} where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' and bn_id = '$bnid' order by bn_order, bn_id desc ";
            $result = sql_query($sql);
        } else if($position == "랜덤") {
            $sql = " select * from {$g5['banner_table']} where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' order by bn_id ";
            $result = sql_query($sql);
        } else {
            $sql = " select * from {$g5['banner_table']} where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' order by bn_order, bn_id desc ";
            $result = sql_query($sql);
        }
        

        include $skin_path;
    } else {
        echo '<p>'.str_replace(G5_PATH.'/', '', $skin_path).' 경로에 스킨 파일이 존재하지 않습니다.</p>';
    }
}


?>