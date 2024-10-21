<?php

use Core\Database;
use Core\Response;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $note = $db->query(
        "select * from notes where id = :id", [
            'id' => $_POST['id']
        ]
    )->findOrFail();


    authorize($note['user_id'] === $currentUserId);

    $db->query("delete from notes where id = :id",
        [
            'id' => $_POST['id']
        ]);

    header('Location: /notes');

} else {
    $note = $db->query(
        "select * from notes where id = :id", [
            'id' => $_GET['id']
        ]
    )->findOrFail();


    authorize($note['user_id'] === $currentUserId);

    view("notes/show.view.php", [
        'heading' => 'Note',
        'note' => $note
    ]);
}

