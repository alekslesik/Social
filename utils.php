<?php

class Utils
{
    private static $dbhost = 'localhost';
    private static $dbname = 'robinsnest';
    private static $dbuser = 'robinsnest';
    private static $dbpass = 'rnpassword';

    public function __construct()
    {
//    static $dbhost = 'localhost';
//    static $dbname = 'robinsnest';
//    static $dbuser = 'robinsnest';
//    static $dbpass = 'rnpassword';

        $connection = new mysqli(Utils::$dbhost, Utils::$dbuser, Utils::$dbpass, Utils::$dbname);
        if ($connection->connect_error) die("No Data Base connection");
    }

    /**
     * Create table
     * @param $name string name
     * @param $query
     */
    static function createTable($name, $query)
    {
        Utils::queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
        echo "The table '$name' had created or already exists<br>";
    }

    /**
     * Performs a query on the database
     * @param $query string
     * @return bool|mysqli_result
     */
    static function queryMysql($query)
    {
        global $connection;
        $result = $connection->query($query);
        if (!$result) die("No query to DB");
        return $result;
    }

    /**
     * Destroy session
     */
    static function destroySession()
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
    static function sanitizeString($var)
    {
        global $connection;
        $var = htmlentities(strip_tags($var));

        return $connection->real_escape_string($var);
    }

    /**
     * Show user data from database
     * @param $user
     */
    static function showProfile($user)
    {
        if (file_exists("$user.jpg"))
            echo "img src='$user.jpg' align='left'";

        $result = UTILS::queryMysql("SELECT * FROM profiles WHERE user='$user'");

        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripcslashes($row['text'] . "<br> style='clear:left;'><br>");
        } else echo "<p>There are no data in table</p><br>";
    }
}