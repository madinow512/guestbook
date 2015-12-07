/**
 * Created by Markus on 19.11.2015.
 */

function loadPrivateContent(limit, offset, prepend) {
    prependContent = typeof prepend !== 'undefined' ? prepend : true;
    var c_offset = typeof offset !== 'undefined' ? offset : 0;
    var data = {mode: 'private', limit: limit, offset: c_offset};
    startProgressBar(pollingIntervalTime);
    GetInterface.execute(urlAPI + 'content/getContent.php', data, loadPrivateFn, null);
}

function loadPrivateFn(data) {

    if ((!data || data.length) <= 0 && contentInitialLoad) {
        $('#no_message_info').removeClass('invisible');
    }else if(data && data.length > 0){
        $('#no_message_info').addClass('invisible');
        showPopup("Neue Beiträge wurden geladen.");
    }

    if (data) {
        data.reverse();
        jQuery.ajaxSetup({async: false});

        for (var i = 0; i < data.length; i++) {
            var content = data[i];
            $.get("templates/content/contentBox.html", '', function (template) {

                template = $(template);

                template.animate({opacity: 0}, 0);
                template.animate({borderColor: '#0096e0'}, 0);

                var date = Date.createFromMysql(content.created);
                var day = date.getDate();
                var month = date.getMonth();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
                var dateString = day + ". " + monthNames[month] + " " + year + ", " + hour + ":" + minutes;

                var author = $(template.find('#author')[0]);
                author.text(content.username);

                var timestamp = $(template.find('#timestamp')[0]);
                timestamp.text(' - ' + dateString);

                var title = $(template.find('#contentTitle')[0]);
                title.text(content.title);

                var message = $(template.find('#contentMessage')[0]);
                message.html(content.message.replace(/\n/g, "<br>"));

                if (prependContent) {
                    $("#contentBoxContainer").prepend(template);
                } else {
                    $("#contentBoxContainer").append(template);
                }

                template.animate({opacity: 1}, 350);
                template.animate({borderColor: '#ccc'}, 2000);

            });
        }


        /*
         * Including a scroll function for auto-loading older content when scrolled to the bottom of the page
         * => currently nor working due to offset value for database ...
         *
         $('.contentArea').bind('scroll', function(){
         var delta = $('.contentArea').scrollTop() - prevScrollValue ;
         prevScrollValue = $('.contentArea').scrollTop();
         var scrollingDown =  delta > 0 ;
         if($('.contentArea').scrollTop() + $('.contentArea').height() >= $('#contentBoxContainer').height()) {
         if(scrollingDown){
         $('.contentArea').unbind('scroll');
         console.log("bottom");
         contentOffset += 10;
         loadPublicContent(contentLimit, contentOffset, false);
         }
         }
         });
         */
    }

    contentInitialLoad = false;
}

function createPrivateContent() {
    var title = $('#newcontent_title').val();
    var message = $('#newcontent_message').val();
    $('#newcontent_error_title').addClass('invisible');
    $('#newcontent_error_message').addClass('invisible');
    var check = checkValues([title, message]);
    if (check.correct) {
        doCreatePrivateContent(title, message);
    } else {
        handleIncorrectPrivateContent(check);
    }
}

function doCreatePrivateContent(title, message) {
    PostInterface.execute(urlAPI + 'content/newContent.php', {
        title: title,
        message: message
    }, privateContentSuccess, privateContentError);
}

function privateContentSuccess(succData) {
    showPopup(succData.message);
    closeSidebar();
    $('#newcontent_info_message').removeClass('error');
    $('#newcontent_info_message').addClass('correct');
    $('#newcontent_info_message').text(succData.message);
}

function privateContentError(errData) {
    console.log("error", errData);
}

function handleIncorrectPrivateContent(check) {
    if (!check.correct) {
        if (!check[0]) {
            $('#newcontent_error_title').removeClass('invisible');
        }
        if (!check[1]) {
            $('#newcontent_error_message').removeClass('invisible');
        }
    }
}