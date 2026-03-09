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
    // bỏ markdown code block
    $content = str_replace(['```javascript', '```'], '', $content);

    // bỏ inline code
    $content = str_replace('`', '', $content);

    // xuống dòng html
    $content = str_replace("\n", '<br/>', $content);

    return trim($content);
}
}