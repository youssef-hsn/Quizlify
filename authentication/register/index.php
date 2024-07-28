<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php 
        $redirectTo = $_GET['destination']??"/quizlify/home/"; // this is for when someone tries to take a quiz but isn't logged in
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="script.js" defer></script>
    <title>Register Now!</title>
</head>
<body>
    <div class="login">
        <h1>Test Yourself!</h1>
        <p><?php echo $_GET['message'] ?? ''; ?></p>
        <form action="/quizlify/api/createAccount.php" method="post">
            <input type="text" hidden name="destination" value="<?php echo $_GET['destination'] ?? ''; ?>">
            
            <label for="username">Username <img src="" id="isValidUsername" alt=""></label>
            <input type="text" name="username" id="username" placeholder="What would you like us to call you?" required>
            
            <label for="password">Password <img src="" id="isValidPassword" alt=""></label>
            <input type="password" name="password" placeholder="Password" id="password" required />
            
            <label for="confirmPassword">Confirm Password <img src="" id="isValidConfirm" alt=""></label>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" id="confirmPassword" required></label>
            
            <button type="submit" id="submit">Prove your knowledge!</button>
            <p class="message">Already registered? <a href="/quizlify/authentication/login/">Login to your account</a></p>
        </form>
    </div>
</body>
</html>