<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 8/17/16
 * Time: 7:20 PM
 */

$options = [
    'cost' => 5
];

$timeBefore = microtime();

$hash1 = password_hash('123456', PASSWORD_BCRYPT, $options);
//$hash2 = password_hash('123456', PASSWORD_BCRYPT);

var_dump(password_verify('123456', $hash1));
//password_needs_rehash();
var_dump(password_get_info($hash1));

$timeAfter = microtime();
echo $timeAfter - $timeBefore;