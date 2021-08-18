<header class="site-header header-style-2 dark-version">
		<!-- middle header -->
		<div class="main-header-wrapper navbar-expand-lg">
			<div class="main-header clearfix">
				<!-- top bar -->
				<?php if ( is_active_sidebar( 'top-header-right' ) ) { ?>
				<div class="top-bar">
					<div class="container">
						<div class="row d-flex justify-content-between">
						
						<?php if ( is_active_sidebar( 'top-header-right' ) ) { ?>
									<div class="col-12 ce-top-bar-right d-flex justify-content-lg-end justify-content-center">
										<?php dynamic_sidebar( 'top-header-right'); ?>
									</div>
								<?php } 
									 ?>
							
							
							
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="sticky-header">
					<div class="container clearfix">
						<div class="ce-logo">
							<?php consultera_site_branding(); ?>
						</div>
						
						<div class="menu-area">
							<div class="d-flex justify-content-end align-items-center">
								<button class="navbar-toggler justify-content-end collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'corpera' ); ?>">
				                    <span class="fa fa-bars" aria-hidden="true"></span>
				                </button>
				               
							</div>
				            <nav class="navbar-collapse collapse mainmenu justify-content-end" id="navbarNavDropdown">
			                    <?php
												   wp_nav_menu(
												array(
													'theme_location'  => 'primary',
													'container'  => 'nav-collapse collapse navbar-inverse-collapse',
													'menu_class' => 'nav navbar-nav',
													'fallback_cb'     => 'Consultera_Bootstrap_Navwalker::fallback',
													'walker'          => new Consultera_Bootstrap_Navwalker(),
												)
											);
										$HeaderButtonText = get_theme_mod('action_button_text','');
										$HeaderButtonLink = get_theme_mod('action_button_link','#');
										if($HeaderButtonText!=''){?>
										   <div class="extra-nav">
												<a href="<?php echo esc_url ($HeaderButtonLink);?>" class="default-button bg-blue button-md effect-1">
													<span class="btn-text"><?php echo esc_html($HeaderButtonText);?></span>
												</a>
											</div>
									<?php } ?>
				            </nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- main header END -->
	</header>
	<!-- SEARCH MODAL START -->
