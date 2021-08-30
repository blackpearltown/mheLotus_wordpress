/*-------------SIDE NAV ANIMATION-----------*/
function openNav() {
    document.getElementById("mySidenav").style.height = "100%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.0)";
}

function closeNav() {
    document.getElementById("mySidenav").style.height = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}

/*-------------BACK TO TOP BUTTON-----------*/

jQuery(document).ready(function($) {
    if ($(".back_to_top").length > 0) {
        $(window).scroll(function() {
            var e = $(window).scrollTop();
            if (e > 300) {
                $(".back_to_top").show()
            } else {
                $(".back_to_top").hide()
            }
        });
        $(".back_to_top").click(function() {
            $('body,html').animate({
                scrollTop: 0
            })
        })
    }
});
/*-------------------LOCK HOVER TOUCHSCREEN--------------*/
function hasTouch() {
    return 'ontouchstart' in document.documentElement ||
        navigator.maxTouchPoints > 0 ||
        navigator.msMaxTouchPoints > 0;
}
if (hasTouch()) { // remove all the :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
        for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;

            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;

                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                    styleSheet.deleteRule(ri);
                }
            }
        }
    } catch (ex) {}
}