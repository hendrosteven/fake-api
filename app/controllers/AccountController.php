<?php
use \Firebase\JWT\JWT;

class AccountController extends BaseRoute
{

    private $accSvr;

    public function __construct()
    {
        parent::__construct();
        $this->accSvr = new AccountServices();
    }

    public function login()
    {
        $email = $this->post['email'];
        $password = $this->post['password'];

        $v = new Valitron\Validator(array('Email' => $email, 'Password' => $password));
        $v->rule('required', ['Email', 'Password']);

        if ($v->validate()) {
            $account = $this->accSvr->find($email, $password);
            if ($account) {
                $payload = array(
                    "id" => $account->id,
                    "email" => $account->email,
                    "exp_time" => time() + (60 * 60 * 24 * 7), //1 minggu
                );
                $appToken = JWT::encode($payload, $this->f3->get('key'));

                $this->data = [
                    'status' => true,
                    'payload' => array(
                        "messages"=> "Token generated successfully",
                        "token" => $appToken
                    )
                ];
            }else{
                $this->data = [
                    'status' => false,
                    'payload' => "Invalid Login"
                ];
            }
        } else {
            $this->data = [
                'status' => false,
                'payload' => $v->errors(),
            ];
        }
    }

    public function register(){
        $name = $this->post['fullname'];
        $email = $this->post['email'];
        $password = $this->post['password'];

        $v = new Valitron\Validator(array('Full Name'=>$name, 'Email' => $email, 'Password' => $password));
        $v->rule('required', ['Full Name','Email', 'Password']);
        $v->rule('email',['Email']);

        if ($v->validate()) {
            $this->data = [
                'status' => true,
                'payload' => $this->accSvr->create($name, $email, $password)
            ];
        }else{
            $this->data = [
                'success' => false,
                'payload' => $v->errors(),
            ];
        }
    }
}
