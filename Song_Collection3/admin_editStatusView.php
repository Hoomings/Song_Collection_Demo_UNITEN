<?php
session_start();
// check if session exists
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

        .edit-status-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
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
            background-color: #2b1a39;
        }

    </style>
</head>

<body>

<div class="edit-status-container">
    <h2>Songs Collection List</h2>

    <form method="POST">
            <label for="search">Search by Title or Artist/BandName:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Search">
        </form>

        <?php

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "songs_collection_system";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

            $queryView = "SELECT * FROM SONG WHERE 
                           Title LIKE '%$searchTerm%' OR
                           Artist_BandName LIKE '%$searchTerm%'";
            $resultQ = $conn->query($queryView);
        }
        ?>

    <form action="admin_editStatusDetails.php" method="post" onsubmit="return confirm('Are you sure to edit this record')">

        <table>
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
                <th>Song Status</th>
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
                        <td><a href="<?php echo $row["Audio_Video"]; ?>" target="_blank">Visit Link</a></td>
                        <td><?php echo $row["Genre"]; ?></td>
                        <td><?php echo $row["Language"]; ?></td>
                        <td><?php echo $row["ReleaseDate"]; ?></td>
                        <td><?php echo $row["Owner_Id"]; ?></td>
                        <td style="color: <?php echo getSongStatusColor($row["Song_Status"]); ?>">
                            <?php echo $row["Song_Status"]; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="10" style="color: red;">NO data selected</td></tr>';
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

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html>Login</a>";
}

function getSongStatusColor($status)
{
    switch ($status) {
        case "Approved":
            return "green";
        case "Pending":
            return "yellow";
        case "Rejected":
            return "red";
        default:
            return "black";
    }
}
?>
