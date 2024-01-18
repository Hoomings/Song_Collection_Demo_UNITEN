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

        .songs-list-container {
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

        th, td {
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
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            color: red;
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

<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
    ?>

    <div class="songs-list-container">
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
        $searchCondition = "Title LIKE '%$searchTerm%' OR Artist_BandName LIKE '%$searchTerm%'";

        $queryView = "SELECT * FROM SONG WHERE Song_Status = 'Approved' AND ($searchCondition) ORDER BY ReleaseDate DESC";
        $resultQ = $conn->query($queryView);
    }
    ?>

        <table border="1">
            <tr>
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
                while ($row = $resultQ->fetch_assoc()){

                    ?>
                    <tr>
                        <td><?php echo $row["Song_Id"];?></td>
                        <td><?php echo $row["Title"];?></td>
                        <td><?php echo $row["Artist_BandName"];?></td>
                        <td><a href="<?php echo $row["Audio_Video"];?>" target="_blank">Visit Link</a></td>
                        <td><?php echo $row["Genre"];?></td>
                        <td><?php echo $row["Language"];?></td>
                        <td><?php echo $row["ReleaseDate"];?></td>
                        <td><?php echo $row["Owner_Id"];?></td>
                        <td><?php echo $row["Song_Status"];?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9' > NO data selected </td></tr>";
            }
            ?>
        </table>

        <?php
        $conn->close();
        ?>

        <br>

        Click <a href="song_form.php">here</a> to INSERT new Song details. 

        <br><br>

        Click <a href="song_deleteView.php">here</a> to DELETE Song details.

        <br><br>

        Click <a href="song_editView.php">here</a> to EDIT Song list.

        <br><br>

        Click <a href="menu.php">here</a> to MENU page.

    </div>

    <?php
}
else
{
    ?>
    <div class="songs-list-container">
        No session exists or session has expired. Please log in again.<br>
        <a href="login.html"> Login </a>
    </div>
    <?php
}
?>

</body>
</html>
