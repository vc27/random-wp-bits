<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * fetch__data --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.31.13
 **/
if ( ! function_exists( 'fetch__data' ) ) {
function fetch__data( $type, $url, $args = array(), $transient_name = false, $reset_transient = false ) {

	$output = false;
	if ( ! class_exists( 'GetRemoteDataWP' ) ) {
		require_once( 'GetRemoteDataWP.php' );
	}

	if ( class_exists( 'GetRemoteDataWP' ) ) {

		$fetch__data = new GetRemoteDataWP();
		$fetch__data->fetch_data( $type, $url, $args, $transient_name, $reset_transient );
		$output = $fetch__data;

	}

	return $output;

} // end function fetch__data
}
