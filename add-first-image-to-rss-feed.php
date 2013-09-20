<?php
/* 
Plugin Name: Add first image to RSS feed
Plugin URI: http://www.zubinraj.com/
Description: Adds the first image attached to your posts to the RSS feed.
Author: Zubin Raj
Version: 1.0
Author URI: http://www.zubinraj.com
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
			$thumb_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium' )  ? wp_get_attachment_image_src( $attachment->ID, 'medium' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
			$original_attributes = wp_get_attachment_image_src( $attachment->ID, 'full' );

			$output .= '<image>';
			$output .= '<thumb width="' . $thumb_attributes[1] . '" height="' . $thumb_attributes[2] . '">' ;
			$output .= $thumb_attributes[0];
			$output .= '</thumb>';
			$output .= '<original width="' . $original_attributes[1] . '" height="' . $original_attributes[2] . '">' ;
			$output .= $original_attributes[0];
			$output .= '</original>';
			$output .= '</image>';

		}
	}
	

	echo $output;
 
}

?>