## Post Classfied for making Docs, Site map, POST List

**WP Post Classfied for making Docs, Site map, POST List** helps you to display  post list based on category, tag, or any type or taxonomy. All condition is depend on shortcode attr. See some example of shortcode.

**In our plugin**

* Dfault taxonomy(term_name) name is: 'category'.
* Dfault post type(post_type) is: 'post'.
* Dfault Taxonomy Link(term_link) is: 'on'.

**Plugin Links**
* [in WordPress.org Plugin Directory](https://wordpress.org/plugins/post-classified-for-docs/)
* [Github Repo](https://github.com/codersaiful/post-classified-for-docs)


**Shortcode Example**

`[WPPCD_Post]`
Post title with link from WordPress default post with all category name.

`[WPPCD_Post taxs='123,322']`
Here: 123,322 are category ID. Mean: Taxnomy ID.

`[WPPCD_Post post_type='product']`
It will display all product title with link with WooCommerce caegory classified.

`[WPPCD_Post post_type='product' term_name='product_tag']`
It's depend on WooCommerce, product will display from product, based on WooCommerce tag(product_tag).

Example with all attr:
`[WPPCD_Post taxs='12,34,56,67' post_type='product' term_name='product_tag' term_link='off' posts_per_page='10']`

**Important feature**

* Making Docs using Category base.
* Support custom post,
* Support any taxonomy
* Customizeable using filter hook.
* posts_per_page supported attr. 
* post_type supported attr. define post type here.
* taxs supported attr. define your category ID, or any type term/taxonomy ID.
* term_name supported attr. such: post,tag,product_cat,product_tag etc.
* term_link supported attr. on or off your taxonomy link.

## Code Style
```php
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
}
```