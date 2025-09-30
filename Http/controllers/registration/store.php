<?php

use Core\Validator;
use Core\App;
use Core\Authenticator;

$email = $_POST["email"];
$name = $_POST["name"];
$password = $_POST["password"];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password should be at least 7 characters';
}

$db = App::resolve('Core\Database');

$user = $db->query(
    "SELECT * FROM users WHERE email = :email",
    [
        "email" => $email
    ]
)->find();

if ($user) {
    $errors['email'] = 'Email already exists';
    redirect('/');
}

if (!empty($errors)) {
    view(
        'registration/create.view.php',
        [
            'errors' => $errors
        ]
    );
    exit();
}

$user = $db->query(
    "INSERT INTO users (email, name, password) VALUES (:email, :name, :password)",
    [
        'email' => $email,
        'name' => $name,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]
);

$auth = new Authenticator();
$auth->login([
    'name' => $name,
    'id' => $user->id,
    'email' => $email
]);

header('location: / ');
exit();
