
</div>

	<div id="sidebar">

		<ul>

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */

					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Blog Page') ) : ?>



			<li class="box">

				<h3>Connect With Us: </h3>
		
				<p class="center"><a href="#" target="_blank"><img src="http://members.expand2web.com/E2W-theme-images/TW_icon2.png" class="frame" alt="Expand2Web Twitter Feed"/></a></p>
				
				<p class="center"><a href="#" target="_blank"><img src="http://members.expand2web.com/E2W-theme-images/YT_icon2.png" class="frame" alt="Expand2Web YouTube Link"/></a></p>

				<p class="center"><a href="#" target="_blank"><img src="http://members.expand2web.com/E2W-theme-images/FB_icon2.png" class="frame" alt="Expand2Web Facebook Link"/></a></p>

				<p class="center">You can customize this sidebar.</p>
				<p class="center">This demo sidebar widget will disappear as soon as you drag your own Widget into the appropriate sidebar.</p>
				<p class="center">Go to your WordPress Admin panel, select the Appearance tab on the left and select the Widgets tab.</p>

			</li>

			<?php endif; ?>

		</ul>

	</div>
