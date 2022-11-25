<?php require_once './database/connection.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./index.php');
}

$sql = "DELETE FROM `users` WHERE `id` = ${id}";

if ($conn->query($sql)) {
    header('Location: ./index.php');
} else {
    echo "Failed to delete the user";
}