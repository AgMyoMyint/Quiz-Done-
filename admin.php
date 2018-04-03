<?php
    include 'database.php';

    $query = "Select * from questions";
    $result = $mysqli->query($query) or die($mysqli->error._LINE_);

    if(isset($_GET['qno'])){
        $qno = $_GET['qno'];
        //Delete the old data
        $query = "Delete  from questions where question_no = $qno";
        $delete_no = $mysqli->query($query) or die($mysqli->error._LINE_);
        $query = "Delete  from choices where question_no = $qno";
        $delete_no = $mysqli->query($query) or die($mysqli->error._LINE_);

        header("Location: admin.php");
        exit();
    }

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
    <div class="container">
        <div class="row">
            <h2 class="index-title">
                Admin Page
            </h2>
        </div>
        <div class="row">

        </div>
        <div class="row ">
            <div class="col-md-3">
                <a class="function-button text-center" href="add.php"> + Add </a>
            </div>

            <div class="col-md-3">

            </div>
            <div class="col-md-3">

            </div>
            <div class="col-md-3">

            </div>

        </div>
        <div class="row " style="margin-top:20px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td> No </td>
                        <td> Question </td>
                        <td> </td>

                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td> <?php echo $row['question_no']; ?> </td>
                            <td> <?php echo $row['text']; ?>  </td>
                            <td>
                                <a class="function-button text-center" href="Edit.php?qno=<?php echo $row['question_no']; ?>"> Edit </a>
                                <a class="delete-button text-center" href="admin.php?qno=<?php echo $row['question_no']; ?>" style="margin-left : 10px;"> Delete </a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer>
    <div class="container">

    </div>
</footer>
</body>
</html>
