<?php
session_start();
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "LocalWebSite";
$conn = new mysqli($servername, $username, $password, $dbname);
$platform = $_GET['Platfrom'];
settype($platform, "string");
$platform = str_replace("'", "\"", $platform);
$email = $_GET['Email'];
settype($email, "string");
$email = str_replace("'", "\"", $email);
$user = $_GET['Username'];
settype($user, "string");
$user = str_replace("'", "\"", $user);
$pass = $_GET['Password'];
settype($pass, "string");
$pass = str_replace("'", "\"", $pass);
$otherdata = $_GET['OtherData'];
settype($otherdata, "string");
$otherdata = str_replace("'", "\"", $otherdata);
$userid = $_SESSION['userid'];
if (($user != null) && ($pass != null) && ($userid != null)) {
    $sql = "INSERT INTO Data (userid, platform, email, password, username, otherdata)  VALUES ('$userid', '$platform', '$email', '$pass', '$user', '$otherdata')";
    if ($conn->query($sql) === TRUE) {
        header("Location: formhandler.php");
    } else {
        echo $conn->error;
    }
}
?>
<link rel="stylesheet" href="mainstyle.css">
<html>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/">Log out</a>
        <a href="https://github.com/NickNterm">Github</a>
    </div>
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <table>
        <tr>
            <th>Platform</th>
            <th>username</th>
            <th>password</th>
            <th>email</th>
            <th>other data</th>
        </tr>
        <?php
        session_start();
        $servername = "localhost";
        $username = "admin";
        $password = "admin";
        $dbname = "LocalWebSite";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $pass = $_SESSION['password'];
        $user = $_SESSION['username'];
        $salt = $_SESSION['salt'];
        if (($user != null) && ($pass != null) && ($salt != null)) {
            $sql = "SELECT * FROM Login WHERE username = '$user';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (hash('sha256', $salt . $pass, false) === $row["password"]) {
                        $sql1 = "SELECT * FROM Login WHERE username = '$user';";
                        $result = $conn->query($sql1);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $userid = $row["id"];
                                $_SESSION['userid'] = $userid;
                                $sql2 = "SELECT * FROM Data WHERE userid = '$userid';";
                                $result = $conn->query($sql2);
                                while ($rowdata = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $rowdata['platform'] . "</td>";
                                    echo "<td>" . $rowdata['username'] . "</td>";
                                    echo "<td>" . $rowdata['password'] . "</td>";
                                    echo "<td>" . $rowdata['email'] . "</td>";
                                    echo "<td>" . $rowdata['otherdata'] . "</td>";
                                    echo "<td> <span style=\"font-size:30px;cursor:pointer\" onclick=\"openNav()\">&#10005;</span></td></tr>";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            header("Location: /");
        }
        ?>
        <form action="logedin" method="get">
            <td><input type="text" name="Platfrom" placeholder="Enter Platfrom name"></td>
            <td><input type="text" name="Username" placeholder="Enter Username"></td>
            <td><input type="text" name="Password" placeholder="Enter Password"></td>
            <td><input type="text" name="Email" placeholder="Enter Email"></td>
            <td><input type="text" name="OtherData" placeholder="Add Extra Data"></td>
            <td><button class="btn" type="submit">Add</button></td>
        </form>


    </table>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>