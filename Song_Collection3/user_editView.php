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

        .edit-view-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #ffffff; /* Set color to white */
            margin-bottom: 20px;
        }

        form {
            text-align: left;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #63376d;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2b1a39;
            color: #ffffff;
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

<div class="edit-view-container">
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

        ?>

        <form action="user_editDetails.php" method="post" onsubmit="return confirm('Are you sure to edit this record')">
            <table border="1">
                <tr>
                    <th>Choose</th>
                    <th>User ID</th>
                    <th>User Status</th>
                </tr>

                <?php
                if ($resultQ->num_rows > 0) {
                    while ($row = $resultQ->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="radio" name="UserID" value="<?php echo $row["UserID"]; ?>" required></td>
                            <td><?php echo $row["UserID"]; ?></td>
                            <td><?php echo $row["UserStatus"]; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="3" style="color: red;">NO data selected</td></tr>';
                }
                }
                ?>
            </table>

            <br>

            <input type="submit" value="View Record to Edit">
        </form>

        <?php
        $conn->close();
        ?>

        <br>
    </div>

</body>
</html>
