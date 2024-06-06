<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Settings</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #001f3f;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        @media (max-width: 768px) {
            .bottom-image {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: -1;
            }
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
            width: 80%;
            max-width: 500px;
        }

        .info-icon {
            font-size: 4em;
            color: #007bff;
            margin-bottom: 20px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .bottom-nav a {
            color: #001f3f;
            font-size: 1.5em;
            margin: 0 15px;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <i class="fas fa-info-circle info-icon"></i>
            <h1>About the Developer</h1>
            <p>This game was developed by Prince Fisher. It is designed to help new learners learn and match Italian
                words with
                their English translations in a fun and interactive way.</p>
        </div><img src="assets/rome.png" alt="Static Image" class="bottom-image d-md-none">

        <div class="bottom-nav">
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="level.php"><i class="fas fa-gamepad"></i></a>
        </div>
    </body>

</html>