<?php

    global $pdo;

try{
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $pdo = new PDO("mysql:host=localhost;dbname=php_project", 'Amirali_Hosseini', '44266007', $options);
    return $pdo;
}
catch (PDOEXception $e) {
    echo 'error' . $e->getMessage();
    exit;
}