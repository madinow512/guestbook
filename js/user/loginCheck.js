/**
 * Created by Markus on 11.11.2015.
 */

function performLogin(){
    var username = $('#login_username').val();
    var password = $('#login_password').val();
    $('#login_error_username').addClass('invisible');
    $('#login_error_password').addClass('invisible');
    var check = checkValues([username, password]) ;
    if(check.correct){
        doLogin(username, password);
    }else{
        handleInvalidLogin(check);
    }
}

function doLogin(username, password){
    /*
    send ajax-request to server and check whether user with the submitted credentials exists.
    Depending on that handle success or error case.
     */
    $('#login_message').addClass('correct');
    $('#login_message').text("Du wurdest erfolgreich angemeldet.");
}

function handleInvalidLogin(check){
    if(!check.correct){
        if(!check[0]){
            $('#login_error_username').removeClass('invisible');
        }
        if(!check[1]){
            $('#login_error_password').removeClass('invisible');
        }
    }
}