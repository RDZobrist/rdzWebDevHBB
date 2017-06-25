<?php get_header() ?>

<?php the_post() ?>
<?php rewind_posts() ?>

<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
              <div class="post-content">
            <div class="video-content" align="center">
				<?php 
				video_blog_function('450','366',get_the_ID());
				 ?>
             </div>
			<div class="post-footer"></div>
			</div><!-- .post content -->
            
 		
  
        


			


                   
				<?php if ( is_day() ) : ?>
                <div id="post-side" class="sidebar">
					<div class="the-post">
				<h2 class="entry-title"><?php printf(__('Daily Archives', 'sandbox'), get_the_time(get_option('date_format'))) ?></h2>
                </div>
                <div class="entry-meta">
                 <h2 class="entry-title"><?php printf(__('%s', 'sandbox'), get_the_time(get_option('date_format'))) ?></h2>
				 </div>
                   <div class="post-side-footer-b"></div>
				</div> 
				<?php elseif ( is_month() ) : ?>
                      <div id="post-side" class="sidebar">
					<div class="the-post">
				<h2 class="entry-title"><?php printf(__('Monthly Archives', 'sandbox'), get_the_time('F Y')) ?></h2>
                 </div>
                <div class="entry-meta">
                <h2 class="entry-title"><?php printf(__('%s', 'sandbox'), get_the_time('F Y')) ?></h2>
                </div>
                <div class="post-side-footer-b"></div>
				</div> 
                
				<?php elseif ( is_year() ) : ?>
                   <div id="post-side" class="sidebar">
					<div class="the-post">
				<h2 class="entry-title"><?php printf(__('Yearly Archives', 'sandbox'), get_the_time('Y')) ?></h2>
                       <div class="entry-meta">
                    <h2 class="entry-title"><?php printf(__('%s', 'sandbox'), get_the_time('Y')) ?></h2>
                    </div>
                       <div class="post-side-footer-b"></div>
				</div> 
				<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
                 <div id="post-side" class="sidebar">
					<div class="the-post">
				<h2 class="entry-title"><?php _e('Blog Archives', 'sandbox') ?></h2>
                </div>                
                   <div class="entry-meta">
                  <h2 class="entry-title"><?php _e('Blog Archives', 'sandbox') ?></h2>
                 </div>
                <div class="post-side-footer-b"></div>
				</div> 
                <?php else : ?>
				<div id="post-side" class="sidebar ">
                <div class="the-post">
   				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="entry-content">
				<?php the_excerpt(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').'') ?>
				</div>
                 
				</div> <div class="entry-meta">
                <div class="related_posts">
 <h3 class="entry-title">Related Posts</h3>
 <?php wp_related_posts() ?></div>
			
            
                </div>
                    <div class="post-side-footer-b"></div>
                </div>  
            
				<?php endif; ?>
                
                </div>
                
                
                <div class="clear"></div>
	<?php endwhile ?>				
                


			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

<?php get_footer() ?>