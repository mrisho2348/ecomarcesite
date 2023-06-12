<?php
// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Step 3: Retrieve the form data
  $productId = $_POST["product_id"];
  $quantity = $_POST["quantity"];

  // Step 4: Retrieve the user_id from the session variable
  session_start();
  if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    // Step 5: Query the database to get the user_id based on the email using prepared statements
    $userSql = "SELECT id FROM users WHERE email = ?";
    $userStmt = mysqli_prepare($conn, $userSql);
    mysqli_stmt_bind_param($userStmt, "s", $email);
    mysqli_stmt_execute($userStmt);
    $userResult = mysqli_stmt_get_result($userStmt);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
      $userRow = mysqli_fetch_assoc($userResult);
      $userId = $userRow["id"];

      // Step 6: Insert the cart information into the database using prepared statements
      $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "iii", $userId, $productId, $quantity);
      if (mysqli_stmt_execute($stmt)) {
        // Item added to cart successfully
        
        // Retrieve the product_id from the URL parameters
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
        // Failed to add item to cart
        echo "error";
      }
      mysqli_stmt_close($stmt);
    } else {
      echo "User not found.";
    }

    // Step 7: Free the result set
    mysqli_free_result($userResult);
  } else {
    echo "User session not found.";
  }

  // Step 8: Close the database connection
  mysqli_close($conn);
}

?>
