<?php
/*
Plugin Name: Top Smooth Scroll
Plugin URI: https://www.digitaladquest.com/wordpress-plugins/
Description: A complete plugin to add smooth scroll to your WordPress Website, Smooth Scroll To Top, Smooth Scroll To ID, Page Smooth Scrolling, Mouse Smooth Scroll. With in the setting page, you can create a beautiful Scroll To Top Button, Also you can set the button position to Left, Right or Center.
Version: 1.0
Author: Digital Ad Quest
Author URI: https://www.digitaladquest.com/
License: GPLv2 or later
Copyright 2017 Digital Ad Quest

This program is free software:
you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation,
either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.
If not, see http://www.gnu.org/licenses/gpl-2.0.html
*/


// Adding Menu
add_action('admin_menu', 'daq_tss_add_menu');
function daq_tss_add_menu() {
    $page = add_menu_page('Smooth Scroll', 'Smooth Scroll', 'administrator', 'smooth-scroll', 'daq_tss_menu_function');
}


// Add settings link on plugin page
function daq_tss_plugin_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=smooth-scroll">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'daq_tss_plugin_settings_link' );


// Default Options
register_activation_hook( __FILE__, 'daq_tss_activate' );

function daq_tss_activate() {
	add_option('daq_sttp_enable','1');
	add_option('daq_sttp_icon','5');
	add_option('daq_sttp_icon_size','2');
	add_option('daq_sttp_icon_color','#FFFFFF');
	add_option('daq_sttp_icon_hover_color','#DD3333');
	add_option('daq_sttp_background_color','#CCCCCC');
	add_option('daq_sttp_background_hover_color','#EEEE22');
	add_option('daq_sttp_button_radius','25');
	add_option('daq_sttp_button_position','3');
	add_option('daq_sttp_button_margin_left','0');
	add_option('daq_sttp_button_margin_right','20');
	add_option('daq_sttp_button_margin_bottom','20');
	add_option('daq_stid_enable','0');
	add_option('daq_pssc_enable','0');
}


// Enque CSS and Scripts Admin Page Only
function daq_tss_custom_wp_admin_style($hook) {
        // Load only on ?page=tags-categories
        if($hook != 'toplevel_page_smooth-scroll') {
                return;
        }
        wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/style.css', __FILE__) );
		wp_enqueue_style( 'wp-color-picker');
	    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', FALSE, NULL);
        wp_enqueue_script('color-picker-js',plugins_url('js/color-picker.js',__FILE__),array( 'wp-color-picker' ));
}
add_action( 'admin_enqueue_scripts', 'daq_tss_custom_wp_admin_style' );


// Enque Scroll To Top CSS and Scripts
function daq_tss_scroll_to_top_files() {

	$daq_sttp_enable = get_option('daq_sttp_enable');
  		if ($daq_sttp_enable == 1):
		
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', FALSE, NULL);
  wp_enqueue_script('scroller-to-top',plugins_url('js/scroll-to-top.js',__FILE__),array( 'jquery' ));
  		endif;
}
add_action( 'init', 'daq_tss_scroll_to_top_files' );


// Enque Scroll To ID JS
function daq_tss_scroll_to_id_files() {
        $daq_stid_enable = get_option('daq_stid_enable');
  
  		if ($daq_stid_enable == 1) :
        wp_enqueue_script('scroll-to-id',plugins_url('js/scroll-to-id.js',__FILE__),array( 'jquery' ));
		endif;
}
add_action( 'init', 'daq_tss_scroll_to_id_files' );


// Enque Page Smooth Scrolling JS
function daq_tss_page_smooth_files() {
        $daq_pssc_enable = get_option('daq_pssc_enable');
  
  		if ($daq_pssc_enable == 1) :
        wp_enqueue_script('scrollSpeed',plugins_url('js/jQuery.scrollSpeed.js',__FILE__),array( 'jquery' ));
		wp_enqueue_script('page-smooth-scroll',plugins_url('js/page-smooth-scroll.js',__FILE__),array( 'jquery' ));
		endif;
}
add_action( 'wp_footer', 'daq_tss_page_smooth_files' );


// Save Settings
add_action('admin_init', 'daq_tss_reg_function' );
function daq_tss_reg_function() {
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_enable' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_icon' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_icon_size' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_icon_color' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_icon_hover_color' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_background_color' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_background_hover_color' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_button_radius' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_button_position' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_button_margin_left' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_button_margin_right' );
	register_setting( 'daq-settings-group-sttp', 'daq_sttp_button_margin_bottom' );
	register_setting( 'daq-settings-group-stid', 'daq_stid_enable' );
	register_setting( 'daq-settings-group-pssc', 'daq_pssc_enable' );
}


//Display styles in Head (Theme)
add_action('wp_head',"daq_tss_scroll_to_top_style_add_head");
function daq_tss_scroll_to_top_style_add_head(){
  $daq_sttp_icon_color = get_option('daq_sttp_icon_color');
  $daq_sttp_icon_hover_color =get_option('daq_sttp_icon_hover_color');
  $daq_sttp_background_color = get_option('daq_sttp_background_color');
  $daq_sttp_background_hover_color = get_option('daq_sttp_background_hover_color');
  $daq_sttp_button_radius = get_option('daq_sttp_button_radius');
  $daq_sttp_button_position = get_option('daq_sttp_button_position');
  $daq_sttp_button_margin_left = get_option('daq_sttp_button_margin_left');
  $daq_sttp_button_margin_right = get_option('daq_sttp_button_margin_right');
  $daq_sttp_button_margin_bottom = get_option('daq_sttp_button_margin_bottom');

  include 'css/style.php';
}


// Display Enable (Checked)
function daq_tss_scroll_to_top_verify_enable() {
	$enable = get_option('daq_sttp_enable');
	
	if ($enable == 1) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_verify_disable() {
	$enable = get_option('daq_sttp_enable');
	
	if ($enable == 0) {
		echo "checked=\"checked\"";
	}
}


// Display Icon (Checked)
function daq_tss_scroll_to_top_verify_icon_one() {
	$enable = get_option('daq_sttp_icon');
	
	if ($enable == 1) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_verify_icon_two() {
	$enable = get_option('daq_sttp_icon');
	
	if ($enable == 2) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_verify_icon_three() {
	$enable = get_option('daq_sttp_icon');
	
	if ($enable == 3) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_verify_icon_four() {
	$enable = get_option('daq_sttp_icon');
	
	if ($enable == 4) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_verify_icon_five() {
	$enable = get_option('daq_sttp_icon');
	
	if ($enable == 5) {
		echo "checked=\"checked\"";
	}
}


// Display Button Position (Checked)
function daq_tss_scroll_to_top_button_position_one() {
	$enable = get_option('daq_sttp_button_position');
	
	if ($enable == 1) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_button_position_two() {
	$enable = get_option('daq_sttp_button_position');
	
	if ($enable == 2) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_top_button_position_three() {
	$enable = get_option('daq_sttp_button_position');
	
	if ($enable == 3) {
		echo "checked=\"checked\"";
	}
}


// Display Selected Icon Size (Selected)
function daq_tss_scroll_to_top_icon_size_one() {
	$enable = get_option('daq_sttp_icon_size');
	
	if ($enable == 1) {
		echo "selected=\"selected\"";
	}
}

function daq_tss_scroll_to_top_icon_size_two() {
	$enable = get_option('daq_sttp_icon_size');
	
	if ($enable == 2) {
		echo "selected=\"selected\"";
	}
}

function daq_tss_scroll_to_top_icon_size_three() {
	$enable = get_option('daq_sttp_icon_size');
	
	if ($enable == 3) {
		echo "selected=\"selected\"";
	}
}


// Display Enable (Checked) ////// stid
function daq_tss_scroll_to_id_verify_enable() {
	$enable = get_option('daq_stid_enable');
	
	if ($enable == 1) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_scroll_to_id_verify_disable() {
	$enable = get_option('daq_stid_enable');
	
	if ($enable == 0) {
		echo "checked=\"checked\"";
	}
}


// Display Enable (Checked) ///////pssc
function daq_tss_page_scroll_verify_enable() {
	$enable = get_option('daq_pssc_enable');
	
	if ($enable == 1) {
		echo "checked=\"checked\"";
	}
}

function daq_tss_page_scroll_verify_disable() {
	$enable = get_option('daq_pssc_enable');
	
	if ($enable == 0) {
		echo "checked=\"checked\"";
	}
}


// HTML Structure For Theme Files
function  daq_tss_html_structure(){
 
  $daq_sttp_enable = get_option('daq_sttp_enable');
  $daq_sttp_icon = get_option('daq_sttp_icon');
  $daq_sttp_icon_size = get_option('daq_sttp_icon_size');
  $daq_sttp_icon_color = get_option('daq_sttp_icon_color');
  $daq_sttp_icon_hover_color =get_option('daq_sttp_icon_hover_color');
  $daq_sttp_background_color = get_option('daq_sttp_background_color');
  $daq_sttp_background_hover_color = get_option('daq_sttp_background_hover_color');
  $daq_sttp_button_radius = get_option('daq_sttp_button_radius');
  $daq_sttp_button_position = get_option('daq_sttp_button_position');
  $daq_sttp_button_margin_left = get_option('daq_sttp_button_margin_left');
  $daq_sttp_button_margin_right = get_option('daq_sttp_button_margin_right');
  $daq_sttp_button_margin_bottom = get_option('daq_sttp_button_margin_bottom');
  
  if ($daq_sttp_enable == 1) :
  
  ?>
  
	<div id='daq_tss_wrapper'>
		<div>
		<a href="#top" onclick='return false;'>
		<div class="<?php if ($daq_sttp_button_position == 1) : ?>left<?php endif; ?><?php if ($daq_sttp_button_position == 2) : ?>center<?php endif; ?><?php if ($daq_sttp_button_position == 3) : ?>right<?php endif; ?>">
		<div class="button <?php if ($daq_sttp_icon_size == 1) : ?>small<?php endif; ?><?php if ($daq_sttp_icon_size == 2) : ?>medium<?php endif; ?><?php if ($daq_sttp_icon_size == 3) : ?>large<?php endif; ?>">
		<span>
		<?php if ($daq_sttp_icon == 1) : ?><i class="fa fa-angle-up"></i><?php endif; ?><?php if ($daq_sttp_icon == 2) : ?><i class="fa fa-angle-double-up"></i><?php endif; ?><?php if ($daq_sttp_icon == 3) : ?><i class="fa fa-arrow-up"></i><?php endif; ?><?php if ($daq_sttp_icon == 4) : ?><i class="fa fa-arrow-circle-up"></i><?php endif; ?><?php if ($daq_sttp_icon == 5) : ?><i class="fa fa-arrow-circle-o-up"></i><?php endif; ?>
		</span>
		</div>
		</div>
		</a>
		</div>
	</div>
	
  <?php
  
  endif;
}
add_action('wp_footer','daq_tss_html_structure');


// FEED TO WP DASHBOARD
add_action( 'wp_dashboard_setup', 'daq_tss_plugin_setup_function' );
function daq_tss_plugin_setup_function() {
    add_meta_box( 'daq_tss_plugin_dashboard_custom_feed', 'Plugin Support', 'daq_tss_plugin_widget_function', 'dashboard', 'side', 'high' );
}
function daq_tss_plugin_widget_function() {
    
	echo '<div class="daq-rss-widget" style="height:300px; overflow-y:scroll"><a href="https://www.digitaladquest.com/"><img src="' . plugins_url( 'images/feed-logo.png', __FILE__ ) . '" ></a><br>Thank you for using our plugin <strong>Top Smooth Scroll</strong>! We hope the plugin works as stated and you liked this plugin, for any support or feedback, Please <a href="https://www.digitaladquest.com/" target="_blank">visit our website.</a><h3><br><strong>Also You May Check Our Latest News &amp; Blog Updates Below:</strong></h3>';
		wp_widget_rss_output(array(
		// CHANGE THE URL BELOW TO THAT OF YOUR FEED
		'url' => 'http://feeds.feedburner.com/DigitalAdQuest',
		// CHANGE 'OrganicWeb News' BELOW TO THE NAME OF YOUR WIDGET
		'title' => 'Digital Ad Quest Updates',
		// CHANGE '2' TO THE NUMBER OF FEED ITEMS YOU WANT SHOWING
		'items' => 3,
		// CHANGE TO '0' IF YOU ONLY WANT THE TITLE TO SHOW
		'show_summary' => 1,
		// CHANGE TO '1' TO SHOW THE AUTHOR NAME
		'show_author' => 0,
		// CHANGE TO '1' TO SHOW THE PUBLISH DATE
		'show_date' => 1
		));
	echo "</div>";
}



// Setting Form For Admin
function daq_tss_menu_function() {
?>

<div class="wrap">
<h1>Top Smooth Scroll</h1>
<div id="dashboard" class="daq-tss-dashboard">
<h1>Add Smooth Scroll To Top, To ID And Page Smooth Scrolling</h1>

	<!-- Display Saved Message-->
 	<?php if( isset($_GET['settings-updated']) ) { ?>
	<div id="message" class="updated settings-error notice is-dismissible">
	<p><strong><?php _e('Settings saved.') ?></strong></p>
	</div>
	<?php } ?>
	


<?php
 function daq_tss_page_tabs($current = 'first') {
    $tabs = array(
        'scroll_to_top'   => __("Smooth Scroll To Top", 'subh-lite'), 
        'scroll_to_id'  => __("Smooth Scroll To ID", 'subh-lite'),
		'page_smooth_scroll'  => __("Page Smooth Scrolling", 'subh-lite')
    );
    $html =  '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ($tab == $current) ? 'nav-tab-active' : '';
        $html .=  '<a class="nav-tab ' . $class . '" href="?page=smooth-scroll&tab=' . $tab . '">' . $name . '</a>';
    }
    $html .= '</h2>';
    echo $html;
}
?>

<?php
$tab = (!empty($_GET['tab']))? esc_attr($_GET['tab']) : 'scroll_to_top';
daq_tss_page_tabs($tab);
?>

<?php
if($tab == 'scroll_to_top' ) {
?>
	
<form method="post" action="options.php">
	
	<?php settings_fields( 'daq-settings-group-sttp' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Enable Scroll To Top</th>
        <td>
        	<label> 
        		<input type="radio" value="1" <?php daq_tss_scroll_to_top_verify_enable(); ?> name="daq_sttp_enable">
        		Enable
        	</label>
        	<label>
        		<input type="radio" value="0" <?php daq_tss_scroll_to_top_verify_disable(); ?> name="daq_sttp_enable">
        		Disable
        	</label>
        </td>
        </tr>
 
        <tr valign="top">
        <th scope="row">Choose Icon</th>
        <td>
        	<label> 
        		<input type="radio" value="1" <?php daq_tss_scroll_to_top_verify_icon_one(); ?> name="daq_sttp_icon">
        		<i class="fa fa-angle-up"></i>
        	</label>
        	<label>
        		<input type="radio" value="2" <?php daq_tss_scroll_to_top_verify_icon_two(); ?> name="daq_sttp_icon">
        		<i class="fa fa-angle-double-up"></i>
        	</label>
			<label>
        		<input type="radio" value="3" <?php daq_tss_scroll_to_top_verify_icon_three(); ?> name="daq_sttp_icon">
        		<i class="fa fa-arrow-up"></i>
        	</label>
			<label>
        		<input type="radio" value="4" <?php daq_tss_scroll_to_top_verify_icon_four(); ?> name="daq_sttp_icon">
        		<i class="fa fa-arrow-circle-up"></i>
        	</label>
			<label>
        		<input type="radio" value="5" <?php daq_tss_scroll_to_top_verify_icon_five(); ?> name="daq_sttp_icon">
        		<i class="fa fa-arrow-circle-o-up"></i>
        	</label>
        </td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Icon Size</th>
        <td>
        <select name="daq_sttp_icon_size" class="daq-tss-input-width">
		  <option <?php daq_tss_scroll_to_top_icon_size_one(); ?> value="1">Small</option>
		  <option <?php daq_tss_scroll_to_top_icon_size_two(); ?> value="2">Medium</option>
		  <option <?php daq_tss_scroll_to_top_icon_size_three(); ?> value="3">Large</option>
		</select>
		</td>
        </tr>
		
   
        <tr valign="top">
        <th scope="row">Icon Color</th>
        <td>
        <label>
        <input type="text" name="daq_sttp_icon_color" class='daq_sttp_color_picker' value="<?php echo get_option('daq_sttp_icon_color'); ?>" />
        </label>
        </tr>
		
		<tr valign="top">
        <th scope="row">Icon Hover Color</th>
        <td>
        <label>
        <input type="text" name="daq_sttp_icon_hover_color" class='daq_sttp_color_picker' size="7" value="<?php echo get_option('daq_sttp_icon_hover_color'); ?>" />
        </label>
        </tr>
        <tr valign="top">
        <th scope="row">BackGround Color</th>
        <td>
        <label>
        <input type="text" name="daq_sttp_background_color" class='daq_sttp_color_picker' size="7" value="<?php echo get_option('daq_sttp_background_color'); ?>" />
        </label>
        </tr>
		
		<tr valign="top">
        <th scope="row">BackGround Hover Color</th>
        <td>
        <label>
        <input type="text" name="daq_sttp_background_hover_color" class='daq_sttp_color_picker' size="7" value="<?php echo get_option('daq_sttp_background_hover_color'); ?>" />
        </label>
        </tr>
		
		<tr valign="top">
        <th scope="row">Button Radius (px)</th>
        <td>
        <label>
        <input type="text" name="daq_sttp_button_radius"  class="daq-tss-input-width" size="7" value="<?php echo get_option('daq_sttp_button_radius'); ?>" />
        </label><br /><br />
		<span class="daq-tss-orange-color">Round Button:</span> Enter 20 for small button, 25 for medium button, 35 for large button.
        </tr>
		
		<tr valign="top">
        <th scope="row">Button Position</th>
        <td>
        <label> 
        		<input type="radio" value="1" <?php daq_tss_scroll_to_top_button_position_one(); ?> name="daq_sttp_button_position">
        		Left
        	</label>
        	<label>
        		<input type="radio" value="2" <?php daq_tss_scroll_to_top_button_position_two(); ?> name="daq_sttp_button_position">
        		Center
        	</label>
			<label>
        		<input type="radio" value="3" <?php daq_tss_scroll_to_top_button_position_three(); ?> name="daq_sttp_button_position">
        		Right
        	</label>
        </tr>
		
		<tr valign="top">
        <th scope="row">Button Margin (px)</th>
        <td>
        <label>Left
        <input type="text" name="daq_sttp_button_margin_left"  class="daq-tss-input-width" size="7" value="<?php echo get_option('daq_sttp_button_margin_left'); ?>" />
        </label>
		<label>Right
        <input type="text" name="daq_sttp_button_margin_right"  class="daq-tss-input-width" size="7" value="<?php echo get_option('daq_sttp_button_margin_right'); ?>" />
        </label>
		<label>Bottom
        <input type="text" name="daq_sttp_button_margin_bottom"  class="daq-tss-input-width" size="7" value="<?php echo get_option('daq_sttp_button_margin_bottom'); ?>" />
        </label><br /><br />
		<span class="daq-tss-orange-color">Remember:</span> Entering "0" will set as "margin-xxxxx:0px" for respective button position.
        </tr>
    
    
    </table>
 
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
	
 
</form>
</div>
<?php } ?>

<?php
if($tab == 'scroll_to_id' ) {
?>

	<form method="post" action="options.php">
	
	<?php settings_fields( 'daq-settings-group-stid' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Enable Scroll To ID</th>
        <td>
        	<label> 
        		<input type="radio" value="1" <?php daq_tss_scroll_to_id_verify_enable(); ?> name="daq_stid_enable">
        		Enable
        	</label>
        	<label>
        		<input type="radio" value="0" <?php daq_tss_scroll_to_id_verify_disable(); ?> name="daq_stid_enable">
        		Disable
        	</label><br /><br />
			<span class="daq-tss-orange-color">Note:</span>
			<ol>
			<li>It enables smooth scroll to the links with in the pages.</li><li>For Ex. <strong>&lt;a href="#one"&gt;One&lt;/a&gt;</strong> to <strong>&lt;div id="one"&gt;First Element&lt;/div&gt;</strong></li>
			</ol>
        </td>
        </tr>
    </table>
 
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
	
 
</form>
</div>

<?php } ?>

<?php
if($tab == 'page_smooth_scroll' ) {
?>

<form method="post" action="options.php">
	
	<?php settings_fields( 'daq-settings-group-pssc' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Enable Scroll To ID</th>
        <td>
        	<label> 
        		<input type="radio" value="1" <?php daq_tss_page_scroll_verify_enable(); ?> name="daq_pssc_enable">
        		Enable
        	</label>
        	<label>
        		<input type="radio" value="0" <?php daq_tss_page_scroll_verify_disable(); ?> name="daq_pssc_enable">
        		Disable
        	</label><br /><br />
			<span class="daq-tss-orange-color">Note:</span> <ol><li>Just enable this, No more settings needed.</li><li>This enables smooth scroll to mouse scrolling.</li></ol>
        </td>
        </tr>
    </table>
 
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
	
 
</form>
</div>

<?php } ?>

<div class="daq-tss-sidebar">
<?php
echo '<a href="https://www.digitaladquest.com/"><img src="' . plugins_url( 'images/logo.png', __FILE__ ) . '" ></a> ';
?>
<p class="text-justify"><strong>Thank you for using our plugin!</strong> We hope the plugin works as stated and you liked this plugin, for any support or feedback, Please <a href="https://www.digitaladquest.com/" target="_blank">visit our website.</a></p>
<a href="https://www.digitaladquest.com/wordpress-plugins/" class="button daq-tss-width-100">View Our Other Plugins</a><br /><br /><a href="https://www.digitaladquest.com/wordpress-theme/" class="button daq-tss-width-100">Download WordPress Themes</a><br /><br /><a href="https://www.digitaladquest.com/" class="button-primary daq-tss-width-100">Visit Our Website</a>
</div>
</div>
<?php } ?>