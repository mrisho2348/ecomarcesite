<?php
// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Define variables to store form input values
$productName = "";
$productPrice = "";
$productImage = "";
$categoryID = "";

// Step 3: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 4: Retrieve the form data and sanitize it
    $productName = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $productPrice = mysqli_real_escape_string($conn, $_POST["product_price"]);
    $categoryID = mysqli_real_escape_string($conn, $_POST["category_id"]);

    // Step 5: Handle the uploaded image
    if ($_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES["product_image"]["tmp_name"];
        $imageFileName = $_FILES["product_image"]["name"];
        $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
        $targetDirectory = "images/"; // Directory to store the uploaded images
        $targetFilePath = $targetDirectory . uniqid() . '.' . $imageFileType;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($imageTmpName, $targetFilePath)) {
            $productImage = $targetFilePath;
        } else {
            echo "Error uploading image.";
        }
    }

    // Step 6: Insert the product information into the database
    $sql = "INSERT INTO products (product_name, product_price, product_image, category_id)
            VALUES ('$productName', '$productPrice', '$productImage', '$categoryID')";

    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

// Step 7: Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "header.php";
        ?>
        <div class="container mt-4">
            <h3>Add Product</h3>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $productName; ?>">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price:</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $productPrice; ?>">
                </div>
                <div class="form-group">
                    <label for="product_image">Product Image:</label>
                    <input type="file" class="form-control-file" id="product_image" name="product_image">
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <?php
                        // Step 1: Include the database connection file
                        require_once "connection.php";

                        // Step 2: Retrieve the categories from the database
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryID = $row['id'];
                                $categoryName = $row['name'];
                                echo "<option value='$categoryID'>$categoryName</option>";
                            }
                        } else {
                            echo "<option value=''>No categories found</option>";
                        }

                        // Step 3: Free the result set
                        mysqli_free_result($result);

                        // Step 4: Close the database connection
                        mysqli_close($conn);
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>

        <?php
        include "footer.php";
        ?>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
