<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rimplenet.com/templates
 * @since      1.0.0
 *
 * @package    Rimplenet_Templates
 * @subpackage Rimplenet_Templates/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rimplenet_Templates
 * @subpackage Rimplenet_Templates/admin
 * @author     Nellalink <info@rimplenet.com>
 */
class Rimplenet_Templates_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
		
        add_action( 'admin_menu', array( $this, 'admin_menu_addon_display' ) );
        
        add_action( 'admin_menu', array( $this, 'templates_settings_and_import' ));
        add_action( 'admin_menu', array( $this, 'admin_menu_docs_setup_link' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_donate_link' ) );
        
        add_filter("plugin_action_links_rimplenet-templates/rimplenet-templates.php", array( $this, 'my_plugin_settings_link') );
        add_action( 'admin_footer', array($this,'make_class_menu_target_blank' ));  
        
        
		add_action( 'wp_nav_menu_item_custom_fields', array($this,'nav_menu_custom_fields'), 10, 2 );
		add_filter( 'wp_setup_nav_menu_item',array($this,'nav_menu_setup_custom_fields' ));
		add_action( 'wp_update_nav_menu_item', array($this,'nav_menu_update'), 10, 2 );
		

	}
	
		
    public function admin_menu_addon_display(){
           
            add_menu_page(
                __( 'Rimplenet Templates', 'rimplenet' ),
                __( 'Rimplenet Templates', 'rimplenet' ),
                'manage_options',
                'rimplenet-templates',
                array( $this, 'admin_menu_addon_display_fxn' ),
                "dashicons-list-view",
                22
            );
            

        }

    public function admin_menu_addon_display_fxn() { 
          include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/tabs-manager.php';
       }
    
      public function templates_settings_and_import()
	{
		 add_submenu_page(
            'rimplenet-templates',
            __( 'Templates - Settings & Importer', 'text-domain' ),
            __( 'Templates - Settings & Importer', 'text-domain' ),
            'manage_options',
            admin_url( 'admin.php?page=rimplenet-templates&tab=templates-settings-and-importer')
            );
		   
	}
	
    public function admin_menu_docs_setup_link ()
	{
		 add_submenu_page(
            'rimplenet-templates',
            __( '<strong style="color:#FCB214;" class="submenu-page"> Docs / How to Use</strong>', 'text-domain' ),
            __( '<strong style="color:#FCB214;" class="submenu-page"> Docs /  How to Use</strong>', 'text-domain' ),
            'manage_options',
            
            'https://rimplenet.com/docs/templates'
            
            );
		   
	}

       
  
  
         
    
  
    public function admin_menu_donate_link()
	{
		 add_submenu_page(
            'rimplenet-templates',
            __( '<strong style="color:#31a231;" class="submenu-page"> Donate </strong>', 'text-domain' ),
            __( '<strong style="color:#31a231;" class="submenu-page"> Donate </strong>', 'text-domain' ),
            'manage_options',
            'https://rimplenet.com/donate'
            
            );
	}
	
	function make_class_menu_target_blank()
    {
        ?>
        <script type="text/javascript">
          jQuery(document).ready(function($) {
            $('.submenu-page').parent().attr('target','_blank');
          });
        </script>
        <?php
    }
    
    
    
    //On Plugin Activation/Deactivation Page	
	function my_plugin_settings_link($links) { 
      
      // Build and escape the URL.
    	// Create the link.
    	$settings_link = "<a href='".admin_url( 'admin.php?page=rimplenet-templates')."'>" . __( 'Settings' ) . '</a>';
    	$docs_link = "<a href='https://rimplenet.com/docs/templates'  style='color: #93003c;font-weight: 800;' target='_blank'>" . __( 'Docs / How to Use' ) . '</a>';
    	$donate_link = "<a href='https://rimplenet.com/donate' style='color: #FCB214;font-weight: 800;' target='_blank'>" . __( 'Donate' ) . '</a>';
    	// Adds the link to the end of the array.
    	$added_links = array($settings_link,$docs_link,$donate_link);
    	
    	$all_links = array_merge($added_links,$links);
    	return $all_links;
    }
    
    
               
    function nav_menu_custom_fields( $item_id, $item ) {
     
    	wp_nonce_field( 'rimplenet_menu_meta_nonce', '_rimplenet_menu_meta_nonce_name' );
    	$custom_menu_meta = get_post_meta( $item_id, '_rimplenet_menu_meta', true );
    	?>
     
    	<input type="hidden" name="rimplenet-menu-meta-nonce" value="<?php echo wp_create_nonce( 'rimplenet-menu-meta-name' ); ?>" />
     
    	<div class="field-rimplenet_menu_meta description-wide" style="margin: 5px 0;">
    	    <span class="description"><?php _e('Input BNVB Icon Name - Icons @ <a href="https://material.io/resources/icons/" target="_blank">https://material.io/resources/icons/</a> ', 'rimplenet-menu-meta' ); ?></span>
    	    <br>
    	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
     
    	    <div class="logged-input-holder">
    	        <input class="widefat edit-menu-item-rimplenet" type="text" name="rimplenet_menu_meta[<?php echo $item_id ;?>]" id="rimplenet-menu-meta-for-<?php echo $item_id ;?>" placeholder="account_box" value="<?php echo esc_attr( $custom_menu_meta ); ?>" />
    	        <label for="rimplenet-menu-meta-for-<?php echo $item_id ;?>">
    	            <?php _e( 'Input the icon_name, the icon may only appear when used with BNVB dashboard Menu', 'rimplenet-menu-meta'); ?>
    	        </label>
    	    </div>
    	</div>
     
    	<?php
    }
    
    function nav_menu_setup_custom_fields($menu_item) {
        $menu_item->custom = get_post_meta( $menu_item->ID, '_rimplenet_menu_meta', true );
        return $menu_item;
    }
    
    function nav_menu_update( $menu_id, $menu_item_db_id ) {
     
    	// Verify this came from our screen and with proper authorization.
    	if ( ! isset( $_POST['_rimplenet_menu_meta_nonce_name'] ) || ! wp_verify_nonce( $_POST['_rimplenet_menu_meta_nonce_name'], 'rimplenet_menu_meta_nonce' ) ) {
    		return $menu_id;
    	}
     
    	if ( isset( $_POST['rimplenet_menu_meta'][$menu_item_db_id]  ) ) {
    		$sanitized_data = sanitize_text_field( $_POST['rimplenet_menu_meta'][$menu_item_db_id] );
    		update_post_meta( $menu_item_db_id, '_rimplenet_menu_meta', $sanitized_data );
    	} else {
    		delete_post_meta( $menu_item_db_id, '_rimplenet_menu_meta' );
    	}
    }
    
    private function load_dependencies(){
        
		//Include file to displays Template Settings Metabox 
		include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/class-template-settings.php';
    }
         


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rimplenet_Templates_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rimplenet_Templates_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rimplenet-templates-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rimplenet_Templates_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rimplenet_Templates_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rimplenet-templates-admin.js', array( 'jquery' ), $this->version, false );

	}

}
