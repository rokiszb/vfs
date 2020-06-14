<?php

namespace App;

class FolderNode 
{
    private $name;
    private $subFolders;
    private $files;

    function __construct (string $name) 
    {
        $this->name = $name;
        $this->subFolders = [];
        $this->files = [];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubFolders()
    {
        return $this->subFolders;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function addSubFolder(FolderNode $subFolder) 
    {
        array_push($this->subFolders, $subFolder);

        return $this;
    }

    public function addFile(FileNode $file) 
    {
        $this->files[$file->getName()] = $file;

        return $this;
    }

    public function findSubdir($dirName) 
    {
        if(empty($this->getSubFolders())) return false;

        foreach($this->getSubFolders() as $subFolder) {
            if($subFolder->getName() == $dirName) return $subFolder;
        }

        return false;
    }
}