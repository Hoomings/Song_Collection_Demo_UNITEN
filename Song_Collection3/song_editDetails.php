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
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('wallpaper.jpg') center center fixed;
            background-size: cover;
        }

        h2 {
            color: #ffffff;
        }

        p {
            color: blue;
            font-weight: bold;
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

        select {
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
    <?php
    session_start();
    // check if session exists
    if (isset($_SESSION["UID"])) {
    ?>

        <?php
$Song_Id =$_POST["Song_Id"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "songs_collection_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) 
{
 die("Connection failed: " . $conn->connect_error);
} 
else 
{
 
    $queryGet = "SELECT * FROM song WHERE Song_Id = '".$Song_Id."' ";
    $resultGet = $conn->query($queryGet);
 
    if ($resultGet->num_rows > 0){
?>

<form action="song_editSave.php" name="UpdateForm" method="POST" >

<?php
    while ($baris = $resultGet->fetch_assoc()){
?>

Song ID: <b><?php echo $baris['Song_Id'];?></b>
<br><br>
Title: <input type="text" name="Title" value="<?php echo $baris['Title'] ?>" maxlength="50" required> 
<br><br> 
Artist/Band Name: <input type="text" name="Artist_BandName" value="<?php echo $baris['Artist_BandName'] ?>" maxlength="50" required> 
<br><br> 
Audio OR Video of the song: <input type="url" name="Audio_Video" value="<?php echo $baris['Audio_Video'] ?>" required><i style="color:red;">*provides clickable URL</i> 
<br><br> 
Genre: <input type="text" name="Genre" maxlength="50" value="<?php echo $baris['Genre'] ?>" required>
<br><br> 
Language: 
<?php $PType = $baris['Language'];?>
<select name="Language" required>
    <option value="" disabled selected>-Please Choose-</option>
    <option value="Arabic" <?php if($PType == "Arabic") echo "selected"; ?>>Arabic</option>
    <option value="Bengali" <?php if($PType == "Bengali") echo "selected"; ?>>Bengali</option>
    <option value="Chinese" <?php if($PType == "Chinese") echo "selected"; ?>>Chinese</option>
    <option value="Dutch" <?php if($PType == "Dutch") echo "selected"; ?>>Dutch</option>
    <option value="English" <?php if($PType == "English") echo "selected"; ?>>English</option>
    <option value="French" <?php if($PType == "French") echo "selected"; ?>>French</option>
    <option value="German" <?php if($PType == "German") echo "selected"; ?>>German</option>
    <option value="Hindi" <?php if($PType == "Hindi") echo "selected"; ?>>Hindi</option>
    <option value="Indonesian" <?php if($PType == "Indonesian") echo "selected"; ?>>Indonesian</option>
    <option value="Italian" <?php if($PType == "Italian") echo "selected"; ?>>Italian</option>
    <option value="Japanese" <?php if($PType == "Japanese") echo "selected"; ?>>Japanese</option>
    <option value="Korean" <?php if($PType == "Korean") echo "selected"; ?>>Korean</option>
    <option value="Malaysia" <?php if($PType == "Malaysia") echo "selected"; ?>>Malaysia</option>
    <option value="Portuguese" <?php if($PType == "Portuguese") echo "selected"; ?>>Portuguese</option>
    <option value="Russian" <?php if($PType == "Russian") echo "selected"; ?>>Russian</option>
    <option value="Spanish" <?php if($PType == "Spanish") echo "selected"; ?>>Spanish</option>
    <option value="Swedish" <?php if($PType == "Swedish") echo "selected"; ?>>Swedish</option>
    <option value="Thailand" <?php if($PType == "Thailand") echo "selected"; ?>>Thai</option>
    <option value="Turkish" <?php if($PType == "Turkish") echo "selected"; ?>>Turkish</option>
    <option value="Urdu" <?php if($PType == "Urdu") echo "selected"; ?>>Urdu</option>
    <option value="Vietnamese" <?php if($PType == "Vietnamese") echo "selected"; ?>>Vietnamese</option>
    <option value="Tagalog" <?php if($PType == "Tagalog") echo "selected"; ?>>Tagalog</option>
    <option value="Swahili" <?php if($PType == "Swahili") echo "selected"; ?>>Swahili</option>
    <option value="Polish" <?php if($PType == "Polish") echo "selected"; ?>>Polish</option>
    <option value="Greek" <?php if($PType == "Greek") echo "selected"; ?>>Greek</option>
    <option value="Hungarian" <?php if($PType == "Hungarian") echo "selected"; ?>>Hungarian</option>
    <option value="Hebrew" <?php if($PType == "Hebrew") echo "selected"; ?>>Hebrew</option>
    <option value="Czech" <?php if($PType == "Czech") echo "selected"; ?>>Czech</option>
    <option value="Finnish" <?php if($PType == "Finnish") echo "selected"; ?>>Finnish</option>
</select> 
<br><br> 
Release Date: <input type="date" name="ReleaseDate" value="<?php echo $baris['ReleaseDate'] ?>" required> 
<br>

<?php

?>
<br><br> 
<input type="hidden" name="Song_Id" value="<?php echo $baris['Song_Id']?>">
<input type="submit" value="Update New details">
</form>

<?php
}
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