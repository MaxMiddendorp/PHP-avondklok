<?php
include_once 'DotEnv.php';
try{
    $env = new DotEnv('./.env');
}catch(\InvalidArgumentException $exception){
    $env = new DotEnv('../.env');

}
$env->load();

session_start();

$host = $_ENV['DATABASE_HOST'];
$database = $_ENV['DATABASE_DATABASE'];
$username = $_ENV['DATABASE_USER'];
$password = $_ENV['DATABASE_PASSWORD'];
$message = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    $message = $error->getMessage();
}
