let offset = 0;
let anyMore = true;
const quizContainer = $('#quizes');
const loader = $('#loader');
const loadButton = $('#load-button');
const loadingIcon = $('.loading-icon').first();

console.log("Hello World");
function loadQuizzes() {
    console.log("Load Quizzes");
    loadButton.hide();
    loadingIcon.show();
    $.ajax({
        url: '/quizlify/api/fetch_quizes.php',
        method: 'GET',
        data: { offset: offset },
        success: function(response) {
            let quizzes = JSON.parse(response);
            console.log(quizzes.length);
            if (quizzes.length < 10) {
                anyMore = false;
            }
            
            offset += quizzes.length;

            $.each(quizzes, function(index, quiz) {
                quizContainer.children().last().before(
                    `<div class="quiz">
                        <h2>${quiz.title}</h2>
                        <p>${quiz.description}</p>
                        <a href="/quizlify/quiz/index.php?id=${quiz.id}">Try it out</a>
                    </div>`
                );
            });
        },
        error: function(xhr) {
            alert('Error: ' + xhr.statusText);
        }
    }) .then(function() {
        if (anyMore) {
            loadButton.show();
        } else {
            loader.html('No more quizes');
        }

        loadingIcon.hide();
    });
}

loadQuizzes();

loadButton.on('click', loadQuizzes); 

