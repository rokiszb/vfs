<?php

namespace App;

class FolderNode 
{
    private $name;
    private $subFolders;

    function __construct (string $name) 
    {
        $this->name = $name;
        $this->subFolders = [];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubFolders()
    {
        return $this->subFolders;
    }

    public function addSubFolder(FolderNode $subFolder) 
    {
        array_push($this->subFolders, $subFolder);

        return $this;
    }
}