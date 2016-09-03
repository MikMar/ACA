<?php

require_once 'classes/SQLTools.php';
require_once 'classes/Connection.php';

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$ip = getUserIP();
echo $ip; // Output IP address [Ex: 177.87.193.134]

$ip = ip2long($ip);
$sqlTools = new SQLTools(Connection::getConnection());
echo $sqlTools->getCountry($ip)[0]['country'];