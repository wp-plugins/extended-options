=== Extended Options ===
CONTRIBUTORS: plaintxt.org
DONATE LINK: http://www.plaintxt.org/about/#donate
TAGS: archive meta, atom, discovery meta, generator, geo tags, microid, openid, persistence, themes, header.php, footer.php, comments.php, relationship meta, robots, rsd, wlw, www, xrds, yardis
REQUIRES AT LEAST: 2.5
TESTED UP TO: 2.6.3
STABLE TAG: 0.1.2

Extended Options keeps meta data and certain WordPress tweaks persistent regardless of the active theme without editing any theme files.

== Description ==

Extended Options manages certain meta data and content add-ins from within the WordPress dashboard. This plugin adds the capacity for meta data and content added to the footer and `head` areas to be kept consistent regardless of a theme change or upgrade.

Extended Options is for WordPress 2.6.x and, more specifically, manages following meta links and tweaks:

* Archive meta links
* Relationship meta links
* Favicon meta links (blog and dashboard)
* OpenID meta links
* MicroID meta links
* Geo tag meta links
* Robots meta links
* Enabling/disabling author archives
* Enabling/disabling 404 headers
* Enforcing `www.` preference
* Protocol discovery meta links (Atom, RSD, WLW)
* Enabling/disabled generator meta link
* General meta add-in content
* General comment form add-in content
* General footer add-in content

While this collection of meta data and tweaks appear random, these are specific modifications I grew tired of making whenever I activated a different theme or upgraded an old one. I needed a plugin to manage these needs that didn't overlap significantly with other plugins I used.

Special thanks to some awesome code integrated (and possibly modified) with Extended Options.

* [Comment License](http://alexking.org/blog/2008/03/30/comment-license-12 "Comment License 1.2") by Alex King
* [Enforce www Preference](http://wordpress.org/extend/plugins/enforce-www-preference/ "Enforce www preference plugin") by Mark Jaquith

Thanks to those fellows for providing excellent plugins to the community.

== Installation ==

This plugin is installed just like any other WordPress plugin. More [detailed installation instructions](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "Installing Plugins - WordPress Codex") are available on the WordPress Codex.

1. Download Extended Options
2. Extract the `/extended-options/` folder from the archive
3. Upload this folder to `../wp-contents/plugins/`
4. Activate the plugin in *Dashboard > Plugins*
5. Customize from the *Settings > Extended* options menu
7. Enjoy. And then consider donating

In other words, just upload the `/extended-options/` folder and its contents to your plugins folder.

== Use ==

Access the Extended Options menu from *Dashboard > Settings > Extended* to set the plugin options. To use this plugin, you do not need to edit any theme files or WordPress core files.

Everything this plugin does happens based on settings in the *Extended* menu. Extended Options does require, however, the following hooks/actions to be present in the certain files of your active theme.

* `wp_head()` should be present in your `header.php` theme file.
* `wp_footer()` should be present in your `footer.php` theme file.
* `do_action( 'comment_form', $post->ID )` should be present in your `comments.php` theme file.

If your theme files are missing these, please contact the theme author and ask him or her nicely to correct these omissions.

== License ==

Extended Options, a plugin for WordPress, (C) 2008 by Scott Allan Wallick, is licensed under the [GNU General Public License](http://www.gnu.org/licenses/gpl.html "GNU General Public License").

Extended Options is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Extended Options is distributed in the hope that it will be useful, but **without any warranty**; without even the implied warranty of **merchantability** or **fitness for a particular purpose**. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Extended Options. If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/ "GNU General Public Licenses").

== Frequently Asked Questions ==

= What does this plugin do? =

Extended Options keeps meta data and certain WordPress functionality tweaks consistent regardless of the active theme. In other words, you no longer need to edit the `header.php` file each time you change or upgrade your theme. Extended Options uses built-in WordPress functions to keep this information consistent regardless or your active theme.

Extended Options also 'tweaks' certain default WordPress behaviors, such as inserting the WordPress generator link, producing, allowing/disallowing the `www.` prefix in your URL, turning off author archives (i.e., if you have a single-author blog), automatically inserting certain discovery links for various protocols, etc.

= That's great. But I also have to edit the footer.php files for each of my themes. Can extended options also help me with my footer? =

Yes. You can insert your copyright, disclaimer, etc., regardless of your theme's `footer.php` file automatically with Extended Options.

= Nice. What about the comment form? I usually put a comment license there. =

Yes, you can add your comment license with Extended Options regardless of your theme's `comments.php` theme file.

= And I don't have to edit any of the theme files? Because that's tedious stuff. =

No. Well, probably not. See the *Use* section. A well-built theme will include the various hooks/actions necessary for Extended Options to operate properly. If your theme doesn't include this, consider better themes and/or contact the theme author to correct these omissions.

= I will. By the way, I'm using one of your themes. Will they work with this plugin? =

Damn right they will. And thanks for using a [plaintxt.org theme](http://www.plaintxt.org/themes/ "Themes for WordPress by plaintxt.org").

= I deactivated and then reactivated this plugin. Where did my settings go? =

They were deleted for ever and ever and ever. Upon deactivating, this plugins deletes all its stored data from your WordPress database. Tidy? Yes. A surprise just now? Definitely.

= I am confused by MicroID/OpenID/Geo Tags/favicons/robots/etc. Will you explain what they do? =

No. Links have been provided in the *Extended* options menu to sources that provide better information than I can. Nothing this plugin does can harm your blog in any way.

= I have an OpenID and know my server and delegate URIs. What's this stuff about a Yadis/XRDS URI? =

Didn't I just mention something about explaining? Sigh. This is a discovery link for second version of the OpenID protocol. You don't need to supply this URI unless you know it. This particular meta link is optional even if OpenID is enabled.

= I already have a robots.txt file. Do I need to set robots meta links? =

Probably not, unless your robots text file doesn't specify search results and/or 404 pages (which it probably won't). So those are two good options to enable even if you have a `robots.txt` file.

= What happens if my robots.txt says it's OK to visit a particular page, but then my robots meta link setting produces a nollow and/or noindex meta link? =

The page will not be indexed.

= And what about if my robots.txt prohibits a robot/spider from visiting a page I say it can follow links and/or index? =

The page will not be indexed.

= I want to put my favicon(s) in different location(s) than those available in the Extended Options menu. Can I? =

Yes. But you'll need to add your own meta link and disable this option in the *Extended* options menu.

= That's lame. =

Yes. Except you probably shouldn't keep your favicon any where else other than your root directory. And plus you can just use a base 64 encoded string for a favicon too.

= That's fun. =

Yes, it is.

= After I enter some HTML code in to the the meta/comment/footer add-in fields and save, my HTML gets stripped out. What gives? =

The user account you are logged in to while saving this code must have a user level that allows saving unfiltered HTML, i.e., administrator level. Otherwise, your code gets sanitized for security. If you can add HTML to a text widget, then you should be able to add code to these add-ins.

= What about the various protocol (Atom, RSD, WLM) meta links? What happens if I disabled them all? =

Nothing, except you won't be able to use third-party blog clients to post to your blog. And that's about it. These discovery links won't affect your visibility.

= Oh. So I should probably just disable those, right? =

Yes, you should.

= I'd like to modify this plugin in some way unavailable through its options menu. Will you help me? =

No. I apologize as I am unable to help with modifications with any of my plugins.

= Thanks. =

You're very welcome.

== Screenshots ==

1. Extended Options provides a new menu, Extended under Settings, where you can set the many functions of this plugin.