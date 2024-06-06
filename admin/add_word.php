<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'config.php';
include 'header.php';
include 'sidebar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $italian = $_POST['italian'];
    $english = $_POST['english'];

    $sql = "INSERT INTO words (italian_word, english_translation) VALUES ('$italian', '$english')";

    if ($conn->query($sql) === TRUE) {
        $message = "New word added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<h1>Add Word</h1>
<?php if (isset($message)): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>
<form action="add_word.php" method="post">
    <label for="italian">Italian Word:</label>
    <input type="text" id="italian" name="italian" required>
    <br>
    <label for="english">English Translation:</label>
    <input type="text" id="english" name="english" required>
    <br>
    <input type="submit" value="Add Word">
</form>
<?php
include 'footer.php';
?>