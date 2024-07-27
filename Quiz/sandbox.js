let question;
let form;
let res;
let qno;
let score;
let questions = [];

function fetchQuestions() {
    return fetch('/000-QuizlifyRepooo/Quizlify/Quiz/fetch_questions.php')
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


function resetradio() {
    document.querySelectorAll('[type="radio"]').forEach((radio) => {
        radio.removeAttribute("disabled");
    });
    res.setAttribute("class","idle");
    res.innerHTML = "Empty";
}

function evaluate() {
    if (form.op.value == questions[qno].answer) {
        res.setAttribute('class', 'correct');
        res.innerHTML = 'Correct';
        score += questions[qno].score;
    } else {
        res.setAttribute('class', 'incorrect');
        res.innerHTML = 'Incorrect';
    }
    document.querySelectorAll('[type="radio"]').forEach((radio) => {
        radio.setAttribute('disabled', 'disabled');
    });
}


function getNextQuestion() {
    qno++;
    ques = questions[qno];
    question.innerHTML = ques.title;
    const labels = document.querySelectorAll('label');
    labels.forEach((label, idx) => {
        label.innerHTML = ques.options[idx];
    }); 
}

function handleSubmit(e) {
    e.preventDefault();
    if (!form.op.value) {
        alert('Please select an option');
    } else if (form.submit.classList.contains('submit')) {
        evaluate();
        form.submit.classList.remove('submit');
        form.submit.value = 'Next';
        form.submit.classList.add('next');
    } else if (qno < questions.length - 1 && form.submit.classList.contains('next')) {
        getNextQuestion();
        form.submit.classList.remove('next');
        form.submit.value = 'Submit';
        form.submit.classList.add('submit');
        form.reset();
    } else if (form.submit.classList.contains('next')) {
        restartScreen();
        form.submit.classList.remove('next');
        form.submit.value = 'Submit';
        form.submit.classList.add('submit');
        form.reset();
    }
}

function getNextQuestion() {
    qno++;
    ques = questions[qno];
    question.innerHTML = ques.title;
    const labels = document.querySelectorAll('label');
    labels.forEach((label, idx) => {
        label.innerHTML = ques.options[idx];
    });
    document.querySelectorAll('[type="radio"]').forEach((radio) => {
        radio.removeAttribute('disabled');
    });
    res.setAttribute('class', 'idle');
    res.innerHTML = 'Empty';
}

function restartScreen() {
    document.querySelector('.quiz-heading').innerHTML = `Score: ${score}`;
    const card = document.querySelector('.question-card');
    card.innerHTML = "<ul>";
    questions.forEach((ques, idx) => {
        const html = `
            <li>${ques.title} <div class="answer-label">${ques.options[ques.answer]}</div></li>
        `;
        card.innerHTML += html;
    });
    card.innerHTML += "</ul>";
    document.querySelector('.answer-key').style.display = 'block';
    document.querySelector('button').style.display = 'block';
}

function init() {
    fetchQuestions().then(() => {
        question = document.querySelector('#question');
        form = document.querySelector('form');
        res = document.querySelector('#res');
        qno = -1;
        score = 0;
        getNextQuestion();
        form.addEventListener('submit', handleSubmit);
        document.querySelector('button').addEventListener('click', init);
    }).catch(error => {
        console.error('Error fetching questions:', error);
    });
}

document.querySelector('button').addEventListener('click', init);
init();

