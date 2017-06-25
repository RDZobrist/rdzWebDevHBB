<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
    
		<div class="postarea">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div <?php post_class(); ?>>
            
                <h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                
                <div class="postauthor">
                    <p><?php _e("Posted by", 'studiopress'); ?> <?php the_author_posts_link(); ?> <?php _e("on", 'studiopress'); ?> <?php the_time('F j, Y'); ?> &middot; <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment'), __('1 Comment'), __('% Comments')); ?></a>&nbsp;<?php edit_post_link(__('(Edit)'), '', ''); ?></p>
                </div>
                
                <?php the_content(__("Read more", 'studiopress'));?><div class="clear"></div>
                
                <div class="postmeta">
                    <p><?php _e("Filed under", 'studiopress'); ?> <?php the_category(', ') ?> &middot; <?php _e("Tagged with", 'studiopress'); ?> <?php the_tags('') ?></p>
                </div>
            		
            </div>
            
			<?php endwhile; else: ?>
                    
			<p><?php _e('Sorry, no posts matched your criteria.', 'studiopress'); ?></p><?php endif; ?>
            <p><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
        
        </div>
	
	</div>
			
	<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<?php get_footer(); ?>