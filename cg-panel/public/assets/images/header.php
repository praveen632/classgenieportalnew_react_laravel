<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astrid
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/master.css">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="preloader">
<div class="preloader-inner">
	<ul><li></li><li></li><li></li><li></li><li></li><li></li></ul>
</div>
</div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'astrid' ); ?></a>

	<header class="header pageRow overflow-visible fixed-header">
			<div class="wrapper">
				<div class="header-outer">
					<div class="header-inner">
						<div class="header-top row">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><a href="http://classgenie.in/" class="logo"></a></div>

						</div>
					</div>
				</div>
			</div>
		</header>>

	<?php if ( astrid_has_header() == 'has-header' ) : ?>
	<div class="header-image">
		<?php astrid_header_text(); ?>
		
		<?php $mobile_default = get_template_directory_uri() . '/images/header-mobile.jpg'; ?>
		<?php $mobile = get_theme_mod('mobile_header', $mobile_default); ?>
		<?php if ( $mobile ) : ?>
		<img class="small-header" src="<?php echo esc_url($mobile); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">
		<?php else : ?>
		
		<?php endif; ?>
	</div>
	<?php elseif ( astrid_has_header() == 'has-shortcode' ) : ?>
	<div class="shortcode-area">
		<?php $shortcode = get_theme_mod('astrid_shortcode'); ?>
		<?php echo do_shortcode(wp_kses_post($shortcode)); ?>
	</div>
	<?php else : ?>
	<div class="header-clone"></div>
	<?php endif; ?>	

	<?php if ( !is_page_template('page-templates/page_widgetized.php') ) : ?>
		<?php $container = 'container'; ?>
	<?php else : ?>
		<?php $container = 'home-wrapper'; ?>
	<?php endif; ?>

	<?php do_action('astrid_before_content'); ?>

	<div id="content" class="site-content">
		<div class="<?php echo $container; ?>">