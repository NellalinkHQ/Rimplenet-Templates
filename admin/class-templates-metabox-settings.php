<?php

class Rimplenet_Templates_Metabox{
 
    public function __construct() {
        
        //Register Rimplenet Template Settings Meta Box
        add_action('add_meta_boxes',  array($this,'rimplenet_template_register_meta_box'));
        
       //save meta value with save post hook when Template Settings is POSTED
       add_action('save_post',  array($this,'save_template_default_settings'), 10,3 );
        
    }
    
    function rimplenet_template_register_meta_box() {
        add_meta_box( 'rimplenet-template-meta-box-id', esc_html__( 'Template Settings', 'rimplenet' ),   array($this,'rimplenet_template_register_meta_box_callback'), 'rimplenettemplate', 'normal', 'high' );
    }
    
    function rimplenet_template_register_meta_box_callback( $meta_id ) {
    //Add field
     $disp = '<label for="template" style="width:150px; display:inline-block;">'. esc_html__('Template', 'rimplenet') .'</label>';

     $template = get_post_meta( $meta_id->ID, 'template', true );
     $disp .= '<select name="rimplenet_template" id="template" class="template" style="width:300px;">
    <option value="1" selected="selected">default</option>
</select><br><hr>';
     
     $disp .= '<label for="small_title" style="width:150px; display:inline-block;">'. esc_html__('Sidebar Small Title', 'rimplenet') .'</label>';
     $small_title = get_post_meta( $meta_id->ID, 'small-title', true );
     $disp .= '<input type="text" align=right" name="small_title" id="small_title" class="small_title" value="'. esc_attr($small_title) .'" style="width:300px;"/><br><hr>';
    
    $args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'exclude' => 8,
    ); 
    $all_pages = get_pages($args); // get all pages based on supplied args
    //echo var_dump($all_pages);
     
     $page_disp = '';
     foreach($all_pages as $single_page){
         $page_id = $single_page->ID;
         $page_name = $single_page->post_title;
         $page_disp .= '<option value="'.$page_id.'" selected="selected">'.$page_name.'</option>'; 
     }
                
     $disp .= '<label for="default_post" style="width:150px; display:inline-block;">'. esc_html__('Default Post', 'rimplenet') .'</label>';
     $default_post = get_post_meta( $meta_id->ID, 'default-post', true );
     
     $disp .= '<select name="default_post" id="default_post" class="default_post" style="width:300px;">
                    '.$page_disp.'
                </select><br><hr>';
     $disp .= '<label for="sidebar_menu" style="width:150px; display:inline-block;">'. esc_html__('Sidebar Menu', 'rimplenet') .'</label>';
     $sidebar_menu = get_post_meta( $meta_id->ID, 'sidebar-menu', true );
     $all_menus = wp_get_nav_menus();
     
     $menu_disp = '';
     foreach($all_menus as $single_menu){
         $menu_id = $single_menu->term_id;
         $menu_name = $single_menu->name;
         $menu_disp .= '<option value="'.$menu_id.'" selected="selected">'.$menu_name.'</option>'; 
     }
     $disp .= '<select name="sidebar_menu" id="sidebar_menu"  class="sidebar_menu" style="width:300px;">
                    '.$menu_disp.'
                </select><br><hr>';
     
     $disp .= '<label for="header_text" style="width:150px; display:inline-block;">'. esc_html__('Header Text', 'rimplenet') .'</label>';
     $header_text = get_post_meta( $meta_id->ID, 'header-text', true );
     $disp .= '<input type="text" name="header_text" id="header_text" class="header_text" value="'. esc_attr($header_text) .'" style="width:300px;"/><br><hr>';
      
     $disp .= '<label for="dashboard_company_profile_pic" style="width:150px; display:inline-block;">'. esc_html__('Company Pic Url', 'rimplenet') .'</label>';
     $dashboard_company_profile_pic = get_post_meta( $meta_id->ID, 'dashboard-company-profile-pic', true );
     $disp .= '<input type="text" name="dashboard_company_profile_pic" id="company_pic_url" class="dashboard_company_profile_pic" value="'. esc_attr($dashboard_company_profile_pic) .'" style="width:300px;"/><br><hr>';
      
     $disp .= '<label for="footer_copyright_text" style="width:150px; display:inline-block;">'. esc_html__('Footer Copyright Text', 'rimplenet') .'</label>';
     $footer_copyright_text = get_post_meta( $meta_id->ID, 'footer-copyright-text', true );
     $disp .= '<input type="text" name="footer_copyright_text" id="footer_copyright_text" class="footer_copyright_text" value="'. esc_attr($footer_copyright_text) .'" style="width:300px;"/><br>';
 
 
      echo $disp;
     }
     
    function save_template_default_settings($post_id, $post, $update){
     
        if(isset($_POST['small_title'])){
     
            update_post_meta($post_id,'sidebar-small-title',$_POST['sidebar_small_title']);
            update_post_meta($post_id,'default-post',$_POST['default_post']);
            update_post_meta($post_id,'sidebar-menu',$_POST['sidebar_menu']);
            update_post_meta($post_id,'header-text',$_POST['header_text']);
            update_post_meta($post_id,'dashboard-company-profile-pic',$_POST['dashboard_company_profile_pic']);
            update_post_meta($post_id,'footer-copyright-text',$_POST['footer_copyright_text']);
        }
 
}
  
        
}


$Rimplenet_Templates_Metabox = new Rimplenet_Templates_Metabox();