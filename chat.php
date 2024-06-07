<?php
session_start();
require 'vendor/autoload.php';

// Load configuration
$config = require 'config.php';
$apiKey = $config['openai_api_key'];

// Instantiate the OpenAI client directly
$client = OpenAI::client($apiKey);

// Initialize conversation if not already done
if (!isset($_SESSION['conversation'])) {
    $_SESSION['conversation'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['message'] ?? '';
    
    if ($userMessage) {
        // Append user message to the conversation history
        $_SESSION['conversation'][] = ['role' => 'user', 'content' => $userMessage];

        // Send the conversation history to the GPT model
        $response = $client->chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => $_SESSION['conversation'],
            'max_tokens' => 150,
        ]);

        // Append assistant's response to the conversation history
        $chatResponse = $response['choices'][0]['message']['content'];
        $_SESSION['conversation'][] = ['role' => 'assistant', 'content' => $chatResponse];
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBonus - Chatbot</title>
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/chat.css">
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
                    <?php
                    if (isset($_SESSION['conversation'])) {
                        foreach ($_SESSION['conversation'] as $message) {
                            $roleClass = $message['role'] === 'user' ? 'user' : 'assistant';
                            echo '<div class="message ' . $roleClass . '">' . nl2br(htmlspecialchars($message['content'])) . '</div>';
                        }
                    }
                    ?>
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