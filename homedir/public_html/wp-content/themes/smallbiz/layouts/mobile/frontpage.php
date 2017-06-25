<?php
/**
 * Mobile front page theme.
 *
 * @package WordPress
 * @subpackage Expand2Web SmallBiz
 * @since Expand2Web SmallBiz 3.4
 */
  $hideSidebar = true;
?>
 
<head>

<meta http-equiv="Content-Type" value="application/xhtml+xml" /> 

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd"> 


<title><?php echo biz_option('smallbiz_title');?></title>
<meta name="description" content="<?php echo biz_option('smallbiz_description');?>"/>
<meta name="keywords" content="<?php echo biz_option('smallbiz_keywords');?>" />
<?php echo biz_option('smallbiz_analytics');?>	 

<style>
#pagewrap{background-color:#<?php echo biz_option('smallbiz_mobile-body-color')?>;}
body{background:none;}
</style>

</head>
<body>

<div id="pagewrap">

<div id="headerstrip">

<h1>
<a style="color:black;text-decoration:none;" href="<?php bloginfo('url'); ?>">
<?php echo biz_option('smallbiz_name');/* bloginfo('name'); */ ?>
</a>
</h1>

<h2 style="color:black;"><?php echo biz_option('smallbiz_sub_header'); /* bloginfo('description'); */ ?>
</h2>

</div> <!--close headerstrip-->

<div class="tab-area-small-wrap">

<div class="tab-area-small" style="background-color: #<?php echo biz_option('smallbiz_mobile-button-color')?>;">
<p><a href="tel:<?php echo biz_option('smallbiz_countryprefix')?>-<?php echo biz_option('smallbiz_telephone'); ?>"><span style="color: #<?php echo biz_option('smallbiz_mobile-text-button-color')?>;">Call Us</span></a></p>
</div> <!--close tab-area-small1-->
    
<div class="tab-area-small" style="background-color: #<?php echo biz_option('smallbiz_mobile-button-color')?>;">  
<p><a href="<?php echo biz_option('smallbiz_mobile-map')?>" ><span style="color: #<?php echo biz_option('smallbiz_mobile-text-button-color')?>;">Directions</span></a></p>
</div> <!--close tab-area-small2-->
    
    
</div> <!--closetab-area-small-wrap-->


<div id="textbox">

<div id="mobilehomeimage">
<img width="96" src="<?php bloginfo('template_url'); ?>/images/<?php echo biz_option('smallbiz_mobile-home-image')?>" alt="<?php echo biz_option('smallbiz_name')?>" title="<?php echo biz_option('smallbiz_name')?>" />
</div>

<?php echo biz_option('smallbiz_mobile-home-text')?>

</div> <!--close textbox-->

<div id="footerstrip">
<p>You are viewing our Mobile Site</p>
<p><?php echo biz_option('smallbiz_credit');?></p>
</div> <!--close footerstrip-->

</div> <!--close pagewrap-->

</body>