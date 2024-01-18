<?php
session_start();
if (isset($_SESSION["UID"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Song_Id = $_POST["Song_Id"];
        $Song_Status = $_POST["Song_Status"];

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "songs_collection_system";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryUpdate = "UPDATE song SET Song_Status = '$Song_Status' WHERE Song_Id = '$Song_Id'";

            if ($conn->query($queryUpdate) === TRUE) {
                ?>

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
            background: url('wallpaper.jpg') center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .update-status-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 20px;
        }

        a {
            color: #2b1a39;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="update-status-container">
    <h2>Success update song status</h2>
    <br><br>
    Click <a href='admin_viewSong.php'>here</a> to view the updated song list.
</div>

</body>
</html>

<?php
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $conn->close();
    } else {
        header("Location: login.html");
        exit();
    }
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
