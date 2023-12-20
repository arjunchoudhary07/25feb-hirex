<?php
/**
 * The template for displaying archive pages
 * @package Edubin
 * Version: 1.0.0
 */

get_header(); ?>
<div class="container">
    <div id="primary" class="content-area edubin-learndash">
        <main id="main" class="site-main" role="main">
            <div class="edubin-ld-course-list-items row">   
                <?php
                if ( have_posts() ) : ?>
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/post/learndash', 'content');

                    endwhile;

                    the_posts_pagination( array(
                        'prev_text' => '<i class="flaticon-back" aria-hidden="true"></i>',
                        'next_text' => '<i class="flaticon-next" aria-hidden="true"></i>',
                    ) );

                else :

                    get_template_part( 'template-parts/post/content', 'none' );

                endif; ?>
            </div><!-- .row -->

        </main><!-- #main -->
    </div><!-- #primary -->
</div>
<?php get_footer();
