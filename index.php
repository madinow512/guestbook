<?php
    require_once 'static/initApplication.php';
?>
<!DOCTYPE html>
<html>
<?php
include_once "static/components/header.php";
?>
<body onload="initApplication();">

<div class="absoluteElement autoWidthElement autoHeightElement page">

    <?php
        include_once "static/components/menu.php";
    ?>

    <div class="absoluteElement autoWidthElement autoHeightElement contentArea">
        <!-- CONTENT WILL GO HERE -->
    </div>

    <?php
        include_once "static/components/sidebar.php";
    ?>

</div>

</body>
</html>