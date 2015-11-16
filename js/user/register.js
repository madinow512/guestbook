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
        doRegister(username, password, password_r);
    }else{
        handleInvalidRegistration(check);
    }
}

function doRegister(username, password, password_r){
    password = CryptoJS.MD5(password).toString();
    password_r = CryptoJS.MD5(password_r).toString();
    PostInterface.execute(urlAPI+"user/register.php", {username: username, password: password, c_password: password_r},
        registerSuccess, registerError);
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

function registerSuccess(data){
    showPopup(data.message);
    $('#register_message').removeClass('error');
    $('#register_message').addClass('correct');
    $('#register_message').text("Du hast Dich erfolgreich registriert.");
}

function registerError(data){
    $('#register_message').removeClass('correct');
    $('#register_message').addClass('error');
    $('#register_message').text(JSON.parse(data.responseText).message);
}