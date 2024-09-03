<?php
/** counter:/count_difficult.php
 *
 * @created   2022-04-24
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
    exit("This file does not exist. ($file_name)");
}

//  ...
if(!is_writable($file_name) ){
    exit("Please add write permission to file. ($file_name)");
}

//  ...
if(!$file = fopen($file_name, 'r+') ){
    exit("Failed to file open. ($file_name)");
}

//  Wait for unlocked
for($i=0; $i<10; $i++){
    //  Keep unlock flag
    if( $is_lock = flock($file, LOCK_EX) ){
        break;
    }
    //  Lock could not be obtained
    sleep(1);
}

//  ...
if( empty($is_lock) ){
    fclose($file);
    exit("Failed to file lock. ($file_name)");
}

//  ...
$file_size = filesize($file_name);

//  ...
$count = (int)fread($file, $file_size);

//  ...
$count++;

//  ...
if(!rewind($file) ){
    fclose($file);
    exit("Failed to file rewind. ($file_name)");
}

//  ...
if(!fwrite($file, (string)$count) ){
    fclose($file);
    exit("Failed to file write. ($file_name)");
}

//  ...
echo $count;

//  For debug
sleep(3);

//  ...
fclose($file);
