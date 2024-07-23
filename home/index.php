<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Top Quizes</title>
</head>
<body>
    <h1>Top Quizes Around the world</h1>
    <section id="quizes">
        <?php
            include '../config.php';
            $sql = "SELECT * FROM quizes";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                echo '<div class="quiz">';
                    echo "<h3>".$row['title']."</h3>";
                    echo "<p>".$row['description']."</p>";
                    echo "<a href='#'>Start Quiz</a>";
                echo '</div>';
            }
        ?>
    </section>
        
</body>
</html>