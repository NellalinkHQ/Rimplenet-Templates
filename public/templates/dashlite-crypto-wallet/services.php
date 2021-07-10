<?php
  add_shortcode('process-rimplenet-wallet-sending', 'processRimplenetWalletSending');
  function processRimplenetWalletSending($atts){
      
	    ob_start();
	    
	     global $current_user;
         wp_get_current_user();
        
         $atts = shortcode_atts( array(
        
            'id' => 'empty',
            'user_id' => $current_user->ID,
        
         ), $atts);
        
        $user_id = $atts['user_id'];
        
        if(is_user_logged_in() AND isset($_POST['coin_name']) AND isset($_POST['coin_amount']) AND isset($_POST['withdrawal_address'])){
            $wallet_id = sanitize_text_field($_POST['coin_name']);
            $amount = sanitize_text_field($_POST['coin_amount']);
            $address_to = sanitize_text_field($_POST['withdrawal_address']);
            $note='Send to '.$address_to;
            
            $wallet_obj = new Rimplenet_Wallets();
            $all_wallets = $wallet_obj->getWallets();
            
            $min_wdr_amount = 0;
            if($amount<0){
                $status_error = "Amount is too Small.";
            }
            elseif($amount<$min_wdr_amount){
                $status_error = "<strong>ERROR:</strong> Minimum Transaction Amount is ".$min_wdr_amount;
            }
            elseif(!in_array('rimplenet/rimplenet.php', apply_filters('active_plugins', get_option('active_plugins')))){
                $status_error = "<strong>ERROR:</strong> Sending module not found, install and activate rimplenet.";
            }
            else{
                $withdrawal_id = $wallet_obj->withdraw_wallet_bal($user_id, $amount, $wallet_id, $address_to, $note);
                if($withdrawal_id>1){
                    $status_success = "<strong>Transaction Request Successful</strong>: Please note that high activity on blockchain network may affect processing time.";
                }
                else{
                   $status_error =  $withdrawal_id;
                }
            }
            
            
            
            if(!empty($status_error)){
                echo '<div class="alert alert-fill alert-danger alert-icon alert-dismissible">
                        <em class="icon ni ni-cross-circle"></em>
                        '.$status_error.'
                        <button class="close" data-dismiss="alert"></button>
                    </div>';
            }
            elseif(!empty($status_success)){
                 echo '<div class="alert alert-fill alert-primary alert-icon alert-dismissible">
                         <em class="icon ni ni-check-circle"></em>
                        '.$status_success.'
                        <button class="close" data-dismiss="alert"></button>
                    </div>';
            }
            else{
                echo '<div class="alert alert-fill alert-secondary alert-icon alert-dismissible">
                           <em class="icon ni ni-alert-circle"></em> 
                           <strong>Huh Ah,</strong>. 
                                  Unknown Error. 
                            <button class="close" data-dismiss="alert"></button>
                      </div>';
            }
        }
	     
	    $output = ob_get_clean();

	    return $output;
  }
?>