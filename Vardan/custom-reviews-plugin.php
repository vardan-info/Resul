<!DOCTYPE html>
<html>
<body>


<?php


register_activation_hook( __FILE__, 'custom_reviews_plugin_activate' );
function custom_reviews_plugin_activate() {
   
    flush_rewrite_rules();
}

)
register_deactivation_hook( __FILE__, 'custom_reviews_plugin_deactivate' );
function custom_reviews_plugin_deactivate() {
   
    flush_rewrite_rules();
}


add_action( 'wp_enqueue_scripts', 'custom_reviews_plugin_enqueue_scripts' );
function custom_reviews_plugin_enqueue_scripts() {

    wp_enqueue_script( 'jquery' );

 
    wp_localize_script( 'jquery', 'custom_reviews_ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'custom_reviews_nonce' )
    ));

    
  
   
}


?>

</body>