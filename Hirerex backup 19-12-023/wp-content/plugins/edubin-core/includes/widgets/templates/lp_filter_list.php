
<div class="col-lg-12">
  <div class="edubin-course edubin-course-list">
    <div class="row">
      <div class="col-md-4">

          <?php if ( has_post_thumbnail() ):?>
            <div class="course__media">
                <a class="course__media-link" href="<?php the_permalink(); ?>">
                 <?php the_post_thumbnail($settings['image_size']);?>
                </a>
               <?php if ( $settings['show_cat'] == 'yes' ): ?>
                <div class="course__categories ">
                  <?php echo get_the_term_list(get_the_ID(), 'course_category'); ?>
                </div>
               <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
        <div class="col-md-8">
         <div class="course-content">

            <?php
              the_title(sprintf('<h4 class="course__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
              do_action('learn_press_after_the_title');
            ?>
            <?php the_excerpt();?>
            <div class="course-bottom">

            <?php if ($settings['show_instructor_img'] == 'yes' || $settings['show_instructor_name'] == 'yes' ): ?>
                    <div class="author__name">
                      <?php if ( $settings['show_instructor_img'] == 'yes' ): ?>
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                      <?php endif; ?>

                    <?php if ( $settings['show_instructor_name'] ): ?>
                        <?php the_author() ?>
                     <?php endif; ?>
                    </div>
              <?php endif; ?>

                <div class="course__content--meta"> 
                    <?php if ( $settings['show_enroll'] ):       
                      $students = (int)learn_press_get_course()->count_students();
                      $enroll_text = esc_html__('Enrolled', 'edubin-core');?>
                      <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?> </span>
                       <span><?php echo esc_html($enroll_text); ?></span>

                     <?php endif; ?>

              <?php if ( $settings['show_lesson'] ):       
                      $course = \LP_Global::course();
                      $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
                      $lesson_text = ('1' == $lessons) ? esc_html__('Lesson', 'edubin-core') : esc_html__('Lessons', 'edubin-core');
                      printf('<span class="course-lessons"><i class="flaticon-book-1"></i> %s </span>', $lessons); ?>
                     <span><?php echo esc_html($lesson_text); ?></span>
               <?php endif; ?>


              <?php if ( $settings['show_quiz'] ):       
                      $course = \LP_Global::course();
                      $quiz = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                      $quiz_text = ('1' == $quiz) ? esc_html__('Quiz', 'edubin-core') : esc_html__('Quizzes', 'edubin-core');
                      printf('<span class="course-quiz"><i class="flaticon-question"></i> %s </span>', $quiz);?>
                      <span><?php echo esc_html($quiz_text); ?></span>
              <?php endif; ?>
                    
              <?php if ( $settings['show_price'] ): ?>
                <div class="price">
                  <?php get_template_part('learnpress/edubin_price'); ?>
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