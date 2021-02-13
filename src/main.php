<link rel="stylesheet" href="mainstyle.css">
<html>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a onclick="openForm()">Add Data</a>
        <a href="javascript:javascript:history.go(-1)">Log out</a>
        <a href="https://github.com/NickNterm">Github</a>
    </div>
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <table>
        <tr>
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
                                $sql2 = "SELECT * FROM Data WHERE userid = '$userid';";
                                $result = $conn->query($sql2);
                                while ($rowdata = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $rowdata['username'] . "</td>";
                                    echo "<td>" . $rowdata['password'] . "</td>";
                                    echo "<td>" . $rowdata['email'] . "</td>";
                                    echo "<td>" . $rowdata['other data'] . "</td></tr>";
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
    </table>
    <div class="Add" id="AddForm">
        <input type="text" name="Platfrom" placeholder="Enter Platfrom name">
        <input type="text" name="Username" placeholder="Enter Username">
        <input type="text" name="Password" placeholder="Enter Password">
        <input type="text" name="OtherData" placeholder="Add Extra Data">
        <button class="btn" type="submit">Add</button>
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        function openForm() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("AddForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("AddForm").style.display = "none";
        }
    </script>
</body>

</html>