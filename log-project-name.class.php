<?php
/**
 * @package wplslr
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 1.0.0
 *
 * Description: Basic class for logging errors and statuses during development
 *
 * Note: Please reference WP Coding standards and update any issues you find
 * https://codex.wordpress.org/WordPress_Coding_Standards
 **/
#################################################################################################### */

/*
$this->set( 'log', new Log_Project_Name() );
$this->log->set( 'log_file_name', 'log.txt' );
$this->log->set( 'log_destination', plugin_dir_path( __FILE__ ) . '../log/Log_Project_Name/' );
*/

/**
 * Log_Project_Name class
 **/
class Log_Project_Name {

	/**
	 * status
	 *
	 * @access public
	 * @var array
	 * @since 1.0.0
	 **/
	var $status = array();

	/**
	 * have_errors
	 *
	 * @access public
	 * @var bool
	 * @since 1.0.0
	 **/
	var $have_errors = 0;

	/**
	 * errors
	 *
	 * @access public
	 * @var array
	 * @since 1.0.0
	 **/
	var $errors = array();

	/**
	 * log_destination
	 *
	 * @access public
	 * @var string
	 * @since 1.0.0
	 **/
	var $log_destination = '..logs/';

	/**
	 * log_file_name
	 *
	 * @access public
	 * @var string
	 * @since 1.0.0
	 **/
	var $log_file_name = 'Log_Project_Name.log';

	/**
	 * time_instance
	 *
	 * @access public
	 * @var string
	 * @since 1.0
	 **/
	var $time_instance = 0;



	/**
	 * construct
	 **/
	function __construct() {

		$this->set( 'time_instance', time() );
		$this->set( 'log_destination', plugin_dir_path( __FILE__ ) . $this->log_destination );

	} // end function __construct



	/**
	 * log_die_maybe_print
	 **/
	function log_die_maybe_print( $method, $line, $print = 0, $log = 1, $die = 1 ) {

		if ( $print ) {
			print_r( $print );
		}
		if ( $log ) {
			$this->log( $method, $line );
		}
		if ( $die ) {
			die( $method );
		}

	} // end function log_die_maybe_print



	/**
	 * error
	 **/
	function error( $errorKey ) {

		$this->errors[] = $errorKey;

	} // end function error



	/**
	 * add_status
	 **/
	function add_status( $status ) {

		$this->status[] = $status;

	} // end function error



	/**
	 * log
	 **/
	function log( $message, $line, $message_type = 3, $destination = false ) {

		if (
			! $destination
			AND $this->log_destination
			AND $this->log_file_name
		) {
			$destination = $this->log_destination . date('Y-m-d-H') . '-' . $this->log_file_name;
		}

		$output = array(
			'instance' => $this->time_instance
			,'date' => date('Y-m-d H:i:s')
			,"message" => $message
			,"status" => $this->status
			,"errors" => $this->errors
			,"line" => $line
			,"path" => realpath(__FILE__)
		);
		$message = "\n" . json_encode( $output );

		error_log( $message, $message_type, $destination );

	} // end function log



	/**
	 * set
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set

} // end class WPLSLS
