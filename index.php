<?php

require_once "autoload.php";

$questions = QuestionsList::parse("questions.md");
$questions->saveJson("questions.json");
foreach ($questions->all() as $q) {
    echo $q->number . ". " . $q->title . "<br>";
    echo edit::editcontent($q->content) . "<br/>";
    foreach($q->options as $key => $value){
        echo $key . '. ' . $value . '<br>';
    }
    echo "<br/>" . edit::editanswer($q->answer) . "<br><br>";
}
