<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'config.php';
include 'header.php';
include 'sidebar.php';

$message = '';
if (isset($_FILES['csvfile'])) {
    $file = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($file, "r");
    
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $italian = $conn->real_escape_string($data[0]);
            $english = $conn->real_escape_string($data[1]);
            $sql = "INSERT INTO words (italian_word, english_translation) VALUES ('$italian', '$english')";
            
            if (!$conn->query($sql)) {
                $message .= "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        }
        
        fclose($handle);
        $message .= "Bulk import completed successfully.";
    } else {
        $message .= "Error opening the file.";
    }
}
?>
<h1>Bulk Import</h1>
<?php if ($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>
<form action="bulk_import.php" method="post" enctype="multipart/form-data">
    <label for="csvfile">Upload CSV file:</label>
    <input type="file" id="csvfile" name="csvfile" accept=".csv" required>
    <br>
    <input type="submit" value="Upload">
</form>
<?php
include 'footer.php';
?>