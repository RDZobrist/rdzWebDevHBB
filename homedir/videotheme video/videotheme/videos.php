           
			<div class="video-content" align="center">
                <?php 
				$w = '450';
				$h = '355';
				extract ($args);
				$youtube_code = get_post_meta($post->ID,'youtube',single);
				$metacafe = get_post_meta($post->ID,'metacafe',single);
				$dailymotion = get_post_meta($post->ID,'dailymotion',single);
				$blip = get_post_meta($post->ID,'blip',single);
				$veoh = get_post_meta($post->ID,'veoh',single);
				$vimeo = get_post_meta($post->ID,'vimeo',single);
				$myspace = get_post_meta($post->ID,'myspace',single);
				$break = get_post_meta($post->ID,'break',single);					
				$liveleak = get_post_meta($post->ID,'liveleak',single);				
				$custom = get_post_meta($post->ID,'custom',single);
				

			
				if ($youtube_code) {
				$youtube_s = str_replace(" ", "", $youtube_code);
				$youtube = explode(",", $youtube_s);
					foreach ($youtube as $you) {
					?>
					<object width="<?php echo $w; ?>" height="<?php echo $h; ?>">
					<param name="movie" value="http://www.youtube.com/v/<?php echo $you;?>&hl=en"></param>
					<param name="wmode" value="transparent"></param>
					<embed src="http://www.youtube.com/v/<?php echo $you;?>&hl=en" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed>
					</object>
					<?php
					}
				}
			   if ($metacafe) {
				
				?>
                <embed src="http://www.metacafe.com/fplayer/<?php echo $metacafe; ?>.swf" width="460" height="366" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
                <?php
				}				
			   if ($dailymotion) {
				?>
				<object width="450" height="355">
                <param name="movie" value="http://www.dailymotion.com/swf/<?php echo $dailymotion; ?>&v3=1&related=1"></param>
                <param name="allowFullScreen" value="true"></param>
                <param name="allowScriptAccess" value="always"></param>
                <embed src="http://www.dailymotion.com/swf/<?php echo $dailymotion; ?>&v3=1&related=1" type="application/x-shockwave-flash" width="450" height="355" allowFullScreen="true" allowScriptAccess="always"></embed>
                </object>
				<?php
				}
				
				if ($blip) {
				?>
				<object type="application/x-shockwave-flash" data="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $blip; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" width="450" height="366" allowfullscreen="true" id="showplayer">
                <param name="movie" value="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $blip; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" />
                <param name="quality" value="best" />
                <embed src="http://blip.tv/scripts/flash/showplayer.swf?enablejs=true&feedurl=http://moblogic.blip.tv/rss&file=http://blip.tv/rss/flash/<?php echo $blip; ?>&showplayerpath=http://blip.tv/scripts/flash/showplayer.swf" quality="best" width="450" height="366" name="showplayer" type="application/x-shockwave-flash"></embed>
                </object>
				<?php
				}
				
				if ($veoh) {
				?>
				<embed src="http://www.veoh.com/videodetails2.swf?player=videodetailsembedded&type=v&permalinkId=<?php echo $veoh; ?>&id=anonymous" allowFullScreen="true" width="450" height="366" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
				<?php
				}
				if ($vimeo) {
				?>
				<object type="application/x-shockwave-flash" width="450" height="366" data="http://www.vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeo; ?>&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=">
                <param name="quality" value="best" />
                <param name="allowfullscreen" value="true" />
                <param name="scale" value="showAll" />
                <param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeo; ?>&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" />
                </object>
				<?php
				}								
				if ($myspace) {
				?>
				<embed src="http://lads.myspace.com/videos/vplayer.swf" flashvars="m=<?php echo $myspace; ?>&v=2&type=video" type="application/x-shockwave-flash" width="450" height="366"></embed>
				<?php
				}	
				else if ($break) {
				?>
				<object width="464" height="392">
                <param name="movie" value="http://embed.break.com/<?php echo $break; ?>"></param>
				<embed src="http://embed.break.com/<?php echo $break; ?>" type="application/x-shockwave-flash" width="464" height="392"></embed>
                </object>
                <?php
				}												
				if ($liveleak) {
				?>
                <object width="450" height="370">
                <param name="movie" value="http://www.liveleak.com/e/<?php echo $liveleak; ?>"></param>
                <param name="wmode" value="transparent"></param>
                <embed src="http://www.liveleak.com/e/<?php echo $liveleak; ?>" type="application/x-shockwave-flash" wmode="transparent" width="450" height="370"></embed>
                </object>
                <?php
				}										
				if ($custom) {
				?>
                <div id="video_holder"></div>
                <script>
				var s1 = new SWFObject("<?php bloginfo('template_url') ?>/flv/mediaplayer.swf","mediaplayer","450","355","8");
				s1.addParam("allowfullscreen","true");
				s1.addVariable("width","450");
				s1.addVariable("height","355");
				s1.addVariable("file","<?php echo $custom; ?>");
				s1.write("video_holder");
				</script>
                <?php } ?>

                </div>