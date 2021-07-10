<?php

function add_rimplenet_dashlite_template_stylesheet() 
    {
      //Dashlite Css 
      wp_enqueue_style('rimplenet-template-dashlite-crypto-wallet-main', plugins_url( '/assets/css/dashlite.css', __FILE__ ) );
      //Theme Css 
      wp_enqueue_style('rimplenet-template-dashlite-crypto-wallet-theme', plugins_url( '/assets/css/theme.css', __FILE__ ) );
      
      
     //Google Font
      //wp_enqueue_style('rimplenet-template-default-google-font-poiret-one', '//fonts.googleapis.com/css?family=Poiret+One');
      //wp_enqueue_style('rimplenet-template-default-google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
      
      //wp_enqueue_style('rimplenet-template-default-google-font-icons', '//fonts.googleapis.com/css?family=Material+Icons');
      
}

add_action('wp_enqueue_scripts', 'add_rimplenet_dashlite_template_stylesheet');


function add_rimplenet_dashlite_template_js() {
      //Bundle Js
      wp_enqueue_script( 'rimplenet-template-bundle-bootstrap',  plugins_url( '/assets/js/bundle.js', __FILE__ ) );
      //Bundle Js
      wp_enqueue_script( 'rimplenet-template-scripts-bootstrap',  plugins_url( '/assets/js/scripts.js', __FILE__ ) );
      //Bundle Js
      wp_enqueue_script( 'rimplenet-template-charts-bootstrap',  plugins_url( '/assets/js/charts/chart-crypto.js', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'add_rimplenet_dashlite_template_js' );

?>