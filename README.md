# BizzDocMaker - Documentation & Post List Builder

![WordPress Plugin Version](https://img.shields.io/badge/version-2.0.0-blue)
![WordPress Version](https://img.shields.io/badge/wordpress-5.0%2B-brightgreen)
![PHP Version](https://img.shields.io/badge/php-7.0%2B-purple)
![License](https://img.shields.io/badge/license-GPL--2.0%2B-orange)

A powerful WordPress plugin to create beautiful documentation pages, knowledge bases, sitemaps, and organized post lists with multiple display templates and advanced customization options.

## 🚀 Features

- **Multiple Display Templates** - List, Grid, Accordion, and Table layouts
- **Advanced Post Ordering** - Custom ordering with visual meta box
- **Taxonomy-Based Organization** - Group by categories, tags, or custom taxonomies
- **Universal Post Type Support** - Works with any post type
- **Responsive Design** - Mobile-friendly layouts
- **Developer Friendly** - Hooks, filters, and template overrides
- **WooCommerce Compatible** - Display products and categories
- **Performance Optimized** - Query caching and best practices
- **Security First** - Proper sanitization and nonce verification

## 📦 Installation

### From WordPress Admin

1. Navigate to **Plugins > Add New**
2. Search for "BizzDocMaker"
3. Click **Install Now**
4. Activate the plugin

### Manual Installation

1. Download the plugin ZIP file
2. Upload to `/wp-content/plugins/`
3. Activate through the WordPress admin panel

## 📖 Usage

### Basic Shortcode

```
[bizzdocmaker]
```

### With Templates

```
[bizzdocmaker template="grid" columns="3"]
[bizzdocmaker template="accordion"]
[bizzdocmaker template="table"]
```

### For WooCommerce

```
[bizzdocmaker post_type="product" term_name="product_cat"]
```

### Advanced Example

```
[bizzdocmaker template="grid" post_type="post" taxs="1,2,3" posts_per_page="10" show_count="on"]
```

## 🎨 Templates

### List Template
Classic vertical list with clean typography - perfect for documentation.

### Grid Template
Modern card-based grid layout - ideal for showcasing multiple categories.

### Accordion Template
Collapsible sections - great for organizing large amounts of content.

### Table Template
Structured tabular format - best for data-heavy presentations.

## ⚙️ Shortcode Attributes

| Attribute | Description | Default | Values |
|-----------|-------------|---------|--------|
| `template` | Display template | `list` | list, grid, accordion, table |
| `post_type` | Post type to display | `post` | Any registered post type |
| `term_name` | Taxonomy name | `category` | Any registered taxonomy |
| `taxs` | Specific taxonomy IDs | - | Comma-separated IDs |
| `posts_per_page` | Number of posts | `-1` | Number or -1 for all |
| `term_link` | Show taxonomy links | `on` | on, off |
| `_blank` | Open in new tab | `off` | on, off |
| `order_by_number` | Use custom ordering | `on` | on, off |
| `show_count` | Display post count | `off` | on, off |
| `show_description` | Show taxonomy description | `off` | on, off |
| `columns` | Grid columns | `3` | 1-4 |

## 👨‍💻 Developer Documentation

### Hooks & Filters

#### Actions

```php
// After plugin loads
do_action( 'bizzdocmaker_loaded' );

// Enqueue custom styles
do_action( 'bizzdocmaker_enqueue_styles' );

// Enqueue custom scripts
do_action( 'bizzdocmaker_enqueue_scripts' );
```

#### Filters

```php
// Modify query arguments
$args = apply_filters( 'bizzdocmaker_query_args', $args, $taxonomy_id, $atts );

// Change meta box post types
$post_types = apply_filters( 'bizzdocmaker_meta_box_post_types', $post_types );
```

### Template Override

Create a `bizzdocmaker` folder in your theme and copy template files:

```
your-theme/
└── bizzdocmaker/
    └── list/
        └── template.php
```

### Code Example

```php
// Custom query modification
add_filter( 'bizzdocmaker_query_args', function( $args, $taxonomy_id, $atts ) {
    $args['posts_per_page'] = 20;
    return $args;
}, 10, 3 );
```

## 📂 File Structure

```
post-classified-for-docs/
├── src/
│   ├── Admin/              # Admin components
│   ├── Frontend/           # Frontend components
│   ├── Core/               # Core functionality
│   ├── Autoloader.php      # PSR-4 autoloader
│   └── Plugin.php          # Main plugin class
├── templates/              # Display templates
│   ├── list/
│   ├── grid/
│   ├── accordion/
│   └── table/
├── assets/
│   ├── css/               # Stylesheets
│   └── js/                # JavaScript files
├── help-doc/              # Documentation
└── init.php               # Plugin entry point
```

## 🔧 Development

### Requirements

- PHP 7.0+
- WordPress 5.0+
- Node.js (for building assets)

### Building Assets

```bash
npm install
npm run build
```

### Coding Standards

The plugin follows WordPress Coding Standards:

```bash
composer install
./vendor/bin/phpcs
```

## 🤝 Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📝 Changelog

### Version 2.0.0 (2024-11-11)

**Major Update - Complete Refactoring**

- ✨ New admin settings page
- ✨ Dashboard widget
- ✨ Multiple display templates (Grid, Accordion, Table)
- ✨ Template override system
- ✨ PSR-4 autoloading
- ✨ Modern OOP architecture
- 🔒 Enhanced security
- ⚡ Performance improvements
- 📱 Better responsive design

### Version 1.2.0

- Bug fixes and stability improvements
- WordPress 6.8 compatibility

### Version 1.0

- Initial release

## 📄 License

GPL v2 or later - [License Details](https://www.gnu.org/licenses/gpl-2.0.html)

## 💬 Support

- [WordPress Support Forum](https://wordpress.org/support/plugin/post-classified-for-docs/)
- [GitHub Issues](https://github.com/codersaiful/post-classified-for-docs/issues)

## 🌟 Credits

Developed with ❤️ by [Saiful Islam](https://profiles.wordpress.org/codersaiful/)

## 📚 Links

- [WordPress.org Plugin Page](https://wordpress.org/plugins/post-classified-for-docs/)
- [GitHub Repository](https://github.com/codersaiful/post-classified-for-docs)
- [Documentation](https://github.com/codersaiful/post-classified-for-docs/wiki)

---

**If you find this plugin helpful, please consider leaving a ⭐ star on GitHub and a review on WordPress.org!**