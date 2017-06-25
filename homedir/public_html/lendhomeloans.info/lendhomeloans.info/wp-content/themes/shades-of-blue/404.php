<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
    
        <div class="postarea">
                
			<h1><?php _e("We're sorry, that page was not found - Error 404", 'studiopress'); ?></h1>
            <p><?php _e("The page you are looking for no longer exists.", 'studiopress'); ?></p>
            
        </div>
		
	</div>
			
	<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<?php get_footer(); ?>