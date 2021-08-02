<?php

class Rimplenet_Template_Settings{
    public $admin_post_page_type, $viewed_url, $post_id;
    
    public function __construct() {
        
        $this->viewed_url = $_SERVER['REQUEST_URI'];
        $this->admin_post_page_type = sanitize_text_field($_GET["rimplenettransaction_type"]);
        $this->post_id = sanitize_text_field($_GET['post']);
        
        add_action('init',  array($this,'load_required_admin_functions'));
        //save meta value with save post hook when Template Settings is POSTED
        //


        