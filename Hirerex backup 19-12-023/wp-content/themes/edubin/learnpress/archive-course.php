<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
do_action( 'learn-press/template-header' );

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );
$defaults = edubin_generate_defaults();
// Customizer option
$lp_course_archive_style = get_theme_mod( 'lp_course_archive_style', $defaults['lp_course_archive_style']); 
$lp_header_top = get_theme_mod( 'lp_header_top', $defaults['lp_header_top']); 

?>


<div class="lp-content-area">


	<?php if ($lp_header_top): ?>

	<?php 
		if ( is_category() ) {
			$total = get_queried_object();
			$total = $total->count;
		} elseif ( !empty( $_REQUEST['s'] ) ) {
			$total = $wp_query->found_posts;
		} else {
			$total = wp_count_posts( 'post' );
			$total = $total->publish;
		}

		if ( $total == - 1 ) {
			echo '<p class="message message-error">' . esc_html__( 'There are no available posts!', 'edubin' ) . '</p>';
			return;
		} elseif ( $total == 1 ) {
			$index = esc_html__( 'Showing only one result', 'edubin' );
		} else {
			$courses_per_page = absint( get_option( 'posts_per_page' ) );
			$paged            = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

			$from = 1 + ( $paged - 1 ) * $courses_per_page;
			$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

			if ( $from == $to ) {
				$index = sprintf(
					__( 'Showing last post of %s results', 'edubin' ),
					$total
				);
			} else {
				$index = sprintf(
					__( 'Showing %s-%s of %s results', 'edubin' ),
					$from,
					$to,
					$total
				);
			}
		} ?>
		<div class="courses-top-search">
			<ul class="nav float-left" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid" role="tab" aria-controls="courses-grid" aria-selected="true"><i class="fas fa-th-large"></i></a>
				</li>
				<li class="nav-item">
					<a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab" aria-controls="courses-list" aria-selected="false"><i class="fas fa-th-list"></i></a>
				</li>
				<li class="nav-item"><?php echo esc_html($index) ; ?></li>

			</ul> <!-- nav -->
			
			<div class="courses-search float-right">
				<div class="courses-searching">
					<form method="get" action="<?php echo esc_url( get_post_type_archive_link( 'lp_course' ) ); ?>">
						<input type="text" value="" name="s" placeholder="<?php esc_attr_e( 'Search our courses', 'edubin' ) ?>" class="form-control course-search-filter" autocomplete="off" />
						<input type="hidden" value="course" name="ref" />
						<button type="submit"><i class="flaticon-zoom"></i></button>
						<span class="widget-search-close"></span>
					</form>
					<ul class="courses-list-search list-unstyled"></ul>
				</div>
			</div> <!-- courses search -->
		</div> <!-- courses top search -->
	<?php endif; ?>

	<div class="edubin-lp-course-wrapper-<?php echo esc_attr($lp_course_archive_style); ?>">
		<?php 
			//echo '<div class="row">'; ?>
			<?php if(is_active_sidebar( 'lp-course-sidebar-1' )): ?>
				<div class="<?php if(is_active_sidebar( 'lp-course-sidebar-1' )):  echo 'col-md-8 has-lp-sidebar'; endif;?>">
			<?php endif; ?>
			<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
					<div class="learn-press-courses">
					<?php 
					

                      if ( have_posts() ) : ?>
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                
                             	learn_press_get_template_part( 'content', 'course-grid' );
                
                            endwhile;
                
                            the_posts_pagination( array(
                                'prev_text' => '<i class="flaticon-back" aria-hidden="true"></i>',
                                'next_text' => '<i class="flaticon-next" aria-hidden="true"></i>',
                            ) );
                
                        else :
                
                            get_template_part( 'template-parts/post/content', 'none' );
                
                        endif; 
						
					?>
					</div>
				</div>

				<div class="tab-pane fade" id="courses-list" role="tabpanel" aria-labelledby="courses-list-tab">
					<div class="learn-press-courses">
					<?php 
					

                      if ( have_posts() ) : ?>
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                
                              learn_press_get_template_part( 'content', 'course-list' );
                
                            endwhile;
                
                            the_posts_pagination( array(
                                'prev_text' => '<i class="flaticon-back" aria-hidden="true"></i>',
                                'next_text' => '<i class="flaticon-next" aria-hidden="true"></i>',
                            ) );
                
                        else :
                
                            get_template_part( 'template-parts/post/content', 'none' );
                
                        endif; 
						
					?>
					</div>
				</div>

			</div>

		<?php if(is_active_sidebar( 'lp-course-sidebar-1' )): ?>
		</div>

		<div class="col-md-4">
			<div id="secondary" class="widget-area">
		    	<?php dynamic_sidebar( 'lp-course-sidebar-1' ); ?>
			</div>
		</div> 
		<?php endif; ?>

		<?php	
		//echo '</div>'; ?>
	</div>


<?php
	/**
	 * LP Hook
	 */
	do_action( 'learn-press/after-main-content' );

	?>
</div>

<?php
/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
do_action( 'learn-press/template-footer' );
