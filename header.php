<?php
header('Access-Control-Allow-Origin: * ');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, Access-Control-Allow-Header');
header('Content-Type: application/json');
header('Access-Control-Max-Age: 3600');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Metods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Origin: * ");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        header("Access-Control-Allow-Origin: * ");
        
    exit(0);
}