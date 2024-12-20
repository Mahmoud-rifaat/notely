<?php

use Core\App;
use Core\Database;
use Core\Response;

$currentUserId = '11';

$db = App::resolve(Database::class);


$note = $db->query(
    "SELECT * FROM notes WHERE id = :id",
    [
        'id' => $_POST['id']
    ]
)->findOrFail();


authorize($note['user_id'] === $currentUserId);

$db->query(
    "DELETE FROM notes WHERE id = :id",
    [
        'id' => $_POST['id']
    ]
);

header('Location: /notes');
exit();
