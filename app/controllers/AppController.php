<?php
use \Firebase\JWT\JWT;

class AppController  extends BaseRoute {

    private $appSvr;

    function __construct(){
        parent::__construct();
        $this->appSvr = new AppServices();
    }

    function create(){
        $appName = $this->post['app_name'];
        $appDomain = $this->post['app_domain'];

        $v = new Valitron\Validator(array('App Name'=>$appName,'App Domain'=> $appDomain));
        $v->rule('required', ['App Name','App Domain']);   
       
        if ($v->validate()) {
            $payload = array(
                "app_name" => $appName,
                "app_domain" => $appDomain,
                "exp_time" => time() + (60*60*24*365*5) //5 tahun 
            );
            $appToken =  JWT::encode($payload, $this->f3->get('key'));

            $this->data = [
                'status'=> true, 
                'data'=> $this->appSvr->create($appName, $appDomain, $appToken, $payload['exp_time'])
            ];
        }else{
            $this->data = [
                'success'=> false, 
                'payload'=> $v->errors()
            ];
        }
    }
}