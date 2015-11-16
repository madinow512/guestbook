<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 09.11.2015
 * Time: 22:42
 */
?>
<div class="absoluteElement fullPageContainer">
    <div class="contentContainer">
        <h2>Anmelden</h2>
        <p id="login_message">Bitte gib Deine Anmeldedaten in das Formular ein, um Dich anzumelden.</p>
        <p>Falls Du noch kein Konto hast, kannst Du Dich <a href="static/user/register.php">hier</a> registrieren.</p>
        <form>
            <table>
                <tr>
                    <td class="rightTableCol">
                        <input type="text" id="login_username" value="" placeholder="benutzername"/>
                    </td>
                    <td class="error invisible" id="login_error_username">
                        Bitte gib Deinen korrekten Benutzernamen ein.
                    </td>
                </tr>
                <tr>
                    <td class="rightTableCol">
                        <input type="password" id="login_password" value="" placeholder="passwort"/>
                    </td>
                    <td class="error invisible" id="login_error_password">
                        Bitte gib Dein korrektes Passwort ein.
                    </td>
                </tr>
                <tr>
                    <td class="rightTableCol">
                        <input type="button" id="login_submit" value="anmelden" onclick="performLogin();"/>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>