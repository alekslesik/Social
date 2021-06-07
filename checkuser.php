<?php

require_once 'functions.php';


if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $result = queryMysql("SELECT * FROM members WHERE user='$user'");

    if ($result->num_rows) {
        echo "<span class='taken'>The username $user is taken</span>";
    } else {
        echo "<span class='available'>The username $user is available</span>";
    }
}
