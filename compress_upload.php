<?php

// Check if the image is received or not
if (isset($_FILES['image'])) {
    // Store the received image details in variable
    $image = $_FILES['image'];
    // Store image name
    $image_name = $image['name'];
    // Store image temp name
    $image_tmp_name = $image['tmp_name'];

    // Split name and extensions
    $image_ext = explode('.', $image_name);
    // Store the name of the image
    $image_first_name = $image_ext[0];
    // Store the image extension
    $image_ext = strtolower(end($image_ext));
    // Create a new name of the image file
    $imageNewName = $image_first_name . '-' . uniqid() . '.' . $image_ext;

    // if (move_uploaded_file($image_tmp_name, "images/$imageNewName")) {
    if (compress_image($image_tmp_name, "images/$imageNewName", 10)) {
        $response = ['success' => true, 'message' => 'Image uploaded successfully'];
    } else {
        $response = ['success' => false, 'message' => 'There was an error uploading image'];
    }
} else {
    $response = ['success' => false, 'message' => 'No Images Selected!'];
}

echo json_encode($response);

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
