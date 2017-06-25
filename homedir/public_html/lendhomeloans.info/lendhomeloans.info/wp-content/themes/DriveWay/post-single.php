<?php global $theme; ?>

    <div <?php post_class('post post-single clearfix'); ?> id="post-<?php the_ID(); ?>">
    
        <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themater' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        
        <div class="postmeta-primary">

            <span class="meta_date"><?php the_time($theme->get_option('dateformat')); ?></span>
           &nbsp; <span class="meta_author"><?php the_author(); ?></span>

                <?php if(comments_open( get_the_ID() ))  {
                    ?> &nbsp; <span class="meta_comments"><?php comments_popup_link( __( 'No comments', 'themater' ), __( '1 Comment', 'themater' ), __( '% Comments', 'themater' ) ); ?></span><?php
                }
                
                if(is_user_logged_in())  {
                    ?> &nbsp; <span class="meta_edit"><?php edit_post_link(); ?></span><?php
                } ?> 
        </div>
            
        <?php
                if(has_post_thumbnail())  {
                    the_post_thumbnail(
                        array($theme->get_option('featured_image_width_single'), $theme->get_option('featured_image_height_single')),
                        array("class" => $theme->get_option('featured_image_position_single') . " featured_image")
                    );
                }
            ?>
        
        <div class="entry clearfix">
            
            <?php
                the_content('');
            ?>

        </div>
    
        <div class="postmeta-secondary">
           <span class="meta_categories"><?php _e( 'Posted in:', 'themater' ); ?>  <?php the_category(', '); ?></span>
           <?php if(get_the_tags()) {
                    ?> &nbsp; <span class="meta_tags"><?php the_tags(__( 'Tags:', 'themater') . ' ', ', ', ''); ?></span><?php
                }
            ?> 
        </div>
    
    </div><!-- Post ID <?php the_ID(); ?> -->
    
    <?php 
        if(comments_open( get_the_ID() ))  {
            comments_template('', true); 
        }
    ?>