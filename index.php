<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

$command = $argv[1];
$arguments = @$argv[2];
$fileDestination = @$argv[3];

if (empty($command)) {
    die("Command or arguments not found\n");;
}

include 'bootstrap.php';

echo "To start interacting with VFS type mkdir /my/dir/\n";

switch ($command) {
    case 'mkdir':
        $fileSystem->createDirectory($arguments);
        break;
    case 'traverse':
        $fileSystem->traverse('/', $fileSystem->getHead()->getSubFolders());
        break;
    case 'cp':
        $fileSystem->addFile($arguments, $fileDestination);
        break;
    default:
        die("Command not found\n");;
}


// var_dump(trim($input));
// var_dump($fileSystem);
//create or delete virtual folder

//view virtual folder tree

// add or remove file from local file system to the virtual folder (only one file with same name can be in virtual folder)

// list files ir virtual folder