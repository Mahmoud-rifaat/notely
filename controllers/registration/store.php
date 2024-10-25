<?php

use Core\Validator;
use Core\App;

$email = $_POST["email"];
$password = $_POST["password"];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password should be at least 7 characters';
}

$db = App::resolve('Core\Database');

$user = $db->query("SELECT * FROM users WHERE email = :email",
    [
        "email" => $email
    ])->find();

if ($user) {
    $errors['email'] = 'Email already exists';
}

if (count($errors)) {
    view('registration/create.view.php',
        [
            'errors' => $errors
        ]);
    exit();
}

$db->query("INSERT INTO users (email,password) VALUES (:email,:password)",
    [
        'email' => $email,
        'password' => $password
    ]);

$_SESSION['user'] = [
    'email' => $email
];

header('location: / ');