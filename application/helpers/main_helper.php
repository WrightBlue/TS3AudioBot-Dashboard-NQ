<?php defined('BASEPATH') OR exit('No direct script access allowed');

function printJson($success, $message)
{
    return json_encode(array('success' => $success, 'message' => $message));
}

function getRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}