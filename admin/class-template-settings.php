<?php

class Rimplenet_Template_Settings{
    public $admin_post_page_type, $viewed_url, $post_id;
    
    public function __construct() {
        
        $this->viewed_url = $_SERVER['REQUEST_URI'];
        //$this->admin_post_page_type = sanitize_text_field($_GET["rimplenettransaction_type"]);
        $this->post_id = sanitize_text_field($_POST['post_ID']);
        
        add_action('init',  array($this,'load_required_admin_functions'));
        add_action( 'post_edit_form_tag', array($this, 'rimplenet_post_edit_form_tag'));
        //save meta value with save post hook when Template Settings is POSTED
        add_action('save_post',  array($this,'save_settings'), 10,3 );
        
    }

    function rimplenet_post_edit_form_tag() {
      echo 'enctype="multipart/form-data"';
    }
    
    function load_required_admin_functions() {
          
          //Register Rimplenet Template Settings Meta Box
          add_action('add_meta_boxes',  array($this,'rimplenet_template_register_meta_box'));
        
    }
    
    function rimplenet_template_register_meta_box() {
        
        add_meta_box( 'rimplenet-admin-wallet-settings-meta-box', esc_html__( 'Template Settings', 'rimplenet' ),   array($this,'rimplenet_admin_wallet_meta_box_callback'), 'rimplenettemplate', 'normal', 'high' );
        add_meta_box( 'rimplenet-admin-wallet-balance-shortcode-meta-box', esc_html__( 'Wallet Balance Shortcode', 'rimplenet' ),   array($this,'rimplenet_admin_wallet_balance_shortcode_meta_box_callback'), 'rimplenettemplate', 'side', 'high' );  
        
    }
    
    function rimplenet_admin_wallet_meta_box_callback( $meta_id ) {
        
       include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/partials/metabox-template-settings.php';
    
     }
    
    function rimplenet_admin_wallet_balance_shortcode_meta_box_callback($meta_id) {
        
        $wallet_post_id = $meta_id->ID;
        $wallet_id = get_post_meta($wallet_post_id, 'rimplenet_wallet_id', true);
        $user_balance_shortcode  = '[rimplenet-wallet action="view_balance" wallet_id="'.$wallet_id.'"]';
        if(!empty($this->post_id) AND has_term('rimplenet-wallets', 'rimplenettransaction_type', $this->post_id )){
            echo '<code class="rimplenet_click_to_copy">'.$user_balance_shortcode.'</code>';
        }
        else{
            echo "<p style='color:red;'>Wallet Shortcode for displaying user balance will appear here after publish</p>";
        }
    
     }
     
    function save_settings(int $post_id){
      $rimplenet_uploaded_dashboard_pic = '';
      if (isset( $_FILES ) && !empty( $_FILES ) && isset($_FILES['rimplenet_dashboard_pic'])) {
        $movedfile = wp_handle_upload($_FILES['rimplenet_dashboard_pic'], ['test_form'=>false]);
        if( $movedfile && !isset($movedfile['error'])) {
          $rimplenet_uploaded_dashboard_pic = $movedfile['url'];
        }
        // Later: if there is an error, return back to user.
      }
        
      // $rimplenettransaction_type = sanitize_text_field($_POST['rimplenettransaction_type']);
      // if($rimplenettransaction_type=="rimplenet-wallets"){ 
      //   $WALLET_CAT_NAME = 'RIMPLENET WALLETS';
      //   wp_set_object_terms($post_id, $WALLET_CAT_NAME, 'rimplenettransaction_type');
        
        // $rimplenet_wallet_name = get_the_title();
        // $rimplenet_wallet_decimal = sanitize_text_field( $_POST['rimplenet_wallet_decimal'] );
        // $rimplenet_min_withdrawal_amount = sanitize_text_field( $_POST['rimplenet_min_withdrawal_amount'] );
        // $rimplenet_max_withdrawal_amount = sanitize_text_field( $_POST['rimplenet_max_withdrawal_amount'] );
        // $rimplenet_wallet_symbol = sanitize_text_field( $_POST['rimplenet_wallet_symbol'] );
        // $rimplenet_wallet_symbol_position = sanitize_text_field( $_POST['rimplenet_wallet_symbol_position'] );
        // $include_in_withdrawal_form = sanitize_text_field( $_POST['include_in_withdrawal_form'] );
        // $include_in_woocommerce_currency_list = sanitize_text_field( $_POST['include_in_woocommerce_currency_list'] );
        $rimplenet_template_footer_text = sanitize_text_field( $_POST['rimplenet_template_footer_text'] );
        $rimplenet_template_header_text = sanitize_text_field( $_POST['rimplenet_template_header_text'] );
        $rimplenet_small_title = sanitize_text_field( $_POST['rimplenet_small_title'] );
        $rimplenet_template_default = sanitize_text_field( $_POST['rimplenet_template_default'] );
        
        $rimplenet_sidebar_menu = sanitize_text_field( $_POST['rimplenet_sidebar_menu'] );
        $rimplenet_page_id = sanitize_text_field( $_POST['page_id'] );
        
        $metas = array( 
              'rimplenet_template_footer_text' => $rimplenet_template_footer_text,
              'rimplenet_template_header_text' => $rimplenet_template_header_text,
              'rimplenet_small_title' => $rimplenet_small_title,
              'rimplenet_sidebar_menu' => $rimplenet_sidebar_menu,
              'rimplenet_template_default' => $rimplenet_template_default,

              'rimplenet_page_id' => $rimplenet_page_id,
              'rimplenet_dashboard_pic' => $rimplenet_uploaded_dashboard_pic,

              // 'rimplenet_dashboard_pic' => isset($rimplenet_uploaded_dashboard_pic) ? $rimplenet_uploaded_dashboard_pic['name'] : '',


              // 'rimplenet_wallet_decimal' => $rimplenet_wallet_decimal,
              // 'rimplenet_min_withdrawal_amount' => $rimplenet_min_withdrawal_amount,
              // 'rimplenet_max_withdrawal_amount' => $rimplenet_max_withdrawal_amount,
              // 'rimplenet_wallet_symbol' => $rimplenet_wallet_symbol,
              // 'rimplenet_wallet_symbol_position' => $rimplenet_wallet_symbol_position,
              // 'rimplenet_wallet_id' => strtolower($rimplenet_wallet_id),
              // 'include_in_woocommerce_currency_list' => $include_in_woocommerce_currency_list,
              // 'enable_as_woocommerce_product_payment_wallet' => $enable_as_woocommerce_product_payment_wallet,
              // 'rimplenet_wallet_type' => $rimplenet_wallet_type,
              // 'rimplenet_wallet_note' => $rimplenet_wallet_note,
              
              // 'rimplenettransaction_type' => 'rimplenet-wallets',
            
              // 'rimplenet_rules_before_wallet_withdrawal' => $rimplenet_rules_before_wallet_withdrawal,
              // 'rimplenet_rules_after_wallet_withdrawal' => $rimplenet_rules_after_wallet_withdrawal,
            );
            
          foreach ($metas as $key => $value) {
            update_post_meta($post_id, $key, $value);
          }
        }
      
}




$Rimplenet_Template_Settings = new Rimplenet_Template_Settings();