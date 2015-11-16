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
    password = CryptoJS.MD5(password).toString();
    PostInterface.execute(urlAPI+'user/login.php', {username: username, password: password}, loginSuccess, loginError);
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

function loginSuccess(data){
    showPopup(data.message);
    closeSidebar();
    $('#login_message').removeClass('error');
    $('#login_message').addClass('correct');
    $('#login_message').text("Du wurdest erfolgreich angemeldet.");
    $('.contentContainer').load('templates/content/private/');
}

function loginError(data){
    $('#login_message').removeClass('correct');
    $('#login_message').addClass('error');
    $('#login_message').text(JSON.parse(data.responseText).message);
}