<?php
/**
 * Rotator-Video front page theme.
 *
 * @package WordPress
 * @subpackage Expand2Web SmallBiz
 * @since Expand2Web SmallBiz 3.5.1
 */

 $hideSidebar = true;
?> 

<div id="homewrap">
	<div id="business" style="color:#<?php echo get_option('smallbiz_main_text_color') ?>;">
	
	<div id="rotator-video">

<?php echo biz_option('smallbiz_rotator_video')?>
</div>
		
		<?php echo biz_option('smallbiz_rotator_main_text1')?>
	


</div>
</div>

<div id="devider">
</div>
<div id="home">

<div id="homepage-box1">


<?php echo biz_option('smallbiz_rotator_boxe1')?>


</div>

<div id="homepage-box2">

<?php echo biz_option('smallbiz_rotator_boxe2')?>


</div>

<div id="homepage-box3">

<?php echo biz_option('smallbiz_rotator_boxe3')?>



</div>

<div id="homepage-box4">

<?php echo biz_option('smallbiz_rotator_boxe4')?>


</div>
</div>
</div>

