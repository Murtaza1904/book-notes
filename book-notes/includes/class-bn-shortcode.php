<?php
if (!defined('ABSPATH')) exit;

class BN_Shortcode {
    static function init() {
        add_shortcode('book_notes',[__CLASS__,'render']);
    }

    static function render($atts) {
        $atts=shortcode_atts(['min_rating'=>0,'search'=>''],$atts,'book_notes');
        $paged=max(1,get_query_var('paged')?get_query_var('paged'):(isset($_GET['paged'])?absint($_GET['paged']):1));
        $per_page=(int)get_option('bn_per_page',10);
        $args=['post_type'=>'book_note','posts_per_page'=>$per_page,'paged'=>$paged,'s'=>$atts['search']];
        if ((int)$atts['min_rating']>0) {
            $args['meta_query']=[['key'=>'book_rating','value'=>(int)$atts['min_rating'],'compare'=>'>=','type'=>'NUMERIC']];
        }
        $q=new WP_Query($args);
        ob_start();
        if ($q->have_posts()){
            echo '<div class="bn-list">';
            while($q->have_posts()){ $q->the_post();
                $author=get_post_meta(get_the_ID(),'book_author',true);
                $rating=(int)get_post_meta(get_the_ID(),'book_rating',true);
                echo '<article class="bn-item">';
                echo '<h3><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
                if($author) echo '<div>Author: '.esc_html($author).'</div>';
                if($rating) echo '<div>Rating: '.esc_html($rating).'/5</div>';
                echo '<div>'.wp_kses_post(get_the_excerpt()).'</div>';
                echo '</article>';
            }
            echo '</div>';
            echo paginate_links(['total'=>$q->max_num_pages,'current'=>$paged,'type'=>'list']);
            wp_reset_postdata();
        } else {
            echo '<p>No notes found.</p>';
        }
        return ob_get_clean();
    }
}
BN_Shortcode::init();
