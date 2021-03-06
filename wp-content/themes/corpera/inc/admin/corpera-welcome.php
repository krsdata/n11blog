<?php
/**
 * Add admin notice
*/

add_action( 'admin_notices', 'corpera_admin_notice'  );
add_action( 'wp_ajax_dismiss_admin_notice', 'corpera_dismiss_admin_notice' );
add_action( 'admin_enqueue_scripts', 'corpera_welcome_static'  );

 
function corpera_admin_notice() {
	if ( is_admin() && ! get_user_meta( get_current_user_id(), 'welcome_box' ) ) {
		?>
		
		
		
		<div class="updated notice is-dismissible corpera-admin-notice" data-notice="welcome_box">
			<h1><?php
			$theme_info = wp_get_theme();
			printf( esc_html__('Congratulations, Welcome to %1$s Theme', 'corpera'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) ); ?>
			</h1>
			<p><?php echo sprintf( esc_html__("Thank you for choosing Corpera theme. To take full advantage of the complete features of the theme, you have to go to our %1\$s welcome page %2\$s.", "corpera"), '<a href="' . esc_url( admin_url( 'themes.php?page=corpera-welcome' ) ) . '">', '</a>' ); ?></p>
			
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=corpera-welcome' ) ); ?>" class="button button-blue-secondary button_info" style="text-decoration: none;"><?php echo esc_html__('Get started with Cusicorp','corpera'); ?></a></p>
		</div>
		
		
		<?php
	}
}


/**
 * Dismiss admin notice
 */
function corpera_dismiss_admin_notice() {

	// Nonce check.
	check_ajax_referer( 'corpera_dismiss_admin_notice', 'nonce' );

	// Bail if user can't edit theme options.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error();
	}

	$notice = isset( $_POST['notice'] ) ? sanitize_text_field( wp_unslash( $_POST['notice'] ) ) : '';

	if ( $notice ) {
		update_user_meta( get_current_user_id(), $notice, true );
		wp_send_json_success();
	}

	wp_send_json_error();
}

/**
 * Load welcome screen script and css
 */
function corpera_welcome_static() {
	// Dismiss admin notice.
	wp_enqueue_script(
		'corpera-dismiss-admin-notice',
		get_stylesheet_directory_uri() . '/inc/admin/js/dismiss-admin-notice.js',
		'1.0',
		true
	);
	
	wp_enqueue_script(
		'corpera-install-demo',
		get_stylesheet_directory_uri() . '/inc/admin/js/install-demo.js',
		array('updates'),
		'1.0',
		true
	);
	

	wp_localize_script(
		'corpera-dismiss-admin-notice',
		'corpera_dismiss_admin_notice',
		array(
			'nonce' => wp_create_nonce( 'corpera_dismiss_admin_notice' ),
		)
	);

	// Welcome screen style.
	wp_enqueue_style('corpera-admin-styles', get_stylesheet_directory_uri().'/inc/admin/css/corpera-welcome.css');

}



add_action('admin_menu', 'corpera_welcome_page');


// corpera welcome page register
function corpera_welcome_page() {
	$wpazure_page_title =  apply_filters( 'corpera_menu_page_title', __( 'Corpera Options', 'corpera' ) );
    add_theme_page('Corpera Theme Options', $wpazure_page_title, 'edit_theme_options', 'corpera-welcome', 'corpera_settings_page');
}

function corpera_settings_page(){
	?>
  <div class="corpera-admin wrap">
  	<?php	do_action( 'corpera_settings_content' ); ?>
  </div><!-- /.wrap -->
  <?php
}


/**
 * Customizer settings link
 */
function corpera_info_customizer_settings() {
	$customizer_settings = apply_filters(
		'corpera_panel_customizer_settings',
		array(
			'upload_logo' => array(
				'icon'     => 'dashicons dashicons-format-image',
				'name'     => __( 'Upload Logo', 'corpera' ),
				'type'     => 'control',
				'setting'  => 'custom_logo',
				'required' => '',
			),
			
			'home_section' => array(
				'icon'     => 'dashicons dashicons-admin-settings',
				'name'     => __( 'Home section settings', 'corpera' ),
				'type'     => 'panel',
				'setting'  => 'homepage_sections',
				'required' => '',
			),
			
			'widget' => array(
				'icon'     => 'dashicons dashicons-tagcloud',
				'name'     => __( 'Widgets', 'corpera' ),
				'type'     => 'section',
				'setting'  => 'sidebar-widgets-top-header-left',
				'required' => '',
			),
		)
	);

	return $customizer_settings;
}


add_action( 'corpera_settings_content', 'corpera_welcome_render_options_page' );

function corpera_welcome_render_options_page() {  

$corpera_url = 'https://wpazure.com';
			?>
	<div class="corpera-options-wrap admin-welcome-screen">


				<div class="corpera-enhance">
					<div class="corpera-info-container">
						<div class="corpera-enhance-content">
							<div class="corpera-enhance__column corpera-bundle">
								<h3><?php esc_html_e( 'Link to Customizer Settings', 'corpera' ); ?></h3>
								<div class="corpera-quick-setting-section">
									<ul class="corpera-list">
									<?php
									foreach ( corpera_info_customizer_settings() as $key ) {
										$url = get_admin_url() . 'customize.php?autofocus[' . $key['type'] . ']=' . $key['setting'];

										$disabled = '';
										$title    = '';
										if ( '' !== $key['required'] && ! class_exists( $key['required'] ) ) {
											$disabled = 'disabled';

											/* translators: 1: Class name */
											$title = sprintf( __( '%s not activated.', 'corpera' ), ucfirst( $key['required'] ) );

											$url = '#';
										}
										?>

										<li class="link-to-customie-item <?php echo esc_attr( $disabled ); ?>" title="<?php echo esc_attr( $title ); ?>">
											<a class="wst-quick-setting-title wp-ui-text-highlight" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
												<span class="<?php echo esc_attr( $key['icon'] ); ?>"></span>
												<?php echo esc_html( $key['name'] ); ?>
											</a>
										</li>

									<?php } ?>
									</ul>
									
									
								</div>
							</div>

								
						
							
								<div class="corpera-enhance__column corpera-pro-featured pro-featured-list">
									<h3>
										<a class="corpera-learn-more wp-ui-text-highlight" href="https://www.wpazure.com/consultera-pro/" target="_blank"><?php esc_html_e( 'Get The consultera Pro Version!', 'consultera' ); ?></a>
									</h3>

									<div class="corpera-quick-setting-section">
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Top Header', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Multiple Slider Layout and Video Background', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Multiple Header & Footer Layout', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'About section', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Unlimited Servives', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Unlimited Portfolio', 'corpera' ); ?>
											</strong>
											
										</div>
										
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Unlimited Testimonial', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Pricing Section', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Team section', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Client section', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( '17 Page Templates', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Multiple Portfolio Layouts', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Multiple Blog Layouts', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Theme section Layout Manager', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Theme Section Hooks', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Theme settings', 'corpera' ); ?>
											</strong>
											
										</div>
										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Typography', 'corpera' ); ?>
											</strong>
											
										</div>

										<div class="pro-featured-item">
											<strong class="pro-featured-name">
												<?php esc_html_e( 'Read more about pro', 'corpera' ); ?>
											</strong>
											<p>
										<a href="<?php echo esc_url( $corpera_url ); ?>/consultera-pro" class="corpera-button button-primary" target="_blank"><?php esc_html_e( 'Read more', 'consultera' ); ?></a>
									</p>
										</div>
										
									</div>
								</div>
						</div>

						<div class="corpera-enhance-sidebar">
							<?php do_action( 'corpera_pro_panel_sidebar' ); ?>

							<div class="corpera-enhance__column">
								<h3><?php esc_html_e( 'About Theme', 'corpera' ); ?></h3>

								<div class="corpera-quick-setting-section">
									<img src="<?php echo esc_url(  get_stylesheet_directory_uri(). '/images/banner.jpg' ); ?>" alt="corpera Banner" />

									<p>
										<?php esc_html_e( 'corpera is a modern,responsive and fully customizable lightning fast WordPress theme for professionals. This theme comes with a stunning COOL & BEAUTIFUL LOOK, SERVICE SECTION, PORTFOLIO SECTION, TESTIMONIAL SECTION, WOOCOMMERCE PRODUCT SECTION, CALL TO ACTION SECTION, BLOG POST SECTION. ', 'corpera' ); ?>
									</p>

									<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="corpera-button button-primary " target="_blank"><?php echo esc_html__( 'Go to customizer', 'corpera' ); ?></a>
		
								</div>
							</div>
							
							<div class="corpera-enhance__column">
								<h3><?php esc_html_e( 'Recommend Plugins', 'corpera' ); ?></h3>
								
								
								<?php
									$plugin_slug = 'wpazure-kit';
									$slug        = 'wpazure-kit/wpazure-kit.php';
									$redirect    = admin_url( 'admin.php?page=corpera-welcome' );
									$nonce       = add_query_arg(
										array(
											'action'        => 'activate',
											'plugin'        => rawurlencode( $slug ),
											'plugin_status' => 'all',
											'paged'         => '1',
											'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug ),
										),
										network_admin_url( 'plugins.php' )
									);

									// Check corpera Sites status.
									$type = 'install';
									if ( file_exists( ABSPATH . 'wp-content/plugins/' . $plugin_slug ) ) {
										$activate = is_plugin_active( $plugin_slug . '/wpazure-kit.php' ) ? 'activate' : 'deactivate';
										$type = $activate;
									}

									
									$button = '<a href="' . esc_url( admin_url( 'customize.php' ) ) . '" class="corpera-button " target="_blank">' . esc_html__( 'Plugin activated', 'corpera' ) . '</a>';

									
									if ( ! defined( 'WPAZURE_KIT_VERSION' ) ) {
										if ( 'deactivate' == $type ) {
											$button = '<a data-redirect="' . esc_url( $redirect ) . '" data-slug="' . esc_attr( $slug ) . '" class="corpera-button button corpera-active-now" href="' . esc_url( $nonce ) . '">' . esc_html__( 'Activate', 'corpera' ) . '</a>';
										} else {
											$button = '<a data-redirect="' . esc_url( $redirect ) . '" data-slug="' . esc_attr( $plugin_slug ) . '" href="' . esc_url( $nonce ) . '" class="corpera-button install-now button corpera-install-demo">' . esc_html__( 'Install Wpazure kit', 'corpera' ) . '</a>';
										}
									}

									// Data.
									wp_localize_script(
										'corpera-install-demo',
										'corpera_install_demo',
										array(
											'activating' => esc_html__( 'Activating', 'corpera' ),
										)
									);
									?>
									<div class="corpera-quick-setting-section">
										<p>
											<?php echo $button; // WPCS: XSS ok. ?>
										</p>
									</div>

								
							</div>

							<div class="corpera-enhance__column">
								<h3><?php esc_html_e( 'Learn More', 'corpera' ); ?></h3>

								<div class="corpera-quick-setting-section">
									<p>
										<?php esc_html_e( 'Want to know more about corpera? Click on the below link to read full detail.', 'corpera' ); ?>
									</p>

									<p>
										<a href="<?php echo esc_url( $corpera_url ); ?>/corpera-free/" class="corpera-button"><?php esc_html_e( 'Visit Us', 'corpera' ); ?></a>
									</p>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
	
<?php }
