<?php

class AccountServices extends BaseServices{

    function __construct(){
        parent::__construct('taccount'); //set table name
    }

    function create($fullName, $email, $password){
        $account = $this->model;
        $account->fullname = $fullName;
        $account->email = $email;
        $account->password = md5($password);
        $dateTime = date('Y-m-d H:i:s');
        $account->created_at = $dateTime;
        $account->updated_at = $dateTime;
        $account->save();
        return $this->findOne($account->id);
    }

    function update($id, $fullName, $email, $password){
        $account = $this->model->load(array('id=?',$id));
        $account->fullname = $fullName;
        $account->email = $email;
        $account->password= md5($password);
        $account->updated_at = date('Y-m-d H:i:s');
        $account->save();
        return $this->findOne($account->id);
    }

    function find($email, $password){
        $results =  $this->model->find(array('email=? and password=?',$email, md5($password)));
        if($results){
            $results =  array_map(array($this->model,'cast'),$results,array())[0];
        }else{
            $results = null;
        }
        return $results;
    }

}