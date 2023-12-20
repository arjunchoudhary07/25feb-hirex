<?php
/**
 * Template part for displaying posts
 * @package Edubin
 * Version: 1.0.0
 */

    // Customizer option
    $defaults = edubin_generate_defaults();
    $ld_course_archive_style = get_theme_mod( 'ld_course_archive_style', $defaults['ld_course_archive_style']); 
    $ld_course_archive_clm = get_theme_mod( 'ld_course_archive_clm', $defaults['ld_course_archive_clm'] ); 
    $ld_custom_placeholder_image = get_theme_mod( 'ld_custom_placeholder_image', $defaults['ld_custom_placeholder_image'] ); 


    $ld_price_show = get_theme_mod( 'ld_price_show', $defaults['ld_price_show']);
    $ld_lesson_show = get_theme_mod( 'ld_lesson_show', $defaults['ld_lesson_show']);
    $ld_lesson_text_show = get_theme_mod( 'ld_lesson_text_show', $defaults['ld_lesson_text_show']);
    $ld_topic_show = get_theme_mod( 'ld_topic_show', $defaults['ld_topic_show']);
    $ld_topic_text_show = get_theme_mod( 'ld_topic_text_show', $defaults['ld_topic_text_show']);
    $ld_views_show = get_theme_mod( 'ld_views_show', $defaults['ld_views_show']);
    $ld_comment_show = get_theme_mod( 'ld_comment_show', $defaults['ld_comment_show']); 
    $see_more_btn = get_theme_mod( 'see_more_btn', $defaults['see_more_btn']); 
    $ld_progress_bar_show = get_theme_mod( 'ld_progress_bar_show', $defaults['ld_progress_bar_show']); 
    $ld_see_more_btn_text = get_theme_mod( 'ld_see_more_btn_text', $defaults['ld_see_more_btn_text']); 
    $free_custom_text = get_theme_mod( 'free_custom_text', $defaults['free_custom_text'] ); 
    $enrolled_custom_text = get_theme_mod( 'enrolled_custom_text', $defaults['enrolled_custom_text'] ); 
    $completed_custom_text = get_theme_mod( 'completed_custom_text', $defaults['completed_custom_text'] ); 
    $custom_closed_btn_url = get_theme_mod( 'custom_closed_btn_url', $defaults['custom_closed_btn_url'] ); 

    global $post; 
     $prefix = '_edubin_';
     $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;

    $custom_views_number = get_post_meta( $post->ID, 'custom_views_number', true );

    $enable_video = get_post_meta( $post->ID, '_learndash_course_grid_enable_video_preview', true );
    $embed_code   = get_post_meta( $post->ID, '_learndash_course_grid_video_embed_code', true );
    $button_text  = $ld_see_more_btn_text;

        // Retrive oembed HTML if URL provided
    if ( preg_match( '/^http/', $embed_code ) ) {
        $embed_code = wp_oembed_get( $embed_code, array( 'height' => 600, 'width' => 400 ) );
    }

    $button_text = isset( $button_text ) && ! empty( $button_text ) ? $button_text : esc_html__( 'See more', 'edubin' );

    $button_text = apply_filters( 'learndash_course_grid_custom_button_text', $button_text, $post_id );

    $options = get_option('sfwd_cpt_options');
    $currency = null;

    if ( ! is_null( $options ) ) {
        if ( isset($options['modules'] ) && isset( $options['modules']['sfwd-courses_options'] ) && isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) )
            $currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];
    }

    if( is_null( $currency ) )
        $currency = 'USD';

    $course_options = get_post_meta($post_id, "_groups", true);

    if ($free_custom_text) {
    $price = $course_options && isset($course_options['groups_group_price']) ? $course_options['groups_group_price'] : $free_custom_text;
    } else {
    $price = $course_options && isset($course_options['groups_group_price']) ? $course_options['groups_group_price'] : esc_html__( 'Free', 'edubin' );
    }
    


    $has_access   = sfwd_lms_has_access( $course_id, $user_id );
    $is_completed = learndash_course_completed( $user_id, $course_id );

    if( $price == '' )

        if ($free_custom_text) {
            $price .= $free_custom_text;
        } else {
            $price .= esc_html__( 'Free', 'edubin' );
        }
        

    if ( is_numeric( $price ) ) {
        if ( $currency == "USD" )
            $price = '$' . $price;
        else
            $price .= ' ' . $currency;
    }

    $class       = '';
    $ribbon_text = '';

    if ( $has_access && ! $is_completed ) {
        $class = 'ld_course_grid_price ribbon-enrolled';

        if ($enrolled_custom_text) {
            $ribbon_text = $enrolled_custom_text;
        } else {
            $ribbon_text = esc_html__( 'Enrolled', 'edubin' );
        }


    } elseif ( $has_access && $is_completed ) {
        $class = 'ld_course_grid_price';

        if ($completed_custom_text) {
            $ribbon_text = $completed_custom_text;
        } else {
            $ribbon_text = esc_html__( 'Completed', 'edubin' );
        }
        
    } else {
        $class = ! empty( $course_options['groups_group_price'] ) ? 'ld_course_grid_price price_' . $currency : 'ld_course_grid_price free';
        $ribbon_text = $price;
    }
?>
                 
<!--********* Custom code Add to fetch close url **********-->
<?php $meta= learndash_get_setting( $post_id );  
        $post_button_url   = ( isset( $meta['custom_button_url'] ) ) ? $meta['custom_button_url'] : '';

        if ( empty( $post_button_url ) ) {
        $post_button = '';
        } else {
        $post_button_url = trim( $post_button_url );
        /**
        * If the value does NOT start with [http://, https://, /] we prepend the home URL.
        */
        if ( ( stripos( $post_button_url, 'http://', 0 ) !== 0 ) && ( stripos( $post_button_url, 'https://', 0 ) !== 0 ) && ( strpos( $post_button_url, '/', 0 ) !== 0 ) ) {
        $post_button_url = get_home_url( null, $post_button_url );
        }

        }

?> <!--************ Custom code Add to fetch close url End *************-->

<div class="col-lg-<?php echo esc_attr($ld_course_archive_clm); ?> col-sm-6">
    <?php if ($ld_course_archive_style == '1' || $ld_course_archive_style == '2' || $ld_course_archive_style == '3') : ?>
        <div class="edubin-single-course-1 mb-30 ld-course">
            <div class="thum">
                <?php if ( has_post_thumbnail() ):?>
                    <div class="image">
                        <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                            <?php the_post_thumbnail();?>
                        </a>
                    </div>
           
            <?php elseif($ld_custom_placeholder_image) : ?>
                <figure class="image">
                    <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                        <img src="<?php echo esc_url($ld_custom_placeholder_image); ?>" alt="placeholder">
                    </a>
                </figure>
              <?php else : ?>
              <?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
                  <figure class="image">
                      <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                          <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                      </a>
                  </figure>
                <?php endif; ?>

                <?php if($ld_price_show == '1') : ?>
                    <div class="edubin-course-price-<?php echo esc_html($ld_course_archive_style); ?>">
                        <?php if ( $price) : ?>
                            <?php if ($ld_course_archive_style == '2' || $ld_course_archive_style == '3') : ?>
                               <span><?php echo esc_html($price); ?></span>
                               <?php else : ?>
                                <span><?php $price = str_replace('.00', '', $price); echo esc_html($price); ?></span>
                            <?php endif; ?> 

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="course-content">

            <div class="edubin-course-cat">
                <i class="flaticon-folder-1"></i>
                <span><?php echo get_the_term_list(get_the_ID(), 'ld_group_category', '', '', ''); ?></span>
            </div>
            <?php 
            if($post_button_url && $custom_closed_btn_url) :
                $get_custom_closed_url = $post_button_url; 
            else : 
                $get_custom_closed_url = get_the_permalink(); 
            endif;?>
             <?php
                the_title( sprintf( '<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url( $get_custom_closed_url ) ), '</a></h2>' );
             ?>

             <?php if( $ld_lesson_show == '1' || $ld_topic_show == '1' || $ld_views_show == '1' || $ld_comment_show == '1' || $see_more_btn == '1') : ?>
                <div class="course-bottom">
                    <div class="course-meta">
                        <ul>
                            <?php if($ld_lesson_show == '1') : ?>  
                              <?php  
                                $lesson  = learndash_get_course_steps( get_the_ID(), array('sfwd-lessons') );
                                $lesson = $lesson ? count($lesson) : 0;
                                $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin'); ?>
                                <li> 
                                   <i class="flaticon-play-button"></i>
                                    <?php echo esc_html($lesson); ?>
                                    <?php if ($ld_lesson_text_show): ?>
                                    <?php echo esc_html($lesson_text); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>

                            <?php if($ld_topic_show == '1') : ?>  
                              <?php  
                                $topic  = learndash_get_course_steps( get_the_ID(), array('sfwd-topic') );
                                $topic = $topic ? count($topic) : 0;
                                $topic_text = ('1' == $topic) ? esc_html__('Topic', 'edubin') : esc_html__('Topics', 'edubin'); ?>
                                <li> 
                                   <i class="flaticon-play"></i>
                                    <?php echo esc_html($topic); ?>
                                    <?php if ($ld_topic_text_show): ?>
                                    <?php echo esc_html($topic_text); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                            <?php if($ld_views_show == '1') : ?>  

                                <?php if ($custom_views_number) : ?>
                                    <li><i class="flaticon-binoculars"></i> <?php echo esc_attr($custom_views_number); ?></li>
                                <?php else : ?>
                                    <?php if(function_exists('edubinGetPostViews')){ ?>
                                        <li><i class="flaticon-binoculars"></i> <?php echo esc_attr(edubinGetPostViews(get_the_ID())); ?></li>
                                    <?php } ?>
                                <?php endif; ?>

                            <?php endif; ?>

                            <?php if($ld_comment_show == '1') : ?>  
                                <li><i class="flaticon-chat-1"></i><a href="<?php get_comments_link();?>"> <?php echo esc_attr(get_comments_number()); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if($see_more_btn) : ?>  
                        <div class="see-more-btn">
                            <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>"><?php echo esc_html($button_text) ; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <?php elseif ($ld_course_archive_style == '4') : ?>
        <div class="edubin-single-course-2 ld-course">
            <div class="thum">
                <?php if ( has_post_thumbnail() ):?>
                    <div class="image">
                        <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                            <?php the_post_thumbnail();?>
                        </a>
                    </div>
              <?php elseif($ld_custom_placeholder_image) : ?>
                <figure class="image">
                    <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                        <img src="<?php echo esc_url($ld_custom_placeholder_image); ?>" alt="placeholder">
                    </a>
                </figure>
              <?php else : ?>
              <?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
                  <figure class="image">
                      <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                          <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                      </a>
                  </figure>
                <?php endif; ?>

                <?php if($ld_price_show == '1') : ?>
                    <div class="edubin-course-price-<?php echo esc_html($ld_course_archive_style); ?>">
                        <?php if ( $price) : ?>
                            <?php if ($ld_price_show == '2' || $ld_price_show == '3') : ?>
                               <span><?php echo esc_html($price); ?></span>
                               <?php else : ?>
                                <span><?php $price = str_replace('.00', '', $price); echo esc_html($price); ?></span>
                            <?php endif; ?> 
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if($ld_views_show == '1' || $ld_comment_show == '1' || $see_more_btn == '1') : ?>  
                    <div class="course-meta-area">
                        <?php if($see_more_btn) : ?>  
                            <div class="see-more-btn">
                                <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>"><?php echo esc_html($button_text) ; ?></a>
                            </div>
                        <?php endif; ?>

                        <div class="course-meta">
                            <ul>
                                <?php if($ld_views_show == '1') : ?>

                                <?php if ($custom_views_number) : ?>
                                    <li><i class="flaticon-binoculars"></i> <?php echo esc_attr($custom_views_number); ?></li>
                                <?php else : ?>
                                    <?php if(function_exists('edubinGetPostViews')){ ?>
                                        <li><i class="flaticon-binoculars"></i> <?php echo esc_attr(edubinGetPostViews(get_the_ID())); ?></li>
                                    <?php } ?>
                                <?php endif; ?>

                                <?php endif; ?>

                                <?php if($ld_comment_show == '1') : ?>  
                                    <li><i class="flaticon-chat-1"></i><a href="<?php get_comments_link();?>"> <?php echo esc_attr(get_comments_number()); ?></a></li>
                                <?php endif; ?>
                                
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="content">
            <?php 
            if($post_button_url && $custom_closed_btn_url) :
                $get_custom_closed_url = $post_button_url; 
            else : 
                $get_custom_closed_url = get_the_permalink(); 
            endif;?>
             <?php
                the_title( sprintf( '<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url( $get_custom_closed_url ) ), '</a></h2>' );
             ?>
            </div>
        </div> 
    <?php elseif ($ld_course_archive_style == '5') : ?>
    <?php
    /**
     * @package nmbs
     */

    global $post; $post_id = $post->ID;

    $course_id = $post_id;
    $user_id   = get_current_user_id();

    $cg_short_description = get_post_meta( $post->ID, '_learndash_course_grid_short_description', true );
    $enable_video = get_post_meta( $post->ID, '_learndash_course_grid_enable_video_preview', true );
    $embed_code   = get_post_meta( $post->ID, '_learndash_course_grid_video_embed_code', true );
    $button_text  = $ld_see_more_btn_text;

    // Retrive oembed HTML if URL provided
    if ( preg_match( '/^http/', $embed_code ) ) {
        $embed_code = wp_oembed_get( $embed_code, array( 'height' => 600, 'width' => 400 ) );
    }

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

    $course_options = get_post_meta($post_id, "_groups", true);
    $legacy_short_description = isset( $course_options['sfwd-courses_course_short_description'] ) ? $course_options['sfwd-courses_course_short_description'] : '';
    // For LD >= 3.0
    if ( function_exists( 'learndash_get_group_price' ) ) {
        $price_args = learndash_get_group_price( $course_id );
        $price = $price_args['price'];
        $price_type = $price_args['type'];
    } else {

        if ($free_custom_text) {
        $price = $course_options && isset($course_options['groups_group_price']) ? $course_options['groups_group_price'] : $free_custom_text;        
        } 
        else {
        $price = $course_options && isset($course_options['groups_group_price']) ? $course_options['groups_group_price'] : esc_html__( 'Free', 'edubin' );
        }
        

        $price_type = $course_options && isset( $course_options['groups_group_price_type'] ) ? $course_options['groups_group_price_type'] : '';
    }

    if ( ! empty( $cg_short_description ) ) {
        $short_description = $cg_short_description;
    } elseif ( ! empty( $legacy_short_description ) ) {
        $short_description = $legacy_short_description;
    } else {
        $short_description = '';
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
            $class .= ! empty( $course_options['groups_group_price'] ) ? ' price_' . $currency : ' free';
            $course_class .= ' learndash-not-available learndash-incomplete';
            $ribbon_text = $price_text;
        } else {
            $class .= ' custom';
            $course_class .= ' learndash-not-available learndash-incomplete';
        }
    }

    /**
     * Filter: individual course ribbon text
     *
     * @param string $ribbon_text Returned ribbon text
     * @param int    $course_id   Course ID
     * @param string $price_type  Course price type
     */
    $ribbon_text = apply_filters( 'learndash_course_grid_ribbon_text', $ribbon_text, $course_id, $price_type );

    if ( '' == $ribbon_text ) {
        $class = '';
    }

    /**
     * Filter: individual course ribbon class names
     *
     * @param string $class          Returned class names
     * @param int    $course_id      Course ID
     * @param array  $course_options Course's options
     * @var string
     */
    $class = apply_filters( 'learndash_course_grid_ribbon_class', $class, $course_id, $course_options );

    /**
     * Filter: individual course container class names
     *
     * @param string $course_class   Returned class names
     * @param int    $course_id      Course ID
     * @param array  $course_options Course's options
     * @var string
     */
    $course_class = apply_filters( 'learndash_course_grid_course_class', $course_class, $course_id, $course_options );

    $thumb_size = isset( $shortcode_atts['thumb_size'] ) && ! empty( $shortcode_atts['thumb_size'] ) ? $shortcode_atts['thumb_size'] : 'course-thumb';

    ob_start();
    ?>
  
        <div class="ld_course_grid">
            <article id="post-<?php the_ID(); ?>" <?php post_class( $course_class . ' thumbnail course' ); ?>>

                    <?php if ( $post->post_type == 'groups' ) : ?>
                    <div class="<?php echo esc_attr( $class ); ?>">
                        <?php echo wp_kses_post( $ribbon_text ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( 1 == $enable_video && ! empty( $embed_code ) ) : ?>
                    <div class="ld_course_grid_video_embed">
                    <?php echo $embed_code; ?>
                    </div>
                    <?php elseif( has_post_thumbnail() ) :?>
                    <a href="<?php echo esc_url( $button_link ); ?>" rel="bookmark">
                        <?php the_post_thumbnail( $thumb_size ); ?>
                    </a>
                    <?php elseif($ld_custom_placeholder_image) : ?>
                        <a href="<?php if($post_button_url && $custom_closed_btn_url) : echo esc_url($post_button_url); else : the_permalink(); endif;?>">
                            <img src="<?php echo esc_url($ld_custom_placeholder_image); ?>" alt="placeholder">
                        </a>
                    <?php else : ?>
                    <?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
                        <a href="<?php echo esc_url( $button_link ); ?>" rel="bookmark">
                            <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                        </a>
                    <?php endif;?>

                    <div class="caption">
                        
                        <div class="edubin-course-cat">
                            <i class="flaticon-folder-1"></i>
                            <span><?php echo get_the_term_list(get_the_ID(), 'ld_group_category', '', '', ''); ?></span>
                        </div>

                        <a href="<?php echo esc_url( $button_link ); ?>" rel="bookmark">
                            <h3 class="entry-title"><?php the_title(); ?></h3>
                        </a>

                        <?php if ( ! empty( $short_description ) ) : ?>
                        <p class="entry-content"><?php echo do_shortcode( htmlspecialchars_decode( $short_description ) ); ?></p>
                        <?php endif; ?>

                        <?php if($see_more_btn) : ?>  
                        <p class="ld_course_grid_button"><a class="btn btn-primary" role="button" href="<?php echo esc_url( $button_link ); ?>" rel="bookmark"><?php echo esc_attr( $button_text ); ?></a></p>
                        <?php endif; ?>
                        <?php if( isset( $shortcode_atts['progress_bar']) && $ld_progress_bar_show) : ?>  
                            <p><?php echo do_shortcode( '[learndash_course_progress course_id="' . get_the_ID() . '" user_id="' . get_current_user_id() . '"]' ); ?></p>
                        <?php endif; ?>

                    </div><!-- .entry-header -->
                <?php //endif; ?>
            </article><!-- #post-## -->
        </div>

    <?php endif; ?>
</div>
