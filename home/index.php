<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <title>Top Quizes Worldwide</title>
</head>
<body>
  <nav>
    <h1>Top Quizes Worldwide</h1>
    <?php
      include "../config.php";
      if (isset($_SESSION["user"])) {
        echo '
        <ul>
          <li><a href="/quizlify/createQuiz/">Create Quiz</a></li>
          <li><a href="/quizlify/quizFinder/">Find Quiz</a></li>
          <li><a href="/quizlify/api/logout.php">Logout</a></li>
        </ul>
        ';
      } else {
        echo '
        <ul>
          <li><a href="/quizlify/authentication/login/">Login</a></li>
        </ul>
        ';
      }
    ?>
  </nav>
  <section id="quizes">
    <div class="loader" id="loader">
      <button id="load-button" hidden>Load More</button>
      <div class="loading-icon spinner"></div>
    </div>
  </section>
  
</body>
</html>