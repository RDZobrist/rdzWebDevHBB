<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", 'studiopress'); ?></p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<?php // You can start editing here. ?>

<?php if ($comments) : ?>
	<strong><?php comments_number(__('No Responses', 'studiopress'), __('One Response', 'studiopress'), __('% Responses', 'studiopress') );?> <?php _e("to", 'studiopress'); ?> &#8220;<?php the_title(); ?>&#8221;</strong>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>
	
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type == 'comment') { ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>
			<cite><?php comment_author_link() ?></cite> Says:
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e("Your comment is awaiting moderation.", 'studiopress'); ?></em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link(__('edit', 'studiopress'),'&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>

		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
	
	<?php } else { $trackback = true; } ?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>
	
	<?php if ($trackback == true) { ?><br />
	<h4><?php _e("Trackbacks", 'studiopress'); ?></h4>
	<ol id="trackbacks">
	<?php foreach ($comments as $comment) : ?>
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type != 'comment') { ?>
	<li><?php comment_author_link() ?></li>
	<?php } ?>
	<?php endforeach; ?>
	</ol>
	<?php } ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<?php // If comments are open, but there are no comments. ?>

	 <?php else : // comments are closed ?>
		<?php // If comments are closed. ?>
		<p class="nocomments"><?php _e("Comments are closed.", 'studiopress'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?><br />

<p><strong><?php _e("Tell us what you're thinking...", 'studiopress'); ?> <br /><?php _e("and oh, if you want a pic to show with your comment, go get a", 'studiopress'); ?> <a href="http://en.gravatar.com" >gravatar</a>!</strong></p>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e("You must be", 'studiopress'); ?> <a href="/<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("logged in", 'studiopress'); ?></a> <?php _e("to post a comment", 'studiopress'); ?>.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e("Logged in as", 'studiopress'); ?> <a href="/<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="../../<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e("Log out of this account", 'studiopress'); ?>"><?php _e("Log out", 'studiopress'); ?> &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small><?php _e("Name", 'studiopress'); ?> <?php if ($req) _e("(required)", 'studiopress'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2"/>
<label for="email"><small><?php _e("Mail (will not be published)", 'studiopress'); ?> <?php if ($req) echo _e("(required)", 'studiopress'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e("Website", 'studiopress'); ?></small></label></p>

<?php endif; ?>

<?php // <p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> ?>

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Submit Comment", 'studiopress'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>