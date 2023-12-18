<?php
session_start();
include 'db.php';
global $db;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $query = $db->prepare('DELETE FROM categorie WHERE id = :id');
    $query->bindParam('id', $id);
    if ($query->execute()) {
        $_SESSION['message'] = "De categorie is verwijderd.";
    } else {
        $_SESSION['message'] = "Error: De categorie is niet verwijderd";
    }
}