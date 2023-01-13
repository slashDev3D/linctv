<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

delete_cache_latest($bo_table);
// thisgun님 알림 플러그인 사용시 아래 주석 푸세요. https://sir.kr/g5_plugin/6259
// run_event('comment_update_after', $board, $wr_id, $w, $qstr, $redirect_url, $comment_id, $reply_array);
echo G5_URL.'/'.$bo_table.'/'.$wr['wr_parent'].'#c_'.$comment_id;
exit;
?>