<?php
include("includes/dbconnection.php");
session_start();

if (isset($_SESSION['login'])) header("location:user/trangchu.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Quản Lý Chi Tiêu</title>
    <link rel="icon" type="image/x-icon" href="assets/images/QLCT.ico">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
  <?php include("includes/navbar.php"); ?>

  <section class="vh-100 mt-5">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <h1 class="text-uppercase font-weight-bold text-primary text-center">
              Website Quản lý chi tiêu
          </h1>
          <img src="assets/images/budget-management.png" alt="Image">
        </div>
      </div>
  </section>

  <?php include("includes/footer.php"); ?>
  
    <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>