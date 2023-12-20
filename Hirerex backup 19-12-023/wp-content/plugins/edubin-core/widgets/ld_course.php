<?php
/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'pxcv_learndash_course_load_widgets');

function pxcv_learndash_course_load_widgets()
{
    register_widget('PXCV_LearnDash_Course_Widget');
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 *
 */
class PXCV_LearnDash_Course_Widget extends WP_Widget
{
    /**
     * Widget setup.
     */
    function __construct()
    {
        /* Widget settings. */
        $widget_ops = [
            'classname' => 'widget_pxcv_posts',
            'description' => esc_html__('Display LearnDash recent course by categories (or related)', 'edubin-core')
        ];

        /* Create the widget. */
        parent::__construct('pxcv-learndash-course', esc_html__('(Edubin) LearnDash Courses', 'edubin-core'), $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);

        global $wpdb;
        global $post;
        $time_id = rand();

        /* Variables from the widget settings. */
        $title = $instance['title'] ?? '';
        $num_posts = $instance['num_posts'] ?? 4;
        $categories = $instance['categories'] ?? '';
        $show_image = $instance['show_image'] ?? true;
        $show_related = !empty($instance['show_related']) ? true : false;
        $show_content = !empty($instance['show_content']) ? true : false;
        $show_price = !empty($instance['show_price']) ? true : false;

        /* Before widget (defined by themes). */
        echo Edubin_Theme_Helper::render_html($before_widget);

        /* Display the widget title if one was input (before and after defined by themes). */
        if ($title) {
            echo Edubin_Theme_Helper::render_html($before_title),
                esc_attr($instance['title']),
            Edubin_Theme_Helper::render_html($after_title);
        }

        if ($show_related) { // show related category
            $related_category = get_the_category($post->ID);
            if (isset($related_category[0]->cat_name)) {
                $related_category_id = get_cat_ID($related_category[0]->cat_name);
            } else {
                $related_category_id = '';
            }

            $recent_posts = new WP_Query([
                'post_type' => 'sfwd-courses',
                'showposts' => $num_posts,
                'cat' => $related_category_id,
                'post__not_in' => [$post->ID],
                'ignore_sticky_posts' => 1,
            ]);
        } else {
            $recent_posts = new WP_Query([
                'post_type' => 'sfwd-courses',
                'showposts' => $num_posts,
                'cat' => $categories,
                'ignore_sticky_posts' => 1,

            ]);
        }

        if ($recent_posts->have_posts()) :
            echo '<ul class="pxcv-rr-item-widget recent-widget-', esc_attr($time_id), '">';
                while ($recent_posts->have_posts()) :
                    $recent_posts->the_post();

                    $img_url = false;
                    if (
                        $show_image
                        && has_post_thumbnail()
                    ) {
                        $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()));
                    }

                    if ($show_content) {
                        if (has_excerpt()) {
                            $post_excerpt = get_the_excerpt();
                        } else {
                            $post_excerpt = get_the_content();
                        }

                        $without_tags = strip_tags($post_excerpt);
                        $text = Edubin_Theme_Helper::modifier_character($without_tags, 65, '...');
                    } else {
                        $text = '';
                    }

                    // Render
                    echo '<li class="clearfix', ($img_url ? ' has_image' : ''), '">';
                        if ($img_url) {
                           echo '<a class="post__link" href="'.get_permalink().'">'. '<div class="pxcv-rr-item-image_wrapper">' . get_the_post_thumbnail( get_the_id(), 'thumbnail') .'</div>'.'</a>';
                        }
                        echo '<div class="pxcv-rr-item-content_wrapper">';
                            echo '<a class="post__link" href="', esc_url(get_permalink()), '">';
                            echo '<h6 class="post__title">',
                                esc_html(get_the_title()),
                            '</h6>'; // post-title
                             echo '</a>'; // post__link

                            if ($show_price) :
    $defaults = edubin_generate_defaults();
   
    $see_more_btn = get_theme_mod( 'see_more_btn', $defaults['see_more_btn']); 
    $ld_progress_bar_show = get_theme_mod( 'ld_progress_bar_show', $defaults['ld_progress_bar_show']); 
    $ld_see_more_btn_text = get_theme_mod( 'ld_see_more_btn_text', $defaults['ld_see_more_btn_text']); 
    $free_custom_text = get_theme_mod( 'free_custom_text', $defaults['free_custom_text'] ); 
    $enrolled_custom_text = get_theme_mod( 'enrolled_custom_text', $defaults['enrolled_custom_text'] ); 
    $completed_custom_text = get_theme_mod( 'completed_custom_text', $defaults['completed_custom_text'] ); 
    $custom_closed_btn_url = get_theme_mod( 'custom_closed_btn_url', $defaults['custom_closed_btn_url'] ); 
    $ld_course_archive_clm = get_theme_mod( 'ld_course_archive_clm', $defaults['ld_course_archive_clm'] ); 


    global $post; $post_id = $post->ID;

    $course_id = $post_id;
    $user_id   = get_current_user_id();

    $button_text  = $ld_see_more_btn_text;


    if ( isset( $shortcode_atts['course_id'] ) ) {
        $button_link = learndash_get_step_permalink( get_the_ID(), $shortcode_atts['course_id'] );
    } else {
        $button_link = get_permalink();
    }

    $button_link = apply_filters( 'learndash_course_grid_custom_button_link', $button_link, $post_id );

    $button_text = isset( $button_text ) && ! empty( $button_text ) ? $button_text : esc_html__( 'See more', 'edubin' );
    $button_text = apply_filters( 'learndash_course_grid_custom_button_text', $button_text, $post_id );

    $options = get_option( 'sfwd_cpt_options' );
    $currency_setting = class_exists( 'LearnDash_Settings_Section' ) ? LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_PayPal', 'paypal_currency' ) : null;
    $currency = '';

    if ( isset( $currency_setting ) || ! empty( $currency_setting ) ) {
        $currency = $currency_setting;
    } elseif ( isset( $options['modules'] ) && isset( $options['modules']['sfwd-courses_options'] ) && isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) ) {
        $currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];
    }

    if ( class_exists( 'NumberFormatter' ) ) {
        
        $locale = get_locale();
        $number_format = new NumberFormatter( $locale . '@currency=' . $currency, NumberFormatter::CURRENCY );
        $currency = $number_format->getSymbol( NumberFormatter::CURRENCY_SYMBOL );
    }

    /**
     * Currency symbol filter hook
     * 
     * @param string $currency Currency symbol
     * @param int    $course_id
     */
    $currency = apply_filters( 'learndash_course_grid_currency', $currency, $course_id );

    $course_options = get_post_meta($post_id, "_sfwd-courses", true);
    $legacy_short_description = isset( $course_options['sfwd-courses_course_short_description'] ) ? $course_options['sfwd-courses_course_short_description'] : '';
    // For LD >= 3.0
    if ( function_exists( 'learndash_get_course_price' ) ) {
        $price_args = learndash_get_course_price( $course_id );
        $price = $price_args['price'];
        $price_type = $price_args['type'];
    } else {

        if ($free_custom_text) {
        $price = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : $free_custom_text;        
        } 
        else {
        $price = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : esc_html__( 'Free', 'edubin' );
        }
        

        $price_type = $course_options && isset( $course_options['sfwd-courses_course_price_type'] ) ? $course_options['sfwd-courses_course_price_type'] : '';
    }


    /**
     * Filter: individual grid class
     * 
     * @param int   $course_id Course ID
     * @param array $course_options Course options
     * @var string
     */
    $grid_class = apply_filters( 'learndash_course_grid_class', '', $course_id, $course_options );

    $has_access   = sfwd_lms_has_access( $course_id, $user_id );
    $is_completed = learndash_course_completed( $user_id, $course_id );

    $price_text = '';

    if ( is_numeric( $price ) && ! empty( $price ) ) {
        $price_format = apply_filters( 'learndash_course_grid_price_text_format', '{currency}{price}' );

        $price_text = str_replace(array( '{currency}', '{price}' ), array( $currency, $price ), $price_format );
    } elseif ( is_string( $price ) && ! empty( $price ) ) {
        $price_text = $price;
    } elseif ( empty( $price ) ) {
        if ($free_custom_text) {
            $price_text = $free_custom_text;
        } else {
            $price_text = esc_html__( 'Free', 'edubin' );
        }
        
    }

    $class       = 'ld_course_grid_price';
    $course_class = '';
    $ribbon_text = get_post_meta( $post->ID, '_learndash_course_grid_custom_ribbon_text', true );
    $ribbon_text = isset( $ribbon_text ) && ! empty( $ribbon_text ) ? $ribbon_text : '';

    if ( $has_access && ! $is_completed && $price_type != 'open' && empty( $ribbon_text ) ) {
        $class .= ' ribbon-enrolled';
        $course_class .= ' learndash-available learndash-incomplete ';

        if ($enrolled_custom_text) {
            $ribbon_text = $enrolled_custom_text;

        } else {
            $ribbon_text = esc_html__( 'Enrolled', 'edubin' );
        }
        

    } elseif ( $has_access && $is_completed && $price_type != 'open' && empty( $ribbon_text ) ) {
        $class .= '';
        $course_class .= ' learndash-available learndash-complete';

        if ($completed_custom_text) {
            $ribbon_text = $completed_custom_text;
        } else {
            $ribbon_text = esc_html__( 'Completed', 'edubin' );

        }
        

    } elseif ( $price_type == 'open' && empty( $ribbon_text ) ) {
        if ( is_user_logged_in() && ! $is_completed ) {
            $class .= ' ribbon-enrolled';
            $course_class .= ' learndash-available learndash-incomplete';

            if ($enrolled_custom_text) {
                $ribbon_text = $enrolled_custom_text;
            } else {
                $ribbon_text = esc_html__( 'Enrolled', 'edubin' );
            }
            

        } elseif ( is_user_logged_in() && $is_completed ) {
            $class .= '';
            $course_class .= ' learndash-available learndash-complete';

            if ($completed_custom_text) {
                $ribbon_text = $completed_custom_text;

            } else {
                $ribbon_text = esc_html__( 'Completed', 'edubin' );
            }
            
        } else {
            $course_class .= ' learndash-available';
            $class .= ' ribbon-enrolled';
            $ribbon_text = '';
        }
    } elseif ( $price_type == 'closed' && empty( $price ) ) {
        $class .= ' ribbon-enrolled';
        $course_class .= ' learndash-available';

        if ( $is_completed ) {
            $course_class .= ' learndash-complete';
        } else {
            $course_class .= ' learndash-incomplete';
        }

        if ( is_numeric( $price ) ) {
            $ribbon_text = $price_text;
        } else {
            $ribbon_text = '';
        }
    } else {
        if ( empty( $ribbon_text ) ) {
            $class .= ! empty( $course_options['sfwd-courses_course_price'] ) ? ' price_' . $currency : ' free';
            $course_class .= ' learndash-not-available learndash-incomplete';
            $ribbon_text = $price_text;
        } else {
            $class .= ' custom';
            $course_class .= ' learndash-not-available learndash-incomplete';
        }
    }

                                echo '<span class="course-price">';
                                    echo '<span class="price">';
                                         echo wp_kses_post($ribbon_text);
                                    echo '</span>';
                                echo '</span>';

                            endif;
                            if ($text) :
                                echo '<div class="pxcv-rr-item-content">',
                                    esc_html($text),
                                '</div>';
                            endif;
                        echo '</div>';
                  //  echo '</a>'; // post__link
                    echo '</li>';
                endwhile;
            echo '</ul>';

        else :

            esc_html_e('No posts were found.', 'edubin-core');

        endif;

        /* After widget (defined by themes). */
        echo Edubin_Theme_Helper::render_html($after_widget);

        // Restore original Query & Post Data
        wp_reset_query();
        wp_reset_postdata();
    }

    /**
     * Update the widget settings.
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        // Strip tags for title and name to remove HTML (impopxcvant for text inputs).
        $instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['num_posts'] = $new_instance['num_posts'] ?? '';
        $instance['categories'] = $new_instance['categories'] ?? '';
        $instance['show_image'] = $new_instance['show_image'] ?? '';
        $instance['show_related'] = $new_instance['show_related'] ?? '';
        $instance['show_content'] = $new_instance['show_content'] ?? '';
        $instance['show_price'] = $new_instance['show_price'] ?? '';

        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     */
    function form($instance)
    {
        /* Set up some default widget settings. */
        $defaults = [
            'title' => esc_html__('LearnDash Courses' , 'edubin-core'),
            'num_posts' => 3,
            'categories' => 'all',
            'show_related'  => 'off',
            'show_image' => 'on',
            'show_price' => 'on',
            'show_content'  => 'off'
        ];

        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:' , 'edubin-core') ?></label>
            <input class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num_posts')); ?>"><?php esc_html_e('Number of posts:' , 'edubin-core'); ?></label>
            <input type="number" min="1" max="100" class="widefat" id="<?php echo esc_attr($this->get_field_id('num_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('num_posts')); ?>" value="<?php echo esc_attr($instance['num_posts']); ?>" />
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_related')); ?>" name="<?php echo esc_attr($this->get_field_name('show_related')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_related')); ?>"><?php esc_html_e('Show related category posts' , 'edubin-core'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_image')); ?>" name="<?php echo esc_attr($this->get_field_name('show_image')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>"><?php esc_html_e('Show thumbnail image' , 'edubin-core'); ?></label>
        </p>

        <p style="margin-top: 20px;">
            <label style="font-weight: bold;"><?php esc_html_e('Post meta info' , 'edubin-core'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_price'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_price')); ?>" name="<?php echo esc_attr($this->get_field_name('show_price')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_price')); ?>"><?php esc_html_e('Show Price' , 'edubin-core'); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_content'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_content')); ?>" name="<?php echo esc_attr($this->get_field_name('show_content')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_content')); ?>"><?php esc_html_e('Show content' , 'edubin-core'); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filter by Category:' , 'edubin-core'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
                <option value='all' <?php if ('all' == $instance['categories'] ) echo 'selected="selected"'; ?>><?php esc_html_e('All categories' , 'edubin-core');?></option>
                <?php $categories = get_categories( 'hide_empty=0&depth=1&type=sfwd-courses&taxonomy=course_category' ); ?>
                <?php foreach( $categories as $category) { ?>
                <option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>
    <?php
    }
}