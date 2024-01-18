<?php
session_start();
// check if session exists
if (isset($_SESSION["UID"])) {
?>

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

        h3 {
            color: #ffffff;
        }

        form {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="url"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
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
    <form action="song_editSave.php" name="UpdateForm" method="POST">
        <h3>Song Update Save!</h3>

           <?php
    $Song_Id = $_POST["Song_Id"];
    $Title = $_POST["Title"];
    $Artist_BandName = $_POST["Artist_BandName"];
    $Audio_Video = $_POST["Audio_Video"];
    $Genre = $_POST["Genre"];
    $Language = $_POST["Language"];
    $ReleaseDate = $_POST["ReleaseDate"];

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "songs_collection_system";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else
    {
        $queryUpdate = "UPDATE song SET
            Title = '".$Title."', Artist_BandName = '".$Artist_BandName."',
            Audio_Video = '".$Audio_Video."', Genre = '".$Genre."',
            Language = '".$Language."', ReleaseDate = '".$ReleaseDate."'
            WHERE Song_Id = '".$Song_Id."' ";

        if ($conn->query($queryUpdate) === TRUE) {
            echo "Success update data";
            echo "<br><br>";
            echo "Click <a href='viewSong.php'> here </a> to view song list ";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
    ?>
</body>
</html>

<?php
}
else
{
echo "No session exists or session has expired. Please
log in again.<br>";
echo "<a href=login.html> Login </a>";
}
?>