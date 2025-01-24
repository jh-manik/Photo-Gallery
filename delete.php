<?php

require('db.php');

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $dbConnection = dbConnect();
    $id = intval($_POST['id']);

    $dataQuery = query("SELECT image_path FROM photos WHERE id = :id", [
        'id' => $id
    ], $dbConnection);
    $imageData = $dataQuery->fetchAll();

    if ( count($imageData) > 0 ) {
        foreach ($imageData as $image) {
            unlink($image['image_path']);
        }
    }

    query("DELETE FROM photos WHERE id = :id", [
        'id' => $id
    ], $dbConnection);

    header('location: index.php');
    exit;
}