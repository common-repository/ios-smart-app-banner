<?php

/*
Plugin Name: iOS Smart App Banner
Plugin URI: http://iamcam.wordpress.com
Description: This plugin will add the iOS application banner at the top of your web page in mobile safari.
Version: 1.2
Author: Cameron Perry
Copyright: 2014 Cameron Perry
Author URI: http://iamcam.wordpress.com
License: GPLv3
*/


/**
 * Spits out the meta tag
**/

if( ! function_exists('cpisb_make_ios_banner_meta')) {
	function cpisb_make_ios_banner_meta(){

		$options = get_option('cpisb_options');

		//The $post global is implicit
		$values = get_post_custom();

		if( ! count($values)){
		return;
		}
		if( count($values['_cpisb_app_id'])>0){
			if(strlen(trim($values['_cpisb_app_id'][0])) > 0){
				$appID = trim($values['_cpisb_app_id'][0]);
			} else {
				return;
			}
		} else {
			//Must at least have an app ID on the post to get it to work
			return;
		}

		$siteID = '';

		//Use the user's affiliate ID if they provide one, but override if they chose the donate button
		if($options['donate'] == 0 && strlen($options['affiliateID']) >0 ){
			$affiliateID = $options['affiliateID'];
		} elseif( $options['donate'] == 1 ){
			$affiliateID = '10l5KP'; //Use the donation affiliate ID #
		}
		$affStr = (strlen($siteID)) ? ", affiliate-data=at=".$affiliateID : '';
		$arg = '';
		if(strlen($values['_cpisb_app_arg'][0])){
			$arg = ", app-argument=".$values['_cpisb_app_arg'][0];
		}

		$meta = '<meta name="apple-itunes-app" content="app-id='.$appID. $affStr . $arg .'" />';

		echo $meta;
	}
	add_action("wp_head", "cpisb_make_ios_banner_meta");
}


function cpisb_admin_init(){
	add_meta_box('abi-options', __("iOS App Banner"), 'cpisb_make_custom_fields', 'post', 'normal','default' );
	add_meta_box('abi-options', __("iOS App Banner"), 'cpisb_make_custom_fields', 'page', 'normal','default' );

	// Some themes use custom portfolio post types
    add_meta_box('abi-options', __("iOS App Banner"), 'cpisb_make_custom_fields', 'portfolio', 'normal','default' );

}
add_action('admin_init', 'cpisb_admin_init');
add_action('save_post', 'cpisb_save_data');

function cpisb_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=cpisb_options">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'cpisb_plugin_settings_link' );

function cpisb_make_custom_fields(){
	
	echo  wp_nonce_field( plugin_basename( __FILE__ ), 'cpisb_banner_noncename' );
	global $post;
	$val = get_post_meta($post->ID);

	$appID = $val['_cpisb_app_id'][0];
	$appArg = $val['_cpisb_app_arg'][0];
	?>
		<label class="cpisb" for="_cpisb_app_id">App Store ID</label>
		<input type="text" name="_cpisb_app_id" id="_cpisb_app_id" value="<?php echo $appID; ?>">
		<br>
		<br>
		<label class="cpisb" for="_cpisb_app_arg">App Argument</label>
		<input type="text" name="_cpisb_app_arg" id="_cpisb_app_arg" value="<?php echo $appArg; ?>" placeholder="(optional)schema://path">
		<style>label.cpisb{width: 100px;display: inline-block;}</style>
	<?php
}

function cpisb_save_data($post_id){
	// Don't save autosave routines
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
  }

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['cpisb_banner_noncename'], plugin_basename( __FILE__ ) ) ){
	  return;
	}


	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ){
			return;
		}
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ){
		    return;
		}
	}

	$appID = trim($_POST['_cpisb_app_id']);
	$appArg = trim($_POST['_cpisb_app_arg']);
	update_post_meta($post_id, '_cpisb_app_id', $appID);
	update_post_meta($post_id, '_cpisb_app_arg', $appArg);
}

include(dirname(__FILE__).'/options.php');
?>
