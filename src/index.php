<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "LocalWebSite";
$conn = new mysqli($servername, $username, $password, $dbname);
$user = $_POST['Username'];
settype($user, "string");
$user = str_replace("'", "\"", $user);
$pass = $_POST['Password'];
settype($pass, "string");
$pass = str_replace("'", "\"", $pass);
if ($user != null) {
    $sql = "SELECT * FROM Login WHERE username = '$user';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $salt = $row["salt"];
          if(hash('sha256', $salt.$pass, false) === $row["password"]){
            echo "Connected";
          }
        }
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
            <button class="btn" type="submit">Login</button>
            <a unselectable="on" class="nikolas" href="register.php">Sign up</a>
        </div>
    </form>

</body>

</html>