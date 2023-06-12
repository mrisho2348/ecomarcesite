<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php
include "header.php"
?>





    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
    <div class="product-image">
    <?php
    require_once "connection.php";
// Retrieve the product_id from the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Retrieve product images from the database based on product_id
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['product_image'];

        echo '<img class="w-100 h-100" src="' . $image . '" alt="Image">';
    } else {
        echo '<img class="w-100 h-100" src="default-image.jpg" alt="Image">';
    }
}
?>

    </div>
</div>


            <div class="col-lg-7 h-auto mb-30">
            <?php
// Retrieve product information from the database based on product_id
$productQuery = "SELECT * FROM products WHERE id = $product_id";
$productResult = mysqli_query($conn, $productQuery);

if ($productResult && mysqli_num_rows($productResult) > 0) {
    $productRow = mysqli_fetch_assoc($productResult);
    $productName = $productRow['product_name'];
    $productPrice = $productRow['product_price'];
    $productDescription = $productRow['description'];
    $productStockQuantity = $productRow['stock_quantity'];

    echo '<h3>' . $productName . '</h3>';

    // Retrieve rating information from the database based on product_id
    $ratingQuery = "SELECT AVG(rating) AS average_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = $product_id";
    $ratingResult = mysqli_query($conn, $ratingQuery);
    $ratingRow = mysqli_fetch_assoc($ratingResult);
    $averageRating = $ratingRow['average_rating'];
    $totalReviews = $ratingRow['total_reviews'];

    echo '<div class="d-flex mb-3">';
    echo '<div class="text-primary mr-2">';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star-half-alt"></small>';
    echo '<small class="far fa-star"></small>';
    echo '</div>';
    echo '<small class="pt-1">(' . $totalReviews . ' Reviews)</small>';
    echo '</div>';

    echo '<h3 class="font-weight-semi-bold mb-4">$' . $productPrice . '</h3>';
    echo '<p class="mb-4">' . $productDescription . '</p>';
}
?>
<div class="container">
<form id="add-to-cart-form" method="post" action="addCart.php">
    <div class="row">      
        <div class="col-md-3">
            <div class="input-group quantity" style="width: 130px;">
                <!-- Minus button -->
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-minus" type="button">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- Quantity input -->
                <input id="quantity-input" type="text" class="form-control bg-secondary border-0 text-center" name="quantity" value="1">
                <!-- Plus button -->
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-plus" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
           
                <!-- Add to Cart button -->
                <?php
                // Check if the product is already added to the cart
                $isProductInCart = false; // Assume the product is not in the cart

                // Check your cart data or session to determine if the product is in the cart
                // Set $isProductInCart to true if the product is found in the cart

                if ($isProductInCart) {
                    echo '<button id="view-cart-btn" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> View Cart</button>';
                } else {
                    if ($productStockQuantity > 0) {
                        echo '<button id="add-to-cart-btn" class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>';
                    } else {
                        echo '<button class="btn btn-primary px-3" disabled><i class="fa fa-shopping-cart mr-1"></i> Out of Stock</button>';
                    }
                }
                ?>
                <!-- Hidden fields for product ID and user ID -->
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $userID; ?>">
            </form>
        </div>
    </div>
</div>




<script>
$(document).ready(function() {
    // Event listener for the "Add to Cart" button click
    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        // Get the form data
        var formData = $(this).serialize();

        // Send an AJAX request to the add_to_cart.php script
        $.ajax({
            type: 'POST',
            url: 'addCart.php',
            data: formData,
            success: function(response) {
                // Handle the response from the server

                // If the product was added to the cart successfully
                if (response === 'success') {
                    // Change the button to "View Cart"
                    $('#add-to-cart-btn').html('<i class="fa fa-shopping-cart mr-1"></i> View Cart');
                } else {
                    // Show an error message or handle the failure case
                    console.log('Failed to add product to cart.');
                }
            }
        });
    });

    // Event listeners for the plus and minus buttons
    $('.btn-plus').click(function() {
        var quantityInput = $('#quantity-input');
        var quantity = parseInt(quantityInput.val());
        quantityInput.val(quantity + 1); // Increment quantity
    });

    $('.btn-minus').click(function() {
        var quantityInput = $('#quantity-input');
        var quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
            quantityInput.val(quantity - 1); // Decrement quantity
        }
    });
});
</script>

            </div>
        </div>

        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
  <h4 class="mb-3">Product Description</h4>
<?php
// Assuming you have a database connection established
require_once "connection.php";

// Retrieve the product_id from the URL parameter
$product_id = $_GET['product_id'];

// Step 1: Prepare the SQL statement to retrieve the product description
$sql = "SELECT description FROM products WHERE id = ?";

// Step 2: Prepare and bind the parameter (product_id) for the SQL statement
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $product_id);

// Step 3: Execute the prepared statement
mysqli_stmt_execute($stmt);

// Step 4: Fetch the result
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$description = $row['description'];

// Step 5: Close the prepared statement
mysqli_stmt_close($stmt);

// Step 6: Close the database connection
mysqli_close($conn);

// Render the product description
echo "<p>$description</p>";
?>
</div>

                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
  <h4 class="mb-4">Leave a review</h4>
  <small>Your email address will not be published. Required fields are marked *</small>
  <form action="process_review.php" method="POST">
  <div class="d-flex my-3">
    <p class="mb-0 mr-2">Your Rating * :</p>
    <div class="text-primary">
      <input type="hidden" name="rating" id="ratingInput" value="0">
      <i class="far fa-star rating-star" data-rating="1"></i>
      <i class="far fa-star rating-star" data-rating="2"></i>
      <i class="far fa-star rating-star" data-rating="3"></i>
      <i class="far fa-star rating-star" data-rating="4"></i>
      <i class="far fa-star rating-star" data-rating="5"></i>
    </div>
  </div>
  <div class="form-group">
    <label for="message">Your Review *</label>
    <textarea id="message" cols="30" rows="5" class="form-control" name="review_message"></textarea>
  </div>
  <div class="form-group">
    <label for="name">Your Name *</label>
    <input type="text" class="form-control" id="name" name="review_name">
  </div>
  <div class="form-group">
    <label for="email">Your Email *</label>
    <input type="email" class="form-control" id="email" name="review_email">
  </div>
  <div class="form-group">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
  </div>
  <div class="form-group mb-0">
    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
  </div>
</form>

</div>

<!-- Make sure to include the necessary libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('.rating-star').on('mouseenter', function() {
      var rating = $(this).data('rating');
      highlightStars(rating);
    });

    $('.rating-star').on('mouseleave', function() {
      var rating = $('#ratingInput').val();
      highlightStars(rating);
    });

    $('.rating-star').on('click', function() {
      var rating = $(this).data('rating');
      $('#ratingInput').val(rating);
      highlightStars(rating);
    });

    function highlightStars(rating) {
      $('.rating-star').removeClass('fas fa-star-half').addClass('far');

      var floorRating = Math.floor(rating);
      for (var i = 1; i <= floorRating; i++) {
        $('[data-rating="' + i + '"]').removeClass('far').addClass('fas');
      }

      if (rating % 1 !== 0) {
        $('[data-rating="' + floorRating + '"]').removeClass('far').addClass('fas fa-star-half');
      }
    }
  });
</script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php
include "footer.php";
?>

    <!-- Footer End -->


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