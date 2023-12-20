<?php 
        $settings   = $this->get_settings_for_display();
        if (function_exists('tutor')) : // Check tutor lms active
        $disable_course_duration = get_tutor_option('disable_course_duration');
        $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
        $disable_update_date = get_tutor_option('disable_course_update_date');
        $course_duration = get_tutor_course_duration_context();

 ?>    
<div class="col-lg-12">
  <div class="edubin-course edubin-course-list">
    <div class="row">
      <div class="col-md-4">

    <?php
     the_post_thumbnail($settings['image_size']);
        $course_id = get_the_ID();
    ?>
       <?php if ($settings['show_cat'] == 'yes') : ?>
                <div class="course__categories">
                   <?php
                    $course_categories = get_tutor_course_categories();
                    if(!empty($course_categories) && is_array($course_categories ) && count($course_categories)){
                        ?>
                        <?php
                        foreach ($course_categories as $course_category){
                            $category_name = $course_category->name;
                            $category_link = get_term_link($course_category->term_id);
                            echo "<a href='$category_link'>$category_name </a>";
                        }
                    }
                    ?>   
                </div>
            <?php endif; ?>

            <?php if ($settings['show_wishlist'] == 'yes') : ?>
                <div class="course__wishlist">
                    <?php
                    $is_wishlisted = tutor_utils()->is_wishlisted(get_the_ID());
                    $has_wish_list = '';
                    if ($is_wishlisted) {
                        $has_wish_list = 'has-wish-listed';
                    }

                    echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line tutor-course-wishlist-btn ' . $has_wish_list . ' " data-course-id="' . get_the_ID() . '"></a> </span>';
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
         <div class="course-content">

            <?php
              the_title(sprintf('<h4 class="course__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
            
            ?>
            <?php if ( $settings['show_excerpt_list'] == 'yes' ): ?>
             <?php the_excerpt(); ?>
            <?php endif; ?>

            <div class="course-bottom">


              <?php if ( $settings['show_author_avator'] || $settings['show_author_name'] ): ?>
                    <div class="author__name">
                      <?php if ($settings['show_author_avator'] ): ?>
                        <a href="<?php echo esc_url($profile_url); ?>" class="tutor-course-author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></a>
                      <?php endif; ?>

                    <?php if ( $settings['show_author_name'] ): ?>
                        <a href="<?php echo esc_url($profile_url); ?>" class="tutor-course-author"><?php the_author() ?></a>
                     <?php endif; ?>
                    </div>
              <?php endif; ?>

            <div class="course__content--meta"> 
             <?php if ($settings['show_enroll']): 
                      $students = (int) tutor_utils()->count_enrolled_users_by_course();?>
                      <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?> </span>
                   <?php endif; ?>

                    <?php $lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                     $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin-core') : esc_html__('Lessons', 'edubin-core');

                    if ($settings['show_lesson']): ?>
                        <span class="course-lessons">
                            <i class="flaticon-book-1"></i>
                            <?php echo esc_attr( $lesson); ?>
                            <?php if ($settings['show_lesson_text_list_item']): ?>
                                <?php echo esc_html($lesson_text); ?>
                            <?php endif; ?>
                        </span>
                   <?php endif; ?>
                  <?php if ($settings['show_duration']): 
                          printf('<span class="course-lessons"><i class="flaticon-passage-of-time"></i> %s </span>', $course_duration);
                    ?>
                  <?php endif; ?>
            </div>

                <div class="course__content--meta"> 
                 <?php if ( $settings['show_footer'] ): ?>
                    <div class="price-tutor">
                      <?php echo tutor_course_loop_price(); ?>
                    </div>
                <?php endif ?>
                </div>

                </div>
                <!--  End course bottom -->
              </div>
            </div>
          </div> <!--  row  -->
        </div> <!-- single course -->
      </div>

<?php endif; ?>