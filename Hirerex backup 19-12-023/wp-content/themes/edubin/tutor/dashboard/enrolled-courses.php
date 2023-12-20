<?php

/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */
    $disable_course_duration = get_tutor_option('disable_course_duration');
    $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
    $disable_update_date = get_tutor_option('disable_course_update_date');
    $course_duration = get_tutor_course_duration_context();


    $defaults = edubin_generate_defaults();
    $tutor_course_archive_style = get_theme_mod( 'tutor_course_archive_style', $defaults['tutor_course_archive_style']);
    $tutor_instructor_img_on_off = get_theme_mod( 'tutor_instructor_img_on_off', $defaults['tutor_instructor_img_on_off']);
    $tutor_instructor_name_on_off = get_theme_mod( 'tutor_instructor_name_on_off', $defaults['tutor_instructor_name_on_off']);
    $tutor_price_show = get_theme_mod( 'tutor_price_show', $defaults['tutor_price_show']);


/**
 * Pagination info
 */
$per_page = tutor_utils()->get_option( 'pagination_per_page', 10 );
$paged    = (isset($_GET['current_page']) && is_numeric($_GET['current_page']) && $_GET['current_page'] >= 1) ? $_GET['current_page'] : 1;
$offset     = ($per_page * $paged) - $per_page;

$page_tabs = array(
	'enrolled-courses'                   => __('Enrolled Courses', 'edubin'),
	'enrolled-courses/active-courses'    => __('Active Courses', 'edubin'),
	'enrolled-courses/completed-courses' => __('Completed Courses', 'edubin'),
);

// Default tab set
(!isset($active_tab, $page_tabs[$active_tab])) ? $active_tab = 'enrolled-courses' : 0;

// Get Paginated course list
$courses_list_array = array(
	'enrolled-courses'                   => tutor_utils()->get_enrolled_courses_by_user(get_current_user_id(), array('private', 'publish'), $offset, $per_page),
	'enrolled-courses/active-courses'    => tutor_utils()->get_active_courses_by_user(null, $offset, $per_page),
	'enrolled-courses/completed-courses' => tutor_utils()->get_courses_by_user(null, $offset, $per_page),
);

// Get Full course list
$full_courses_list_array = array(
	'enrolled-courses'                   => tutor_utils()->get_enrolled_courses_by_user(get_current_user_id(), array('private', 'publish')),
	'enrolled-courses/active-courses'    => tutor_utils()->get_active_courses_by_user(),
	'enrolled-courses/completed-courses' => tutor_utils()->get_courses_by_user(),
);


// Prepare course list based on page tab
$courses_list =  $courses_list_array[$active_tab];
$paginated_courses_list =  $full_courses_list_array[$active_tab];

?>

<div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-16 tutor-capitalize-text"><?php esc_html_e($page_tabs[$active_tab]); ?></div>
<div class="tutor-dashboard-content-inner enrolled-courses">
	<div class="tutor-mb-32">
		<ul class="tutor-nav" tutor-priority-nav>
			<?php foreach ($page_tabs as $slug => $tab) : ?>
				<li class="tutor-nav-item">
					<a class="tutor-nav-link<?php echo $slug == $active_tab ? ' is-active' : ''; ?>" href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink($slug)); ?>">
						<?php
						echo esc_html($tab);

						$course_count = ($full_courses_list_array[$slug] && $full_courses_list_array[$slug]->have_posts()) ? count($full_courses_list_array[$slug]->posts) : 0;
						if ($course_count) :
							echo esc_html('&nbsp;(' . $course_count . ')');
						endif;
						?>
					</a>
				</li>
			<?php endforeach; ?>

			<li class="tutor-nav-item tutor-nav-more tutor-d-none">
				<a class="tutor-nav-link tutor-nav-more-item" href="#"><span class="tutor-mr-4"><?php _e("More", "edubin"); ?></span> <span class="tutor-nav-more-icon tutor-icon-times"></span></a>
				<ul class="tutor-nav-more-list tutor-dropdown"></ul>
			</li>
		</ul>
	</div>

	<?php if ($courses_list && $courses_list->have_posts()) : ?>
		<div class="tutor-grid tutor-grid-3 edubin__tutor___enrolled-courses">
			<?php
			while ($courses_list->have_posts()) :
				$courses_list->the_post();

		    echo '<div class="layout__'.$tutor_course_archive_style.'">';

		        if ($tutor_course_archive_style == '2') :        
		            get_template_part( 'tutor/loop/layout', '2'); 
		        elseif ($tutor_course_archive_style == '3') :
		            get_template_part( 'tutor/loop/layout', '3'); 
		        elseif ($tutor_course_archive_style == '4') :
		            get_template_part( 'tutor/loop/layout', '4');
		        else :       
		        	tutor_load_template('loop.course');           
		        endif; //End course style

			echo '</div>';
	
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		
		<div class="tutor-mt-20">
			<?php
			if ($paginated_courses_list->found_posts > $per_page) :
				$pagination_data = array(
					'total_items' => $paginated_courses_list->found_posts,
					'per_page'    => $per_page,
					'paged'       => $paged,
				);
				tutor_load_template_from_custom_path(
					tutor()->path . 'templates/dashboard/elements/pagination.php',
					$pagination_data
				);
			endif;
			?>
		</div>
	<?php else : ?>
		<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
	<?php endif; ?>
</div>