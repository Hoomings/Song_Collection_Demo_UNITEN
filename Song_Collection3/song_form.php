<!DOCTYPE HTML>
<html>
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

        .song-form-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #ffffff;
            margin-bottom: 20px;
        }

        form {
            text-align: left;
            margin-top: 20px;
        }

        p {
            color: red;
            font-weight: bold;
        }

        input[type="text"],
        input[type="url"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #63376d;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #2b1a39;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #1a0d1f;
        }

    </style>
</head>

<body>

<?php
session_start();
// check if session exists
if (isset($_SESSION["UID"])) {
    ?>

    <div class="song-form-container">
        <h1>Song Register Form</h1>
        <p><b>Enter song details:</b></p>
        <p><i><b style="color:red;">*ALL fields are required</b></i></p>
        <form name="SongForm" id="SongForm" action="song_register.php" method="POST">
            Title: <input type="text" name="Title" maxlength="50" required>
            <br><br>
            Artist/Band Name: <input type="text" name="Artist_BandName" maxlength="50" required>
            <br><br>
            Audio OR Video of the song: <input type="url" name="AudioVideo" required><i style="color:red;">*provides clickable URL</i>
            <br><br>
            Genre: <input type="text" name="Genre" maxlength="50" required>
            <br><br>
            Language: <select name="Language" required>
                <option value="" disabled selected>-Please Choose-</option>
                <option value="Arabic">Arabic</option>
                <option value="Bengali">Bengali</option>
                <option value="Chinese">Chinese</option>
                <option value="Dutch">Dutch</option>
                <option value="English">English</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Hindi">Hindi</option>
                <option value="Indonesian">Indonesian</option>
                <option value="Italian">Italian</option>
                <option value="Japanese">Japanese</option>
                <option value="Korean">Korean</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Russian">Russian</option>
                <option value="Spanish">Spanish</option>
                <option value="Swedish">Swedish</option>
                <option value="Thailand">Thai</option>
                <option value="Turkish">Turkish</option>
                <option value="Urdu">Urdu</option>
                <option value="Vietnamese">Vietnamese</option>
                <option value="Tagalog">Tagalog</option>
                <option value="Swahili">Swahili</option>
                <option value="Polish">Polish</option>
                <option value="Greek">Greek</option>
                <option value="Hungarian">Hungarian</option>
                <option value="Hebrew">Hebrew</option>
                <option value="Czech">Czech</option>
                <option value="Finnish">Finnish</option>
            </select>
            <br><br>
            Release Date: <input type="date" name="ReleaseDate" required>
            <br><br>
            <input type="submit" value="Display Song Details">
            <input type="reset" value="Cancel">
        </form>
    </div>

    <?php
} else {
    ?>
    <div class="song-form-container">
        No session exists or session has expired. Please log in again.<br>
        <a href="login.html"> Login </a>
    </div>
    <?php
}
?>

</body>
</html>
