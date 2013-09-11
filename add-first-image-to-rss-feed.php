<?php
/* 
Plugin Name: Add first image to RSS feed
Plugin URI: http://www.zubinraj.com/
Description: Adds the first image attached to your posts to the RSS feed.
Author: Zubin Raj
Version: 1.0
Author URI: http://www.zubinraj.com
*/

/*	function echo_first_image( $content ) {
		global $post;
		$args = array(
			'numberposts' => 1,
			'order' => 'ASC',
			'post_mime_type' => 'image',
			'post_parent' => $post->ID,
			'post_status' => null,
			'post_type' => 'attachment',
		);

		$attachments = get_children( $args );

		if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
				$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium' )  ? wp_get_attachment_image_src( $attachment->ID, 'medium' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );

				$content = '<div class="zr-first-image-thumb"><img src="' . $image_attributes[0] . '"/></div>' . $content;
			}
		}
		
		return $content;

	}	
	add_filter('the_excerpt_rss', 'echo_first_image', 1000, 1);
	add_filter('the_content_feed', 'echo_first_image', 1000, 1);
*/

add_action( 'rss2_item', 'add_first_image' );

function add_first_image() {
	global $post;

	$output = '';

	$args = array(
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',
		'post_parent' => $post->ID,
		'post_status' => null,
		'post_type' => 'attachment',
	);

	$attachments = get_children( $args );

	
	if ( $attachments ) {
		foreach ( $attachments as $attachment ) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium' )  ? wp_get_attachment_image_src( $attachment->ID, 'medium' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );

			$output .= '<thumbnail>';
			$output .= '<url>'. $image_attributes[0] .'</url>';
			$output .= '</thumbnail>';

		}
	}
	

	echo $output;
 
}

?>