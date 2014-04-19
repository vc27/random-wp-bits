<?php
/**
 * File Name social-networks.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 07.08.13
 **/
#################################################################################################### */

?>
<ul class="social-networks">
	<?php if ( get_vc_option( 'social_networks', 'facebook' ) ) { ?><li><a class="icon-facebook-sign" target="_blank" href="<?php echo get_vc_option( 'social_networks', 'facebook' ); ?>"></a></li><?php } ?>
	<?php if ( get_vc_option( 'social_networks', 'twitter' ) ) { ?><li><a class="icon-twitter-sign" target="_blank" href="<?php echo get_vc_option( 'social_networks', 'twitter' ); ?>"></a></li><?php } ?>
</ul>