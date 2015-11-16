/**
 * Created by Markus on 16.11.2015.
 */
function signout(){
    PostInterface.execute(urlAPI+'user/logout.php', {}, signoutSuccess, function(){});
}

function signoutSuccess(data){
    showPopup(data.message);
    $('#nav_signout').addClass('invisible');
    var elem = $($('.navigation').find('.active')[0]);
    elem.removeClass('active');
    elem.click();
}