/**
 * Created by Markus on 08.11.2015.
 */

var isBluredBackground = false;
var isMenuHovered = false;
var isSidebarClosing = false ;

function blurContent(blurRadius1, blurRadius2) {
    var fadeIn = blurRadius1 > blurRadius2 && isBluredBackground && /*$('.sidebar').width() <= 0 &&*/ !isMenuHovered;
    var fadeOut = blurRadius2 > blurRadius1 && !isBluredBackground;
    if (fadeIn) {
        $('.contentArea').animate({opacity: 1, backgroundColor: 'transparent'}, 250);
    } else if (fadeOut) {
        $('.contentArea').animate({opacity: 0.5, backgroundColor: 'rgba(0,0,0,0.2)'}, 250);
    }
    if (fadeIn || fadeOut) {
        $({blurRadius: blurRadius1}).animate({blurRadius: blurRadius2}, {
            duration: 250,
            easing: 'swing',
            step: function () {
                $('.contentArea').css({
                    "-webkit-filter": "blur(" + this.blurRadius + "px)",
                    "-moz-filter": "blur(" + this.blurRadius + "px)",
                    "-o-filter": "blur(" + this.blurRadius + "px)",
                    "-ms-filter": "blur(" + this.blurRadius + "px)",
                    "filter": "progid:DXImageTransform.Microsoft.Blur(PixelRadius='" + this.blurRadius + "')",
                    "filter": "blur(" + this.blurRadius + "px)"
                });
            }
        });
    }
    if (fadeOut) {
        isBluredBackground = true;
    } else if (fadeIn) {
        isBluredBackground = false;
    }
}

function displayPage() {
    setTimeout(function () {
        $('body').animate({opacity: 1}, 250);
    }, 250);
}

function openSidebar(callback) {
    if ($('.sidebar').width() <= 0) {
        blurContent(0, 1);
        $('.sidebar').show();
        $('.sidebar').animate({marginLeft: "50%"}, 250, "easeOutSine", function () {
            $('.sidebarContent').animate({opacity: 1}, 150);
            if (callback) {
                callback();
            }
        });
    } else {
        if (callback) {
            callback();
        }
    }
}

function closeSidebar(callback) {
    if ($('.sidebar').width() > 0) {
        blurContent(1, 0);
        isSidebarClosing = true ;
        $('.sidebarContent').animate({opacity: 0}, 150);
        $('.sidebar').animate({marginLeft: "100%"}, 250, "easeOutSine", function () {
            $('.sidebar').hide();
            $('.sidebarContent').html("");
            if (callback) {
                callback();
            }
            isSidebarClosing = false ;
        });
        $('.sidebarContent').animate({opacity: 0}, 250);
    } else {
        if (callback) {
            callback();
        }
    }
}