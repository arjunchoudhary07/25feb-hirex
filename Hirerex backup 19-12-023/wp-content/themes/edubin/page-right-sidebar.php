<?php
/**
* Template Name: Page With Right Sidebar
*/

get_header(); ?>
<div class="container">
	<div class="row">

		<div class="col-md-8">
		    <?php
		        while ( have_posts() ) : the_post();

		            get_template_part( 'template-parts/page/content', 'page' );

		            // If comments are open or we have at least one comment, load up the comment template.
		            if ( comments_open() || get_comments_number() ) :
		                comments_template();
		            endif;

		        endwhile; // End of the loop.
		    ?>
		</div>

        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div> 
        
	</div>
</div>
<?php get_footer();
