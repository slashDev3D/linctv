<?php
if (!defined('_GNUBOARD_')) exit;
@include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 최신글 추출
// $cache_time 캐시 갱신시간
function latest($skin_dir='', $bo_table, $rows=10, $subject_len=40, $cache_time=1, $options='')
{
    global $g5, $is_admin;

    if (!$skin_dir) $skin_dir = 'basic';
    
    $time_unit = 3600;  // 1시간으로 고정

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $caches = false;

    if(G5_USE_CACHE) {
        $cache_file_name = "latest-{$bo_table}-{$skin_dir}-{$rows}-{$subject_len}-".g5_cache_secret_key();
        $caches = g5_get_cache($cache_file_name, (int) $time_unit * (int) $cache_time);
        $cache_list = isset($caches['list']) ? $caches['list'] : array();
        g5_latest_cache_data($bo_table, $cache_list);
    }

    if( $caches === false ){

        $list = array();

        $board = get_board_db($bo_table, true);

        if( ! $board ){
            return '';
        }

        $bo_subject = get_text($board['bo_subject']);

        $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

        $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit 0, {$rows} ";

        
        
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {
            try {
                unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
            } catch (Exception $e) {
            }
            $row['wr_email'] = '';              //이메일 저장 안함
            if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
                $row['file'] = array('count'=>0);
            }
            $list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);

            $list[$i]['first_file_thumb'] = (isset($row['wr_file']) && $row['wr_file']) ? get_board_file_db($bo_table, $row['wr_id'], 'bf_file, bf_content', "and bf_type between '1' and '3'", true) : array('bf_file'=>'', 'bf_content'=>'');
            $list[$i]['bo_table'] = $bo_table;
            // 썸네일 추가
            if($options && is_string($options)) {
                $options_arr = explode(',', $options);
                $thumb_width = $options_arr[0];
                $thumb_height = $options_arr[1];
                $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb_width, $thumb_height, false, true);
                // 이미지 썸네일
                if($thumb['src']) {
                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
                    $list[$i]['img_thumbnail'] = '<a href="'.$list[$i]['href'].'" class="lt_img">'.$img_content.'</a>';
                // } else {
                //     $img_content = '<img src="'. G5_IMG_URL.'/no_img.png'.'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'" class="no_img">';
                }
            }

            if(! isset($list[$i]['icon_file'])) $list[$i]['icon_file'] = '';
        }
        g5_latest_cache_data($bo_table, $list);

        if(G5_USE_CACHE) {

            $caches = array(
                'list' => $list,
                'bo_subject' => sql_escape_string($bo_subject),
            );

            g5_set_cache($cache_file_name, $caches, (int) $time_unit * (int) $cache_time);
        }
    } else {
        $list = $cache_list;
        $bo_subject = (is_array($caches) && isset($caches['bo_subject'])) ? $caches['bo_subject'] : '';
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// $cache_time 캐시 갱신시간, 단위는 시간이며, 0 이면 갱신하지 않는다.
function latest_multi($skin_dir='', $bo_table, $rows=10, $subject_len=40, $cache_time=0, $options='')
{
	global $g5;

	if (!$skin_dir) $skin_dir = 'basic';

	if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
		if (G5_IS_MOBILE) {
			$latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
			if(!is_dir($latest_skin_path))
				$latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
			$latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
		} else {
			$latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
			$latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
		}
		$skin_dir = $match[1];
	} else {
		if(G5_IS_MOBILE) {
			$latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
			$latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
		} else {
			$latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
			$latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
		}
	}
	$latest_skin_url = parse_url($latest_skin_url, PHP_URL_PATH);	// url 에서 프로토콜과 도메인 포트 등 앞부분을 제거한다.
	//echo $latest_skin_url;

	$cache_fwrite = false;
	if(G5_USE_CACHE) {
		$cache_file = G5_DATA_PATH."/cache/latest-multi-{$bo_table}-{$skin_dir}-{$rows}-{$subject_len}-{$cache_time}-{$options}.php";	// latest- 로 시작해야 관리자페이지에서 삭제된다.

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
		$list = array();

		$sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
		$board = sql_fetch($sql);
		$bo_subject = get_text($board['bo_subject']);
		$bo_mobile_subject = get_text($board['bo_mobile_subject']);

		$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

		$sql_where = " where wr_is_comment = 0 ";
		if (stristr($options, "notice_only"))		$sql_where .= " and INSTR(concat(',','{$board['bo_notice']}',','),concat(',',wr_id,',')) > 0 ";
		if (stristr($options, "notice_exclude"))	$sql_where .= " and INSTR(concat(',','{$board['bo_notice']}',','),concat(',',wr_id,',')) = 0 ";
		if (stristr($options, "reply_exclude"))		$sql_where .= " and wr_reply = '' ";
		if (stristr($options, "file_exist"))		$sql_where .= " and wr_file > 0 ";
		//if (stristr($options, "mine_only"))			$sql_where .= " and mb_id = '{$member['mb_id']}' ";	// 이 기능을 사용하려면 global 에 $member 를 추가해야 한다. 하지만, 사용하려 해도 최신글 캐시 기능 때문에 활용이 어렵다.
		//echo $sql_where;

		$sql_order = " order by ";
		if (stristr($options, "notice_up"))			$sql_order .= " case when INSTR(concat(',','{$board['bo_notice']}',','),concat(',',wr_id,',')) > 0 then 0 else 1 end, ";
		if (stristr($options, "reply_list"))		$sql_order .= " wr_num, wr_reply, ";
		if (stristr($options, "datetime_asc"))		$sql_order .= " wr_datetime asc, ";
		if (stristr($options, "datetime_desc"))		$sql_order .= " wr_datetime desc, ";
		if (stristr($options, "hit_asc"))			$sql_order .= " wr_hit asc, ";
		if (stristr($options, "hit_desc"))			$sql_order .= " wr_hit desc, ";
		if (stristr($options, "last_asc"))			$sql_order .= " wr_last asc, ";
		if (stristr($options, "last_desc"))			$sql_order .= " wr_last desc, ";
		if (stristr($options, "comment_asc"))		$sql_order .= " wr_comment asc, ";
		if (stristr($options, "comment_desc"))		$sql_order .= " wr_comment desc, ";
		if (stristr($options, "comment_cnt_desc"))	$sql_order .= " wr_comment desc, ";
		if (stristr($options, "good_asc"))			$sql_order .= " wr_good asc, ";
		if (stristr($options, "good_desc"))			$sql_order .= " wr_good desc, ";
		if (stristr($options, "subject_asc"))		$sql_order .= " wr_subject asc, ";
		if (stristr($options, "subject_desc"))		$sql_order .= " wr_subject desc, ";
		if (stristr($options, "ca_name_asc"))		$sql_order .= " ca_name asc, ";
		if (stristr($options, "ca_name_desc"))		$sql_order .= " ca_name desc, ";
		if (stristr($options, "wr_1_asc"))			$sql_order .= " wr_1 asc, ";
		if (stristr($options, "wr_1_desc"))			$sql_order .= " wr_1 desc, ";
		if (stristr($options, "random"))			$sql_order .= " rand(), ";
		$sql_order .= " wr_num limit 0, {$rows} ";
		//echo $sql_order;

		$sql = " select * from {$tmp_write_table} " . $sql_where . $sql_order;
		$result = sql_query($sql);
		for ($i=0; $row = sql_fetch_array($result); $i++) {
			$list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);
		}

		if($cache_fwrite) {
			$handle = fopen($cache_file, 'w');
			$cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$bo_subject='".sql_escape_string($bo_subject)."';\n\$bo_mobile_subject='".sql_escape_string($bo_mobile_subject)."';\n\$list=".var_export($list, true)."?>";
			fwrite($handle, $cache_content);
			fclose($handle);
		}
	}

	ob_start();
	include $latest_skin_path.'/latest.skin.php';
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}



// 최신글 추출
// $cache_time 캐시 갱신시간
function latest_main($skin_dir='', $bo_table, $rows=10, $subject_len=40, $cache_time=1, $options='')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';
    
    $time_unit = 3600;  // 1시간으로 고정

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $caches = false;

    if(G5_USE_CACHE) {
        $cache_file_name = "latest-{$bo_table}-{$skin_dir}-{$rows}-{$subject_len}-".g5_cache_secret_key();
        $caches = g5_get_cache($cache_file_name, (int) $time_unit * (int) $cache_time);
        $cache_list = isset($caches['list']) ? $caches['list'] : array();
        g5_latest_cache_data($bo_table, $cache_list);
    }

    if( $caches === false ){

        $list = array();

        $board = get_board_db($bo_table, true);

        if( ! $board ){
            return '';
        }

        $bo_subject = get_text($board['bo_subject']);

        $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
        //$sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit 0, {$rows} ";
        if($tmp_write_table == "g5_write_linctv01"){
            $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 and wr_5 = 'Y' order by wr_9 * 1 desc limit 0, {$rows} ";
        }else {
            $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 and wr_5 = 'Y' order by wr_6 limit 0, {$rows} ";
        }
        
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {
            try {
                unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
            } catch (Exception $e) {
            }
            $row['wr_email'] = '';              //이메일 저장 안함
            if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
                $row['file'] = array('count'=>0);
            }
            $list[$i] = get_list($row, $board, $latest_skin_url, $subject_len);

            $list[$i]['first_file_thumb'] = (isset($row['wr_file']) && $row['wr_file']) ? get_board_file_db($bo_table, $row['wr_id'], 'bf_file, bf_content', "and bf_type between '1' and '3'", true) : array('bf_file'=>'', 'bf_content'=>'');
            $list[$i]['bo_table'] = $bo_table;
            // 썸네일 추가
            if($options && is_string($options)) {
                $options_arr = explode(',', $options);
                $thumb_width = $options_arr[0];
                $thumb_height = $options_arr[1];
                $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb_width, $thumb_height, false, true);
                // 이미지 썸네일
                if($thumb['src']) {
                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
                    $list[$i]['img_thumbnail'] = '<a href="'.$list[$i]['href'].'" class="lt_img">'.$img_content.'</a>';
                // } else {
                //     $img_content = '<img src="'. G5_IMG_URL.'/no_img.png'.'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'" class="no_img">';
                }
            }

            if(! isset($list[$i]['icon_file'])) $list[$i]['icon_file'] = '';
        }
        g5_latest_cache_data($bo_table, $list);

        if(G5_USE_CACHE) {

            $caches = array(
                'list' => $list,
                'bo_subject' => sql_escape_string($bo_subject),
            );

            g5_set_cache($cache_file_name, $caches, (int) $time_unit * (int) $cache_time);
        }
    } else {
        $list = $cache_list;
        $bo_subject = (is_array($caches) && isset($caches['bo_subject'])) ? $caches['bo_subject'] : '';
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}


function latest_group2($skin_dir="", $gr_id, $rows=10, $subject_len=40, $contents_len=200, $options="", $category="", $orderby="") { 
    global $config; 
    global $g5; 
    
    $list = array(); 
    $limitrows = $rows; 
    
    $sql_groupname = " select gr_subject from {$g5['group_table']} where gr_id='{$gr_id}' ";
    $rowgroup = sql_fetch_array(sql_query($sql_groupname));
    $gr_subject = $rowgroup['gr_subject']; 
    
    $sqlgroup = " select bo_table, bo_subject from {$g5['board_table']} where gr_id='{$gr_id}' and bo_use_search=1 order by rand()";
    $rsgroup = sql_query($sqlgroup); 
    if (!$skin_dir) $skin_dir = 'group_basic'; 

    // 아미나빌더인가요?
    $field_query = "SHOW COLUMNS FROM {$g5['config_table']} WHERE `Field` = 'as_thema';";
    $field_row = sql_fetch( $field_query );
    if($field_row['Field']) { // 아미나빌더가 있으면
        $g5_builder = "amina";
    }
    
    if ($g5_builder == "amina") {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
    } else {
        if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
            if (G5_IS_MOBILE) {
                $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                if(!is_dir($latest_skin_path))
                    $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
            } else {
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
            }
            $skin_dir = $match[1];
        } else {
            if(G5_IS_MOBILE) {
                $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
                $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            } else {
                $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
                $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
            }
        }
    }
    
    for ($j=0, $k=0; $rowgroup = sql_fetch_array($rsgroup); $j++) {
        $bo_table = $rowgroup['bo_table'];
        
        // 테이블 이름구함
        $sql = " select * from {$g5['board_table']} where bo_table='{$bo_table}'";
        $board = sql_fetch($sql);
        
        $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 실제이름
        
        $subqry = "";
        
        // 답변글 출력제외 
        //$subqry = "&& wr_reply = ''";
        
        // 공지사항 출력제외 
        $arr_notice = preg_replace("/\n/",',', trim($board['bo_notice']));
        if($arr_notice) {
            $subqry = $subqry." && wr_id Not in ({$arr_notice}) ";
        }
        
        // 옵션에 따라 정렬
        $sql = "select * from {$tmp_write_table} where wr_is_comment = 0 ";
        $sql .= (!$category) ? "" : " and ca_name = '{$category}' ";
        $sql .= $subqry;
        $sql .= (!$orderby) ? "  order by wr_datetime desc " : "  order by {$orderby} desc, wr_datetime desc ";
        $sql .= " limit ".$limitrows."";
        $result = sql_query($sql);
        
        for ($i=0; $row = sql_fetch_array($result); $i++, $k++) {
            
            if(!$orderby) {
                $op_list[$k] = $row['wr_datetime'];
            } else  { 
                $op_list[$k] = is_string($row[$orderby]) ? sprintf("%-256s", $row[$orderby]) : sprintf("%016d", $row[$orderby]);
                $op_list[$k] .= $row['wr_datetime'];
                $op_list[$k] .= $row['wr_name'];
            }
            
            $list[$k] = get_list($row, $board, $latest_skin_path, $subject_len, $wr_name, $wr_10);
            
            $list[$k]['bo_table'] = $board['bo_table'];
            $list[$k]['bo_subject'] = $board['bo_subject'];
            $list[$k]['wr_name'] = $board['wr_name'];
            
            $list[$k]['bo_wr_subject'] = cut_str($board['bo_subject'] . $list[$k]['wr_subject'], $subject_len, $wr_name, $wr_10);
        }
    }
    
    if($k>0) array_multisort($op_list, SORT_DESC, $list);
    if($k>$rows) array_splice($list, $rows);
    
    ob_start();
    include $latest_skin_path."/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}



// board_new 게시판 최신글 추출
function new_latest($skin_dir='', $rows=10, $subject_len=40, $is_comment=false, $cache_minute=5, $options='')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        if($is_comment)
            $type = 'comment';
        else
            $type = 'write';

        $cache_file = G5_DATA_PATH."/cache/latest-boardnew-{$type}-{$skin_dir}-{$rows}-{$subject_len}.php";

        if(!file_exists($cache_file)) {
            $cache_fwrite = true;
        } else {
            if($cache_minute > 0) {
                $filetime = filemtime($cache_file);
                if($filetime && $filetime < (G5_SERVER_TIME - 60 * $cache_minute)) {
                    @unlink($cache_file);
                    $cache_fwrite = true;
                }
            }

            if(!$cache_fwrite)
                include($cache_file);
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
        $list = array();

        $sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b where a.bo_table = b.bo_table and b.bo_use_search = 1 ";

        if($is_comment)
            $sql_common .= " and a.wr_id <> a.wr_parent ";
        else
            $sql_common .= " and a.wr_id = a.wr_parent ";

        $sql_order = " order by a.bn_id desc ";

        $sql = " select a.*, b.bo_subject {$sql_common} {$sql_order} limit {$rows} ";

        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

            if ($row['wr_id'] == $row['wr_parent']) {

                // 원글
                $comment_link = "";
                $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
                $list[$i] = $row2;

                // 당일인 경우 시간으로 표시함
                $datetime = substr($row2['wr_datetime'],0,10);
                $datetime2 = $row2['wr_datetime'];
                if ($datetime == G5_TIME_YMD) {
                    $datetime2 = substr($datetime2,11,5);
                } else {
                    $datetime2 = substr($datetime2,5,5);
                }

                $list[$i]['comment_cnt'] = '';
                if ($row2['wr_comment'])
                    $list[$i]['comment_cnt'] = "<span class=\"cnt_cmt\">".$list[$i]['wr_comment']."</span>";
 
                $list[$i]['icon_new'] = '';
                if ($row2['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (24 * 3600)))
                    $list[$i]['icon_new'] = '<img src="'.$latest_skin_url.'/img/icon_new.gif" alt="새글">';

                $list[$i]['icon_secret'] = '';
                if (strstr($row2['wr_option'], 'secret'))
                    $list[$i]['icon_secret'] = '<img src="'.$latest_skin_url.'/img/icon_secret.gif" alt="비밀글">';

            } else {

                // 코멘트
                $comment_link = '#c_'.$row['wr_id'];
                $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
                $row3 = sql_fetch(" select wr_name, wr_datetime, wr_content, wr_option from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
                $row2['wr_subject'] = $row3['wr_content'];
                $list[$i] = $row2;
                $list[$i]['wr_id'] = $row['wr_id'];
                $list[$i]['wr_name'] = $row3['wr_name'];

                // 당일인 경우 시간으로 표시함
                $datetime = substr($row3['wr_datetime'],0,10);
                $datetime2 = $row3['wr_datetime'];
                if ($datetime == G5_TIME_YMD) {
                    $datetime2 = substr($datetime2,11,5);
                } else {
                    $datetime2 = substr($datetime2,5,5);
                }

                $list[$i]['icon_new'] = '';
                if ($row3['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (24 * 3600)))
                    $list[$i]['icon_new'] = '<img src="'.$latest_skin_url.'/img/icon_new.gif" alt="새글">';

                $list[$i]['icon_secret'] = '';
                if (strstr($row2['wr_option'], 'secret') || strstr($row3['wr_option'], 'secret')) {
                    $row2['wr_subject'] = '비밀 댓글입니다.';
                    $list[$i]['icon_secret'] = '<img src="'.$latest_skin_url.'/img/icon_secret.gif" alt="비밀글">';
                }

            }

            $list[$i]['bo_table'] = $row['bo_table'];
            $list[$i]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row2['wr_id'].$comment_link;
            $list[$i]['datetime'] = $datetime;
            $list[$i]['datetime2'] = $datetime2;
            $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
			$list[$i]['wr_subject'] = conv_subject($row2['wr_subject'], $subject_len, '…');
        }

        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$list=".var_export($list, true)."?>";
            fwrite($handle, $cache_content);
            fclose($handle);
        }
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}



function latest_newmain ($skin_dir='', $subject='', $rows=10, $subject_len=40, $sub_table='', $cache_time=1, $options='')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';
    if(!$options) $options_cache = 'basic'; else $options_cache = $options;
    $options_cache = str_replace(array(" ","'"), array("",""), $options_cache);

    $not_in = ""; 
    if($sub_table!=''){
    	foreach ($sub_table as $key => $val) {
    		$not_in .= "'$val',";
    		$not_cache .= "{$val}";
    	}
    }else{
    	$not_cache = 'basic';
    }
    $not_in .= "'1'";    
    

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        $cache_file = G5_DATA_PATH."/cache/latest-all-{$skin_dir}-{$rows}-{$subject_len}-{$not_cache}-{$options_cache}-serial.php";

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
            
            if(!$cache_fwrite) {
                try{
                    $file_contents = file_get_contents($cache_file);
                    $file_ex = explode("\n\n", $file_contents);
                    $caches = unserialize(base64_decode($file_ex[1]));

                    $list = (is_array($caches) && isset($caches['list'])) ? $caches['list'] : array();
                    $bo_subject = (is_array($caches) && isset($caches['bo_subject'])) ? $caches['bo_subject'] : '';
                    $bo_table = (is_array($caches) && isset($caches['bo_table'])) ? $caches['bo_table'] : 'free';
                } catch(Exception $e){
                    $cache_fwrite = true;
                    $list = array();
                }
            }
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
    	
        $list = array();
        $board = array();
        $bo_subject = $subject;
		$sql = " select * from {$g5['board_table']} where bo_table not in({$not_in})";
		//$sql = " select * from {$g5['board_table']} where gr_id not in ({$not_in})";
		$bo = sql_query($sql);
		
		
		$sql = " select * from (";
		$brow = sql_fetch_array($bo);
			
		$board[$brow['bo_table']] = $brow; 
		
		$sql_union .= "
					select
						*,
						'{$brow['bo_subject']}' bo_subject,
						'{$brow['bo_table']}' bo_table
					from {$g5['write_prefix']}{$brow['bo_table']}";
		
		for ($i=0; $brow = sql_fetch_array($bo); $i++) {
			$board[$brow['bo_table']] = $brow;
			$sql_union .= "
						union all
						select 
							*, 
							'{$brow['bo_subject']}' bo_subject, 
							'{$brow['bo_table']}' bo_table 
						from {$g5['write_prefix']}{$brow['bo_table']}";
		}
		
		$sql .= "{$sql_union}) X where {$options} wr_is_comment = 0 order by wr_datetime desc limit 0, {$rows}";
        $result = sql_query($sql);
        
		for ($i=0; $row = sql_fetch_array($result); $i++) {
            try {
                unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
            } catch (Exception $e) {
            }
            
            $row['wr_email'] = '';              //이메일 저장 안함
            if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
                $row['file'] = array('count'=>0);
            }
            $row['wr_subject'] = "[{$row['bo_subject']}] {$row['wr_subject']}";
            
            if($i==0) $bo_table = $row['bo_table'];
            	
            $list[$i] = get_list($row, $board[$row['bo_table']], $latest_skin_url, $subject_len);
        }

        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $caches = array(
                'list' => $list,
                'bo_subject' => sql_escape_string($bo_subject),
            	'bo_table' => sql_escape_string($bo_table),
                );
            $cache_content = "<?php if (!defined('_GNUBOARD_')) exit; ?>\n\n";
            $cache_content .= base64_encode(serialize($caches));  //serialize

            fwrite($handle, $cache_content);
            fclose($handle);

            @chmod($cache_file, 0640);
        }
    }

       
    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();
    
    return $content;
}


function latest_newmain_uni ($skin_dir='', $subject='', $rows=10, $subject_len=40, $sub_table='', $cache_time=1, $options='')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';
    if(!$options) $options_cache = 'basic'; else $options_cache = $options;
    $options_cache = str_replace(array(" ","'"), array("",""), $options_cache);

    $not_in = ""; 
    if($sub_table!=''){
    	foreach ($sub_table as $key => $val) {
    		$not_in .= "'$val',";
    		$not_cache .= "{$val}";
    	}
    }else{
    	$not_cache = 'basic';
    }
    $not_in .= "'1'";    
    

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        $cache_file = G5_DATA_PATH."/cache/latest-all-{$skin_dir}-{$rows}-{$subject_len}-{$not_cache}-{$options_cache}-serial.php";

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
            
            if(!$cache_fwrite) {
                try{
                    $file_contents = file_get_contents($cache_file);
                    $file_ex = explode("\n\n", $file_contents);
                    $caches = unserialize(base64_decode($file_ex[1]));

                    $list = (is_array($caches) && isset($caches['list'])) ? $caches['list'] : array();
                    $bo_subject = (is_array($caches) && isset($caches['bo_subject'])) ? $caches['bo_subject'] : '';
                    $bo_table = (is_array($caches) && isset($caches['bo_table'])) ? $caches['bo_table'] : 'free';
                } catch(Exception $e){
                    $cache_fwrite = true;
                    $list = array();
                }
            }
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
    	
        $list = array();
        $board = array();
        $bo_subject = $subject;
		$sql = " select * from {$g5['board_table']} where bo_table not in({$not_in})";
		//$sql = " select * from {$g5['board_table']} where gr_id not in ({$not_in})";
		$bo = sql_query($sql);
		
		
		$sql = " select * from (";
		$brow = sql_fetch_array($bo);
			
		$board[$brow['bo_table']] = $brow; 
		
		$sql_union .= "
					select
						*,
						'{$brow['bo_subject']}' bo_subject,
						'{$brow['bo_table']}' bo_table
					from {$g5['write_prefix']}{$brow['bo_table']}";
		
		for ($i=0; $brow = sql_fetch_array($bo); $i++) {
			$board[$brow['bo_table']] = $brow;
			$sql_union .= "
						union all
						select 
							*, 
							'{$brow['bo_subject']}' bo_subject, 
							'{$brow['bo_table']}' bo_table 
						from {$g5['write_prefix']}{$brow['bo_table']}";
		}
		
		$sql .= "{$sql_union}) X where {$options} wr_is_comment = 0 order by wr_datetime desc limit 0, {$rows}";
        $result = sql_query($sql);
        
		for ($i=0; $row = sql_fetch_array($result); $i++) {
            try {
                unset($row['wr_password']);     //패스워드 저장 안함( 아예 삭제 )
            } catch (Exception $e) {
            }
            
            $row['wr_email'] = '';              //이메일 저장 안함
            if (strstr($row['wr_option'], 'secret')){           // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row['wr_content'] = $row['wr_link1'] = $row['wr_link2'] = '';
                $row['file'] = array('count'=>0);
            }
           // $row['wr_subject'] = "[{$row['bo_subject']}] {$row['wr_subject']}";
			$row['wr_subject'] = "{$row['wr_subject']}";
            
            if($i==0) $bo_table = $row['bo_table'];
            	
            $list[$i] = get_list($row, $board[$row['bo_table']], $latest_skin_url, $subject_len);
        }

        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $caches = array(
                'list' => $list,
                'bo_subject' => sql_escape_string($bo_subject),
            	'bo_table' => sql_escape_string($bo_table),
                );
            $cache_content = "<?php if (!defined('_GNUBOARD_')) exit; ?>\n\n";
            $cache_content .= base64_encode(serialize($caches));  //serialize

            fwrite($handle, $cache_content);
            fclose($handle);

            @chmod($cache_file, 0640);
        }
    }

       
    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();
    
    return $content;
}


function latest_main_center ($skin_dir="", $gr_id, $rows=10, $subject_len=40, $contents_len=200, $options="", $category="", $orderby="") {
    global $config;
    global $g5;
    $list = array();
    $limitrows = $rows;
    $sql_groupname = " select gr_subject from {$g5['group_table']} where gr_id='{$gr_id}' ";
    $rowgroup = sql_fetch_array(sql_query($sql_groupname));
    $gr_subject = $rowgroup['gr_subject'];
    $sqlgroup = " select bo_table, bo_subject from {$g5['board_table']} where gr_id='{$gr_id}' and bo_use_search=1 order by rand()";
    $rsgroup = sql_query($sqlgroup);
    if (!$skin_dir) $skin_dir = 'basic';
    // 아미나빌더인가요?
    $field_query = "SHOW COLUMNS FROM {$g5['config_table']} WHERE `Field` = 'as_thema';";
    $field_row = sql_fetch( $field_query );
    if($field_row['Field']) { // 아미나빌더가 있으면
        $g5_builder = "amina";
    }
    if ($g5_builder == "amina") {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
    } else {
        if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
            if (G5_IS_MOBILE) {
                $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                if(!is_dir($latest_skin_path))
                    $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
            } else {
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
                $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
            }
            $skin_dir = $match[1];
        } else {
            if(G5_IS_MOBILE) {
                $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
                $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            } else {
                $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
                $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
            }
        }
    }
    for ($j=0, $k=0; $rowgroup = sql_fetch_array($rsgroup); $j++) {
        $bo_table = $rowgroup['bo_table'];
        // 테이블 이름구함
        $sql = " select * from {$g5['board_table']} where bo_table='{$bo_table}'";
        $board = sql_fetch($sql);
        $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 실제이름
        $subqry = "";
        // 답변글 출력제외
        //$subqry = "&& wr_reply = ''";
        // 공지사항 출력제외
        $arr_notice = preg_replace("/\n/",',', trim($board['bo_notice']));
        if($arr_notice) {
            $subqry = $subqry." && wr_id Not in ({$arr_notice}) ";
        }
        // 옵션에 따라 정렬
        $sql = "select * from {$tmp_write_table} where wr_is_comment = 0 ";
        $sql .= (!$category) ? "" : " and ca_name = '{$category}' ";
        $sql .= $subqry;
        $sql .= (!$orderby) ? "  order by wr_datetime desc " : "  order by {$orderby} desc, wr_datetime desc ";
        $sql .= " limit ".$limitrows."";
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++, $k++) {
            if(!$orderby) {
                $op_list[$k] = $row['wr_datetime'];
            } else  {
                $op_list[$k] = is_string($row[$orderby]) ? sprintf("%-256s", $row[$orderby]) : sprintf("%016d", $row[$orderby]);
                $op_list[$k] .= $row['wr_datetime'];
                $op_list[$k] .= $row['wr_name'];
            }
            $list[$k] = get_list($row, $board, $latest_skin_path, $subject_len, $wr_name, $wr_10);
            $list[$k]['bo_table'] = $board['bo_table'];
            $list[$k]['bo_subject'] = $board['bo_subject'];
            $list[$k]['wr_name'] = $board['wr_name'];
            $list[$k]['bo_wr_subject'] = cut_str($board['bo_subject'] . $list[$k]['wr_subject'], $subject_len, $wr_name, $wr_10);
        }
    }
    if($k>0) array_multisort($op_list, SORT_DESC, $list);
    if($k>$rows) array_splice($list, $rows);
    ob_start();
    include $latest_skin_path."/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}




// 최신글 추출
// $cache_time 캐시 갱신시간
function latest_group($skin_dir='', $gr_id, $rows=10, $subject_len=40, $cache_time=1, $options='')

{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        $cache_file = G5_DATA_PATH."/cache/latest-{$gr_id}-group-{$skin_dir}-{$rows}-{$subject_len}.php";

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

            if(!$cache_fwrite) {
                try{
                    $file_contents = file_get_contents($cache_file);
                    $file_ex = explode("\n\n", $file_contents);
                    $caches = unserialize(base64_decode($file_ex[1]));

                    $list = (is_array($caches) && isset($caches['list'])) ? $caches['list'] : array();
                    $gr_subject = (is_array($caches) && isset($caches['gr_subject'])) ? $caches['gr_subject'] : '';
                } catch(Exception $e){
                    $cache_fwrite = true;
                    $list = array();
                }
            }
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
        $list = array();
        $sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and b.bo_use_search = 1 ";
        $sql_common .= " and b.gr_id = '$gr_id' ";
        $sql_common .= " and a.bo_table not in ('linctv02', 'linctv03') ";
        $sql_common .= " and a.wr_id = a.wr_parent ";
        $sql_order = " order by a.bn_id desc ";
        $sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit 0, {$rows}";
		$result = sql_query($sql);

		for ($i=0; $row=sql_fetch_array($result); $i++) {

			$sql = " select * from {$g5['board_table']} where bo_table = '{$row['bo_table']}' ";
			$board = sql_fetch($sql);
			$gr_subject = $row['gr_subject'];

			$tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
			$row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");

            try {
                unset($row2['wr_password']); //패스워드 저장 안함(아예 삭제)
            } catch (Exception $e) {
            }
            $row2['wr_email'] = ''; //이메일 저장 안함
            if (strstr($row2['wr_option'], 'secret')){ // 비밀글일 경우 내용, 링크, 파일 저장 안함
                $row2['wr_content'] = $row['wr_link1'] = $row2['wr_link2'] = '';
                $row2['file'] = array('count'=>0);
            }

			$list[$i] = $row2;
			$list[$i] = get_list($row2, $board, $latest_skin_url, $subject_len);
			$list[$i]['bo_subject'] = $row['bo_subject'];
			$list[$i]['bo_table'] = $row['bo_table'];
		}

        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $caches = array(
                'list' => $list,
                'gr_subject' => sql_escape_string($gr_subject),
                );
            $cache_content = "<?php if (!defined('_GNUBOARD_')) exit; ?>\n\n";
            $cache_content .= base64_encode(serialize($caches));  //serialize

            fwrite($handle, $cache_content);
            fclose($handle);

            @chmod($cache_file, 0640);
        }
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
//echo  latest_alls('theme/basic', '전체게시판', 10, 24 ,array('linctv','community','lincevent','	lincnews')); 
?>