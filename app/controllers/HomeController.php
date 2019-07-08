<?php

class HomeController extends SecureRoute{

    function index(){
       $this->data = array(
           "status" => true,
           "data" => ['messages'=>'Welcome to Social API', 'account'=>$this->account]
       );
    }
}
