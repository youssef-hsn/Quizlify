$("#username").on("change", (c) => {
    let newValue = c.target.value;
    $.ajax({
        url: '/quizlify/api/validateValue.php',
        method: 'POST',
        data: { value: newValue, table: 'users', column: 'username' },
        success: (response) => {
            switch (response.isValid) {
                case true:
                    $("#isValidUsername").attr('src', '/quizlify/images/tickMark.png');
                    $("#isValidUsername").attr('alt', 'This is a valid username');
                    break;
                case false:
                    $("#isValidUsername").attr('src', '/quizlify/images/xMark.png');
                    $("#isValidUsername").attr('alt', 'This username is already in use');
                    break;
            }
        }        
    })}
)

$("#password").on("change", (c) => {
    let newValue = c.target.value;
    const minLength = 6;
    const hasNumber = /\d/.test(newValue);
    const hasUpper = /[A-Z]/.test(newValue);
    const hasLower = /[a-z]/.test(newValue);
    const isValid = newValue.length >= minLength && hasNumber && hasUpper && hasLower;
    $("#isValidPassword").attr('src', isValid ? '/quizlify/images/tickMark.png' : '/quizlify/images/xMark.png');
    $("#isValidPassword").attr('alt', isValid ? 'This is a valid password' : 'The password must contain at least 6 characters, including one uppercase letter, one lowercase letter, and one number.');
})

$("#confirmPassword").on("change", (c) => {
    let newValue = c.target.value;
    $("#isValidConfirm").attr('src', newValue === $("#password").val() ? '/quizlify/images/tickMark.png' : '/quizlify/images/xMark.png');
    $("#isValidConfirm").attr('alt', newValue === $("#password").val() ? 'Passwords match' : 'Passwords do not match');
})