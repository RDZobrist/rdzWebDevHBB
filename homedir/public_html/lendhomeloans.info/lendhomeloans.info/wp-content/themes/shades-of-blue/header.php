<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="language" content="en" />

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<link rel="Shortcut Icon" href="<?php echo bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php //if(is_user_logged_in()){header("Location: ".bloginfo('url')."wp-login.php");} ?>


</head>

<body>
<?php echo 'test'; ?>
<?php //echo wp_login_url( $redirect ); ?> 
<div id="header">

    <div class="headerleft">
		<?php if (is_home()) { ?>
        	<h1><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
        <?php } else { ?>
        	<h4><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h4>
        <?php } ?>    
       		<p><?php bloginfo('description'); ?></p>
    </div>
		
	<div class="headerright">
    
	<ul id="nav">
		<?php if (is_home()) { ?>
            <li class="current_page_item"><a href="<?php echo get_option('home'); ?>">Home</a></li>
        <?php } else { ?>
            <li><a href="<?php echo get_option('home'); ?>">Home</a></li>
        <?php } ?>    
        <?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
	</ul>
    
	</div>

</div>

<div class="clear"></div>

<div id="wrap">