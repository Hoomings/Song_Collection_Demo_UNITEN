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

        input[type="password"] {
            font-family: 'Arial', sans-serif;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="registration-details-container">
        <h2>User Registration Details</h2>

        <?php
        $UserID = $_POST["UserID"];
        $UserPwd = $_POST["UserPwd"];
        ?>

        <table border="1">
            <tr>
                <td>User ID:</td>
                <th><?php echo $UserID;?></th>
            </tr>
            <tr>
                <td>User Password:</td>
                <th><input type="password" value="<?php echo $UserPwd; ?>" readonly></th>
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
            $DBquery = "INSERT INTO USERS (UserID, UserPwd, UserType, UserStatus)
            VALUES ('".$UserID."' , '".$UserPwd."' , 'User' , 'Active' )"; 
            if ($conn->query($DBquery) === TRUE) {
                echo "<p style='color:blue;'>Success insert user record!!</p>";
            }
            else {
                echo "<p style='color:red;'> Fail to insert: ". $conn->error. "</p>";
            }   
        }

        $conn->close();
        ?>

        <p> Click <a href="login.html">here</a> to login.</p>
    </div>

</body>
</html>
