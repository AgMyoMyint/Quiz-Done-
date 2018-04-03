<?php
include 'database.php';
?>

<?php

if(!isset($_GET['n'])){
    $current_number = 1;
}else{
    $current_number = $_GET['n'];
}


//Total Questions
$query = "Select * from questions";
$result = $mysqli->query($query) or die($mysqli->connect_error._LINE_);
$total = $result->num_rows;

//All CHoices
$query = "Select * from choices where question_no = $current_number";
$choices = $mysqli->query($query) or die($mysqli->connect_error._LINE_);


//Current Question
$query = "Select * from questions where question_no = $current_number";
$results = $mysqli->query($query) or die($mysqli->connect_error._LINE_);
$question = $results->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Quiz </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>

    </style>
</head>

<body>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><h2 class="title"> QUIZZ </h2> </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="Active">
                    <a href="index.php"> Home </a>
                </li>
                <li>
                    <a href="question.php"> Start </a>
                </li>
                <li>
                    <a href="admin.php"> Admin </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main>
    <div class="container" class="">
        <form method="post" action="process.php">


            <div class="row">
                <h2 class="index-title">
                    Question <?php echo $current_number; ?> of <?php echo $total; ?>
                </h2>
            </div>

            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4 center">
                    <p class="question"> <?php echo $question['text']; ?> </p>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4 ">
                    <ul class="choices">
                        <?php while($row = $choices->fetch_assoc() ): ?>
                            <li>
                                <input type="radio" name="choice" value=" <?php echo $row['id']; ?>">
                                <?php echo $row['text']; ?>
                            </li>
                        <?php endwhile; ?>

                    </ul>

                </div>
                <div class="col-md-4"></div>

            </div>

            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4 center" style="">
                    <input type="hidden" name="question_number" value=" <?php echo $current_number; ?>">
                    <input type="submit" name="submit" value="Next" class="submit-button"/>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
</main>

<footer>
    <div class="container">

    </div>
</footer>
</body>
</html>
