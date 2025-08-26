<?php
if (!defined('ABSPATH')) exit;

class BN_Settings {
    static function init() {
        add_action('admin_menu',[__CLASS__,'menu']);
        add_action('admin_init',[__CLASS__,'register']);
    }

    static function menu() {
        add_options_page('Book Notes Settings','Book Notes','manage_options','bn-settings',[__CLASS__,'page']);
    }

    static function register() {
        register_setting('bn_settings','bn_per_page',['type'=>'integer','sanitize_callback'=>'absint','default'=>10]);
        add_settings_section('bn_section','Display','__return_false','bn-settings');
        add_settings_field('bn_per_page','Items per page',[__CLASS__,'field'],'bn-settings','bn_section');
    }

    static function field() {
        $v=(int)get_option('bn_per_page',10);
        echo '<input type="number" name="bn_per_page" value="'.esc_attr($v).'" min="1" class="small-text">';
    }

    static function page() {
        echo '<div class="wrap"><h1>Book Notes Settings</h1><form method="post" action="options.php">';
        settings_fields('bn_settings');
        do_settings_sections('bn-settings');
        submit_button();
        echo '</form></div>';
    }
}
BN_Settings::init();
