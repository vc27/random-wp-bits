<?php
/**
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * Password Form, for password protected pages
 *
 * @version 0.4
 * @updated	07.31.12
 *
 * Todo: Remove this function, it's not been utilized for over a year
 **/
function the_password_form( $args = '' ) {
	global $wp_query;

	// Set Defaults
	$defaults = array(
		'welcome' => get_vc_option( 'password_protected', 'welcome_text' ),
		'label_id' => 'pwbox-' . $wp_query->post->ID,
		'label_text' => get_vc_option( 'password_protected', 'label_text' ),
		'submit' => get_vc_option( 'password_protected', 'submit_text' ),
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$output = "<form action=\"" . $this->home_url . "/wp-login.php?action=postpass\" method=\"post\">";
		$output .= wpautop( $welcome );
		$output .= "<label for=\"$label_id\">" . __( $label_text ) . " <input class=\"post_password_field\" name=\"post_password\" id=\"$label_id\" type=\"password\" /></label>";
		$output .= "<input class=\"post_password_button\" type=\"submit\" name=\"Submit\" value=\"" . esc_attr__( $submit ) . "\" />";
	$output .= "</form>";

	return $output;

} // end function the_password_form