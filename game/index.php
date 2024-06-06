<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Pair Matching Game - Home</title>
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
            flex-direction: column;
            text-align: center;
            overflow: hidden;
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
            margin-top: 100px;
            animation: slideUp 1s forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100px);
            }

            to {
                transform: translateY(0);
            }
        }

        .start-button {
            font-size: 1.5em;
            padding: 10px 20px;
            margin-top: 20px;
        }

        .gif-container {
            position: absolute;
            top: 0;
            width: 80%;
            display: flex;
            justify-content: center;
            animation: slideDown 1s forwards;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100px);
            }

            to {
                transform: translateY(20px);
            }
        }
        </style>
    </head>

    <body>
        <div class="gif-container">
            <img src="assets/fisher2.png" alt="Animated GIF" class="img-fluid">
        </div>
        <div class="container">
            <h4 style="color: #bb1b40; font-weight: bold;">Welcome to the Pair Matching Game!</h4>

            <p>Match the Italian words with their English translations. Select the correct level to begin.</p>
            <a href="level.php" class="btn btn-primary start-button" onclick="playClickSound()">
                <i class="fas fa-play"></i> Start
            </a>
        </div>
        <img src="assets/italy.png" alt="Static Image" class="bottom-image d-md-none">
        <audio id="clickSound" src="assets/click.mp3"></audio>
        <script>
        function playClickSound() {
            document.getElementById('clickSound').play();
        }
        </script>
    </body>

</html>