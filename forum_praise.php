<?php
/**
 * 咪咕点赞功能
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 2016/11/15
 * Time: 13:33
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
define('NOROBOT', TRUE);

if($_GET['action'] == 'toPraise') {
    //点赞
    $uid = intval(trim($_GET['uid']));

    $tid = intval(trim($_GET['tid']));

    $praise = C::t("#migu_praise#migu_praise")->search_id_by_uid_tid($uid,$tid);
    if (!empty($praise)) {
        //说明取消--则变成点赞样式
        $flag = 2;
        C::t("#migu_praise#migu_praise")->delete_by_id($praise['id']);
    }else{
        //说明点赞--则变成取消点赞样式
        $flag = 1;
        C::t("#migu_praise#migu_praise")->add($uid,$tid);
    }
    $countNum = C::t("#migu_praise#migu_praise")->count_by_tid($tid);
    $res = json_encode(array(
        'data'=>$countNum,
        'flag'=>$flag
        ));
    echo $res;

}