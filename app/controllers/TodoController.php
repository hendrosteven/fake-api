<?php

class TodoController extends BaseRoute{

    private $todoSvr;

    function __construct(){
        parent::__construct();
        $this->todoSvr = new TodoServices();
    }


    function findOne(){
        $id = $this->params['id'];
        $this->data = [
            'status' => true,
            'data' => $this->todoSvr->findOne($id)
        ];
    }

    function findAll(){
        $page = $this->params['page'];
        $limit = $this->params['limit'];
        $todos = $this->todoSvr->findAll($page,$limit);

        $this->data = [
            'status' => true,
            'data' => $todos
        ];
    }

    function createOne(){
        $title = $this->post['title'];
        $v = new Valitron\Validator(array('Todo Title'=>$title));
        $v->rule('required', ['Todo Title']);
       
        if ($v->validate()) {
            $this->data = [
                'status'=> true, 
                'data'=> $this->todoSvr->create($title)
        ];
        }else{
            $this->data = [
                'status'=> false, 
                'messages'=> $v->errors()
            ];
        }
    }

    function updateOne(){
        $id = $this->post['id'];
        $title = $this->post['title'];
        $status = $this->post['status'];

        $v = new Valitron\Validator(array('Todo Id'=>$id, 'Todo Title'=>$title, 'Todo Status'=>$status));
        $v->rule('required', ['Todo Id','Todo Title', 'Todo Status']);
       
        if ($v->validate()) {
            $this->data = [
                'status'=> true, 
                'data'=> $this->todoSvr->update($id, $title, $status)
        ];
        }else{
            $this->data = [
                'status'=> false, 
                'messages'=> $v->errors()
            ];
        }
    }

    function search(){
        $title = $this->post['title'];
        $this->data = [
            'status'=> true, 
            'data'=> $this->todoSvr->search($title)
        ];
    }

}