<?php
require 'vendor/autoload.php';

// Load configuration
$config = require 'config.php';
$apiKey = $config['openai_api_key'];

// Instantiate the OpenAI client directly
$client = OpenAI::client($apiKey);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $location = $_POST['location'] ?? '';
    $alone = $_POST['alone'] ?? '';
    $with = isset($_POST['with']) ? implode(', ', $_POST['with']) : '';
    $ownHouse = $_POST['ownHouse'] ?? '';
    $job = $_POST['job'] ?? '';
    $benefit = $_POST['benefit'] ?? '';
    $income = $_POST['income'] ?? '';
    $specificQuestions = $_POST['specificQuestions'] ?? '';
    $specificQuestionDetails = $_POST['specificQuestionDetails'] ?? '';
    $interest = isset($_POST['interest']) ? implode(', ', $_POST['interest']) : '';

    // Compile the answers into a string
    $answers = "
        Name: $name
        Age: $age
        Location: $location
        Living alone: $alone
        Living with: $with
        Own house: $ownHouse
        Job: $job
        Benefit: $benefit
        Income: $income
        Specific questions: $specificQuestions
        Specific question details: $specificQuestionDetails
        Interests: $interest
    ";

    // Prepare the messages for the chat model
    $messages = [
        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
        ['role' => 'user', 'content' => "Here are the user's details: $answers. Start a chat with them."]
    ];

    // Start the chat with the compiled answers
    $response = $client->chat()->create([
        'model' => 'gpt-4-turbo',
        'messages' => $messages,
        'max_tokens' => 150,
    ]);

    $chatResponse = $response['choices'][0]['message']['content'];
} else {
    $chatResponse = "Please fill out the form to start a chat.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBonus - Chatbot</title>
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="./index.php">
                <img src="./images/logo.svg" alt="BBonus Logo">
            </a>
        </div>
        <div class="dropdown">
            <button class="dropbtn">NL</button>
            <div class="dropdown-content">
                <a href="#">FR</a>
                <a href="#">DE</a>
            </div>
        </div>
    </header>

    <main>
        <section class="chat">
            <h2>Chat with BBonus</h2>
            <div class="chat-container">
                <div class="chat-box">
                    <?php echo nl2br(htmlspecialchars($chatResponse)); ?>
                </div>
                <form action="chat.php" method="POST" class="chat-form">
                    <textarea name="message" placeholder="Type your message..." required></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>