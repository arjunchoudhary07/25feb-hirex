<?php
    $post_id = edubin_get_id();
    $prefix = '_edubin_';
    $defaults = edubin_generate_defaults();
    $page_header_enable = get_post_meta($post_id, $prefix . 'page_header_enable', true);
    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);
    $breadcrumb_show = get_theme_mod( 'breadcrumb_show', $defaults['breadcrumb_show']); 
    $shortcode_breadcrumb = get_theme_mod( 'shortcode_breadcrumb', $defaults['shortcode_breadcrumb']); 
    $header_variations = get_theme_mod( 'header_variations', $defaults['header_variations'] );
    $header_title_tag = get_theme_mod( 'header_title_tag', $defaults['header_title_tag'] );
?>

    <?php if(function_exists( 'is_woocommerce' ) && is_woocommerce()){ ?>

        <?php echo '<'.$header_title_tag.' class="page-title">'; ?>
            <?php woocommerce_page_title(); ?>
        <?php echo '</'.$header_title_tag.'>' ?>

       <?php } elseif(function_exists( 'tribe_events' ) && tribe_is_month() && is_archive()){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php esc_html_e( 'Events Calendar', 'edubin'); ?><?php echo '</'.$header_title_tag.'>' ?>

       <?php } elseif(function_exists( 'tribe_events' ) && is_single() && is_singular( 'tribe_events' )){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php single_post_title(); ?><?php echo '</'.$header_title_tag.'>' ?>

    <?php } elseif(is_page() || is_single()){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php echo esc_html( get_the_title() ); ?><?php echo '</'.$header_title_tag.'>' ?>

    <?php } elseif( is_search() ){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php printf( __( 'Search Results for: %s', 'edubin' ), '<span>' . get_search_query() . '</span>' ); ?><?php echo '</'.$header_title_tag.'>' ?>

    <?php }elseif( is_404() ){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php esc_html_e( 'Page Not Found: 404', 'edubin'); ?><?php echo '</'.$header_title_tag.'>' ?>

    <?php }elseif( is_home() ){ ?>

         <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php single_post_title(); ?><?php echo '</'.$header_title_tag.'>' ?>
        
    <?php } 

    else {
        if(is_archive()) {
            the_archive_title( '<'.$header_title_tag.' class="page-title">', '</'.$header_title_tag.'>' ); 
        }
        ?>

        <?php if ( is_single() ) { ?>
             <?php echo '<'.$header_title_tag.' class="page-title">'; ?><?php single_post_title(); ?><?php echo '</'.$header_title_tag.'>' ?>
        <?php  }
        
    }
    ?>
    <?php if($breadcrumb_show == '1'): ?>
        <div class="header-breadcrumb">
            <?php if($shortcode_breadcrumb) : ?>
                <?php echo do_shortcode( $shortcode_breadcrumb ); ?>
            <?php else : ?>
                <?php edubin_breadcrumb_trail(); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>



