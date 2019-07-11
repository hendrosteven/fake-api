<?php

class CommentController extends SecureRoute{

    private $commentSvr;

    public function __construct()
    {
        parent::__construct();
        $this->commentSvr = new CommentServices();
    }

    function findAll(){
        $postId = $this->params['id'];
        $this->data = array(
           "status" => true,
           "payload" => $this->commentSvr->findByPost($postId)
        );
    }

    function comments(){
        $postId = $this->post['posting_id'];
        $comments = $this->post['comments'];
        $acc = $this->account->id;
        $this->data = array(
            "status" => true,
            "payload" => $this->commentSvr->add($postId, $acc, $comments)
        );
    }
}
