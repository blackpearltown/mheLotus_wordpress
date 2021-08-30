(function($) {

    "use strict";

    /* Slick Slider Initialize */
    wpsisac_pro_slick_slider_init();

    /* Slick Carousel Slider Initialize */
    wpsisac_pro_slick_carousel_init();

    /* Slick Variable Slider Initialize */
    wpsisac_pro_slick_variable_init();

    /***** Visual Composer Compatibility Start *****/
    /* Toggle */
    $(document).on('click', '.vc_toggle', function() {

        var slider_wrap = $(this).find('.vc_toggle_content .wpsisac-slick-init');

        $(slider_wrap).each(function(index) {

            var slider_id = $(this).attr('id');

            if (typeof(slider_id) !== 'undefined' && slider_id != '' && $(this).hasClass('slick-initialized')) {
                $('#' + slider_id).slick('setPosition');
            }
        });
    });

    /* Accordion - Tab */
    $(document).on('click', '.vc_tta-panel-title', function() {

        var cls_ele = $(this).closest('.vc_tta-panel');
        var slider_wrap = cls_ele.find('.wpsisac-slick-init');

        $(slider_wrap).each(function(index) {

            var slider_id = $(this).attr('id');

            if (typeof(slider_id) !== 'undefined' && slider_id != '' && $(this).hasClass('slick-initialized')) {
                $('#' + slider_id).slick('setPosition');
            }
        });
    });
    /***** Visual Composer Compatibility End *****/

    /* Elementor Compatibility */
    $(document).on('click', '.elementor-tab-title', function() {

        var ele_control = $(this).attr('aria-controls');
        var slider_wrap = $('#' + ele_control).find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');
            $('#' + slider_id).css({ 'visibility': 'hidden', 'opacity': 0 });

            setTimeout(function() {
                if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                    $('#' + slider_id).slick('setPosition');
                    $('#' + slider_id).css({ 'visibility': 'visible', 'opacity': 1 });
                }
            }, 350);
        });
    });

    /* SiteOrigin Compatibility For Accordion Panel */
    $(document).on('click', '.sow-accordion-panel', function() {

        var ele_control = $(this).attr('data-anchor');
        var slider_wrap = $('#accordion-content-' + ele_control).find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');

            if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                $('#' + slider_id).slick('setPosition');
            }
        });
    });

    /* SiteOrigin Compatibility for Tab Panel */
    $(document).on('click focus', '.sow-tabs-tab', function() {
        var sel_index = $(this).index();
        var cls_ele = $(this).closest('.sow-tabs');
        var tab_cnt = cls_ele.find('.sow-tabs-panel').eq(sel_index);
        var slider_wrap = tab_cnt.find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');
            $('#' + slider_id).css({ 'visibility': 'hidden', 'opacity': 0 });

            setTimeout(function() {
                if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                    $('#' + slider_id).slick('setPosition');
                    $('#' + slider_id).css({ 'visibility': 'visible', 'opacity': 1 });
                }
            }, 300);
        });
    });

    /* Beaver Builder Compatibility for Accordion */
    $(document).on('click', '.fl-accordion-item, .fl-tabs-label', function() {

        var cls_ele = $(this).closest('.fl-accordion');
        var ele_control = cls_ele.find('.fl-accordion-button').attr('aria-controls');
        var slider_wrap = $('#' + ele_control).find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');

            if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                $('#' + slider_id).slick('setPosition');
            }
        });
    });

    /* Divi Builder Compatibility for Accordion & Toggle */
    $(document).on('click', '.et_pb_toggle', function() {

        var acc_cont = $(this).find('.et_pb_toggle_content');
        var slider_wrap = acc_cont.find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {

            var slider_id = $(this).attr('id');

            if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                $('#' + slider_id).slick('setPosition');
            }
        });
    });

    /* Divi Builder Compatibility for Tabs */
    $('.et_pb_tabs_controls li a').click(function() {
        var cls_ele = $(this).closest('.et_pb_tabs');
        var tab_cls = $(this).closest('li').attr('class');
        var tab_cont = cls_ele.find('.et_pb_all_tabs .' + tab_cls);
        var slider_wrap = tab_cont.find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');
            $('#' + slider_id).css({ 'visibility': 'hidden', 'opacity': 0 });

            setTimeout(function() {
                if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                    $('#' + slider_id).slick('setPosition');
                    $('#' + slider_id).css({ 'visibility': 'visible', 'opacity': 1 });
                }
            }, 550);
        });
    });

    /* Fusion Builder Compatibility for Tabs */
    $(document).on('click', '.fusion-tabs li .tab-link', function() {
        var cls_ele = $(this).closest('.fusion-tabs');
        var tab_id = $(this).attr('href');
        var tab_cont = cls_ele.find(tab_id);
        var slider_wrap = tab_cont.find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');
            $('#' + slider_id).css({ 'visibility': 'hidden', 'opacity': 0 });

            setTimeout(function() {
                if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                    $('#' + slider_id).slick('setPosition');
                    $('#' + slider_id).css({ 'visibility': 'visible', 'opacity': 1 });
                }
            }, 550);
        });
    });

    /* Fusion Builder Compatibility for Toggles */
    $(document).on('click', '.fusion-accordian .panel-heading a', function() {
        var cls_ele = $(this).closest('.fusion-accordian');
        var tab_id = $(this).attr('href');
        var tab_cont = cls_ele.find(tab_id);
        var slider_wrap = tab_cont.find('.wpsisac-slick-init');

        /* Tweak for slick slider */
        $(slider_wrap).each(function(index) {
            var slider_id = $(this).attr('id');
            $('#' + slider_id).css({ 'visibility': 'hidden', 'opacity': 0 });

            if (typeof(slider_id) !== 'undefined' && slider_id != '') {
                $('#' + slider_id).slick('setPosition');
                $('#' + slider_id).css({ 'visibility': 'visible', 'opacity': 1 });
            }
        });
    });

})(jQuery);

/* Function to Initialize Slick Slider */
function wpsisac_pro_slick_slider_init() {
    jQuery('.wpsisac-slick-slider').each(function(index) {

        if (jQuery(this).hasClass('slick-initialized')) {
            return;
        }

        var slider_id = jQuery(this).attr('id');
        var nav_id = null;
        var slider_nav_id = jQuery(this).attr('data-slider-nav-for');
        var slider_conf = jQuery.parseJSON(jQuery(this).closest('.wpsisac-slider-wrp').attr('data-conf'));

        /* For Navigation */
        if (typeof(slider_nav_id) != 'undefined' && slider_nav_id != '') {
            nav_id = '.' + slider_nav_id;
        }

        if (typeof(slider_id) != 'undefined' && slider_id != '') {

            jQuery('#' + slider_id).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: false,
                asNavFor: nav_id,
                lazyLoad: slider_conf.lazyload,
                speed: parseInt(slider_conf.speed),
                autoplaySpeed: parseInt(slider_conf.autoplay_interval),
                dots: (slider_conf.dots == "true") ? true : false,
                infinite: (slider_conf.loop == "true") ? true : false,
                arrows: (slider_conf.arrows == "true") ? true : false,
                autoplay: (slider_conf.autoplay == "true") ? true : false,
                fade: (slider_conf.fade == "true") ? true : false,
                pauseOnHover: (slider_conf.hover_pause == "true") ? true : false,
                pauseOnFocus: (slider_conf.focus_pause == "false") ? false : true,
                rtl: (slider_conf.rtl == "true") ? true : false,
                mobileFirst: (Wpsisac_Pro.is_mobile == 1) ? true : false,
            });
        }

        /* For Navigation */
        if (typeof(slider_nav_id) != 'undefined') {
            jQuery('.' + slider_nav_id).slick({
                slidesToScroll: 1,
                arrows: true,
                focusOnSelect: true,
                dots: false,
                asNavFor: '#' + slider_id,
                lazyLoad: slider_conf.lazyload,
                slidesToShow: parseInt(slider_conf.slider_nav_column),
                centerMode: (slider_conf.nav_center_mode == "true") ? true : false,
                rtl: (slider_conf.rtl == "true") ? true : false,
                infinite: (slider_conf.loop == "true") ? true : false,
                responsive: [{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slider_nav_column) > 3) ? 3 : parseInt(slider_conf.slider_nav_column),
                        slidesToScroll: 1,
                    }
                }, {
                    breakpoint: 639,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slider_nav_column) > 3) ? 3 : parseInt(slider_conf.slider_nav_column),
                        slidesToScroll: 1,
                        centerMode: false,
                    }
                }, {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slider_nav_column) > 2) ? 2 : parseInt(slider_conf.slider_nav_column),
                        slidesToScroll: 1,
                        centerMode: false,
                    }
                }]
            });
        }
    });
}

/* Function to Initialize Slick Carousel Slider */
function wpsisac_pro_slick_carousel_init() {
    jQuery('.wpsisac-slick-carousal-slider').each(function(index) {

        if (jQuery(this).hasClass('slick-initialized')) {
            return;
        }

        var slider_id = jQuery(this).attr('id');
        var slider_conf = jQuery.parseJSON(jQuery(this).closest('.wpsisac-slick-carousal-wrp').attr('data-conf'));

        jQuery('#' + slider_id).slick({
            lazyLoad: slider_conf.lazyload,
            speed: parseInt(slider_conf.speed),
            autoplaySpeed: parseInt(slider_conf.autoplay_interval),
            slidesToShow: parseInt(slider_conf.slidestoshow),
            slidesToScroll: parseInt(slider_conf.slidestoscroll),
            centerPadding: parseInt(slider_conf.center_padding) + 'px',
            dots: (slider_conf.dots == "true") ? true : false,
            infinite: (slider_conf.loop == "true") ? true : false,
            arrows: (slider_conf.arrows == "true") ? true : false,
            autoplay: (slider_conf.autoplay == "true") ? true : false,
            centerMode: (slider_conf.centermode == "true") ? true : false,
            pauseOnHover: (slider_conf.hover_pause == "true") ? true : false,
            pauseOnFocus: (slider_conf.focus_pause == "false") ? false : true,
            rtl: (slider_conf.rtl == "true") ? true : false,
            mobileFirst: (Wpsisac_Pro.is_mobile == 1) ? true : false,
            responsive: [{
                breakpoint: 1023,
                settings: {
                    slidesToShow: (parseInt(slider_conf.slidestoshow) < 2) ? 2 : parseInt(slider_conf.slidestoshow),
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: (parseInt(slider_conf.slidestoshow) < 2) ? 2 : parseInt(slider_conf.slidestoshow),
                    slidesToScroll: 1,
                    dots: false,
                    centerMode: false,
                }
            }, {
                breakpoint: 639,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    centerMode: false,
                }
            }, {
                breakpoint: 319,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    centerMode: false,
                }
            }, {
                breakpoint: 290,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    centerMode: false,
                }
            }]
        });
    });
}

/* Function to Initialize Slick Variable Slider */
function wpsisac_pro_slick_variable_init() {
    jQuery('.wpsisac-slick-variable').each(function(index) {

        if (jQuery(this).hasClass('slick-initialized')) {
            return;
        }

        var slider_id = jQuery(this).attr('id');
        var slider_conf = jQuery.parseJSON(jQuery(this).closest('.wpsisac-slick-variable-wrp').attr('data-conf'));

        jQuery('#' + slider_id).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '0px',
            lazyLoad: slider_conf.lazyload,
            speed: parseInt(slider_conf.speed),
            autoplaySpeed: parseInt(slider_conf.autoplay_interval),
            dots: (slider_conf.dots == "true") ? true : false,
            infinite: (slider_conf.loop == "true") ? true : false,
            arrows: (slider_conf.arrows == "true") ? true : false,
            autoplay: (slider_conf.autoplay == "true") ? true : false,
            pauseOnHover: (slider_conf.hover_pause == "true") ? true : false,
            pauseOnFocus: (slider_conf.focus_pause == "false") ? false : true,
            rtl: (slider_conf.rtl == "true") ? true : false,
            variableWidth: (slider_conf.var_width == "true") ? true : false,
            mobileFirst: (Wpsisac_Pro.is_mobile == 1) ? true : false,
            responsive: [{
                breakpoint: 1023,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    variableWidth: (slider_conf.var_width == "true") ? true : false,
                }
            }, {
                breakpoint: 639,
                settings: {
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    variableWidth: false,

                }
            }, {
                breakpoint: 319,
                settings: {
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    variableWidth: false,
                    centermode: false,
                }
            }]
        });
    });
}