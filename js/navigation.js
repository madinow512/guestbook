/**
 * Created by Markus on 09.11.2015.
 */
function bindClickEvent() {
    $('body').on('click', 'a',  function (e) {
        e.preventDefault();
        if (!$(this).hasClass('active') && !$(this).hasClass('notActivated')) {
            var scope = this;
            closeSidebar(function(){
                if ($(scope).hasClass('special')) {
                    $.each($('body').find('a'), function (index, elem) {
                        $(elem).removeClass('active');
                    });
                    $('.contentArea').load($(scope).attr('href'));
                    $(scope).addClass('active');
                } else {
                    openSidebar(function () {
                        $('.sidebarContent').load($(scope).attr('href'));
                    });
                }
            });
        }
        return;
    });
}
