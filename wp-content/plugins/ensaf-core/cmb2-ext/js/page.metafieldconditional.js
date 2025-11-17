(function($){
    "use strict";
    
    let $ensaf_page_breadcrumb_area      = $("#_ensaf_page_breadcrumb_area");
    let $ensaf_page_settings             = $("#_ensaf_page_breadcrumb_settings");
    let $ensaf_page_breadcrumb_image     = $("#_ensaf_breadcumb_image");
    let $ensaf_page_title                = $("#_ensaf_page_title");
    let $ensaf_page_title_settings       = $("#_ensaf_page_title_settings");

    if( $ensaf_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--ensaf-page-breadcrumb-settings").show();
        if( $ensaf_page_settings.val() == 'global' ) {
            $(".cmb2-id--ensaf-breadcumb-image").hide();
            $(".cmb2-id--ensaf-page-title").hide();
            $(".cmb2-id--ensaf-page-title-settings").hide();
            $(".cmb2-id--ensaf-custom-page-title").hide();
            $(".cmb2-id--ensaf-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--ensaf-breadcumb-image").show();
            $(".cmb2-id--ensaf-page-title").show();
            $(".cmb2-id--ensaf-page-breadcrumb-trigger").show();
    
            if( $ensaf_page_title.val() == '1' ) {
                $(".cmb2-id--ensaf-page-title-settings").show();
                if( $ensaf_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--ensaf-custom-page-title").hide();
                } else {
                    $(".cmb2-id--ensaf-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--ensaf-page-title-settings").hide();
                $(".cmb2-id--ensaf-custom-page-title").hide();
    
            }
        }
    } else {
        $ensaf_page_breadcrumb_area.parents('.cmb2-id--ensaf-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $ensaf_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--ensaf-page-breadcrumb-settings").show();
            if( $ensaf_page_settings.val() == 'global' ) {
                $(".cmb2-id--ensaf-breadcumb-image").hide();
                $(".cmb2-id--ensaf-page-title").hide();
                $(".cmb2-id--ensaf-page-title-settings").hide();
                $(".cmb2-id--ensaf-custom-page-title").hide();
                $(".cmb2-id--ensaf-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--ensaf-breadcumb-image").show();
                $(".cmb2-id--ensaf-page-title").show();
                $(".cmb2-id--ensaf-page-breadcrumb-trigger").show();
        
                if( $ensaf_page_title.val() == '1' ) {
                    $(".cmb2-id--ensaf-page-title-settings").show();
                    if( $ensaf_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--ensaf-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--ensaf-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--ensaf-page-title-settings").hide();
                    $(".cmb2-id--ensaf-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--ensaf-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $ensaf_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--ensaf-page-title-settings").show();
            if( $ensaf_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--ensaf-custom-page-title").hide();
            } else {
                $(".cmb2-id--ensaf-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--ensaf-page-title-settings").hide();
            $(".cmb2-id--ensaf-custom-page-title").hide();

        }
    });

    //page settings
    $ensaf_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--ensaf-breadcumb-image").hide();
            $(".cmb2-id--ensaf-page-title").hide();
            $(".cmb2-id--ensaf-page-title-settings").hide();
            $(".cmb2-id--ensaf-custom-page-title").hide();
            $(".cmb2-id--ensaf-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--ensaf-breadcumb-image").show();
            $(".cmb2-id--ensaf-page-title").show();
            $(".cmb2-id--ensaf-page-breadcrumb-trigger").show();
    
            if( $ensaf_page_title.val() == '1' ) {
                $(".cmb2-id--ensaf-page-title-settings").show();
                if( $ensaf_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--ensaf-custom-page-title").hide();
                } else {
                    $(".cmb2-id--ensaf-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--ensaf-page-title-settings").hide();
                $(".cmb2-id--ensaf-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $ensaf_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--ensaf-custom-page-title").hide();
        } else {
            $(".cmb2-id--ensaf-custom-page-title").show();
        }
    });
    
})(jQuery);