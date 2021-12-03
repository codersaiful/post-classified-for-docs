=== Post Classfied for making Documentation, Site map, POST List ===
Contributors: codersaiful
Tags: wp post, post list, product list, taxonomy wise post, category wise post, site map, site xml
Requires at least: 4.0.0
Tested up to: 5.8.2
Stable tag: 1.2.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

To display all post based on a shortcode [WPPCD_Post taxs='123,322']. User able to display any type custom post. Even any type taxonomy. Such: category,tags etc.

== Description ==
*WP Post Classfied for making Docs, Site map, POST List* helps you to display post list based on category, tag, or any type or taxonomy. All condition is depend on shortcode attr. See some example of shortcode.

**In our plugin**

* Dfault taxonomy(term_name) name is: 'category'.
* Dfault post type(post_type) is: 'post'.
* Dfault Taxonomy Link(term_link) is: 'on'.


**Shortcode Example**

`[WPPCD_Post]`
Post title with link from WordPress default post with all category name.

`[WPPCD_Post taxs='123,322']`
Here: 123,322 are category ID. Mean: Taxnomy ID.

`[WPPCD_Post post_type='product']`
It will display all product title with link with WooCommerce caegory classified.

`[WPPCD_Post post_type='product' term_name='product_tag']`
It's depend on WooCommerce, product will display from product, based on WooCommerce tag(product_tag).

`[WPPCD_Post taxs='12,34,56,67' post_type='product' term_name='product_tag' term_link='off' posts_per_page='10']`
Example with all attr:


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

== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/post-classified-for-docs` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. And Enjoy our plugin. There is no configuration/setting page. Just use shortcode.


== Frequently Asked Questions ==

= Is there in Dashboard ? =

No, there is no menu or option in Dashboard menu. All you able to handle using shortcode.

= support any custo post type? =

Yes.

= Can I limit post for eacy taxonomy? =

Yes. You can. Use attr posts_per_page in your shortcode as attr.

= Is it support any theme ? =

Yes.

= How to show specific Category post ? =

use taxs attr. include ID of your Category/Taxnomy. 

== Screenshots ==


== Changelog ==

= 1.1 =
* Readme update and stable tag update

= 1.1 =
* Bug Fix and added new options

= 1.0 =
* Just Start First version.