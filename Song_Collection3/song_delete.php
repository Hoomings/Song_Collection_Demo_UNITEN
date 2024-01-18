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

        .delete-container {
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

        p {
            color: blue;
            font-weight: bold;
        }

        p.success {
            color: blue;
        }

        p.error {
            color: red;
        }

        a {
            color: blue;
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
    if (isset($_SESSION["UID"])) {
    ?>
        <div class="delete-container">
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
                // Check if Song_Id is set
                if (isset($_POST["Song_Id"])) {
                    $Song_Id = $_POST["Song_Id"];
                    
                    $queryDelete = "DELETE FROM song WHERE Song_Id = '" . $Song_Id . "' ";
    
                    if ($conn->query($queryDelete) === TRUE) {
                        echo "<p class='success'>Record has been deleted from the database!</p>";
                        echo "Click <a href='viewSong.php'>here</a> to view the SONG list";
                    } else {
                        echo "<p class='error'>Query problems! : " . $conn->error . "</p>";
                    }
                } else {
                    // Display an error message if Song_Id is not set
                    echo "<p class='error'>No song selected for deletion.</p>";
                    echo "Click <a href='viewSong.php'>here</a> to view the SONG list";
                }
            }
            $conn->close();
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="delete-container">
            No session exists or session has expired. Please log in again.<br>
            <a href="login.html">Login</a>
        </div>
        <?php
    }
    ?>