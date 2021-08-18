<?php
get_header();
$background_image = get_theme_support( 'custom-header', 'default-image' );

if ( has_header_image() ) {
  $background_image = get_header_image();
}
?>
<!-- Blog & Sidebar Section -->
<div class="breadcrumb-section" style="background-image: url(<?php echo esc_url( $background_image ); ?>);">
	<div class="d-table">
		<div class="d-table-cell">
			<div class="container">
				<div class="breadcrumb-title text-center">
				<?php 
					if ( class_exists( 'WooCommerce' ) ) {
					if ( is_shop() ) {
						echo '<h1>';
							woocommerce_page_title();
						echo '</h1>';
					}
					elseif(is_cart() || is_checkout()) {
							
							the_title(  '<h1>', '</h1>' );	
						}
					else { 
				
						the_title(  '<h1>', '</h1>' ); 
					} 
				} ?>
				</div>
				
				<div class="breadcrumb-page text-center">
					<ul>
						<?php if (function_exists('ce_breadcrumbs_fun')) ce_breadcrumbs_fun();?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="section-padding" id="site-content">
	<div class="container">
		<div class="row">	
			<!--Blog Section-->
			<div class="col-lg-<?php echo ( !is_active_sidebar( 'woocommerce' ) ? '12' :'8' ); ?> col-12">
		        <div class="site-content">
			     <?php woocommerce_content(); ?>
			    </div>
            </div>				
			<!--/Blog Section-->
			<?php get_sidebar('woocommerce'); ?>
		</div>
	</div>
</section>
<!-- /Blog Section with Sidebar -->
<?php get_footer();