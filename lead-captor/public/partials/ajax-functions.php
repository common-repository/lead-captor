<?php

if( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] )) {

	$token = $_POST['token'];
	if( wp_verify_nonce( $token, 'lead-captor-secret' ) ){

		$email = sanitize_email( $_POST['email'] );

		$post = array(
		  'post_title'    => $email,
		  'post_content'  => $email,
		  'post_status'   => 'publish',
		  'post_type'     => 'lead-subscriber',
		);
		 
		// Insert the post into the database
		$post_result = wp_insert_post( $post, true );

		if ( is_wp_error( $post_result ) ) {

			wp_send_json_error( $post_result );

		}else{

			wp_send_json_success( $post_result );	

		}		

	}else{

		wp_send_json_error( 'Invalid Nonce' ); //This do not render to the front-end

	}//end token

} // end IF
