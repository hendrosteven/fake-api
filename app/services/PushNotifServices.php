<?php

class PushNotifServices{

    function sendNotif($message){
        $url = "https://onesignal.com/api/v1/notifications";
        
        $data = array(
            "app_id" =>"44e7014d-b607-466c-b91d-f9799849f430",
            "contents" => array("en"=>$message),
            "included_segments"=>array("Subscribed Users")
        );

        $response = \Httpful\Request::post($url)
                    ->addHeaders(array(
                        'Content-Type'=>'application/json',
                        'Authorization'=> 'Basic MDVjYTM3OWQtNjg1My00ZjU5LTlhMzQtYzhkMzlhNDZiNmJh'
                    ))
                    ->body(json_encode($data))    
                    ->send();
    }
}