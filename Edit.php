<?php
include 'database.php';
?>

<?php


if(isset($_GET["qno"])){
    $qno = (int) $_GET["qno"];
    //Get Questions
    $query = "Select * from questions where question_no= $qno";
    $result = $mysqli->query($query) or die($mysqli->connect_error._LINE_);
    $question = $result->fetch_assoc();

    $question_number = $question['question_no'];
    $question_text = $question['text'];

    //Get Choices
    $query = "Select * from choices where question_no= $qno";
    $results = $mysqli->query($query) or die($mysqli->connect_error._LINE_);



    $count = 1;
    $text = array();



    $correct_number = 0;
    while($row = $results->fetch_assoc()){
        $text[$count] = $row['text'];

        if( ((int)$row['is_correct']) == 1){
            $correct_number = $count;
        }
        $count++;
    }


}




if(isset($_POST["submit"])){

    //Retrieve variable
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_number = $_POST['correct_number'];
    $choices =  array();
    $choices[1] = $_POST['choice1'];
    $choices[2] = $_POST['choice2'];
    $choices[3] = $_POST['choice3'];
    $choices[4] = $_POST['choice4'];
    $choices[5] = $_POST['choice5'];


    //Delete the old data
    $query = "Delete  from questions where question_no = $question_number";
    $delete_no = $mysqli->query($query) or die($mysqli->error._LINE_);
    $query = "Delete  from choices where question_no = $question_number";
    $delete_no = $mysqli->query($query) or die($mysqli->error._LINE_);

    //insert into questions
    $query = "Insert into questions(question_no,text) values('$question_number','$question_text')";
    $insert_no = $mysqli->query($query) or die($mysqli->error._LINE_);

    if($insert_no){

        //insert into choices
        foreach($choices as $choice=>$value){


            if($value!=""){
                if($correct_number == $choice){
                    $is_correct = 1;
                }else {
                    $is_correct = 0;
                }
                $query = "Insert into choices(question_no,text,is_correct) values ('$question_number','$value','$is_correct')";
                $insert_no = $mysqli->query($query) or die($mysqli->error._LINE_);
                if($insert_no){
                    continue;
                }else{
                    die('Error No: ('.$mysqli->errno.')'. $mysqli->error);
                }
            }



        }

        header("Location: admin.php");
        exit();

    }

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
                Add New Question
            </h2>
        </div>

        <form method="post" action="Edit.php">


            <div class="row">
                <div class="row padding" >
                    <div class="col-md-3"> <label  class=""> Question Number </label></div>
                    <div class="col-md-9"> <input readonly name="question_number" type="number" class="textbox-number" value="<?php echo $qno; ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Question </label></div>
                    <div class="col-md-9"> <input  name="question_text" type="text" class="form-control" value="<?php echo $question_text; ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Choice #1 </label></div>
                    <div class="col-md-9"> <input  name="choice1" type="text" class="form-control" value="<?php if(isset($text[1])){echo $text[1];} ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Choice #2 </label></div>
                    <div class="col-md-9"> <input  name="choice2" type="text" class="form-control" value="<?php if(isset($text[2])){echo $text[2];} ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Choice #3 </label></div>
                    <div class="col-md-9"> <input  name="choice3" type="text" class="form-control" value="<?php if(isset($text[3])){echo $text[3];} ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Choice #4 </label></div>
                    <div class="col-md-9"> <input  name="choice4" type="text" class="form-control" value="<?php if(isset($text[4])){echo $text[4];} ?>"></div>
                </div>
                <div class="row padding">
                    <div class="col-md-3"> <label  class=""> Choice #5 </label></div>
                    <div class="col-md-9"> <input  name="choice5" type="text" class="form-control" value="<?php if(isset($text[5])){echo $text[5];} ?>"></div>
                </div>
                <div class="row padding" >
                    <div class="col-md-3"> <label  class=""> Correct Choice #No) </label></div>
                    <div class="col-md-9"> <input  name="correct_number" type="number" class="textbox-number" value="<?php echo $correct_number; ?>"></div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4 center">
                    <input type="submit" class="submit-button" value="Update" name="submit" style="margin-bottom: 20px;">
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
