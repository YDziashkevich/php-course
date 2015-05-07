#!/usr/bin/php5
<?php
echo `clear`;
date_default_timezone_set('UTC');
require_once 'autoloader.php';
$caledar = new Calendar();
echo $caledar->getCalendar();