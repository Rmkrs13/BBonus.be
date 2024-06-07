document.addEventListener('DOMContentLoaded', function () {
    const startButton = document.querySelector('.test-btn');
    const introSection = document.querySelector('.intro');
    const interviewSection = document.querySelector('.interview');
    const questions = document.querySelectorAll('.question');
    const nextButtons = document.querySelectorAll('.next-btn');
    const skipButtons = document.querySelectorAll('.skip-btn');
    const nameInput = document.getElementById('name');
    const namePlaceholder = document.getElementById('name-placeholder');
    let currentQuestionIndex = 0;

    function showQuestion(index) {
        questions.forEach((question, i) => {
            question.style.display = i === index ? 'block' : 'none';
        });
    }

    function goToNextQuestion() {
        if (currentQuestionIndex === 0 && nameInput.value.trim() !== '') {
            namePlaceholder.textContent = nameInput.value.trim();
        }

        if (currentQuestionIndex === 3) {
            const alone = document.querySelector('input[name="alone"]:checked');
            if (alone && alone.value === 'ja') {
                currentQuestionIndex += 2; // Skip the "Met wie woon je daar?" and "Is dit je eigen woning?" questions
            } else {
                currentQuestionIndex++;
            }
        } else if (currentQuestionIndex === 5) {
            const job = document.querySelector('input[name="job"]:checked');
            if (job && job.value === 'nee') {
                currentQuestionIndex++; // Go to the "Krijg je momenteel een uitkering?" question
            } else {
                currentQuestionIndex += 2; // Skip the "Krijg je momenteel een uitkering?" question
            }
        } else if (currentQuestionIndex === 7) {
            const specificQuestions = document.querySelector('input[name="specificQuestions"]:checked');
            if (specificQuestions && specificQuestions.value === 'ja') {
                currentQuestionIndex++;
            } else {
                currentQuestionIndex += 2;
            }
        } else {
            currentQuestionIndex++;
        }

        if (currentQuestionIndex < questions.length) {
            showQuestion(currentQuestionIndex);
        }
    }

    startButton.addEventListener('click', function () {
        introSection.style.display = 'none';
        interviewSection.style.display = 'block';
        showQuestion(currentQuestionIndex);
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            goToNextQuestion();
        });
    });

    skipButtons.forEach(button => {
        button.addEventListener('click', function () {
            goToNextQuestion();
        });
    });

    // Event listener for specific question
    document.querySelectorAll('input[name="specificQuestions"]').forEach(input => {
        input.addEventListener('change', function () {
            goToNextQuestion();
        });
    });
});