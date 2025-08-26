<?php
/*
Plugin Name: Book Notes
Description: Book Note custom post type with meta, settings, shortcode, and REST API.
Version: 1.0.0
Author: Muhammad Murtaza
Text Domain: book-notes
*/
if (!defined('ABSPATH')) exit;

define('BN_PATH', plugin_dir_path(__FILE__));
define('BN_URL', plugin_dir_url(__FILE__));

require_once BN_PATH.'includes/class-bn-cpt.php';
require_once BN_PATH.'includes/class-bn-metabox.php';
require_once BN_PATH.'includes/class-bn-shortcode.php';
require_once BN_PATH.'includes/class-bn-settings.php';
require_once BN_PATH.'includes/class-bn-rest.php';

register_activation_hook(__FILE__, ['BN_CPT','activate']);
register_deactivation_hook(__FILE__, ['BN_CPT','deactivate']);

add_action('plugins_loaded', function(){
    load_plugin_textdomain('book-notes', false, dirname(plugin_basename(__FILE__)).'/languages');
});
