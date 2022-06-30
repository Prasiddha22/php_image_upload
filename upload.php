<?php

if (isset($_FILES['image'])) {

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];


    $image_ext = explode('.', $image_name);
    $image_first_name = $image_ext[0];
    $image_ext = strtolower(end($image_ext));

    $imageNewName = $image_first_name . '-' . uniqid() . '.' . $image_ext;

    if (move_uploaded_file($image_tmp_name, "images/$imageNewName")) {
        echo "Image uploaded successfully";
    } else {
        echo "There was an error uploading image";
    }
} else {
    echo "No image selected";
}
