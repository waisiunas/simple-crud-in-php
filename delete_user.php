<?php require_once './database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./show_users.php');
}

$sql = "DELETE FROM `users` WHERE `id` = $id";

if ($conn->query($sql)) {
    header('Location: ./show_users.php');
} else {
    echo 'User has failed to delete';
}