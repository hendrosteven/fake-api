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
}
