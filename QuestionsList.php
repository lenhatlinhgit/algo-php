<?php

require_once "Collection.php";

require_once "Question.php";

class QuestionsList extends Collection
{

    public static function parse($path)
{
    $text = file_get_contents($path);

    preg_match_all(
        '/######\s*(?:<a[^>]*><\/a>)?\s*(\d+)\.\s*(.*?)\n([\s\S]*?)\n((?:-\s*[A-F]:\s*.*\n?){2,6})[\s\S]*?<details>[\s\S]*?Đáp án[\s\S]*?<p>([\s\S]*?)<\/p>/',
        $text,
        $matches,
        PREG_SET_ORDER
    );

    $questions = [];

    foreach ($matches as $m) {

        // số câu
        $number = trim($m[1]);

        // tiêu đề
        $title = trim($m[2]);

        // nội dung
        $content = trim($m[3]);

        // options
        $options = [];

        preg_match_all('/-\s*([A-F]):\s*(.*)/', $m[4], $opts);

        foreach ($opts[1] as $i => $key) {
            $options[$key] = trim($opts[2][$i]);
        }

        // đáp án
        $answer = trim($m[5]);

        $questions[] = new Question(
            $number,
            $title,
            $content,
            $options,
            $answer
        );
    }

    return new static($questions);
}

    public function saveJson(string $path)
    {
        // chuyển từng Question object thành array
        $data = array_map(
            fn($q) => $q->toArray(),
            $this->items
        );

        // ghi dữ liệu json ra file
        file_put_contents(
            $path,
            json_encode(
                $data,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
    }

}