<?php
session_start();
// check if session exists
if (isset($_SESSION["UID"])) {
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

        .edit-status-details-container {
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

        form {
            text-align: left;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
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
            background-color: #2b1a39;
        }

    </style>
</head>

<body>

<div class="edit-status-details-container">
    <h2>Songs Collection List</h2>

    <p style="color: blue; font-weight: bold;">Update song details</p>

    <?php
    $Song_Id = $_POST["Song_Id"];
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "songs_collection_system";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {

        $queryGet = "SELECT * FROM song WHERE Song_Id = '" . $Song_Id . "' ";
        $resultGet = $conn->query($queryGet);

        if ($resultGet->num_rows > 0) {
            ?>

            <form action="admin_editStatusSave.php" name="UpdateForm" method="POST">

                <?php
                while ($baris = $resultGet->fetch_assoc()) {
                    ?>

                    <label for="songId">Song ID: <b><?php echo $baris['Song_Id']; ?></b></label>

                    <label for="title">Title: <?php echo $baris['Title'] ?></label>

                    <label for="artist">Artist/Band Name: <?php echo $baris['Artist_BandName'] ?></label>

                    <label for="audioVideo">Audio OR Video of the song: <a
                                href="<?php echo $baris['Audio_Video']; ?>" target="_blank"><?php echo $baris['Audio_Video']; ?></a></label>

                    <label for="genre">Genre: <?php echo $baris['Genre'] ?></label>

                    <label for="language">Language: <?php echo $baris['Language'] ?></label>

                    <label for="releaseDate">Release Date: <?php echo $baris['ReleaseDate'] ?></label>

                    <label for="songStatus">Song Status:</label>
                    <?php $SStatus = $baris['Song_Status']; ?>
                    <input type="radio" name="Song_Status" value="Pending" <?php if ($SStatus == "Pending") echo "checked"; ?> required> Pending
                    <input type="radio" name="Song_Status" value="Approved" <?php if ($SStatus == "Approved") echo "checked"; ?> required> Approved
                    <input type="radio" name="Song_Status" value="Rejected" <?php if ($SStatus == "Rejected") echo "checked"; ?> required> Rejected

                    <br><br>
                    
                    <input type="hidden" name="Song_Id" value="<?php echo $baris['Song_Id'] ?>">
                    <input type="submit" value="Update New details">
                <?php
                }
                ?>
            </form>

            <?php
        }
    }
    $conn->close();
    ?>

</div>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html>Login</a>";
}
?>
