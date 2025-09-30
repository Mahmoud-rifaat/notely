<?php

$_SESSION['loggedIn'] = true;

view("index.view.php",
    [
        'heading' => 'Home',
    ]
);