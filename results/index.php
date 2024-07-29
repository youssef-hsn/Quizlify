<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <link rel="stylesheet" type="text/css" href="../Quiz/styles.css" />
    <style>
        .correct {
            color: green;
        }
        .incorrect {
            color: red;
        }
        .selected {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 class='quiz-heading'>Quiz Results</h1>
    <div class="app-body">
        <?php
            // Get the result data from the query string
            $data = isset($_GET['data']) ? json_decode($_GET['data'], true) : null;

            if ($data) {
                echo "<h2>Your Score: " . htmlspecialchars($data['score']) . "</h2>";
                echo "<ul>";

                foreach ($data['results'] as $index => $result) {
                    echo "<li>";
                    echo "<h3>" . htmlspecialchars($result['question']) . "</h3>";
                    echo "<ul>";

                    foreach ($result['options'] as $optIndex => $option) {
                        $class = '';
                        if ($optIndex == $result['correct']) {
                            $class = 'correct'; // Correct option
                        } elseif ($optIndex == $result['selected']) {
                            $class = 'selected incorrect'; // User's answer
                        }
                        echo "<li class='$class'>" . htmlspecialchars($option) . "</li>";
                    }

                    echo "</ul>";
                    echo "</li>";
                }

                echo "</ul>";
            } else {
                echo "<p>No results to display.</p>";
            }
        ?>
        <button onclick="window.location.href='/quizlify/quizfinder/'">Back to Quizzes</button>
    </div>
</body>
</html>
