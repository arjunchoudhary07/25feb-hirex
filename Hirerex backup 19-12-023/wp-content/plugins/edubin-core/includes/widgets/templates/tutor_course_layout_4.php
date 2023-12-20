<?php 
        $settings   = $this->get_settings_for_display();
 ?>    

 <div class="edubin-single-course-1">
   <div class="thum">
      <figure class="image">
            <a class="course__media-link" href="<?php the_permalink(); ?>">
                <?php
                 the_post_thumbnail($settings['image_size']);
                    $course_id = get_the_ID();
                ?>
            </a>
      </figure>

      <div class="edubin-course-price-1">
        <span class="course-price">
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

            <?php if ($settings['show_author_avator'] ): ?>
                 <div class="thum">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                 </div>
             <!--  End instructor image -->
            <?php endif; ?>

            <?php if ( $settings['show_author_name'] ): ?>
                <div class="name">
                    <?php the_author() ?>
                </div>
             <!--  End instructor name -->
            <?php endif; ?>

        <?php if ( $settings['show_enroll'] || $settings['show_lesson'] || $settings['show_duration'] ): ?>
         <div class="admin">
            <ul>
                <?php if ($settings['show_enroll']):  ?>
               <li> <?php
                      $students = (int) tutor_utils()->count_enrolled_users_by_course();?>
                      <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?> </span>
                </li>
                 <?php endif; ?>
               <!--  End enroll -->
                <?php   
                 if ($settings['show_lesson']): ?>
                   <li>                    
                    <?php $lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                         $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin-core') : esc_html__('Lessons', 'edubin-core'); ?>

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