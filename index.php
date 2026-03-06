<?php

require_once "autoload.php";

$questions = QuestionsList::parse("questions.md");
$questions->saveJson("questions.json");
foreach ($questions->all() as $q) {
    echo $q->number . ". " . $q->title . "<br>";
    echo edit::editcontent($q->content) . "<br/>";
    echo edit::editanswer($q->answer) . "<br><br>";
}
