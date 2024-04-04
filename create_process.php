<?php
include 'config.php';

$name = $description = $price = $stock = '';
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    
    $target_dir = "C:/xampp/htdocs/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = basename($_FILES["image"]["name"]);
        $sql = "INSERT INTO products (name, description, price, stock, image_path) VALUES ('$name', '$description', '$price', '$stock', '$image_path')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit();
        } else {
            $errors['database'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $errors['image'] = "Sorry, there was an error uploading your file.";
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>
