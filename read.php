<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .product-details {
            text-align: center;
        }
        .product-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Product Details</h1>
        <?php
        include 'config.php';

        if(isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class="product-details">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<img src="' . $row['image_path'] . '" class="product-img">';
                echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                echo '<p><strong>Price:</strong> $' . $row['price'] . '</p>';
                echo '<p><strong>Stock:</strong> ' . $row['stock'] . '</p>';
                echo '</div>';
            } else {
                echo "<p class='text-center'>No product found</p>";
            }
        } else {
            echo "<p class='text-center'>Product ID not provided</p>";
        }
        ?>
        <a href="index.php" class="btn btn-primary btn-back d-block mx-auto">Back to Products</a>
    </div>
</body>
</html>
