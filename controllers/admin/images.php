<?php
include_once "models/Uploader.class.php";
$imageSubmitted = isset($_POST['new-image']);
if ($imageSubmitted) {
    $uploader = new Uploader('image-data');
    $uploader->saveIn("img");
    $uploader->save();
    $uploadMessage = "file probably uploaded!";
}

$imageManagerHTML = include_once "views/admin/images_html.php";
return $imageManagerHTML;
