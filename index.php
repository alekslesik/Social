<?php

if (!isset($_SESSION)) session_start();

require_once 'header.php';

echo "<div class='center'>Welcome to Robin's Nest,";

if ($loggedin) echo " $user, you are logged in";
else echo " please sign up or log in!";
echo "</div>";

require_once 'footer.html';