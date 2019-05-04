<?php

 class AppServices extends BaseServices{

    function __construct(){
        parent::__construct('app'); //set table name
    }
    
    function create($app_name, $app_domain, $app_token, $exp_time){
        $app = $this->model;
        $app->app_name = $app_name;
        $app->app_domain = $app_domain;
        $app->app_token = $app_token;
        $app->valid_until = date('Y-m-d H:i:s', $exp_time);
        $app->create_date = date('Y-m-d H:i:s');
        $app->update_date = date('Y-m-d H:i:s');
        $app->save();
        return $this->findOne($app->id);
    }
}