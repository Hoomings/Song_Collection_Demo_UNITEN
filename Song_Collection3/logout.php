<?php
session_start();
if (isset($_SESSION["UID"])) {
    session_unset();
    session_destroy();
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

        .logout-container {
            background-color: rgba(184, 154, 134, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        p {
            color: red;
            margin-bottom: 20px;
        }

        a {
            color: #2b1a39;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="logout-container">
    <p>You have successfully logged out.</p>
    <br>Click <a href='login.html'>here</a> to LOGIN again.
</div>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.";
    echo "<br>Click <a href='login.html'>here</a> to LOGIN again.";
}
?>
