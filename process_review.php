<?php
// Retrieve the form data
$reviewMessage = $_POST["review_message"];
$reviewName = $_POST["review_name"];
$reviewEmail = $_POST["review_email"];
$rating = $_POST["rating"];
$product_id = $_POST["product_id"];

// Process the form data (e.g., save to a database)

// Step 1: Establish a database connection (assuming you have a connection.php file)
require_once "connection.php";

// Step 2: Prepare the SQL statement to insert the data into the database
$sql = "INSERT INTO product_reviews (product_id, rating, review, created_at, updated_at, user_name, user_email) VALUES (?, ?, ?, NOW(), NOW(), ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iisss", $product_id, $rating, $reviewMessage, $reviewName, $reviewEmail);

// Step 3: Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
  // Success - the data has been inserted into the database
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
  } else {
    // If the product_id is not set, you can handle the error or assign a default value
    $product_id = 10; // Assign a default value or handle the error case
  }

  // Redirect to detail.php with the dynamic product_id
  header("Location: detail.php?product_id=" . $product_id);
  exit;
} else {
  // Error - failed to insert the data into the database
  echo "Error submitting review.";
}

// Step 4: Close the prepared statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Redirect the user back to the detail page or display a success message
// You can use header("Location: detail.php") to redirect or show a success message using echo or HTML
?>
