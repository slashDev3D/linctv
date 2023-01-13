<?php
if (!defined('_GNUBOARD_')) exit;

// 최신글 추출
// $cache_time 캐시 갱신시간
function latest_group_line($skin_dir="", $gr_id, $rows=10, $eachrows=1, $subject_len=40, $no_table="", $cache_time=1, $category="", $orderby="" )
{
	global $g5;
    //static $css = array();
	
    if (!$skin_dir) $skin_dir = 'basic';

    if(G5_IS_MOBILE) {
        $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
    } else {
        $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
        $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
    }
	
    $cache_fwrite = false;
    if(G5_USE_CACHE) {
		//$cache_file = G5_DATA_PATH."/cache/latest-{$gr_id}-{$skin_dir}-{$rows}-{$subject_len}.php";
        $cache_file = G5_DATA_PATH."/cache/latest-{$gr_id}-{$skin_dir}-{$rows}-{$subject_len}.php";

        if(!file_exists($cache_file)) {
            $cache_fwrite = true;
        } else {
            if($cache_time > 0) {
                $filetime = filemtime($cache_file);
                if($filetime && $filetime < (G5_SERVER_TIME - 3600 * $cache_time)) {
                    @unlink($cache_file);
                    $cache_fwrite = true;
                }
            }

            if(!$cache_fwrite)
                include($cache_file);
        }
    }	
	
    if(!G5_USE_CACHE || $cache_fwrite) {	
	//if (!G5_USE_CACHE || !file_exists($cache_file)) {	
		$list = array();
		
		$limitrows = $eachrows;
		
		$sqlgroup = " select bo_table, bo_subject, bo_9 from {$g5['board_table']} where gr_id = '$gr_id' $sqls ";

		/**** 목록에서 제외시킬 테이블들 { ***/
		if ($no_table) {
			$t_flag = serialize($no_table);
			if ($t_flag[0] == "a") {	//Array이면
				for ($ic=0; $ic<count($no_table); $ic++) {
					$sqlgroup .= " and bo_table != '$no_table[$ic]' ";
				}
			} else if ($t_flag[0] == "s") {	//String이면
				$sqlgroup .= " and bo_table != '$no_table' ";
			}
		}	

		$sqlgroup .= " and bo_use_search=1 order by bo_order ";
		$rsgroup = sql_query($sqlgroup);
		/**** 목록에서 제외시킬 테이블들 } ***/
		
	
		for ($j=0, $k=0; $rowgroup=sql_fetch_array($rsgroup); $j++) {
			$bo_table = $rowgroup[bo_table];

			$sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
			$board = sql_fetch($sql);
			$bo_subject = get_text($board['bo_subject']);
			
			$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
			// 옵션에 따라 정렬 { //
			$sql = "select * from {$tmp_write_table} where wr_is_comment = 0 ";
			// $sql .= "and wr_datetime > ( now() - interval 512 hour) ";
			$sql .= (!$category) ? "" : " and ca_name = '$category' ";
			$sql .= (!$orderby) ? "  order by wr_id desc " : "  order by wr_id desc ";
			$sql .= " limit $limitrows";
			// 옵션에 따라 정렬 } //
			$result = sql_query($sql);
			for ($i=0; $row = sql_fetch_array($result); $i++, $k++) {
				if(!$orderby) $op_list[$k] = $row[wr_datetime];
				else  {
					$op_list[$k] = is_string($row[$orderby]) ? sprintf("%-256s", $row[$orderby]) : sprintf("%016d", $row[$orderby]);
					$op_list[$k] .= $row[wr_datetime];
				}

				$list[$k] = get_list($row, $board, $latest_skin_url, $subject_len);

				$list[$k][bo_table] = $board[bo_table];
				$list[$k][bo_subject] = $board[bo_subject];

				$list[$k][bo_wr_subject] = cut_str($board[bo_subject] . $list[$k][wr_subject], $subject_len);
			}
		}
		
		if($cache_fwrite) {
			$handle = fopen($cache_file, 'w');
            $cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$bo_subject='".$bo_subject."';\n\$list=".var_export($list, true)."?>";			
			fwrite($handle, $cache_content);
			fclose($handle);		
		}
	}
	
    /*
    // 같은 스킨은 .css 를 한번만 호출한다.
    if (!in_array($skin_dir, $css) && is_file($latest_skin_path.'/style.css')) {
        echo '<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">';
        $css[] = $skin_dir;
    }
    */
	
	if($k>0) array_multisort($op_list, SORT_DESC, $list);
	if($k>$rows) array_splice($list, $rows);

	ob_start();
    include $latest_skin_path.'/latest.skin.php';
	$content = ob_get_contents();
	ob_end_clean();
	
	return $content;
}
?>