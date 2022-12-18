<?php
include_once("definition.php");
if(!isset($_SESSION)) session_start(); 
?>

<!--Main Navigation-->
<header>
  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <?php if (isset($_SESSION['login'])) { ?>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <?php } ?>

        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="<?php echo BASE_URL."/index.php" ?>">
          <img
              src="<?php echo BASE_URL."/assets/images/QLCT.png" ?>"
              height=""
              alt="Logo"
              loading="lazy"
              style="margin-top: -1px;max-height: 30px;"
          />
          <span style="color: #1672E6;">QLCT</span>
        </a>
      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <?php if (isset($_SESSION['login'])) { ?>
        <?php include_once("notiDropdown.php"); ?>
        <!-- User -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <i class='fa fa-user'> Người dùng</i>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end text-center"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <span class="dropdown-item text-primary disabled"><?php echo $_SESSION['ho_ten']; ?></span>
            </li>
            <li>
              <a class="dropdown-item" href="../user/nguoidung.php"><i class='fas fa-user-edit'></i> Thông tin</a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo BASE_URL."/user/dangxuat.php" ?>" class="nav-link"><i class='fas fa-sign-out-alt'></i> </i>  Đăng xuất</a>
            </li>
          </ul>
        </li>  
        <?php } else { ?>                  
        <div id="signMenu" class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE_URL."/user/dangnhap.php" ?>">
                <button type="button" class="btn btn-link px-2 me-2">
                    <i class='fa fa-sign-in-alt'> Đăng nhập</i>
                </button>            
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE_URL."/user/dangky.php" ?>">
                <button type="button" class="btn btn-primary px-3 me-2">
                    <i class='fa fa-plus'> Đăng ký</i>
                </button>
              </a>
            </li>
          </ul>   
        </div> 
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#signMenu"
          aria-controls="signMenu"
          aria-expanded="false"
          aria-label="signToggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button> 
        <?php } ?>
      </ul>
    </div>
  </nav>
</header>
<?php
//  if (isset($_SESSION['noti'])) {
//   echo "<script> showNoti(); </script>";
//   unset($_SESSION['noti']); }
  ?>