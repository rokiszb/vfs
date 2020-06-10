<?php

namespace App;

class FileNode 
{
    private $content;
    private $name;

    function __construct (string $name, string $content = '') 
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function getContent() 
    {
        return $this->content;
    }

    public function getName() 
    {
        return $this->name;
    }
}