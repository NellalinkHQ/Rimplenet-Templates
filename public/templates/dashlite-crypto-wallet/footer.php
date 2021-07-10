<?php
    global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $sidebar_mode = get_post_meta($template_id,"sidebar-mode",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
    
    $copyright_text = get_post_meta($template_id,"footer-copyright-text",true);
?>
<div class="nk-footer nk-footer-fluid">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <?php
                              if(!empty($copyright_text)){
                            ?>
                                <div class="nk-footer-copyright"> <?php echo $copyright_text; ?></div>
                            <?php
                             }
                            ?>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                 <?php    
                                  $FooterMenuChosen = get_post_meta($template_id,"footer-menu",true);
                                  $footerMenu = wp_get_nav_menu_items($FooterMenuChosen);
                                  if ($footerMenu!=false) {
                                      foreach ($footerMenu as $key => $menu) {
                                       
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
                                    <li class="nav-item"><a class="nav-link"   target="<?php echo $menu->target; ?>" href="<?php echo $menu_item_link; ?>"><?php echo $menu->title; ?></a></li>
                                <?php
                                          
                                      }
                                  }
                                  else{
                                ?>
                                    <li class="nav-item"><a class="nav-link" href="#">Set Menu</a></li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>