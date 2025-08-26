<?php
if (!defined('ABSPATH')) exit;

class BN_Rest {
    static function init() {
        add_action('rest_api_init',[__CLASS__,'routes']);
    }

    static function routes() {
        register_rest_route('book-notes/v1','/notes',[
            'methods'=>'GET',
            'callback'=>[__CLASS__,'notes'],
            'args'=>['min_rating'=>['default'=>0,'sanitize_callback'=>'absint']]
        ]);
    }

    static function notes(WP_REST_Request $req) {
        $min=(int)$req->get_param('min_rating');
        $args=['post_type'=>'book_note','posts_per_page'=>-1];
        if($min>0) $args['meta_query']=[['key'=>'book_rating','value'=>$min,'compare'=>'>=','type'=>'NUMERIC']];
        $q=new WP_Query($args);
        $out=[];
        while($q->have_posts()){ $q->the_post();
            $out[]=['id'=>get_the_ID(),'title'=>get_the_title(),'author'=>get_post_meta(get_the_ID(),'book_author',true),'rating'=>(int)get_post_meta(get_the_ID(),'book_rating',true),'link'=>get_permalink()];
        }
        wp_reset_postdata();
        return rest_ensure_response($out);
    }
}
BN_Rest::init();
