<?php

class TimelineServices extends BaseServices{

    function __construct(){
        parent::__construct('tposting'); //set table name
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