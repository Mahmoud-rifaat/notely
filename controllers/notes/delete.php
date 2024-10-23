<?php

use Core\App;
use Core\Database;
use Core\Response;

$currentUserId = 1;

$db = App::resolve(Database::class);


$note = $db->query(
    "select * from notes where id = :id",
    [
        'id' => $_POST['id']
    ]
)->findOrFail();


authorize($note['user_id'] === $currentUserId);

$db->query(
    "delete from notes where id = :id",
    [
        'id' => $_POST['id']
    ]
);

header('Location: /notes');
exit();
