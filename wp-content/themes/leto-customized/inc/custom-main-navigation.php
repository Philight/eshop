<?php
/*
	Added icons to Account area (login/register)
	rework structure maybe	
*/

add_action( 'init', 'remove_actions_leto_navigation');
function remove_actions_leto_navigation() {
	remove_action( 'leto_inside_header', 'leto_main_navigation', 9 );
};

add_action( 'wp_enqueue_scripts', 'tthq_add_custom_fa_css' );
function tthq_add_custom_fa_css() {
	wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
}

add_action( 'wp_enqueue_scripts', 'add_icomoon_fonts_css' );
function add_icomoon_fonts_css() {
	wp_enqueue_style( 'custom-icons', get_stylesheet_directory_uri() . '/icomoon/style.css' );
}

add_action( 'leto_inside_header', 'override_leto_main_navigation', 9 );
function override_leto_main_navigation() {
	?>
		<nav id="site-navigation" class="main-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->	

		<div class="header-mobile-menu">
			<div class="header-mobile-menu__inner">
				<button class="toggle-mobile-menu">
					<span><?php esc_html_e( 'Toggle menu', 'leto' ); ?></span>
				</button>
			</div>
		</div><!-- /.header-mobile-menu -->		


		<?php $show_menu_additions = get_theme_mod( 'leto_show_menu_additions', 1 ); ?>
		<?php if ( $show_menu_additions ) : ?>
		<ul class="nav-link-right">
			<li class="nav-link-account">
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php if ( is_user_logged_in() ) { ?>
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="Account">
							<i class="icon icon-user-circle-o"></i> 
						</a>
					<?php } 
					else { ?>
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="Login">
							<span class="login-register">
								<i class="icon icon-person-o"></i> 
								<?php esc_html_e( 'Login/Register', 'leto' ); ?>
							</span> 
						</a>
					<?php } ?>
				<?php else : ?>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login">
						<span class="login-register">
							<i class="icon icon-person-o"></i> 
							<?php esc_html_e( 'Login/Register', 'leto' ); ?>
						</span> 
					</a>
				<?php endif; ?>
			</li>

			<?php if ( class_exists( 'Woocommerce' ) ) : ?>

			<?php $cart_content = WC()->cart->cart_contents_count; ?>

			<li class="nav-link-cart">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart-link">
					<i class="ion-bag"></i>
					<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'leto' ); ?></span>
					<span class="cart-count">(<?php echo intval($cart_content); ?>)</span>
				</a>
				<div class="sub-menu cart-mini-wrapper">
					<div class="cart-mini-wrapper__inner">
					<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</li>
			<?php endif; //end Woocommerce class_exists check ?>
			
			<?php
			$enable_search = get_theme_mod( 'leto_enable_search', 1 );
			if ( $enable_search ) : ?>
			<li class="nav-link-search">
				<a href="#" class="toggle-search-box">
					<i class="ion-ios-search"></i>
				</a>
			</li>
			<?php endif; ?>

		</ul>
		<?php endif; ?>

	<?php
}
