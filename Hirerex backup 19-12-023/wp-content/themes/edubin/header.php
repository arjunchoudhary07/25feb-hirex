<?php
/**
 * Theme header 
 * @subpackage Edubin
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="//gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php
  $post_id = edubin_get_id();
  $prefix = '_edubin_';
  $defaults = edubin_generate_defaults();

  $page_bg_color = get_post_meta($post_id, $prefix . 'page_bg_color', true);
  $header_top_show = get_theme_mod('header_top_show', $defaults['header_top_show']);
  $header_variations = get_theme_mod('header_variations', $defaults['header_variations'] );
  $sticky_header_enable = get_theme_mod('sticky_header_enable', $defaults['sticky_header_enable']);
  $page_header_show = get_theme_mod('page_header_show', $defaults['page_header_show']); 
  $lp_single_page_layout = get_theme_mod('lp_single_page_layout', $defaults['lp_single_page_layout']); 
  $edubin_header_type = get_theme_mod( 'edubin_header_type', $defaults['edubin_header_type']); 
  $edubin_get_elementor_header = get_theme_mod( 'edubin_get_elementor_header', $defaults['edubin_get_elementor_header']); 
  $tutor_hide_profile_page_header = get_theme_mod( 'tutor_hide_profile_page_header', $defaults['tutor_hide_profile_page_header']); 

  // CMB2
  $page_header_enable = get_post_meta($post_id, $prefix . 'page_header_enable', true);
  $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

  $mb_customize_header_layout = get_post_meta($post_id, $prefix . 'mb_customize_header_layout', true);
  $mb_elementor_header = get_post_meta($post_id, $prefix . 'mb_elementor_header', true);

  wp_head(); ?>
	
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N2D7FK8');</script>
<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?> <?php if(!empty($page_bg_color)): ?>style="background-color: <?php echo esc_attr($page_bg_color); ?>"<?php endif; ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site', 'preloader' ); ?>

  <div id="page" class="site <?php if($sticky_header_enable == '0'): echo esc_attr( 'is-header-sticky-main'); endif; ?> <?php if($header_top_show == '1'): echo esc_attr( 'is-header-top-main'); endif; ?>">
<?php 


    if ($mb_customize_header_layout == 'mb_elementor_header') { ?>
            <header id="header" class="header-sections <?php if($sticky_header_enable == '1'): echo esc_attr( 'is-header-sticky'); endif; ?> edubin-header-builder">
                <div class='edubin-container-wrap container-fluid'>
                   <?php   
                   if ($mb_elementor_header) {
                          $mb_elementor_header_id = intval($mb_elementor_header);

                          if (did_action('elementor/loaded')) {
                              echo \Elementor\Plugin::$instance->frontend->get_builder_content($mb_elementor_header_id);
                          }
                      } ?>
                </div>
            </header> 
          
   <?php } 
   elseif ($edubin_header_type == 'edubin_elementor_header') { ?>
            <header id="header" class="header-sections <?php if($sticky_header_enable == '1'): echo esc_attr( 'is-header-sticky'); endif; ?> edubin-header-builder">
                <div class='edubin-container-wrap container-fluid'>
                   <?php   
                   if ($edubin_get_elementor_header) {
                          $header_page_select_id = intval($edubin_get_elementor_header);

                          if (did_action('elementor/loaded')) {
                              echo \Elementor\Plugin::$instance->frontend->get_builder_content($header_page_select_id);
                          }
                      } ?>
                </div>
            </header> 

        <?php  } else { // Show theme header ?>

            <header id="header" class="header-sections <?php if($sticky_header_enable == '1'): echo esc_attr( 'is-header-sticky'); endif; ?>">

              <?php if ($header_top_show == '1'): ?>
                   <div class="header-top">
                        <div class="container">
                            <?php get_template_part( 'template-parts/header/header', 'top' ); ?>
                       </div>
                   </div>
              <?php endif; ?>

                <div class="container">
                  <?php 
                        if( $header_variations == 'header_v1') :
                          get_template_part( 'template-parts/header/header', 'v1' );
                        elseif( $header_variations == 'header_v2') :
                          get_template_part( 'template-parts/header/header', 'v2' ); 
                        elseif( $header_variations == 'header_v3') :
                          get_template_part( 'template-parts/header/header', 'v3' ); 
                        else : 
                          get_template_part( 'template-parts/header/header', 'v2' );
                       endif; 
                   ?>
               </div>
             </header> 

      <?php } //End elementor header theme ?>

     <?php if($page_header_show == true):  ?>
        <?php         
        if(class_exists('LearnPress') && is_singular( 'lp_course' ) && $lp_single_page_layout == '2') :
            // Hide header for LearnPress

        // global $wp;
        // $wp->parse_request();

        // elseif ( strpos( home_url($wp->request), '/profile/') !== false) : 
        // // Hide header for Tutor LMS profile page

        elseif(!is_front_page() && $page_header_enable == 'enable'):  ?>
          <section class="page-header" style="background-image: url('<?php if ($page_header_img): ?><?php echo esc_url($page_header_img); ?><?php else : ?><?php echo esc_url( get_header_image() ); ?><?php endif ?>');">
            <div class="container">
             <?php get_template_part( 'template-parts/header/page-header' ); ?>
           </div>
         </section>
       <?php elseif($page_header_enable == !'enable'):  ?>
          <section class="page-header" style="background-image: url('<?php if ($page_header_img): ?><?php echo esc_url($page_header_img); ?><?php else : ?><?php echo esc_url( get_header_image() ); ?><?php endif ?>');">
            <div class="container">
             <?php get_template_part( 'template-parts/header/page-header' ); ?>
           </div>
         </section>
     <?php endif;?>
 
   <?php endif;?>

   
 <div id="content" class="site__content <?php if($page_header_enable == 'disable'): echo esc_attr( 'page-header-disable' ); endif; ?> ">