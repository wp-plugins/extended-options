<?php
/*
PLUGIN NAME: Extended Options
PLUGIN URI: http://www.plaintxt.org/experiments/extended-options/
DESCRIPTION: Extended Options keeps meta data and certain WordPress tweaks consistent regardless of the active theme without editing any theme files. A plaintxt.org experiment for WordPress.
AUTHOR: Scott Allan Wallick
AUTHOR URI: http://scottwallick.com/
VERSION: 0.1.1 &beta;
*/

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

// Have we enabled meta relationship links?
if ( get_option('exop_meta_relationship_links') > 0 ) {
	// Our function to create relationship meta links
	function exop_meta_relationship_links() {
		// We'll need post data outside of the loop.
		global $post, $wpdb;
		// We can specify the TYPE attribute for the LINK, so let's
		$html = get_bloginfo('html_type');
		// If we're not on the front page
		if ( !is_front_page() ) {
			echo "\t" . '<link rel="start" type="' . $html . '" href="' . get_bloginfo('url') . '/" title="' . wp_specialchars( strip_tags(str_replace( '"', '', get_bloginfo('name') )), 1 ) . '" />' . "\n";
		}
		// Query our oldest, the 'first', post from the database
		$first = @$wpdb->get_row("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC LIMIT 1");
		// If we have a first post
		if ( $first ) {
			echo "\t" . '<link rel="first" type="' . $html . '" href="' . get_permalink($first->ID) . '" title="' . wp_specialchars( strip_tags(str_replace( '"', '', $first->post_title )), 1 ) .  '" />' . "\n";
		}
		// Query our most recent, the 'last', post from the database
		$last = @$wpdb->get_row("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date DESC LIMIT 1");
		// If we have a last post
		if ( $last ) {
			echo "\t" . '<link rel="last" type="' . $html . '" href="' . get_permalink($last->ID) . '" title="' . wp_specialchars( strip_tags(str_replace( '"', '', $last->post_title )), 1 ) . '" />' . "\n";
		}
		// If a single post, we can make prev/next meta relationship links
		if ( is_single() ) {
			// Again, we'll need post data outside the loop
			global $wpdb, $wp_query;
			// Query the post at hand
			$post = $wp_query->post;
			// If we have DB errors, just ignore for now
			$wpdb->hide_errors();
			// We can use a WordPress function to get the previous post
			$prev = get_previous_post();
			// If we have a previous post
			if ( $prev ) {
				echo "\t" . '<link rel="prev" type="' . $html . '" href="' . get_permalink($previous->ID) . '" title="' . wp_specialchars( strip_tags(str_replace( '"', '', $prev->post_title )), 1 ) . '" />' . "\n";
			}
			// We can use a WordPress function to get the next post
			$next = get_next_post();
			// If we have a next post
			if ( $next ) {
				echo "\t" . '<link rel="next" type="' . $html . '" href="' . get_permalink($next->ID) . '" title="' . wp_specialchars( strip_tags(str_replace( '"', '', $next->post_title )), 1 ) . '" />' . "\n";
			}
			// Now we can show any errors, now we're done
			$wpdb->show_errors();
		}
		// For child pages, we can make a LINK with rel="parent"
		if ( is_single() || is_page() ) {
			// Query stuff.
			global $wp_query;
			// Get the post at hand.
			$post = $wp_query->post;
			// If the post/page has a parent page, make its meta LINK
			if ( $post->post_parent ) {
				echo "\t" . '<link rel="parent" type="' . $html . '" href="' . get_permalink($post->post_parent) . '" title="' . wp_specialchars( get_the_title($post->post_parent), 1 ) . '" />' . "\n";
			}
			// For attachment pages, let's make links for accompanying attachments
			if ( is_attachment() ) {
				// We're using a function mostly taken from media.php, line 338
				function exops_attachment_meta_link( $prev = true ) {
					global $post;
					// We can specify the TYPE attribute for the LINK, so let's
					$html = get_bloginfo('html_type');
					// Let's get the attachment (post) info
					$post = get_post($post);
					// Let's query to find if this attachment has any friends
					$attachments = array_values(get_children(array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' )));
					// For any attachments we find that doesn't match the ID, stop
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID ) {
							break;
						}
					}
					// Offsets for the prev/next post
					$k = $prev ? $k - 1 : $k + 1;
					// If we have attachment info to put in to a LINK
					if ( isset($attachments[$k]) ) {
						// We'll specify whether this is the prev/next
						if ( $prev ) {
							$rel = 'prev';
						} else {
							$rel = 'next';
						}
						// Our meta relationship LINK(s)
						echo "\t" . '<link rel="' . $rel . '" type="' . $html . '" href="' . get_attachment_link($attachments[$k]->ID) . '" title="' . wp_specialchars( strip_tags(str_replace( '"', '', $attachments[$k]->post_title )), 1 ) . '" />' . "\n";
					}
				}
				// Runs our functions to produce the links. Not ideal, but it works.
				exops_attachment_meta_link(false); // Ugh.
				exops_attachment_meta_link(true); // Sigh.
			}
			// Return our 'loop' to where it was
			wp_reset_query();
		}
	}
	// Add our meta relationship function to wp_head()
	add_action( 'wp_head', 'exop_meta_relationship_links' );
}
// Have we enabled meta archive links?
if ( get_option('exop_meta_archives') > 0 ) {
	// Let's create a function to make the links
	function exop_meta_archives_links() {
		// Variable for the number of archive links
		$n = attribute_escape(get_option('exop_meta_archives_count'));
		// Variable for the archive link type
		$t = get_option('exop_meta_archives_type');
		// We stored numerical data, so we have to correlate the data
		if ( $t == 1 ) {
			$t = 'postbypost';
		} elseif ( $t = 2 ) {
			$t = 'daily';
		} elseif ( $t = 3 ) {
			$t = 'weekly';
		} elseif ( $t = 4 ) {
			$t = 'monthly';
		} elseif ( $t = 5 ) {
			$t = 'yearly';
		}
		// Run the WordPress function with our variables
		wp_get_archives("type=$t&limit=$n&format=link");
	}
	// Add our meta archive function to wp_head()
	add_action( 'wp_head', 'exop_meta_archives_links' );
}
// Have we enabled a blog favicon link?
if ( get_option('exop_meta_favicon_link') > 0 ) {
	// Our blog favicon meta link-producing function
	function exop_meta_blog_favicon() {
		// Get our option as a variable for multiple use
		$opt = get_option('exop_meta_favicon_link');
		// If link points to root directory
		if ( $opt == 2 ) {
			$favicon_uri = get_bloginfo('url') . '/favicon.ico';
		// Otherwise, we're using a base 64 encoded string
		} elseif ( $opt == 1 ) {
			// If a base 64 value, we *must* clean out the extra whitespace
			$favicon_uri = 'data:application/octet-stream;base64,' . str_replace( array( "\r", "\n", "\t" ), '', attribute_escape(get_option('exop_meta_favicon_base64')) );
		}
		// Return the favicon meta link
		echo "\t" . '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon_uri . '" />' . "\n";
	}
	// Add our blog favicon meta link function to wp_head()
	add_action( 'wp_head', 'exop_meta_blog_favicon' );
}
// Have we enabled an admin favicon link?
if ( get_option('exop_tweak_admin_favicon') > 0 ) {
	// Our dashboard favicon meta link-producing function
	function exop_tweak_admin_favicon() {
		// Get the option as variable for multiple uses
		$opt   = get_option('exop_tweak_admin_favicon');
		$wpurl = get_bloginfo('wpurl');
		// Resolve our numeric options
		if ( $opt == 4 ) {
			$favicon_uri = $wpurl . '/wp-content/plugins/extended-options/icons/wp-org_favicon.ico';
		} elseif ( $opt == 3 ) {
			$favicon_uri = $wpurl . '/wp-content/plugins/extended-options/icons/wp-com_favicon.ico';
		} elseif ( $opt == 2 ) {
			$favicon_uri = $wpurl . '/wp-admin/favicon.ico';
		} elseif ( $opt == 1 ) {
			// If a base 64 value, we *must* clean out the extra whitespace
			$favicon_uri = 'data:application/octet-stream;base64,' . str_replace( array( "\r", "\n", "\t" ), '', attribute_escape(get_option('exop_tweak_admin_favicon_base64')) );
		}
		// Produces the meta link
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon_uri . '" />' . "\n";
	}
	// Add our dashboard favicon meta link function to admin_head()
	add_action( 'admin_head', 'exop_tweak_admin_favicon' );
}
// Have we enabled the Atom Introspection discovery link?
if ( get_option('exop_tweak_atom_api_link') > 0 ) {
	// Function to produce the Atom API meta link
	function exop_tweak_atom_api_link() {
		echo "\t" . '<link rel="introspection" type="application/atomserv+xml" href="' . get_bloginfo('wpurl') . '/wp-app.php" />' . "\n";
	}
	// Add our Atom API link to wp_head()
	add_action( 'wp_head', 'exop_tweak_atom_api_link' );
}
// Have we enabled OpenID meta links?
if ( get_option('exop_meta_openid_link') > 0 ) {
	// Function to produce our two/three OpenID meta links
	function exop_meta_openid() {
		echo "\t" . '<link rel="openid2.provider openid.server" href="' . attribute_escape(get_option('exop_meta_openid_server_uri')) . '" />' . "\n";
		echo "\t" . '<link rel="openid2.local_id openid.delegate" href="' . attribute_escape(get_option('exop_meta_openid_delegate_uri')) . '" />' . "\n";
		// Get variable for multiple (potential) uses
		$yadisuri = attribute_escape(get_option('exop_meta_openid_yadis_uri'));
		// If the user has provided a Yadis URI, create its meta link
		if ( $yadisuri ) {
			echo "\t" . '<meta http-equiv="X-XRDS-Location" content="' . $yadisuri . '" />' . "\n";
		}
	}
	// Add our OpenID meta links to wp_head()
	add_action( 'wp_head', 'exop_meta_openid' );
}
// Have we enabled a MicroID meta link?
if ( get_option('exop_meta_microid_link') > 0 ) {
	// Function to create and produce the MicroID meta link
	function exop_meta_microid() {
		// Get the identity, i.e., email, URI from the plugin options
		$identity_uri = trim(get_option('exop_meta_microid_identity_uri'));
		// Our service URI is the blog URI, so we'll get it and keep it tidy
		$service_uri  = trim(get_bloginfo('url'));
		// Create the MicroID using SHA1 hash. If you don't have SHA1 on your server, enabling this function will crash your plugin. Oops! That's why we aren't saving options as variables. Heh.
		$microid = sha1(sha1("mailto:$identity_uri") . sha1("$service_uri/"));
		// Print our MicroID meta link
		echo "\t" . '<meta name="microid" content="mailto+http:sha1:' . $microid . '" />' . "\n";
	}
	// Add our MicroID meta link to wp_head()
	add_action( 'wp_head', 'exop_meta_microid' );
}
// Have we enabled Geo meta tags?
if ( get_option('exop_meta_geotags') > 0 ) {
	// Function to produce each, if applicable, geo tag
	function exop_meta_geotags() {
		// We'll make variables out of the options so we only create the meta link if the user has saved data for each
		$country   = attribute_escape(get_option('exop_meta_geotags_country'));
		$region    = attribute_escape(get_option('exop_meta_geotags_region'));
		$placename = attribute_escape(get_option('exop_meta_geotags_placename'));
		$latitude  = attribute_escape(get_option('exop_meta_geotags_latitude'));
		$longitude = attribute_escape(get_option('exop_meta_geotags_longitude'));
		// Do we have the two-letter country *and* region codes?
		if ( $country && $region ) {
			echo "\t" . '<meta name="geo.region" content="' . $country . '-' . $region . '" />' . "\n";
		}
		// Do we have a placename?
		if ( $placename ) {
			echo "\t" . '<meta name="geo.placename" content="' . $placename . '" />' . "\n";
		}
		// Do we have both a latitude and longitude to use?
		if ( $latitude && $longitude ) {
			echo "\t" . '<meta name="geo.position" content="' . $latitude . ';' . $longitude . '" />' . "\n";
			echo "\t" . '<meta name="icbm" content="' . $latitude . ', ' . $longitude . '" />' . "\n";
		}
	}
	// Add our geo tags to wp_head()
	add_action( 'wp_head', 'exop_meta_geotags' );
}
// Now our robots meta-building function
function exop_robots_meta() {
	// If author archive, check that option to see if enabled
	if ( is_author() ) {
		$robots = get_option('exop_robots_meta_author');
	// If category archive, check that option to see if enabled
	} elseif ( is_category() ) {
		$robots = get_option('exop_robots_meta_cats');
	// If date-based archive, check that option to see if enabled
	} elseif ( is_date() ) {
		$robots = get_option('exop_robots_meta_date');
	// If search results page, check that option to see if enabled
	} elseif ( is_search() ) {
		$robots = get_option('exop_robots_meta_search');
	// If tag archive, check that option to see if enabled
	} elseif ( is_tag() ) {
		$robots = get_option('exop_robots_meta_tags');
	}
	// We saved numerical values for robots settings. We must resolve those.
	if ( $robots > 0 ) {
		if ( $robots == 1 ) {
			$robots = 'index,nofollow';
		} elseif ( $robots == 2 ) {
			$robots ='noindex,follow';
		} elseif ( $robots == 3 ) {
			$robots ='noindex,nofollow';
		}
		// Having no robots meta is equal to index, follow
		echo "\t" . '<meta name="robots" content="' . attribute_escape($robots) . '" />' . "\n";
	}
}
// Add our robots meta function to wp_head()
add_action( 'wp_head', 'exop_robots_meta' );
// Now we'll make a function for WordPress Dashboard robots meta link
function exop_robots_meta_wpadmin() {
	// We saved numerical values for robots settings. We must resolve those.
	$robots = get_option('exop_robots_meta_wpadmin');
	if ( $robots > 0 ) {
		if ( $robots == 1 ) {
			$robots = 'index,nofollow';
		} elseif ( $robots == 2 ) {
			$robots ='noindex,follow';
		} elseif ( $robots == 3 ) {
			$robots ='noindex,nofollow';
		}
		// Having no robots meta is equal to index, follow
		echo '<meta name="robots" content="' . attribute_escape($robots) . '" />' . "\n";
	}
}
// Add our robots meta function to admin_head()
add_action( 'admin_head', 'exop_robots_meta_wpadmin' );
// Now we'll make a function for WordPress login and registration pages robots meta link
function exop_robots_meta_wplogin() {
	// We saved numerical values for robots settings. We must resolve those.
	$robots = get_option('exop_robots_meta_wplogin');
	if ( $robots > 0 ) {
		if ( $robots == 1 ) {
			$robots = 'index,nofollow';
		} elseif ( $robots == 2 ) {
			$robots ='noindex,follow';
		} elseif ( $robots == 3 ) {
			$robots ='noindex,nofollow';
		}
		// Having no robots meta is equal to index, follow
		echo '<meta name="robots" content="' . attribute_escape($robots) . '" />' . "\n";
	}
}
// Add our robots meta function to login_head()
add_action( 'login_head', 'exop_robots_meta_wplogin' );
// Have we enabled redirecting author archives?
if ( get_option('exop_tweak_301_author') > 0 ) {
	// Function to redirect all author archives to the front page
	function exop_tweak_301_author() {
		// We have to check the query to know is_author()
		global $wp_query;
		if ( $wp_query->is_author ) {
			// We'll use the WP function to redirect to our blog URL, sending a 301 (moved permanently) header
			wp_redirect( get_bloginfo('url'), 301 );
			// And we're done.
			exit;
		}
		// We have to clear our global $wp_query
		wp_reset_query();
	}
	// Add our headers to wp(), which loads first
	add_action( 'wp', 'exop_tweak_301_author' );
}
// Have we enabled sending 404 headers?
if ( get_option('exop_tweak_404_headers') > 0 ) {
	// If we have, and if this is a 404 result
	function exop_tweak_404_headers() {
		if ( is_404() ) {
			// Then send 404/Not Found headers to the user agent
			header( 'HTTP/1.1 404 Not Found' );
		}
	}
	// Add our headers to wp(), which loads first
	add_action( 'wp', 'exop_tweak_404_headers' );
}
// Have we enabled enforcing the exact URL in our blog settings, either with or without 'www.'?
if ( get_option('exop_tweak_www') > 0 ) {
	// **NOTE** Thanks to MARK JAQUITH for the following code,
	// **NOTE** from ENFORCE WWW PREFERENCE, http://wordpress.org/extend/plugins/enforce-www-preference/
	// If so, we're going to redirect the user agent
	if ( $_SERVER['REQUEST_URI'] == str_replace( 'http://' . $_SERVER['HTTP_HOST'], '', get_bloginfo('url') ) . '/index.php' ) {
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . get_bloginfo('url') . '/');
		exit();
	}
	if ( strpos( $_SERVER['HTTP_HOST'], 'www.' ) === 0  && strpos( get_bloginfo('url'), 'http://www.' ) === false ) {
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: http://' . substr( $_SERVER['HTTP_HOST'], 4 ) . $_SERVER['REQUEST_URI']);
		exit();
	} elseif ( strpos( $_SERVER['HTTP_HOST'], 'www.' ) !== 0 && strpos( get_bloginfo('url'), 'http://www.' ) === 0 ) {
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: http://www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
}
// Have we disabled the RSD discovery meta link?
if ( get_option('exop_tweak_rsd_link') < 1 ) {
	// If so, remove it from wp_head()
	remove_action( 'wp_head', 'rsd_link' );
}
// Have we disabled the WLW discovery meta link?
if ( get_option('exop_tweak_wlw_link') < 1 ) {
	// If so, remove it from wp_head()
	remove_action( 'wp_head', 'wlwmanifest_link' );
}
// Have we disabled the WordPress generator meta link?
if ( get_option('exop_tweak_generator') < 1 ) {
	// We'll create a function to return nothing to the generator function
	function exop_tweak_generator() {
		return null;
	}
	// Add our nothing-making function to the_generator filter
	add_filter( 'the_generator', 'exop_tweak_generator' );
}
// Have we enabled the META add in content?
if ( get_option('exop_meta_addin') > 0 ) {
	// Function to sanitize and secure our content
	function exop_meta_addin() {
		echo stripslashes(get_option('exop_meta_addin_content')) . "\n";
	}
	// Add our meta add in function to wp_head()
	add_action( 'wp_head', 'exop_meta_addin' );
}
// Have we enabled the comment content add in?
if ( get_option('exop_comment_addin') > 0 ) {
	// **NOTE** Thanks to ALEX KING for the following code,
	// **NOTE** from COMMENT LICENSE, http://alexking.org/blog/2008/03/30/comment-license-12
	// Function to sanitize and secure our content
	function exop_comment_addin() {
		echo "\n" . '<div class="comment-addin">' . "\n" . stripslashes(wp_filter_post_kses(get_option('exop_comment_addin_content'))) . "\n</div><!-- .comment-addin -->\n";
	}
	// Add our comment form add in content last (i.e., '99') to do_action('comment_form')
	add_action( 'comment_form', 'exop_comment_addin', 99 );
}
// Have we enabled footer add in content?
if ( get_option('exop_footer_addin') > 0 ) {
	// Function to sanitize and secure our content
	function exop_footer_addin() {
		echo "\n" . '<div class="footer-addin">' . "\n" . stripslashes(wp_filter_post_kses(get_option('exop_footer_addin_content'))) . "\n</div><!-- .footer-addin -->\n";
	}
	// Add our footer content to wp_footer()
	add_action( 'wp_footer', 'exop_footer_addin' );
}
// Adds plugin defaults when plugin is activated
function exop_activation() {
	add_option( 'exop_comment_addin', 0, '', 'yes' );
	add_option( 'exop_comment_addin_content', __( 'By submitting a comment, you hereby grant perpetual license to reproduce your words, name, and/or Web site in attribution.', 'exops' ), '', 'yes' );
	add_option( 'exop_footer_addin', 0, '', 'yes' );
	add_option( 'exop_footer_addin_content', '', '', 'yes' );
	add_option( 'exop_meta_addin', 0, '', 'yes' );
	add_option( 'exop_meta_addin_content', '', '', 'yes' );
	add_option( 'exop_meta_archives', 0, '', 'yes' );
	add_option( 'exop_meta_archives_count', 10, '', 'yes' );
	add_option( 'exop_meta_archives_type', 4, '', 'yes' );
	add_option( 'exop_meta_favicon_base64', '', '', 'yes' );
	add_option( 'exop_meta_favicon_link', 0, '', 'yes' );
	add_option( 'exop_meta_geotags', 0, '', 'yes' );
	add_option( 'exop_meta_geotags_country', '', '', 'yes' );
	add_option( 'exop_meta_geotags_latitude', '', '', 'yes' );
	add_option( 'exop_meta_geotags_longitude', '', '', 'yes' );
	add_option( 'exop_meta_geotags_placename', '', '', 'yes' );
	add_option( 'exop_meta_geotags_region', '', '', 'yes' );
	add_option( 'exop_meta_microid_identity_uri', '', '', 'yes' );
	add_option( 'exop_meta_microid_link', 0, '', 'yes' );
	add_option( 'exop_meta_openid_delegate_uri', '', '', 'yes' );
	add_option( 'exop_meta_openid_link', 0, '', 'yes' );
	add_option( 'exop_meta_openid_server_uri', '', '', 'yes' );
	add_option( 'exop_meta_openid_yadis_uri', '', '', 'yes' );
	add_option( 'exop_meta_relationship_links', 0, '', 'yes' );
	add_option( 'exop_robots_meta_404', 0, '', 'yes' );
	add_option( 'exop_robots_meta_author', 0, '', 'yes' );
	add_option( 'exop_robots_meta_cats', 0, '', 'yes' );
	add_option( 'exop_robots_meta_date', 0, '', 'yes' );
	add_option( 'exop_robots_meta_search', 0, '', 'yes' );
	add_option( 'exop_robots_meta_tags', 0, '', 'yes' );
	add_option( 'exop_robots_meta_wpadmin', 0, '', 'yes' );
	add_option( 'exop_robots_meta_wplogin', 0, '', 'yes' );
	add_option( 'exop_tweak_301_author', 0, '', 'yes' );
	add_option( 'exop_tweak_404_headers', 0, '', 'yes' );
	add_option( 'exop_tweak_admin_favicon', 0, '', 'yes' );
	add_option( 'exop_tweak_admin_favicon_base64', '', '', 'yes' );
	add_option( 'exop_tweak_atom_api_link', 0, '', 'yes' );
	add_option( 'exop_tweak_generator', 1, '', 'yes' );
	add_option( 'exop_tweak_rsd_link', 1, '', 'yes' );
	add_option( 'exop_tweak_wlw_link', 1, '', 'yes' );
	add_option( 'exop_tweak_www', 0, '', 'yes' );
}
// Deletes plugin settings when deactivated
function exop_deactivation() {
	delete_option('exop_comment_addin');
	delete_option('exop_comment_addin_content');
	delete_option('exop_footer_addin');
	delete_option('exop_footer_addin_content');
	delete_option('exop_meta_addin');
	delete_option('exop_meta_addin_content');
	delete_option('exop_meta_archives');
	delete_option('exop_meta_archives_count');
	delete_option('exop_meta_archives_type');
	delete_option('exop_meta_favicon_base64');
	delete_option('exop_meta_favicon_link');
	delete_option('exop_meta_geotags');
	delete_option('exop_meta_geotags_country');
	delete_option('exop_meta_geotags_latitude');
	delete_option('exop_meta_geotags_longitude');
	delete_option('exop_meta_geotags_placename');
	delete_option('exop_meta_geotags_region');
	delete_option('exop_meta_microid_identity_uri');
	delete_option('exop_meta_microid_link');
	delete_option('exop_meta_openid_delegate_uri');
	delete_option('exop_meta_openid_link');
	delete_option('exop_meta_openid_server_uri');
	delete_option('exop_meta_openid_yadis_uri');
	delete_option('exop_meta_relationship_links');
	delete_option('exop_robots_meta_404');
	delete_option('exop_robots_meta_author');
	delete_option('exop_robots_meta_cats');
	delete_option('exop_robots_meta_date');
	delete_option('exop_robots_meta_search');
	delete_option('exop_robots_meta_tags');
	delete_option('exop_robots_meta_wpadmin');
	delete_option('exop_robots_meta_wplogin');
	delete_option('exop_tweak_301_author');
	delete_option('exop_tweak_404_headers');
	delete_option('exop_tweak_admin_favicon');
	delete_option('exop_tweak_admin_favicon_base64');
	delete_option('exop_tweak_atom_api_link');
	delete_option('exop_tweak_generator');
	delete_option('exop_tweak_rsd_link');
	delete_option('exop_tweak_wlw_link');
	delete_option('exop_tweak_www');
}
// Function to add our theme options menu
function exop_initialize() {
	if ( function_exists('add_options_page') ) {
		add_options_page( __( 'Extended Options', 'exops' ), __( 'Extended', 'exops' ), 'manage_options', 'extended-options/exops-menu.php', '' );
	}
}
// Register the necessary hooks to keep things nice and tidy
register_activation_hook( __FILE__, 'exop_activation' );
register_deactivation_hook( __FILE__, 'exop_deactivation' );
// Allow localization, if applicable
load_plugin_textdomain('exops');
// Initialize our plugin function
add_action( 'admin_menu', 'exop_initialize' );
?>