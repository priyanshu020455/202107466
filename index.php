<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Priyanshu(202107466)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .btn-view,
        .btn-edit,
        .btn-delete,
        .btn-select {
            background-color: #28a745;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            font-size: 16px;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-select {
            background-color: red;
        }

        .image-container {
            width: 200px;
            height: 200px;
            overflow: hidden;
            transform: rotate(45deg);
            margin: 10px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            transform: rotate(-45deg);
            object-fit: cover;
        }

        .container {
            background-color: #ffffcc;
            padding: 2px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="logo">
        <img src="logo.jpeg" alt="Priyanshu Designs Logo" class="logo-img">
    </div>

    <div class="paragraph-container">
        <h1>Welcome to Priyanshu Designs</h1>
    </div>

    <div class="container">
        <h1 class="mt-4">Product Catalog</h1>
        <a href="create.php" class="btn btn-primary mb-4">Add New Product</a>
        
        <div class="row">
            <?php
            include 'config.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-2">';
                    echo '<div class="image-container">';
                    echo '<img src="' . $row["image_path"] . '" alt="' . $row["name"] . '">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text">Price: $' . $row["price"] . '</p>';
                    echo '<div class="button-group">';
                    echo '<a href="read.php?id=' . $row["id"] . '" class="btn btn-primary btn-view">View</a>';
                    echo '<a href="update.php?id=' . $row["id"] . '" class="btn btn-secondary btn-edit">Edit</a>';
                    echo '<a href="index.php?delete_id=' . $row["id"] . '" class="btn btn-danger btn-delete" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>';
                    echo '<a href="Book.php?id=' . $row["id"] . '" class="btn btn-success btn-Book">Book</a>';
                    echo '</div>';
                    echo '</div></div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
