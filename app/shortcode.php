<?php 
namespace WPPCD;

use WP_Query;

/**
 * Display post using shortcode
 * 
 * Managing post based on shortcode atts
 * 
 * We will collect query data from shortcode
 * 
 * @since 1.0
 * @author Saiful Islam<codersaiful@gmail.com>
 */
class Shortcode{
    public static $taxs = array();
    public static $term_name = 'category';
    public static $post_type = 'post';
    public static $posts_per_page = -1;
    public static $term_link = 'on';
    public static $atts = array();


    
    public static function init( $atts ){
        
        self::$atts = $atts;

        if( isset( $atts['taxs'] ) && ! empty( $atts['taxs'] ) ){
            self::$taxs = self::attr_to_arr('taxs');
        }
        if( empty( self::$atts ) || ! is_array( self::$atts ) ){
            self::$atts = array();
        }else{
            //Populate ATTS using manipulae_atts()
            self::manipulae_atts();
        }

        //Generate for all Cate
        if( empty( self::$taxs ) ){
            self::$taxs = self::get_taxonomies();
        }


        if( ! is_array( self::$taxs ) || count( self::$taxs ) < 1 ) return;
            
        return self::generate_html();
    }

    public static function manipulae_atts(){
        
        self::$post_type = isset( self::$atts['post_type'] ) && ! empty( self::$atts['post_type'] ) ? self::$atts['post_type']: self::$post_type;
        if( self::$post_type == 'product' ){
            self::$term_name = 'product_cat';
        }
        
        self::$term_name = isset( self::$atts['term_name'] ) && ! empty( self::$atts['term_name'] ) ? self::$atts['term_name']: self::$term_name;
        self::$posts_per_page = isset( self::$atts['posts_per_page'] ) && ! empty( self::$atts['posts_per_page'] ) ? self::$atts['posts_per_page']: self::$posts_per_page;
        self::$term_link = isset( self::$atts['term_link'] ) && ! empty( self::$atts['term_link'] ) ? self::$atts['term_link']: self::$term_link;
    }

    /**
     * Attr srting like taxs='1,2,32,45' to convert to array
     *
     * @param string $atts_attr taxs attts attr
     * @return void
     */
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



    /**
     * Get taxonomy list based on selected term name. such: category,tag,product_tag etc
     *
     * @return Array
     */
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
     * Full content will be generate from here
     * 
     * 
     * ************************
     * All other void method will call here
     * ************************
     *
     * @return void
     */
    public static function generate_html(){
        ob_start();

        foreach( self::$taxs as $taxonomy_id ){
            ?>
            <div class="wppcd-main-wrapper docs-wrapper">
                <div class="wppcd-inside-wrapper">
                <?php
                self::taxonomy_markup( $taxonomy_id );
                ?>
                
                </div><!-- /.wppcd-inside-wrapper -->
            </div><!--.wppcd.docs-wrapper -->
            
            <?php
        }

        return ob_get_clean();
    }

    /**
     * Each taxonomy HTML Markub will generate here
     *
     * @param int $taxonomy_id Here need taxonomy_id (Term ID)
     * @return void
     */
    public static function taxonomy_markup( $taxonomy_id = false ){
        if( ! $taxonomy_id ) return;
        if(empty( self::get_taxonomy_name( $taxonomy_id ) )) echo "The Taxonomy ID:$taxonomy_id not found";
        $term_link = self::$term_link == 'on' ? true : false;
        ?>
        <div class="each-taxonomy-item-wrapper">
            <div class="each-item-inside">
                <h3 class="item-heading item-heading-<?php echo esc_attr( $taxonomy_id ); ?>">
                    <?php if( $term_link ){?>
                    <a href="<?php echo esc_url( get_term_link( $taxonomy_id ) ); ?>" class="item-heading-link" target="_blank">
                    <?php } 
                    echo esc_html( self::get_taxonomy_name( $taxonomy_id ) );
                    if( $term_link ){ ?>
                    </a>
                    <?php } ?>
                </h3>
                <?php
                self::the_post_list_markup( $taxonomy_id );
                ?>
            </div>
        </div>
        <?php 

    }

    /**
     * Getting Taxonomy name/title based on Taxonomy Term ID 
     *
     * @param int $taxonomy_id
     * @return void
     */
    public static function get_taxonomy_name( $taxonomy_id ) {
        $taxonomy_id   = (int) $taxonomy_id;
        $taxonomy = get_term( $taxonomy_id, self::$term_name );
    
        if ( ! $taxonomy || is_wp_error( $taxonomy ) ) {
            return '';
        }
    
        return $taxonomy->name;
    }

    /**
     * Post list HTML markup
     * We find out All post under the selected taxonomy_id
     *
     * @param int $taxonomy_id
     * @return void
     */
    public static function the_post_list_markup( $taxonomy_id ){

        $args = array(
            'post_type'             => self::$post_type,
            'post_status'           => 'publish',
            'posts_per_page'        => self::$posts_per_page,//-1,
            'tax_query'             => array(
                array(
                    'taxonomy'  => self::$term_name,
                    'field'     => 'term_id',
                    'terms'     => $taxonomy_id,
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
            <ul class="item-list item-list-id-<?php echo esc_attr( $taxonomy_id ); ?>">
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