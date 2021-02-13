<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "LocalWebSite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$user = $_POST['Username'];
settype($user, "string");
$user = str_replace("'", "\"", $user);
$pass = $_POST['Password'];
settype($pass, "string");
$pass = str_replace("'", "\"", $pass);
$pass2 = $_POST['Password2'];
settype($pass2, "string");
$pass2 = str_replace("'", "\"", $pass);
if (($pass === $pass2) && ($pass != null)) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $salt = '';
    for ($i = 0; $i < 8; $i++) {
        $salt .= $characters[rand(0, $charactersLength - 1)];
    }
    $hashedpass = hash('sha256', $salt . $pass, false);
    $sql = "INSERT INTO Login (username, password, salt)  VALUES ('$user', '$hashedpass', '$salt')";
    if ($conn->query($sql) === TRUE) {
        header('Location: /');
    }
}
?>

<link rel="stylesheet" href="loginstyle.css">
<html>

<body>
    <form action="" method="post">
        <div class="container">
            <div>
                <img src="logo.png">
                <p class="powertext">Powered by <a class="nikolas" href="https://github.com/NickNterm">Nikolas Ntermaris</a></p>
            </div>
            <hr>
            <input type="text" name="Username" placeholder="Enter Username" required>
            <input type="password" name="Password" placeholder="Enter Password" required>
            <input type="password" name="Password2" placeholder="re-enter Password" required>
            <button class="btn" type="submit">Sign up</button>
            <?php
            $pass = $_POST['Password'];
            $pass2 = $_POST['Password2'];
            if ($pass2 != $pass) {
                echo "<div class=\"alert\">\n
                <p class=\"alerttext\">Passwords don't match</p>\n
            </div>";
            }
            ?>
        </div>
    </form>
</body>

</html>