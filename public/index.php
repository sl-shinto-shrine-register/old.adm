<?php
include "../application/bootstrap.php";

$application = new SlsrAdm\Application("../configuration.ini");
$response = $application->process($_SERVER['REQUEST_URI'], $_REQUEST, $_FILES);
$response->show();
