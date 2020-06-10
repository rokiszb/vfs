<?php

use App\FileNode;

include 'bootstrap.php';

$file = new FileNode('text.txt', 'bla');
var_dump($file);

echo "Are you sure you want to do this?  Type 'yes' to continue: ";

$handle = fopen ("php://stdin","r");
$input = fgets($handle);

// if( != 'yes'){
//     echo "ABORTING!\n";
//     exit;
// }

var_dump(trim($input));


//create or delete virtual folder

//view virtual folder tree

// add or remove file from local file system to the virtual folder (only one file with same name can be in virtual folder)

// list files ir virtual folder