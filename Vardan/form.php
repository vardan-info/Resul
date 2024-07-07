<!DOCTYPE html>
<html>
<body>


<?php



add_action( 'wp_ajax_custom_reviews_submit_review', 'custom_reviews_submit_review' );
add_action( 'wp_ajax_nopriv_custom_reviews_submit_review', 'custom_reviews_submit_review' ); // For non-logged in users
function custom_reviews_submit_review() {
    check_ajax_referer( 'custom_reviews_nonce', 'nonce' );

    
    parse_str( $_POST['formData'], $formData );

 
    $errors = array();

    if ( empty( $formData['title'] ) ) {
        $errors[] = 'Title is required.';
    }

    if ( empty( $formData['description'] ) ) {
        $errors[] = 'Description is required.';
    }

    if ( empty( $formData['name'] ) ) {
        $errors[] = 'Name is required.';
    }

    if ( empty( $formData['dob'] ) ) {
        $errors[] = 'Date of Birth is required.';
    }

    if ( empty( $formData['company'] ) ) {
        $errors[] = 'Company is required.';
    }

ssages
    if ( ! empty( $errors ) ) {
        echo implode( '<br>', $errors );
        wp_die();
    }

   
    $post_data = array(
        'post_title'    => sanitize_text_field( $formData['title'] ),
        'post_content'  => sanitize_textarea_field( $formData['description'] ),
        'post_type'     => 'reviews',
        'post_status'   => 'publish'
    );

   // database
    $post_id = wp_insert_post( $post_data );

    
    if ( $post_id && function_exists('update_field') ) {
        update_field( 'name', sanitize_text_field( $formData['name'] ), $post_id );
        update_field( 'date_of_birth', sanitize_text_field( $formData['dob'] ), $post_id );
        update_field( 'company_name', sanitize_text_field( $formData['company'] ), $post_id );
    }

    if ( $post_id ) {
        echo 'Review submitted successfully!';
    } else {
        echo 'Error submitting review!';
    }

    wp_die();
}


?>

</body>
</html>
