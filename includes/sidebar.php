<!--Main Navigation-->
<header style="margin-top: 5rem;">
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-2 my-4">
        <a 
          id="main"
          href="#"
          class="list-group-item list-group-item-action py-3 ripple active"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Trang chính</span>
        </a>
        <a id="uocluong" href="#" class="list-group-item list-group-item-action py-3 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i><span>Ước lượng</span></a
        >
        <a id="thongke" href="#" class="list-group-item list-group-item-action py-3 ripple">
          <i class="fas fa-chart-pie fa-fw me-3"></i><span>Thống kê</span>
        </a>
        <a id="lichsu" href="#" class="list-group-item list-group-item-action py-3 ripple"
          ><i class="fas fa-history fa-fw me-3"></i><span>Lịch sử</span></a
        >
      </div>
      <div class="text-center mt-5">
        <img src="../assets/images/budget-management.png" class="img-fluid" style="object-fit: cover; min-height: 10rem;" alt="image">
      </div>  
    </div>
  </nav>
</header>

<!--Main layout-->
<main style="margin-top: 5rem; min-height: 100vh; font-size: min(100%, 6vw) !important;">
  <div id="content" class="container pt-4"></div>
</main>
<?php include("../includes/footer.php"); ?>
