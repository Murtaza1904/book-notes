<?php
if (!defined('ABSPATH')) exit;

class BN_Metabox {
    static function init() {
        add_action('add_meta_boxes',[__CLASS__,'add']);
        add_action('save_post_book_note',[__CLASS__,'save']);
    }

    static function add() {
        add_meta_box('bn_fields','Book Details',[__CLASS__,'render'],'book_note','side','default');
    }

    static function render($post) {
        wp_nonce_field('bn_save','bn_nonce');
        $author=get_post_meta($post->ID,'book_author',true);
        $rating=(int)get_post_meta($post->ID,'book_rating',true);
        echo '<p><label>Author</label><br><input type="text" name="book_author" value="'.esc_attr($author).'" class="widefat"></p>';
        echo '<p><label>Rating (1-5)</label><br><input type="number" name="book_rating" min="1" max="5" value="'.($rating?$rating:'').'" class="widefat"></p>';
    }

    static function save($post_id) {
        if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'],'bn_save')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['book_author'])) update_post_meta($post_id,'book_author',sanitize_text_field($_POST['book_author']));
        if (isset($_POST['book_rating'])) update_post_meta($post_id,'book_rating',absint($_POST['book_rating']));
    }
}
BN_Metabox::init();
