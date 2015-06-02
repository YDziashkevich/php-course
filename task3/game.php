#!/usr/bin/php5
<?php

include('settings.php');
require_once 'autoloader.php';

echo `clear`;

ncurses_init();
ncurses_clear();

$game = new Game();

ncurses_end();