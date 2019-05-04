<?php

class TodoServices extends BaseServices{

    function __construct(){
        parent::__construct('todos'); //set table name
    }

    function create($title){
        $todo = $this->model;
        $todo->title = $title;
        $todo->status = FALSE;
        $dateTime = date('Y-m-d H:i:s');
        $todo->createdAt = $dateTime;
        $todo->updatedAt = $dateTime;
        $todo->save();
        return $this->findOne($todo->id);
    }

    function update($id, $title, $status){
        $todo = $this->model->load(array('id=?',$id));
        $todo->title = $title;
        $todo->status = $status;
        $todo->updatedAt = date('Y-m-d H:i:s');
        $todo->save();
        return $this->findOne($todo->id);
    }
}