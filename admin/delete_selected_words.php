<?php
// Include the database connection file
include 'config.php';

// Include header
include 'header.php';

// Include sidebar
include 'sidebar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_words'])) {
    $selectedWords = $_POST['selected_words'];

    // Sanitize input to prevent SQL injection
    $ids = array_map(function ($id) use ($conn) {
        return (int)$conn->real_escape_string($id);
    }, $selectedWords);

    // Construct the DELETE query
    $sql = "DELETE FROM words WHERE id IN (" . implode(',', $ids) . ")";

    // Execute the DELETE query
    if ($conn->query($sql) === TRUE) {
        // Display Bootstrap alert
        echo '<div class="alert alert-success" role="alert">
                Selected words deleted successfully! Redirecting in 3 seconds...
              </div>';
        // Redirect back to the current page after deletion
        header("refresh:3;url=all_words.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error deleting record: ' . $conn->error . '
              </div>';
    }
}

// Include footer
include 'footer.php';

// Close the database connection
$conn->close();
?>