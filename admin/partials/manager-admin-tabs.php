<?php
    //This file is Included at admin/class-rimplenet-wallet-addon-admin.php
    $plugin_name = $this->plugin_name;
    global $current_user,$wpdb, $post,  $wp;
     $current_user = wp_get_current_user();
?>
<div class="wrap">
    
    <div id="icon-options-general" class="icon32"></div>
    <h1><?php _e('Rimplenet Templates', 'rimplenet'); ?></h1>
     <!-- wordpress provides the styling for tabs. -->
    <h2 class="nav-tab-wrapper">
        <!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
         <?php
            $active_tab = $_GET["tab"] ;
            if($_GET["tab"] == "recommendations")
             {
               $recommendations_tab_active = "nav-tab-active";
               $path_to_tab = plugin_dir_path( dirname( __FILE__ ) ) . "partials/recommendations.php";
             }
            elseif($_GET["tab"] == "templates-settings-and-importer")
             {
               $templates_importer_tab_active = "nav-tab-active";
               $path_to_tab = plugin_dir_path( dirname( __FILE__ ) ) . "partials/templates-settings-and-importer.php";
             }
            else
             { 
               $active_tab  = "overview";
               $overview_tab_active = "nav-tab-active";
               $path_to_tab = plugin_dir_path( dirname( __FILE__ ) ) . "partials/overview.php";
             }
             
             //Set the url for each of the tab
             $overview_tab_url = add_query_arg( array( 'post_type'=>$_GET["post_type"], 'page'=>$_GET["page"], 'tab'=>'overview', 'viewing_user'=>$current_user->ID), admin_url( "admin.php") );
             $templates_importer_tab_url = add_query_arg( array( 'post_type'=>$_GET["post_type"], 'page'=>$_GET["page"], 'tab'=>'templates-settings-and-importer', 'viewing_user'=>$current_user->ID), admin_url( "admin.php") );
             $recommendations_tab_url = add_query_arg( array( 'post_type'=>$_GET["post_type"], 'page'=>$_GET["page"], 'tab'=>'recommendations', 'viewing_user'=>$current_user->ID), admin_url( "admin.php") );
             
         ?>
        <a href="<?php echo $overview_tab_url; ?>" class="nav-tab <?php echo $overview_tab_active; ?>">
            <?php _e('Overview', 'rimplenet'); ?>
        </a>
        
        <a href="<?php echo $templates_importer_tab_url; ?>" class="nav-tab <?php echo $templates_importer_tab_active; ?>">
            <?php _e('Templates Settings & Importer', 'rimplenet'); ?>
        </a>

        <a href="<?php echo $recommendations_tab_url; ?>" class="nav-tab <?php echo $recommendations_tab_active; ?>">
            <?php _e('Recommendations', 'rimplenet'); ?>
        </a>
        
    </h2>
    <br>
    <div class="clearfix"></div>
     <?php 
        //show the content as per tab from file
        include_once $path_to_tab; 
     ?>
        

    
</div>