<?php 
namespace WPPCD;

use WP_Query;

class Shortcode{
    public static $taxs = array();
    public static $term_name = 'category';
    public static $post_type = 'post';
    public static $atts = array();


    
    public static function init( $atts ){
        
        self::$atts = $atts;

        if( isset( $atts['taxs'] ) && ! empty( $atts['taxs'] ) ){
            self::$taxs = self::attr_to_arr('taxs');
        }

        //Generate for all Cate
        if( empty( self::$taxs ) ){
            self::$taxs = self::get_taxonomies();
        }


        if( ! is_array( self::$taxs ) || count( self::$taxs ) < 1 ) return;

        if( empty( self::$atts ) || ! is_array( self::$atts ) ){
            self::$atts = array();
        }

        return self::generate_html();
    }

    public static function attr_to_arr($atts_attr = 'taxs'){
        
        $atts = self::$atts;
        $taxstr = $atts[$atts_attr];
        if( ! is_string( $taxstr ) ) return;

        $taxstr = rtrim($taxstr,',');
        $taxs = explode(',',$taxstr);

        $taxs = array_filter($taxs);
        $taxs = array_map(function($item){
            return (int) $item;
        },$taxs);
        return $taxs;
    }



    public static function get_taxonomies(){
        $taxonomies = get_terms(
            array(
                'taxonomy' => self::$term_name,//'category',
            )
        );
        $o_taxs = array();
        foreach( $taxonomies as $taxonomy ){
            $o_taxs[$taxonomy->term_id] = $taxonomy->term_id;
        }
        return $o_taxs;
    }

    /**
     * Generating full HTML
     */
    public static function generate_html(){
        ob_start();

        foreach( self::$taxs as $cat_id ){
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
                <h3 class="item-heading item-heading-<?php echo esc_attr( $cat_id ); ?>"><?php echo esc_html( self::get_taxonomy_name( $cat_id ) ) ?></h3>
                <?php
                self::the_post_list_markup( $cat_id );
                ?>
            </div>
        </div>
        <?php 

    }

    public static function get_taxonomy_name( $cat_id ) {
        $cat_id   = (int) $cat_id;
        $taxonomy = get_term( $cat_id, self::$term_name );
    
        if ( ! $taxonomy || is_wp_error( $taxonomy ) ) {
            return '';
        }
    
        return $taxonomy->name;
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

        /**
         * Query Args Generate and Handle using $atts
         * 
         * We will access args index key from $atts key
         * 
         * @since 1.0.0.0
         */
        $this_atts = self::$atts;

        $args = apply_filters('wppcd_query_args', $args);
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