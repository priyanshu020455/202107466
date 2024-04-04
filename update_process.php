<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "C:/xampp/htdocs/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = basename($_FILES["image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (isset($image_path)) {
        $update_values = "name='$name', description='$description', price='$price', image_path='$image_path'";
    } else {
        $update_values = "name='$name', description='$description', price='$price'";
    }
    $sql = "UPDATE products SET $update_values WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>
