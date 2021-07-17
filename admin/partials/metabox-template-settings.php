<?php
        $template_post_id = $meta_id->ID;
        $template_defualt = get_post_meta($template_post_id, 'rimplenet_template_default', true);
        //$small_title = get_post_meta( $template_post_id, 'small_title', true );
        $small_title = get_post_meta($template_post_id, 'rimplenet_small_title', true);
        $user_balance_shortcode  = '[rimplenet-wallet action="view_balance" wallet_id="'.$template_post_id.'"]';
        
        $rimplenet_template_header = get_post_meta($template_post_id, 'rimplenet_template_header_text', true);
        $rimplenet_template_footer = get_post_meta($template_post_id, 'rimplenet_template_footer_text', true);
        
        $sidebar_menu = get_post_meta($template_post_id, 'rimplenet_sidebar_menu', true);
        $rimplenet_page_id = get_post_meta($template_post_id, 'rimplenet_page_id', true);

        $rimplenet_dashboard_pic = get_post_meta($template_post_id, 'rimplenet_dashboard_pic', true);

?>
    <table class="form-table">
          <tbody>
            <tr>
                <th colspan="2"><h2>Basic settings</h2> </th>  
            </tr>
    
               <tr>
                <th>
                 <label for="rimplenet_template_default"> 
                     Template 
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="This will allow users to fund your wallet via the created product"></span>
                 </label>
                </th>
                <td>
                   <select name="rimplenet_template_default" id="rimplenet_template_default" style="width: 100%;max-width: 400px; height: 40px;" required>
                         <option selected="selected" value="default"> Default </option> 
                      </select>
                </td>
            </tr>

            <tr>
                <th><label for="rimplenet_small_title"> 
                     Small Title 
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="Wallet Symbol of the Wallet  for Bitcoin or maybe ETH for Ethereum"></span>
                </label></th>
                <td><input name="rimplenet_small_title" id="rimplenet_small_title" type="text" value="<?php echo $small_title; ?>" placeholder="3 To 4" min=3 max=4 class="regular-text" required style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>

             <tr>
                <th>
                 <label for="default"> 
                     Default Page <?php echo $rimplenet_page_id; ?>
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="This will allow users to fund your wallet via the created product"></span>
                 </label>
                </th>
                <td> <?php wp_dropdown_pages([
                                'depth'                 => 0,
                                'child_of'              => 0,
                                'selected'              => isset($rimplenet_page_id) ? $rimplenet_page_id : 0,
                                'echo'                  => 1,
                                'name'                  => 'page_id',
                                'id'                    => '',
                                'class'                 => '',
                                'show_option_none'      => '',
                                'show_option_no_change' => '',
                                'option_none_value'     => '',
                                'value_field'           => 'ID',
                            ]);
                        ?> 
                   <!-- <select name="rimplenet_page_template" id="rimplenet_page_template" style="width: 100%;max-width: 400px; height: 40px;" required>
                       
                      </select> -->
                </td>
            </tr>

             <tr>
                <th>
                 <label for="rimplenet_sidebar_menu_template"> 
                     Sidebar Menu <?php echo $sidebar_menu; ?>
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="This will allow users to fund your wallet via the created product"></span>
                 </label>
                </th>
                <td>
                   <?php $nav_menus = wp_get_nav_menus(); 
                    $menu_names = wp_list_pluck($nav_menus, 'name');
                    $menu_slugs = wp_list_pluck($nav_menus, 'slug');

                   ?>
                      <select name="rimplenet_sidebar_menu" id="rimplenet_sidebar_menu_template" style="width: 100%;max-width: 400px; height: 40px;" required>
                        <option value=""> Choose one menu </option>
                        <?php foreach ($nav_menus as $key => $value) { ?>
                            <option <?php selected( $sidebar_menu, $menu_slugs[$key] ); ?> value="<?= $menu_slugs[$key]; ?>"><?= $menu_names[$key]; ?></option>
                        <?php } ?>
                </td>
            </tr>
      

            <tr>
                <th><label for="rimplenet_template_header_text"> 
                     Header Text 
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="Wallet Decimal of the Wallet, it sometimes 2 is for fiat currecny wallet & 6 or more for cryptocurrency wallet"></span>
                </label></th>
                <td><input name="rimplenet_template_header_text" id="rimplenet_template_header_text" type="text" value="<?php echo $rimplenet_template_header; ?>" placeholder="Header Text" class="regular-text" required style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>

            <tr>
                <th><label for="rimplenet_company_profile_pic"> 
                     Company Dashboard Profile Picture
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="Wallet Decimal of the Wallet, it sometimes 2 is for fiat currecny wallet & 6 or more for cryptocurrency wallet"></span>
                </label></th>
                <td><input name="rimplenet_dashboard_pic" id="rimplenet_company_profile_pic" type="file" value="<?php echo $rimplenet_dashboard_pic; ?>" class="regular-text" style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>


            <tr>
                <th>
                 <label for="rimplenet_template_footer_text"> 
                     Footer Copyright 
                     <span class="dashicons dashicons-editor-help rimplenet-admin-tooltip" title="Wallet Minimum Single Withdrawal Amount"></span>
                 </label>
                </th>
                <td><input name="rimplenet_template_footer_text" id="rimplenet_template_footer_text" type="text" value="<?php echo $rimplenet_template_footer; ?>" placeholder="Footer Text" class="regular-text" style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>
            
            <?php 
                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
                //Only show below fields if Woocommerce is Installed and Activated
            ?>
          
            <?php
                }
            ?>
         
            </tbody>
        </table>
     