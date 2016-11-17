<?php
/**
 * Created by PhpStorm.
 * User: wanganjiu
 * Date: 2016/11/15
 * Time: 15:22
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class table_migu_praise extends discuz_table{
    /**
     * table_migu_praise construct
     */
    public function __construct()
    {
        $this->_table = 'migu_praise';
        $this->_pk = 'id';
        parent::__construct();
    }

    /**
     *  根据uid与tid查询点赞id
     * @author  wanganjiu
     * @param $uid
     * @param $tid
     * @return array
     * @version
     * @todo
     */
    public function search_id_by_uid_tid($uid ,$tid){
        $praise = DB::fetch_first('SELECT `id` FROM `%t` WHERE `uid`= ' . $uid . ' AND `tid`= ' . $tid , array($this->_table));
        return $praise;
    }

    /**
     * 根据ID进行删除
     * @author  wanganjiu
     * @param $id
     * @return mixed
     * @version
     * @todo
     */
    public function delete_by_id($id){
        return DB::query('DELETE FROM `%t` WHERE `id`= ' . $id ,array($this->_table));
    }

    /**
     * 点赞
     * @author  wanganjiu
     * @param $uid
     * @param $tid
     * @return mixed
     * @version
     * @todo
     */
    public function add($uid,$tid){
        return DB::query(
            'INSERT INTO `%t`(`uid`, `tid` ) VALUES (%d, %s )',
            array(
                $this->_table,
                $uid,
                $tid
            )
        );
    }

    /**
     * 根据帖子id获取点赞数量
     * @author  wanganjiu
     * @param $tid
     * @return mixed
     * @version
     * @todo
     */
    public function count_by_tid($tid){
        return DB::result_first('SELECT COUNT(*) FROM `%t` WHERE `tid` = ' .$tid , array($this->_table));
    }


}