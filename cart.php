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

<?php
include "header.php"
?>

    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php
// Assuming you have a database connection established
require_once "connection.php";

// Retrieve product data from the database
$sql = "SELECT p.id, p.product_name, p.product_price, p.product_image
        FROM products p
        INNER JOIN cart c ON p.id = c.product_id";
$result = mysqli_query($conn, $sql);

// Generate table rows dynamically
while ($row = mysqli_fetch_assoc($result)) {
  $product_id = $row['id'];
  $product_name = $row['product_name'];
  $product_price = $row['product_price'];
  $product_image = $row['product_image'];
  ?>
  <tr>
    <td class="align-middle">
      <img src="<?php echo $product_image; ?>" alt="" style="width: 50px;"> <?php echo $product_name; ?>
    </td>
    <td class="align-middle">$<?php echo $product_price; ?></td>
    <td class="align-middle">
      <div class="input-group quantity mx-auto" style="width: 100px;">
        <div class="input-group-btn">
          <button class="btn btn-sm btn-primary btn-minus" data-product-id="<?php echo $product_id; ?>">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center quantity-input" value="1">
        <div class="input-group-btn">
          <button class="btn btn-sm btn-primary btn-plus" data-product-id="<?php echo $product_id; ?>">
            <i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
    </td>
    <td class="align-middle">$<?php echo $product_price; ?></td>
    <td class="align-middle">
      <button class="btn btn-sm btn-danger btn-remove" data-product-id="<?php echo $product_id; ?>">
        <i class="fa fa-times"></i>
      </button>
    </td>
  </tr>
<?php
}

// Close the database connection
mysqli_close($conn);
?>

                     
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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