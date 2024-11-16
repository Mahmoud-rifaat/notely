<?php

use Core\App;
use Core\Database;
use Core\Validator;


$db = APP::resolve(Database::class);

$currentUserId = '11';

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);


$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body must be greater than or equal 1 and less than 1000 characters in length!';
}

if (count($errors)) {
    return view(
        'notes/edit.view.php',
        [
            'heading' => 'Edit Note',
            'errors' => $errors,
            'note' => $note
        ]
    );
}


$db->query(
    "UPDATE notes SET body = :body WHERE id = :id",
    [
        "body" => $_POST['body'],
        'id' => $_POST['id']
    ]
);

header('location: /notes');
die();
