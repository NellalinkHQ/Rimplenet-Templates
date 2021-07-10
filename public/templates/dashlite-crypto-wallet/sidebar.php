<?php
    global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $sidebar_mode = get_post_meta($template_id,"sidebar-mode",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
    
    
    $display_sidebar_profile = get_post_meta($template_id,"display-sidebar-profile",true);
    $before_sidebar_menu_text = get_post_meta($template_id,"before-sidebar-menu-text",true);
    
    
    $dashboard_title = get_post_meta($template_id,"title",true);
    if(empty($dashboard_title)){ $dashboard_title= get_bloginfo("name"); }
    
    $dashboard_logo = get_post_meta($template_id,"dashboard-logo",true);
    if(empty($dashboard_logo)){ $dashboard_logo = get_site_icon_url('', ''); }
    
    $dashboard_logo_dark = get_post_meta($template_id,"dashboard-logo-dark",true);
?>
<div class="nk-sidebar nk-sidebar-fixed <?php echo $sidebar_mode; ?>" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="<?php echo get_permalink(); ?>" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="<?php echo $dashboard_logo; ?>" alt="logo">
                            <img class="logo-dark logo-img" src="<?php echo $dashboard_logo_dark; ?>"  alt="logo-dark">
                            <span class="nio-version"> <?php echo $dashboard_title; ?> </span>
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-widget d-none d-xl-block">
                               <?php echo do_shortcode($before_sidebar_menu_text); ?>
                            </div><!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                                <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                                 <?php if($display_sidebar_profile=="yes"){ ?>
                                    <div class="user-card-wrap">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                                <span>PP</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text"><?php echo $current_user->user_login; ?></span>
                                                <span class="sub-text"><?php echo $current_user->user_email; ?></span>
                                            </div>
                                            <div class="user-action">
                                                <em class="icon ni ni-chevron-down"></em>
                                            </div>
                                        </div>
                                    </div>
                                  <?php } ?>
                                </a>
                                <?php echo do_shortcode($before_sidebar_menu_text); ?>
                            </div><!-- .nk-sidebar-widget -->
                            <div class="nk-sidebar-menu">
                                <!-- Menu -->
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Menu</h6>
                                    </li>
                                    
                                 <?php
                                        
                                        
                                  $leftMenuChosen = get_post_meta($template_id,"sidebar-menu",true);
                                  $leftMenu = wp_get_nav_menu_items($leftMenuChosen);
                                  if ($leftMenu!=false) {
                                  
                    
                                ?>
                    
                    
                                  
                                        
                                  <?php
                                   //var_dump($leftMenu);
                                   
                                   
                                    $menu_parent_ids = array_column($leftMenu, 'menu_item_parent');
                                    $menu_parent_ids_count =  array_count_values($menu_parent_ids);
                                   foreach ($leftMenu as $key => $menu) {
                                       
                                     //$menu_item_target = get_post_meta( $menu->ID, '_menu_item_target',true);
                                     $post_id = $menu->object_id;
                                    
                                      if (get_post_meta( $menu->ID, '_rimplenet_menu_meta',true)) {
                                        $icon_name = get_post_meta( $menu->ID, '_rimplenet_menu_meta',true);
                                        $icon_disp = '<span class="material-icons">'.$icon_name.'</span>';
                                      }
                                      else{
                                        $icon_disp = '';
                                      }
                    
                                      if(rtrim(get_permalink(), "/")== rtrim($menu->url, "/") ){//if it's this same page link
                                         $active_menu_disp = 'active';
                                        }
                                       else{
                                         $active_menu_disp = '';
                                       }
                                     
                                     if($menu->type=='custom'){
                                       $menu_item_link = $menu->url;
                                     }
                                     elseif( rtrim(get_permalink(), "/")== rtrim($menu->url, "/") ){//if it's this same page link
                                       $menu_item_link = $menu->url;
                                     }
                                     else{
                                       $menu_item_link = get_permalink().'?rimplenet-view-post='.$post_id;
                                     }
                                     
                                     //echo var_dump($menu);
                                      
                                     if ($menu->menu_item_parent == 0) {
                                        $child_counter = $menu_parent_ids_count[$menu->ID];
                                        if($child_counter>1){ //if has children, open tag <li> and <a with class dropdown ot be closed in COUNTER REDUCTION FXN
                                             ?>
                                             
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                                <span class="nk-menu-icon"><em class="icon ni <?php echo  $icon_disp; ?>"></em></span>
                                                <span class="nk-menu-text"><?php echo $menu->title; ?></span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                             
                                             <?php
                                                }
                                                else{//when it has no parent 
                                                 ?>
                                                 <li class="nk-menu-item">
                                                    <a href="<?php echo $menu_item_link; ?>"  target="<?php echo $menu->target; ?>" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em class="icon ni <?php echo  $icon_disp; ?>"></em></span>
                                                        <span class="nk-menu-text"> <?php echo $menu->title; ?> </span>
                                                    </a>
                                                </li>
                                            
                                                 <?php    
                                                }
                                      }
                                      else{ //When it has parent
                                      
                                   ?>
                                       
            
                                        <li class="nk-menu-item">
                                                <a href="<?php echo $menu_item_link; ?>"  target="<?php echo $menu->target; ?>" class="nk-menu-link">
                                                    <span class="nk-menu-text"> <?php echo $menu->title; ?>  </span>
                                                </a>
                                        </li>
                    
                                   
                                  <?php
                                  
                                          $child_counter--;//reduce remaining children - COUNTER REDUCTION FXN 
                                          if($child_counter==0){
                                    ?>
                                              </ul>
                                            </li>
                                    <?php
                                              $child_counter = 'not_yet';
                                          }
                                      }
                                     
                                     }
                    
                                   ?>
                                  
                    
                                <?php
                    
                                }
                    
                                 else{
                                  echo '<li>
                                        <a href="ads_setup.php">
                                            <i class="far fa-map"></i>
                                            Set Menu - (<small> visible to only you </small>)
                                        </a>
                                    </li>';
                                  }
                                ?>      
                                
                                <!--
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/index.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/accounts.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                            <span class="nk-menu-text">My Account</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/wallets.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                            <span class="nk-menu-text">Wallets</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/buy-sell.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                            <span class="nk-menu-text">Buy / Sell</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/order-history.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                            <span class="nk-menu-text">Orders</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/chats.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-chat-circle"></em></span>
                                            <span class="nk-menu-text">Chats</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/profile.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                            <span class="nk-menu-text">My Profile</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                            <span class="nk-menu-text">Additional Pages</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="html/crypto/welcome.html" class="nk-menu-link"><span class="nk-menu-text">Welcome</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="html/crypto/kyc-application.html" class="nk-menu-link"><span class="nk-menu-text">KYC - Get Started</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="html/crypto/kyc-form.html" class="nk-menu-link"><span class="nk-menu-text">KYC - Application Form</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title">Return to</h6>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/index.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                            <span class="nk-menu-text">Main Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/components.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                            <span class="nk-menu-text">All Components</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nk-sidebar-widget">
                                <div class="widget-title">
                                    <h6 class="overline-title">Crypto Accounts <span>(4)</span></h6>
                                    <a href="#" class="link">View All</a>
                                </div>
                                <ul class="wallet-list">
                                    <li class="wallet-item">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-sign-kobo"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">NioWallet</h6>
                                                <span class="wallet-balance">30.959040 <span class="currency currency-nio">NIO</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="wallet-item">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-sign-btc"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">Bitcoin Wallet</h6>
                                                <span class="wallet-balance">0.0495950 <span class="currency currency-btc">BTC</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="wallet-item wallet-item-add">
                                        <a href="#">
                                            <div class="wallet-icon"><em class="icon ni ni-plus"></em></div>
                                            <div class="wallet-text">
                                                <h6 class="wallet-name">Add another wallet</h6>
                                            </div>
                                        </a>
                                    </li>< -->
                                </ul>
                            </div>
                            <div class="nk-sidebar-footer">
                                <ul class="nk-menu nk-menu-footer">
                                    <li class="nk-menu-item">
                                        <a href="https://zugacoin.io/contact" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                            <span class="nk-menu-text">Support</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item ml-auto">
                                        <div class="dropup">
                                            <a href="#" class="nk-menu-link dropdown-indicator has-indicator" data-toggle="dropdown" data-offset="0,10">
                                                <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                                <span class="nk-menu-text">English</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/english.png" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <!--
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/french.png" alt="" class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                    -->
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-body -->
                </div><!-- .nk-sidebar-element -->
            </div>