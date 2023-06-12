<?php
// Step 1: Include the database connection file
require_once "connection.php";

// Step 2: Define variables to store form input values
$email = "";
$password = "";
$firstname = "";
$lastname = "";
$address = "";
$contactInfo = "";
$photo = "";


// Step 3: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 4: Retrieve the form data and sanitize it
 // Step 4: Retrieve the form data and sanitize it
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]); 
$firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
$address = mysqli_real_escape_string($conn, $_POST["address"]);
$contactInfo = mysqli_real_escape_string($conn, $_POST["contact_info"]);
$photo = $_FILES["photo"];

// Step 5: Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Step 6: Process and store the uploaded photo
$photoName = $photo["name"]; // The original name of the file
$photoTmpName = $photo["tmp_name"]; // The temporary filename on the server
$photoError = $photo["error"]; // Any error code
$photoSize = $photo["size"]; // The size of the file

// Specify the directory to store the uploaded photos
$uploadDir = "photos/";
$photoPath = $uploadDir . $photoName;

// Move the uploaded photo to the specified directory
if (move_uploaded_file($photoTmpName, $photoPath))
 {
    // Step 7: Insert user information into the database, including the photo path
    $userSql = "INSERT INTO users (email, password,  firstname, lastname, address, contact_info, photo) 
                VALUES ('$email', '$hashedPassword',  '$firstname', '$lastname', '$address', '$contactInfo', '$photoPath')";

    if (mysqli_query($conn, $userSql))
     {
        echo "User registered successfully.";
        // You can perform additional actions here, such as redirecting to a success page or logging the user in.
        header("Location: login.php");
        exit; //
    } 
    else
     {
        echo "Error registering user: " . mysqli_error($conn);
        header("Location: registerUser.php");
        exit; //
    }
} 

else 
{
    echo "Error uploading photo.";
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
    <title>User Registration and Order Placement</title>
</head>

<body>

<?php
include "header.php"
?>
    
    <div class="container mt-4">
        <h3>User Registration </h3>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>        
    <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required>
    </div>
    <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="form-group">
        <label for="contact_info">Contact Info:</label>
        <input type="text" class="form-control" id="contact_info" name="contact_info" required>
    </div>
    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control-file" id="photo" name="photo" required>
    </div>

    <button type="submit" class="btn btn-primary">Sign Up</button>
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
