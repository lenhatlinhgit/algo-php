<?php
class edit {
    public static function editanswer($answer)
{

    $answer = str_replace('#', '', $answer);

    $answer = str_replace("\n", "<br>", $answer);

    $answer = str_replace("<img", "<br/><img", $answer);

    $answer = preg_replace('/(<img[^>]*>)/', '$1<br/>', $answer);

    return $answer;
}
public static function editcontent($content)
{

    $content = str_replace(['```javascript', '```'], '', $content);

    $content = str_replace('`', '', $content);

    $content = str_replace("\n", '<br/>', $content);

    preg_match_all('/([A-D]:[^A-D]*)/', $content, $m);

    $question = trim(preg_replace('/- A:.*$/', '', $content));

    $result = $question . "<br/>";

    foreach ($m[1] as $opt) {
        $result .= trim($opt) . "<br/>";
    }

    return $result;
}
}