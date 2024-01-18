<?php
$userID = $_POST['userID'];
$userPwd = $_POST['userPwd'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "songs_collection_system";

$link = new mysqli($host, $username, $password, $dbname);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} else {
 
    echo '<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs Collection</title>
    <style>
        body {
            font-family: \'Arial\', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url(\'wallpaper.jpg\') center center fixed;
            background-size: cover;
        }

        .login-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Add other styles as needed */
    </style>
</head>
<body>';

    $queryCheck = "SELECT * FROM USERS WHERE UserID = '" . $userID . "'";
    $resultCheck = $link->query($queryCheck);

    if ($resultCheck->num_rows == 0) {
        echo "<div class='login-container'>";
        echo "<p style='color:red;'>User ID does not exist</p>";
        echo "<br>Click <a href='login.html'> here </a> to log-in again";
        echo "</div>";
    } else {
        $row = $resultCheck->fetch_assoc();
        $UserStatus = $row["UserStatus"]; 

        if ($UserStatus === 'Blocked') {
            
            header("Location: blocked.php");
            exit();
        } else {
            
            if ($row["UserPwd"] == $userPwd) {
                session_start();
                $_SESSION["UID"] = $userID;
                $_SESSION["UserType"] = $row["UserType"];
                header("Location: menu.php");
            } else {
                echo "<div class='login-container'>";
                echo "<p style='color:red;'>Wrong password!!! </p>";
                echo "Click <a href='login.html'> here </a> to login again ";
                echo "</div>";
            }
        }
    }
}

$link->close();
?>
</body>
</html>
