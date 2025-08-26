<?php
if (!defined('ABSPATH')) exit;

class BN_CPT {
    static function init() {
        add_action('init',[__CLASS__,'register']);
    }

    static function register() {
        $labels=['name'=>'Book Notes','singular_name'=>'Book Note'];
        register_post_type('book_note',[
            'labels'=>$labels,
            'public'=>true,
            'supports'=>['title','editor','thumbnail','excerpt'],
            'show_in_rest'=>true,
            'has_archive'=>true,
            'rewrite'=>['slug'=>'book-notes']
        ]);
        register_post_meta('book_note','book_author',[
            'type'=>'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'sanitize_text_field'
        ]);
        register_post_meta('book_note','book_rating',[
            'type'=>'integer','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'absint'
        ]);
    }

    static function activate() {
        self::register();
        flush_rewrite_rules();
    }
    static function deactivate() {
        flush_rewrite_rules();
    }
}
BN_CPT::init();
