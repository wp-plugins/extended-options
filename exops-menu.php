<?php
/*
EXTENDED OPTIONS
by SCOTT ALLAN WALLICK, http://scottwallick.com/
from PLAINTXT.ORG, http://www.plaintxt.org/

This file is part of EXTENDED OPTIONS.

EXTENDED OPTIONS is free software: you can redistribute it and/or
modify it under the terms of the GNU General Public License as
published by the Free Software Foundation, either version 3 of
the License, or (at your option) any later version.

EXTENDED OPTIONS is distributed in the hope that it will be
useful, but WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for details.

You should have received a copy of the GNU General Public License
along with EXTENDED OPTIONS. If not, see www.gnu.org/licenses/.
*/

// Allow localization, if applicable
load_plugin_textdomain('exops');
// Let them donate, if they will
if ( !function_exists('plaintxt_plugin_donate') ) {
	// If another plaintxt.org plugin is initialized before this one, use its donate function instead
	function plaintxt_plugin_donate() {
		$button = '
			<form id="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:left;margin:0.9em 0.5em 0 0;">
				<div id="donate">
					<input name="cmd" type="hidden" value="_s-xclick" />
					<input name="submit" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" type="image" alt="' . __( 'PayPal: The safer, easier way to donate!', 'exops' ) . '" />
					<img src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="' . __( 'Donate with PayPal', 'exops' ) . '" width="1" height="1" border="0" />
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
				</div>
			</form>';
		// And let's spit out our button on command.
		echo $button . "\n";
	}
}
// Should you be doing this?
if ( !current_user_can('manage_options') ) {
	// Apparently not.
	die( __( 'ACCESS DENIED: Your don\'t have permission to do this.', 'exops' ) );
} elseif ( $_POST['action'] && $_POST['action'] == 'update' ) {
	// Did this $_POST come from our form?
	check_admin_referer('exop_save_options');
	// Good. But before we process certain data, we should know who we are dealing with
	if ( current_user_can('unfiltered_html') ) {
		// We'll allow unfiltered HTML from power users, whatever that means
		update_option( 'exop_comment_addin_content', stripslashes($_POST['comment_addin_content']) );
		update_option( 'exop_footer_addin_content', stripslashes($_POST['footer_addin_content']) );
		update_option( 'exop_meta_addin_content', stripslashes($_POST['meta_addin_content']) );
	} else {
		// Otherwise, we're going to filter more aggresively from powerless users
		update_option( 'exop_comment_addin_content', stripslashes(wp_filter_post_kses($_POST['comment_addin_content'])) );
		update_option( 'exop_footer_addin_content', stripslashes(wp_filter_post_kses($_POST['footer_addin_content'])) );
		update_option( 'exop_meta_addin_content', stripslashes(wp_filter_post_kses($_POST['meta_addin_content'])) );
	}
	// OK, now we can process data submitted from our form safely
	update_option( 'exop_comment_addin', strip_tags(stripslashes($_POST['comment_addin'])) );
	update_option( 'exop_footer_addin', strip_tags(stripslashes($_POST['footer_addin'])) );
	update_option( 'exop_meta_addin', strip_tags(stripslashes($_POST['meta_addin'])) );
	update_option( 'exop_meta_archives', strip_tags(stripslashes($_POST['meta_archives'])) );
	update_option( 'exop_meta_archives_count', strip_tags(stripslashes($_POST['meta_archives_count'])) );
	update_option( 'exop_meta_archives_type', strip_tags(stripslashes($_POST['meta_archives_type'])) );
	update_option( 'exop_meta_favicon_base64', strip_tags(stripslashes($_POST['meta_favicon_base64'])) );
	update_option( 'exop_meta_favicon_link', strip_tags(stripslashes($_POST['meta_favicon_link'])) );
	update_option( 'exop_meta_geotags', strip_tags(stripslashes($_POST['meta_geotags'])) );
	update_option( 'exop_meta_geotags_country', strip_tags(stripslashes($_POST['meta_geotags_country'])) );
	update_option( 'exop_meta_geotags_latitude', strip_tags(stripslashes($_POST['meta_geotags_latitude'])) );
	update_option( 'exop_meta_geotags_longitude', strip_tags(stripslashes($_POST['meta_geotags_longitude'])) );
	update_option( 'exop_meta_geotags_placename', strip_tags(stripslashes($_POST['meta_geotags_placename'])) );
	update_option( 'exop_meta_geotags_region', strip_tags(stripslashes($_POST['meta_geotags_region'])) );
	update_option( 'exop_meta_microid_identity_uri', strip_tags(stripslashes($_POST['meta_microid_identity_uri'])) );
	update_option( 'exop_meta_microid_link', strip_tags(stripslashes($_POST['meta_microid_link'])) );
	update_option( 'exop_meta_openid_delegate_uri', strip_tags(stripslashes($_POST['meta_openid_delegate_uri'])) );
	update_option( 'exop_meta_openid_link', strip_tags(stripslashes($_POST['meta_openid_link'])) );
	update_option( 'exop_meta_openid_server_uri', strip_tags(stripslashes($_POST['meta_openid_server_uri'])) );
	update_option( 'exop_meta_openid_yadis_uri', strip_tags(stripslashes($_POST['meta_openid_yadis_uri'])) );
	update_option( 'exop_meta_relationship_links', strip_tags(stripslashes($_POST['meta_relationship_links'])) );
	update_option( 'exop_robots_meta_404', strip_tags(stripslashes($_POST['robots_meta_404'])) );
	update_option( 'exop_robots_meta_author', strip_tags(stripslashes($_POST['robots_meta_author'])) );
	update_option( 'exop_robots_meta_cats', strip_tags(stripslashes($_POST['robots_meta_cats'])) );
	update_option( 'exop_robots_meta_date', strip_tags(stripslashes($_POST['robots_meta_date'])) );
	update_option( 'exop_robots_meta_search', strip_tags(stripslashes($_POST['robots_meta_search'])) );
	update_option( 'exop_robots_meta_tags', strip_tags(stripslashes($_POST['robots_meta_tags'])) );
	update_option( 'exop_robots_meta_wpadmin', strip_tags(stripslashes($_POST['robots_meta_wpadmin'])) );
	update_option( 'exop_robots_meta_wplogin', strip_tags(stripslashes($_POST['robots_meta_wplogin'])) );
	update_option( 'exop_tweak_301_author', strip_tags(stripslashes($_POST['tweak_301_author'])) );
	update_option( 'exop_tweak_404_headers', strip_tags(stripslashes($_POST['tweak_404_headers'])) );
	update_option( 'exop_tweak_admin_favicon', strip_tags(stripslashes($_POST['tweak_admin_favicon'])) );
	update_option( 'exop_tweak_admin_favicon_base64', strip_tags(stripslashes($_POST['tweak_admin_favicon_base64'])) );
	update_option( 'exop_tweak_atom_api_link', strip_tags(stripslashes($_POST['tweak_atom_api_link'])) );
	update_option( 'exop_tweak_generator', strip_tags(stripslashes($_POST['tweak_generator'])) );
	update_option( 'exop_tweak_rsd_link', strip_tags(stripslashes($_POST['tweak_rsd_link'])) );
	update_option( 'exop_tweak_wlw_link', strip_tags(stripslashes($_POST['tweak_wlw_link'])) );
	update_option( 'exop_tweak_www', strip_tags(stripslashes($_POST['tweak_www'])) );
	// If we've updated settings, show a message
	echo '<div id="message" class="updated fade"><p><strong>' . __( 'Settings saved.', 'exops' ) . '</strong></p></div>';
}
// Let's get some variables for multiple instances
$selected = ' selected="selected"';
// And we being the actual menu HTML
?>
<div class="wrap">
	<h2><?php _e( 'Extended Options', 'exops' ) ?></h2>
	<?php if ( function_exists('plaintxt_plugin_donate') ) plaintxt_plugin_donate(); ?>
	<p><?php _e( 'Thank you for using this <a href="http://www.plaintxt.org/" title="plaintxt.org">plaintxt.org</a> plugin. When deactivating this plugin, its settings will be permanently deleted from you database.', 'exops' ) ?></p>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
		<?php wp_nonce_field('exop_save_options'); echo "\n"; ?>
		<h3><?php _e( 'General Meta Links', 'exops' ) ?></h3>
		<p><?php _e( 'These meta links add semantic links and accessibility for some browsers/spiders.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'General Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_archives"><?php _e( 'Archives Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Archive Meta Links', 'exops' ) ?></legend>
						<select name="meta_archives" id="meta_archives">
							<option value="0"<?php if ( get_option('exop_meta_archives') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_archives') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
						<p><label for="meta_archives_type"><?php _e( 'Generate by', 'exops' ) ?></label>
							<select name="meta_archives_type" id="meta_archives_type">
								<option value="1"<?php if ( get_option('exop_meta_archives_type') == 1 ) echo $selected; ?>> <?php _e( 'post', 'exops' ) ?> </option>
								<option value="2"<?php if ( get_option('exop_meta_archives_type') == 2 ) echo $selected; ?>> <?php _e( 'day', 'exops' ) ?> </option>
								<option value="3"<?php if ( get_option('exop_meta_archives_type') == 3 ) echo $selected; ?>> <?php _e( 'week', 'exops' ) ?> </option>
								<option value="4"<?php if ( get_option('exop_meta_archives_type') == 4 ) echo $selected; ?>> <?php _e( 'month', 'exops' ) ?> </option>
								<option value="5"<?php if ( get_option('exop_meta_archives_type') == 5 ) echo $selected; ?>> <?php _e( 'year', 'exops' ) ?> </option>
							</select>
							<label for="meta_archives_count"><?php _e( 'and produce', 'exops' ) ?> <input id="meta_archives_count" name="meta_archives_count" type="text" value="<?php echo attribute_escape(get_option('exop_meta_archives_count')); ?>" size="3" /> <?php _e( 'archive meta links.', 'exops' ) ?></label></p>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_relationship_links"><?php _e( 'Relationship Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Relationship Meta Links', 'exops' ) ?></legend>
						<select name="meta_relationship_links" id="meta_relationship_links">
							<option value="0"<?php if ( get_option('exop_meta_relationship_links') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_relationship_links') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'Relationship meta links include <code>next</code>, <code>prev</code>, <code>first</code>, <code>last</code>, <code>parent</code>, and <code>start</code>.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'Favicon Meta Links', 'exops' ) ?></h3>
		<p><?php _e( 'Favicons are small icons that are displayed in the address bar, in bookmarks, and/or in a tab interface.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'Favicon  Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_favicon_link"><?php _e( 'Blog Favicon', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Blog Favicon Meta Link', 'exops' ) ?></legend>
						<select name="meta_favicon_link" id="meta_favicon_link">
							<option value="0"<?php if ( get_option('exop_meta_favicon_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_favicon_link') == 1 ) echo $selected; ?>> <?php _e( 'Encoded embeded favicon', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_meta_favicon_link') == 2 ) echo $selected; ?>> <?php _e( 'Favicon in root directory', 'exops' ) ?> </option>
						</select>
<?php
	if ( get_option('exop_meta_favicon_link') == 2 ) {
		printf(__( '<p>Current blog favicon is: <img src="%s/favicon.ico" alt="[Blog favicon]" /></p>', 'exops' ), get_bloginfo('url') );
	} elseif ( get_option('exop_meta_favicon_link') == 1 ) {
		$favicon_base64 = null;
		$favicon_base64 = attribute_escape(get_option('exop_meta_favicon_base64')); ?>
						<p><?php printf(__( '<label for="meta_favicon_base64">Your blog favicon</label>, the <a href="http://www.motobit.com/util/base64-decoder-encoder.asp" title="Base64 Encoder Online" rel="external">base64</a> string provided below: <img src="data:application/octet-stream;base64,%s" alt="[Save to preview]" />', 'exops' ), str_replace( array( "\r", "\n", "\t" ), '', $favicon_base64 ) ) ?></p>
						<textarea name="meta_favicon_base64" id="meta_favicon_base64" cols="50" rows="3" class="code" style="font-size:12px;width:95%;"><?php echo str_replace( array( "\r", "\n", "\t" ), '', $favicon_base64 ); ?></textarea><?php
	} ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_admin_favicon"><?php _e( 'Dashboard Favicon', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'WordPress Dashboard Favicon Meta Link', 'exops' ) ?></legend>
						<select name="tweak_admin_favicon" id="tweak_admin_favicon">
							<option value="0"<?php if ( get_option('exop_tweak_admin_favicon') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_admin_favicon') == 1 ) echo $selected; ?>> <?php _e( 'Encoded embeded favicon', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_meta_favicon_link') == 2 ) echo $selected; ?>> <?php _e( 'Favicon in admin directory', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_tweak_admin_favicon') == 3 ) echo $selected; ?>> <?php _e( 'WordPress.com favicon', 'exops' ) ?> </option>
							<option value="4"<?php if ( get_option('exop_tweak_admin_favicon') == 4 ) echo $selected; ?>> <?php _e( 'WordPress.org favicon', 'exops' ) ?> </option>
						</select>
<?php
	$dashFavicon = null;
	$dashFavicon = get_option('exop_tweak_admin_favicon');
	if ( $dashFavicon == 3 ) {
		printf(__( '<p>Current dashboard favicon is: <img src="%s/wp-content/plugins/extended-options/icons/wp-com_favicon.ico" alt="[Dashboard favicon]" /></p>', 'exops' ), get_bloginfo('wpurl') );
	} elseif ( $dashFavicon == 4 ) {
		printf(__( '<p>Current dashboard favicon is: <img src="%s/wp-content/plugins/extended-options/icons/wp-org_favicon.ico" alt="[Dashboard favicon]" /></p>', 'exops' ), get_bloginfo('wpurl') );
	} elseif ( $dashFavicon == 2 ) {
		printf(__( '<p>Current dashboard favicon is: <img src="%s/wp-admin/favicon.ico" alt="[Dashboard favicon]" /></p>', 'exops' ), get_bloginfo('wpurl') );
	} elseif ( $dashFavicon == 1 ) {
		$favicon_base64 = null;
		$favicon_base64 = attribute_escape(get_option('exop_tweak_admin_favicon_base64')); ?>
						<p><?php printf(__( '<label for="tweak_admin_favicon_base64">Your dashboard favicon</label>, the <a href="http://www.motobit.com/util/base64-decoder-encoder.asp" title="Base64 Encoder Online" rel="external">base64</a> string provided below: <img src="data:application/octet-stream;base64,%s" alt="[Save to preview]" />', 'exops' ), str_replace( array( "\r", "\n", "\t" ), '', $favicon_base64 ) ) ?></p>
						<textarea name="tweak_admin_favicon_base64" id="tweak_admin_favicon_base64" cols="50" rows="3" class="code" style="font-size:12px;width:95%;"><?php echo str_replace( array( "\r", "\n", "\t" ), '', $favicon_base64 ); ?></textarea><?php
	} ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'OpenID Meta Links', 'exops' ) ?></h3>
		<p><?php _e( '<a href="http://openid.net/" title="OpenID" rel="external">OpenID</a> is an easy way to use a single digital identity, available from services like <a href="http://claimid.com/" title="ClaimID is the free, easy way
to manage your online identity">ClaimID</a> or <a href="https://pip.verisignlabs.com/" title="Verisign Personal Information Provider">Verisign <abbr title="Personal Information Provider">PIP</abbr></a>.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'OpenID Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_openid_link"><?php _e( 'OpenID', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'OpenID Meta Links', 'exops' ) ?></legend>
						<select name="meta_openid_link" id="meta_openid_link">
							<option value="0"<?php if ( get_option('exop_meta_openid_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_openid_link') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_openid_server_uri"><?php _e( 'Server <abbr title="Uniform Resource Identifier">URI</abbr>', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'OpenID Server URI', 'exops' ) ?></legend>
						<input id="meta_openid_server_uri" name="meta_openid_server_uri" type="text" value="<?php echo attribute_escape(get_option('exop_meta_openid_server_uri')); ?>" class="code" size="40" /><br />
						<?php _e( 'Also refered to as the provider <abbr title="Uniform Resource Identifier">URI</abbr>.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_openid_delegate_uri"><?php _e( 'Delegate <abbr title="Uniform Resource Identifier">URI</abbr>', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'OpenID Delegate URI', 'exops' ) ?></legend>
						<input id="meta_openid_delegate_uri" name="meta_openid_delegate_uri" type="text" value="<?php echo attribute_escape(get_option('exop_meta_openid_delegate_uri')); ?>" class="code" size="40" /><br />
						<?php _e( 'Also refered to as the local ID <abbr title="Uniform Resource Identifier">URI</abbr>.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_openid_yadis_uri"><?php _e( 'Yadis/<abbr title="eXtensible Resource Descriptor Sequence">XRDS</abbr> <abbr title="Uniform Resource Identifier">URI</abbr>', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'OpenID Yadis/XRDS URI', 'exops' ) ?></legend>
						<input id="meta_openid_yadis_uri" name="meta_openid_yadis_uri" type="text" value="<?php echo attribute_escape(get_option('exop_meta_openid_yadis_uri')); ?>" class="code" size="40" /><br />
						<?php _e( 'Necessary for Yadis/<abbr title="Extensible Resource Identifier">XRI</abbr> discovery (optional).', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'MicroID Meta Link', 'exops' ) ?></h3>
		<p><?php _e( '<a href="http://microid.org/" title="MicroID">MicroID</a> is a lightweight identity for the Web, enabling anyone to claim verifiable ownership of content on the Web.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'MicroID Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_microid_link"><?php _e( 'MicroID', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'MicroID Meta Link', 'exops' ) ?></legend>
						<select name="meta_microid_link" id="meta_microid_link">
							<option value="0"<?php if ( get_option('exop_meta_microid_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_microid_link') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_microid_identity_uri"><?php _e( 'MicroID <abbr title="Uniform Resource Identifier">URI</abbr>', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'MicroID Identity URI', 'exops' ) ?></legend>
						<code>mailto:</code><input id="meta_microid_identity_uri" name="meta_microid_identity_uri" type="text" value="<?php echo attribute_escape(get_option('exop_meta_microid_identity_uri')); ?>" class="code" size="33" /><br />
						<?php _e( 'Your MicroID is a combination of this blog\'s <abbr title="Uniform Resource Identifier">URI</abbr> and this e-mail address.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'Geo Tag Meta Links', 'exops' ) ?></h3>
		<p><?php _e( 'Geotagging adds geographical identification information to your blog.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'Geo Tag Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_geotags"><?php _e( 'Geo Tags', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Geo Tag Meta Links', 'exops' ) ?></legend>
						<select name="meta_geotags" id="meta_geotags">
							<option value="0"<?php if ( get_option('exop_meta_geotags') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_geotags') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'If enabled, geo meta tags will only be generated for data as provided below, i.e., the following fields are optional.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_geotags"><?php _e( 'Region', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Geo Tag Region Code', 'exops' ) ?></legend>
						<label for="meta_geotags_country"><?php _e( 'Country code:', 'exops' ) ?></label><input id="meta_geotags_country" name="meta_geotags_country" type="text" value="<?php echo attribute_escape(get_option('exop_meta_geotags_country')); ?>" size="5" maxlength="4" />
						<label for="meta_geotags_region"><?php _e( 'Region code:', 'exops' ) ?></label><input id="meta_geotags_region" name="meta_geotags_region" type="text" value="<?php echo attribute_escape(get_option('exop_meta_geotags_region')); ?>" size="5" maxlength="4" /><br />
						<?php _e( 'Your country subdivision code, <a href="http://geotags.com/iso3166/countries.html">available here</a>.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_geotags_placename"><?php _e( 'Placename', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Geo Tag Placename', 'exops' ) ?></legend>
						<input id="meta_geotags_placename" name="meta_geotags_placename" type="text" value="<?php echo attribute_escape(get_option('exop_meta_geotags_placename')); ?>" size="40" /><br />
						<?php _e( 'Usually your city/place name, <a href="http://www.getty.edu/research/conducting_research/vocabularies/tgn/">available here</a>.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_geotags_latitude"><?php _e( 'Latitude', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Geo Tag Latitude', 'exops' ) ?></legend>
						<input id="meta_geotags_latitude" name="meta_geotags_latitude" type="text" value="<?php echo attribute_escape(get_option('exop_meta_geotags_latitude')); ?>" size="40" /><br />
						<?php _e( 'Latitude is given in degrees of arc relative to the Equator.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="meta_geotags_longitude"><?php _e( 'Longitude', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Geo Tag Longitude', 'exops' ) ?></legend>
						<input id="meta_geotags_longitude" name="meta_geotags_longitude" type="text" value="<?php echo attribute_escape(get_option('exop_meta_geotags_longitude')); ?>" size="40" /><br />
						<?php _e( 'Longitude is given in degrees of arc relative to the Greenwich Meridian.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'Robot Meta Links', 'exops' ) ?></h3>
		<p><?php _e( '<a href="http://www.robotstxt.org/meta.html">Robots meta</a> tell robots (spiders) not to index content of a page and/or not to follow links on a page. If an existing <code>robots.txt</code> allows access to a specific page with a restricting robots meta link, the robots meta link is used. A page without a robots meta link is the equivalent of <code>follow, index</code>.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'Robot Meta Links', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="robots_meta_404"><?php _e( '404 Results', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( '404 Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_404" id="robots_meta_404">
							<option value="0"<?php if ( get_option('exop_robots_meta_404') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_404') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_404') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_404') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_author"><?php _e( 'Author Archives', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Author Archives Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_author" id="robots_meta_author">
							<option value="0"<?php if ( get_option('exop_robots_meta_author') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_author') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_author') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_author') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_cats"><?php _e( 'Category Archives', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Category Archives Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_cats" id="robots_meta_cats">
							<option value="0"<?php if ( get_option('exop_robots_meta_cats') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_cats') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_cats') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_cats') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_date"><?php _e( 'Dated Archives', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Date Archives Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_date" id="robots_meta_date">
							<option value="0"<?php if ( get_option('exop_robots_meta_date') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_date') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_date') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_date') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_search"><?php _e( 'Search Results', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Search Results Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_search" id="robots_meta_search">
							<option value="0"<?php if ( get_option('exop_robots_meta_search') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_search') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_search') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_search') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_tags"><?php _e( 'Tag Archives', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Tag Archives Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_tags" id="robots_meta_tags">
							<option value="0"<?php if ( get_option('exop_robots_meta_tags') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_tags') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_tags') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_tags') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_wpadmin"><?php _e( 'Admin Dashboard', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'WordPress Dashboard Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_wpadmin" id="robots_meta_wpadmin">
							<option value="0"<?php if ( get_option('exop_robots_meta_wpadmin') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_wpadmin') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_wpadmin') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_wpadmin') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="robots_meta_wplogin"><?php _e( 'Admin Login &amp; Registration', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'WordPress Login and Registration Robots Meta Link', 'exops' ) ?></legend>
						<select name="robots_meta_wplogin" id="robots_meta_wplogin">
							<option value="0"<?php if ( get_option('exop_robots_meta_wplogin') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_robots_meta_wplogin') == 1 ) echo $selected; ?>> <?php _e( 'index, nofollow', 'exops' ) ?> </option>
							<option value="2"<?php if ( get_option('exop_robots_meta_wplogin') == 2 ) echo $selected; ?>> <?php _e( 'noindex, follow', 'exops' ) ?> </option>
							<option value="3"<?php if ( get_option('exop_robots_meta_wplogin') == 3 ) echo $selected; ?>> <?php _e( 'noindex, nofollow', 'exops' ) ?> </option>
						</select>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'Tweak Options', 'exops' ) ?></h3>
		<p><?php _e( 'These are adjustments that can be made to core WordPress settings, which will alter certain functions of WordPress. None of these can damage your WordPress installation.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'Tweak Options', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="tweak_301_author"><?php _e( 'Redirect Author Archives', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Redirect (301) Author Archives', 'exops' ) ?></legend>
						<select name="tweak_301_author" id="tweak_301_author">
							<option value="0"<?php if ( get_option('exop_tweak_301_author') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_301_author') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'Enabling sends 301 (moved permanently) headers when a page archive is loaded and redirect to the home page.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_404_headers"><?php _e( 'Send 404 Headers', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Send Not Found (404) Headers', 'exops' ) ?></legend>
						<select name="tweak_404_headers" id="tweak_404_headers">
							<option value="0"<?php if ( get_option('exop_tweak_404_headers') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_404_headers') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'Enabling sends 404 (not found) headers when a 404 error occurs, e.g., when the theme file <code>404.php</code> is used.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_www"><?php _e( 'Enforce <code>www.</code> Preference', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Enforce URL as in Blog Settings', 'exops' ) ?></legend>
						<select name="tweak_www" id="tweak_www">
							<option value="0"<?php if ( get_option('exop_tweak_www') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_www') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'Enabling enforces the blog <abbr title="Uniform Resource Locator">URL</abbr> as in your settings. If it does not include <code>www.</code>, then the <code>www.</code> <abbr title="Uniform Resource Locator">URL</abbr> will redirect to your set blog URL.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_atom_api_link"><?php _e( 'Atom <abbr title="Application Program Interface">API</abbr> Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Atom API Meta Link', 'exops' ) ?></legend>
						<select name="tweak_atom_api_link" id="tweak_atom_api_link">
							<option value="0"<?php if ( get_option('exop_tweak_atom_api_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_atom_api_link') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php printf( __( 'Enabling inserts the discovery link for the Atom <abbr title="Application Program Interface">API</abbr> publishing protocol. You also have to enable this <abbr title="Application Program Interface">API</abbr> in the <a href="%s">Writing</a> section.', 'exops' ),
							get_bloginfo('wpurl') . '/wp-admin/options-writing.php' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_rsd_link"><?php _e( '<abbr title="Really Simple Discoverability">RSD</abbr> Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'RSD Meta Link', 'exops' ) ?></legend>
						<select name="tweak_rsd_link" id="tweak_rsd_link">
							<option value="0"<?php if ( get_option('exop_tweak_rsd_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_rsd_link') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php printf( __( 'Enabling inserts the discovery link for the <abbr title="Really Simple Discoverability">RSD</abbr> <abbr title="XML-RPC">XML-RPC</abbr> protocol. You also have to enable <abbr title="XML-RPC">XML-RPC</abbr> access in the <a href="%s">Writing</a> section.', 'exops' ),
							get_bloginfo('wpurl') . '/wp-admin/options-writing.php' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_wlw_link"><?php _e( '<abbr title="Windows Live Writer">WLW</abbr> Manifest Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Windows Live Writer Meta Link', 'exops' ) ?></legend>
						<select name="tweak_wlw_link" id="tweak_wlw_link">
							<option value="0"<?php if ( get_option('exop_tweak_wlw_link') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_wlw_link') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php printf( __( 'Enabling inserts the discovery link for the Windows Live Writer publishing protocol. You also have to enable <abbr title="XML-RPC">XML-RPC</abbr> access in the <a href="%s">Writing</a> section.', 'exops' ),
							get_bloginfo('wpurl') . '/wp-admin/options-writing.php' ) ?>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tweak_generator"><?php _e( 'WordPress Generator Meta', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'WordPress Generator Meta Link', 'exops' ) ?></legend>
						<select name="tweak_generator" id="tweak_generator">
							<option value="0"<?php if ( get_option('exop_tweak_generator') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_tweak_generator') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select><br />
						<?php _e( 'Enabling inserts a WordPress-generated meta link containing the current WordPress version number and is publicly viewable.', 'exops' ) ?>
					</fieldset>
				</td>
			</tr>
		</table>
		<h3><?php _e( 'Content Add-In Options', 'exops' ) ?></h3>
		<p><?php _e( 'You may enable this to add content via hooks found in (properly developed) themes.', 'exops' ) ?></p>
		<table class="form-table" summary="<?php _e( 'Content Add-In Options', 'exops' ) ?>">
			<tr valign="top">
				<th scope="row"><label for="meta_addin"><?php _e( 'Meta Add-In', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Meta Add-In Content', 'exops' ) ?></legend>
						<select name="meta_addin" id="meta_addin">
							<option value="0"<?php if ( get_option('exop_meta_addin') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_meta_addin') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
						<p><label for="meta_addin_content"><?php _e( 'Meta add-in is inserted via <code>wp_head()</code> in <code>header.php</code>.', 'exops' ) ?></label></p>
						<textarea name="meta_addin_content" id="meta_addin_content" cols="50" rows="8" class="code" style="font-size:12px;width:95%;"><?php echo format_to_edit(get_option('exop_meta_addin_content')); ?></textarea>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="comment_addin"><?php _e( 'Comments Add-In', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Comments Add-In Content', 'exops' ) ?></legend>
						<select name="comment_addin" id="comment_addin">
							<option value="0"<?php if ( get_option('exop_comment_addin') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_comment_addin') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
						<p><label for="comment_addin_content"><?php _e( 'Comment add-in is inserted via <code>do_action(\'comment_form\')</code> in <code>comments.php</code>.', 'exops' ) ?></label></p>
						<textarea name="comment_addin_content" id="comment_addin_content" cols="50" rows="8" class="code" style="font-size:12px;width:95%;"><?php echo format_to_edit(get_option('exop_comment_addin_content')); ?></textarea>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="footer_addin"><?php _e( 'Footer Add-In', 'exops' ) ?></label></th>
				<td>
					<fieldset>
						<legend class="hidden"><?php _e( 'Footer Add-In Content', 'exops' ) ?></legend>
						<select name="footer_addin" id="footer_addin">
							<option value="0"<?php if ( get_option('exop_footer_addin') == 0 ) echo $selected; ?>> <?php _e( 'Disabled', 'exops' ) ?> </option>
							<option value="1"<?php if ( get_option('exop_footer_addin') == 1 ) echo $selected; ?>> <?php _e( 'Enabled', 'exops' ) ?> </option>
						</select>
						<p><label for="footer_addin_content"><?php _e( 'Footer add-in is inserted via <code>wp_footer()</code> in <code>footer.php</code>.', 'exops' ) ?></label></p>
						<textarea name="footer_addin_content" id="footer_addin_content" cols="50" rows="8" class="code" style="font-size:12px;width:95%;"><?php echo format_to_edit(get_option('exop_footer_addin_content')); ?></textarea>
					</fieldset>
				</td>
			</tr>
		</table>
		<p class="submit">
			<!-- You can use the access key S to save options -->
			<input id="update" name="update" type="submit" value="<?php _e( 'Save Changes', 'exops' ) ?>" accesskey="S" />
			<input name="action" type="hidden" value="update" />
			<input name="page_options" type="hidden" value="comment_addin,comment_addin_content,footer_addin,footer_addin_content,meta_addin,meta_addin_contentmeta_archive_count,meta_archive_links,meta_archive_type,meta_favicon_base64,meta_favicon_link,meta_geotags,meta_geotags_country,meta_geotags_latitude,meta_geotags_longitude,meta_geotags_placename,meta_geotags_region,meta_microid_identity_uri,meta_microid_link,meta_openid_delegate_uri,meta_openid_link,meta_openid_server_uri,meta_openid_yadis_uri,meta_relationship_links,robots_meta_404,robots_meta_author,robots_meta_cats,robots_meta_date,robots_meta_search,robots_meta_tags,robots_meta_wpadmin,robots_meta_wplogin,tweak_301_author,tweak_404_headers,tweak_admin_favicon,tweak_admin_favicon_base64,tweak_atom_api_link,tweak_generator,tweak_rsd_link,tweak_wlw_link,tweak_www" />
		</p>
	</form>
</div>