<div class="right column">

<!-- TWITTER UPADTES BEGIN -->
<div class="featbox">
	<h3 class="sidetitl bluehead"> Twitter updates</h3>
<?php
$twit = get_option('cupi_twit'); 
include('twitter.php');?>
<?php if(function_exists('twitter_messages')) : ?>
       <?php twitter_messages("$twit") ?>
       <?php endif; ?>
	
	<a href="http://twitter.com/<?php $twit = get_option('cupi_twit'); echo ($twit); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/follow.png" title="Twitter" alt="Twitter"/></a>
 </div> 
<!-- TWITTER UPADTES END -->
 
 
<!-- AD BLOCKS BEGIN --> 
<?php include (TEMPLATEPATH . '/sponsors.php'); ?>	
<!-- AD BLOCKS END -->

<!-- POPULAR POSTS BEGIN -->
<div class="featbox">
	<h3 class="sidetitl redhead"> Popular Posts </h3>	
	<div class="featlist ">
<?php 
	$my_query = new WP_Query('orderby=comment_count&showposts=5');
	while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<div class="fblock">
	<a href="<?php the_permalink() ?>">
		<?php
		if ( has_post_thumbnail() ) { ?>
		<img class="phumb" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=50&amp;w=50&amp;zc=1" alt=""/>
		<?php } else { ?>
		<img class="phumb" src="<?php bloginfo('template_directory'); ?>/images/dummy.png" alt="" />
		<?php } ?>
	</a>
<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo short_title('...', 4); ?></a></h3>
<p>  <?php the_content_rss('', TRUE, '', 10); ?> </p>
</div>
<?php endwhile; ?>
</div>
</div>	
<!-- POPULAR POSTS END -->	

<!-- SIDEBAR WIDGETS BEGIN -->
<div class="sidebar">
<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
	<?php endif; ?>
</ul>
</div>
<!-- SIDEBAR WIDGETS END -->

</div>