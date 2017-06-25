<?php
/**
 * Template Name: Full Width, no sidebar(s)
*/

get_header(); ?>

    <div id="main-fullwidth">
        
        <?php 
            if (have_posts()) : while (have_posts()) : the_post();
                /**
                 * Find the post formatting for the pages in the post-page.php file
                 */
                get_template_part('post', 'page');
            endwhile;
            
            else :
                get_template_part('post', 'noresults');
            endif; 
            
            if(comments_open( get_the_ID() ))  {
                comments_template('', true); 
            }
        ?>
        
    </div><!-- #main-fullwidth -->
    
<?php get_footer(); ?>