<?php
/** counter:/count_easy.php
 *
 * @created   2022-04-23
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
$file_name = 'count.txt';

//  ...
if(!file_exists($file_name) ){
    $current_directory = getcwd();
    echo "<p style='color:red;'>This file does not exist. ($current_directory, $file_name)</p>";
    exit;
}

//  ...
if(!is_writable($file_name) ){
    echo "<p style='color:red;'>Please add write permission to this file. ($file_name)</p>";
    exit;
}

//  ...
$count = file_get_contents($file_name);

//  ...
$count++;

//  ...
file_put_contents($file_name, $count, LOCK_EX);

//  ...
echo $count;
