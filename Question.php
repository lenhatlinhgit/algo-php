<?php

class Question
{
    public $number;
    public $title;
    public $content;
    public $answer;

    public function __construct($number,$title,$content,$answer)
    {
        $this->number = $number;
        $this->title = $title;
        $this->content = $content;
        $this->answer = $answer;
    }

    public function toArray()
    {
        return [
            'number'=>$this->number,
            'title'=>$this->title,
            'content'=>$this->content,
            'answer'=>$this->answer
        ];
    }
}