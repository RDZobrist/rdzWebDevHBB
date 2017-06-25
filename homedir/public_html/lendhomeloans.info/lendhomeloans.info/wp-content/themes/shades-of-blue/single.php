<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
	
		<div class="postarea">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div class="post">
			
                <h1><?php the_title(); ?></h1>
                    
                    <div class="postauthor">
                        <p><?php _e("Posted by", 'studiopress'); ?> <?php the_author_posts_link(); ?> <?php _e("on", 'studiopress'); ?> <?php the_time('l, F j, Y'); ?> &middot; <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment'), __('1 Comment'), __('% Comments')); ?></a>&nbsp;<?php edit_post_link(__('(Edit)'), '', ''); ?></p>
                    </div>
                
                <?php the_content(__("Read more", 'studiopress'));?><div class="clear"></div>
                        
                <!--
                <?php trackback_rdf(); ?>
                -->
                
                <div class="postmeta">
                    <p><?php _e("Filed under", 'studiopress'); ?> <?php the_category(', ') ?> &middot; <?php _e("Tagged with", 'studiopress'); ?> <?php the_tags('') ?></p>
                </div>
                
                <div class="clear"></div>
                
                <div class="authorbox">
                    <p><?php echo get_avatar( get_the_author_email(), '64' ); ?><strong><?php _e("About", 'studiopress'); ?> <?php the_author(); ?></strong><br /><?php the_author_meta( 'description' ); ?></p>
                    <div class="clear"></div>
                </div>
                    
            </div>
			
		</div>
			
        <div class="postcomments">
            
			<?php comments_template('',true); ?>
        
        </div>

		<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'studiopress'); ?></p><?php endif; ?>
		
	</div>
	
<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<?php get_footer(); ?>