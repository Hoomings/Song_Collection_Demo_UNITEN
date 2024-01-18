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
        }

        .edit-details-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #ffffff;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            color: blue;
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #2b1a39;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #1a0d1f;
        }
    </style>
</head>
<body>
<?php
session_start();
$UserID = $_POST["UserID"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "songs_collection_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queryGet = "SELECT * FROM users WHERE UserID = '" . $UserID . "' ";
$resultGet = $conn->query($queryGet);

if ($resultGet->num_rows > 0) {
    while ($baris = $resultGet->fetch_assoc()) {
        ?>
        <div class="edit-details-container">
            <h2>Songs Collection List</h2>
            <p>Update user details</p>
            <form action="user_editSave.php" name="UpdateForm" method="POST">
                <label>User ID: <b><?php echo $baris['UserID']; ?></b></label>
                <label>User Status:</label>
                <?php $UStatus = $baris['UserStatus']; ?>
                <input type="radio" name="UserStatus" value="Active" <?php echo ($UStatus == "Active") ? "checked" : ""; ?> required> Active
                <input type="radio" name="UserStatus" value="Blocked" <?php echo ($UStatus == "Blocked") ? "checked" : ""; ?> required> Blocked
                <br><br>
                <input type="hidden" name="UserID" value="<?php echo $baris['UserID'] ?>">
                <input type="submit" value="Update New details">
            </form>
        </div>
        <?php
    }
    $conn->close();
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
</body>
</html>
