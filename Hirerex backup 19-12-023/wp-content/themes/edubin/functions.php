<?php
/**
 *
 * Edubin functions and definitions
 * @package Edubin
 *
 */

define('EDUBIN_DIR', trailingslashit(get_template_directory()));
define('EDUBIN_URI', trailingslashit(get_template_directory_uri()));
define('EDUBIN_THEME_VERSION', '8.12.18');
/**
 * Edubin only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/include/back-compat.php';
    return;
}

//Sets up theme defaults and registers support for various WordPress features.
function edubin_setup()
{

    //Make theme available for translation.
    load_theme_textdomain('edubin', get_template_directory() . '/languages');
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    //Let WordPress manage the document title.
    add_theme_support('title-tag');

    //Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_image_size('edubin-featured-image', 1450, 480, true);
    add_image_size('edubin-blog-image', 1140, 710, true);
    add_image_size('edubin-thumbnail-avatar', 100, 100, true);
    add_image_size('edubin_blog_image_360x210', 360, 210, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'primary'     => esc_html__('Primary Menu', 'edubin'),
        'footer_menu' => esc_html__('Footer Menu', 'edubin'),
    ));

    //Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Enable support for Post Formats.
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Enqueue editor styles.
    add_editor_style('style-editor.css');

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
     */
    add_editor_style(array('assets/css/editor-style.css', edubin_get_font_url()));

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add theme support for Custom Background.
    $args = array(
        'default-color' => '#ffffff',
        'default-image' => '',
    );

    add_theme_support('custom-background', $args);

    $args = array(
        'width'              => 1450,
        'flex-height'        => true,
        'flex-width'         => true,
        'height'             => 480,
        'default-text-color' => '',
        'default-image'      => get_template_directory_uri() . '/assets/images/header.jpg',
        'wp-head-callback'   => 'edubin_header_style',
    );
    register_default_headers(array(
        'default-image' => array(
            'url'           => '%s/assets/images/header.jpg',
            'thumbnail_url' => '%s/assets/images/header.jpg',
            'description'   => esc_html__('Default Header Image', 'edubin'),
        ),
    ));
    add_theme_support('custom-header', $args);
}

add_action('after_setup_theme', 'edubin_setup');

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Edubin 5.0.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function edubin_get_font_url()
{
    $fonts_url = '';
    $subsets   = 'latin';
    $defaults  = edubin_generate_defaults();

    /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'.
     * Do not translate into your own language.
     */
    $bodyFont = json_decode(get_theme_mod('edubin_body_text_font', $defaults['edubin_body_text_font']), true);

    /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'.
     * Do not translate into your own language.
     */
    $headerFont = json_decode(get_theme_mod('edubin_heading_font', $defaults['edubin_heading_font']), true);

    /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'.
     * Do not translate into your own language.
     */
    $menuFont = json_decode(get_theme_mod('edubin_menu_text_font', $defaults['edubin_menu_text_font']), true);

    /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'.
     * Do not translate into your own language.
     */
    $submenuFont = json_decode(get_theme_mod('edubin_sub_menu_text_font', $defaults['edubin_sub_menu_text_font']), true);

    if ('off' !== $bodyFont || 'off' !== $headerFont || 'off' !== $menuFont || 'off' !== $submenuFont) {
        $font_families = array();

        if ('off' !== $bodyFont) {
            $font_families[] = $bodyFont['font'] . ':' . ',' . $bodyFont['boldweight'];
        }

        if ('off' !== $headerFont) {
            $font_families[] = $headerFont['font'] . ':' . ',' . $headerFont['boldweight'];
        }

        if ('off' !== $menuFont) {
            $font_families[] = $menuFont['font'] . ':' . ',' . $menuFont['boldweight'];
        }

        if ('off' !== $submenuFont) {
            $font_families[] = $submenuFont['font'] . ':' . ',' . $submenuFont['boldweight'];
        }

        $query_args = array(
            'family'  => urlencode(implode('|', $font_families)),
            'subset'  => urlencode($subsets),
            'display' => urlencode('fallback'),
        );
        $fonts_url = add_query_arg($query_args, "https://fonts.googleapis.com/css");
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Edubin 5.0.0
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function edubin_resource_hints($urls, $relation_type)
{
    if (wp_style_is('edubin-fonts', 'queue') && 'preconnect' === $relation_type) {
        if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '>=')) {
            $urls[] = array(
                'href' => 'https://fonts.gstatic.com',
                'crossorigin',
            );
        } else {
            $urls[] = 'https://fonts.gstatic.com';
        }
    }

    return $urls;
}
add_filter('wp_resource_hints', 'edubin_resource_hints', 10, 2);

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses edubin_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Edubin 5.0.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function edubin_mce_css($mce_css)
{
    $font_url = edubin_get_font_url();

    if (empty($font_url)) {
        return $mce_css;
    }

    if (!empty($mce_css)) {
        $mce_css .= ',';
    }

    $mce_css .= esc_url_raw(str_replace(',', '%2C', $font_url));

    return $mce_css;
}
add_filter('mce_css', 'edubin_mce_css');

/**
 * Output our Customizer styles in the site header
 *
 * @since Ephemeris 1.0
 *
 * @return string    css styles
 */
function edubin_customizer_css_styles()
{
    $defaults    = edubin_generate_defaults();
    $styles      = '';
    $bodyFont    = json_decode(get_theme_mod('edubin_body_text_font', $defaults['edubin_body_text_font']), true);
    $headerFont  = json_decode(get_theme_mod('edubin_heading_font', $defaults['edubin_heading_font']), true);
    $menuFont    = json_decode(get_theme_mod('edubin_menu_text_font', $defaults['edubin_menu_text_font']), true);
    $submenuFont = json_decode(get_theme_mod('edubin_sub_menu_text_font', $defaults['edubin_sub_menu_text_font']), true);

    // Header styles
    $styles .= "h1, h2, h3, h4, h5, h6, .widget .widget-title, .learnpress .lp-single-course .widget-title, .tribe-common--breakpoint-medium.tribe-common .tribe-common-h6--min-medium { font-family: '" . $headerFont['font'] . "'," . $headerFont["category"] . "; font-weight: " . $headerFont['boldweight'] . ";}";

    // Body Text styles
    $styles .= "body p,
button,
.tutor-lead-info-btn-group a.tutor-button,
.tutor-lead-info-btn-group .tutor-course-complete-form-wrap button,
.tutor-lead-info-btn-group .tutor-button.tutor-success,
.tutor-course-enrolled-review-wrap .write-course-review-link-btn,
.tutor-login-form-wrap input[type='submit'],
a.tutor-profile-photo-upload-btn,
.tutor-course-loop-meta>div span,
.tutor-course-filter-wrap,
.tutor-loop-rating-wrap,
.tutor-loop-course-footer,
.tutor-loop-author,
.tutor-price-preview-box,
.tutor-container,
.breadcrumbs,
.widget-area,
.entry-content ul,
.nav-links,
select,
option,
.header-top,
.site-footer .edubin-quickinfo,
button.tutor-profile-photo-upload-btn,
.woocommerce .woocommerce-error .button,
.woocommerce .woocommerce-info .button,
.woocommerce .woocommerce-message .button,
.woocommerce div.product form.cart .button,
.woocommerce ul.products li.product a,
a.button.wc-backward,
.woocommerce-cart .wc-proceed-to-checkout,
div.wpforms-container-full .wpforms-form input[type=submit],
div.wpforms-container-full .wpforms-form button[type=submit],
div.wpforms-container-full .wpforms-form .wpforms-page-button,
.edubin-main-btn,
.edubin-main-btn a,
.single_add_to_cart_button,
a.tutor-button,
.tutor-button,
a.tutor-btn,
.tutor-btn,
.tribe-common .tribe-common-c-btn,
.tribe-common a.tribe-common-c-btn,
#rtec .rtec-register-button,
#rtec input[type='submit'],
.learnpress.course-item-popup #course-item-content-header .form-button.lp-button-back button { font-family: '" . $bodyFont['font'] . "'," . $bodyFont["category"] . "; font-weight: " . $bodyFont['boldweight'] . ";}";

    // Menu Text styles
    $styles .= ".main-navigation a { font-family: '" . $menuFont['font'] . "'," . $menuFont["category"] . "; font-weight: " . $menuFont['boldweight'] . ";}";

    // Sub menu Text styles
    $styles .= ".main-navigation ul ul a { font-family: '" . $submenuFont['font'] . "'," . $submenuFont["category"] . "; font-weight: " . $submenuFont['boldweight'] . ";}";

    echo '<style type="text/css">' . $styles . '</style>';
}
add_action('wp_head', 'edubin_customizer_css_styles');

/**
 * Register widget areas.
 */
function edubin_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'edubin'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Header Top', 'edubin'),
        'id'            => 'header-top',
        'description'   => esc_html__('Add widgets here to appear in your header top area.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title d-none">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'edubin'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'edubin'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'edubin'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 4', 'edubin'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Copyright 1', 'edubin'),
        'id'            => 'copyright',
        'description'   => esc_html__('Add widgets here to appear in your footer copyright.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Copyright 2', 'edubin'),
        'id'            => 'copyright_2',
        'description'   => esc_html__('Add widgets here to appear in your footer copyright right side.', 'edubin'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Tutor login before
    if (function_exists('tutor')) {

        //Tuotr other sidebar
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS Login From Before', 'edubin'),
            'id'            => 'edubin-tutor-login-form-before-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS login pages from before section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));
        // Tutor login after
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS Login From After', 'edubin'),
            'id'            => 'edubin-tutor-login-form-after-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS login pages from after section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));

        // Tutor student register  before
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS Student Register From Before', 'edubin'),
            'id'            => 'edubin-tutor-student-reg-form-before-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS register pages from before section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));

        // Tutor student register after
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS Student Register From After', 'edubin'),
            'id'            => 'edubin-tutor-student-reg-form-after-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS register pages from after section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));

        // Tutor instructor register  before
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS Instructor Register From Before', 'edubin'),
            'id'            => 'edubin-tutor-instructor-reg-form-before-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS instructor register pages from before section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));

        // Tutor instructor register after
        register_sidebar(array(
            'name'          => esc_html__('Tutor LMS instructor Register From After', 'edubin'),
            'id'            => 'edubin-tutor-instructor-reg-form-after-widget',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor LMS register pages from after section.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title edubin-wtb-hide">',
            'after_title'   => '</h2>',
        ));
    }
    // LearnPress
    if (class_exists('LearnPress')) {
        register_sidebar(array(
            'name'          => esc_html__('LearnPress Archive Page', 'edubin'),
            'id'            => 'lp-course-sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnPress course archive pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget edubin-lp-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="lp-course-widget-title widget-title">',
            'after_title'   => '</h2>',
        ));
        register_sidebar(array(
            'name'          => esc_html__('LearnPress Single Page', 'edubin'),
            'id'            => 'lp-course-sidebar-2',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnPress course details pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget edubin-lp-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="lp-course-widget-title widget-title">',
            'after_title'   => '</h2>',
        ));
    }
    // LearnDash
    if (class_exists('SFWD_LMS')) {
        register_sidebar(array(
            'name'          => esc_html__('LearnDash Single Right', 'edubin'),
            'id'            => 'ld-course-sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnDash course details pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget edubin-ld-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'edubin_widgets_init');

function edubin_tribe_events_widgets_init()
{
    // The Events Calender
    if (class_exists('Tribe__Events__Main')) {
        register_sidebar(array(
            'name'          => esc_html__('The Events Calendar Single', 'edubin'),
            'id'            => 'tribe_event_sidebar',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on The Events Calendar details pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'edubin_tribe_events_widgets_init');

function edubin_woocommerce_widgets_init()
{
    // WooCommerce

    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Shop Page', 'edubin'),
            'id'            => 'woocommerce_shop_page_sidebar',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on shop page pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Shop Page Top', 'edubin'),
            'id'            => 'woocommerce_shop_page_top_sidebar',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on shop page top pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Single Page Top', 'edubin'),
            'id'            => 'woocommerce_product_page_top_sidebar',
            'description'   => esc_html__('Add widgets here to appear in your sidebar on woocommerce shop product details page top pages.', 'edubin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'edubin_woocommerce_widgets_init');

/**
 * Change the excerpt length
 */
function edubin_excerpt_length($length)
{
    $excerpt = get_theme_mod('exc_lenght', '45');
    return $excerpt;
}
add_filter('excerpt_length', 'edubin_excerpt_length', 999);

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function edubin_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'edubin_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function edubin_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
    }
}
add_action('wp_head', 'edubin_pingback_header');

/**
 * Enqueue scripts and styles.
 */
function edubin_scripts()
{

    global $wp_styles;

    $defaults               = edubin_generate_defaults();
    $rtl_enable             = get_theme_mod('rtl_enable', $defaults['rtl_enable']);
    $header_variations      = get_theme_mod('header_variations', $defaults['header_variations']);
    $tutor_settings_color   = get_theme_mod('tutor_settings_color', $defaults['tutor_settings_color']);
    $load_bootstrap_css     = get_theme_mod('load_bootstrap_css', $defaults['load_bootstrap_css']);
    $load_bootstrap_rtl_css = get_theme_mod('load_bootstrap_rtl_css', $defaults['load_bootstrap_rtl_css']);
    $load_fontawesome_css   = get_theme_mod('load_fontawesome_css', $defaults['load_fontawesome_css']);
    $load_owl_carousel_css  = get_theme_mod('load_owl_carousel_css', $defaults['load_owl_carousel_css']);
    $load_animate_css       = get_theme_mod('load_animate_css', $defaults['load_animate_css']);
    $load_bootstrap_js      = get_theme_mod('load_bootstrap_js', $defaults['load_bootstrap_js']);
    $load_owl_carousel_js   = get_theme_mod('load_owl_carousel_js', $defaults['load_owl_carousel_js']);
    // Theme stylesheet.
    wp_enqueue_style('edubin-style', get_stylesheet_uri());
    // Theme block stylesheet.
    wp_enqueue_style('edubin-block-style', get_template_directory_uri() . '/assets/css/blocks.css', array('edubin-style'), EDUBIN_THEME_VERSION);
    if (is_rtl() && $rtl_enable == true && $load_bootstrap_rtl_css) {
        wp_enqueue_style('bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap-rtl.min.css');
    }
    if ($load_bootstrap_css) {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0');
    }
    if ($load_fontawesome_css) {
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css', '5.9.0');
    }
    wp_enqueue_style('edubin-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon.css', EDUBIN_THEME_VERSION);
    if ($load_owl_carousel_css) {
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '2.3.4');
    }
    if ($load_animate_css) {
        wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', '3.7.0');
    }
    if (class_exists('LearnPress')):
        $get_lp_plugin_dir        = WP_PLUGIN_DIR . '/learnpress/learnpress.php';
        $lp_plugin_version_number = get_plugin_data($get_lp_plugin_dir);

        if ($lp_plugin_version_number['Version'] < '4.0.0'):
            wp_enqueue_style('edubin-learnpress', get_template_directory_uri() . '/assets/css/learnpress.css', array(), EDUBIN_THEME_VERSION);
        endif;

        if ($lp_plugin_version_number['Version'] > '4.0.0'):
            wp_enqueue_style('edubin-learnpress-v4', get_template_directory_uri() . '/assets/css/learnpress-v4.css', array(), EDUBIN_THEME_VERSION);

            wp_enqueue_style('edubin-learnpress-color', get_template_directory_uri() . '/assets/css/learnpress-color.css', array(), EDUBIN_THEME_VERSION);

        endif;

    endif;
    if (class_exists('SFWD_LMS')):
        wp_enqueue_style('edubin-learndash', get_template_directory_uri() . '/assets/css/learndash.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (function_exists('tutor')):
        wp_enqueue_style('edubin-tutor', get_template_directory_uri() . '/assets/css/tutor.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (function_exists('tutor') && !$tutor_settings_color):
        wp_enqueue_style('edubin-tutor-color', get_template_directory_uri() . '/assets/css/tutor-color.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('Tribe__Events__Main')):
        wp_enqueue_style('edubin-events', get_template_directory_uri() . '/assets/css/events.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('Tribe__Events__Filterbar__PUE')):
        wp_enqueue_style('edubin-events-filterbar', get_template_directory_uri() . '/assets/css/filterbar.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('WPForms')):
        wp_enqueue_style('edubin-wpforms', get_template_directory_uri() . '/assets/css/wpforms.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists( 'WPCF7_ContactForm' )):
        wp_enqueue_style('edubin-wpcf7', get_template_directory_uri() . '/assets/css/wpcf7.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('UM')):
        wp_enqueue_style('edubin-ultimate-member', get_template_directory_uri() . '/assets/css/ulm.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('Mega_Menu') && $header_variations == 'header_v3'):
        wp_enqueue_style('edubin-max-mega-menu', get_template_directory_uri() . '/assets/css/max-menu.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('Video_Conferencing_With_Zoom')):
        wp_enqueue_style('edubin-zoom-conferencing', get_template_directory_uri() . '/assets/css/zoom.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('WooCommerce')):
        wp_enqueue_style('edubin-woocommerce', get_template_directory_uri() . '/assets/css/wc.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('BuddyPress')):
        wp_enqueue_style('edubin-buddypress', get_template_directory_uri() . '/assets/css/buddypress.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists('bbPress')):
        wp_enqueue_style('edubin-bbpress', get_template_directory_uri() . '/assets/css/bbpress.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists( 'PMPro_Membership_Level' )) :
        wp_enqueue_style('edubin-paid-membership', get_template_directory_uri() . '/assets/css/pmp.css', array(), EDUBIN_THEME_VERSION);
    endif;
    if (class_exists( 'Edubin_Shortcode_Social' )) :
        wp_enqueue_style('edubin-core', get_template_directory_uri() . '/assets/css/edubin-core.css', array(), EDUBIN_THEME_VERSION);
    endif;
    wp_enqueue_style('edubin-theme', get_template_directory_uri() . '/assets/css/style.css', array(), EDUBIN_THEME_VERSION);

    wp_enqueue_script('edubin-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), EDUBIN_THEME_VERSION, true);

    if ($rtl_enable == true) {
        wp_enqueue_style('edubin-theme-rtl', get_template_directory_uri() . '/rtl.css', array(), EDUBIN_THEME_VERSION);
    }

    $font_url = edubin_get_font_url();
    if (!empty($font_url)) {
        wp_enqueue_style('edubin-fonts', esc_url_raw($font_url), array(), null);
    }

    $edubin_l10n = array(
        'quote' => edubin_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('edubin-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), EDUBIN_THEME_VERSION, true);
        $edubin_l10n['expand']   = esc_html__('Expand child menu', 'edubin');
        $edubin_l10n['collapse'] = esc_html__('Collapse child menu', 'edubin');
        $edubin_l10n['icon']     = edubin_get_svg(array('icon' => 'angle-down', 'fallback' => true));
    }

    wp_enqueue_script('edubin-global', get_template_directory_uri() . '/assets/js/global.js', array('jquery'), EDUBIN_THEME_VERSION, true);
    wp_enqueue_script('jquery-scrollto', get_template_directory_uri() . '/assets/js/jquery.scrollTo.js', array('jquery'), '2.1.2', true);
    if ($load_owl_carousel_js) {
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.js', array('jquery'), '2.3.4', true);
    }
    wp_enqueue_script('youtube-popup', get_template_directory_uri() . '/assets/js/youtube-popup.js', array('jquery'), EDUBIN_THEME_VERSION, true);
    if ($load_bootstrap_js) {
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.3', true);
    }
    wp_enqueue_script('edubin-theme-script', get_template_directory_uri() . '/assets/js/edubin-theme.js', array('jquery'), EDUBIN_THEME_VERSION, true);

    wp_localize_script('edubin-skip-link-focus-fix', 'edubinScreenReaderText', $edubin_l10n);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'edubin_scripts');

/**
 * Register/Enqueue JS/CSS In Admin Panel
 */
function edubin_register_admin_styles()
{
    wp_enqueue_style('edubin-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), EDUBIN_THEME_VERSION);
    wp_enqueue_style('edubin-customizer', get_template_directory_uri() . '/admin/assets/css/customizer.css', array(), EDUBIN_THEME_VERSION);
    
    if (class_exists('RWMB_Loader')) {
        wp_enqueue_script('edubin-metaboxes', get_template_directory_uri() . '/admin/assets/js/metaboxes.js', array('jquery'), '1.0.0');
    }
}
add_action('admin_enqueue_scripts', 'edubin_register_admin_styles');

/**
 * Enqueues styles for the block-based editor.
 */
function edubin_block_editor_styles()
{
    // Block styles.
    wp_enqueue_style('edubin-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), EDUBIN_THEME_VERSION);
    // Add custom fonts.
    wp_enqueue_style('edubin-fonts', edubin_get_font_url(), array(), null);
}
add_action('enqueue_block_editor_assets', 'edubin_block_editor_styles');

/**
 * Filter the `sizes` value in the header image markup.
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function edubin_header_image_tag($html, $header, $attr)
{
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}
add_filter('get_header_image_tag', 'edubin_header_image_tag', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function edubin_front_page_template($template)
{
    return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'edubin_front_page_template');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size and use list format for better accessibility.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function edubin_widget_tag_cloud_args($args)
{
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'em';
    $args['format']   = 'list';

    return $args;
}
add_filter('widget_tag_cloud_args', 'edubin_widget_tag_cloud_args');

function edubin_admin_scripts($hook)
{

    wp_enqueue_media();

    wp_enqueue_script('upload-image', get_template_directory_uri() . '/assets/js/image-upload.js', array('jquery'), '1.0.0');

}

add_action('admin_enqueue_scripts', 'edubin_admin_scripts');

/**
 * Edubin get id
 */

if (!function_exists('edubin_array_get')) {
    function edubin_array_get($array, $key, $default = null)
    {
        if (!is_array($array)) {
            return $default;
        }

        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}

if (!function_exists('edubin_get_id')) {
    function edubin_get_id()
    {
        global $wp_query;
        return $wp_query->get_queried_object_id();
    }
}

/**
 * Theme helper functions
 */

require get_template_directory() . '/include/theme-helper.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/include/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/include/template-functions.php';

/**
 * Image Class
 */
require get_parent_theme_file_path('/include/class-image.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/include/icon-functions.php');

/**
 * breadcrumb.
 */
require get_parent_theme_file_path('/template-parts/header/breadcrumb.php');

/**
 * WooCommerce.
 */
require get_parent_theme_file_path('/include/woocommerce.php');

/**
 * LearnPress.
 */
require get_parent_theme_file_path('/include/learnpress.php');

/**
 * LearnDash.
 */
require get_parent_theme_file_path('/include/learndash.php');

/**
 * The Events Calendar.
 */
require get_parent_theme_file_path('/include/events-calendar.php');

/**
 * Edubin Options.
 */
require get_theme_file_path('admin/customizer.php');

// Custom Theme Style
if (file_exists(get_template_directory() . '/admin/custom-styles.php')) {
    require_once get_template_directory() . '/admin/custom-styles.php';
}
/**
 * One click demo import.
 */
require get_theme_file_path('admin/edubin-demo-import.php');
