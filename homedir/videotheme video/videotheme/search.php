<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php if (have_posts()) : ?>
         <div class="post-content">
         <div class="padding">
		<h2 class="page-title"><?php _e('Search Results for:', 'sandbox') ?> <span id="search-terms"><?php the_search_query() ?></span></h2>
<br />


<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class=" <?php sandbox_post_class() ?> page">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="entry-content">
<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').'') ?>
</div>
    <div class="video-content" align="center">
          <?php 
			video_blog_function('450','366',get_the_ID());
			 ?>
				</div>
				</div>
                
				
			

<?php endwhile; ?>
</div> <div class="post-footer"></div></div>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

<?php else : ?>

		<div class="post-content">
         <div class="padding">
				<h2 class="entry-title"><?php _e('Nothing Found', 'sandbox') ?></h2>
				<div class="entry-content">
					<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sandbox') ?></p>
				</div>
				<form id="noresults-searchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="noresults-s" class="text-input" name="s" type="text" value="<?php the_search_query() ?>" size="40" />
						<input id="noresults-searchsubmit" class="submit-button" name="searchsubmit" type="submit" value="<?php _e('Find', 'sandbox') ?>" />
					</div>
				</form>
			</div><!-- .post -->
            
</div>     <div class="post-footer"></div>
<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>