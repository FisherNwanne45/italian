<?php
session_start();
include '../admin/config.php';

// Fetch 20 random words from the database
$sql = "SELECT * FROM words ORDER BY RAND() LIMIT 20";
$result = $conn->query($sql);

$words = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $words[] = $row;
    }
}

// Store words in session for later use
$_SESSION['words'] = $words;
$_SESSION['current'] = 0;
$_SESSION['incorrect'] = [];
$_SESSION['score'] = 0;
$_SESSION['total'] = count($words) * 5;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Pair Matching Game</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #001f3f;
            color: #fff;
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
            margin-top: 50px;
            text-align: center;
        }

        .game-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            color: #333;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .preloader .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
        }

        .bottom-nav a {
            color: white;
            font-size: 20px;
        }

        .balloon {
            position: absolute;
            bottom: 0;
            border-radius: 50% 50% 50% 50%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: float 5s ease-in-out infinite;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .balloon::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 2px;
            height: 10px;
            background: inherit;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            50% {
                transform: translateY(-300px);
                opacity: 1;
            }

            100% {
                transform: translateY(0);
                opacity: 0;
            }
        }

        .sad-emoji {
            font-size: 100px;
            color: #ff6f61;
        }
        </style>
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('answer').addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    checkAnswer();
                }
            });
        });

        function playSound(src) {
            const sound = new Audio(src);
            sound.play();
        }

        function showBalloons() {
            for (let i = 0; i < 10; i++) {
                const balloon = document.createElement('div');
                balloon.className = 'balloon';
                balloon.style.left = Math.random() * 100 + '%';
                balloon.style.width = Math.random() * 30 + 20 + 'px';
                balloon.style.height = Math.random() * 40 + 30 + 'px';
                balloon.style.background = `hsl(${Math.random() * 360}, 100%, 50%)`;
                document.querySelector('.game-container').appendChild(balloon);
                setTimeout(() => {
                    balloon.remove();
                }, 5000);
            }
        }

        function showSadEmoji() {
            const emoji = document.createElement('div');
            emoji.className = 'sad-emoji';
            emoji.innerHTML = '&#128577;';
            document.querySelector('.game-container').appendChild(emoji);
            setTimeout(() => {
                emoji.remove();
            }, 3000);
        }

        function checkAnswer() {
            const userAnswer = document.getElementById('answer').value.toLowerCase().replace(/\s+/g, '');
            const correctAnswers = document.getElementById('correct_answer').value.toLowerCase().split(',').map(a => a
                .replace(/\s+/g, ''));
            const italianWord = document.getElementById('italian_word').innerText;
            const feedback = document.getElementById('feedback');
            const scoreElement = document.getElementById('score');

            if (correctAnswers.includes(userAnswer)) {
                feedback.innerHTML = '<div class="alert alert-success" role="alert">Correct!</div>';
                scoreElement.innerText = parseInt(scoreElement.innerText) + 5;
                showBalloons();
                playSound('assets/correct.mp3');
            } else {
                feedback.innerHTML = '<div class="alert alert-danger" role="alert">Wrong!</div>';
                document.getElementById('incorrect_answers').innerHTML +=
                    `<li>${italianWord} - ${correctAnswers.join(' or ')}</li>`;
                showSadEmoji();
                playSound('assets/wrong.mp3');
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "next_word.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('game_area').innerHTML = xhr.responseText;
                    document.getElementById('answer').focus();
                }
            };
            xhr.send();
        }

        function endGame() {
            const finalScore = document.getElementById('score').innerText;
            const totalScore = <?= $_SESSION['total'] ?>;
            document.getElementById('feedback').innerHTML = '';
            document.getElementById('incorrect_answers').style.display = 'block';
            document.getElementById('game_area').innerHTML =
                `<p>Game Over! Final Score: <span id="final_score">${finalScore}/${totalScore}</span></p><button onclick="location.reload()" class="btn btn-primary mt-3">Start Again</button>`;
        }
        </script>
    </head>

    <body>
        <div class="preloader" id="preloader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="container">
            <h1>Pair Matching Game</h1><br><br>
            <div class="game-container">
                <div id="feedback"></div>
                <div id="game_area">
                    <?php include 'next_word.php'; ?>
                </div>
                <p>Score: <span id="score">0</span></p>
                <ul id="incorrect_answers" style="display:none;">
                    <!-- Incorrect answers will be appended here -->
                </ul>
                <button onclick="endGame()" class="btn btn-secondary mt-3">Display Answers</button>
            </div>
        </div><img src="assets/rome.png" alt="Static Image" class="bottom-image d-md-none">


        <div class="bottom-nav">
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="level.php"><i class="fas fa-gamepad"></i></a>
            <a href="settings.php"><i class="fas fa-cog"></i></a>
        </div>

        <script>
        window.onload = function() {
            document.getElementById('preloader').style.display = 'none';
        };
        </script>
    </body>

</html>