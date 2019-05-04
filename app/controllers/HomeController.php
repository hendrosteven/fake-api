<?php

class HomeController extends SecureRoute{

    function index(){
       $this->data = array(
           "status" => true,
           "data" => ['messages'=>'Welcome to Bobobobo API', 'account'=>$this->account]
       );
    }
}
