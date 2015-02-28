<?php
/**
 * File Name initiate.php
 * @package ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0.0
 **/
#################################################################################################### */


/**
 * ClassNameSettings --> Wrapper Function
 **/
if ( ! function_exists( 'ClassNameSettings' ) ) {
function ClassNameSettings() {
	$output = false;

	if ( ! class_exists( 'ClassNameSettings' ) ) {
		require_once( 'ClassNameSettings.php' );
	}
	if ( class_exists( 'ClassNameSettings' ) ) {
		$output = new ClassNameSettings();
	}

	return $output;

} // end function ClassNameSettings
}
