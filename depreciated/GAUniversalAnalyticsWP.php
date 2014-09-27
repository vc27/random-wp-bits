<?php
/**
 * File Name GAUniversalAnalyticsWP.php
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * GAUniversalAnalyticsWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$GAUniversalAnalyticsWP = new GAUniversalAnalyticsWP();
class GAUniversalAnalyticsWP {
	
	
	
	/**
	 * analytics_id
	 * 
	 * @access public
	 * @var string
	 **/
	var $property_id = 1111;
	
	
	
	/**
	 * analytics_id
	 * 
	 * @access public
	 * @var string
	 **/
	var $advanced_click_tracking = 1;
	
	
	
	/**
	 * domain
	 * 
	 * @access public
	 * @var string
	 **/
	var $domain = '';
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		if ( $this->property_id === 0 ) {
			return;
		}
		
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		add_action( 'wp_head', array( &$this, 'display_tracking_code' ), 11 );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	/**
	 * set_domain
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set_domain( $key ) {
		
		$this->set( 'domain', str_replace( array( 'http://', 'https://', 'www.' ), '', home_url() ) );
		
	} // end function set_domain
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * display_tracking_code
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function display_tracking_code() {
		$this->set_domain();
		?>
			<script type="text/javascript">
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
				ga('create', '<?php echo $this->property_id; ?>', '<?php echo $this->domain; ?>');
				ga('send', 'pageview');
			</script>
		<?php
		
	} // end function display_tracking_code
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_something
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_something() {
		
		if ( isset( $this->something ) AND ! empty( $this->something ) ) {
			$this->set( 'have_something', 1 );
		} else {
			$this->set( 'have_something', 0 );
		}
		
		return $this->have_something;
		
	} // end function have_something
	
	
	
} // end class GAUniversalAnalyticsWP