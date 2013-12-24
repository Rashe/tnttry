<?php

class Posts_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function make_post($username, $post_body)
    {
        $url_post = array(
            'username' =>$username,
            'post_body' => $post_body
        );

        $make_post = $this->db->insert('post', $url_post);
        return $make_post;
    }


}