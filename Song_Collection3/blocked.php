<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocked Page</title>
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

        .blocked-container {
            background-color: rgba(184, 154, 134, 0.8);
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
            color: red;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #fff;
            text-decoration: none;
            background-color: #2b1a39;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #1a0d1f;
        }
    </style>
</head>

<body>

<div class="blocked-container">
    <h1>Sorry, you are blocked!</h1>
    <p>Contact support for assistance.</p>
    <p>Click <a href='login.html'>here</a> to LOGIN again.</p>
</div>

</body>
</html>
