<?php

class TimelineServices extends BaseServices{

    function __construct(){
        parent::__construct('tposting'); //set table name
    }

    function posting($account_id, $photo, $description){
        $posting = $this->model;
        $posting->post_date = date('Y-m-d H:i:s');
        $posting->photo = $photo;
        $posting->description = $description;
        $posting->taccount_id = $account_id;
        $posting->save();
        return $this->findOne($posting->id);
    }

    function findAll($page, $limit){
        if($page<1){
            $page = 1;
        }
        $offset = ($page-1)*$limit;
        $postings = $this->model;
        $postings->account_name = 'select fullname from taccount where tposting.taccount_id=taccount.id';
        $rows = $postings->find(
            null,
            array(
                'order'=>'id',
                'offset'=>$offset,
                'limit'=>$limit
            )
        );
        $result['subset'] = array_map(array($this->model,'cast'),$rows,array());
        $result['total'] = $this->db->exec("select count(*) as _row from $this->table")[0]['_row'];
        $result['limit'] = $limit;
        $result['count'] = ceil($result['total']/$limit);
        $result['page'] = $page;
        return $result;
        
    }

    

}