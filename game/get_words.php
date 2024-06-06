<!-- get_words.php -->
<?php
include '../admin/config.php';

$sql = "SELECT italian_word, english_translation FROM words ORDER BY RAND() LIMIT 20";
$result = $conn->query($sql);

$words = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $words[] = $row;
    }
}

$conn->close();

echo json_encode($words);
?>