/**
 * Created by Markus on 19.11.2015.
 */
function checkLoginStatus(loggedInCallback, loggedOutCallback) {
    GetInterface.execute(urlAPI + 'user/checkUserLogin.php', null,
        function (loggedIn) {
            if (!loggedIn) {
                if (loggedOutCallback) {
                    loggedOutCallback();
                }
            } else {
                if (loggedInCallback) {
                    loggedInCallback();
                }
            }
        }, function (error) {
        });
}