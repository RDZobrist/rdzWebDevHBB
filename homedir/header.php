<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">



	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta name="author" content="WPTemplates.Net" />

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->



	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>



<?php

	$themecolor = get_option('themecolor');

	

	if($themecolor == '')

		$themecolor = '/themecolor/black/color.css';

	else

		$themecolor = '/themecolor/' . $themecolor .'/color.css';

?>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); echo $themecolor; ?>" type="text/css" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/custom.css" type="text/css" />

	<link rel="stylesheet" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<!--[if IE 6]>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style-ie.css" />

<![endif]-->


<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script> 	



	<?php wp_head(); ?>



</head>



<body>



<div id="container">

	<!-- Header Start -->

	<div id="header-top">

		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>

		

	</div>		

	<!-- Header End -->



	<!-- Menu Start -->

	<div id="menu">

		<div id="nav-left">

			<div id="nav-right">

				<div id="nav">

					<ul style="float:right;">

						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'main-menu' ) ); ?>

					</ul>		

				</div>				  

			</div>

		</div>

	</div>

	<!-- Menu End -->





