<?php
/**
 * Learndash compatibility
 *
 * @package Edubin
 */

/**
 * Display related courses sidebar
 */
if ( ! function_exists( 'edubin_Learndash_related_courses' ) ) {
	function edubin_Learndash_related_courses() { ?>
  <?php 

      // Customizer option
      $defaults = edubin_generate_defaults();
      $ld_related_course_views = get_theme_mod( 'ld_related_course_views', $defaults['ld_related_course_views']); 
      $ld_related_course_price = get_theme_mod( 'ld_related_course_price', $defaults['ld_related_course_price']); 
      $ld_related_course_heading = get_theme_mod( 'ld_related_course_heading', $defaults['ld_related_course_heading']); 

      $ld_see_more_btn_text = get_theme_mod( 'ld_see_more_btn_text', $defaults['ld_see_more_btn_text']); 
      $free_custom_text = get_theme_mod( 'free_custom_text', $defaults['free_custom_text'] ); 
      $enrolled_custom_text = get_theme_mod( 'enrolled_custom_text', $defaults['enrolled_custom_text'] ); 
      $completed_custom_text = $ld_see_more_btn_text; 
  ?>
        <div class="edubin-related-course ld-related-course">
            <?php if ($ld_related_course_heading) { ?>
              <h2 class="widget-title"><?php echo $ld_related_course_heading; ?></h2>
           <?php } else { ?>
              <h2 class="widget-title"><?php esc_html_e('You May Like', 'edubin'); ?></h2>
            <?php }
             ?>

            <?php
            $tags = wp_get_post_terms( get_queried_object_id(), 'ld_course_tag', ['fields' => 'ids'] );
            $args = [
              'post__not_in'        => array( get_queried_object_id() ),
              'posts_per_page'      => 3,
              'post_type'        => 'sfwd-courses',
              'ignore_sticky_posts' => 1,
              'orderby'             => 'rand',
              'tax_query' => [
                  [
                      'taxonomy' => 'ld_course_tag',
                      'terms'    => $tags
                  ]
              ]
          ];

          $my_query = new wp_query( $args );
          if( $my_query->have_posts() ) {
              while( $my_query->have_posts() ) {
                  $my_query->the_post(); ?>

                <?php
                  global $post; 
                   $prefix = '_edubin_';
                   $post_id = $post->ID;
                  $course_id = $post_id;
                  $user_id   = get_current_user_id();
                  $current_id = $post->ID;
                  
                  $custom_views_number = get_post_meta( $post->ID, 'custom_views_number', true );

                  $enable_video = get_post_meta( $post->ID, '_learndash_course_grid_enable_video_preview', true );
                  $embed_code   = get_post_meta( $post->ID, '_learndash_course_grid_video_embed_code', true );
                  $button_text  = get_post_meta( $post->ID, '_learndash_course_grid_custom_button_text', true );


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

                $course_options = get_post_meta($post_id, "_sfwd-courses", true);

                if ($free_custom_text) {
                  $price = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : $free_custom_text;
                } else {
                    $price = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : __( 'Free', 'edubin' );
                }
                
              

                $has_access   = sfwd_lms_has_access( $course_id, $user_id );
                $is_completed = learndash_course_completed( $user_id, $course_id );

                if( $price == '' )

                  if ($free_custom_text) {
                    $price .= $free_custom_text;
                  } else {
                    $price .= __( 'Free', 'edubin' );
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
                    if ($free_custom_text) {
                      $ribbon_text = $free_custom_text;
                    } else {
                      $ribbon_text = __( 'Free', 'edubin' );
                    }

                } elseif ( $has_access && $is_completed ) {
                    $class = 'ld_course_grid_price';
                    if ($completed_custom_text) {
                      $ribbon_text = $completed_custom_text;
                    } else {
                      $ribbon_text = __( 'Completed', 'edubin' );
                    }
                } else {
                    $class = ! empty( $course_options['sfwd-courses_course_price'] ) ? 'ld_course_grid_price price_' . $currency : 'ld_course_grid_price free';
                    $ribbon_text = $price;
                }

                ?>

                <div class="single-maylike">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="image">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="cont">
                       <a href="<?php the_permalink(); ?>">
                        <h4><?php the_title(); ?></h4>
                    </a>
                    <ul>
                        <?php if ($ld_related_course_views) : ?>

                        <?php if ($custom_views_number) : ?>
                           <li class="enroll-student"><i class="flaticon-binoculars"></i> <?php echo esc_attr($custom_views_number); ?></li>
                        <?php else : ?>

                          <?php if(function_exists('edubinGetPostViewsCustom')){ ?>
                            <li class="enroll-student"><i class="flaticon-binoculars"></i> <?php echo esc_attr(edubinGetPostViewsCustom(get_the_ID())); ?></li>
                          <?php } ?>
                        <?php endif; ?>

     

                        <?php endif; ?>

                        <?php if ($ld_related_course_price) : ?>
                          <li><span class="course-origin-price"><?php echo esc_attr( $ribbon_text ); ?></span>							
                          </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        <?php } 
        wp_reset_postdata(); 
    } ?>
</div>
<?php
}
}
