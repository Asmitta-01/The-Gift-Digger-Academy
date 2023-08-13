<?php

/**
 * The header for our theme
 *
 * @subpackage Education Academy Coach
 * @since 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	} else {
		do_action('wp_body_open');
	}
	?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'education-academy-coach'); ?></a>
	<?php if (get_option('education_insight_theme_loader') == '1') { ?>
		<div class="preloader">
			<div class="load">
				<hr />
				<hr />
				<hr />
				<hr />
			</div>
		</div>
	<?php } ?>
	<div id="page" class="site">
		<div class="top_header">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 col-md-9 box-center">
						<?php if (get_option('education_insight_topbar_enable', false) != '1') { ?>
							<div class="my-2">
								<?php if (get_theme_mod('education_insight_call') != '') { ?>
									<span><i class="fas fa-phone"></i><?php echo esc_html(get_theme_mod('education_insight_call', '')); ?></span>
								<?php } ?>
								<?php if (get_theme_mod('education_insight_email') != '') { ?>
									<span><i class="far fa-envelope"></i><?php echo esc_html(get_theme_mod('education_insight_email', '')); ?></span>
							<?php }
							} ?>
							<?php if (class_exists('woocommerce')) { ?>
								<span class="account">
									<?php if (is_user_logged_in()) { ?>
										<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php esc_html_e('MY ACCOUNT', 'education-academy-coach'); ?></a>
									<?php } else { ?>
										<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php esc_html_e('LOGIN / REGISTER', 'education-academy-coach'); ?></a>
									<?php } ?>
								</span>
							<?php } ?>
							</div>
					</div>
					<div class="col-lg-5 col-md-3 box-center">
						<?php if (get_option('header_social_icon_enable', false) != 'off') { ?>
							<?php
							$education_insight_header_fb_target = esc_attr(get_option('education_insight_header_fb_target', 'true'));
							$education_insight_header_twt_target = esc_attr(get_option('education_insight_header_twt_target', 'true'));
							$education_insight_header_linkedin_target = esc_attr(get_option('education_insight_header_linkedin_target', 'true'));
							$education_insight_header_pintrest_target = esc_attr(get_option('education_insight_header_pintrest_target', 'true'));
							?>
							<div class="links">
								<?php if (get_theme_mod('education_insight_facebook') != '') { ?>
									<a <?php if ($education_insight_header_fb_target != 'off') { ?>target="_blank" <?php } ?>href="<?php echo esc_url(get_theme_mod('education_insight_facebook', '')); ?>">
										<i class="<?php echo esc_html(get_theme_mod('education_insight_facebook_icon', 'fab fa-facebook-f')); ?>"></i>
									</a>
								<?php } ?>
								<?php if (get_theme_mod('education_insight_twitter') != '') { ?>
									<a <?php if ($education_insight_header_twt_target != 'off') { ?>target="_blank" <?php } ?>href="<?php echo esc_url(get_theme_mod('education_insight_twitter', '')); ?>">
										<i class="<?php echo esc_html(get_theme_mod('education_insight_twitter_icon', 'fab fa-twitter')); ?>"></i></a>
								<?php } ?>
								<?php if (get_theme_mod('education_insight_linkedin') != '') { ?>
									<a <?php if ($education_insight_header_linkedin_target != 'off') { ?>target="_blank" <?php } ?>href="<?php echo esc_url(get_theme_mod('education_insight_linkedin', '')); ?>">
										<i class="<?php echo esc_html(get_theme_mod('education_insight_linkedin_icon', 'fab fa-linkedin-in')); ?>"></i>
									</a>
								<?php } ?>
								<?php if (get_theme_mod('education_insight_pintrest') != '') { ?>
									<a <?php if ($education_insight_header_pintrest_target != 'off') { ?>target="_blank" <?php } ?>href="<?php echo esc_url(get_theme_mod('education_insight_pintrest', '')); ?>">
										<i class="<?php echo esc_html(get_theme_mod('education_insight_pintrest_icon', 'fab fa-pinterest-p')); ?>"></i>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div id="header">
			<div class="wrap_figure fixed_header">
				<div class="container">
					<div class="row ">
						<div class="col-lg-3 col-md-3 box-center">
							<div class="logo">
								<?php if (has_custom_logo()) : ?>
									<?php the_custom_logo(); ?>
								<?php endif; ?>
								<?php $education_academy_coach_blog_info = get_bloginfo('name'); ?>
								<?php if (!empty($education_academy_coach_blog_info)) : ?>
									<?php if (is_front_page() && is_home()) : ?>
										<?php if (get_option('education_insight_logo_title', '') != 'off') { ?>
											<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
										<?php } ?>
									<?php else : ?>
										<?php if (get_option('education_insight_logo_title', '') != 'off') { ?>
											<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>

								<?php
								$education_academy_coach_description = get_bloginfo('description', 'display');
								if ($education_academy_coach_description || is_customize_preview()) :
								?>
									<?php if (get_option('education_insight_logo_text', '') != 'off') { ?>
										<p class="site-description">
											<?php echo esc_html($education_academy_coach_description); ?>
										</p>
									<?php } ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-7 col-md-5 col-3 box-center">
							<div class="theme-menu">
								<?php if (has_nav_menu('primary-3')) { ?>
									<div class="toggle-menu gb_menu">
										<button onclick="education_insight_gb_Menu_open()" class="gb_toggle"><i class="fas fa-ellipsis-h"></i>
											<p><?php esc_html_e('Menu', 'education-academy-coach'); ?></p>
										</button>
									</div>
								<?php } ?>
								<?php get_template_part('template-parts/navigation/navigation-top'); ?>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-9 box-center">
							<div class="admision-btn">
								<?php if (!is_user_logged_in() && (get_theme_mod('education_insight_admission_text') != '' || get_theme_mod('education_insight_admission_link') != '')) { ?>
									<a href="<?= wp_login_url() ?>"><?php echo esc_html(get_theme_mod('education_insight_admission_text', '')); ?></a>
								<?php } elseif (is_user_logged_in()) { ?>
									<a href="<?= wp_logout_url(wp_get_referer()) ?>">Se déconnecter</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>