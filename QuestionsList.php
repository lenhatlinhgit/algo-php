<?php

require_once "Collection.php";

require_once "Question.php";

class QuestionsList extends Collection
{

    public static function parse($path)
    {

        $text = file_get_contents($path);

        preg_match_all(

            '/######\s*(\d+)\.\s*(.*?)\n([\s\S]*?)<details>[\s\S]*?Đáp án[\s\S]*?<p>([\s\S]*?)<\/p>/',

            $text,

            $matches,

            // mỗi match sẽ là 1 phần tử riêng
            PREG_SET_ORDER
        );

        $questions = [];

        foreach ($matches as $m) {

            // nhóm 1: số câu hỏi
            $number  = trim($m[1]);

            // nhóm 2: tiêu đề
            $title   = trim($m[2]);

            // nhóm 3: nội dung câu hỏi
            $content = trim($m[3]);

            // nhóm 4: phần giải thích đáp án
            $answer  = trim($m[4]);

            // tạo object Question mới rồi thêm vào mảng
            $questions[] = new Question($number, $title, $content, $answer);
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