<div class="d-flex">
  <!--  -->
  <div class="card border border-secondary shadow-0 me-3">
    <div class="card-header bg-primary text-light">
      Thống kê chung
    </div>
    <div class="card-body"  style="min-width: 50vw;">    
      <canvas id="myChart"></canvas>
    </div>
    <div class="card-footer bg-transparent border-secondary">
      Xem theo:       
      <div class="btn-group d-flex" >
        <input type="radio" class="btn-check" name="time" id="day" value="day" onclick="showGraph(this.value)" checked autocomplete="off" />
        <label 
          class="btn btn-secondary text-primary fw-bold" 
          for="day" 
          data-mdb-toggle="tooltip"
          title="Các ngày trong tháng hiện tại" >
            Ngày
        </label>

        <input type="radio" class="btn-check" name="time" id="week" value="week" onclick="showGraph(this.value)" autocomplete="off" />
        <label 
          class="btn btn-secondary text-primary fw-bold" 
          for="week" 
          data-mdb-toggle="tooltip"
          title="Các tuần trong tháng hiện tại" >
            Tuần
        </label>

        <input type="radio" class="btn-check" name="time" id="month" value="month" onclick="showGraph(this.value)" autocomplete="off" />
        <label 
          class="btn btn-secondary text-primary fw-bold" 
          for="month" 
          data-mdb-toggle="tooltip"
          title="Các tháng trong năm hiện tại" >
            Tháng
        </label>
      </div>
    </div>
  </div>

  <!--  -->
  <div class="card border border-secondary shadow-0 me-3">
    <div class="card-header bg-primary text-light">
      Chi tiết
    </div>
  <div class="card-body" style="min-width: 27vw;">
    <blockquote class="blockquote mb-0">
        <div class="d-flex justify-content-between" style="font-size: smaller;">
          <span>
            <i class="fas fa-money-bill-alt pe-1"></i>
            Thu nhập:
          </span>          
          <div id="thuNhap" class="text-success"></div>
        </div>
        <div class="d-flex justify-content-between" style="font-size: smaller;">
          <span>
            <i class="fas fa-hand-holding-usd pe-1"></i>
            Tổng chi tiêu: 
          </span>          
          <div id="tongChiChung" class="text-success"></div>
        </div><hr>
        <div style="font-size: smaller;">
          <div class="fw-bolder text-primary fs-6 text-uppercase">
            Khoản chi thiết yếu
          </div><br>
          <div>
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-money-bill-wave-alt pe-1"></i>
                Ngân sách:
              </span> 
              <div id="nganSach1" class="text-success"></div>
            </div>              
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-hand-holding-usd pe-1"></i>
                Đã chi:
              </span> 
              <div id="daChi1" class="text-success"></div>
            </div>  
          </div>                  
        </div><hr>

        <div style="font-size: smaller;">
          <div class="fw-bolder text-info fs-6 text-uppercase">
            Khoản chi linh hoạt
          </div><br>
          <div>
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-money-bill-wave-alt pe-1"></i>
                Ngân sách:
              </span> 
              <div id="nganSach2" class="text-success"></div>
            </div>              
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-hand-holding-usd pe-1"></i>
                Đã chi:
              </span> 
              <div id="daChi2" class="text-success"></div>
            </div>  
          </div>                  
        </div><hr>

        <div style="font-size: smaller;">
          <div class="fw-bolder text-success fs-6 text-uppercase">
            Khoản tiết kiệm, đầu tư
          </div><br>
          <div>
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-money-bill-wave-alt pe-1"></i>
                Ngân sách:
              </span> 
              <div id="nganSach3" class="text-success"></div>
            </div>              
            <div class="d-flex justify-content-between ps-2">
              <span>
                <i class="fas fa-hand-holding-usd pe-1"></i>
                Đã chi:
              </span> 
              <div id="daChi3" class="text-success"></div>
            </div>  
          </div>                  
        </div>
        
      </blockquote>
    </div>
  </div>
  
</div>
<br>
<br><br>

<script>
  $(document).ready(function () {
    $.post("data_thongke.php?period=",
      function (data){
        console.log(data);
        var ngay_chi = [], so_tien = [];
        for (var i=0; i<data.length-1; i++) {
          ngay_chi.push(data[i].ngay);
          so_tien.push(data[i].so_tien);          
        }
        var detail = data[data.length-1];
        console.log(detail);
        $("#thuNhap").text(toPrice(detail.thu_nhap));
        $("#tongChiChung").text(toPrice(detail.tong_chi_chung));
        $("#nganSach1").text(toPrice(detail.ngan_sach1));
        $("#daChi1").text(toPrice(detail.tong_chi1));
        $("#nganSach2").text(toPrice(detail.ngan_sach2));
        $("#daChi2").text(toPrice(detail.tong_chi2));
        $("#nganSach3").text(toPrice(detail.ngan_sach3));
        $("#daChi3").text(toPrice(detail.tong_chi3));
        
        if(detail.tong_chi_chung > detail.thu_nhap) $("#tongChiChung").attr('style', 'color: #DC4C64 !important');
        if(detail.tong_chi1 > detail.ngan_sach1) $("#daChi1").attr('style', 'color: #DC4C64 !important');
        if(detail.tong_chi2 > detail.ngan_sach2) $("#daChi2").attr('style', 'color: #DC4C64 !important');
        if(detail.tong_chi3 > detail.ngan_sach3) $("#daChi3").attr('style', 'color: #DC4C64 !important');

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
              label: "Tổng chi tiêu",
              backgroundColor: 'rgba(54, 162, 235, 0.3)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: so_tien,
              datalabels: {
                color: 'rgba(54, 162, 235, 1)',
                anchor: 'start',
                align: 'top',
                formatter: function(value) {
                  return '';
                  // return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + ' đ';
                }
              }
            }
          ]
        };

        var barGraph = new Chart($("#myChart"), {
          type: 'bar',
          data: myChart,
          plugins: [ChartDataLabels],
          options: options
        });
      });
  });

  function toPrice(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + 'đ';
  }
  function showGraph(period){ 
    let chartStatus = Chart.getChart("myChart");
    if (chartStatus != undefined) {
      chartStatus.destroy();
    }
    $.post("data_thongke.php?period="+period,
      function (data){
        console.log(data);
        var ngay_chi = [], so_tien = [];
        for (var i=0; i<data.length-1; i++) {
          ngay_chi.push(data[i].ngay);
          so_tien.push(data[i].so_tien);          
        }

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
              label: "Tổng chi tiêu",
              backgroundColor: 'rgba(54, 162, 235, 0.3)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              hoverBorderWidth: 3,
              data: so_tien,
              datalabels: {
                color: 'rgba(54, 162, 235, 1)',
                anchor: 'start',
                align: 'top',
                formatter: function(value) {
                  if(period === 'day') return '';
                  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + ' đ';
                }
              }
            }
          ]
        };

        barGraph = new Chart($("#myChart"), {
          type: 'bar',
          data: myChart,
          plugins: [ChartDataLabels],
          options: options
        });
      });
  }
</script>