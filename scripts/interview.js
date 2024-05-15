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

    startButton.addEventListener('click', function () {
        introSection.style.display = 'none';
        interviewSection.style.display = 'block';
        showQuestion(currentQuestionIndex);
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            if (currentQuestionIndex === 0 && nameInput.value.trim() !== '') {
                namePlaceholder.textContent = nameInput.value.trim();
            }
            if (currentQuestionIndex === 3 && document.querySelector('input[name="alone"]:checked').value === 'ja') {
                currentQuestionIndex += 2; // Skip the "Met wie woon je daar?" question
            } else {
                currentQuestionIndex++;
            }
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            }
        });
    });

    skipButtons.forEach(button => {
        button.addEventListener('click', function () {
            if (currentQuestionIndex === 3 && document.querySelector('input[name="alone"]:checked').value === 'ja') {
                currentQuestionIndex += 2; // Skip the "Met wie woon je daar?" question
            } else {
                currentQuestionIndex++;
            }
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            }
        });
    });

    // Event listener for specific question
    document.querySelectorAll('input[name="specificQuestions"]').forEach(input => {
        input.addEventListener('change', function () {
            if (input.value === 'ja') {
                currentQuestionIndex++;
            } else {
                currentQuestionIndex += 2;
            }
            showQuestion(currentQuestionIndex);
        });
    });
});