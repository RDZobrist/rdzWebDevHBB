<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'studiopress'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", 'studiopress'); ?></p>
	<?php
		return;
	}
?>

<?php // You can start editing here. ?>

	<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php _e("Comments", 'studiopress'); ?></h3>
	<strong><?php comments_number(__('No Responses', 'studiopress'), __('One Response', 'studiopress'), __('% Responses', 'studiopress') );?> <?php _e("to", 'studiopress'); ?> &#8220;<?php the_title(); ?>&#8221;</strong>
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&avatar_size=48'); ?>
	</ol>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	
	<?php if ( !empty($comments_by_type['pings']) ) :  ?>
	<h3><?php _e("Trackbacks", 'studiopress'); ?></h3>
	<strong><?php _e("Check out what others are saying about this post...", 'studiopress'); ?></strong>
	<ol class="commentlist">
	<?php wp_list_comments('type=pings'); ?>
	</ol><br /><br />
	<?php endif; ?>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<?php // If comments are open, but there are no comments. ?>

	 <?php else : // comments are closed ?>
		<?php // If comments are closed. ?>
		<p class="nocomments"><?php _e("Comments are closed.", 'studiopress'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php _e("Speak Your Mind", 'studiopress'); ?></h3>
<strong><?php _e("Tell us what you're thinking...", 'studiopress'); ?> <br /><?php _e("and oh, if you want a pic to show with your comment, go get a", 'studiopress'); ?> <a href="http://en.gravatar.com" >gravatar</a>!</strong>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e("You must be", 'studiopress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("logged in", 'studiopress'); ?></a> <?php _e("to post a comment", 'studiopress'); ?>.</p></div>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e("Logged in as", 'studiopress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account", 'studiopress'); ?>"><?php _e("Log out", 'studiopress'); ?> &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e("Name", 'studiopress'); ?> <?php if ($req) _e("(required)", 'studiopress'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e("Mail (will not be published)", 'studiopress'); ?> <?php if ($req) echo _e("(required)", 'studiopress'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e("Website", 'studiopress'); ?></small></label></p>

<?php endif; ?>

<?php // <p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Submit Comment", 'studiopress'); ?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
