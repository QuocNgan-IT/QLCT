<?php
include("../includes/action.php");
if(!isset($_SESSION)) session_start(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Quản Lý Chi Tiêu - Đăng ký</title>  
  <link rel="icon" type="image/x-icon" href="../assets/images/QLCT.ico">

  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
</head>

<body>
  <?php include("../includes/navbar.php"); ?>

  <section>
    <div class="container py-5 my-5">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="../assets/images/budget-management.png" class="img-fluid" alt="image">
          <div class="d-flex align-items-center justify-content-center mb-3">
            <h3>Quản lý chi tiêu</h3>
          </div>
        </div><br>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <h3 class="text-uppercase font-weight-bold text-primary" style="text-align: center;">Đăng ký</h3>

          <form method="POST">
          <!-- Name input -->
          <div class="form-outline mb-4">
              <input 
                type="text" 
                name="name" 
                class="form-control form-control-lg" 
                required
              />
              <label class="form-label" for="name">Họ và tên</label>
            </div>

          <!-- Chọn giới tính  & năm sinh -->
            <div class="form-group row align-items-end mb-4"> 
                <div class="col">
                    <label class="form-label" for="gender">Giới tính </label>
                    <select class="form-select" name="gender">
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nữ</option>
                        <option selected value="Khác">Khác</option>
                    </select> 
                </div>
                <div class="col-1"></div>
                <div class="col form-outline me-2">
                    <input 
                        type="number" 
                        name="birthyear" 
                        class="form-control form-control-lg" 
                        required
                        min="<?php echo date("Y")-100; ?>"
                        max="<?php echo date("Y"); ?>"
                        data-mdb-toggle="tooltip"
                        data-mdb-placement="left" 
                        title="Nhập năm sinh hợp lệ"
                    />
                    <label class="form-label" for="birthyear">Năm sinh</label>
                </div>                             
            </div>

            <!-- Thu nhập -->
            <div class="form-outline input-group mb-4">
                <input
                    type="text"
                    id="income"
                    name="income" 
                    class="form-control number-separator" 
                    required
                    aria-describedby="basic-addon"
                    data-mdb-toggle="tooltip"
                    data-mdb-placement="left" 
                    title="Theo thống kê năm 2020 & 2021 về thu nhập và chi tiêu của người Việt Nam, mức thu nhập bình quân chung là > 4 triệu đồng/người/tháng"
                    placeholder="> 4 000"
                    onkeyup="check1();"
                />
                <input type="hidden" id="result_input" name="true_income">
                <span class="input-group-text" id="basic-addon">000đ</span>
                <label class="form-label" for="income">Thu nhập hàng tháng</label>
            </div>
            
            <!-- Username input -->
            <div class="form-outline mb-4">
              <input 
                type="text" 
                name="username" 
                class="form-control form-control-lg" 
                required
                minlength="3"
                maxlength="20" 
                data-mdb-toggle="tooltip"
                data-mdb-placement="left" 
                title="Từ 3-20 ký tự"
              />
              <label class="form-label" for="username">Tên đăng nhập</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control form-control-lg" 
                required
                minlength="3"
                maxlength="20"
                data-mdb-toggle="tooltip"
                data-mdb-placement="left" 
                title="Từ 3-20 số"
                onkeyup="check();"
                />
              <label class="form-label" for="password">Mật khẩu</label>
            </div>
            <div class="form-outline mb-4">
              <input 
                type="password" 
                id="cfr_password" 
                name="cfr_password" 
                class="form-control form-control-lg" 
                required
                data-mdb-toggle="tooltip"
                data-mdb-placement="left" 
                title="Nhập lại mật khẩu"
                onkeyup="check();"
                />
              <label class="form-label" for="cfr_password">Nhập lại mật khẩu</label>
            </div>
            
            <!-- Thông báo lỗi -->
            <span class="text-danger">
                <?php if (isset($_SESSION['err'])) {
                        echo $_SESSION['err'];
                        unset($_SESSION['err']); } ?>
            </span>

            <!-- Submit button -->
            <button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Đăng ký</button>

            <!-- Register -->
            <div class="d-flex justify-content-center align-items-center mb-4">
              <div class="text-center">
                <p>Đã có tài khoản? <a href="<?php echo BASE_URL."/user/dangnhap.php" ?>">Đăng nhập ngay</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include("../includes/footer.php"); ?>

  <script src="../bootstrap/js/mdb.min.js"></script>  
  <script src="../bootstrap/js/easy-number-separator.js"></script>  
  <script type="text/javascript">
      //Check password == confirm_password != null
      var check = function() {
        var pass = document.getElementById('password').value
        var cf_pass = document.getElementById('cfr_password').value
        // var regex = /([a-zA-Z])[a-zA-Z0-9]{3,}/
        var regex = /[0-9]{3,20}/

        if (pass==cf_pass && pass!='' && pass.match(regex)) {
            document.getElementById('cfr_password').style.backgroundColor = 'rgb(127, 255, 127, 0.4)';
        } else {
            document.getElementById('cfr_password').style.backgroundColor = 'rgb(255, 127, 127, 0.4)';
        }
      }

      var check1 = function() {
        var income = document.getElementById('income').value

        if (income < 4000) document.getElementById('income').style.backgroundColor = 'rgb(255, 127, 127, 0.4)';
        else document.getElementById('income').style.backgroundColor = 'transparent';
      }

      // 
      easyNumberSeparator({
        selector: '.number-separator',
        separator: ' ',
        decimalSeparator: '.',
        resultInput: '#result_input',
      })
    </script>
</body>

</html>