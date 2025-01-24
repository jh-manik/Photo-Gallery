<?php

require('db.php');

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $title = htmlspecialchars(trim($_POST['title']));
    $image = $_FILES['image'];


    if ( isset($image) && !empty($image['tmp_name']) ) {
        $uloadDir = 'uploads/';
        $filePath = $uloadDir . basename($image['name']);

        if ( move_uploaded_file($image['tmp_name'], $filePath) ) {
            $dbConnection = dbConnect();
            if (
                query("INSERT INTO photos (title, image_path) VALUES (:title, :image)", [
                    'title' => $title,
                    'image' => $filePath
                ], $dbConnection)
            ) {
                header('Location: index.php');
                exit;
            } else {
                echo 'Failed to upload image';
            }

            
        } else {
            echo 'Failed to upload image';
        }
    } else {
        echo 'Please select a image to upload';
    }
}
