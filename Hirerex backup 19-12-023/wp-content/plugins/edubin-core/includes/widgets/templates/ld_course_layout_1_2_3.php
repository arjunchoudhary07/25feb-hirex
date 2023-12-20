        <?php 
    // Customizer option
    global $wp, $wp_query, $post;

         ?>

            <div <?php echo $this->get_render_attribute_string( 'edubin_post_slider_item_attr' ); ?> >
                <div class="edubin-single-course-1 mb-30 ld-course">


                    <div class="thum">
                        <?php $intor_video_image =  $settings['intor_video_image']; ?>
                        <?php if ( 1 == $enable_video && !empty( $embed_code ) && $intor_video_image) : ?>
                        
                        <figure class="image">
                            <a href="<?php if($post_button_url && $settings['custom_closed_btn_url']) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                                <?php the_post_thumbnail($settings['image_size']);?>
                            </a>
                        </figure>
                 

                        <?php elseif ( 1 == $enable_video && ! empty( $embed_code ) ) : ?>
                        <div class="ld_course_grid_video_embed">
                        <?php echo $embed_code; ?>
                        </div>

                        <?php elseif ( has_post_thumbnail() ):?>
                            <figure class="image">
                                <a href="<?php if($post_button_url && $settings['custom_closed_btn_url']) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                                    <?php the_post_thumbnail($settings['image_size']);?>
                                </a>
                            </figure>
                        <?php elseif(!empty($settings['custom_placeholder_image']['url'])) : ?>
                            <figure class="image">
                                <img src="<?php echo esc_url($settings['custom_placeholder_image']['url']); ?>" alt="placeholder">
                            </figure>
                        <?php else : ?>
                            <figure class="image">
                                <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                                <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                            </figure>
                        <?php endif; ?>
                        <?php if($settings['show_price'] == 'yes') : ?>
                            
                            <div <?php echo $this->get_render_attribute_string( 'edubin_price_style' ); ?>>
                                <?php if ( $price) : ?>
                                    <?php if ($settings['course_style'] == 2 || $settings['course_style'] == 3) : ?>
                                     <span><?php echo $price; ?></span>
                                    <?php else : ?>
                                        <span><?php $price = str_replace('.00', '', $price); echo $price; ?></span>
                                    <?php endif; ?> 

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="course-content">

                         <h4 class="course-title"><a href="<?php if($post_button_url && $settings['custom_closed_btn_url']) : echo esc_url($post_button_url); else : the_permalink(); endif;?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>
                        
                        <!-- custom code added to show time-->
                        <?php if($settings['batch_timing_show'] == 'yes') : ?>  
                            <p class="course-time"><?php esc_attr_e( 'Time', 'edubin-core' ); ?> <br><span><?php echo get_post_meta($post->ID, 'batch_timing', true); ?></span></p>
                        <?php endif; ?>
                         <!-- custom code added to show time end-->
                        <?php if($settings['show_lesson'] == 'yes' || $settings['show_topic'] == 'yes' || $settings['show_views'] == 'yes' || $settings['show_see_more'] || $settings['show_comments']) : ?>  
                            <div class="course-bottom">
                                <div class="course-meta">
                                    <ul>
                                        <?php if($settings['show_lesson'] == 'yes') : ?>  
                                        <?php  
                                        $lesson  = learndash_get_course_steps( get_the_ID(), array('sfwd-lessons') );
                                        $lesson = $lesson ? count($lesson) : 0;
                                        $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin-core') : esc_html__('Lessons', 'edubin-core'); ?>
                                            <li><i class="flaticon-play-button"></i>  
                                                <?php echo esc_html($lesson); ?>
                                                <?php if ($settings['show_lesson_text']): ?>
                                                    <?php echo esc_html($lesson_text); ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($settings['show_topic'] == 'yes') : ?>  
                                        <?php  
                                        $topic  = learndash_get_course_steps( get_the_ID(), array('sfwd-topic') );
                                        $topic = $topic ? count($topic) : 0;
                                        $topic_text = ('1' == $topic) ? esc_html__('Topic', 'edubin-core') : esc_html__('Topics', 'edubin-core'); ?>
                                            <li><i class="flaticon-play"></i>  
                                                <?php echo esc_html($topic); ?>
                                                <?php if ($settings['show_topic_text']): ?>
                                                    <?php echo esc_html($topic_text); ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($settings['show_views'] == 'yes') : ?>  
                                            <li><i class="flaticon-binoculars"></i> <?php echo edubinGetPostViews(get_the_ID()); ?></li>
                                        <?php endif; ?>

                                        <?php if($settings['show_comments'] == 'yes') : ?>  
                                            <li><i class="flaticon-chat-1"></i><a href="<?php get_comments_link();?>"> <?php echo get_comments_number(); ?></a></li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            <?php if($settings['show_see_more'] == 'yes') : ?>  

                                <div class="see-more-btn">
                                    <a href="<?php if($post_button_url && $settings['custom_closed_btn_url']) : echo esc_url($post_button_url); else : the_permalink(); endif;?>"><?php echo $button_text ; ?></a>
                                </div>
                            <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div> 
            </div>
