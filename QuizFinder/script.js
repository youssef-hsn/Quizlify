$("#quiz-id").on("input", (c) => {
    let newValue = c.target.value;
    $("#feedback img").show();
    $.ajax({
        url: '/quizlify/api/getQuizData.php',
        method: 'GET',
        data: { id: newValue },
        success: function(response) {
            const quiz = response.quiz;
            $("#feedback img").attr("src", `https://api.dicebear.com/9.x/icons/svg?seed=${quiz.title}`);
            $("#quiz-title").text(quiz.title);
            $("#quiz-description").text(quiz.description);
        },
        error: function(xhr) {
            $("#feedback img").attr("src", `https://api.dicebear.com/9.x/glass/svg?backgroundColor=FE305B`);
            $("#quiz-title").text("Some Error Occured");
            $("#quiz-description").text(xhr.statusText);
        }
    })
})