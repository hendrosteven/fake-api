<?php

class TimelineController extends SecureRoute{

    private $timelineSvr;

    public function __construct()
    {
        parent::__construct();
        $this->timelineSvr = new TimelineServices();
    }

    function findAll(){
        $page = $this->params['page'];
        $limit = $this->params['limit'];
        $this->data = array(
           "status" => true,
           "payload" => $this->timelineSvr->findAll($page,$limit)
        );
    }

    function posting(){
        $photo = $this->post['photo'];
        $description = $this->post['description'];
        $acc = $this->account['id'];
        $this->data = array(
            "status" => true,
            "payload" => $this->timelineSvr->posting($acc, $photo, $description)
        );
    }
}
