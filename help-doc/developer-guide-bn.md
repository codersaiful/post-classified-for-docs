# BizzDocMaker - ডেভেলোপার ডকুমেন্টেশন

## প্লাগিন পরিচিতি

BizzDocMaker হলো একটি আধুনিক WordPress প্লাগিন যা ডকুমেন্টেশন, সাইটম্যাপ এবং সুসংগঠিত পোস্ট লিস্ট তৈরি করতে সাহায্য করে।

## ফাইল স্ট্রাকচার

```
post-classified-for-docs/
├── src/                      # মূল সোর্স কোড
│   ├── Admin/               # অ্যাডমিন সংক্রান্ত ক্লাস
│   │   ├── Settings.php     # সেটিংস পেজ
│   │   ├── MetaBox.php      # মেটা বক্স হ্যান্ডলার
│   │   ├── Dashboard.php    # ড্যাশবোর্ড উইজেট
│   │   └── Welcome.php      # স্বাগত পেজ
│   ├── Frontend/            # ফ্রন্টএন্ড সংক্রান্ত ক্লাস
│   │   ├── Shortcode.php    # শর্টকোড হ্যান্ডলার
│   │   └── Assets.php       # CSS/JS লোডার
│   ├── Core/                # মূল কার্যক্রম
│   │   └── PostTypes.php    # কাস্টম পোস্ট টাইপ
│   ├── Autoloader.php       # PSR-4 অটোলোডার
│   └── Plugin.php           # মূল প্লাগিন ক্লাস
├── templates/               # ডিসপ্লে টেমপ্লেট
│   ├── list/               # লিস্ট টেমপ্লেট
│   ├── grid/               # গ্রিড টেমপ্লেট
│   ├── accordion/          # অ্যাকর্ডিয়ন টেমপ্লেট
│   └── table/              # টেবিল টেমপ্লেট
├── assets/                  # স্ট্যাটিক ফাইল
│   ├── css/                # স্টাইলশীট
│   └── js/                 # জাভাস্ক্রিপ্ট
├── help-doc/               # ডেভেলোপার ডকুমেন্টেশন
├── init.php                # প্লাগিন প্রবেশদ্বার
└── readme.txt              # WordPress রিডমি
```

## প্রযুক্তিগত বিবরণ

### নেমস্পেস

প্লাগিনটি `BizzDocMaker` নেমস্পেস ব্যবহার করে। সকল ক্লাস PSR-4 অটোলোডিং স্ট্যান্ডার্ড অনুসরণ করে।

### অটোলোডিং

```php
// PSR-4 Autoloader
$autoloader = new BizzDocMaker\Autoloader( __DIR__ . '/src' );
$autoloader->register();
```

### প্লাগিন ইনিশিয়ালাইজেশন

```php
// Singleton Pattern
$plugin = BizzDocMaker\Plugin::instance();
```

## কোডিং স্ট্যান্ডার্ড

### নামকরণ নিয়ম

1. **ক্লাস**: PascalCase (উদাহরণ: `MetaBox`, `Shortcode`)
2. **মেথড**: camelCase (উদাহরণ: `renderTemplate`, `saveMetaBox`)
3. **ভেরিয়েবল**: snake_case (উদাহরণ: `$post_type`, `$term_name`)
4. **কনস্ট্যান্ট**: UPPER_SNAKE_CASE (উদাহরণ: `BIZZDOCMAKER_VERSION`)

### ডকুমেন্টেশন

প্রতিটি ক্লাস এবং মেথডে PHPDoc ব্লক থাকা বাধ্যতামূলক:

```php
/**
 * Short description
 *
 * Long description if needed
 *
 * @since 2.0.0
 * @param type $param Description
 * @return type Description
 */
```

### সিকিউরিটি

1. **Nonce Verification**: সকল ফর্ম সাবমিশনে
2. **Capability Check**: অ্যাডমিন অ্যাকশনে
3. **Sanitization**: ইনপুট ডেটায়
4. **Escaping**: আউটপুট ডেটায়

```php
// Input sanitization
$value = sanitize_text_field( $_POST['field'] );

// Output escaping
echo esc_html( $value );
echo esc_url( $url );
echo esc_attr( $attribute );
```

## হুক এবং ফিল্টার

### অ্যাকশন হুক

```php
// প্লাগিন লোড হওয়ার পর
do_action( 'bizzdocmaker_loaded' );

// স্টাইল যোগ করতে
do_action( 'bizzdocmaker_enqueue_styles' );

// স্ক্রিপ্ট যোগ করতে
do_action( 'bizzdocmaker_enqueue_scripts' );
```

### ফিল্টার হুক

```php
// কোয়েরি আর্গুমেন্ট পরিবর্তন
$args = apply_filters( 'bizzdocmaker_query_args', $args, $taxonomy_id, $atts );

// মেটা বক্স পোস্ট টাইপ পরিবর্তন
$post_types = apply_filters( 'bizzdocmaker_meta_box_post_types', $post_types );
```

## টেমপ্লেট ওভাররাইড

থিম থেকে টেমপ্লেট ওভাররাইড করার পদ্ধতি:

1. থিম ডিরেক্টরিতে `bizzdocmaker` ফোল্ডার তৈরি করুন
2. টেমপ্লেট ফাইল কপি করুন:
   ```
   your-theme/
   └── bizzdocmaker/
       └── list/
           └── template.php
   ```
3. প্রয়োজন অনুযায়ী টেমপ্লেট পরিবর্তন করুন

## শর্টকোড ব্যবহার

### বেসিক উদাহরণ

```
[bizzdocmaker]
```

### অ্যাট্রিবিউট সহ

```
[bizzdocmaker template="grid" columns="3" post_type="post" term_name="category"]
```

### সকল অ্যাট্রিবিউট

- `template`: লিস্ট টাইপ (list, grid, accordion, table)
- `post_type`: পোস্ট টাইপ (পূর্বনির্ধারিত: post)
- `term_name`: ট্যাক্সোনমি নাম (পূর্বনির্ধারিত: category)
- `taxs`: ট্যাক্সোনমি আইডি (কমা দিয়ে আলাদা)
- `posts_per_page`: পোস্ট সংখ্যা (-1 সবগুলোর জন্য)
- `term_link`: ট্যাক্সোনমি লিংক (on/off)
- `_blank`: নতুন ট্যাবে খুলুন (on/off)
- `order_by_number`: কাস্টম অর্ডারিং (on/off)
- `show_count`: পোস্ট সংখ্যা দেখান (on/off)
- `show_description`: বর্ণনা দেখান (on/off)
- `columns`: গ্রিডে কলাম সংখ্যা (1-4)

## ডাটাবেস

### মেটা কী

- `bizzdocmaker_post_order`: পোস্ট অর্ডার নম্বর সংরক্ষণ করে

### অপশন কী

- `bizzdocmaker_options`: প্লাগিন সেটিংস সংরক্ষণ করে

## পারফরম্যান্স অপটিমাইজেশন

1. **ক্যাশিং**: ট্রানজিয়েন্ট API ব্যবহার করুন
2. **লেজি লোডিং**: ইমেজের জন্য
3. **মিনিফিকেশন**: CSS/JS ফাইলের
4. **কোয়েরি অপটিমাইজেশন**: শুধু প্রয়োজনীয় ডেটা নিন

```php
// Transient caching example
$cache_key = 'bizzdocmaker_posts_' . $taxonomy_id;
$posts = get_transient( $cache_key );

if ( false === $posts ) {
    $posts = new WP_Query( $args );
    set_transient( $cache_key, $posts, HOUR_IN_SECONDS );
}
```

## টেস্টিং

### ইউনিট টেস্ট

```php
// Example test
public function test_shortcode_render() {
    $shortcode = new BizzDocMaker\Frontend\Shortcode();
    $output = $shortcode->render( array() );
    
    $this->assertNotEmpty( $output );
    $this->assertStringContainsString( 'bizzdocmaker-wrapper', $output );
}
```

## ডিবাগিং

### ডিবাগ মোড চালু করুন

```php
// wp-config.php এ যোগ করুন
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

### লগিং

```php
// লগ করার জন্য
error_log( 'BizzDocMaker: ' . print_r( $data, true ) );
```

## কন্ট্রিবিউশন গাইডলাইন

1. **কোড স্ট্যান্ডার্ড**: WordPress Coding Standards অনুসরণ করুন
2. **কমিট মেসেজ**: স্পষ্ট এবং বর্ণনামূলক
3. **ব্রাঞ্চিং**: feature/feature-name ফরম্যাট ব্যবহার করুন
4. **পুল রিকোয়েস্ট**: পরিষ্কার বর্ণনা সহ
5. **টেস্টিং**: নতুন ফিচারের জন্য টেস্ট যোগ করুন

## সাপোর্ট

সমস্যা বা প্রশ্নের জন্য:

- GitHub Issues: https://github.com/codersaiful/post-classified-for-docs/issues
- WordPress Support: https://wordpress.org/support/plugin/post-classified-for-docs/

## লাইসেন্স

GPL v2 or later - https://www.gnu.org/licenses/gpl-2.0.html

## চেঞ্জলগ

### সংস্করণ 2.0.0
- সম্পূর্ণ রিফ্যাক্টরিং
- PSR-4 অটোলোডিং যোগ
- নতুন টেমপ্লেট সিস্টেম
- উন্নত সিকিউরিটি
- পারফরম্যান্স উন্নতি

---

**তৈরি করেছেন:** Saiful Islam
**সর্বশেষ আপডেট:** 2024-11-11
