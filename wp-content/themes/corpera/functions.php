<?php
function corpera_css() {
	
	wp_enqueue_style( 'consultera-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'corpera-style', get_stylesheet_uri(), array( 'consultera-parent-style' ));
	
	wp_enqueue_style('corpera-color-default',get_stylesheet_directory_uri() .'/css/default.css');
	wp_dequeue_style('consultera-color-default');
	
	wp_enqueue_style( 'owl-carousel-css', get_stylesheet_directory_uri() . '/js/owl-carousel/css/owl.carousel.min.css' );
	
	wp_enqueue_script( 'owl-carousel-scripts', get_stylesheet_directory_uri() . '/js/owl-carousel/js/owl.carousel.min.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'corpera-custom-script', get_stylesheet_directory_uri() . '/js/custom.js');
}
add_action( 'wp_enqueue_scripts', 'corpera_css',999);


if ( is_admin() ) {

 require_once( get_stylesheet_directory(). '/inc/admin/corpera-welcome.php' );
 }

   	

/**
 * All categories
 */
if ( ! function_exists( 'corpera_all_categories' ) ) :
function corpera_all_categories() {
	$Separate_meta = ', ';
	$categories_list = get_the_category_list($Separate_meta);

	if ( $categories_list ) {
		echo '<li class="post-category">' . $categories_list . '</li>';
	}
}
endif;


if ( ! function_exists( 'corpera_get_tags' ) ) :
function corpera_get_tags(){
	
/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list();
	if ( $tag_list ) {
	echo '<li class="ce-tags">' . $tag_list .'</li>';
	}
}
endif;



/**
 * Before Footer 
 */
function corpera_footer_before(){
	do_action( 'corpera_footer_before' );
}

/**
 * widget Footer 
 */
function corpera_footer(){
	do_action( 'corpera_footer' );
}

/**
 * After Footer 
 */
function corpera_footer_after(){
	do_action( 'corpera_footer_after' );
}

/**
 * Scroll to top button 
 */
function corpera_scroll_to_top(){
	do_action( 'corpera_scroll_to_top' );
}

function remove_some_widgets(){
 
    // Unregister some of the TwentyTen sidebars
    unregister_sidebar( 'top-header-left' );
  
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );

/**
 * Function to get site Footer
 */
if ( ! function_exists( 'corpera_footer_markup' ) ) {

	/**
	 * Site Footer - <footer>
	 */
	function corpera_footer_markup() { ?>
		
		<!-- FOOTER SECTION START -->
		<footer class="main-footer">
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
					<div class="col-md-4 col-12">
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>	
					</div>
					<?php endif; 
					if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
					<div class="col-md-4 col-12">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>	
					</div>
					<?php endif; 
					if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
					<div class="col-md-4 col-12">
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>	
					</div>
					<?php endif; ?>
				</div>
				<!-- #Footer bottom section -->
				
				
				<div class="copyright-wrapper">
				<div class="container">
					<div class="copyright-bar">
						<div class="col-md-12 col-sm-12 col-xs-12">
							
							<a href="<?php echo esc_url( __( 'https://ninja11.in/', '' ) ); ?>">
		Powered By Ninja11
	</a
						</div>
					</div>
				</div>
			</div>
				<!-- End of Footer bottom -->
			</div>
		</footer>
		<!-- FOOTER SECTION END -->
		
	<?php }

}

add_action( 'corpera_footer', 'corpera_footer_markup' );

add_filter('get_custom_logo','corpera_logo_class');


	function corpera_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}
	
	
// Register panels, sections, settings, controls, and partials.
	add_action( 'customize_register', 'corpera_header_sections'  );
	function corpera_header_sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Consultera_Get_Pro_Section' );

		// Register sections.
		$manager->add_section(
			new Consultera_Get_Pro_Section(
				$manager,
				'consultera_upsell',
				array(
					'pro_text' => esc_html__( 'Go To Consultera pro',  'consultera' ),
					'pro_url'  => '//www.wpazure.com/consultera-pro/',
					'priority' => 0,
				)
			)
		);
	}
	
	
	add_action( "customize_register", "corpera_remove_default_customize_register" );
function corpera_remove_default_customize_register( $wp_customize ) {



 // Theme Options Panel
$wp_customize->add_panel( 'header_settings', 
    array(
        'priority'       => 10,
        'title'            => __( 'Header Settings', 'corpera' ),
        
    ) 
);

// Text Options Section Inside Theme
$wp_customize->add_section( 'header_settings_section', 
    array(
        'title'         => __( 'Action button', 'corpera' ),
        'priority'      => 1,
        'panel'         => 'header_settings'
    ) 
);

// Setting for Copyright text.
$wp_customize->add_setting( 'action_button_text',
    array(
        'default'           => __( 'Call Us ', 'corpera' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    )
);

// Control for Copyright text
$wp_customize->add_control( 'action_button_text', 
    array(
        'type'        => 'text',
        'priority'    => 10,
        'section'     => 'header_settings_section',
        'label'       => 'Button Text',
    ) 
);

// Setting for Copyright text.
$wp_customize->add_setting( 'action_button_link',
    array(
        'default'           => __( '#', 'corpera' ),
        'sanitize_callback' => 'corpera_sanitize_text_content',
        'transport'         => 'refresh',
    )
);

// Control for Copyright text
$wp_customize->add_control( 'action_button_link', 
    array(
        'type'        => 'text',
        'priority'    => 10,
        'section'     => 'header_settings_section',
        'label'       => 'Button Link',
    ) 
);

if ( ! function_exists( 'corpera_sanitize_text_content' ) ) :
		
			function corpera_sanitize_text_content( $input, $setting ) {

				return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

			}
		endif;

}
