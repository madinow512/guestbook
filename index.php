<!DOCTYPE html>
<html>
<?php
include_once "templates/components/header.html";
?>
<body onload="initApplication();">

<div class="absoluteElement autoWidthElement autoHeightElement page">

    <?php
        include_once "templates/components/popup.html";
        include_once "templates/components/menu.html";
    ?>

    <div class="absoluteElement autoWidthElement autoHeightElement contentArea">
        <!-- CONTENT WILL GO HERE -->
    </div>

    <?php
        include_once "templates/components/sidebar.html";
    ?>

</div>

</body>
</html>