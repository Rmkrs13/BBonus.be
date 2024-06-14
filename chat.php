<?php
require 'vendor/autoload.php';

// Load configuration
$config = require 'config.php';
$apiKey = $config['openai_api_key'];

// Start session if not started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle new session logic
if (isset($_GET['new_session']) && $_GET['new_session'] == 'true') {
    session_destroy();
    session_start();
}

// Instantiate the OpenAI client directly
$client = OpenAI::client($apiKey);

// Initialize conversation if not already done
if (!isset($_SESSION['conversation'])) {
    $_SESSION['conversation'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $formData = [
        'name' => $_POST['name'] ?? '',
        'age' => $_POST['age'] ?? '',
        'location' => $_POST['location'] ?? '',
        'alone' => $_POST['alone'] ?? '',
        'with' => $_POST['with'] ?? [],
        'ownHouse' => $_POST['ownHouse'] ?? '',
        'job' => $_POST['job'] ?? '',
        'benefit' => $_POST['benefit'] ?? '',
        'income' => $_POST['income'] ?? '',
        'specificQuestions' => $_POST['specificQuestions'] ?? '',
        'specificQuestionDetails' => $_POST['specificQuestionDetails'] ?? '',
        'interest' => $_POST['interest'] ?? [],
    ];

    // Store form data in session
    $_SESSION['formData'] = $formData;

    // Prepare form data summary for the AI without displaying it in the chat
    $formDataSummary = "";
    foreach ($formData as $key => $value) {
        if (is_array($value)) {
            $formDataSummary .= ucfirst($key) . ": " . implode(', ', $value) . ". ";
        } else {
            $formDataSummary .= ucfirst($key) . ": " . $value . ". ";
        }
    }

    // Prepare the system instructions
    $systemInstructions = "Je bent een behulpzame Nederlandstalige ai chatbox op het digitaal platform bbonus.be. Dit platform gaat uit van de Belgische Federale overheid en is een hulptool gekoppeld aan een database met alle subsidies en steunmaatregelen waar burgers recht op kunnen hebben. Het heeft toegang tot betrouwbare gecontroleerde gegevens van overheidsinstellingen en diensten op elk niveau. Je mag praten tegen de gebruiker en ze vragen stellen en zou zoeken waar ze recht op hebben en meer uit hun belastinggeld te halen. Je kunt gebruikers, vragen stellen in welke thema's ze geïnteresseerd zijn of in welke levensfase ze zitten. Ze kunnen jou ook heel specifieke vragen stellen of ze wel of niet ergens recht op hebben of hoe ze iets moeten aanvragen. Antwoord enkel in het Nederlands. MOMENTEEL HEB JE NOG GEEN TOEGANG TOT DE DATABASE. Dit zijn de gegevens die we al weten over de gebruiker: $formDataSummary";

    // Store system instructions in session
    $_SESSION['systemInstructions'] = $systemInstructions;

    // Handle user message if available
    $userMessage = $_POST['message'] ?? '';

    if ($userMessage) {
        // Append user message to the conversation history
        $_SESSION['conversation'][] = ['role' => 'user', 'content' => $userMessage];

        // Prepare the conversation for the AI model
        $conversation = array_merge(
            [['role' => 'system', 'content' => $_SESSION['systemInstructions']]],
            $_SESSION['conversation']
        );

        // Send the conversation history to the GPT model
        $response = $client->chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => $conversation,
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
    <link rel="stylesheet" href="./styles/style.css">
</head>
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
            <!-- Dropdown content can be added here if needed -->
        </div>
    </header>

    <main>
        <section class="chat">
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
                    <textarea name="message" placeholder="Typ hier je bericht" required></textarea>
                    <button type="submit">Verzenden</button>
                </form>
            </div>
            <h2>Chat met B-Bonus AI</h2>
        </section>
    </main>
    <caption>
        <p>Deze chatbot maakt gebruik van artificiële intelligentie en is geen natuurlijk persoon.</p>
    </caption>
</body>
</html>

</html>