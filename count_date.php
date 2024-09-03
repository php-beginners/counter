<?php
/** counter:/count_date.php
 *
 * Counter of daily.
 *
 * @created   2024-08-18
 * @author    phpbeginners <phpbeginners@gmail.com>
 * @copyright phpbeginners All right reserved.
 */

//  ...
error_reporting(E_ALL);

//  ...
ini_set('short_open_tag','On' );
ini_set('display_errors','On' );
ini_set('log_errors'    ,'Off');
ini_set('date.timezone' ,'Asia/Tokyo');

//  ...
$dir  = __DIR__.'/count/';
$date = date('Y-m-d');
$file_path = $dir . $date . '.txt';

//  ...
if(!file_exists($dir)){
    exit("<p style='color:red;'>This directory does not exist. ({$dir})</p>");
}

//  ...
if(!is_writable($dir) ){
    exit("<p style='color:red;'>Please add write permission to this directory. ($dir)</p>");
}

//  ...
if(!file_exists($file_path) ){
    if(!touch($file_path) ){
        exit("<p style='color:red;'>Please add write and execute permission to this directory. ($dir)</p>");
    }
}

//  ...
if(!is_writable($file_path) ){
    $me = `whoami`;
    exit("<p style='color:red;'>Please add me write permission to this file. ($me, $file_path)</p>");
}

//  ...
$today = file_get_contents($file_path);

//  ...
$today++;

//  ...
file_put_contents($file_path, $today);

//  ...
$yesterday = date('Y-m-d', strtotime('-1 day'));

//  ...
$file_path = $dir . $yesterday . '.txt';

//  ...
if( file_exists($file_path) ){
    $yesterday = file_get_contents($file_path);
}else{
    $yesterday = 0;
}

//  ...
echo "yesterday: $yesterday<br/>";
echo "today: $today<br/>";
