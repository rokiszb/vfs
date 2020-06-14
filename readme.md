# PHP virtual filesystem, author: Rokas Lakstauskas

Virtual system is implemented using some basic OOP and Tree data structure ideas.
All filesystem is made up from FolderNodes and FileNodes. Each FolderNode is basically a folder, that holds files and other
subdirectories in arrays. 
If filesystem is deleted or missing it will automatically create root FolderNode and boot.
At the end of object lifecycle filesystem is automatically saved (serialized and base64 encoded).

Recursive traverse function goes deeper into every subdirectory and constructs /file/path/ to output to console.

Current version lacks all functionality as right now 3 commands work

1. mkdir /dir/name/
creates directory in vfs

2. traverse
echoe's out all directories and files under those directories to console

3. cp c:\path\to\file.txt /destination/to/file.txt
reads file from pc filesystem and copies content to vfs

What is missing as of today (2020-06-15):
Unit tests, backup, file deletion.

What should be improved:
Folders should be saved to assoc array (array map) for better lookup. (That is in case if filesystem becomes very large). Minor fix.
CLI functionality could be moved to CLI class.
Better filtering/sanitizing.