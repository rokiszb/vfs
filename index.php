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