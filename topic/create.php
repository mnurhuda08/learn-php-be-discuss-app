<?php

include '../connection.php';

$title = $_POST['title'];
$description = $_POST['description'];
$images = $_POST['images'];
$base64codes = $_POST['base64codes'];
$id_user = $_POST['id_user'];

$sql = "INSERT INTO topics SET 
title ='$title',
description='$description',
images='$images',
id_user = '$id_user'";
$result = $connect->query($sql);

if ($result) {
    $list_image = json_decode($images);
    $list_base64code = json_decode($base64codes);
    for ($i = 0; $i < count($list_image); $i++) {
        file_put_contents("../images/topic/" . $list_image[$i], base64_decode($list_base64code[$i]));
    }
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
