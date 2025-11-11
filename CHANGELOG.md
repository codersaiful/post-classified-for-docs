# Changelog

All notable changes to BizzDocMaker will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2024-11-11

### 🎉 Major Release - Complete Plugin Refactoring

This is a major update with breaking changes. The plugin has been completely refactored with modern architecture, new features, and improved performance.

### ✨ Added

#### Core Features
- **PSR-4 Autoloading** - Modern autoloader following PSR-4 standards
- **OOP Architecture** - Complete rewrite using object-oriented programming
- **New Namespace** - Changed to `BizzDocMaker` for better organization
- **Plugin Class** - Singleton pattern implementation for plugin initialization

#### Admin Features
- **Settings Page** - Full-featured admin settings with tabbed interface
  - General settings tab
  - Display settings tab
  - Advanced settings tab
- **Dashboard Widget** - Shows plugin statistics (total posts, categories, ordered posts)
- **Welcome Screen** - First-time user onboarding experience
- **Improved Meta Box** - Better UI for post ordering in editor
- **Help & Support Page** - In-admin documentation and support resources

#### Display Templates
- **List Template** - Enhanced classic list layout (default)
- **Grid Template** - Modern card-based responsive grid (1-4 columns)
- **Accordion Template** - Collapsible sections for better organization
- **Table Template** - Structured tabular format with dates
- **Template Override System** - Theme-level template customization support

#### Shortcode Features
- **New Shortcode** - `[bizzdocmaker]` (old shortcode still works)
- **Template Selection** - `template` attribute (list, grid, accordion, table)
- **Column Control** - `columns` attribute for grid layout
- **Show Count** - `show_count` attribute to display post counts
- **Show Description** - `show_description` attribute for taxonomy descriptions

#### UI/UX Improvements
- **Modern Admin UI** - Clean, professional admin interface
- **Responsive Design** - Mobile-first approach for all templates
- **Loading States** - Visual feedback during operations
- **Smooth Animations** - CSS transitions and animations
- **Better Typography** - Improved readability and hierarchy

#### Developer Features
- **Template System** - Easy template override in themes
- **Hooks & Filters** - Extensive action and filter hooks
  - `bizzdocmaker_loaded` action
  - `bizzdocmaker_query_args` filter
  - `bizzdocmaker_enqueue_styles` action
  - `bizzdocmaker_enqueue_scripts` action
  - `bizzdocmaker_meta_box_post_types` filter
- **Developer Documentation** - Comprehensive docs in Bengali and English
- **Code Examples** - Practical examples for common customizations

#### Assets
- **New CSS** - Modern, modular stylesheets
  - `assets/css/frontend.css` - Frontend styles
  - `assets/css/admin.css` - Admin styles
- **New JavaScript** - Enhanced functionality
  - `assets/js/frontend.js` - Accordion, search, smooth scroll
  - `assets/js/admin.js` - Tab navigation, form validation

#### Documentation
- **User Guide** - Comprehensive guide in `help-doc/user-guide.md`
- **Developer Guide** - Bengali developer docs in `help-doc/developer-guide-bn.md`
- **README.md** - Updated GitHub README with badges and examples
- **CONTRIBUTING.md** - Contribution guidelines for developers
- **CHANGELOG.md** - This changelog file

### 🔄 Changed

- **Plugin Name** - "Post Classified for Docs" → "BizzDocMaker - Documentation & Post List Builder"
- **Text Domain** - Kept as `post-classified-for-docs` for backward compatibility
- **Minimum PHP** - Updated to 7.0 (was 5.6)
- **Minimum WordPress** - Updated to 5.0 (was 4.0)
- **Meta Key** - `wppcd_post_order_number` → `bizzdocmaker_post_order`
- **File Structure** - Reorganized into `src/` directory
  - `src/Admin/` - Admin components
  - `src/Frontend/` - Frontend components
  - `src/Core/` - Core functionality
- **Readme.txt** - Complete rewrite with detailed information

### 🔒 Security

- **Nonce Verification** - Added to all form submissions
- **Capability Checks** - Proper permission verification
- **Input Sanitization** - All inputs sanitized using WordPress functions
- **Output Escaping** - All outputs escaped properly
- **CSRF Protection** - Protection against cross-site request forgery

### ⚡ Performance

- **Query Optimization** - Optimized database queries
- **Caching Support** - Built-in caching system (can be enabled in settings)
- **Lazy Loading** - JavaScript-based lazy loading for images
- **Minification Ready** - Assets ready for minification

### 🐛 Fixed

- Improved error handling in shortcode rendering
- Fixed category/taxonomy detection issues
- Resolved mobile responsive issues
- Fixed post ordering inconsistencies

### 📝 Documentation

- Updated all inline code documentation
- Added PHPDoc blocks to all classes and methods
- Created comprehensive user and developer guides
- Added code examples and use cases

### ♻️ Deprecated

- Old file structure (kept for backward compatibility)
- `WPPCD` namespace (now `BizzDocMaker`)
- Old constants (kept for compatibility)

### 🔧 Technical

- Implemented PSR-4 autoloading
- Added singleton pattern for main plugin class
- Improved code organization and structure
- Better separation of concerns
- WordPress Coding Standards compliance

### 📦 Backward Compatibility

- ✅ Old shortcode `[WPPCD_Post]` still works
- ✅ Old file structure preserved
- ✅ Text domain unchanged for translations
- ✅ Meta data compatible with old version

### 🎨 UI Components

- Modern admin menu with icon
- Tabbed settings interface
- Dashboard widget with statistics
- Improved meta box design
- Welcome screen for new users
- Help and documentation section

---

## [1.2.0] - 2023-XX-XX

### Changed
- Updated stable tag
- Tested with WordPress 6.8

### Fixed
- Various bug fixes
- Stability improvements

---

## [1.1.0] - 2022-XX-XX

### Changed
- Updated readme
- Updated stable tag

### Added
- New options for customization

### Fixed
- Bug fixes

---

## [1.0.0] - Initial Release

### Added
- Basic shortcode functionality `[WPPCD_Post]`
- Category-based post listing
- Support for custom post types
- Taxonomy support
- Post type and taxonomy filtering
- Posts per page limit
- Custom post ordering
- Basic styling

### Features
- Display posts by category
- Support for WooCommerce products
- Customizable via filter hooks
- Simple shortcode attributes

---

## Upgrade Guide

### From 1.x to 2.0

**Requirements:**
- PHP 7.0 or higher (was 5.6)
- WordPress 5.0 or higher (was 4.0)

**Breaking Changes:**
- None - fully backward compatible

**What to Do:**
1. Backup your site
2. Update the plugin
3. Clear caches (if using caching plugins)
4. Test your pages with shortcodes
5. Check admin settings (optional)

**New Features to Try:**
- Visit BizzDocMaker > Settings to configure defaults
- Try new templates: `[bizzdocmaker template="grid"]`
- Check the dashboard widget for statistics
- Read the user guide in Help & Support

**Notes:**
- Old shortcode `[WPPCD_Post]` continues to work
- No database changes required
- Settings are optional, plugin works without configuration
- All your existing shortcodes will work as before

---

[2.0.0]: https://github.com/codersaiful/post-classified-for-docs/releases/tag/2.0.0
[1.2.0]: https://github.com/codersaiful/post-classified-for-docs/releases/tag/1.2.0
[1.1.0]: https://github.com/codersaiful/post-classified-for-docs/releases/tag/1.1.0
[1.0.0]: https://github.com/codersaiful/post-classified-for-docs/releases/tag/1.0.0
