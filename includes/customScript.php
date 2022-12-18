<script type="text/javascript">
  // Sidebar Menu
  $(document).ready(function() {
    $("#content").load("main.php");

    // Item Click
    $("#main").click(function(e) {
      $("#content").load("main.php");
    });

    $("#uocluong").click(function(e) {
      $("#content").load("uocluong.php");
    });

    $("#thongke").click(function(e) {
      $("#content").load("thongke.php");
    });

    $("#lichsu").click(function(e) {
      $("#content").load("lichsu.php");
    });

    $(".list-group-item").click(function() {
      $(".list-group-item").removeClass("active");
      $(this).toggleClass("active");
    });
  });

  // subSidebar Menu
  $(document).ready(function() {
    
    // Item Click
    $("#kcc1").click(function(e) {
      $("#content1").load("ct_khoanchi.php?kcc=1");
    });

    $("#kcc2").click(function(e) {
      $("#content1").load("ct_khoanchi.php?kcc=2");
    });

    $("#kcc3").click(function(e) {
      $("#content1").load("ct_khoanchi.php?kcc=3");
    });

    $(".list-group-item").click(function() {
      $(".list-group-item").removeClass("active");
      $(this).toggleClass("active");
    });
  });

  // 
  easyNumberSeparator({
    selector: '.number-separator-add',
    separator: ' ',
    decimalSeparator: '.',
    resultInput: '#trueResult_add',
  })
  easyNumberSeparator({
    selector: '.number-separator-edit',
    separator: ' ',
    decimalSeparator: '.',
    resultInput: '#trueResult_edit',
  })

  // Back to top
  let mybutton = document.getElementById("btn-back-to-top");
  window.onscroll = function () {
    scrollFunction();
  };
  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }  
  mybutton.addEventListener("click", backToTop);
  function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

  // Toast
  let notiToast = mdb.Toast.getInstance(document.getElementById('notification-toast'));
  function showNoti() {
    notiToast.show();
  }

  let warnToast = mdb.Toast.getInstance(document.getElementById('warning-toast'));
  function showWarn() {
    warnToast.show();
  }

  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict';
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach((form) => {
      form.addEventListener('submit', (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
  
  // 
  var editModal = document.getElementById('editModal')
  editModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-mdb-* attributes
    var ma_kct = button.getAttribute('data-mdb-ma_kct')
    var ma_kcc = button.getAttribute('data-mdb-ma_kcc')
    var ten_kct = button.getAttribute('data-mdb-ten_kct')
    var so_tien = button.getAttribute('data-mdb-so_tien')
    var mo_ta = button.getAttribute('data-mdb-mo_ta')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modal_ma_kct = editModal.querySelector('#maKct')
    var modal_ma_kcc = editModal.querySelector('#maKcc')
    var modal_ten_kct = editModal.querySelector('#tenKct')
    var modal_tien_kct = editModal.querySelector('#tienKct')
    var modal_trueTien_kct = editModal.querySelector('#trueResult_edit')
    var modal_mota_kct = editModal.querySelector('#motaKct')

    modal_ma_kct.value = ma_kct
    modal_ma_kcc.value = ma_kcc
    modal_ten_kct.value = ten_kct
    modal_tien_kct.value = so_tien/1000
    modal_trueTien_kct.value = so_tien/1000
    modal_mota_kct.textContent = mo_ta
  })

  // 
  var deleteModal = document.getElementById('deleteModal')
  deleteModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-mdb-* attributes
    var ma_kct = button.getAttribute('data-mdb-ma_kct')
    var ma_kcc = button.getAttribute('data-mdb-ma_kcc')
    var ten_kct = button.getAttribute('data-mdb-ten_kct')
    var so_tien = button.getAttribute('data-mdb-so_tien')
    var mo_ta = button.getAttribute('data-mdb-mo_ta')
    var ngay_chi = button.getAttribute('data-mdb-ngay_chi')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modal_ma_kct = deleteModal.querySelector('#maKctXoa')
    var modal_ma_kcc = deleteModal.querySelector('#maKccXoa')
    var modal_ten_kct = deleteModal.querySelector('#tenKctXoa')
    var modal_tien_kct = deleteModal.querySelector('#tienKctXoa')
    var modal_mota_kct = deleteModal.querySelector('#motaKctXoa')
    var modal_ngaychi_kct = deleteModal.querySelector('#ngayChiKct')

    modal_ma_kct.value = ma_kct
    modal_ma_kcc.value = ma_kcc
    modal_ten_kct.value = ten_kct
    modal_tien_kct.value = so_tien/1000
    modal_mota_kct.textContent = mo_ta
    modal_ngaychi_kct.textContent = ngay_chi
  })

  // 
  var fixModal = document.getElementById('fixModal')
  fixModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-mdb-* attributes
    var thuNhap = button.getAttribute('data-mdb-thuNhap')
    var tongChi1 = button.getAttribute('data-mdb-tongChi1')
    var tongChi2 = button.getAttribute('data-mdb-tongChi2')
    var tongChi3 = button.getAttribute('data-mdb-tongChi3')
    var tyLe1 = button.getAttribute('data-mdb-tyLe1')
    var tyLe2 = button.getAttribute('data-mdb-tyLe2')
    var tyLe3 = button.getAttribute('data-mdb-tyLe3')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modal_thuNhap = fixModal.querySelector('#thuNhap')
    var modal_tongChi1 = fixModal.querySelector('#tongChi1')
    var modal_tongChi2 = fixModal.querySelector('#tongChi2')
    var modal_tongChi3 = fixModal.querySelector('#tongChi3')
    var modal_tyLe1 = fixModal.querySelector('#tyLe1')
    var modal_tyLe2 = fixModal.querySelector('#tyLe2')
    var modal_tyLe3 = fixModal.querySelector('#tyLe3')

    modal_thuNhap.value = thuNhap
    modal_tongChi1.value = tongChi1
    modal_tongChi2.value = tongChi2
    modal_tongChi3.value = tongChi3
    modal_tyLe1.value = tyLe1
    modal_tyLe2.value = tyLe2
    modal_tyLe3.value = tyLe3

    $("#slider1").val(tyLe1);
    $("#rangeValue1").text(tyLe1); 
    $("#slider2").val(tyLe2);
    $("#rangeValue2").text(tyLe2);
    $("#slider3").val(tyLe3);
    $("#rangeValue3").text(tyLe3);

    checkTyLe();
  })

  // Fix KCC
  var max_total = 100;
  var min_KCC1 = 30;
  $("#slider1").on("change", function(){
    if(parseInt(this.value,10) < min_KCC1){
      this.value = min_KCC1;
    } 
    checkTyLe();

    var slider1 = this.value;
    var slider2 = $("#slider2").val();
    var slider3 = $("#slider3").val();
    $("#rangeValue1").text(slider1);    
    $("#slider2").prop("value", max_total - slider1 - slider3);
    $("#rangeValue2").text(slider2);
    $("#slider2").change();
  });

  $("#slider2").on("change", function(){
    var slider2 = this.value;
    var slider1 = $("#slider1").val();
    var slider3 = $("#slider3").val();    
    $("#rangeValue2").text(slider2);    
    $("#slider3").prop("value", max_total - slider1 - slider2);
    $("#rangeValue3").text(slider3);
    $("#slider3").change();  
  });
  
  $("#slider3").on("change", function(){
    var slider3 = this.value;
    var slider1 = $("#slider1").val();
    var slider2 = $("#slider2").val();    
    $("#rangeValue3").text(slider3);    
    $("#slider1").prop("value", max_total - slider2 - slider3);
    $("#rangeValue1").text(slider1);
    $("#slider1").change();
  });

  function checkTyLe() {
    var thuNhap = $("#thuNhap").val();
    var tyLe1 = $("#slider1").val();
    var tyLe2 = $("#slider2").val();
    var tyLe3 = $("#slider3").val();
    var tongChi1 = $("#tongChi1").val();
    var tongChi2 = $("#tongChi2").val();
    var tongChi3 = $("#tongChi3").val();

    if ( (thuNhap*tyLe1/100 < tongChi1) || (thuNhap*tyLe2/100 < tongChi2) || (thuNhap*tyLe3/100 < tongChi3) ) {
      $("#fix-alert").css('color', 'red');
      $("#fix-alert").text("Chưa cân đối!");
    } else $("#fix-alert").text("");

    if (thuNhap*tyLe1/100 < tongChi1) $("#KCC1-frame").css('background-color', 'rgb(255, 127, 127, 0.3)');
    else $("#KCC1-frame").css('background-color', 'transparent');
    if (thuNhap*tyLe2/100 < tongChi2) $("#KCC2-frame").css('background-color', 'rgb(255, 127, 127, 0.3)');
    else $("#KCC2-frame").css('background-color', 'transparent');
    if (thuNhap*tyLe3/100 < tongChi3) $("#KCC3-frame").css('background-color', 'rgb(255, 127, 127, 0.3)');
    else $("#KCC3-frame").css('background-color', 'transparent');

  }

  $("#tuDieuChinh").on("click", function(){ 
    var thuNhap = $("#thuNhap").val();
    var tyLe1 = $("#slider1").val();
    var tyLe2 = $("#slider2").val();
    var tyLe3 = $("#slider3").val();
    var tongChi1 = $("#tongChi1").val();
    var tongChi2 = $("#tongChi2").val();
    var tongChi3 = $("#tongChi3").val();

    var tyLeMoi1 = Math.round(tongChi1/thuNhap*100) +1;
    var tyLeMoi2 = Math.round(tongChi2/thuNhap*100) +1;
    var tyLeMoi3 = 100-(tyLeMoi1+tyLeMoi2);

    console.log(tyLeMoi1);
    if ( tyLeMoi1<100 && tyLeMoi2<100 && tyLeMoi3<100 ) {
      $("#slider1").prop("value", tyLeMoi1);
      $("#rangeValue1").text(tyLeMoi1);
      // $("#slider1").change();

      $("#slider2").prop("value", tyLeMoi2);
      $("#rangeValue2").text(tyLeMoi2);
      // $("#slider2").change();

      $("#slider3").prop("value", tyLeMoi3);
      $("#rangeValue3").text(tyLeMoi3);
      // $("#slider3").change();
    }    

    checkTyLe();
    if ( (thuNhap*tyLeMoi1/100 < tongChi1) || (thuNhap*tyLeMoi2/100 < tongChi2) || (thuNhap*tyLeMoi3/100 < tongChi3) ) {
      $("#fix-alert").css('color', 'orange');
      $("#fix-alert").text("Không thể điều chỉnh!");
    } else {
      $("#fix-alert").css('color', 'green');
      $("#fix-alert").text("Tự điều chỉnh thành công!");      
    } 
  });

  
</script>