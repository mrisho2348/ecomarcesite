<?php
// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Define variables to store form input values
$categoryName = "";
$categorySlug = "";

// Step 3: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 4: Retrieve the form data and sanitize it
    $categoryName = mysqli_real_escape_string($conn, $_POST["category_name"]);
    
    // Generate slug from the category name
    $categorySlug = generateSlug($categoryName);

    // Step 5: Insert the category information into the database
    $sql = "INSERT INTO category (name, slug) VALUES ('$categoryName', '$categorySlug')";

    if (mysqli_query($conn, $sql)) {
        echo "Category added successfully.";
    } else {
        echo "Error adding category: " . mysqli_error($conn);
    }
}

// Step 6: Close the database connection
mysqli_close($conn);

// Function to generate a slug from a string
function generateSlug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>

<body>
    <div class="container mt-4">
        <h3>Add Category</h3>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</body>

</html>



