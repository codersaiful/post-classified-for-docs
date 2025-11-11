# BizzDocMaker User Guide

## Table of Contents

1. [Getting Started](#getting-started)
2. [Using Shortcodes](#using-shortcodes)
3. [Display Templates](#display-templates)
4. [Post Ordering](#post-ordering)
5. [Settings](#settings)
6. [Advanced Usage](#advanced-usage)
7. [Troubleshooting](#troubleshooting)

## Getting Started

### Installation

1. **From WordPress Admin:**
   - Go to Plugins > Add New
   - Search for "BizzDocMaker"
   - Click Install Now > Activate

2. **Manual Installation:**
   - Download the plugin ZIP
   - Go to Plugins > Add New > Upload Plugin
   - Choose the ZIP file and click Install Now
   - Activate the plugin

### First Steps

After activation, you'll see a welcome screen with quick start information.

1. Navigate to **BizzDocMaker** in your WordPress admin menu
2. Configure your settings (optional)
3. Add the shortcode to any page or post

## Using Shortcodes

### Basic Shortcode

The simplest way to display your documentation:

```
[bizzdocmaker]
```

This will display all posts organized by categories.

### Legacy Shortcode

The old shortcode still works for backward compatibility:

```
[WPPCD_Post]
```

### Shortcode Attributes

#### Template Selection

Choose how your content is displayed:

```
[bizzdocmaker template="list"]      <!-- Classic list (default) -->
[bizzdocmaker template="grid"]      <!-- Card-based grid -->
[bizzdocmaker template="accordion"] <!-- Collapsible sections -->
[bizzdocmaker template="table"]     <!-- Structured table -->
```

#### Post Type

Display any post type:

```
[bizzdocmaker post_type="post"]     <!-- WordPress posts -->
[bizzdocmaker post_type="page"]     <!-- WordPress pages -->
[bizzdocmaker post_type="product"]  <!-- WooCommerce products -->
```

#### Taxonomy

Choose which taxonomy to use:

```
[bizzdocmaker term_name="category"]     <!-- Categories (default) -->
[bizzdocmaker term_name="post_tag"]     <!-- Tags -->
[bizzdocmaker term_name="product_cat"]  <!-- Product categories -->
```

#### Specific Categories

Show only specific categories by ID:

```
[bizzdocmaker taxs="1,2,3"]
```

To find category IDs:
1. Go to Posts > Categories
2. Hover over a category name
3. Look at the URL (tag_ID=X)

#### Limit Posts

Control how many posts to show:

```
[bizzdocmaker posts_per_page="10"]  <!-- Show 10 posts per category -->
[bizzdocmaker posts_per_page="-1"]  <!-- Show all posts (default) -->
```

#### Display Options

```
[bizzdocmaker show_count="on"]        <!-- Show post count -->
[bizzdocmaker show_description="on"]  <!-- Show category description -->
[bizzdocmaker term_link="off"]        <!-- Hide category links -->
[bizzdocmaker _blank="on"]            <!-- Open links in new tab -->
```

#### Grid Columns

For grid template, set number of columns:

```
[bizzdocmaker template="grid" columns="3"]  <!-- 3 columns (default) -->
[bizzdocmaker template="grid" columns="2"]  <!-- 2 columns -->
[bizzdocmaker template="grid" columns="4"]  <!-- 4 columns -->
```

### Complete Examples

**Simple Documentation:**
```
[bizzdocmaker]
```

**Product Catalog:**
```
[bizzdocmaker post_type="product" term_name="product_cat" template="grid" columns="3"]
```

**FAQ Accordion:**
```
[bizzdocmaker template="accordion" taxs="5,6,7" show_description="on"]
```

**Knowledge Base Table:**
```
[bizzdocmaker template="table" post_type="post" term_name="category"]
```

## Display Templates

### List Template

**Best for:** Traditional documentation, linear content

**Features:**
- Clean vertical layout
- Easy to scan
- Mobile-friendly
- Default template

**Usage:**
```
[bizzdocmaker template="list"]
```

### Grid Template

**Best for:** Visual catalogs, multiple categories

**Features:**
- Card-based design
- Responsive columns
- Modern look
- Configurable columns (1-4)

**Usage:**
```
[bizzdocmaker template="grid" columns="3"]
```

### Accordion Template

**Best for:** Large content, space-saving

**Features:**
- Collapsible sections
- First section open by default
- Click to expand/collapse
- Smooth animations

**Usage:**
```
[bizzdocmaker template="accordion"]
```

### Table Template

**Best for:** Data presentation, structured content

**Features:**
- Tabular format
- Shows post date
- Numbered rows
- Responsive design

**Usage:**
```
[bizzdocmaker template="table"]
```

## Post Ordering

### Using the Meta Box

Each post/page has a "BizzDocMaker - Post Order" meta box in the editor.

**Steps:**
1. Edit any post or page
2. Find the "BizzDocMaker - Post Order" box in the sidebar
3. Enter a number (lower numbers appear first)
4. Update/Publish the post

**Example:**
- Post A: Order 1 (appears first)
- Post B: Order 2 (appears second)
- Post C: Order 10 (appears third)

### Disabling Custom Order

To use default WordPress order instead:

```
[bizzdocmaker order_by_number="off"]
```

## Settings

Access settings from **BizzDocMaker > Settings** in admin menu.

### General Settings

**Default Template:** Choose the default template for new shortcodes

**Enable Caching:** Turn on to improve performance (recommended)

### Display Settings

**Posts Per Page:** Default number of posts to show

**Show Post Count:** Display count next to category names by default

## Advanced Usage

### For Developers

**Custom Query:**
```php
add_filter( 'bizzdocmaker_query_args', function( $args ) {
    $args['posts_per_page'] = 20;
    $args['orderby'] = 'title';
    return $args;
});
```

**Template Override:**

1. Create folder in theme: `your-theme/bizzdocmaker/`
2. Copy template from plugin: `templates/list/template.php`
3. Paste in theme folder and modify

### WooCommerce Integration

**Display Products:**
```
[bizzdocmaker post_type="product" term_name="product_cat"]
```

**Product Grid:**
```
[bizzdocmaker post_type="product" term_name="product_cat" template="grid" columns="4"]
```

**Product Tags:**
```
[bizzdocmaker post_type="product" term_name="product_tag"]
```

### Multiple Shortcodes

You can use multiple shortcodes on the same page:

```
[bizzdocmaker template="list" taxs="1,2"]

[bizzdocmaker template="grid" taxs="3,4,5" columns="3"]
```

## Troubleshooting

### Posts Not Showing

**Check:**
1. Posts are published (not draft)
2. Posts have the correct category assigned
3. Category ID is correct in `taxs` attribute
4. Post type matches your content

### Wrong Order

**Solutions:**
1. Set order numbers in meta box
2. Make sure `order_by_number="on"` (default)
3. Check that meta box is visible in Screen Options

### Styling Issues

**Try:**
1. Clear browser cache
2. Check for theme conflicts
3. Use browser inspector to check CSS
4. Add custom CSS in theme

**Custom CSS Example:**
```css
.bizzdocmaker-wrapper {
    /* Your custom styles */
}
```

### Template Not Loading

**Verify:**
1. Template name is correct (list, grid, accordion, table)
2. Template file exists in plugin
3. Check for theme override conflicts

### Performance Issues

**Optimize:**
1. Enable caching in settings
2. Limit posts with `posts_per_page`
3. Show only specific categories with `taxs`
4. Optimize images

## FAQs

**Q: Can I customize the appearance?**
A: Yes! Use custom CSS or override templates in your theme.

**Q: Does it work with custom post types?**
A: Absolutely! Use the `post_type` attribute.

**Q: Is it mobile responsive?**
A: Yes, all templates are fully responsive.

**Q: Can I use it multiple times on one page?**
A: Yes, you can use as many shortcodes as needed.

**Q: Does it slow down my site?**
A: No, the plugin is optimized for performance with caching.

**Q: Can I translate it?**
A: Yes, it's translation ready with .pot file included.

**Q: Is there support?**
A: Yes, through WordPress.org forum and GitHub issues.

## Getting Help

- **Documentation:** This guide and developer docs in `help-doc/`
- **Support Forum:** https://wordpress.org/support/plugin/post-classified-for-docs/
- **GitHub Issues:** https://github.com/codersaiful/post-classified-for-docs/issues

## Updates

The plugin will notify you when updates are available. Always backup before updating!

---

**Need more help?** Visit the [Support Forum](https://wordpress.org/support/plugin/post-classified-for-docs/)
