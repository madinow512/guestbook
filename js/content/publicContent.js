/**
 * Created by Markus on 19.11.2015.
 */
Date.createFromMysql = function(mysql_string)
{
    var t, result = null;
    if( typeof mysql_string === 'string' )
    {
        t = mysql_string.split(/[- :]/);
        //when t[3], t[4] and t[5] are missing they defaults to zero
        result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
    }
    return result;
}

var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
];

function loadPublicContent(limit, offset){
    var data = {mode: 'public', limit: limit, offset: offset};
    startProgressBar(pollingIntervalTime);
    GetInterface.execute(urlAPI+'content/getContent.php', data, loadFn, null);
}

function loadFn(data){
    if(data){
        data.reverse();
        jQuery.ajaxSetup({ async: false });
        for(var i =0; i < data.length; i++){
            var content = data[i] ;
            $.get("templates/content/contentBox.html", '', function (template) {

                template = $(template);

                template.animate({opacity: 0}, 0);
                template.animate({borderColor: '#0096e0'}, 0);

                var date = Date.createFromMysql(content.created);
                var day = date.getDate();
                var month = date.getMonth();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minutes = (date.getMinutes()<10?'0':'') + date.getMinutes();
                var dateString = day+". "+monthNames[month]+" "+year+", "+hour+":"+minutes;

                var author = $(template.find('#author')[0]);
                author.text(content.username);

                var timestamp = $(template.find('#timestamp')[0]);
                timestamp.text(' - '+dateString);

                var title = $(template.find('#contentTitle')[0]);
                title.text(content.title);

                var message = $(template.find('#contentMessage')[0]);
                message.html(content.message.replace(/\n/g,"<br>"));

                $("#contentBoxContainer").prepend(template);

                template.animate({opacity: 1}, 350);
                template.animate({borderColor: '#ccc'}, 2000);

            });
        }
    }
}

function createPublicContent(){
    var username = $('#newcontent_username').val();
    var title = $('#newcontent_title').val();
    var message = $('#newcontent_message').val();

    $('#newcontent_error_username').addClass('invisible');
    $('#newcontent_error_title').addClass('invisible');
    $('#newcontent_error_message').addClass('invisible');
    var check = checkValues([username, title, message]);

    res = message.split(" ");
    if(res.length > 10000){
        check[3] = false ;
        check.correct = false ;
    }

    if(check.correct){
        doCreatePublicContent(username, title, message);
    }else{
        handleIncorrectPublicContent(check);
    }
}

function doCreatePublicContent(username, title, message){
    PostInterface.execute(urlAPI+'content/newContent.php', {username: username, title: title, message: message}, publicContentSuccess, publicContentError);
}

function publicContentSuccess(succData){
    showPopup(succData.message);
    closeSidebar();
    $('#newcontent_info_message').removeClass('error');
    $('#newcontent_info_message').addClass('correct');
    $('#newcontent_info_message').text(succData.message);
}

function publicContentError(errData){
    console.log("error", errData);
}

function handleIncorrectPublicContent(check){
    if(!check.correct){
        if(!check[0]){
            $('#newcontent_error_username').removeClass('invisible');
        }
        if(!check[1]){
            $('#newcontent_error_title').removeClass('invisible');
        }
        if(!check[2]){
            $('#newcontent_error_message').removeClass('invisible');
        }

        if(!check[3]){
            $('#newcontent_info_message').addClass('error');
            $('#newcontent_info_message').removeClass('correct');
            $('#newcontent_info_message').html("Du hast zu viele Wörter eingegeben. Es sind maximal 10.000 Wörter zulässig.");
        }

    }
}