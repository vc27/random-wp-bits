<?php
/**
 * File Name wrapper-functions.php
 * @package ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 * 
 * Description:
 * Utilize classes at any point in time with out preloading them.
 **/
#################################################################################################### */


/**
 * GetPostIdByCFValue --> Wrapper Function
 *
 * @version 1.0
 * @updated	00.00.00
 **/
function GetPostIdByCFValue($key,$value) {
	
	$output = false;
	if ( ! class_exists( 'GetPostIdByCFValue' ) ) {
		require_once( 'GetPostIdByCFValue.php' );
	}
	
	if ( class_exists( 'GetPostIdByCFValue' ) ) {
		
		$GetPostIdByCFValue = new GetPostIdByCFValue($key,$value);
		$output = $GetPostIdByCFValue->get('post_id');
	}
	
	return $output;
	
} // end function GetPostIdByCFValue






/**
 * SendCustomMailWP --> Wrapper Function
 *
 * @version 1.0
 * @updated	00.00.00
 **/
function SendCustomMailWP( $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'SendCustomMailWP' ) ) {
		require_once( 'SendCustomMailWP.php' );
	}
	
	if ( class_exists( 'SendCustomMailWP' ) ) {
		
		$SendCustomMailWP = new SendCustomMailWP();
		$output = $SendCustomMailWP->send_mail( $args );
	}
	
	return $output;
	
} // end function SendCustomMailWP