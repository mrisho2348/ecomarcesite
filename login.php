<?php
// Start the session
session_start();

// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Define variables to store form input values
$email = "";
$password = "";

// Step 3: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 4: Retrieve the form data and sanitize it
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Step 5: Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        $userId = $row['user_id'];

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            // User exists and password matches, store the email and user ID in session variables
            $_SESSION["email"] = $email;
            $_SESSION["user_id"] = $userId;
            echo "Login successful. Email: " . $_SESSION["email"];
            // You can perform additional actions here, such as redirecting to a dashboard page.
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid email or password.";
            header("Location: login.php");
            exit;
        }
    } else {
        echo "Invalid email or password.";
        header("Location: login.php");
        exit;
    }

    // Step 6: Free the result set
    mysqli_free_result($result);
}

// Step 7: Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
<?php
include "header.php"
?>
    <div class="container mt-4">
        <h3>Login</h3>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
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
