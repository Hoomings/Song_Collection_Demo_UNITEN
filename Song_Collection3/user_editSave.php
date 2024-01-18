<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Songs Collection</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('wallpaper.jpg') center center fixed;
            background-size: cover;
            color: #ffffff;
        }

        .update-save-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
        }

        a {
            color: #2b1a39;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #1a0d1f;
        }
    </style>
</head>

<body>
<?php
session_start();
// check if session exists
if (isset($_SESSION["UID"])) {
    $UserID = $_POST["UserID"];
    $UserStatus = $_POST["UserStatus"];

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "songs_collection_system";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryUpdate = "UPDATE users SET UserStatus = '".$UserStatus."' WHERE UserID = '".$UserID."'";

        if ($conn->query($queryUpdate) === TRUE) {
            ?>
            <div class="update-save-container">
                <h3>Success update data</h3>
                <br><br>
                Click <a href='viewUser.php'> here </a> to view user list.
            </div>
            <?php
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
} else {
    ?>
    <div class="update-save-container">
        No session exists or session has expired. Please log in again.<br>
        <a href="login.html"> Login </a>
    </div>
    <?php
}
?>
</body>
</html>
