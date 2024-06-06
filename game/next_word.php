<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['words'])) {
    echo 'No words found.';
    exit;
}

$current = $_SESSION['current'];
$words = $_SESSION['words'];

if ($current >= count($words)) {
    echo 'Game Over!';
    exit;
}

$word = $words[$current];
$_SESSION['current']++;

// Example correct answers array with alternatives
$correctAnswersMap = [
    "I am" => "I am,I'm",
    "You are" => "You are,You're",
    "They are" => "They are,They're",
    "Goodbye" => "Goodbye,Good bye",
    "Do not" => "Do not,Don't",
    "Cannot" => "Cannot,Can't",
    "Should not" => "Should not,Shouldn't",
    "Would not" => "Would not,Wouldn't",
    "I will" => "I will,I'll",
    "You will" => "You will,You'll",
    "They will" => "They will,They'll",
    "We are" => "We are,We're",
    "We will" => "We will,We'll",
    "She is" => "She is,She's",
    "He is" => "He is,He's",
    "It is" => "It is,It's",
    "There is" => "There is,There's",
    "There are" => "There are,There're",
    "Who is" => "Who is,Who's",
    "What is" => "What is,What's",
    "Where is" => "Where is,Where's",
    "How is" => "How is,How's",
    "Cannot" => "Cannot,Can't",
    "Will not" => "Will not,Won't",
    "Did not" => "Did not,Didn't",
    "Has not" => "Has not,Hasn't",
    "Have not" => "Have not,Haven't",
    "Was not" => "Was not,Wasn't",
    "Were not" => "Were not,Weren't",
    "Does not" => "Does not,Doesn't",
    "Is not" => "Is not,Isn't",
    "It will" => "It will,It'll",
    "That is" => "That is,That's",
    "What are" => "What are,What're",
    "We have" => "We have,We've",
    "You have" => "You have,You've",
    "They have" => "They have,They've",
    "I have" => "I have,I've",
    "She has" => "She has,She's",
    "He has" => "He has,He's",
    "Do not" => "Do not,Don't",
    "I'm" => "I am,I'm",
    "You're" => "You are,You're",
    "They're" => "They are,They're",
    "We're" => "We are,We're",
    "She's" => "She is,She's",
    "He's" => "He is,He's",
    "It's" => "It is,It's",
    "There's" => "There is,There's",
    "I'll" => "I will,I'll",
    "You'll" => "You will,You'll",
    "They'll" => "They will,They'll",
    "We'll" => "We will,We'll",
    "Won't" => "Will not,Won't",
    "Didn't" => "Did not,Didn't",
    "Hasn't" => "Has not,Hasn't",
    "Haven't" => "Have not,Haven't",
    "Wasn't" => "Was not,Wasn't",
    "Weren't" => "Were not,Weren't",
    "Doesn't" => "Does not,Doesn't",
    "Isn't" => "Is not,Isn't",
    "It'll" => "It will,It'll",
    "What're" => "What are,What're",
    "We've" => "We have,We've",
    "You've" => "You have,You've",
    "They've" => "They have,They've",
    "I've" => "I have,I've",
    "Don't" => "Do not,Don't",
    "Can't" => "Cannot,Can't",
    "Shouldn't" => "Should not,Shouldn't",
    "Wouldn't" => "Would not,Wouldn't",
    "Won't" => "Will not,Won't",
    "Didn't" => "Did not,Didn't",
    "Hasn't" => "Has not,Hasn't",
    "Haven't" => "Have not,Haven't",
    "Wasn't" => "Was not,Wasn't",
    "Weren't" => "Were not,Weren't",
    "Doesn't" => "Does not,Doesn't",
    "Isn't" => "Is not,Isn't",
    "It'll" => "It will,It'll",
    "What're" => "What are,What're",
    "We've" => "We have,We've",
    "You've" => "You have,You've",
    "They've" => "They have,They've",
    "I've" => "I have,I've",
    "Don't" => "Do not,Don't"
];


$correctAnswers = isset($correctAnswersMap[$word['english_translation']]) ? $correctAnswersMap[$word['english_translation']] : $word['english_translation'];

echo '<p id="italian_word">' . $word['italian_word'] . '</p>';
echo '<input type="hidden" id="correct_answer" value="' . $correctAnswers . '">';
echo '<input type="text" id="answer" class="form-control" placeholder="Enter English translation" autocomplete="off">';
echo '<button onclick="checkAnswer()" class="btn btn-primary mt-2">Submit</button>';