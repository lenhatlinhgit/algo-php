<?php

class Question
{
    public $number;
    public $title;
    public $content;
    public $options;
    public $answer;

    public function __construct($number,$title,$content,$options,$answer)
    {
        $this->number = $number;
        $this->title = $title;
        $this->content = $content;
        $this->options = $options;
        $this->answer = $answer;
    }

    public function toArray()
    {
        return [
            'number'=>$this->number,
            'title'=>$this->title,
            'content'=>$this->content,
            'options'=>$this->options,
            'answer'=>$this->answer
        ];
    }
}