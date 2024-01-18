<!DOCTYPE html>
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

        .delete-view-container {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #63376d;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2b1a39;
            color: #ffffff;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            color: red;
        }

        input[type="radio"] {
            margin-right: 5px;
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

    // Check if session exists
    if (isset($_SESSION["UID"])) {
    ?>

        <div class="delete-view-container">
            <h2>Songs Collection List</h2>

            <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "songs_collection_system";

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $queryView = "SELECT * FROM SONG WHERE Owner_Id = '" . $_SESSION["UID"] . "'";
                $resultQ = $conn->query($queryView);
            }
            ?>

            <form action="song_delete.php" method="post" onsubmit="return confirm('Are you sure to delete this record')">

                <table border="1">
                    <tr>
                        <th>Choose</th>
                        <th>Song ID</th>
                        <th>Title</th>
                        <th>Artist/BandName</th>
                        <th>Audio/Video</th>
                        <th>Genre</th>
                        <th>Language</th>
                        <th>ReleaseDate</th>
                        <th>Owner ID</th>
                    </tr>

                    <?php
                    if ($resultQ->num_rows > 0) {
                        while ($row = $resultQ->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><input type="radio" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>" required></td>
                                <td><?php echo $row["Song_Id"]; ?></td>
                                <td><?php echo $row["Title"]; ?></td>
                                <td><?php echo $row["Artist_BandName"]; ?></td>
                                <td><a href="<?php echo $row["Audio_Video"]; ?>">Visit Link</a></td>
                                <td><?php echo $row["Genre"]; ?></td>
                                <td><?php echo $row["Language"]; ?></td>
                                <td><?php echo $row["ReleaseDate"]; ?></td>
                                <td><?php echo $row["Owner_Id"]; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" style="color: red;"> NO data selected </td></tr>';
                    }
                    ?>
                </table>

                <br>

                <input type="submit" value="Delete Selected Record">

            </form>

            <?php
            $conn->close();
            ?>

            <br>

        </div>

    <?php
    } else {
    ?>
        <div class="delete-view-container">
            No session exists or the session has expired. Please log in again.<br>
            <a href="login.html"> Login </a>
        </div>
    <?php
    }
    ?>

</body>

</html>
