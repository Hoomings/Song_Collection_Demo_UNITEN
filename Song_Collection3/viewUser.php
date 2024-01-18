<?php
session_start();

// check if the session exists
if (isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .users-list-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            color: #ffffff; /* Set color to white */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #63376d;
        }

        th {
            background-color: #2b1a39;
            color: #ffffff;
        }

        a {
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="users-list-container">
    <h2>Users List</h2>

    <?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "songs_collection_system";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryView = "SELECT * FROM USERS WHERE UserType = 'User'";
        $resultQ = $conn->query($queryView);
    }
    ?>

    <table>
        <tr>
            <th>User ID</th>
            <th>User Status</th>
        </tr>

        <?php
        if ($resultQ->num_rows > 0) {
            while ($row = $resultQ->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["UserID"]; ?></td>
                    <td><?php echo $row["UserStatus"]; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='2'>NO data selected</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>

    <br>

    Click <a href="user_editView.php">here</a> to EDIT user status.

    <br><br>

    Click <a href="menu.php">here</a> to MENU page.

</div>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html>Login</a>";
}
?>
