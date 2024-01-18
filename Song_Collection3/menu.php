<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
?>

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

        .menu-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #ffffff; /* Set color to white */
            margin-bottom: 10px;
        }

        p {
            color: #000000; /* Set color to gray */
            margin-bottom: 16px;
        }

        a.button {
            display: inline-block;
            background-color: #2b1a39;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 4px;
        }

        a.button:hover {
            background-color: #1a0d1f;
        }
    </style>
</head>
<body>

<div class="menu-container">
    <h2>WELCOME, Hi <?php echo $_SESSION["UID"];?></h2>
    <p>Choose your menu:</p>

    <?php
    if ($_SESSION["UserType"] == "Admin") {
    ?>
        <a href="admin_viewSong.php" class="button">View Song List</a><br><br>
        <a href="viewUser.php" class="button">View User List</a><br><br>
    <?php
    } else {
    ?>
        <a href="song_form.php" class="button">Register New Song</a><br><br>
        <a href="song_editView.php" class="button">Edit Song Details</a><br><br>
        <a href="song_deleteView.php" class="button">Delete Song Record</a><br><br>
        <a href="viewSong.php" class="button">View Songs List</a><br><br>
    <?php
    }
    ?>

    <a href="logout.php" class="button">Logout</a><br>
</div>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html>Login</a>";
}
?>
