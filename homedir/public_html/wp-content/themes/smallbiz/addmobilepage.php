<?php

/*

Template Name: Additional Mobile Page

*/

  $hideSidebar = true;

?>

<head>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<meta http-equiv="Content-Type" value="application/xhtml+xml" /> 
<meta name="viewport" content="width=320px; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />

<style>

/* Reset */

a, abbr, acronym, address, area, b, bdo, big, blockquote, body, button, caption, cite,
code, col, colgroup, dd, del, dfn, div, dl, dt, em, fieldset, form, h1, h2, h3, h4,
h5, h6, hr, html, i, images, ins, kbd, label, legend, li, map, object, ol, p, param, pre,
q, samp, small, span, strong, sub, sup, table, tbody, td, textarea, tfoot, th, thead,
tr, tt, ul, var {margin:0;padding:0;vertical-align:baseline}

#headerstrip{
	background-image:url(<?php bloginfo('template_url'); ?>/images/mobile/mobile-header.jpg);
	background-repeat:repeat-x;
}
	
#footerstrip{
	background-image:url(<?php bloginfo('template_url'); ?>/images/mobile/mobile-header.jpg);
	background-repeat:repeat-x;
}
	
#footer-mobile-switch{
	background-image:url(<?php bloginfo('template_url'); ?>/images/mobile/mobile-header.jpg);
background-repeat:repeat-x;
}

h1{
font-size:19px;
text-align:center;
color:black;
}

h2{
font-size:16px;
color:black;
}

p{
font-size:18px;
color:black;
font-family:Helvetica, sans-serif;
margin:1em 0 1em 0;
}

#content p{
margin-right: 0px;
}

a{
text-decoration: none;
}

#footer,
#page,#content,
#pagewrap,
#head, #site-wrap{
width:320px;
margin:0 auto;
}

#pagewrap{background-color:#<?php echo biz_option('smallbiz_mobile-body-color')?>;}

#headerstrip{
padding: 10px;
font-family: Arial; 
font-size: 1.2em;
}

#headerstrip h2{
text-align:center;
}

#mobile-text{
padding:10px;
}

#home-link{
margin-top:10px;
}

#home-link img{
border:none;
}
 
#mobilehomeimage{
float: left;
margin-bottom: 2px;
margin-right: 10px;
}
 
#footerstrip{
margin: 0 auto;
margin-top:3px;
font-family: Arial; 
font-size: 1.2em;
}

#footerstrip p{
text-align:center;
font-size:10px;
color: black;
}

#footer a{
color:white;
}

#footer b{
color:white;
}

/*  Hide our full site UI elements: */
#footer .footercenter,
#featured,
#access,
#header { 
    display:none; 
}

/* Change others: */
#page{
    background:none;
    width:auto;
}
#site-wrap{    
    margin-top:0px;
}
#content{
    padding:0;
    float:none;
    margin:auto;   
}
#footer #site-ui-switch-link {
    display:block; margin:auto;
    text-align:center;
}
</style>

<title><?php echo biz_option('smallbiz_title');?></title>
<meta name="description" content="<?php echo biz_option('smallbiz_description');?>"/>
<meta name="keywords" content="<?php echo biz_option('smallbiz_keywords');?>" />
<?php echo biz_option('smallbiz_analytics');?>	     
</head>
<body>

<div id="pagewrap">

<div id="headerstrip">

<h1>
<a style="color:black;text-decoration:none;" href="<?php bloginfo('url'); ?>">
<?php echo biz_option('smallbiz_name');/* bloginfo('name'); */ ?>
</a>
</h1>

<h2 style="color:black;"><?php echo biz_option('smallbiz_sub_header'); /* bloginfo('description'); */ ?>
</h2>

</div> <!--close headerstrip-->

<div id="mobile-text">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

		<?php if(!is_page('home')) :?><?php endif; ?>

			<div class="entry">

							<?php global $more; $more = false; ?>

<?php the_content('...Continue Reading'); ?>

<?php $more = true; ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>

		</div>

		<?php endwhile; endif; ?>



<div id="home-link">
<a style="text-decoration:none;color:#000;" href="<?php bloginfo('url'); ?>"><img src="http://www.e2beta.com/3.7.2alpha/wp-content/themes/smallbiz/images/mobile/home.png" alt="mobile-back-home"><br />(Mobile Home)</a>
</div>

</div> <!--closing mobile text-->

<div id="footerstrip">
<p><?php echo biz_option('smallbiz_credit');?></p>
</div> <!--close footerstrip-->

</div> <!--close pagewrap-->
</body>
