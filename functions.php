<?php
$dbhost = 'localhost';
$dbname = 'robinsnest';
$dbuser = 'robinsnest';
$dbpass = 'rnpassword';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die("No Data Base connection");

/**
 * Create table
 * @param $name string name
 * @param $query
 */
function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "The table '$name' had created or already exists<br>";
}

/**
 * Performs a query on the database
 * @param $query string
 * @return bool|mysqli_result
 */
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("No query to DB");
    return $result;
}

/**
 * Destroy session
 */
function destroySession()
{
    $_SESSION = array();
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');

    session_destroy();
}

/**
 * Strip HTML and PHP tags from a string
 * Convert all applicable characters to HTML entities
 * @param $var string
 * @return string
 */
function sanitizeString($var)
{
    global $connection;
    $var = htmlentities(strip_tags($var));

    return $connection->real_escape_string($var);
}

/**
 * Show user data from database
 * @param $user
 */
function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "img src='$user.jpg' align='left'";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripcslashes($row['text'] . "<br> style='clear:left;'><br>");
    } else echo "<p>There are no data in table</p><br>";
}