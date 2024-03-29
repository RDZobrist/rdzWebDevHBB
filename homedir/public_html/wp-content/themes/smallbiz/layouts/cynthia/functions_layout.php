<?php
/**
 * Functions for Cynthia.
 *
 * @package WordPress
 * @subpackage Expand2Web SmallBiz
 * @since Expand2Web SmallBiz 3.3
 */ 

/* Defaults overrides for Layout */
function smallbiz_defaults_for_layout(){
  global $smallbiz_defaults_for_layout, $smallbiz_cur_version;
  if($smallbiz_defaults_for_layout){
      return $smallbiz_defaults_for_layout;
  }

  $smallbiz_defaults_for_layout = array(
    "cynthia_page_image" =>  'mid.jpg',
    "cynthia_main_text" =>  '<div style="float: left; padding-right:15px; padding-bottom
    :8px;"><img src="'.get_bloginfo('template_url').'/images/site1.jpg" alt="Expand2Web Stockimage" height="250" /></div>
    <h2>Call us today: 1.192.555.1212</h2><p> </p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
    sint occaecat cupidatat non proident, sunt in culpa qui officia
    deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>',
    
    "cynthia_left_text" => '<h2>About</h2><hr /><p> </p>
    <div style="float: left; padding-right:15px; padding-bottom
    :8px;"><img src="'.get_bloginfo('template_url').'/images/happy.jpg" alt="Expand2Web Stockimage" /></div><p>This is an example of a Text Box, you could edit this to put information about yourself or your site so readers know where you are coming from. You rename the box to what you like. This box and all others can be edited with a visual editor inside of WordPress.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>',
	"layout_title" =>  'Cynthia',
	);
    return $smallbiz_defaults_for_layout;
}

/* Extra options for layout */
/* Not sure this is needed -- check. */ 
function smallbiz_on_layout_activate()
{
	global $wpdb;
	$smallbiz_defaults = smallbiz_defaults();
	$layout_defaults   = smallbiz_defaults_for_layout();
	if(!get_option('smallbiz_cynthia_left_text')){
	    //update_option('smallbiz_cynthia_left_text', $layout_defaults['cynthia_left_text']);
	}
}
/* Extra options for layout must also be defined here: */
function smallbiz_layout_extra_options()
{
    $options = array(
			'cynthia_left_text',
			'cynthia_main_text',
			'cynthia_page_image'
			
	);
	return $options;
}

/* Section on the options page for layout */
function smallbiz_theme_option_page_layout_options()
{
	global $wpdb, $smallbiz_cur_version ;
	
	if(isset($_POST['sales_update']) )
	{
		if($_FILES['cynthia_page_image']['tmp_name'] != ""){
		    if (file_exists(dirname(__FILE__).'/images/'.get_option('smallbiz_cynthia_page_image'))) {
		        unlink(dirname(__FILE__).'/images/'.get_option('smallbiz_cynthia_page_image'));
			}
			@move_uploaded_file($_FILES['cynthia_page_image']['tmp_name'], dirname(__FILE__). '/../../images/'. $_FILES['cynthia_page_image']['name']);
			update_option('smallbiz_cynthia_page_image', $_FILES['cynthia_page_image']['name']);
			update_option('smallbiz_cynthia_page_image_customized', 'true');
	     }	    
	}
?>
<div id="outerbox">             
<h6>Home Page Text Box - Left Side</h6>
<div id="mainpagetext">

            <?php echo tinyMCE_HTMLarea('cynthia_left_text',get_option("smallbiz_cynthia_left_text")); ?>
            

            <?php

            $pages = $wpdb->get_results('select * from '. $wpdb->prefix .'posts where post_type="page" and post_status="publish"');

            ?>
            
               <br />
	 <p><input type="submit" value="Save Changes" name="sales_update" /></p>
            
</div> <!--mainpagetext--> 
<div id="protip">
<p>ProTip: Upload your own image. Click "Media" -> "Add New" to upload your image.<br /> 
Toggle the Editor into HTML mode and copy/paste the URL into this box.</p>
</div>
</div> <!--outerbox-->
            
            

<div id="outerbox">             
<h6>Home Page Text Box - Right Side</h6>
<div id="mainpagetext">

            <?php echo tinyMCE_HTMLarea('cynthia_main_text',get_option("smallbiz_cynthia_main_text")); ?>
            

            <?php

            $pages = $wpdb->get_results('select * from '. $wpdb->prefix .'posts where post_type="page" and post_status="publish"');

            ?>
            
               <br />
	 <p><input type="submit" value="Save Changes" name="sales_update" /></p>
            
</div> <!--mainpagetext-->
</div> <!--outerbox-->
            
            
<div id="outerbox"> 
<h6>Home Page Banner (above the two textboxes on the homepage)</h6>
<div id="homepageimage">

            <p>Ideal size: 960px x 200px : <input type="file" class="fileinput" name="cynthia_page_image"/></p>
            
               <br />
	 <p><input type="submit" value="Save Changes" name="sales_update" /></p>
            
</div> <!--homepageimage-->    
<div id="protip">
<p>ProTip: Create your own 960px wide banner. You can make it as tall as you want the theme will scale accordingly. You can also upload an animated GIF created using image software for cool slideshow style effects.</p>
</div>
</div> <!--outerbox-->

<?php } ?>