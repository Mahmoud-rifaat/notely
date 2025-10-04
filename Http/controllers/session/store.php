<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$attributes = [
    'email' => $_POST["email"],
    'password' => $_POST["password"]
];

$form = LoginForm::validate($attributes);

$signedIn = (new Authenticator)->attempt($attributes);

if (!$signedIn) {
    $form->error('email', 'Invalid email address or password')
        ->throw();
}

redirect('/');
