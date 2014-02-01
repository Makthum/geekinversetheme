<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="../wp-content/themes/geekinverse/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../wp-content/themes/geekinverse/css/animations.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister' rel='stylesheet' type='text/css'>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="site-wrapper" class="container-fluid">

<div id="page" class="container-fluid">
	<div class="container-fluid ">
	<div class="row-fluid header">
	<div id="header_image">
	
	
		<div class="col-md-6 col-md-offset-4 header-logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			
		<img class="img-responsive img-circle" src=" http://localhost/wp-content/uploads/2014/01/cropped-33849605aba749efb3bef9cad833c03051f9c6e3c7f3ac80-stocklarge3.jpg">
		</img>
		</a>
	
	
	</div>
	</div>
	<div class="row-fluid">
	<div class="span12">
	

		
	
<nav id="header-navigation" class="navbar navbar-default navigation-menu" role="navigation">
 <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-md1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                GeekInverse
            </a>
        </div>
				<?php wp_nav_menu( array( 'theme_location' => 'Header-nav', 'menu_class' => 'nav-menu nav navbar-nav navbar-inner','container'=>'div','container_class'=>'collapse navbar-collapse navbar-md1-collapse' ) ); ?>
				
			</nav>	
	
			</div>
		</div>
			<div class="row-fluid">	
			<div class="span12">

		
		
		<div class="header-Strip">
    <div id="Strip-0"></div>
    <div id="Strip-1"></div>
    <div id="Strip-2"></div>
    <div id="Strip-3"></div>
    <div id="Strip-4"></div>
    <div id="Strip-5"></div>
    </div>
	</div>
	</div>
	<!-- #masthead -->
</div>
	<div id="main" class="container-fluid">