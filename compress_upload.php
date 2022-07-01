<?php

if (isset($_FILES['image'])) {

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];


    $image_ext = explode('.', $image_name);
    $image_first_name = $image_ext[0];
    $image_ext = strtolower(end($image_ext));

    $imageNewName = $image_first_name . '-' . uniqid() . '.' . $image_ext;

    // if (move_uploaded_file($image_tmp_name, "images/$imageNewName")) {
    if (compress_image($image_tmp_name, "images/$imageNewName", 10)) {
        echo "Image uploaded successfully";
    } else {
        echo "There was an error uploading image";
    }
} else {
    echo "No image selected";
}

function compress_image($src, $dest, $quality)
{
    $info = getimagesize($src);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($src);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($src);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($src);
    } else {
        die('Unknown image file format');
    }
    //compress and save file to jpg
    imagejpeg($image, $dest, $quality);

    return true;
}
