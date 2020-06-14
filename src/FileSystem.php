<?php

namespace App;

class FileSystem
{
    private $head;
    private $fileName;
    private $filePath;
    const PATH_TO_FILESYSTEM = 'fs';

    function __construct() 
    {
        $this->boot();
    }

    public function getHead()
    {
        return $this->head;
    }

    private function boot() 
    {
        if (file_exists(self::PATH_TO_FILESYSTEM)) {
            $fileSystem = file_get_contents(self::PATH_TO_FILESYSTEM);
            $fileSystem = unserialize(base64_decode($fileSystem));
            
            if ($fileSystem instanceof FolderNode) {
                $this->head = $fileSystem;

                return $this;
            } 
        }

        $this->head = new FolderNode('root');
        $this->save();
    }

    private function save()
    {
        file_put_contents(self::PATH_TO_FILESYSTEM, base64_encode(serialize($this->head)));
    }

    public function createDirectory($directory) 
    {
        if (empty($directory)) {
            die("Arguments not found\n");;
        }

        $directory = trim($directory,"/");
        $directoriesArray = explode('/', $directory);

        $currentFilesystemDir = $this->head;

        foreach ($directoriesArray as $directory) {
            $tempDir = $currentFilesystemDir->findSubdir($directory);

            if($tempDir) {
                $currentFilesystemDir = $tempDir;
            } else {
                $newDirectory =  new FolderNode($directory);
                $currentFilesystemDir->addSubFolder($newDirectory);
                $currentFilesystemDir = $newDirectory;
            }
        }

        return $currentFilesystemDir;
    }
    
    public function addFile($filePath, $fileDestination) 
    {
        if(!file_exists($filePath)) die("File does not exist in provided dir\n");
        if(!$this->validateFilePath($fileDestination)) die("File destination is not valid format\n"); 

        $file = new FileNode($this->fileName, file_get_contents($filePath));
        $tempDir = $this->createDirectory($this->filePath);
        $tempDir->addFile($file);
    }

    public function validateFilePath($path)
    {
        $path = explode('/', $path);
        $fileName = array_pop($path);
        $path = implode('/', $path);
        
        if (preg_match('/^\/$|(\/[a-zA-Z_0-9-]+)+$/', $path)) {
            $this->fileName = $fileName;
            $this->filePath = $path;

            return true;
        } else {
            return false;
        }
    }
    
    public function traverse($path = '/', $subFolders = []) 
    {

        if(empty($subFolders)) {
            echo $path . "\n";
        } else {
            foreach ($subFolders as $subFolder) {
                $tempPath = $path . $subFolder->getName() . '/';
                
                if(!empty($subFolder->getFiles())) {
                    foreach($subFolder->getFiles() as $file) {
                        echo $tempPath .  $file->getName() . "\n";
                    }
                }
                
                $this->traverse($tempPath, $subFolder->getSubFolders());
            }
        }
    }

    function __destruct() {
        $this->save();
    }
} 