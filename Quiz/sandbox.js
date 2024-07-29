let form;
let res;
let qno;
let score;
let questions = [];

function fetchQuestions() {
    const urlParams = new URLSearchParams(window.location.search);
    const quizId = urlParams.get('id');
    return fetch(`/quizlify/Quiz/fetch_questions.php?id=${quizId}`)
        .then(response => response.json())
        .then(data => {
            questions = data.map(q => ({
                title: q.title,
                options: q.options,
                answer: q.answer.toString(),
                score: q.score
            }));
        });
}

function createQuestionHTML(question, index) {
    const questionHTML = document.createElement('div');
    questionHTML.classList.add('question');

    const questionTitle = document.createElement('h2');
    questionTitle.textContent = `${index + 1} - ${question.title}`;
    questionHTML.appendChild(questionTitle);

    question.options.forEach((option, idx) => {
        const optionContainer = document.createElement('div');
        
        const radio = document.createElement('input');
        radio.type = 'radio';
        radio.id = `q${index}_op${idx}`;
        radio.name = `q${index}`;
        radio.value = idx;
        
        const label = document.createElement('label');
        label.htmlFor = `q${index}_op${idx}`;
        label.textContent = option;
        
        optionContainer.appendChild(radio);
        optionContainer.appendChild(label);
        questionHTML.appendChild(optionContainer);
    });

    return questionHTML;
}

function displayQuestions() {
    const container = document.getElementById('questions-container');
    container.innerHTML = ''; // Clear previous content

    questions.forEach((question, index) => {
        container.appendChild(createQuestionHTML(question, index));
    });
}

function restartScreen() {
    document.querySelector('.quiz-heading').innerHTML = `Score: ${score}`;
    const card = document.querySelector('.question-card');
    card.innerHTML = "<ul>";
    questions.forEach((ques) => {
        const html = `
            <li>${ques.title} <div class="answer-label">${ques.options[ques.answer]}</div></li>
        `;
        card.innerHTML += html;
    });
    card.innerHTML += "</ul>";
    document.querySelector('.answer-key').style.display = 'block';
    document.querySelector('button').style.display = 'block';
}

function evaluate() {
    score = 0;
    questions.forEach((question, index) => {
        const selectedOption = document.querySelector(`input[name="q${index}"]:checked`);
        if (selectedOption && selectedOption.value === question.answer) {
            score += question.score;
        }
    });
    res.setAttribute('class', 'correct');
    res.innerHTML = 'Quiz submitted successfully';
    restartScreen();
}

function handleSubmit(e) {
    e.preventDefault();

    // Calculate score
    score = 0;
    const results = questions.map((question, index) => {
        const selectedOption = document.querySelector(`input[name="q${index}"]:checked`);
        const isCorrect = selectedOption && selectedOption.value === question.answer;
        if (isCorrect) {
            score += question.score;
        }
        return {
            question: question.title,
            options: question.options,
            selected: selectedOption ? selectedOption.value : null,
            correct: question.answer
        };
    });

    // Redirect to the result page with score and results
    const resultData = { score, results };
    const queryString = `?data=${encodeURIComponent(JSON.stringify(resultData))}`;
    window.location.href = `/quizlify/results/index.php${queryString}`;
}


function init() {
    fetchQuestions().then(() => {
        form = document.getElementById('quiz-form');
        res = document.getElementById('res');
        qno = -1;
        score = 0;
        displayQuestions();
        form.addEventListener('submit', handleSubmit);
        document.querySelector('button').addEventListener('click', init);
    }).catch(error => {
        console.error('Error fetching questions:', error);
    });
}

document.querySelector('button').addEventListener('click', init);
init();
