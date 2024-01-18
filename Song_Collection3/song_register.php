<!DOCTYPE HTML>
<html>
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

        .registration-details-container {
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
    </style>
</head>

<body>

<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
    ?>

    <div class="registration-details-container">
        <h2>Song Registration Details</h2>

        <?php
        $Title = $_POST["Title"];
        $Artist_BandName = $_POST["Artist_BandName"];
        $AudioVideo = $_POST["AudioVideo"];
        $Genre = $_POST["Genre"];
        $Language = $_POST["Language"];
        $ReleaseDate = $_POST["ReleaseDate"];
        ?>

        <table border="1">
            <tr>
                <td>Title:</td>
                <th><?php echo $Title;?></th>
            </tr>
            <tr>
                <td>Artist/BandName:</td>
                <th><?php echo $Artist_BandName;?></th>
            </tr>
            <tr>
                <td>Audio/Video:</td>
                <th><?php echo '<a href="' . $AudioVideo . '" target="_blank">Visit Link</a>';?></th>
            </tr>
            <tr>
                <td>Genre:</td>
                <th><?php echo $Genre;?></th>
            </tr>
            <tr>
                <td>Language:</td>
                <th><?php echo $Language;?></th>
            </tr>
            <tr>
                <td>ReleaseDate:</td>
                <th><?php echo $ReleaseDate;?></th>
            </tr>
        </table>
        <br>

        <?php 
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "songs_collection_system";

        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error){
            die("MAYDAY MAYDAY, ERROR !".$conn->connect_error);
        }
        else 
        {
            $DBquery = "INSERT INTO SONG (Title, Artist_BandName, Audio_Video, Genre, Language, ReleaseDate, Owner_Id, Song_Status)
            VALUES ('".$Title."' , '".$Artist_BandName."' , '".$AudioVideo."' , '".$Genre."' ,'".$Language."' ,'".$ReleaseDate."', '".$_SESSION["UID"]."', 'Pending' )"; 
            if ($conn->query($DBquery) === TRUE) {
                echo "<p style='color:blue;'>Success insert record!!</p>";
            }
            else {
                echo "<p style='color:red;'> Fail to insert: ". $conn->error. "</p>";
            }   
        }

        $conn->close();
        ?>

        <p> Click <a href="song_form.php">here</a> to enter new Song details.</p>
        <p> Click <a href="viewSong.php">here</a> to view ALL Song details.</p>
    </div>

    <?php
}
else
{
    ?>
    <div class="registration-details-container">
        No session exists or session has expired. Please log in again.<br>
        <a href="login.html"> Login </a>
    </div>
    <?php
}
?>

</body>
</html>
