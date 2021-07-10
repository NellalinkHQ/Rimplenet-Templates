<?php
    global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $sidebar_mode = get_post_meta($template_id,"sidebar-mode",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
?>

<div class="nk-body npc-crypto bg-white has-sidebar">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php include 'sidebar.php'; ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                 <?php include 'header.php'; ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                        <?php 
                           
                           $content_id = sanitize_text_field($_GET["rimplenet-view-post"]);
                           if(is_numeric($content_id)){
                               $content = get_post_field('post_content', $content_id);
                           }else{
                               $content = get_post_field('post_content', $template_id);
                           }
                        
                           echo apply_filters('the_content',$content );
                        ?>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
               <?php include 'footer.php'; ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
</div>