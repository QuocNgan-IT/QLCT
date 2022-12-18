<div class="d-flex">
  <!--  -->
  <div class="card border border-secondary shadow-0 me-3">
    <div class="card-header bg-primary text-light">
      Ước lượng chi tiêu tháng hiện tại <?php echo date('(m/Y)'); ?>
    </div>
    <div class="card-body" style="min-width: 50vw;">     
      <canvas id="myChart"></canvas>
    </div>
    <div class="card-footer bg-transparent border-secondary">
      Khoản chi chính:       
      <div class="btn-group d-flex">
        <input type="radio" class="btn-check" name="time" id="1" value="1" onclick="showGraph(this.value)" checked autocomplete="off" />
        <label class="btn btn-secondary text-primary fw-bold" for="1">Thiết yếu</label>

        <input type="radio" class="btn-check" name="time" id="2" value="2" onclick="showGraph(this.value)" autocomplete="off" />
        <label class="btn btn-secondary text-info fw-bold" for="2">Linh hoạt</label>

        <input type="radio" class="btn-check" name="time" id="3" value="3" onclick="showGraph(this.value)" autocomplete="off" />
        <label class="btn btn-secondary text-success fw-bold" for="3">Tiết kiệm, đầu tư</label>
      </div>
    </div>
  </div>

  <!--  -->
  <div class="card border border-secondary shadow-0 me-3">
    <div id="tenKCC" class="card-header bg-primary  text-uppercase text-center text-light">
      Chi tiết
    </div>
    <div class="card-body" style="min-width: 25vw;">
      <blockquote class="blockquote mb-0">
        <div style="font-size: smaller;">
          <i class="fas fa-money-bill-wave-alt pe-1"></i>
          Ngân sách:
          <div id="nganSach" class="text-success text-end"></div>
        </div>
        <div style="font-size: smaller;">
          <i class="fas fa-hand-holding-usd pe-1"></i>
          Đã chi: 
          <div id="tongChi" class="text-success text-end"></div>
        </div>
        <div style="font-size: smaller;">
          <i class="fas fa-hand-holding-usd pe-1"></i>
          Chi tiêu trung bình: 
          <div class="row text-end">
            <div id="chiTB" class="col text-success"></div>
            <!-- <div class="col">
              ~ <span id="chiTBngay" class="text-success"></span>/ngày
            </div> -->
          </div>          
        </div><hr>
        <div style="font-size: smaller;">
          <i class="far fa-lightbulb pe-1"></i>
          Ước lượng chi tiêu cả tháng: 
          <div id="uocLuong" class="text-success text-end"></div>
        </div>
        <div style="font-size: smaller;">
          <i class="fab fa-think-peaks pe-1"></i>
          Dự đoán: 
          <div id="duDoan" class="fw-bolder fs-5 text-uppercase text-end"></div>
        </div><hr>
        <div style="font-size: smaller;">
          <i class='fas fa-lightbulb pe-1'></i> Gợi ý: 
          <div id="goiY" class="text-primary text-center"></div>
        </div>
      </blockquote>
    </div>
  </div>
  
</div>

<script>
  $(document).ready(function () {
    $.post("data_uocluong.php?KCC=1",
      function (data){
        console.log(data);
        var ngay_chi = [], so_tien = [], uoc_luong = [];
        for (var i=0; i<data.length-1; i++) {
          ngay_chi.push(data[i].ngay);
          uoc_luong.push(data[i].so_tien);          
        }
        for (var i=0; i<data.length-2; i++) {
          // ngay_chi.push(data[i].ngay);
          so_tien.push(data[i].so_tien);          
        }
        
        var detail = data[data.length-1];
        console.log(detail);
        $("#tenKCC").text(detail.ten_KCC);
        $("#nganSach").text(toPrice(detail.ngan_sach));
        $("#tongChi").text(toPrice(detail.tong_chi)); 
        $("#chiTB").text(toPrice(detail.chi_tb)); 
        $("#chiTBngay").text(toPrice(detail.chi_tb_ngay)); 
        $("#uocLuong").text(toPrice(data[data.length-2].so_tien));
        $("#duDoan").text(detail.du_doan);
        $("#duDoan").css('color', detail.color);
        $("#goiY").html(detail.goi_y).val();

        var options = {
          maintainAspectRatio: false,
          scales: {            
            y: {
              stacked: false,
              ticks: {
                beginAtZero: true
              }
            }
          }
        };

        var myChart = {
          labels: ngay_chi,
          datasets: [
            {
              label: "Chi tiêu",
              backgroundColor: 'rgba(54, 162, 235, 0.4)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: so_tien
            },
            {
              label: "Chi tiêu ước lượng",
              backgroundColor: detail.color,
              borderColor: detail.color,
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: uoc_luong
            }
          ]
        };

        var lineGraph = new Chart($("#myChart"), {
          type: 'line',
          data: myChart,
          options: options
        });
      });
  });

  function toPrice(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + 'đ';
  }
  function showGraph(KCC){ 
    let chartStatus = Chart.getChart("myChart");
    if (chartStatus != undefined) {
      chartStatus.destroy();
    }
    $.post("data_uocluong.php?KCC="+KCC,
      function (data){
        console.log(data);
        var ngay_chi = [], so_tien = [], uoc_luong = [];
        for (var i=0; i<data.length-1; i++) {
          ngay_chi.push(data[i].ngay);
          uoc_luong.push(data[i].so_tien);          
        }
        for (var i=0; i<data.length-2; i++) {
          // ngay_chi.push(data[i].ngay);
          so_tien.push(data[i].so_tien);          
        }
        
        var detail = data[data.length-1];
        console.log(detail);
        $("#tenKCC").text(detail.ten_KCC);
        $("#nganSach").text(toPrice(detail.ngan_sach));
        $("#tongChi").text(toPrice(detail.tong_chi)); 
        $("#chiTB").text(toPrice(detail.chi_tb)); 
        $("#chiTBngay").text(toPrice(detail.chi_tb_ngay)); 
        $("#uocLuong").text(toPrice(data[data.length-2].so_tien));
        $("#duDoan").text(detail.du_doan);
        $("#duDoan").css('color', detail.color);  
        $("#goiY").html(detail.goi_y).val();
        
        var options = {
          maintainAspectRatio: false,
          scales: {            
            y: {
              ticks: {
                beginAtZero: true
              }
            }
          }
        };

        var myChart = {
          labels: ngay_chi,
          datasets: [
            {
              label: "Chi tiêu",
              backgroundColor: 'rgba(54, 162, 235, 0.4)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: so_tien
            },
            {
              label: "Chi tiêu ước lượng",
              backgroundColor: detail.color,
              borderColor: detail.color,
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: uoc_luong
            }
          ]
        };

        lineGraph = new Chart($("#myChart"), {
          type: 'line',
          data: myChart,
          options: options
        });
      });
  }
</script>