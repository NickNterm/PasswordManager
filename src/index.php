<?php
$link = mysqli_connect('localhost', 'admin', 'admin', 'LocalWebSite');
if (!$link) {
    echo "<h2>MySQL Error!</h2>";
    exit;
}
$user = $_POST['Username'];
settype($user, "string"); 
$user = str_replace("'","\"",$user);
$pass = $_POST['Password'];
settype($pass, "string"); 
$pass = str_replace("'","\"",$pass);
$db = "LocalWebSite";
mysqli_select_db($link, $db);
$q = mysqli_query($link, "SELECT * FROM Login WHERE username = '$user' AND password = '$pass';");
if (mysqli_num_rows($q)!=0) {
    echo "connected     ";
}else{
    echo "wrong credits ";
}
echo mysqli_num_rows($q);
echo "      Username: ";
echo $user;
echo "    Password: ";
echo $pass;
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
            <button class="btn" type="submit">Login</button>
            <a unselectable="on"  href="register.php">Sign up</a>
        </div>
    </form>

</body>

</html>