<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=webbrett', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM user WHERE username = :username");

    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        header("Location: ../templates/backend.php");
        die();
    } else {
        echo 'Password oder Username falsch';
    }
    unset($pdo);
}