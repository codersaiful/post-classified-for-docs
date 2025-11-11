=== BizzDocMaker - Documentation & Post List Builder ===
Contributors: codersaiful
Tags: documentation, post list, taxonomy, knowledge base, site map, table of contents
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 2.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create beautiful documentation pages, knowledge bases, and organized post lists with multiple display templates and advanced customization options.

== Description ==

**BizzDocMaker** is a powerful WordPress plugin that helps you create stunning documentation pages, knowledge bases, site maps, and organized post lists. With multiple display templates and extensive customization options, you can showcase your content in the most effective way.

= 🚀 Key Features =

* **Multiple Display Templates** - Choose from List, Grid, Accordion, or Table layouts
* **Advanced Post Ordering** - Control the exact order of your posts with custom ordering
* **Taxonomy-Based Organization** - Group posts by categories, tags, or any custom taxonomy
* **Universal Post Type Support** - Works with posts, pages, products, and any custom post type
* **Responsive Design** - Looks great on all devices and screen sizes
* **Developer Friendly** - Extensive hooks, filters, and template override system
* **Performance Optimized** - Built with best practices and query caching
* **Security First** - Follows WordPress security standards with proper sanitization
* **WooCommerce Compatible** - Seamlessly integrates with WooCommerce products
* **Easy to Use** - Simple shortcodes with powerful customization options

= 📋 Display Templates =

* **List Template** - Classic vertical list with clean typography
* **Grid Template** - Modern card-based grid layout
* **Accordion Template** - Collapsible sections for better organization
* **Table Template** - Structured tabular format for easy scanning

= 🎯 Use Cases =

* Documentation and knowledge base
* Product catalogs and listings
* Site maps and content indexes
* FAQ sections
* Resource libraries
* Course syllabi
* Service directories
* And much more!

= 💡 Shortcode Examples =

**Basic Usage:**
`[bizzdocmaker]`

**With Grid Template:**
`[bizzdocmaker template="grid" columns="3"]`

**For WooCommerce Products:**
`[bizzdocmaker post_type="product" term_name="product_cat"]`

**Specific Categories:**
`[bizzdocmaker taxs="1,2,3" template="accordion"]`

**Custom Display:**
`[bizzdocmaker post_type="post" posts_per_page="10" show_count="on" show_description="on"]`

**Legacy Shortcode (Still Supported):**
`[WPPCD_Post taxs='123,322']`

= 🔧 Shortcode Attributes =

* `template` - Display template (list, grid, accordion, table)
* `post_type` - Post type to display (default: post)
* `term_name` - Taxonomy name (default: category)
* `taxs` - Comma-separated taxonomy IDs
* `posts_per_page` - Number of posts to show (-1 for all)
* `term_link` - Show taxonomy links (on/off)
* `_blank` - Open links in new tab (on/off)
* `order_by_number` - Use custom post ordering (on/off)
* `show_count` - Display post count (on/off)
* `show_description` - Show taxonomy description (on/off)
* `columns` - Number of columns for grid (1-4)

= 👨‍💻 Developer Features =

* PSR-4 autoloading
* Modern OOP architecture
* Extensive action and filter hooks
* Template override system
* Clean, well-documented code
* WordPress Coding Standards compliant
* Translation ready

= 🔌 Hooks & Filters =

**Filters:**
* `bizzdocmaker_query_args` - Modify query arguments
* `bizzdocmaker_meta_box_post_types` - Add/remove post types for meta box

**Actions:**
* `bizzdocmaker_loaded` - Fires when plugin is fully loaded
* `bizzdocmaker_enqueue_styles` - Add custom styles
* `bizzdocmaker_enqueue_scripts` - Add custom scripts

= 🌐 Translation Ready =

The plugin is fully translation ready and follows WordPress internationalization standards.

= 📖 Documentation =

Comprehensive documentation and code examples are available in the Help & Support section within the plugin settings.

== Installation ==

= Automatic Installation =

1. Log in to your WordPress admin panel
2. Navigate to Plugins > Add New
3. Search for "BizzDocMaker"
4. Click "Install Now" and then "Activate"

= Manual Installation =

1. Download the plugin zip file
2. Upload to `/wp-content/plugins/` directory
3. Unzip the file
4. Activate through the 'Plugins' menu in WordPress

= Getting Started =

1. After activation, you'll see a welcome screen with quick start guide
2. Navigate to BizzDocMaker > Settings to configure default options
3. Add the shortcode `[bizzdocmaker]` to any page or post
4. Customize with attributes as needed

== Frequently Asked Questions ==

= How do I display my documentation? =

Simply add the shortcode `[bizzdocmaker]` to any page or post where you want to display your documentation.

= Can I customize the appearance? =

Yes! You can choose from multiple templates (list, grid, accordion, table) and customize colors through your theme's CSS. The plugin also supports template overrides.

= Does it work with custom post types? =

Absolutely! Use the `post_type` attribute to specify any post type: `[bizzdocmaker post_type="your_custom_type"]`

= How do I order my posts? =

Each post has a "BizzDocMaker - Post Order" meta box in the editor. Set the order number (lower numbers appear first).

= Is it compatible with WooCommerce? =

Yes! You can display WooCommerce products: `[bizzdocmaker post_type="product" term_name="product_cat"]`

= Can I limit the number of posts? =

Yes, use the `posts_per_page` attribute: `[bizzdocmaker posts_per_page="10"]`

= Does it support multiple languages? =

Yes, the plugin is translation ready and follows WordPress internationalization standards.

= How do I override templates? =

Create a `bizzdocmaker` folder in your theme and copy the template files from the plugin's `templates` folder.

= Is there a dashboard? =

Yes! Version 2.0 includes a full admin interface with settings page, dashboard widget, and help section.

= Can I hide taxonomy links? =

Yes, use `term_link="off"` in your shortcode.

= How do I display specific categories only? =

Use the `taxs` attribute with comma-separated category IDs: `[bizzdocmaker taxs="1,2,3"]`

= Does it affect site performance? =

No, the plugin is optimized for performance with query caching and follows WordPress best practices.

== Screenshots ==

1. List template displaying documentation organized by categories
2. Grid template with modern card layout
3. Accordion template with collapsible sections
4. Admin settings page with multiple options
5. Dashboard widget showing statistics
6. Post order meta box in editor
7. Help & documentation page

== Changelog ==

= 2.0.0 - 2024-11-11 =
**Major Update - Complete Plugin Refactoring**

* **New Features:**
  - Added admin settings page with tabbed interface
  - Dashboard widget showing plugin statistics
  - Welcome screen for new installations
  - Grid display template
  - Accordion display template
  - Table display template
  - Template override system for themes
  - Improved post ordering interface
  - Help & support page with documentation

* **Improvements:**
  - Complete code refactoring with PSR-4 autoloading
  - Modern OOP architecture
  - WordPress Coding Standards compliance
  - Enhanced security with proper sanitization and escaping
  - Improved performance with query optimization
  - Better responsive design
  - New shortcode `[bizzdocmaker]` (old shortcode still works)
  - Enhanced meta box design
  - Better admin UI/UX

* **Developer:**
  - Namespace changed to BizzDocMaker
  - Added extensive hooks and filters
  - Clean, documented code
  - Template override support
  - Action and filter hooks for extensibility

* **Breaking Changes:**
  - Minimum PHP version: 7.0
  - Minimum WordPress version: 5.0
  - New file structure (backward compatible)

= 1.2.0 =
* Bug fixes and stability improvements
* Tested with WordPress 6.8

= 1.1 =
* Readme update and stable tag update
* Added new options for customization

= 1.0 =
* Initial release

== Upgrade Notice ==

= 2.0.0 =
Major update with new features, templates, and improved admin interface. Fully backward compatible with previous versions. Requires PHP 7.0+.

= 1.2.0 =
Bug fixes and compatibility updates. Safe to update.

== Support ==

For support, feature requests, or bug reports, please visit:

* [WordPress Support Forum](https://wordpress.org/support/plugin/post-classified-for-docs/)
* [GitHub Repository](https://github.com/codersaiful/post-classified-for-docs)

== Credits ==

Developed with ❤️ by [Saiful Islam](https://profiles.wordpress.org/codersaiful/)

== Privacy Policy ==

BizzDocMaker does not collect, store, or share any personal data. The plugin operates entirely within your WordPress installation.