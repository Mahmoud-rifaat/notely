<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);
$loginForm = new LoginForm();

$email = $_POST["email"];
$password = $_POST["password"];


if ($loginForm->validate([
    'email' => $email,
    'password' => $password
])) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }
    $loginForm->error('email', 'Invalid email address or password');
}

return view(
    'session/create.view.php',
    [
        'errors' => $loginForm->errors()
    ]
);
