<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'config.php';
include 'header.php';
include 'sidebar.php';
?>
<h1>Admin Panel</h1>
<p>Welcome to the Admin Panel.</p>
<form action="add_word.php" method="post">
    <label for="italian">Italian Word:</label>
    <input type="text" id="italian" name="italian" required>
    <br>
    <label for="english">English Translation:</label>
    <input type="text" id="english" name="english" required>
    <br>
    <input type="submit" value="Add Word">
</form>
<hr>
<h2>Bulk Import</h2>
<form action="bulk_import.php" method="post" enctype="multipart/form-data">
    <label for="csvfile">Upload CSV file:</label>
    <input type="file" id="csvfile" name="csvfile" accept=".csv" required>
    <br>
    <input type="submit" value="Upload">
</form>
</body>

</html>
<?php
include 'footer.php';
?>