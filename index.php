<?php
session_start();
require("app/core/init.php");

$app = new App();

$_SESSION['login'] = 1;
