/**
 * Created by Markus on 11.11.2015.
 */

function performRegister(){
    var username = $('#register_username').val();
    var password = $('#register_password').val();
    var password_r = $('#register_password_repeat').val();
    $('#register_error_username').addClass('invisible');
    $('#register_error_password').addClass('invisible');
    $('#register_error_password_repeat').addClass('invisible');
    var check = checkValues([username, password, password_r]) ;
    check[3] = password === password_r ;
    check.correct &= check[3] ;
    if(check.correct){
        doRegister(username, password);
    }else{
        handleInvalidRegistration(check);
    }
}

function doRegister(username, password){
    /*
     send ajax-request to server and check whether user with the submitted credentials exists.
     Depending on that handle success or error case.
     */
    $('#register_message').addClass('correct');
    $('#register_message').text("Du hast Dich erfolgreich registriert.");
}

function handleInvalidRegistration(check){
    if(!check.correct){
        if(!check[0]){
            $('#register_error_username').removeClass('invisible');
        }
        if(!check[1]){
            $('#register_error_password').removeClass('invisible');
        }
        if(!check[2] || !check[3]){
            $('#register_error_password_repeat').removeClass('invisible');
        }
    }
}