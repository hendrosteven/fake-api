<?php

class BaseServices {

    protected $db;
    protected $model;
    protected $table;

    function __construct($table){
        $f3 = Base::instance(); 
        $this->db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));  
        $this->model = new BaseModel($this->db,$table);
        $this->table = $table;
    }

    public function findOne($id){
        $results =  $this->model->find(array('id=?',$id));
        $results =  array_map(array($this->model,'cast'),$results,array())[0];
        return $results;
    }


    function findAll($page, $limit){
        if($page<1){
            $page = 1;
        }
        $offset = ($page-1)*$limit;
        $rows = $this->model->find(
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

    function findAllLastUpdated($page, $limit, $time){
        if($page<1){
            $page = 1;
        }
        $offset = ($page-1)*$limit;
        $rows = $this->model->find(
            array('updatedAt>?',$time),
            array(
                'order'=>'id',
                'offset'=>$offset,
                'limit'=>$limit
            )
        );
        $result['subset'] = array_map(array($this->model,'cast'),$rows,array());
        $result['total'] = $this->db->exec("select count(*) as _row from $this->table where updatedAt>'$time'")[0]['_row'];
        $result['limit'] = $limit;
        $result['count'] = ceil($result['total']/$limit);
        $result['page'] = $page;
        return $result;
    }

}