<?php
/*
iOS Smart Banner
Copyright (C) 2014 Cameron perry
License: GPLv3
License URI: http://www.gnu.org/copyleft/gpl.html
*/
add_action('admin_init', 'cpisb_admin_opts_init');
add_action('admin_menu', 'cpisb_admin_add_page');

function cpisb_admin_add_page() {

	add_options_page('App Banner for iOS', 'iOS Smart Banner', 'manage_options', 'cpisb_options', 'cpisb_options_page');
}
function cpisb_admin_opts_init(){
	register_setting( 'cpisb_options', 'cpisb_options', 'cpisb_options_validate' );
	add_settings_section('plugin_main', 'Main Settings', 'cpisb_section_text', 'cpisb_options');
	add_settings_field('cpisb_afiiliateID', 'Affiliate ID', 'cpisb_affiliate_setting_string', 'cpisb_options', 'plugin_main');	

	add_settings_section('plugin_donation', 'Help Out', 'cpisb_section_text', 'cpisb_optionsD');
	add_settings_field('cpisb_donation', 'Give a little back', 'cpisb_donate_setting_string', 'cpisb_optionsD', 'plugin_donation');	

}

function cpisb_options_page(){
?>
	<style>
	.intro, .outro {
		width :50%;
		margin-bottom: 25px;
	}
	.outro {
		margin-top: 50px;
	}
	.outro .form-table {
		margin-bottom: 30px;
	}
	hr {
		border: 0;
		background: lightgrey;
		height :1px;
	}
	</style>
	<div class="wrap">
		<h2>iOS Smart Banner</h2>
		<hr>
		<div class="intro">
		<p>iOS App Banner for iOS is a plugin that allows you to take advantage of the new feature in iOS6, where by placing a special <tt>&lt;meta&gt;</tt> tag will tell mobile safari to open a banner at the top of the page, pointing to your app in the app store. <a href="https://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/PromotingAppswithAppBanners/PromotingAppswithAppBanners.html">Check it here</a>.</p>
		<p>This plugin was born out of a need for our own apps with promo pages running on WP sites. If you find it useful, first of all, <strong>tell your friends.</strong></p>

		</div>
		<script type="text/javascript">
		jQuery(function(){

				if(jQuery("#cpisb_donate").is(":checked")){
					jQuery("#cpisb_afiiliateID").attr('disabled', "disabled");
				} else {
					jQuery("#cpisb_afiiliateID").removeAttr('disabled');
				}

			jQuery("#cpisb_donate").on('change',function(){
				if(jQuery(this).is(":checked")){
					jQuery("#cpisb_afiiliateID").attr('disabled', "disabled")
				} else {
					jQuery("#cpisb_afiiliateID").removeAttr('disabled');
				}

			});
		});
		</script>

		<form action="options.php" method="post">
		<?php settings_fields('cpisb_options'); ?>
		<?php do_settings_sections('cpisb_options'); ?>

		<br><br>
		<hr>
		<div class="outro">
			<?php do_settings_sections('cpisb_optionsD'); ?>

			
			<p>Please consider giving a little bit back by checking the donation box above. Checking the box above will set my affiliate link on your banners - so it's like a donation. If you wish to use your affiliate number, but still give back, PayPal is easy and convenient. <br>
				<br>

				<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mistercameron%40gmail%2ecom&lc=US&item_name=Cameron%20Perry&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"></a>
			</p>
		</div>
		<br><br>
		<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	</div>

<?php
}

function cpisb_affiliate_setting_string() {
	$options = get_option('cpisb_options');
	echo "<input id='cpisb_afiiliateID' name='cpisb_options[afiiliateID]' size='15' type='text' value='{$options['afiiliateID']}' />";
}
function cpisb_donate_setting_string() {
	$options = get_option('cpisb_options');

	$checked = ($options['donate'] == 1)? "checked" : '';

	echo "<input name='cpisb_options[donate]' type='hidden' value='0'><input id='cpisb_donate' name='cpisb_options[donate]' type='checkbox' {$checked} value='1' /> ";
}

function cpisb_section_text() {
} 


// validate our options
function cpisb_options_validate($input) {
	$options = get_option('cpisb_options');
	$options['afiiliateID'] = trim($input['afiiliateID']);
	if($input['donate'] == 1){
		$options['donate'] = $input['donate'];
	} else {
		$options['donate'] = 0;
	}
	
	return $options;
}


?>
