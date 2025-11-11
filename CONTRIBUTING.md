# Contributing to BizzDocMaker

Thank you for your interest in contributing to BizzDocMaker! This document provides guidelines and instructions for contributing.

## 🤝 How to Contribute

### Reporting Bugs

1. Check if the bug has already been reported in [Issues](https://github.com/codersaiful/post-classified-for-docs/issues)
2. If not, create a new issue with:
   - Clear title and description
   - Steps to reproduce
   - Expected vs actual behavior
   - WordPress version, PHP version
   - Screenshots if applicable

### Suggesting Enhancements

1. Check existing [Issues](https://github.com/codersaiful/post-classified-for-docs/issues) and [Pull Requests](https://github.com/codersaiful/post-classified-for-docs/pulls)
2. Create a new issue with:
   - Clear description of the enhancement
   - Use case and benefits
   - Possible implementation approach

### Pull Requests

1. Fork the repository
2. Create a new branch: `git checkout -b feature/your-feature-name`
3. Make your changes
4. Test thoroughly
5. Commit with clear messages
6. Push to your fork
7. Create a Pull Request

## 📝 Coding Standards

### PHP

- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Use PSR-4 autoloading
- Add PHPDoc blocks for all classes and methods
- Use type hints where possible (PHP 7.0+)

### JavaScript

- Follow [WordPress JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/)
- Use ES5 syntax for compatibility
- Comment complex logic

### CSS

- Follow [WordPress CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/)
- Use BEM naming convention where appropriate
- Mobile-first approach

## 🏗️ Development Setup

### Requirements

- PHP 7.0 or higher
- WordPress 5.0 or higher
- Node.js and npm
- Composer

### Local Development

1. Clone the repository:
```bash
git clone https://github.com/codersaiful/post-classified-for-docs.git
cd post-classified-for-docs
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Build assets:
```bash
npm run build
```

4. Link to WordPress:
```bash
ln -s /path/to/post-classified-for-docs /path/to/wordpress/wp-content/plugins/
```

## ✅ Testing

### Manual Testing

1. Test all shortcode variations
2. Check multiple templates (list, grid, accordion, table)
3. Verify different post types
4. Test on different themes
5. Check mobile responsiveness

### Code Quality

Run PHP Code Sniffer:
```bash
./vendor/bin/phpcs
```

Fix automatically fixable issues:
```bash
./vendor/bin/phpcbf
```

## 📦 Building for Release

1. Update version numbers:
   - `init.php` header
   - `readme.txt` stable tag
   - `src/Plugin.php` version
   - `package.json` version

2. Update CHANGELOG in `readme.txt`

3. Build assets:
```bash
npm run build
```

4. Create release package:
```bash
npm run package
```

## 🔐 Security

- Never commit sensitive data
- Sanitize all inputs
- Escape all outputs
- Use nonces for forms
- Check user capabilities

## 📋 Commit Messages

Use clear, descriptive commit messages:

- ✨ `feat: Add grid template support`
- 🐛 `fix: Resolve accordion collapse issue`
- 📝 `docs: Update README with new examples`
- 💄 `style: Improve mobile responsiveness`
- ♻️ `refactor: Reorganize admin classes`
- ⚡ `perf: Optimize query performance`
- 🔒 `security: Add nonce verification`

## 🌐 Translation

### Adding Translations

1. Use `__()`, `_e()`, `esc_html__()`, etc. with text domain `post-classified-for-docs`
2. Generate POT file:
```bash
wp i18n make-pot . languages/post-classified-for-docs.pot
```

## 📄 Documentation

- Update README.md for user-facing changes
- Update help-doc/ for developer documentation
- Add inline comments for complex logic
- Update PHPDoc blocks

## 🎯 Code Review Process

1. All PRs require review
2. Address feedback promptly
3. Keep PR focused on single feature/fix
4. Ensure CI checks pass
5. Update documentation if needed

## 💡 Questions?

- Open an issue for discussion
- Check existing documentation
- Ask in WordPress Support Forum

## 📜 License

By contributing, you agree that your contributions will be licensed under GPL v2 or later.

---

Thank you for contributing to BizzDocMaker! 🎉
