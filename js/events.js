/**
 * Created by Markus on 11.11.2015.
 */

function registerResizeEvent(){
    $(window).resize(function(){
        resizeSidebar();
    });
}

function registerLinkClickEvent() {
    bindClickEvent();
    $('#nav_public').click();
}

function registerMenuHoverEvent() {
    $('.menu').on("mouseenter", function () {
        blurContent(0, 1);
        isMenuHovered = true;
    });
    $('.menu').on("mouseleave", function () {
        isMenuHovered = false;
        if($('.sidebar').width() <= 0 || isSidebarClosing){
            blurContent(1, 0);
        }
    });
}

function registerKeyEvents() {
    $('body').keyup(function (e) {
        if (e.keyCode === 27) {
            closeSidebar();
        }
    });
    $('body').on('keypress', 'form', function(e){
        if(e.keyCode === 13){
            $($(this).find(':button')[0]).click();
        }
    });
}

function bindContentAreaClick() {
    $('.contentArea').bind({
        click: function (e) {
            closeSidebar();
        }
    });
}
