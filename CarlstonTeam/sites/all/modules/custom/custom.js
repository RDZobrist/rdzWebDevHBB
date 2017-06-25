    jQuery( document ).ready(function() {

    	jQuery("body.page-user-register #page-title").html("<span class='free-trial'>30 DAY FREE TRIAL</span><span>Create an account information</span><span class='required-fields-new'>* Required Fields");
    	jQuery("label[for*='edit-conf-mail']").html("Re-Type Email");
    	jQuery("label[for*='edit-pass-pass2']").html("Re-Type Password");
    	jQuery("body.page-user-login .form-item-name label").html("Email");
    	jQuery("body.page-user-login .help-block a").html("forgot password?");
    	jQuery(".view-housing-us-states .view-header .us_states").click(function(){
        jQuery(this).parent('div').next('div.view-content').slideToggle();
    });
        jQuery( ".form-item-title" ).prepend( jQuery( ".field-type-markup" ) );
    });
    