<?php
/*
Plugin Name: Aceify
Plugin URI: http://acegoulet.com
Description: Admin interface for customizing wordpress admin to fit client needs.
Author: AceGoulet.com
Version: 1.2
Author URI: http://acegoulet.com
*/

// Define current version constant
define( 'aceify_version', '1.1' );

// Define plugin URL
$aceify_URL = 'admin.php?page=aceify';

// create custom plugin settings menu
add_action('admin_menu', 'aceify_plugin_menu');

function aceify_plugin_menu() {
	//create settings menu menu
	add_menu_page('Aceify', 'Aceify', 'administrator', 'aceify', 'aceify_settings');
	//call register settings function
	add_action( 'admin_init', 'register_aceify_settings' );
}

function register_aceify_settings() {
	//register our settings
	register_setting( 'aceify-settings-group', 'hide_editors_only' );
	register_setting( 'aceify-settings-group', 'aceify_hide_menus' );
	register_setting( 'aceify-settings-group', 'aceify_remove_tags' );
	register_setting( 'aceify-settings-group', 'aceify_disable_bar' );
	register_setting( 'aceify-settings-group', 'aceify_login_logo' );
	register_setting( 'aceify-settings-group', 'aceify_login_logo_height' );
	register_setting( 'aceify-settings-group', 'aceify_login_logo_bottom_margin' );
	register_setting( 'aceify-settings-group', 'aceify_login_custom_css' );
	register_setting( 'aceify-settings-group', 'aceify_featured_image' );
	register_setting( 'aceify-settings-group', 'aceify_emoji' );
	register_setting( 'aceify-settings-group', 'aceify_menus' );
}

//settings page
function aceify_settings() {
	global $aceify_URL;

?>
	<div class="wrap">
		<?php screen_icon( 'plugins' ); ?>
		<h2><?php _e('Aceify Your Admin', 'acify-plugin'); ?></h2>
		<p><?php _e('Plugin version', 'acify-plugin'); ?>: <?php echo aceify_version; ?><br />
		<?php _e('WordPress version', 'acify-plugin'); ?>: <?php echo get_bloginfo('version'); ?></p>
	</div>
	<div class="wrap">
		<form method="post" action="options.php">
			<?php settings_fields( 'aceify-settings-group' ); ?>
			<?php do_settings_sections( 'aceify-settings-group' ); ?>
			<?php 
				$hide_editors_only = get_option('hide_editors_only');
				$aceify_hide_menus = get_option('aceify_hide_menus');
				$aceify_remove_tags = get_option('aceify_remove_tags');
				$aceify_disable_bar = get_option('aceify_disable_bar');
				$aceify_login_logo = get_option('aceify_login_logo');
				$aceify_login_logo_height = get_option('aceify_login_logo_height');
				$aceify_login_logo_bottom_margin = get_option('aceify_login_logo_bottom_margin');
				$aceify_login_custom_css = get_option('aceify_login_custom_css');
				$aceify_emoji = get_option('aceify_emoji');
				$aceify_featured_image = get_option('aceify_featured_image');
				$aceify_menus = get_option('aceify_menus');
			?>
			<br />
			<h3>Hide Admin Menu Items</h3>
			<input type="checkbox" name="hide_editors_only" tabindex="1" id="editors-only-checkbox" value="true"<?php if($hide_editors_only==true){ echo 'checked="checked"'; } ?> />&nbsp;<label for="editors-only-checkbox">Editors Only</label>
			<p>By default, these hiding settings apply to all users, including admins. Use the above setting to apply these settings to just editor accounts.</p>
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="2" id="dashboard-checkbox" value="dashboard"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('dashboard', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="dashboard-checkbox">Dashboard</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="3" id="posts-checkbox" value="posts"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('posts', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="posts-checkbox">Posts</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="4" id="media-checkbox" value="media"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('media', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="media-checkbox">Media</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="5" id="pages-checkbox" value="pages"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('pages', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="pages-checkbox">Pages</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="6" id="comments-checkbox" value="comments"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('comments', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="comments-checkbox">Comments</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="7" id="appearance-checkbox" value="appearance"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('appearance', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="appearance-checkbox">Appearance</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="8" id="plugins-checkbox" value="plugins"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('plugins', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="plugins-checkbox">Plugins</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="9" id="users-checkbox" value="users"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('users', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="users-checkbox">Users</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="10" id="tools-checkbox" value="tools"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('tools', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="tools-checkbox">Tools</label> <br />
			
			<input type="checkbox" name="aceify_hide_menus[]" tabindex="11" id="settings-checkbox" value="settings"<?php if(isset($aceify_hide_menus) && is_array($aceify_hide_menus)) { if(in_array('settings', $aceify_hide_menus)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="settings-checkbox">Settings</label> <br />
			
			<br /><br />
			<h3>Remove Unwanted WP &lt;head&gt; Tags and XMLRPC</h3>
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="13" id="wlwmanifest-checkbox" value="wlwmanifest"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('wlwmanifest', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="wlwmanifest-checkbox">wlwmanifest</label> <br />
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="14" id="generator-checkbox" value="generator"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('generator', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="generator-checkbox">Generator</label> <br />
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="15" id="shortlink-checkbox" value="shortlink"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('shortlink', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="shortlink-checkbox">Shortlink</label> <br />
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="16" id="feed_links-checkbox" value="feed_links"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('feed_links', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="feed_links-checkbox">Feed Links</label> <br />
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="16" id="relational_tags-checkbox" value="relational_tags"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('relational_tags', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="relational_tags-checkbox">Relational Meta Tags (Next/Previous page, post, etc)</label> <br />
			
			<input type="checkbox" name="aceify_remove_tags[]" tabindex="17" id="xmlrpc-checkbox" value="xmlrpc"<?php if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)) { if(in_array('xmlrpc', $aceify_remove_tags)) { echo 'checked="checked"'; } } ?> />&nbsp;<label for="xmlrpc-checkbox">Disable XMLRPC</label> <br />
			
			<br /><br />
			<h3>Remove Emoji Support (added to WP 4.2.2)</h3>
			
			<input type="checkbox" name="aceify_emoji" tabindex="18" id="aceify_emoji-checkbox" value="aceify_emoji"<?php if($aceify_emoji==true){ echo 'checked="checked"'; } ?> />&nbsp;<label for="aceify_emoji-checkbox">Disable Emoji Support</label>
			
			<br /><br />
			
			<h3>Featured Image Support</h3>
			
			<input type="checkbox" name="aceify_featured_image" tabindex="18" id="aceify_featured_image-checkbox" value="aceify_featured_image"<?php if($aceify_featured_image==true){ echo 'checked="checked"'; } ?> />&nbsp;<label for="aceify_featured_image-checkbox">Enable Featured Images</label> <br />
			
			<br /><br />
			
			<h3>Menus Support</h3>
			
			<input type="checkbox" name="aceify_menus" tabindex="18" id="aceify_menus-checkbox" value="aceify_menus"<?php if($aceify_menus==true){ echo 'checked="checked"'; } ?> />&nbsp;<label for="aceify_menus-checkbox">Enable Menus</label> <br />
			
			<br /><br />
			
			<h3>Disable Admin Bar on Front End</h3>
			
			<input type="checkbox" name="aceify_disable_bar" tabindex="17" id="disable-bar-checkbox" value="true"<?php if($aceify_disable_bar==true){ echo 'checked="checked"'; } ?> />&nbsp;<label for="disable-bar-checkbox">Disable Admin Bar (Front End)</label> <br />
			
			<br /><br />
			<h3>Custom Login Screen Logo &amp; Styles</h3>
			
			<label for="aceify_login_logo-input">Logo file URL</label> <br />
			<input type="text" name="aceify_login_logo" tabindex="18" id="aceify_login_logo-input" value="<?php if(isset($aceify_login_logo)) { echo esc_attr($aceify_login_logo); } ?>" style="width:590px; max-width: 90%;" /><br /><br />
			
			<label for="aceify_login_logo_height-input">Logo Height (include px or %)</label> <br />
			<input type="text" name="aceify_login_logo_height" tabindex="19" id="aceify_login_logo_height-input" value="<?php if(isset($aceify_login_logo_height)) { echo esc_attr($aceify_login_logo_height); } ?>" style="width:590px; max-width: 90%;" /><br /><br />
			
			<label for="aceify_login_logo_bottom_margin-input">Logo Bottom Margin (include px or %)</label> <br />
			<input type="text" name="aceify_login_logo_bottom_margin" tabindex="20" id="aceify_login_logo_bottom_margin-input" value="<?php if(isset($aceify_login_logo_bottom_margin)) { echo esc_attr($aceify_login_logo_bottom_margin); } ?>" style="width:590px; max-width: 90%;" /><br /><br />
			
			<label for="aceify_login_custom_css-input">Custom Login CSS (do not include &lt;style&gt; tags)</label><br />
			<textarea name="aceify_login_custom_css" id="aceify_login_custom_css-input" style="width:590px; height: 250px; max-width: 90%;"><?php If (isset($aceify_login_custom_css)) { echo esc_attr($aceify_login_custom_css); } ?></textarea> <br />
			
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}


//remove admin areas
function remove_menus(){
	$hide_editors_only = get_option('hide_editors_only');
	$aceify_hide_menus = get_option('aceify_hide_menus');
	if((($hide_editors_only==true && !current_user_can( 'manage_options' )) || ($hide_editors_only!=true)) && (isset($aceify_hide_menus) && is_array($aceify_hide_menus))) {
		if(in_array('dashboard', $aceify_hide_menus)) {
			remove_menu_page( 'index.php' ); //Hide Dashboard
		}
		if(in_array('posts', $aceify_hide_menus)) {
			remove_menu_page( 'edit.php' ); //Hide Posts
		}
		if(in_array('media', $aceify_hide_menus)) {
			remove_menu_page( 'upload.php' ); //Hide Media
		}
		if(in_array('pages', $aceify_hide_menus)) {
			remove_menu_page( 'edit.php?post_type=page' ); //Hide Pages
		}
		if(in_array('comments', $aceify_hide_menus)) {
			remove_menu_page( 'edit-comments.php' ); //Hide Comments
		}
		if(in_array('appearance', $aceify_hide_menus)) {
			remove_menu_page( 'themes.php' ); //Hide Appearance
		}
		if(in_array('plugins', $aceify_hide_menus)) {
			remove_menu_page( 'plugins.php' ); //Hide Plugins
		}
		if(in_array('users', $aceify_hide_menus)) {
			remove_menu_page( 'users.php' ); //Hide Users
		}
		if(in_array('tools', $aceify_hide_menus)) {
			remove_menu_page( 'tools.php' ); //Hide Tools
		}
		if(in_array('settings', $aceify_hide_menus)) {
			remove_menu_page( 'options-general.php' ); //Hide Settings
		}
	}
}
add_action( 'admin_menu', 'remove_menus' );


//remove unwanted wordpress <head> tags
$aceify_remove_tags = get_option('aceify_remove_tags');
if(isset($aceify_remove_tags) && is_array($aceify_remove_tags)){
	if(in_array('wlwmanifest', $aceify_remove_tags)) {
		remove_action('wp_head', 'wlwmanifest_link');
	}
	if(in_array('shortlink', $aceify_remove_tags)) {
		remove_action('wp_head', 'wp_shortlink_wp_head');
	}
	if(in_array('generator', $aceify_remove_tags)) {
		remove_action('wp_head', 'wp_generator');
	}
	if(in_array('feed_links', $aceify_remove_tags)) {
		remove_action('wp_head','feed_links_extra', 3);
	}
	if(in_array('relational_tags', $aceify_remove_tags)){
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	}
	if(in_array('xmlrpc', $aceify_remove_tags)) {
		add_filter('xmlrpc_enabled', '__return_false');
		remove_action('wp_head', 'rsd_link'); //Edit URI Link (xmlrpc)
	}
}

//disable emojis
$aceify_emoji = get_option('aceify_emoji');
if ( function_exists( 'add_theme_support' ) &&  $aceify_emoji) { 
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

//enamble featured image
$aceify_featured_image = get_option('aceify_featured_image');
if ( function_exists( 'add_theme_support' ) &&  $aceify_featured_image) { 
  add_theme_support( 'post-thumbnails' ); 
}

//add menu support
$aceify_menus = get_option('aceify_menus');
if($aceify_menus){
	add_theme_support( 'menus' );
}

//disable admin bar on front end
$aceify_disable_bar = get_option('aceify_disable_bar');
if($aceify_disable_bar==true) {
	add_filter('show_admin_bar', '__return_false');
}

//custom login page styles
function aceify_login_style() { 
	$aceify_login_logo = get_option('aceify_login_logo');
	$aceify_login_logo_height = get_option('aceify_login_logo_height');
	$aceify_login_logo_bottom_margin = get_option('aceify_login_logo_bottom_margin');
	$aceify_login_custom_css = get_option('aceify_login_custom_css');
	
	if($aceify_login_logo || $aceify_login_logo_height || $aceify_login_logo_bottom_margin || $aceify_login_custom_css){
?>

	<style type="text/css"><?php
		if($aceify_login_logo){ ?>
			body.login div#login h1 a {
				display: none;
			}
			body.login div#login h1{
				display: block;
				background: url('<?php echo $aceify_login_logo; ?>') no-repeat center;
				<?php if($aceify_login_logo_height){ ?>
					height: <?php echo $aceify_login_logo_height; ?>;
				<?php } ?>
				<?php if($aceify_login_logo_bottom_margin){ ?>
					margin-bottom: <?php echo $aceify_login_logo_bottom_margin; ?>;
				<?php } ?>
			}
		<?php }
		if(isset($aceify_login_custom_css)){ echo $aceify_login_custom_css; } ?>
	</style>
<?php }
}
add_action( 'login_enqueue_scripts', 'aceify_login_style' );
?>