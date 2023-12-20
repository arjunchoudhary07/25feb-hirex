<?php

$disable_course_duration = get_tutor_option('disable_course_duration');
$disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
$disable_update_date = get_tutor_option('disable_course_update_date');
$course_duration = get_tutor_course_duration_context();


$defaults = edubin_generate_defaults();
$tutor_course_archive_style = get_theme_mod( 'tutor_course_archive_style', $defaults['tutor_course_archive_style']);
$tutor_instructor_img_on_off = get_theme_mod( 'tutor_instructor_img_on_off', $defaults['tutor_instructor_img_on_off']);
$tutor_instructor_name_on_off = get_theme_mod( 'tutor_instructor_name_on_off', $defaults['tutor_instructor_name_on_off']);
$tutor_price_show = get_theme_mod( 'tutor_price_show', $defaults['tutor_price_show']);
$tutor_cat_show = get_theme_mod( 'tutor_cat_show', $defaults['tutor_cat_show']);
$tutor_enroll_show = get_theme_mod( 'tutor_enroll_show', $defaults['tutor_enroll_show']);
$tutor_lesson_show = get_theme_mod( 'tutor_lesson_show', $defaults['tutor_lesson_show']);
$tutor_lesson_text = get_theme_mod( 'tutor_lesson_text', $defaults['tutor_lesson_text']);
$tutor_lessons_text = get_theme_mod( 'tutor_lessons_text', $defaults['tutor_lessons_text']);

?>

 <div class="edubin-course">
    <div class="course__container">
        <a class="course__media-link" href="<?php the_permalink(); ?>">
            <?php Edubin_Image::the_post_thumbnail( [ 'size' => '480x304' ] ); ?>
        </a>
    <?php if ( $tutor_cat_show ) {
        ?>
        <div class="course__categories">
            <?php
            $course_categories = get_tutor_course_categories();

            if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) {
                ?>
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
       <div class="course__content">
          <div class="course__content--info">

            <?php if ( $tutor_instructor_img_on_off || $tutor_instructor_name_on_off ): ?>
               <div class="author__name">
                    <?php if ( $tutor_instructor_img_on_off ): ?>
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                    <?php endif; ?>
                     <!--  End instructor image -->
                    <?php if ( $tutor_instructor_name_on_off ): ?>
                            <?php the_author() ?>
                    <?php endif; ?>
                     <!--  End instructor name -->
               </div>
            <?php endif; ?>
           <h4 class="course__title">
                <a href="<?php the_permalink();?>">
                    <?php echo get_the_title(); ?>
                </a>
           </h4>

             <div class="course-meta"> 

                <?php if ($tutor_enroll_show): 
                    $students = (int) tutor_utils()->count_enrolled_users_by_course(); ?>
                  <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?> </span>
                <?php endif; ?>

                <?php   
                 if ($tutor_lesson_show): ?>

                <?php $lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                     $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin'); ?>

                  <span class="course-lessons">
                  <i class="flaticon-book-1"></i>
                    <?php echo esc_attr( $lesson); ?>                                             
                   </span>
                <?php endif; ?>

             </div>
          </div>
          <div class="course__content--meta">
             <div class="price-tutor">
                <div class="tutor-course-loop-price">
                 <div class="price">
                    <?php 
                        $course_id     = get_the_ID();
                        $default_price = apply_filters('tutor-loop-default-price', esc_html__('Free', 'edubin'));
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
                                                ' . __( 'Start Learning', 'edubin' ) . '
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
                                            esc_html_e( 'Continue Learning', 'edubin' );
                                        }
                                        if ( $completed_percent == 0 && ! $is_completed_course ) {
                                            esc_html_e( 'Start Learning', 'edubin' );
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
    </div>
 </div>


