<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 2016/11/14
 * Time: 17:07
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_migu_praise_forum {

    public function __construct()
    {
        $this->_table = 'migu_praise';
        $this->_pk = 'id';
    }

    public function viewthread_useraction(){
        global $_G;
        $lang = lang('plugin/migu_praise');
        $tid = $_G[tid];
        $countNum = DB::result_first('SELECT COUNT(*) FROM `%t` WHERE `tid` = ' .$tid , array($this->_table));
        $bind = "<a href='javascript:void(0);' onClick=\"topraise($_G[uid],$_G[tid]);\"><i id=\"praise_title\" style='color:red' >".$lang['title'].$countNum."</i></a>
                <script type=\"text-javascript\" src=\"static/js/jquery-1.8.2.js\"></script>
                <script>
                    function topraise(uid,tid){
                        if(uid == 0){
                            //弹出登录框
                            jQuery(\"#k_favorite\").click();
                            return false;
                        }
                        jQuery.ajax({
                            async: true,
                            cache:false,
                            type:\"GET\",
                            url:\"forum.php?mod=praise&action=toPraise\",
                            dataType:\"json\",
                            data:{uid:uid,tid:tid},
                            timeout:30000,
                            success:function(data){
                                var num = data['data'];
                                var flag = data['flag'];
                                var res ;
                                if(flag == '1'){
                                    res = '取消点赞'+ num;
                                    jQuery(\"#praise_title\").css('color','black');
                                }else{
                                    res = '点赞' + num;
                                    jQuery(\"#praise_title\").css('color','red');
                                }
                               jQuery(\"#praise_title\").text(res);
                            }
                        });
                    }
                </script>";

        return $bind;
    }

    function check($tid){
        alert($tid);
    }
}