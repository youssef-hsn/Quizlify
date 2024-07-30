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

    console.log(title);
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
        const question = q.children[0].value;
        const answers = q.children[1].children;
        console.log(answers)
        let answersList = [];
        answers.each((i, a) => {
            answersList.push(a.children[0].value);
            answersList.push(a.children[1].value);
        })
        console.log(questions)
        // $.ajax({
        //     url: '/quizlify/api/createQuiz.php',
        //     method: 'POST',
        //     data: {
        //         title: title,
        //         description: description,
        //         question: question,
        //         answers: answersList
        //     }
        // })
    })
})