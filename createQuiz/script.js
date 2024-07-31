const template = document.querySelector("#template").cloneNode(true);

$("#add-question").on("click", (c) => {
    const newQuestion = template.cloneNode(true);
    newQuestion.removeAttribute("id");
    $("#questions").append(
        newQuestion
    );
})

function deleteQuestion(test) {
    test.parentNode.remove();
}

$("#create-quiz").on("click", (c) => {
    const title = $("#title").val();

    if (title === "") {
        $("#isValidTitle").attr('src', '/quizlify/images/exclamationMark.png');
        $("#isValidTitle").attr('alt', 'Title cannot be empty');
        $("#title").focus();
        return;
    } else {
        $("#isValidTitle").attr('src', '/quizlify/images/tickMark.png');
        $("#isValidTitle").attr('alt', '');
    }
    const description = $("#description").val();
    const input = $("#questions").children();
    let questions = [];
    input.each((i, q) => {
        const question = q.children[1].value;
        const answers = q.children[3].children;
        console.log(answers)
        let answersList = [];
        for (let a of answers) {
            answersList.push({
                text: a.children[0].value,
                points: a.children[1].value
            });
        }
        questions.push({
            question: question,
            answers: answersList
        })
    })
    $.ajax({
        url: '/quizlify/api/createQuiz.php',
        method: 'POST',
        data: {
            creator_id: $("#id").val(),
            title: title,
            description: description,
            questions: questions
        }
    })
})