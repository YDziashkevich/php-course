#!/usr/bin/php5

<?php
$name = (!empty($argv[1])) ? $argv[1] : 'Anonymous';
echo "\x1b[31m $name \x1b[0m, купи слона \n";
$text = trim(fgets(STDIN));
while($text != 'Exit' && $text != 'exit' && $text != 'EXIT'){
    echo "\x1b[30;41m $name \x1b[0m, каждый может сказать \x1b[30;47m $text \x1b[0m, а ты возьми и купи слона \n";
    $text = trim(fgets(STDIN));
}
