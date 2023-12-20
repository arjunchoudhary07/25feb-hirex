
    <?php do_action('tutor_course/loop/before_content');

    do_action('tutor_course/loop/badge');

    do_action('tutor_course/loop/before_header');?>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="tutor-course-header">
            <a href="<?php the_permalink(); ?>">
                <?php
                 the_post_thumbnail($settings['image_size']);
                    $course_id = get_the_ID();
                ?>
            </a>
            <div class="tutor-course-loop-header-meta">
                <?php
                $is_wishlisted = tutor_utils()->is_wishlisted($course_id);
                $has_wish_list = '';
                if ($is_wishlisted) {
                    $has_wish_list = 'has-wish-listed';
                }
                if ($settings['show_difficulty_level'] == 'yes') {
                    echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
                }
                // if ($settings['show_wishlist'] == 'yes') {
                //     echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line tutor-course-wishlist-btn ' . $has_wish_list . ' " data-course-id="' . $course_id . '"></a> </span>';
                // }
                ?>
            </div>
        </div>
    <?php else : ?>
    <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
        </a>
    <?php endif; ?>
    <?php
    do_action('tutor_course/loop/after_header');

    do_action('tutor_course/loop/start_content_wrap');
    if ($settings['show_review'] == 'yes') {
        do_action('tutor_course/loop/before_rating');
        do_action('tutor_course/loop/rating');
        do_action('tutor_course/loop/after_rating');
    }
    do_action('tutor_course/loop/before_title');
    do_action('tutor_course/loop/title');
    do_action('tutor_course/loop/after_title');

    do_action('tutor_course/loop/before_meta');

    global $post, $authordata;
    if ( has_post_thumbnail() ) :
        $profile_url = tutor_utils()->profile_url($authordata->ID);
    endif;
    ?>
    <?php if ($settings['show_enroll'] == 'yes' || $settings['show_duration'] == 'yes'): ?>
        <div class="tutor-course-loop-meta">
            <?php
            $course_duration = get_tutor_course_duration_context();
            $course_students = tutor_utils()->count_enrolled_users_by_course();
            ?>
            <?php if ($settings['show_enroll'] == 'yes') {?>
                <div class="tutor-single-loop-meta">
                     <i class="flaticon-user-4"></i> <span><?php echo $course_students; ?></span>
                </div>
            <?php }?>
            <?php
            if (!empty($course_duration && $settings['show_duration'] == 'yes')) {?>
                <div class="tutor-single-loop-meta">
                    <i class="flaticon-passage-of-time"></i> <span><?php echo $course_duration; ?></span>
                </div>
            <?php }?>
        </div>
    <?php endif;?>

    <?php if ($settings['show_author_avator'] == 'yes' || $settings['show_author_name'] == 'yes' || $settings['show_cat'] == 'yes'): ?>
        <div class="tutor-loop-author">
            <?php if ($settings['show_author_avator'] == 'yes' && has_post_thumbnail()) {?>
                <div class="tutor-single-course-avatar">
                    <a href="<?php echo $profile_url; ?>"> <?php echo tutor_utils()->get_tutor_avatar($post->post_author); ?></a>
                </div>
            <?php }?>
            <?php if ($settings['show_author_name'] == 'yes' && has_post_thumbnail()) {?>
                <div class="tutor-single-course-author-name">
                    <span><?php _e('by', 'edubin-core');?></span>
                    <a href="<?php echo $profile_url; ?>"><?php echo get_the_author(); ?></a>
                </div>
            <?php }?>
            <?php if ($settings['show_cat'] == 'yes') {
                ?>
                <div class="tutor-course-lising-category">
                    <?php
                    $course_categories = get_tutor_course_categories();
                    if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) {
                        ?>
                        <span><?php esc_html_e('In', 'edubin-core')?></span>
                        <?php
                        foreach ($course_categories as $course_category) {
                            $category_name = $course_category->name;
                            $category_link = get_term_link($course_category->term_id);
                            echo "<a href='$category_link'>$category_name </a>";
                        }
                    }
                    ?>
                </div>
            <?php }?>
        </div>
    <?php endif;?>

    <?php
    do_action('tutor_course/loop/after_meta');

    if ($settings['show_excerpt'] == 'yes') {
        do_action('tutor_course/loop/before_excerpt'); ?>
        <div class="edubin-tutor-excerpt">
            <?php the_excerpt(); ?>
        </div>
    <?php   
    do_action('tutor_course/loop/after_excerpt');
    }
    do_action('tutor_course/loop/end_content_wrap');

    if ($settings['show_footer'] == 'yes') { ?>

    <div class="tutor-loop-course-footer">

            <div class="course__content--meta">
               <div class="price-tutor">
                  <div class="tutor-course-loop-price">
                     <div class="price">
                        <?php 
                            $course_id     = get_the_ID();
                            $default_price = apply_filters('tutor-loop-default-price', $settings['text_free']);
                            $price_html    = '<span class="price"> ' . $default_price . '</span>';
                            if (tutor_utils()->is_course_purchasable()) {

                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                $product    = wc_get_product($product_id);

                                if ($product) {
                                    $price_html = '<span class="price"> ' . $product->get_price_html() . ' </span>';
                                }
                            }

                             echo wp_kses( $price_html, 'edubin-default' );
                        ?>
                        <div class="tutor-loop-cart-btn-wrap">
                            <div  class="list-item-button icon__none">
                            <?php
                                
                                $course_id = get_the_ID();
                                $enroll_btn = '
                                                <a href="'. get_the_permalink(). '" class="tutor-btn tutor-pr-0 tutor-pl-0 tutor-btn-disable-outline tutor-btn-md tutor-btn-full">
                                                    ' . __( 'Start Learning', 'tutor' ) . '
                                                </a>
                                            ';

                                $lesson_url = tutor_utils()->get_course_first_lesson();
                                $completed_lessons = tutor_utils()->get_completed_lesson_count_by_course();
                                $completed_percent = tutor_utils()->get_course_completed_percent();
                                $is_completed_course = tutor_utils()->is_completed_course();
                                $retake_course = tutor_utils()->get_option( 'course_retake_feature', false ) && ( $is_completed_course || $completed_percent >= 100 );
                                $button_class = 'tutor-btn tutor-btn-disable-outline tutor-btn-outline-fd tutor-btn-md tutor-btn-full tutor-pr-0 tutor-pl-0 ' . ( $retake_course ? ' tutor-course-retake-button' : '' );
                                
                                if ( $lesson_url && ! $is_completed_course ) { 
                                    ob_start();
                                    ?>
                                    <a href="<?php echo $lesson_url; ?>" class="<?php echo $button_class; ?>" data-course_id="<?php echo get_the_ID(); ?>">
                                        <?php
                                            if ( ! $is_completed_course && $completed_percent != 0 ) {
                                                esc_html_e( 'Continue Learning', 'tutor' );
                                            }
                                            if ( $completed_percent == 0 && ! $is_completed_course ) {
                                                esc_html_e( 'Start Learning', 'tutor' );
                                            }
                                        ?>
                                    </a>
                                    <?php 
                                    $enroll_btn = ob_get_clean();
                                }
                                
                                echo apply_filters( 'tutor_course/loop/start/button', $enroll_btn, get_the_ID() );
                            ?>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
    </div>

    <?php 
    }

    do_action('tutor_course/loop/after_content');?>
