<?php
    global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $sidebar_mode = get_post_meta($template_id,"sidebar-mode",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
    
    $before_profile_menu_text = get_post_meta($template_id,"before-profile-menu-text",true);
    
    
    $dashboard_title = get_post_meta($template_id,"title",true);
    if(empty($dashboard_title)){ $dashboard_title= get_bloginfo("name"); }
    
    $dashboard_logo = get_post_meta($template_id,"dashboard-logo",true);
    if(empty($dashboard_logo)){ $dashboard_logo = get_site_icon_url('', ''); }
    
    $dashboard_logo_dark = get_post_meta($template_id,"dashboard-logo-dark",true);
    
    $header_news = get_post_meta($template_id,"header-news",true);
?>

<div class="nk-header nk-header-fluid nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="<?php echo get_permalink(); ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php echo $dashboard_logo; ?>" alt="logo">
                                    <img class="logo-dark logo-img" src="<?php echo $dashboard_logo_dark; ?>" alt="logo-dark">
                                    <span class="nio-version"><?php echo $dashboard_title; ?></span>
                                </a>
                            </div>
                            <?php if(!empty($header_news)){ echo $header_news; } ?>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status"><?php echo $current_user->user_login; ?></div>
                                                    <div class="user-name dropdown-indicator"><?php echo $current_user->display_name; ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>PP</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo $current_user->display_name; ?></span>
                                                        <span class="sub-text"><?php echo $current_user->user_email; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                          <?php echo do_shortcode($before_profile_menu_text); ?>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                      
                                             <?php
                                                    
                                                    
                                              $profileMenuChosen = get_post_meta($template_id,"profile-menu",true);
                                              $profileMenu = wp_get_nav_menu_items($profileMenuChosen);
                                              if ($profileMenu!=false) {
                                                foreach ($profileMenu as $key => $menu) {
                                                   
                                                 //$menu_item_target = get_post_meta( $menu->ID, '_menu_item_target',true);
                                                 $post_id = $menu->object_id;
                                                
                                                  if (get_post_meta( $menu->ID, '_rimplenet_menu_meta',true)) {
                                                    $icon_name = get_post_meta( $menu->ID, '_rimplenet_menu_meta',true);
                                                    $icon_disp = '<span class="material-icons">'.$icon_name.'</span>';
                                                  }
                                                  else{
                                                    $icon_disp = '';
                                                  }
                                
                                                  if($post_id==$active_menu_post_id){
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
                                                   $menu_item_link =  get_permalink().'?rimplenet-view-post='.$post_id;
                                                 }
                                                 
                                                 ?>
                                                     <li><a   target="<?php echo $menu->target; ?>" href="<?php echo $menu_item_link; ?>"><em class="icon ni <?php echo $icon_name; ?>"></em><span><?php echo $menu->title; ?></span></a></li>
                                              <?php
                                                }
                                                
                                              }
                                              else{
                                                ?>
                                                
                                                 <li><a href="#"><em class="icon ni ni-map"></em><span>Set Menu</span></a></li>
                                            <?php
                                              }
                                                              
                                              ?><!--<li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> -->
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner" style="display:none;"><!-- Display none -->
                                                <ul class="link-list">
                                                    <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown notification-dropdown mr-n1" style="display:none;"> <!-- Display none -->
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                </div>
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>