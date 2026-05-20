# প্লাগিন উন্নয়নের জন্য প্রম্পট এবং নির্দেশনা

## ভূমিকা

এই ডকুমেন্টে আপনি পাবেন কিভাবে AI/Developer কে নির্দেশ দিয়ে এই প্লাগিন উন্নত করা যায়। প্রতিটি সেকশনে বাংলায় বিস্তারিত প্রম্পট দেওয়া আছে।

---

## ১. নিরাপত্তা উন্নতি (Security Improvements)

### প্রম্পট:
```
আমার WordPress প্লাগিনের নিরাপত্তা উন্নত করতে হবে। নিম্নলিখিত কাজগুলো করুন:

1. `app/shortcode.php` ফাইলে:
   - সকল শর্টকোড অ্যাট্রিবিউটে sanitize_text_field() ব্যবহার করুন
   - attr_to_arr() ফাংশনে array_map() দিয়ে absint() ব্যবহার করুন
   - SQL injection প্রতিরোধের জন্য সব ইনপুট ভ্যালিডেট করুন

2. `app/admin-handle.php` ফাইলে:
   - save_meta_box() ফাংশনে ইনপুট sanitization যোগ করুন
   - sanitize_text_field() এবং absint() ব্যবহার করুন
   - current_user_can() চেক আরও শক্তিশালী করুন

3. `assets/js/scripts.js` ফাইলে:
   - AJAX রিকোয়েস্টে nonce ভেরিফিকেশন যোগ করুন
   - XSS প্রতিরোধের জন্য সব ডাটা escape করুন

4. নতুন ফাইল তৈরি করুন: `includes/security.php`
   - Input validation helper functions তৈরি করুন
   - Nonce generation এবং verification functions যোগ করুন

মনে রাখবেন: কোড যতটা সম্ভব minimal পরিবর্তন করবেন। শুধু নিরাপত্তা সম্পর্কিত অংশ আপডেট করবেন।
```

---

## ২. Appsero রিমুভ করা

### প্রম্পট:
```
আমার WordPress প্লাগিন থেকে Appsero integration সম্পূর্ণ রিমুভ করুন:

1. `app/appsero` পুরো ফোল্ডার ডিলিট করুন

2. `app/admin-handle.php` ফাইল থেকে:
   - লাইন 75-96 পর্যন্ত Appsero সম্পর্কিত কোড রিমুভ করুন
   - `require_once` এবং `appsero_init_tracker_post_classified_for_docs()` ফাংশন ডিলিট করুন

3. `readme.txt` ফাইল থেকে:
   - Privacy Policy সেকশন (লাইন 53-60) রিমুভ করুন

4. `.distignore` ফাইলে Appsero ফোল্ডার উল্লেখ থাকলে রিমুভ করুন

এটি একটি simple task। শুধু Appsero সম্পর্কিত কোড এবং ফোল্ডার রিমুভ করুন, অন্য কিছু পরিবর্তন করবেন না।
```

---

## ৩. বানান ঠিক করা এবং Naming Convention

### প্রম্পট:
```
প্লাগিনের সব ফাইলে বানান ভুল এবং naming inconsistency ঠিক করুন:

1. সব জায়গায় 'Classfied' কে 'Classified' করুন:
   - init.php (Plugin Name এবং comments)
   - README.md
   - readme.txt
   - সব ফাইলে search এবং replace করুন

2. `app/shortcode.php` তে:
   - `manipulae_atts()` কে `manipulate_atts()` করুন
   - সব জায়গায় function call আপডেট করুন

3. README এবং readme.txt তে:
   - 'Dfault' কে 'Default' করুন

4. `init.php` তে:
   - WPPCD_NAME constant আপডেট করুন
   - 'UltraAddons - Addons Plugin' এর পরিবর্তে 'Post Classified for Docs' ব্যবহার করুন

5. version consistency:
   - init.php তে WPPCD_VERSION '1.2.0' রাখুন (শুধু মেইন ভার্সন)
   - functions.php এ wppcd_get_version() ফাংশন WPPCD_VERSION return করুক

সতর্কতা: শুধু নাম এবং বানান পরিবর্তন করবেন, কোন functionality পরিবর্তন করবেন না।
```

---

## ৪. অ্যাডমিন সেটিংস পেজ যোগ করা

### প্রম্পট:
```
এই WordPress প্লাগিনের জন্য একটি সুন্দর Admin Settings Page তৈরি করুন:

1. নতুন ফাইল তৈরি করুন: `app/admin-settings.php`

2. Settings Page এ নিম্নলিখিত অপশন যোগ করুন:
   - Default Post Type সিলেক্ট করার অপশন
   - Default Taxonomy সিলেক্ট করার অপশন
   - Default Posts Per Page নাম্বার
   - Default Term Link on/off
   - Default Target Blank on/off
   - Custom CSS যোগ করার textarea

3. WordPress Settings API ব্যবহার করুন:
   - register_setting()
   - add_settings_section()
   - add_settings_field()

4. Menu যোগ করুন:
   - Top level menu 'Post Classified' নামে
   - Icon: dashicons-list-view

5. Settings save এবং retrieve করার functions:
   - get_option() ব্যবহার করুন
   - Shortcode এ default value হিসেবে ব্যবহার করুন

6. Admin UI সুন্দর করতে:
   - WordPress admin style ফলো করুন
   - Tabs ব্যবহার করুন বিভিন্ন সেকশনের জন্য
   - Help text এবং descriptions যোগ করুন

7. `init.php` তে নতুন ফাইল include করুন

মনে রাখবেন: WordPress coding standards মেনে চলুন এবং responsive design করুন।
```

---

## ৫. শর্টকোড জেনারেটর/বিল্ডার

### প্রম্পট:
```
Admin Settings Page এ একটি Visual Shortcode Builder যোগ করুন:

1. নতুন Tab তৈরি করুন: "Shortcode Generator"

2. Form fields যোগ করুন:
   - Post Type dropdown (dynamic - সব registered post types)
   - Taxonomy dropdown (selected post type অনুযায়ী dynamic)
   - Term/Category multiselect (AJAX দিয়ে load)
   - Posts Per Page number input
   - Term Link checkbox (on/off)
   - Target Blank checkbox (on/off)
   - Order by Number checkbox (on/off)

3. Live Preview সেকশন:
   - যখন user option সিলেক্ট করবে, real-time shortcode generate হবে
   - Copy to Clipboard বাটন যোগ করুন

4. AJAX functionality:
   - Post Type সিলেক্ট করলে সংশ্লিষ্ট taxonomies load হবে
   - Taxonomy সিলেক্ট করলে terms load হবে

5. Generated Shortcode এর নিচে:
   - Usage instructions দেখান
   - Example output দেখান (optional preview)

6. JavaScript ফাইল তৈরি করুন: `assets/js/admin-shortcode-builder.js`
   - Select2 অথবা Chosen.js ব্যবহার করুন better UX এর জন্য
   - AJAX calls handle করুন

7. CSS ফাইল তৈরি করুন: `assets/css/admin-shortcode-builder.css`
   - Modern এবং clean design
   - Responsive layout

এটি একটি complex feature। ধাপে ধাপে করুন এবং প্রতিটি অংশ test করুন।
```

---

## ৬. পারফরম্যান্স অপটিমাইজেশন

### প্রম্পট:
```
প্লাগিনের performance উন্নত করুন:

1. Conditional Asset Loading (`includes/load-scripts.php`):
   - শুধু যেসব পেজে shortcode আছে সেখানেই CSS/JS load করুন
   - has_shortcode() ফাংশন ব্যবহার করুন
   - Widget area চেক করুন

2. Query Optimization (`app/shortcode.php`):
   - Default posts_per_page -1 এর পরিবর্তে 20 করুন
   - get_posts() ব্যবহার করুন WP_Query এর পরিবর্তে (যদি উপযুক্ত হয়)
   - 'fields' => 'ids' ব্যবহার করুন যেখানে শুধু ID দরকার

3. Caching Implementation:
   - নতুন ফাইল তৈরি করুন: `includes/cache.php`
   - Transient API ব্যবহার করুন
   - Taxonomy list এবং post queries cache করুন (12 ঘন্টার জন্য)
   - Cache clear করার function যোগ করুন (post save/update এ)

4. Database Optimization:
   - Index যোগ করুন meta_key এ (যদি প্রয়োজন হয়)
   - Unnecessary queries কমান

5. JavaScript Optimization:
   - console.log() রিমুভ করুন production version থেকে
   - Minify করুন JavaScript এবং CSS
   - wp-scripts build command ব্যবহার করুন

6. Lazy Loading:
   - বড় লিস্টের জন্য pagination যোগ করুন
   - AJAX load more functionality (optional)

Performance testing করুন Query Monitor plugin দিয়ে। সব পরিবর্তন backward compatible রাখুন।
```

---

## ৭. Internationalization (i18n) উন্নতি

### প্রম্পট:
```
প্লাগিনকে সম্পূর্ণ translation-ready করুন:

1. সব ফাইল চেক করুন এবং hardcoded text গুলো translatable করুন:
   - __(), _e(), _n(), _x() ফাংশন ব্যবহার করুন
   - Text domain 'wppcd' সব জায়গায় সঠিকভাবে ব্যবহার করুন

2. POT ফাইল generate করুন:
   - `wp i18n make-pot` command ব্যবহার করুন
   - languages/wppcd.pot ফাইল তৈরি করুন

3. বাংলা ভাষার translation যোগ করুন:
   - languages/wppcd-bn_BD.po এবং .mo ফাইল তৈরি করুন
   - সব string বাংলায় translate করুন

4. `init.php` তে text domain load করুন:
   - load_plugin_textdomain() ফাংশন যোগ করুন
   - plugins_loaded hook ব্যবহার করুন

5. JavaScript strings translatable করুন:
   - wp_localize_script() ব্যবহার করুন
   - wp_set_script_translations() ব্যবহার করুন (if needed)

6. README.md এ multi-language support উল্লেখ করুন

Translation ready করার সময় কোন functionality break করবেন না।
```

---

## ৮. নতুন ফিচার যোগ করা

### প্রম্পট:
```
প্লাগিনে নিম্নলিখিত user-friendly features যোগ করুন:

1. **Custom Templates Support:**
   - নতুন ফোল্ডার তৈরি করুন: `templates/`
   - বিভিন্ন layout template তৈরি করুন (list, grid, accordion)
   - Shortcode attribute যোগ করুন: template='list|grid|accordion'
   - Theme থেকে template override করার সুবিধা

2. **Search এবং Filter:**
   - Post list এ search box যোগ করার অপশন
   - AJAX live search implement করুন
   - Shortcode attribute: search='on|off'

3. **Pagination:**
   - বড় লিস্টের জন্য pagination যোগ করুন
   - AJAX pagination support
   - Shortcode attribute: pagination='on|off'

4. **Excerpt Support:**
   - Post title এর সাথে excerpt দেখানোর অপশন
   - Shortcode attribute: show_excerpt='on|off', excerpt_length='20'

5. **Featured Image Support:**
   - Thumbnail দেখানোর অপশন
   - Shortcode attribute: show_image='on|off', image_size='thumbnail|medium'

6. **Custom Ordering:**
   - More ordering options (date, title, random)
   - Shortcode attribute: order='ASC|DESC', orderby='date|title|random'

7. **Widget Support:**
   - WordPress widget তৈরি করুন
   - Visual interface দিয়ে সব option কনফিগার করার সুবিধা

8. **Gutenberg Block:**
   - React দিয়ে modern block তৈরি করুন
   - InspectorControls এ সব setting যোগ করুন
   - Live preview support

প্রতিটি feature আলাদা আলাদা করে যোগ করুন। প্রতিটি feature add করার পর test করুন।
```

---

## ৯. Documentation এবং Help System

### প্রম্পট:
```
Complete documentation system তৈরি করুন:

1. **User Guide তৈরি করুন:**
   - `help-doc/user-guide.md` ফাইল তৈরি করুন
   - Installation steps
   - Basic usage examples
   - Shortcode attributes এর বিস্তারিত বর্ণনা
   - Screenshot সহ step-by-step tutorial

2. **Developer Documentation:**
   - `help-doc/developer-guide.md` তৈরি করুন
   - Available hooks এবং filters
   - Code examples
   - Template override guide
   - Custom post type integration

3. **FAQ Page:**
   - `help-doc/faq.md` তৈরি করুন
   - সাধারণ প্রশ্ন এবং উত্তর
   - Troubleshooting guide

4. **Video Tutorial:**
   - Tutorial video এর script তৈরি করুন
   - `help-doc/video-script.md`

5. **README.md Update:**
   - আরও বিস্তারিত example যোগ করুন
   - Feature list update করুন
   - Screenshots এর reference যোগ করুন
   - Changelog সঠিকভাবে maintain করুন

6. **Inline Help:**
   - Admin settings page এ contextual help যোগ করুন
   - Tooltips এবং help icons
   - Link to documentation

7. **PHPDoc Comments:**
   - সব function, class, এবং method এ proper PHPDoc যোগ করুন
   - @param, @return, @since tags ব্যবহার করুন

Documentation বাংলা এবং ইংরেজি উভয় ভাষায় তৈরি করুন।
```

---

## ১০. Testing এবং Quality Assurance

### প্রম্পট:
```
Complete testing system implement করুন:

1. **Unit Tests তৈরি করুন:**
   - PHPUnit setup করুন
   - `tests/` ফোল্ডার তৈরি করুন
   - Core functions এর test cases লিখুন
   - Test shortcode output
   - Test admin functionality

2. **Integration Tests:**
   - Different post types এ test করুন
   - Different themes এ test করুন
   - Other plugins এর সাথে compatibility test

3. **WordPress Coding Standards:**
   - PHPCS setup করুন
   - WordPress-Core ruleset ব্যবহার করুন
   - সব coding standard issues fix করুন

4. **Code Quality Tools:**
   - PHPStan অথবা Psalm setup করুন
   - Static analysis run করুন
   - Issues fix করুন

5. **Performance Testing:**
   - Query Monitor দিয়ে test করুন
   - Large dataset এ performance check করুন
   - Optimization করুন যদি প্রয়োজন হয়

6. **Accessibility Testing:**
   - WCAG 2.1 compliance check করুন
   - Screen reader test করুন
   - Keyboard navigation test করুন

7. **Browser Testing:**
   - Chrome, Firefox, Safari, Edge এ test করুন
   - Mobile browsers এ test করুন
   - Responsive design verify করুন

8. **Automated Testing:**
   - GitHub Actions setup করুন
   - Automated testing workflow তৈরি করুন
   - PR এর সময় automatic test run করুন

Testing এর জন্য proper documentation তৈরি করুন যাতে অন্যরা test run করতে পারে।
```

---

## ১১. প্লাগিন নাম এবং Branding

### প্রম্পট:
```
প্লাগিনের নাম এবং branding উন্নত করুন:

বর্তমান নাম: "Post Classfied for making Documentation, Site map, POST List"

এই নামের সমস্যা:
- খুব লম্বা
- "Classfied" বানান ভুল
- Professional মনে হয় না
- SEO friendly নয়

**পরামর্শকৃত নতুন নাম:**

1. **DocMaker - Documentation & Post List Builder** 
   - ছোট এবং catchy
   - Purpose clear
   - Professional

2. **Post Navigator - Smart Documentation Tool**
   - Navigate করার concept
   - Documentation focus

3. **TaxoList - Taxonomy-Based Post Display**
   - Technical কিন্তু clear
   - Main feature highlight

4. **WP Post Classifier** (সহজ এবং সরল)
   - WordPress এর সাথে সম্পর্ক clear
   - Main functionality বোঝা যায়

5. **SmartDocs - Organized Post Display**
   - Modern নাম
   - User benefit clear

**কাজ করতে হবে:**

1. নতুন নাম select করুন (অথবা উপরের কোনো একটি)

2. সব ফাইলে নাম update করুন:
   - init.php (Plugin Name)
   - README.md
   - readme.txt
   - package.json
   - All constants এবং comments

3. Logo/Icon তৈরি করুন:
   - Plugin icon (256x256 px)
   - Banner (1544x500 px) WordPress.org এর জন্য

4. Tagline তৈরি করুন:
   - Catchy one-liner যা plugin এর কাজ বোঝায়
   - Example: "Organize your posts beautifully with smart taxonomy-based lists"

5. README আকর্ষণীয় করুন:
   - Clear feature list
   - Use cases
   - Before/After examples
   - Video demo link

নাম পরিবর্তন করার পর consistency maintain করুন সব জায়গায়।
```

---

## ১২. User Experience (UX) উন্নতি

### প্রম্পট:
```
Plugin এর user experience dramatically উন্নত করুন:

1. **First-Time User Experience:**
   - Welcome screen তৈরি করুন plugin activation এ
   - Quick start guide দেখান
   - Sample shortcode দিয়ে demo page তৈরির offer করুন
   - Video tutorial link যোগ করুন

2. **Admin Dashboard Widget:**
   - WordPress dashboard এ একটি widget যোগ করুন
   - Quick statistics দেখান (কতগুলো page এ shortcode ব্যবহৃত)
   - Quick shortcode generator link
   - Recent changes/updates দেখান

3. **Visual Feedback:**
   - Success/Error messages সুন্দর করুন
   - Loading states যোগ করুন
   - Progress indicators যোগ করুন long operations এ

4. **Smart Defaults:**
   - Most commonly used settings auto-detect করুন
   - User এর previous choices remember করুন
   - Intelligent suggestions দিন

5. **Contextual Help:**
   - প্রতিটি setting এ tooltip যোগ করুন
   - "?" icon দিয়ে help text দেখান
   - Related documentation এর link দিন

6. **Error Handling:**
   - User-friendly error messages
   - Suggest solutions যখন কিছু ভুল হয়
   - Debug mode যোগ করুন developers এর জন্য

7. **Export/Import Settings:**
   - Settings export করার option
   - Settings import করার option
   - Backup/Restore functionality

8. **Live Preview:**
   - Settings change করার সময় live preview দেখান
   - Shortcode output এর preview

User testing করুন non-technical users দিয়ে এবং feedback নিন।
```

---

## নোট এবং সতর্কতা

### কোড পরিবর্তনের সময় মনে রাখুন:

1. **Backward Compatibility:** পুরাতন shortcode এবং settings যেন কাজ করে
2. **WordPress Standards:** WordPress Coding Standards মেনে চলুন
3. **Security First:** সব ইনপুট sanitize এবং validate করুন
4. **Performance:** অপ্রয়োজনীয় query এবং operations এড়িয়ে চলুন
5. **Documentation:** প্রতিটি পরিবর্তন document করুন
6. **Testing:** পরিবর্তনের পর অবশ্যই test করুন
7. **Version Control:** ছোট ছোট commits করুন clear message সহ

### প্রম্পট ব্যবহারের পদ্ধতি:

1. একটি সময়ে একটি সেকশন নিয়ে কাজ করুন
2. প্রতিটি task complete হওয়ার পর test করুন
3. কোন issue হলে আগের state এ roll back করুন
4. সব পরিবর্তন git এ commit করুন
5. Pull request তৈরি করুন review এর জন্য

---

## শেষ কথা

এই প্রম্পটগুলো ব্যবহার করে আপনি ধাপে ধাপে প্লাগিনটিকে একটি professional এবং feature-rich সফটওয়্যারে পরিণত করতে পারবেন। প্রতিটি improvement independent, তাই আপনি যেকোনো order এ করতে পারেন। তবে Security এবং Bug fixes first priority হওয়া উচিত।

যেকোনো সমস্যা বা প্রশ্ন থাকলে প্রম্পটে বিস্তারিত বর্ণনা দিন এবং আপনার requirement clear করে বলুন। AI/Developer আপনাকে সাহায্য করতে পারবে।

শুভকামনা! 🚀
