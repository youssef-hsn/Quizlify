<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php 
        $redirectTo = $_GET['destination']??"/quizlify/home/"; // this is for when someone tries to take a quiz but isn't logged in
    ?>
    <title>Login to your account</title>
</head>
<body>
    <div class="login">
        <h1>Test Yourself!</h1>
        <form action="/quizlify/api/generateToken.php" method="post">
            <input type="text" hidden name="destination" value="<?php echo $_GET['destination']; ?>">
            <input type="text" name="username" placeholder="Username" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" id="submit">Login</button>
            <p class="message">Not registered? <a href="/quizlify/authentication/register/">Create an account</a></p>
        </form>
    </div>
</body>
</html>