<?php
include("../includes/action.php");
if(!isset($_SESSION)) session_start(); 

  if (isset($_SESSION['login'])) header("location:trangchu.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Quản Lý Chi Tiêu - Đăng nhập</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/QLCT.ico">

  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
</head>

<body>
  <?php include("../includes/navbar.php"); ?>

  <section class="vh-100 my-2">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="../assets/images/budget-management.png" class="img-fluid" alt="image">
          <div class="d-flex align-items-center justify-content-center">
            <h3>Quản lý chi tiêu</h3>
          </div>
        </div><br>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <h3 class="text-uppercase font-weight-bold text-primary" style="text-align: center;">Đăng nhập</h3>
          <form method="POST">
            <!-- Username input -->
            <div class="form-outline mb-4">
              <input 
                type="text" 
                name="username" 
                class="form-control form-control-lg" 
                required
                minlength="3"
                maxlength="20" 
              />
              <label class="form-label" for="username">Tên đăng nhập</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input 
                type="password" 
                name="password" 
                class="form-control form-control-lg" 
                required
                />
              <label class="form-label" for="password">Mật khẩu</label>
            </div>

            <!-- <div class="d-flex justify-content-around align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Ghi nhớ đăng nhập </label>
              </div>
              <a href="#!">Quên mật khẩu?</a>
            </div> -->
            
            <!-- Thông báo lỗi -->
            <span class="text-danger">
                <?php if (isset($_SESSION['err'])) {
                        echo $_SESSION['err'];
                        unset($_SESSION['err']); } ?>
            </span>

            <!-- Submit button -->
            <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Đăng nhập</button>

            <!-- Register -->
            <div class="d-flex justify-content-center align-items-center mb-4">
              <div class="text-center">
                <p>Chưa có tài khoản? <a href="<?php echo BASE_URL."/user/dangky.php" ?>">Đăng ký ngay</a></p>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include("../includes/footer.php"); ?>
  <script src="../bootstrap/js/mdb.min.js"></script>
</body>

</html>