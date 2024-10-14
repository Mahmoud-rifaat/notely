<?php

$config = require('config.php');
$db = new Database($config['database']);
$Validator = require('Validator.php');

$heading = "Create note";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    $validator = new Validator();

    if (!$validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body must be greater than or equal 1 and less than 1000 characters in length!';
    }

    if (empty($errors)) {
        $db->query("INSERT INTO notes(body, user_id) VALUES (:body, :user_id)", [
            "body" => $_POST['body'],
            "user_id" => 1
        ]);
    }
}

require 'views/notes/create.view.php';