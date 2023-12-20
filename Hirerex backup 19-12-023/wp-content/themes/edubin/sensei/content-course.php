<?php
/**
 * Content-course.php template file
 *
 * responsible for content on archive like pages. Only shows the course excerpt.
 *
 * For single course content please see single-course.php
 *
 * @author      Automattic
 * @package     Sensei
 * @category    Templates
 * @version     3.13.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$defaults = edubin_generate_defaults();

$course              = get_post( get_the_ID() );
// $category_output     = get_the_term_list( $course->ID, 'course-category', '', ', ', '' );
// $author_display_name = get_the_author_meta( 'display_name', $course->post_author );
// $lesson_length      = get_post_meta( get_the_ID(), '_lesson_length', true );
$lesson_count        = Sensei()->course->course_lesson_count( get_the_ID() );

// Sensei course archive price
$price_data = get_post_meta(get_the_ID(), '_course_woocommerce_product', true);

if ($price_data == '-' ) {
$final_price = 'free'; 
} else {
$final_price = $price_data; 
}


// Sensei course archive image size
$sensei_course_archive_clm = get_theme_mod( 'sensei_course_archive_clm', $defaults['sensei_course_archive_clm']); 
$sensei_archive_image_size = get_theme_mod( 'sensei_archive_image_size', $defaults['sensei_archive_image_size']); 

if ($sensei_archive_image_size == 'medium_large' ) {
$final_sensei_archive_image_size = 'medium_large'; 
} else {
$final_sensei_archive_image_size = !empty(get_intermediate_image_sizes()[$sensei_archive_image_size]);
}


?>
<div class="col-sm- col-md- col-lg-<?php echo esc_attr($sensei_course_archive_clm); ?>">
   <div class="edubin-course">
      <div class="course__container">
         <div class="course__media">

			<?php if ( has_post_thumbnail() ):?>
			      <a href="<?php the_permalink(); ?>">
			        <?php the_post_thumbnail($final_sensei_archive_image_size);?>
			      </a>
				<?php else : ?>

			<?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
			      <a href="<?php the_permalink(); ?>">
			          <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
			      </a>
			<?php endif; ?>

			<div class="course__categories ">
			<?php echo get_the_term_list(get_the_ID(), 'course-category'); ?>
			</div>

         </div>
         <div class="course__content">
            <div class="course__content--info">
               <h4 class="course__title"> <a href="<?php the_permalink(); ?>" class="course__title-link"> <?php the_title(); ?> </a></h4>

                <div class="author__name">
                  <?php //if ( $lp_instructor_img_on_off ): ?>
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                  <?php// endif; ?>

                <?php //if ( $lp_instructor_name_on_off ): ?>
                    <?php the_author() ?>
                 <?php// endif; ?>
                </div>

				<p class="course__excerpt">
					<?php echo wp_kses_post( get_the_excerpt() ); ?>
				</p>

            </div>

            <div class="course__content--meta">

               	<span class="course-lessons">
               		<i class="flaticon-book-1"></i> <?php echo esc_attr($lesson_count ); ?> 
					<?php //if ($settings['show_lesson_text']): ?>
					<?php esc_html_e( 'Lessons', 'edubin' ); ?>
					<?php //endif; ?>
               	</span>

               <div class="price"> <span class="price"><?php echo esc_html($final_price); ?></span></div>

            </div>
         </div>
      </div>
   </div>
</div>