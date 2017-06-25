<?php get_header(); ?>

<div id="content">

<div class="topbox">
<div class='feedlist'>
<ul>
	<li><a href="<?php bloginfo('rss2_url'); ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" title="subscribe" alt="RSS"/></a></li>
	<li><a href="<?php $face = get_option('cupi_face'); echo ($face); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" title="Facebook" alt="Facebook"/></a></li> 
	<li><a href="http://twitter.com/<?php $twit = get_option('cupi_twit'); echo ($twit); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" title="Twitter" alt="Twitter"/></a></li> 
	<li><a href="<?php $linkd = get_option('cupi_linkd'); echo ($linkd); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/linkedin.png" title="Linkedin" alt="Linkedin"/></a></li> 
	<li><a href="<?php $yout = get_option('cupi_yout'); echo ($yout); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/youtube.png" title="Youtube" alt="Youtube"/></a></li> 

	
</ul>
</div>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<div class="postmeta clearfix">
		<span class="author"> Posted by <?php the_author(); ?></span> 
		<span class="clock"> On <?php the_time('F - j - Y'); ?></span>
		<span class="comm"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>	
</div>

	<a href="<?php the_permalink() ?>">
		<?php
		if ( has_post_thumbnail() ) { ?>
		<img class="postimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=100&amp;w=200&amp;zc=1" alt=""/>
		<?php } else { ?>
		<img class="postimg" src="<?php bloginfo('template_directory'); ?>/images/dummy.png" alt="" />
		<?php } ?>
	</a>

<div class="title">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>
	<div class="clear"></div>

<div class="entry">

<?php the_excerpt(); ?> 

<div class="clear"></div>
</div>
	
</div>
<?php endwhile; ?>
<div class="clear"></div>

<?php getpagenavi(); ?>

<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>

</div>

<?php get_footer(); ?>