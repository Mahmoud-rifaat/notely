<?php

use Core\App;
use Core\Database;
use Core\Response;

$db = App::resolve(Database::class);

$currentUserId = '11';


$note = $db->query(
    "select * from notes where id = :id",
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
