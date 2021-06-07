<?php
if (!isset($_SESSION)) session_start();

require_once "init.html";
require_once "functions.php";

$userstr = "Welcome Guest";
$user = '';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr = "Logged in as: $user";
} else $loggedin = FALSE;

require_once "main.phtml";

if ($loggedin) {
    require_once "loggedin.phtml";
} else {
    require_once 'guest.phtml';
}


