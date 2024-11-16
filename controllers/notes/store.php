<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$errors = [];

$validator = new Validator();

if (!$validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body must be greater than or equal 1 and less than 1000 characters in length!';
}

if (!empty($errors)) {
    return view(
        'notes/create.view.php',
        [
            'heading' => 'Create Note',
            'errors' => $errors
        ]
    );
}


$db->query(
    "INSERT INTO notes(body, user_id) VALUES (:body, :user_id)",
    [
        "body" => $_POST['body'],
        "user_id" => 11
    ]
);

header('location: /notes');
die();
