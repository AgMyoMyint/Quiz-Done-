<?php

include 'database.php';

session_start();

if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if(isset($_POST['submit'])){

    //Retrieve from previous page
    $question_number = $_POST['question_number'];
    $choice = $_POST['choice'];

    //prepare for next page
    $next = $question_number+1;


    //Total Questions
    $query = "Select * from questions";
    $result = $mysqli->query($query) or die($mysqli->connect_error._LINE_);
    $total = $result->num_rows;


    //Current QUestion's right CHoices
    $query = "Select * from choices where question_no = $question_number AND is_correct = 1";
    $results = $mysqli->query($query) or die($mysqli->connect_error._LINE_);
    $answer = $results->fetch_assoc();

    //Check Answer is true or false
    if($choice == $answer["id"]){
       $_SESSION['score']++;
    }

    //Check This is last question?
    if($total == $question_number){
        header("Location: final.php");
        exit();
    }else{
        header("Location: question.php?n=".$next);
        exit();
    }


}