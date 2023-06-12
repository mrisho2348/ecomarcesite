<?php
// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Define variables to store form input values
$productName = "";
$productPrice = "";
$productImage = "";
$categoryID = "";
$productDescription = "";
$stockQuantity = "";

// Step 3: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 4: Retrieve the form data and sanitize it
    $productName = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $productPrice = mysqli_real_escape_string($conn, $_POST["product_price"]);
    $categoryID = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $productDescription = mysqli_real_escape_string($conn, $_POST["product_description"]);
    $stockQuantity = mysqli_real_escape_string($conn, $_POST["stock_quantity"]);

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

    // Step 6: Generate slug for the product
    $productNameSlug = strtolower(str_replace(" ", "-", $productName));
    $slug = generateUniqueSlug($productNameSlug);

    // Step 7: Insert the product information into the database
    $sql = "INSERT INTO products (product_name, product_price, product_image, category_id, description, stock_quantity, slug)
            VALUES ('$productName', '$productPrice', '$productImage', '$categoryID', '$productDescription', '$stockQuantity', '$slug')";

    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

// Step 8: Retrieve categories from the database
$sql = "SELECT * FROM category";
$result1 = mysqli_query($conn, $sql);

// Step 9: Close the database connection
mysqli_close($conn);

// Helper function to generate a unique slug
function generateUniqueSlug($slug)
{
    global $conn;
    $uniqueSlug = $slug;
    $counter = 1;

    while (slugExists($uniqueSlug)) {
        $uniqueSlug = $slug . '-' . $counter;
        $counter++;
    }

    return $uniqueSlug;
}

// Helper function to check if a slug already exists in the database
function slugExists($slug)
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM products WHERE slug = '$slug'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}
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
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $productName; ?>" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $productPrice; ?>" required>
        </div>
        <div class="form-group">
            <label for="product_image">Product Image:</label>
            <input type="file" class="form-control-file" id="product_image" name="product_image" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <?php
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $categoryID = $row['id'];
                        $categoryName = $row['name'];
                        echo "<option value='$categoryID'>$categoryName</option>";
                    }
                } else {
                    echo "<option value=''>No categories found</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" id="product_description" name="product_description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>


    </div>
    <?php
include "footer.php";
?>
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
