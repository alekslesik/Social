<?php
require_once 'header.php';
$error = $user = $pass = "";

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user === "" || $pass === "") {
        $error = "Not all fields were entered";
    } else {
        $result = queryMysql("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");

        if ($result->num_rows == 0) {
            $error = "Invalid login attempt";
        } else {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("You are now logged in. Please <a data-transition='slide'
            href='members.php?view=$user'>click here </a> to continue. </div></body></html>");
        }
    }
}
?>

<form action="login.php" method="post">
    <div data-role="fieldcontain">
        <label for=""></label>
        <span class="error"><?php $error ?></span>
    </div>
    <div data-role="fieldcontain">
        <label for=""></label>
        Please enter your details to log in
    </div>
    <div data-role="fieldcontain">
        <label for="">Username</label>
        <input type="text" maxlength="16" name="user" value="<?php $user ?>">
    </div>
    <div data-role="fieldcontain">
        <label for="">Password</label>
        <input type="password" maxlength="16" name="pass" value="<?php $pass ?>">
    </div>
    <div data-role="fieldcontain">
        <label for=""></label>
        <input type="submit" data-transition="slide" value="Login">
    </div>
</form>
</div>
</body>
</html>
