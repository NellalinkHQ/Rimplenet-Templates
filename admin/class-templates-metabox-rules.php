<?php

class Rimplenet_Templates_Metabox_Rules{
 
    public function __construct() {
        
        //Register Rimplenet Template Settings Meta Box
        add_action('add_meta_boxes',  array($this,'rimplenet_template_register_meta_box'));
        
       //save meta value with save post hook when Template Settings is POSTED
       add_action('save_post',  array($this,'save_template_default_settings'), 10,3 );
        
    }
    
    function rimplenet_template_register_meta_box() {
        add_meta_box( 'rimplenet-rules-metabox-id', esc_html__( 'Rimplenet Content Restriction Access Rules', 'rimplenet' ),   array($this,'rimplenet_template_register_meta_box_callback'), 'page', 'normal', 'high' );
        add_meta_box( 'rimplenet-rules-metabox-id', esc_html__( 'Rimplenet Content Restriction Access Rules', 'rimplenet' ),   array($this,'rimplenet_template_register_meta_box_callback'), 'post', 'normal', 'high' );
    }
    
    function rimplenet_template_register_meta_box_callback( $meta_id ) {
        
       include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/partials/manager-metabox-rules.php';
    
     }
     
    function save_template_default_settings($post_id, $post, $update){
     
       //include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/partials/manager-metabox-rules.php';
 
    }
  
        
}


$Rimplenet_Templates_Metabox_Rules = new Rimplenet_Templates_Metabox_Rules();