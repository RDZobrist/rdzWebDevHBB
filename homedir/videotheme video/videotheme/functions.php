<?php
// Produces a list of pages in the header without whitespace -- er, I mean negative space.
function sandbox_globalnav() {
	
	echo '<div id="menu"><ul><li ';
	if (is_home()){
	echo 'class="current_page_item"';
	}
	echo '><a href="';
	echo get_option('home');
	echo '">Home</a>';
	$menu = wp_list_pages('title_li=&sort_column=menu_order&echo=0'); // Params for the page list in header.php
	echo str_replace( array( "\r", "\n", "\t" ), '', $menu );
	echo '<li class="right"><a href="';
	bloginfo('rss2_url');
	echo '">RSS</a></li>';
	echo '<li class="right"><a href="';
	bloginfo('home');
	echo '/?feed=video">Video RSS</a></li>';
	echo "</ul></div>\n";
}

function feed_video() {
?>
<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
$more = 1;

?>
<?php echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	<?php do_action('rss2_ns'); ?>
>

<channel>
	<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></pubDate>
	<?php the_generator( 'rss2' ); ?>
	<language><?php echo get_option('rss_language'); ?></language>
	<?php do_action('rss2_head'); ?>
	<?php while( have_posts()) : the_post(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
		<comments><?php comments_link(); ?></comments>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<dc:creator><?php the_author() ?></dc:creator>
		<?php the_category_rss() ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<?php the_excerpt_rss();
		
		video_blog_function('450','366',get_the_ID());?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss();
		
		video_blog_function('450','366', get_the_ID());?>]]></description>
	<?php if ( strlen( $post->post_content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php the_content();
		
		video_blog_function('450','366',get_the_ID());?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss();
		
		video_blog_function('450','366',get_the_ID()); ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
		<wfw:commentRss><?php echo get_post_comments_feed_link(); ?></wfw:commentRss>
<?php rss_enclosure(); ?>
	<?php do_action('rss2_item'); ?>
	</item>
	<?php endwhile; ?>
</channel>
</rss>

<?php 
}
add_feed('video', 'feed_video');

// Generates semantic classes for BODY element
function sandbox_body_class( $print = true ) {
	global $wp_query, $current_user;

	// It's surely a WordPress blog, right?
	$c = array('wordpress');

	// Applies the time- and date-based classes (below) to BODY element
	sandbox_date_classes( time(), $c );

	// Generic semantic classes for what type of content is displayed
	is_front_page()  ? $c[] = 'home'       : null; // New 'front' class for WP 2.5
	is_home()        ? $c[] = 'blog'       : null; // Class for the posts, if set
	is_archive()     ? $c[] = 'archive'    : null;
	is_date()        ? $c[] = 'date'       : null;
	is_search()      ? $c[] = 'search'     : null;
	is_paged()       ? $c[] = 'paged'      : null;
	is_attachment()  ? $c[] = 'attachment' : null;
	is_404()         ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character

	// Special classes for BODY element when a single post
	if ( is_single() ) {
		$postID = $wp_query->post->ID;
		the_post();

		// Adds 'single' class and class with the post ID
		$c[] = 'single postid-' . $postID;

		// Adds classes for the month, day, and hour when the post was published
		if ( isset( $wp_query->post->post_date ) )
			sandbox_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );

		// Adds category classes for each category on single posts
		if ( $cats = get_the_category() )
			foreach ( $cats as $cat )
				$c[] = 's-category-' . $cat->slug;

		// Adds tag classes for each tags on single posts
		if ( $tags = get_the_tags() )
			foreach ( $tags as $tag )
				$c[] = 's-tag-' . $tag->slug;

		// Adds MIME-specific classes for attachments
		if ( is_attachment() ) {
			$mime_type = get_post_mime_type();
			$mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
				$c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
		}

		// Adds author class for the post author
		$c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author_login()));
		rewind_posts();
	}

	// Author name classes for BODY on author archives
	elseif ( is_author() ) {
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;
	}

	// Category name classes for BODY on category archvies
	elseif ( is_category() ) {
		$cat = $wp_query->get_queried_object();
		$c[] = 'category';
		$c[] = 'category-' . $cat->slug;
	}

	// Tag name classes for BODY on tag archives
	elseif ( is_tag() ) {
		$tags = $wp_query->get_queried_object();
		$c[] = 'tag';
		$c[] = 'tag-' . $tags->slug;
	}

	// Page author for BODY on 'pages'
	elseif ( is_page() ) {
		$pageID = $wp_query->post->ID;
		$page_children = wp_list_pages("child_of=$pageID&echo=0");
		the_post();
		$c[] = 'page pageid-' . $pageID;
		$c[] = 'page-author-' . sanitize_title_with_dashes(strtolower(get_the_author('login')));
		// Checks to see if the page has children and/or is a child page; props to Adam
		if ( $page_children != '' )
			$c[] = 'page-parent';
		if ( $wp_query->post->post_parent )
			$c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
		rewind_posts();
	}

	// For when a visitor is logged in while browsing
	if ( $current_user->ID )
		$c[] = 'loggedin';

	// Paged classes; for 'page X' classes of index, single, etc.
	if ( ( ( $page = $wp_query->get('paged') ) || ( $page = $wp_query->get('page') ) ) && $page > 1 ) {
		$c[] = 'paged-' . $page;
		if ( is_single() ) {
			$c[] = 'single-paged-' . $page;
		} elseif ( is_page() ) {
			$c[] = 'page-paged-' . $page;
		} elseif ( is_category() ) {
			$c[] = 'category-paged-' . $page;
		} elseif ( is_tag() ) {
			$c[] = 'tag-paged-' . $page;
		} elseif ( is_date() ) {
			$c[] = 'date-paged-' . $page;
		} elseif ( is_author() ) {
			$c[] = 'author-paged-' . $page;
		} elseif ( is_search() ) {
			$c[] = 'search-paged-' . $page;
		}
	}

	// Separates classes with a single space, collates classes for BODY
	$c = join( ' ', apply_filters( 'body_class',  $c ) );

	// And tada!
	return $print ? print($c) : $c;
}

// Generates semantic classes for each post DIV element
function sandbox_post_class( $print = true ) {
	global $post, $sandbox_post_alt;

	// hentry for hAtom compliace, gets 'alt' for every other post DIV, describes the post type and p[n]
	$c = array( 'hentry', "p$sandbox_post_alt", $post->post_type, $post->post_status );

	// Author for the post queried
	$c[] = 'author-' . sanitize_title_with_dashes(strtolower(get_the_author('login')));

	// Category for the post queried
	foreach ( (array) get_the_category() as $cat )
		$c[] = 'category-' . $cat->slug;

	// Tags for the post queried; if not tagged, use .untagged
	if ( get_the_tags() == null ) {
		$c[] = 'untagged';
	} else {
		foreach ( (array) get_the_tags() as $tag )
			$c[] = 'tag-' . $tag->slug;
	}

	// For password-protected posts
	if ( $post->post_password )
		$c[] = 'protected';

	// Applies the time- and date-based classes (below) to post DIV
	sandbox_date_classes( mysql2date( 'U', $post->post_date ), $c );

	// If it's the other to the every, then add 'alt' class
	if ( ++$sandbox_post_alt % 2 )
		$c[] = 'alt';

	// Separates classes with a single space, collates classes for post DIV
	$c = join( ' ', apply_filters( 'post_class', $c ) );

	// And tada!
	return $print ? print($c) : $c;
}

// Define the num val for 'alt' classes (in post DIV and comment LI)
$sandbox_post_alt = 1;

// Generates semantic classes for each comment LI element
function sandbox_comment_class( $print = true ) {
	global $comment, $post, $sandbox_comment_alt;

	// Collects the comment type (comment, trackback),
	$c = array( $comment->comment_type );

	// Counts trackbacks (t[n]) or comments (c[n])
	if ( $comment->comment_type == 'comment' ) {
		$c[] = "c$sandbox_comment_alt";
	} else {
		$c[] = "t$sandbox_comment_alt";
	}

	// If the comment author has an id (registered), then print the log in name
	if ( $comment->user_id > 0 ) {
		$user = get_userdata($comment->user_id);

		// For all registered users, 'byuser'; to specificy the registered user, 'commentauthor+[log in name]'
		$c[] = 'byuser comment-author-' . sanitize_title_with_dashes(strtolower( $user->user_login ));
		// For comment authors who are the author of the post
		if ( $comment->user_id === $post->post_author )
			$c[] = 'bypostauthor';
	}

	// If it's the other to the every, then add 'alt' class; collects time- and date-based classes
	sandbox_date_classes( mysql2date( 'U', $comment->comment_date ), $c, 'c-' );
	if ( ++$sandbox_comment_alt % 2 )
		$c[] = 'alt';

	// Separates classes with a single space, collates classes for comment LI
	$c = join( ' ', apply_filters( 'comment_class', $c ) );

	// Tada again!
	return $print ? print($c) : $c;
}

// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function sandbox_date_classes( $t, &$c, $p = '' ) {
	$t = $t + ( get_option('gmt_offset') * 3600 );
	$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
	$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
	$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
	$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
}

// For category lists on category archives: Returns other categories except the current one (redundant)
function sandbox_cats_meow($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );

	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}

	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function sandbox_tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );

	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}

	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

// Produces an avatar image with the hCard-compliant photo class
function sandbox_commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( ']* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	echo $commenter ;
}

function sandbox_commenter_avatar() {
	$email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email", "64" ) );
	echo $avatar;
}

// Sandbox gallery short code; styles used in style.css file
function sandbox_gallery($attr) {
	global $post;
	// Sets our defaults for the Sandbox gallery short code
	extract( shortcode_atts(
		array(
			'orderby'    => 'menu_order ASC, ID ASC',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
		),
		$attr ) );
	$id = intval($id);
	$orderby = addslashes($orderby);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby=\"{$orderby}\"");
	// If we have nothing, show nothing
	if ( empty($attachments) )
		return '';
	// Shows simple image links when viewed in a feed
	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link( $id, $size, true ) . "\n";
		return $output;
	}
	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	// Divides number of columns for even widths
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	// Let's begin our gallery
	$output = apply_filters( "gallery_style", "<div class='gallery gallery-set-1'>" );
	// We're using pretty much the same code from ../wp-includes/media.php
	foreach ( $attachments as $id => $attachment ) {
		$link = wp_get_attachment_link( $id, $size, true );
		// This is our 'wrapper' for each gallery item
		$output .= "<{$itemtag} class='gallery-item' style='width:{$itemwidth}%;'>";
		// And now we have the actual image link
		$output .= "<{$icontag} class='gallery-icon'>$link</{$icontag}>";
		// Next, show the image caption if present
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "<{$captiontag} class='gallery-caption'>{$attachment->post_excerpt}</{$captiontag}>";
		}
		// Close the gallery item 'wrapper'
		$output .= "</{$itemtag}>";
		// Start a new gallery set for our 'columns'
		if ( $columns > 0 && ++$i % $columns == 0 ) {
			$gallery_count = 2;
			$output .= "\n</div>\n<div class='gallery gallery-set-" . $gallery_count . "'>\n";
			$gallery_count++;
		}
	}
	// Ends our gallery
	$output .= "</div>\n";
	// And spits out the chewed up code
	return $output;
}

// Widget: Search; to match the Sandbox style and replace Widget plugin default
function widget_sandbox_search($args) {
	extract($args);
	$options = get_option('widget_sandbox_search');
	$title = empty($options['title']) ? __( 'Search', 'sandbox' ) : $options['title'];
	$button = empty($options['button']) ? __( 'Find', 'sandbox' ) : $options['button'];
?>
			<?php echo $before_widget ?>
				<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
				<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="s" class="text-input" name="s" type="text" value="<?php the_search_query() ?>" size="10" tabindex="1" accesskey="S" />
						<input id="searchsubmit" class="submit-button" name="searchsubmit" type="submit" value="<?php echo $button ?>" tabindex="2" />
					</div>
				</form>
			<?php echo $after_widget ?>
<?php
}

// Widget: Search; element controls for customizing text within Widget plugin
function widget_sandbox_search_control() {
	$options = $newoptions = get_option('widget_sandbox_search');
	if ( $_POST['search-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['search-title'] ) );
		$newoptions['button'] = strip_tags( stripslashes( $_POST['search-button'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_sandbox_search', $options );
	}
	$title = attribute_escape( $options['title'] );
	$button = attribute_escape( $options['button'] );
?>
			<p><label for="search-title"><?php _e( 'Title:', 'sandbox' ) ?> <input class="widefat" id="search-title" name="search-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="search-button"><?php _e( 'Button Text:', 'sandbox' ) ?> <input class="widefat" id="search-button" name="search-button" type="text" value="<?php echo $button; ?>" /></label></p>
			<input type="hidden" id="search-submit" name="search-submit" value="1" />
<?php
}

// Widget: Meta; to match the Sandbox style and replace Widget plugin default
function widget_sandbox_meta($args) {
	extract($args);
	$options = get_option('widget_meta');
	$title = empty($options['title']) ? __( 'Meta', 'sandbox' ) : $options['title'];
?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<ul>
					<?php wp_register() ?>

					<li><?php wp_loginout() ?></li>
					<?php wp_meta() ?>

				</ul>
			<?php echo $after_widget; ?>
<?php
}

// Widget: RSS links; to match the Sandbox style
function widget_sandbox_rsslinks($args) {
	extract($args);
	$options = get_option('widget_sandbox_rsslinks');
	$title = empty($options['title']) ? __( 'RSS Links', 'sandbox' ) : $options['title'];
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
				<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?> <?php _e( 'Posts RSS feed', 'sandbox' ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', 'sandbox' ) ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> <?php _e( 'Comments RSS feed', 'sandbox' ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', 'sandbox' ) ?></a></li>
			</ul>
		<?php echo $after_widget; ?>
<?php
}

// Widget: RSS links; element controls for customizing text within Widget plugin
function widget_sandbox_rsslinks_control() {
	$options = $newoptions = get_option('widget_sandbox_rsslinks');
	if ( $_POST['rsslinks-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['rsslinks-title'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_sandbox_rsslinks', $options );
	}
	$title = attribute_escape( $options['title'] );
?>
			<p><label for="rsslinks-title"><?php _e( 'Title:', 'sandbox' ) ?> <input class="widefat" id="rsslinks-title" name="rsslinks-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="rsslinks-submit" name="rsslinks-submit" value="1" />
<?php
}

// Widget: Foxinni Video
function widget_video_widget($args) {
	extract($args);
	$options = get_option('widget_video_widget');
	$title = empty($options['title']) ? __( 'Recent Videos', 'sandbox' ) : $options['title'];
	$number = empty($options['number']) ? __( 'Amount', 'sandbox' ) : $options['number'];
	
	$r = new WP_Query("showposts=$number&what_to_show=posts&nopaging=0&post_status=publish");
	if ($r->have_posts()) :         ?>  
     

		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
            <ul>
            <?php
	
		if ( !$number = (int) $options['number'] )
		$number = 4;
		else if ( $number < 1 )
		$number = 1;
		else if ( $number > 15 )
		$number = 15; ?>

	<?php  while ($r->have_posts()) : $r->the_post(); ?>
		
            <li>
            
             <h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h4>
		<div class="video-content" align="center">
           <?php 
		   	$postID = $r->post->ID;
			video_blog_function('320','260', $postID); ?>
            </div>
		</li>
      
            
				<?php endwhile; ?>
        
            </ul>
		<?php echo $after_widget; ?>	
		<?php	wp_reset_query();  // Restore global post data stomped by the_post().
		endif; 
}

// Widget: Foxinni Video
function widget_video_widget_control() {
	$options = $newoptions = get_option('widget_video_widget');
	if ( $_POST['video-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes( $_POST['video-title'] ) );
		$newoptions['number'] = strip_tags( stripslashes( $_POST['video-amount'] ) );
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option( 'widget_video_widget', $options );
	}
	$title = attribute_escape( $options['title'] );
	$number = attribute_escape( $options['number'] );
?>
			<p><label for="video-title"><?php _e( 'Title:', 'sandbox' ) ?>
            <input class="widefat" id="video-title" name="video-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="video-amount"><?php _e( 'Number:', 'sandbox' ) ?>
            <input class="widefat" id="video-amount" name="video-amount" type="text" value="<?php echo $number; ?>" /></label></p>  
			<input type="hidden" id="video-submit" name="video-submit" value="1" />
<?php
}

// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function sandbox_widgets_init() {
	if ( !function_exists('register_sidebars') )
		return;

	// Formats the Sandbox widgets, adding readability-improving whitespace
	$p = array(
		'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
		'after_widget'   =>   "\n\t\t\t</li>\n",
		'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
		'after_title'    =>   "</h3>\n"
	);

	// Table for how many? Two? This way, please.
	register_sidebars( 1, $p );

	// Finished intializing Widgets plugin, now let's load the Sandbox default widgets; first, Sandbox search widget
	$widget_ops = array(
		'classname'    =>  'widget_search',
		'description'  =>  __( "A search form for your blog (Sandbox)", "sandbox" )
	);
	wp_register_sidebar_widget( 'search', __( 'Search', 'sandbox' ), 'widget_sandbox_search', $widget_ops );
	unregister_widget_control('search');
	wp_register_widget_control( 'search', __( 'Search', 'sandbox' ), 'widget_sandbox_search_control' );

	// Sandbox Meta widget
	$widget_ops = array(
		'classname'    =>  'widget_meta',
		'description'  =>  __( "Log in/out and administration links (Sandbox)", "sandbox" )
	);
	wp_register_sidebar_widget( 'meta', __( 'Meta', 'sandbox' ), 'widget_sandbox_meta', $widget_ops );
	unregister_widget_control('meta');
	wp_register_widget_control( 'meta', __('Meta'), 'wp_widget_meta_control' );

	//Sandbox RSS Links widget
	$widget_ops = array(
		'classname'    =>  'widget_rss_links',
		'description'  =>  __( "RSS links for both posts and comments <small>(Sandbox)</small>", "sandbox" )
	);
	wp_register_sidebar_widget( 'rss_links', __( 'RSS Links', 'sandbox' ), 'widget_sandbox_rsslinks', $widget_ops );
	wp_register_widget_control( 'rss_links', __( 'RSS Links', 'sandbox' ), 'widget_sandbox_rsslinks_control' );
	
	//Foxinni Video widget
	$widget_ops = array(
		'classname'    =>  'widget_video',
		'description'  =>  __( "A custom built widget for Video Blog that displays recent video in the sidebar", "sandbox" )
	);
	wp_register_sidebar_widget( 'video_widget', __( 'Video Blog Widget', 'sandbox' ), 'widget_video_widget', $widget_ops );
	wp_register_widget_control( 'video_widget', __( 'Video Blog Widget', 'sandbox' ), 'widget_video_widget_control' );
	
}

//Foxinni Addons



function vb_add_admin() {
	if ( $_GET['page'] == basename(__FILE__) ) {	
		if ( 'save' == $_REQUEST['action'] ) {	
		
		
				update_option( 'vb_theme', $_REQUEST['theme_select'] );
			//update_option( 'sandbox_logo', $_REQUEST['logo_dest'] );
			
			if( isset( $_REQUEST['theme_select'] ) ) { update_option( 'vb_theme', $_REQUEST['theme_select']  ); } else { delete_option( 'vb_theme' ); }
		//	if( isset( $_REQUEST['logo_dest'] ) ) { update_option( 'sandbox_logo', $_REQUEST['logo_dest']  ); } else { delete_option( 'sandbox_logo' ); }
				

			
			header("Location: themes.php?page=functions.php&saved=true");
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('vb_theme');
			
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
		
	}
add_theme_page(__('Customize Video Theme'), __('Video Theme Settings'), 'edit_themes', basename(__FILE__), 'theme_page');
}

function theme_page (){

if ( $_REQUEST['saved'] ) { ?><div id="message1" class="updated fade"><p><?php printf(__('Theme options saved. <a href="%s">View site &raquo;</a>', 'sandbox'), get_bloginfo('home') . '/'); ?></p></div><?php }
if ( $_REQUEST['reset'] ) { ?><div id="message2" class="updated fade"><p><?php _e('Theme options reset.', 'sanbox'); ?></p></div><?php } ?>

<div class="wrap">	           
 <h2>Video Theme Settings</h2>	

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">


<table class="form-table">
 <tr>
 	<th scope="row" valign="top">Choose a theme</th>
 	<td>
    <?php $theme = get_settings('vb_theme'); ?>
   
 	 <select name="theme_select">
 <optgroup label="Light Themes">
 <option <?php if ($theme == 'blue-light') { echo 'selected'; } ?> value="blue-light">Blue (defualt)</option>
  <option <?php if ($theme == 'blue2-light') { echo 'selected'; } ?> value="blue2-light">Deep Blue</option>
  <option <?php if ($theme == 'red-light') { echo 'selected'; } ?> value="red-light">Red</option>
  <option <?php if ($theme == 'green-light') { echo 'selected'; } ?> value="green-light">Green</option>
    <option <?php if ($theme == 'orange-light') { echo 'selected'; } ?> value="orange-light">Orange</option>
    <option <?php if ($theme == 'brown-light') { echo 'selected'; } ?> value="brown-light">Brown</option>
    <option <?php if ($theme == 'grey-light') { echo 'selected'; } ?> value="grey-light">Grey</option>
      <option <?php if ($theme == 'rose-light') { echo 'selected'; } ?> value="rose-light">Rose</option>
      </optgroup>
       <optgroup label="Dark Themes">
 <option <?php if ($theme == 'blue-dark') { echo 'selected'; } ?> value="blue-dark">Blue</option>
  <option <?php if ($theme == 'blue2-dark') { echo 'selected'; } ?> value="blue2-dark">Deep Blue</option>
  <option <?php if ($theme == 'purple-dark') { echo 'selected'; } ?> value="purple-dark">Purle</option>
  <option <?php if ($theme == 'green-dark') { echo 'selected'; } ?> value="green-dark">Green</option>
    <option <?php if ($theme == 'orange-dark') { echo 'selected'; } ?> value="orange-dark">Orange</option>
    <option <?php if ($theme == 'red-dark') { echo 'selected'; } ?> value="red-dark">Red</option>
    <option <?php if ($theme == 'white-dark') { echo 'selected'; } ?> value="white-dark">White</option>
      <option <?php if ($theme == 'coffee-dark') { echo 'selected'; } ?> value="coffee-dark">Coffee</option>
      </optgroup>
 </select>
 	</td>
 </tr>
</table>
		<p class="submit" style="border:0">
			<input name="save" type="submit" value="<?php _e('Save Options &raquo;', 'sandbox'); ?>" />  
			<input name="action" type="hidden" value="save" />
		</p>



</div>
    
    <?php

};



function vb_head () {
	if ( get_settings('vb_theme') == "" ) {
		$theme = 'blue-light';
	} else {
		$theme = stripslashes( get_settings('vb_theme') ); 

	};
?>
<style>
.post-footer { background:#fff url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/post_footer.gif) no-repeat center top;   }
.post-header { background:#fff url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/post_top.gif) no-repeat center top;}
.post-side-footer-b { background: url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/sb_footer_b.gif) no-repeat right top;  }
.side-top { background:#fff url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/sb_top.gif) no-repeat center top;}
.side-bot { background: url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/sb_bottom.gif) no-repeat center top;}

.home .video-content, .archive .video-content { background: #fff url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/top_left.gif) no-repeat left top;}
.home .the-post, .archive .the-post { background:#fff url(<?php bloginfo('template_url') ?>/images/<?php echo $theme; ?>/top_right.gif) no-repeat right top;}
<?php
switch ($theme)  {
		//Light
	case 'blue2-light': 
		echo 'body { background-color:#3874a6}';  		break;
	case 'green-light':
		echo 'body { background-color:#CBF4BA}';  		break;
	case 'red-light': 
		echo 'body { background-color:#9e333a}';  		break;
	case 'orange-light': 
		echo 'body { background-color:#ff9f4f}';  		break;
	case 'brown-light': 
		echo 'body { background-color:#8b775f}'; 		break;
	case 'grey-light': 
		echo 'body { background-color:#7e7e7e}'; 		break;
	case 'rose-light':  
		echo 'body { background-color:#bc2f68}';  		break;
		//Dark
	case 'blue-dark': 
		echo 'body { background-color:#86ADD1}';  		break;//
	case 'blue2-dark': 
		echo 'body { background-color:#565A73}';  		break;//
	case 'green-dark':
		echo 'body { background-color:#748855}';  		break;//
	case 'red-dark': 
		echo 'body { background-color:#A64645}';  		break; //
	case 'orange-dark': 
		echo 'body { background-color:#C8874B}';  		break; //
	case 'coffee-dark': 
		echo 'body { background-color:#A9A58C}'; 		break;
	case 'purple-dark': 
		echo 'body { background-color:#8B77AA}'; 		break;//
	case 'white-dark':  
		echo 'body { background-color:#fff}';  		break; //
}

$dark = explode("-",$theme);
if ($dark[1] == 'dark')
{ 
?>
body {color:#ccc}
div.comments ol li{background:#000;  }
.formcontainer {background:#000;}
.post-content { background:#000;} 
.video-content { background:#000;}
 .page .post-content{ background:#000; }
.page .p1 .post-header { background:#000}
.the-post { background:#000}
div.sidebar h3{border-bottom:1px #666 solid;}

.entry-meta { background: #5e5e5e url(<?php bloginfo('template_url') ?>/images/sb_footer_a_dark.gif) no-repeat right top;padding:20px 10px 10px;  }

.post-footer { background-color:#000  }
.post-header { background-color:#000 }
.side-top { background-color:#000 }

.home .p1 .video-content, .archive .p1 .video-content { background-color: #000;}
.home .p1 .the-post,.archive .p1 .the-post { background-color:#000;}
.home .video-content, .archive .video-content { background-color: #000;}
.home .the-post,.archive .the-post  { background-color:#000;}
.sidebar ul.xoxo { background-color:#000; }

a:link, a:visited { color:#fff}
a:hover, a:active { color:#ccc}


div#menu ul li.current_page_item a:link, div#menu ul li.current_page_item a:visited{ color:#fff; background: #000;}



<?php 
}
?> </style> <?php
}

add_action ('admin_menu','vb_add_admin');
add_action ('wp_head','vb_head');
// Translate, if applicable
load_theme_textdomain('sandbox');

// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'sandbox_widgets_init' );

// Add Sandbox function to gallery short code
add_shortcode( 'gallery', 'sandbox_gallery' );

// Adds filters so that things run smoothly
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remember: the Sandbox is for play.




function video_blog_function ($w,$h,$post_id) {

				$youtube_code = get_post_meta($post_id,'youtube',single);
				$meta_code = get_post_meta($post_id,'metacafe',single);
				$daily_code = get_post_meta($post_id,'dailymotion',single);
				$blip_code = get_post_meta($post_id,'blip',single);
				$veoh_code = get_post_meta($post_id,'veoh',single);
				$vimeo_code = get_post_meta($post_id,'vimeo',single);
				$myspace_code = get_post_meta($post_id,'myspace',single);
				$break_code = get_post_meta($post_id,'break',single);					
				$liveleak_code = get_post_meta($post_id,'liveleak',single);
				$hulu_code = get_post_meta($post_id,'hulu',single);			
				$custom_code = get_post_meta($post_id,'custom',single);
				$start_image = get_post_meta($post_id,'start_image',single);
				$any_code = get_post_meta($post_id,'any',single);

				if ($youtube_code) {
				$youtube_s = str_replace(" ", "", $youtube_code);
				$youtube = explode(",", $youtube_s);
					foreach ($youtube as $you) {
					?>
					<object width="<?php echo $w; ?>" height="<?php echo $h; ?>">
					<param name="movie" value="http://www.youtube.com/v/<?php echo $you;?>&hl=en"></param>
					<param name="wmode" value="transparent"></param>
					<embed src="http://www.youtube.com/v/<?php echo $you;?>&hl=en" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $w; ?>" height="<?php echo $h; ?>"></embed>
					</object>
					<?php
					}
				}
			   if ($meta_code) {
			   $meta_s = str_replace(" ", "", $meta_code);
			   $metacafe = explode(",", $meta_s);
					foreach ($metacafe as $metac) {
				
				?>
                <embed src="http://www.metacafe.com/fplayer/<?php echo $metac; ?>.swf" width="<?php echo $w; ?>" height="<?php echo $h; ?>" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
                <?php
				}	}			
			   if ($daily_code) {
			   $daily_s = str_replace(" ", "", $daily_code);
			   $dailymotion = explode(",", $daily_s);
					foreach ($dailymotion as $dailym) {
				?>
				<object width="<?php echo $w; ?>" height="<?php echo $h; ?>">
                <param name="movie" value="http://www.dailymotion.com/swf/<?php echo $dailym; ?>&v3=1&related=1"></param>
                <param name="allowFullScreen" value="true"></param>
                <param name="allowScriptAccess" value="always"></param>
                <embed src="http://www.dailymotion.com/swf/<?php echo $dailym; ?>&v3=1&related=1" type="application/x-shockwave-flash" width="<?php echo $w; ?>" height="<?php echo $h; ?>" allowFullScreen="true" allowScriptAccess="always"></embed>
                </object>
				<?php
				}}
				
				if ($blip_code) {
				$blip_s = str_replace(" ", "", $blib_code);
			    $blip = explode(",", $blip_s);
					foreach ($blip as $bl) {
				?>
				<object type="application/x-shockwave-flash" data="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $bl; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" width="<?php echo $w; ?>" height="<?php echo $h; ?>" allowfullscreen="true" id="showplayer">
                <param name="movie" value="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $bl; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" />
                <param name="quality" value="best" />
                <embed src="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $bl; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" quality="best" width="<?php echo $w; ?>" height="<?php echo $h; ?>" name="showplayer" type="application/x-shockwave-flash"></embed>
                </object>
				<?php
				}}
				
				if ($veoh_code) {
				$veoh_s = str_replace(" ", "", $veoh_code);
			    $veoh = explode(",", $veoh_s);
					foreach ($veoh as $ve) {
				?>
				<embed src="http://www.veoh.com/videodetails2.swf?player=videodetailsembedded&type=v&permalinkId=<?php echo $ve; ?>&id=anonymous" allowFullScreen="true" width="<?php echo $w; ?>" height="<?php echo $h; ?>" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
				<?php
				}}
				if ($vimeo_code) {
				$vimeo_s = str_replace(" ", "", $vimeo_code);
			    $vimeo = explode(",", $vimeo_s);
					foreach ($vimeo as $vi) {
				?>
				<object type="application/x-shockwave-flash" width="<?php echo $w; ?>" height="<?php echo $h; ?>" data="http://www.vimeo.com/moogaloop.swf?clip_id=<?php echo $vi; ?>&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=">
                <param name="quality" value="best" />
                <param name="allowfullscreen" value="true" />
                <param name="scale" value="showAll" />
                <param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id=<?php echo $vi; ?>&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" />
                </object>
				<?php
				}	}							
				if ($myspace_code) {
				$myspace_s = str_replace(" ", "", $myspace_code);
			    $myspace = explode(",", $myspace_s);
					foreach ($myspace as $my) {
				?>
				<embed src="http://lads.myspace.com/videos/vplayer.swf" flashvars="m=<?php echo $my; ?>&v=2&type=video" type="application/x-shockwave-flash" width="<?php echo $w; ?>" height="<?php echo $h; ?>"></embed>
				<?php
				}}
				if ($break_code) {
				$break_s = str_replace(" ", "", $break_code);
			    $break = explode(",", $break_s);
					foreach ($break as $br) {
				?>
				<object width="<?php echo $w; ?>" height="<?php echo $h; ?>">
                <param name="movie" value="http://embed.break.com/<?php echo $br; ?>"></param>
				<embed src="http://embed.break.com/<?php echo $br; ?>" type="application/x-shockwave-flash" width="<?php echo $w; ?>" height="<?php echo $h; ?>"></embed>
                </object>
                <?php
				}}												
				if ($liveleak_code) {
				$liveleak_s = str_replace(" ", "", $liveleak_code);
			    $liveleak = explode(",", $liveleak_s);
					foreach ($liveleak as $ll) {
				?>
                <object width="<?php echo $w; ?>" height="<?php echo $h; ?>">
                <param name="movie" value="http://www.liveleak.com/e/<?php echo $ll; ?>"></param>
                <param name="wmode" value="transparent"></param>
                <embed src="http://www.liveleak.com/e/<?php echo $ll; ?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $w; ?>" height="<?php echo $h; ?>"></embed>
                </object>
                <?php
				}}
				if ($hulu_code) {
				$hulu_s = str_replace(" ", "", $hulu_code);
			    $hulu = explode(",", $hulu_s);
					foreach ($hulu as $hu) {
					if ($w == 450) {
				?>
               
                <object width="<?php echo $w; ?>" height="<?php echo $h-111; ?>">
                <param value="http://www.hulu.com/embed/<?php echo $hu; ?>/" name="movie"/>
                <embed width="<?php echo $w; ?>" height="<?php echo $h-111; ?>" type="application/x-shockwave-flash" src="http://www.hulu.com/embed/<?php echo $hu; ?>/"/>
                </object>
                <?php }
				else {
				?>
               
                <object width="<?php echo $w; ?>" height="<?php echo $h-71; ?>">
                <param value="http://www.hulu.com/embed/<?php echo $hu; ?>/" name="movie"/>
                <embed width="<?php echo $w; ?>" height="<?php echo $h-71; ?>" type="application/x-shockwave-flash" src="http://www.hulu.com/embed/<?php echo $hu; ?>/"/>
                </object>
                <?php
				
				
				}
				}}
											
				if ($custom_code) {
					if ($start_image) {
					$ci = $start_image;
					 } else { $ci = get_bloginfo('template_url') . "/images/video_theme.jpg";
					 }
				$custom_s = str_replace(" ", "", $custom_code);
			    $custom = explode(",", $custom_s);
					foreach ($custom as $cu) {
				?>
                <div id="video-holder-<?php echo get_the_ID(); ?>"></div>
                <script>
				var s1 = new SWFObject("<?php bloginfo('template_url') ?>/flv/mediaplayer.swf","mediaplayer","<?php echo $w; ?>","<?php echo $h; ?>","8");
				s1.addParam("allowfullscreen","true");
				s1.addVariable("width","<?php echo $w; ?>");
				s1.addVariable("height","<?php echo $h; ?>");
				s1.addVariable("file","<?php echo $cu; ?>");
				s1.addVariable("image","<?php echo $ci ?>");
				s1.write("video-holder-<?php echo get_the_ID(); ?>");
				</script>
                <?php
				 }}
				if ($any_code != '') {
					if ($w != '450') {
					$any_code = preg_replace('/width=\"\d\d\d\"/i', 'width="320"', $any_code);
					$any_code = preg_replace('/height=\"\d\d\d\"/i', 'height="266"', $any_code);
					}
					else
					{
					$any_code = preg_replace('/width=\"\d\d\d\"/i', 'width="450"', $any_code);
					$any_code = preg_replace('/height=\"\d\d\d\"/i', 'height="366"', $any_code);
					}
	
					
					echo $any_code;
			
		
				 }
				 ?>

                
<?php
}
?>
<?php
/*
Plugin Name: WordPress Related Posts
Version: 0.7
Plugin URI: http://fairyfish.net/2007/09/12/wordpress-23-related-posts-plugin/
Description: Generate a related posts list via tags of WorPdress
Author: Denis,PaoPao
Author URI: http://fairyfish.net/

Copyright (c) 2007
Released under the GPL license
http://www.gnu.org/licenses/gpl.txt

    This file is part of WordPress.
    WordPress is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

	INSTALL: 
	Just install the plugin in your blog and activate
*/

load_plugin_textdomain('wp_related_posts',PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)) . '/lang');

function wp_get_related_posts() {
	global $wpdb, $post,$table_prefix;
	$wp_rp = get_option("wp_rp");
	
	$exclude = explode(",",$wp_rp["wp_rp_exclude"]);
	$limit = $wp_rp["wp_rp_limit"];
	$wp_rp_title = $wp_rp["wp_rp_title"];
	$wp_no_rp = $wp_rp["wp_no_rp"];
	$wp_no_rp_text = $wp_rp["wp_no_rp_text"];
	$show_date = $wp_rp["wp_rp_date"];
	$show_comments_count = $wp_rp["wp_rp_comments"];
	
	if ( $exclude != '' ) {
		$q = "SELECT tt.term_id FROM ". $table_prefix ."term_taxonomy tt, " . $table_prefix . "term_relationships tr WHERE tt.taxonomy = 'category' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id = $post->ID";

		$cats = $wpdb->get_results($q);
		
		foreach(($cats) as $cat) {
			if (in_array($cat->term_id, $exclude) != false){
				return;
			}
		}
	}
		
	if(!$post->ID){return;}
	$now = current_time('mysql', 1);
	$tags = wp_get_post_tags($post->ID);

	//print_r($tags);
	
	$taglist = "'" . $tags[0]->term_id. "'";
	
	$tagcount = count($tags);
	if ($tagcount > 1) {
		for ($i = 1; $i <= $tagcount; $i++) {
			$taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
		}
	}
		
	if ($limit) {
		$limitclause = "LIMIT $limit";
	}	else {
		$limitclause = "LIMIT 6";
	}
	
	$q = "SELECT DISTINCT p.ID, p.post_title, p.post_date, p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC $limitclause;";

	//echo $q;

	$related_posts = $wpdb->get_results($q);
	$output = "";
	
	if (!$related_posts){
		
		if(!$wp_no_rp || ($wp_no_rp == "popularity" && !function_exists('akpc_most_popular'))) $wp_no_rp = "text";
		
		if($wp_no_rp == "text"){
			if(!$wp_no_rp_text) $wp_no_rp_text= __("No Related Post",'wp_related_posts');
			$output  .= '<li>'.$wp_no_rp_text .'</li>';
		}	else{
			if($wp_no_rp == "random"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Random Posts",'wp_related_posts');
				$related_posts = wp_get_random_posts($limitclause);
			}	elseif($wp_no_rp == "commented"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Most Commented Posts",'wp_related_posts');
				$related_posts = wp_get_most_commented_posts($limitclause);
			}	elseif($wp_no_rp == "popularity"){
				if(!$wp_no_rp_text) $wp_no_rp_text= __("Most Popular Posts",'wp_related_posts');
				$related_posts = wp_get_most_popular_posts($limitclause);
			}else{
				return __("Something wrong",'wp_related_posts');;
			}
			$wp_rp_title = $wp_no_rp_text;
		}
	}		
		
	foreach ($related_posts as $related_post ){
		$output .= '<li>';
		
		if ($show_date){
			$dateformat = get_option('date_format');
			$output .=   mysql2date($dateformat, $related_post->post_date) . " -- ";
		}
		
		$output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">'.wptexturize($related_post->post_title).'';
		
		if ($show_comments_count){
			$output .=  " (" . $related_post->comment_count . ")";
		}
		
		$output .=  '</a></li>';
	}
	
	$output = '<ul class="related_post">' . $output . '</ul>';
		
	if($wp_rp_title != '') $output =  '<h3>'.$wp_rp_title .'</h3>'. $output;
	
	return $output;
}

function wp_related_posts(){

	$output = wp_get_related_posts() ;
	echo $output;	
}

function wp23_related_posts() {
	wp_related_posts();
}

function wp_related_posts_for_feed($content=""){
	$wp_rp = get_option("wp_rp");
	$wp_rp_rss = ($wp_rp["wp_rp_rss"] == 'yes') ? 1 : 0;
	if ( (! is_feed()) || (! $wp_rp_rss)) return $content;
	
	$output = wp_get_related_posts() ;
	$content = $content . $output;
	
	return $content;
}

add_filter('the_content', 'wp_related_posts_for_feed',1);

function wp_related_posts_auto($content=""){
	$wp_rp = get_option("wp_rp");
	$wp_rp_auto = ($wp_rp["wp_rp_auto"] == 'yes') ? 1 : 0;
	if ( (! is_single()) || (! $wp_rp_auto)) return $content;
	
	$output = wp_get_related_posts() ;
	$content = $content . $output;
	
	return $content;
}

add_filter('the_content', 'wp_related_posts_auto',99);

function wp_get_random_posts ($limitclause="") {
    global $wpdb, $tableposts, $post;
		
    $q = "SELECT ID, post_title, post_date, comment_count FROM $tableposts WHERE post_status = 'publish' AND post_type = 'post' AND ID != $post->ID ORDER BY RAND() $limitclause";
    return $wpdb->get_results($q);
}

function wp_random_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$random_posts = wp_get_random_posts ($limitclause);
	
	foreach ($random_posts as $random_post ){
		$output .= '<li>';
		
		$output .=  '<a href="'.get_permalink($random_post->ID).'" title="'.wptexturize($random_post->post_title).'">'.wptexturize($random_post->post_title).'</a></li>';
	}
	
	$output = '<ul class="randome_post">' . $output . '</ul>';
	
	echo $output;
}

function wp_get_most_commented_posts($limitclause="") {
	global $wpdb; 
    $q = "SELECT ID, post_title, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC $limitclause"; 
    return $wpdb->get_results($q);
} 

function wp_most_commented_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$most_commented_posts = wp_get_most_commented_posts ($limitclause);
	
	foreach ($most_commented_posts as $most_commented_post ){
		$output .= '<li>';
		
		$output .=  '<a href="'.get_permalink($most_commented_post->ID).'" title="'.wptexturize($most_commented_post->post_title).'">'.wptexturize($most_commented_post->post_title).'</a></li>';
	}
	
	$output = '<ul class="most_commented_post">' . $output . '</ul>';
	
	echo $output;
}

function wp_get_most_popular_posts ($limitclause="") {
    global $wpdb, $table_prefix;
		
    $q = $sql = "SELECT p.ID, p.post_title, p.post_date, p.comment_count FROM ". $table_prefix ."ak_popularity as akpc,".$table_prefix ."posts as p WHERE p.ID = akpc.post_id ORDER BY akpc.total DESC $limitclause";;
    return $wpdb->get_results($q);
}

function wp_most_popular_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$most_popular_posts = wp_get_most_popular_posts ($limitclause);
	
	foreach ($most_popular_posts as $most_popular_post ){
		$output .= '<li>';
		
		$output .=  '<a href="'.get_permalink($most_popular_post->ID).'" title="'.wptexturize($most_popular_post->post_title).'">'.wptexturize($most_popular_post->post_title).'</a></li>';
	}
	
	$output = '<ul class="most_popular_post">' . $output . '</ul>';
	
	echo $output;
}

add_action('admin_menu', 'wp_add_related_posts_options_page');

function wp_add_related_posts_options_page() {
	if (function_exists('add_options_page')) {
		add_options_page( __('WordPress Related Posts','wp_related_posts'), __('WordPress Related Posts','wp_related_posts'), 8, basename(__FILE__), 'wp_related_posts_options_subpanel');
	}
}

function wp_related_posts_options_subpanel() {
	if($_POST["wp_rp_Submit"]){
		$message = "WordPress Related Posts Setting Updated";
	
		$wp_rp_saved = get_option("wp_rp");
	
		$wp_rp = array (
			"wp_rp_title" 	=> $_POST['wp_rp_title_option'],
			"wp_no_rp"		=> $_POST['wp_no_rp_option'],
			"wp_no_rp_text"	=> $_POST['wp_no_rp_text_option'],
			"wp_rp_limit"	=> $_POST['wp_rp_limit_option'],
			'wp_rp_exclude'	=> $_POST['wp_rp_exclude_option'],
			'wp_rp_auto'	=> $_POST['wp_rp_auto_option'],
			'wp_rp_rss'		=> $_POST['wp_rp_rss_option'],
			'wp_rp_comments'=> $_POST['wp_rp_comments_option'],
			'wp_rp_date'	=> $_POST['wp_rp_date_option']
		);
		
		if ($wp_rp_saved != $wp_rp)
			if(!update_option("wp_rp",$wp_rp))
				$message = "Update Failed";
		
		echo '<div id="message" class="updated fade"><p>'.$message.'.</p></div>';
	}
	
	$wp_rp = get_option("wp_rp");
?>
    <div class="wrap">
        <h2 id="write-post"><?php _e("Related Posts Options&hellip;",'wp_related_posts');?></h2>
        <p><?php _e("WordPress Related Posts Plugin will generate a related posts via WordPress tags, and add the related posts to feed.",'wp_related_posts');?></p>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo basename(__FILE__); ?>">
                <h3><?php _e("Related Posts Preference",'wp_related_posts');?></h3>
                <table class="form-table">
                    <tr>
                        <th><?php _e("Related Posts Title:",'wp_related_posts'); ?></th>
                        <td>
							<input type="text" name="wp_rp_title_option" value="<?php echo $wp_rp["wp_rp_title"]; ?>" />
						</td>
                    </tr>
					<tr>
                        <th><?php _e("When No Related Posts, Dispaly:",'wp_related_posts'); ?></th>
                        <td>
							<?php $wp_no_rp = $wp_rp["wp_no_rp"]; ?>
							<select name="wp_no_rp_option" >
								<option value="text" <?php if($wp_no_rp == 'text') echo 'selected' ?> ><?php _e("Text: 'No Related Posts'",'wp_related_posts'); ?></option>
								<option value="random" <?php if($wp_no_rp == 'random') echo 'selected' ?>><?php _e("Random Posts",'wp_related_posts'); ?></option>
								<option value="commented" <?php if($wp_no_rp == 'commented') echo 'selected' ?>><?php _e("Most Commented Posts",'wp_related_posts'); ?></option>
								<?php if (function_exists('akpc_most_popular')){ ?>
								<option value="popularity" <?php if($wp_no_rp == 'popularity') echo 'selected' ?>><?php _e("Most Popular Posts",'wp_related_posts'); ?></option>
								<?php } ?> 
        					</select>
						</td>
                    </tr>
                    <tr>
                        <th><?php _e("No Related Post's Title or Text:",'wp_related_posts'); ?></th>
                        <td>
							<input type="text" name="wp_no_rp_text_option" value="<?php echo $wp_rp["wp_no_rp_text"]; ?>" />
						</td>
                    </tr>
                    <tr>
                        <th><?php _e("Limit:",'wp_related_posts');?></th>
                        <td>
							<input type="text" name="wp_rp_limit_option" value="<?php echo $wp_rp["wp_rp_limit"]; ?>" />
						</td>
                    </tr>
                    <tr>
                        <th><?php _e("Exclude(category IDs):",'wp_related_posts');?></th>
                        <td>
							<input type="text" name="wp_rp_exclude_option" value="<?php echo $wp_rp["wp_rp_exclude"]; ?>" />
						</td>
                    </tr>
					<tr>
						<th><?php _e("Other Setting:",'wp_related_posts');?></th>
						<td>
						<label>
						<?php
							if ( $wp_rp["wp_rp_auto"] == 'yes' ) {
								echo '<input name="wp_rp_auto_option" type="checkbox" value="yes" checked>';
							} else {
								echo '<input name="wp_rp_auto_option" type="checkbox" value="yes">';
							}
						?>
						<?php _e("Auto Insert Related Posts",'wp_related_posts');?>
						</label>
						<br />
						<label>
						<?php
							if ( $wp_rp["wp_rp_rss"] == 'yes' ) {
								echo '<input name="wp_rp_rss_option" type="checkbox" value="yes" checked>';
							} else {
								echo '<input name="wp_rp_rss_option" type="checkbox" value="yes">';
							}
						?>
						<?php _e("Related Posts for RSS",'wp_related_posts');?>
						</label>
						<br />
						<label>
						<?php
							if ( $wp_rp["wp_rp_comments"] == 'yes' ) {
								echo '<input name="wp_rp_comments_option" type="checkbox" value="yes" checked>';
							} else {
								echo '<input name="wp_rp_comments_option" type="checkbox" value="yes">';
							}
						?>
						<?php _e("Display Comments Count",'wp_related_posts');?>
						</label>
						<br />
						<label>
						<?php
							if ( $wp_rp["wp_rp_date"] == 'yes' ) {
								echo '<input name="wp_rp_date_option" type="checkbox" value="yes" checked>';
							} else {
								echo '<input name="wp_rp_date_option" type="checkbox" value="yes">';
							}
						?>
						<?php _e("Display Post Date",'wp_related_posts');?>
						</label>
						<br />
						</td>
					</tr>
				</table>
            
           <p class="submit"><input type="submit" value="<?php _e("Update Preferences &raquo;",'wp_related_posts');?>" name="wp_rp_Submit" /></p>
        </form>
    </div>
<?php } ?>