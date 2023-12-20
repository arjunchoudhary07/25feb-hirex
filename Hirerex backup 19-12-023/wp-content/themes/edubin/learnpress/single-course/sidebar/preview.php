<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;


$defaults = edubin_generate_defaults();
$lp_intro_video_position = get_theme_mod( 'lp_intro_video_position', $defaults['lp_intro_video_position']); 
?>

<div class="course-sidebar-preview lp">
      <?php $intro_video = get_post_meta( get_the_ID(), 'edubin_lp_video', 1 ); ?>

      <?php if ($intro_video && $lp_intro_video_position == 'intro_video_content') : ?>

      <div class="intro-video-sidebar intro-video-content">
        <div class="intro-video" style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'large')); ?>)"> <a href="<?php echo esc_url( $intro_video ); ?>" class="edubin-popup-videos bla-2"><span class="fas fa-play"></span></a>
        </div>
      </div>  
    <?php elseif($intro_video && $lp_intro_video_position == 'intro_video_sidebar') : ?>
    <!--   the video will be show on sidebar -->
    <?php else : ?>
    <?php if ( has_post_thumbnail()):?>
	<div class="media-preview">
		<?php
		LP()->template( 'course' )->course_media_preview();
		learn_press_get_template( 'loop/course/badge-featured' );
		?>
	</div>
    <?php endif; ?>

    <?php endif; ?>

	<?php
	// Price box.
	LP()->template( 'course' )->course_pricing();

	// Graduation.
	LP()->template( 'course' )->course_graduation();

	// Buttons.
	LP()->template( 'course' )->course_buttons();

	LP()->template( 'course' )->user_time();

	LP()->template( 'course' )->user_progress();

	edubin_course_info();
	?>
</div>
