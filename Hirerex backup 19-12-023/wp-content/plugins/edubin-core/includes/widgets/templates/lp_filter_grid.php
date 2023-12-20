<?php

    $settings   = $this->get_settings_for_display(); ?>

    <div <?php echo $this->get_render_attribute_string( 'edubin_posts_column' ); ?> >

    <?php if ($settings['course_style'] == '1' || $settings['course_style'] == '2' || $settings['course_style'] == '3') : ?>

        <div <?php echo $this->get_render_attribute_string( 'edubin_post_slider_item_attr' ); ?> >
            <div class="edubin-single-course-1 mb-30">
                <div class="thum">
                    <?php if ( has_post_thumbnail() ):?>
                        <figure class="image">
                            <a href="<?php the_permalink(); ?>">
                                 <?php the_post_thumbnail($settings['image_size']);?>
                            </a>
                        </figure>
                    <?php else : ?>
                    <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                        <figure class="image">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                            </a>
                        </figure>
                    <?php endif; ?>
                    <?php if($settings['show_price'] == 'yes') : ?>
                        
                        <div <?php echo $this->get_render_attribute_string( 'edubin_price_style' ); ?>>
                            <?php if ( $price_html = $course->get_price_html() ) : ?>

                                <?php if ($settings['course_style'] == 2 || $settings['course_style'] == 3) : ?>
                                    <?php $origin_price_html = $course->get_origin_price_html(); ?>
                                 <span>
                                      <?php if ($origin_price_html !== $price_html) : ?>
                                    <?php echo '<del>' . $origin_price_html . '</del>'; ?>
                                        <?php if($origin_price_html) : echo '/'; endif; ?>
                                     <?php endif; ?> 

                                     <?php echo $price_html; ?>
                                 </span>

                                <?php else : ?>

                                    <?php if ($settings['show_full_price']) : ?>
                                        <span><?php echo $price_html; ?></span>
                                    <?php else : ?>
                                        <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo $new_price; ?></span>
                                    <?php endif; ?> 

                                <?php endif; ?> 

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="course-content">

                    <?php if (class_exists('LP_Addon_Course_Review_Preload') & $settings['show_review'] == 'yes'): ?>
                    <div class="edubin-course-rate">
                         <?php  
                            $course_id       = get_the_ID();
                            $course_rate_res = learn_press_get_course_rate( $course_id, false );
                            $course_rate     = $course_rate_res['rated'];
                            $total           = $course_rate_res['total'];

                            learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); 

                            $total_text = ('1' == $total) ? esc_html__('Review', 'edubin-core') : esc_html__('reviews', 'edubin-core');

                            ?>

                          <?php if ($settings['show_review_text'] == 'yes') :?>
                              <span class="course-reviews">
                                <?php echo esc_attr('(') ?>
                                <?php echo esc_html($total); ?> 
                                <?php echo esc_html($total_text); ?>
                                <?php echo esc_attr(')') ?>
                              </span>
                          <?php endif; ?><!--  End review text-->
                    </div>
                    <?php endif; ?><!--  End review -->

                     <h4 class="course-title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>

                    <?php if($settings['show_instructor_img'] == 'yes' || $settings['show_instructor_name'] || $settings['show_enroll'] == 'yes' || $settings['show_comments'] == 'yes') : ?>
                    <div class="course-bottom">
                    <?php if($settings['show_instructor_img'] == 'yes') : ?>
                        <div class="thum">
                             <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                                <?php echo $course->get_instructor()->get_profile_picture(); ?>
                            </a>
                        </div>
                    <?php endif; ?><!--  End instructor image -->

                    <?php if($settings['show_instructor_name'] == 'yes') : ?>
                        <div class="name">
                           <h6 class="ins-name"><?php echo $course->get_instructor_html(); ?></h6>
                        </div>
                    <?php endif; ?><!--  End instructor name -->

                        <div class="admin">
                            <ul>
                               <?php if($settings['show_enroll'] == 'yes') : ?>
                                <li><i class="flaticon-user-4"></i><span class="enroll-users"><?php echo esc_html( $count ); ?></span></li>
                                <?php endif; ?><!--  End enroll -->
                                <?php if($settings['show_comments'] == 'yes') : ?>
                                <li><a href="<?php the_permalink();?>"><i class="flaticon-chat-1"></i><span><?php echo get_comments_number(); ?></span></a></li>
                                 <?php endif; ?><!--  End comments -->
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?><!--  End course bottom -->
                </div>
            </div> <!-- single course -->
        </div>

    <?php elseif ($settings['course_style'] == '4') : ?>

        <div <?php echo $this->get_render_attribute_string( 'edubin_post_slider_item_attr' ); ?> >
            <div class="edubin-single-course-2">
                <div class="thum">
                    <?php if ( has_post_thumbnail() ):?>
                        <figure class="image">
                            <a href="<?php the_permalink(); ?>">
                                  <?php the_post_thumbnail($settings['image_size']);?>
                            </a>
                        </figure>

                    <?php else : ?>
                        
                    <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                        <figure class="image">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                            </a>
                        </figure>
                    <?php endif; ?>

                    <?php if($settings['show_price'] == 'yes') : ?>
                        
                            <div <?php echo $this->get_render_attribute_string( 'edubin_price_style' ); ?>>
                            <?php if ( $price_html = $course->get_price_html() ) : ?>

                                <?php if ($settings['course_style'] == 2 || $settings['course_style'] == 3) : ?>
                                    <?php $origin_price_html = $course->get_origin_price_html(); ?>
                                 <span>
                                    <?php echo '<del>' . $origin_price_html . '</del>'; ?>
                                     <?php if($origin_price_html) : echo '/'; endif; ?>
                                     <?php echo $price_html; ?>
                                 </span>
                                <?php else : ?>
                                    <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo $new_price; ?></span>
                                <?php endif; ?> 

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="course-teacher">

                        <?php if( $settings['show_instructor_img'] == 'yes') : ?>
                            <div class="thum">
                                 <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                                    <?php echo $course->get_instructor()->get_profile_picture(); ?>
                                </a>
                            </div>
                        <?php endif; ?><!--  End instructor image -->

                        <?php if($settings['show_instructor_name'] == 'yes') : ?>
                            <div class="name">
                               <h6 class="ins-name"><?php echo $course->get_instructor_html(); ?></h6>
                            </div>
                        <?php endif; ?><!--  End instructor name -->

                        <?php if (class_exists('LP_Addon_Course_Review_Preload') & $settings['show_review'] == 'yes'): ?>
                        <div class="edubin-course-rate">
                             <?php  
                                $course_id       = get_the_ID();
                                $course_rate_res = learn_press_get_course_rate( $course_id, false );
                                $course_rate     = $course_rate_res['rated'];
                                $total           = $course_rate_res['total'];

                                learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); 

                                $total_text = ('1' == $total) ? esc_html__('Review', 'edubin-core') : esc_html__('reviews', 'edubin-core');

                                ?>

                              <?php if ($settings['show_review_text'] == 'yes') :?>
                                  <span class="course-reviews">
                                    <?php echo esc_attr('(') ?>
                                    <?php echo esc_html($total); ?> 
                                    <?php echo esc_html($total_text); ?>
                                    <?php echo esc_attr(')') ?>
                                  </span>
                              <?php endif; ?><!--  End review text-->
                        </div>
                        <?php endif; ?><!--  End review -->
                    </div>
                </div>
                <div class="content">
                  <h4 class="course-title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>
                </div>
            </div> <!-- single course -->
        </div>

    <?php elseif ($settings['course_style'] == '5') : ?>

      <div class="edubin-course">
        <div class="course__container">

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


          <div class="course__content">
            <div class="course__content--info">

              <h4 class="course__title">
                <a href="<?php the_permalink(); ?>" class="course__title-link">
                  <?php the_title(); ?>
                </a>
              </h4>

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
            </div>
            <div class="course__content--meta"> 
                <?php if ( $settings['show_enroll'] ):       
                  $students = (int)learn_press_get_course()->count_students();;?>
                <span class="course-enroll" ><i class="flaticon-user-4"></i> <?php echo $students; ?></span>
            <?php endif; ?>
            
          <?php if ( $settings['show_lesson'] ):       
                  $course = \LP_Global::course();
                  $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
                  printf('<span class="course-lessons"><i class="flaticon-book-1"></i> %s </span>', $lessons);
           endif; ?>

          <?php if ( $settings['show_quiz'] ):       
                  $course = \LP_Global::course();
                  $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                  printf('<span class="course-lessons"><i class="flaticon-question"></i> %s </span>', $lessons);
           endif; ?>

          <?php if ( $settings['show_price'] ): ?>
            <div class="price">
              <?php get_template_part('learnpress/edubin_price'); ?>
              </div>
            <?php endif ?>
            </div>
          </div>

        </div>
      </div>

    <?php endif; ?>

</div>