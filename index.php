<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBonus - Ontdek waar je écht recht op hebt</title>
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/style.css">
    <style>
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <section>
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
        </section>
    </header>

    <main>
        <section class="intro">
            <img src="./images/wordlogo.svg" alt="BBonus">
            <h2>Ontdek waar je écht recht op hebt</h2>
            <button class="test-btn">DOE DE TEST</button>
        </section>

        <section class="interview" style="display:none;">
            <form class="questions" action="./chat.php?new_session=true" method="POST">
                <div class="question active" id="question1">
                    <h2>Laten we eerst even kennis maken</h2>
                    <div class="input-container">
                        <input type="text" id="name" name="name" placeholder="Wat is je naam?" required>
                        <label for="name" class="text-input-label">Wat is je naam?</label>
                    </div>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question2">
                    <h2>Laten we eerst even kennis maken</h2>
                    <div class="input-container">
                        <input type="number" id="age" name="age" placeholder="Hoe oud ben je?" required>
                        <label for="age" class="text-input-label">Hoe oud ben je?</label>
                    </div>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question3">
                    <h2>Laten we eerst even kennis maken</h2>
                    <div class="input-container">
                        <input type="text" id="location" name="location" placeholder="In welke gemeente woon je?">
                        <label for="location" class="text-input-label">In welke gemeente woon je?</label>
                    </div>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question4">
                    <h2>Woon je daar (momenteel) alleen?</h2>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="alone" value="ja">Ja</label>
                        <label class="checkbox-radio"><input type="radio" name="alone" value="nee">Nee</label>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question3a">
                    <h2>Met wie woon je daar?</h2>
                    <div class="checkbox-container">
                        <label class="checkbox-radio"><input type="checkbox" name="with[]" value="Ouders"> Ouders</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="with[]" value="Kinderen"> Kinderen</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="with[]" value="Partner"> Partner</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="with[]" value="Anders"> Anders</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question3b">
                    <h2>Is dit je eigen woning?</h2>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="ownHouse" value="ja"> Ja</label><br>
                        <label class="checkbox-radio"><input type="radio" name="ownHouse" value="nee"> Nee</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question5">
                    <h2>Heb je momenteel een job?</h2>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="job" value="ja"> Ja</label><br>
                        <label class="checkbox-radio"><input type="radio" name="job" value="nee"> Nee</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question5a">
                    <h2>Krijg je momenteel een uitkering?</h2>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="benefit" value="ja"> Ja</label><br>
                        <label class="checkbox-radio"><input type="radio" name="benefit" value="nee"> Nee</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question6">
                    <h2>Hoeveel verdien je (ongeveer) netto per maand?</h2>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="income" value="Onder €1500"> Onder €1500</label><br>
                        <label class="checkbox-radio"><input type="radio" name="income" value="€1500-€2000"> €1500-€2000</label><br>
                        <label class="checkbox-radio"><input type="radio" name="income" value="€2000-€2500"> €2000-€2500</label><br>
                        <label class="checkbox-radio"><input type="radio" name="income" value="Boven €2500"> Boven €2500</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button><br>
                    <button type="button" class="skip-btn">Vraag overslaan</button>
                </div>
                <div class="question" id="question7">
                    <h2>Dankjewel voor de vragenlijst in te vullen, <span id="name-placeholder"></span>.</h2>
                    <p>Heb je specifieke tegemoetkomingen (onderwerpen) waar je vragen rond hebt?</p><br>
                    <div class="radio-container">
                        <label class="checkbox-radio"><input type="radio" name="specificQuestions" value="ja"> Ja</label><br>
                        <label class="checkbox-radio"><input type="radio" name="specificQuestions" value="nee"> Nee</label><br>
                    </div>
                    <br>
                    <button type="button" class="next-btn">Volgende</button>
                </div>
                <div class="question" id="question7a">
                    <h2>Kan je me wat meer vertellen over jouw vraag?</h2>
                    <textarea name="specificQuestionDetails" placeholder="Geef hier meer informatie" class="checkbox-radio"></textarea>
                    <br>
                    <br>
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
                <div class="question" id="question7b">
                    <h2>In welke thema's ben je geïnteresseerd?</h2>
                    <div class="checkbox-container">
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Voertuigen"> Voertuigen</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Dier & Natuur"> Dier & Natuur</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Wonen & bouwen"> Wonen & bouwen</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Milieu"> Milieu</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Ondernemers"> Ondernemers</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Studenten"> Studenten</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Jobs en loon"> Jobs en loon</label><br>
                        <label class="checkbox-radio"><input type="checkbox" name="interest[]" value="Niets specifiek"> Niets specifiek</label><br>
                    </div>
                    <br>
                    <button type="submit" class="submit-btn">Verzenden</button>
                </div>
            </form>
        </section>
    </main>
    <script src="./scripts/interview.js"></script>
</body>
</html>