<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 09.11.2015
 * Time: 19:56
 */
require_once '../static/initApplication.php' ;
?>
<div class="absoluteElement autoHeightElement fullPageContainer">
    <div class="autoWidthElement contentContainer">
            <?php
            if(CustomSessionHandler::doesSessionParamExist(USER)){
                echo "<h2>Willkommen im privaten Bereich</h2>" ;
            }else{
                echo "<h2>Zugang nur für Mitglieder!</h2>" ;
                echo "Bitte melde Dich <a href=\"static/user/login.php\">hier</a> an, um die Inhalte dieser Seite sehen zu können." ;
            }
            ?>
    </div>
</div>