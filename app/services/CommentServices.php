<?php

class CommentServices extends BaseServices{

    function __construct(){
        parent::__construct('tcomment'); //set table name
    }

    function add($postingId, $accountId, $comments){
        $komentar = $this->model;
        $komentar->comment_date = date('Y-m-d H:i:s');
        $komentar->posting_id = $postingId;
        $komentar->account_id = $accountId;
        $komentar->comment = $comments;
        $komentar->save();

        $komentar->account_name = 'select fullname from taccount where tcomment.account_id=taccount.id';
        $result = $komentar->find(array('id=?',$komentar->id));
        $result =  array_map(array($this->model,'cast'),$result,array())[0];
        return $result;
    }

    function findByPost($postId){
        $komentar = $this->model;
        $komentar->account_name = 'select fullname from taccount where tcomment.account_id=taccount.id';
        $rows = $komentar->find(
            array('posting_id=?',$postId),
            array(
                'order'=>'id'
            )
        );
        $result['subset'] = array_map(array($this->model,'cast'),$rows,array());
        $result['total'] = $this->db->exec("select count(*) as _row from $this->table")[0]['_row'];
        return $result;
    }



}