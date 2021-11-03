<?php 
namespace WPPCD;

use WP_Query;

class Shortcode{
    public static $cats = array();
    public static $term_name = 'category';
    public static $post_type = 'post';
    public static $atts = array();


    public static function attr_to_arr($atts_attr = 'cats'){
        
        $atts = self::$atts;
        $catstr = $atts[$atts_attr];
        if( ! is_string( $catstr ) ) return;

        $catstr = rtrim($catstr,',');
        $cats = explode(',',$catstr);

        $cats = array_filter($cats);
        $cats = array_map(function($item){
            return (int) $item;
        },$cats);
        return $cats;
    }

    public static function init( $atts ){
        
        self::$atts = $atts;
        if( isset( $atts['cats'] ) && ! empty( $atts['cats'] ) ){
            self::$cats = self::attr_to_arr('cats');
        }

        //Generate for all Cate
        if( empty( self::$cats ) ){
            self::$cats = self::get_categories();
        }

        //self::$cats = self::get_cat_modified_ids();

        if( ! is_array( self::$cats ) || count( self::$cats ) < 1 ) return;

        
        return self::generate_html();
    }

    public static function get_cat_modified_ids(){
        $modified_cats = self::$cats;




        return apply_filters( 'wppcd_cats_list_arr', $modified_cats , self::$atts );

    }

    public static function get_categories(){
        $categories = get_terms(
            array(
                'taxonomy' => 'category',
            )
        );
        $o_cats = array();
        foreach( $categories as $category ){
            $o_cats[$category->term_id] = $category->term_id;
        }
        return $o_cats;
    }

    /**
     * Generating full HTML
     */
    public static function generate_html(){
        ob_start();

        foreach( self::$cats as $cat_id ){
            ?>
            <div class="wppcd-main-wrapper docs-wrapper">
                <div class="wppcd-inside-wrapper">
                <?php
                self::taxonomy_markup( $cat_id );
                ?>
                
                </div><!-- /.wppcd-inside-wrapper -->
            </div><!--.wppcd.docs-wrapper -->
            
            <?php
        }

        return ob_get_clean();
    }

    public static function taxonomy_markup( $cat_id = false ){
        if( ! $cat_id ) return;
        if(empty( self::get_taxonomy_name( $cat_id ) )) echo "The Taxonomy ID:$cat_id not found";
        ?>
        <div class="each-taxonomy-item-wrapper">
            <div class="each-item-inside">
                <h3 class="item-heading <?php echo esc_attr( $cat_id ); ?>"><?php echo esc_html( self::get_taxonomy_name( $cat_id ) ) ?></h3>
                <?php
                self::the_post_list_markup( $cat_id );
                ?>
            </div>
        </div>
        <?php 

    }

    public static function get_taxonomy_name( $cat_id ) {
        $cat_id   = (int) $cat_id;
        $category = get_term( $cat_id, self::$term_name );
    
        if ( ! $category || is_wp_error( $category ) ) {
            return '';
        }
    
        return $category->name;
    }

    public static function the_post_list_markup( $cat_id ){
        $args = array(
            'post_type'             => self::$post_type,
            'post_status'           => 'publish',
            'posts_per_page'        => -1,
            'tax_query'             => array(
                array(
                    'taxonomy'  => self::$term_name,
                    'field'     => 'term_id',
                    'terms'     => $cat_id,
                ),
            ),

        );

        $query = new WP_Query( $args );
        
        if( $query->have_posts() ):
            ?>
            <ul class="item-list item-list-id-<?php echo esc_attr( $cat_id ); ?>">
            <?php 
            while( $query->have_posts() ): $query->the_post();

            ?>
                <li class="each-doc-item">
                    <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="doc-link" target="_blank">
                    <?php echo esc_html( get_the_title() ); ?>
                    </a>
                </li>
            <?php 
            endwhile;
            ?>
            </ul>
            <?php
        else:
        endif;
        wp_reset_query();
        wp_reset_postdata();
    }   
}