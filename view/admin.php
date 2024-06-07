<?php ob_start(); ?>
Blalablabla
<?php
$content = ob_get_clean();
$titre = "Admin";
require_once "view/component/template.php";