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

<div class="edubin-tutor-courses-column-area">
   <div class="edubin-single-course-1">
      <div class="thum">
         <figure class="image">
            <a class="course__media-link" href="<?php the_permalink(); ?>">
                <?php Edubin_Image::the_post_thumbnail( [ 'size' => '480x304' ] ); ?>
            </a>
         </figure>
         <div class="edubin-course-price-1">
            <span class="course-price">                             
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
             </span>      
         </div>
      </div>
      <div class="course-content">
         <!--  End review -->
         <h4 class="course-title">
            <a href="<?php the_permalink();?>">
                <?php echo get_the_title(); ?>
            </a>
         </h4>
         <div class="course-bottom">
            <?php if ( $tutor_instructor_img_on_off ): ?>
            <div class="thum">
               <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
            </div>
            <!--  End instructor image -->
            <?php endif; ?> 
            <?php if ( $tutor_instructor_name_on_off ): ?>
            <div class="name">
              <?php the_author() ?>
            </div>
            <!--  End instructor name -->
            <?php endif; ?>

            <?php if ( $tutor_enroll_show || $tutor_lesson_show ): ?>
             <div class="admin">
                <ul>
                    <?php if ( $tutor_enroll_show ):  ?>
                   <li> <?php
                          $students = (int) tutor_utils()->count_enrolled_users_by_course();?>
                          <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?> </span>
                    </li>
                     <?php endif; ?>
                   <!--  End enroll -->
                    <?php   
                     if ( $tutor_lesson_show ): ?>
                       <li>                    
                        <?php $lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                             $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin'); ?>

                                <span class="course-lessons">
                                    <i class="flaticon-book-1"></i>
                                    <?php echo esc_attr( $lesson); ?>
                                </span>

                       </li>
                    <?php endif; ?>
                   <!--  End lesson -->

                </ul>
             </div>
            <?php endif; ?>

         </div>
         <!--  End course bottom -->
      </div>
   </div>
</div>