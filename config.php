<?php

require_once 'vendor/autoload.php';

if(!session_id())
{
    session_start();

}

$facebook = new \Facebook\Facebook([
    'app_id'        => '322171602020895',
    'app_secret'    => 'b89fbb6ee2f149e369dd46ad29047705',
    'default_graph_version' => 'v3.0'
]);

?>