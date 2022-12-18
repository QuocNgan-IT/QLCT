<!-- Modal Add -->
<?php
include_once("action.php");
?>
<!-- Add modal -->
  <div 
    class="modal fade" 
    id="addModal" 
    data-mdb-backdrop="static" 
    data-mdb-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="addModalLabel" 
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary" id="addModalLabel">Thêm khoản chi tiêu</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add-form" method="POST" class="needs-validation" novalidate>
          <div class="modal-body">
            <!-- Khoản chi chính -->
            <div class="form-outline mb-3">
              <span class="form-label">Khoản chi chính</span>
              <div class="btn-group d-flex">
                <input type="radio" class="btn-check" name="ma_kcc" id="kcc1" value="1" autocomplete="off" checked />
                <label class="btn btn-secondary text-primary fw-bold" for="kcc1">Thiết yếu</label>

                <input type="radio" class="btn-check" name="ma_kcc" id="kcc2" value="2" autocomplete="off" />
                <label class="btn btn-secondary text-info fw-bold" for="kcc2">Linh hoạt</label>

                <input type="radio" class="btn-check" name="ma_kcc" id="kcc3" value="3" autocomplete="off" />
                <label class="btn btn-secondary text-success fw-bold" for="kcc3">Tiết kiệm, đầu tư</label>
              </div>
            </div>  
            <!-- Tên kc -->
            <div class="form-outline mb-3">
              <input 
                type="text" 
                name="ten_kct" 
                class="form-control form-control-lg" 
                required
              />
              <label class="form-label" for="ten_kct">Tên khoản chi</label>
            </div>
            <!-- Số tiền -->
            <div class="form-outline input-group mb-3">
              <input
                type="text"
                name="tien_kct" 
                aria-describedby="basic-addon"
                class="form-control number-separator-add" 
                required 
                style="height: 45px;"
              />
              <input type="hidden" id="trueResult_add" name="true_tien_kct">
              <span class="input-group-text" id="basic-addon" style="height: 45px;">000đ</span>
              <label class="form-label" for="tien_kct">Số tiền</label>
            </div>
                    
            <!-- Mô tả -->
            <div class="form-outline mb-0">
              <textarea 
                type="textarea" 
                rows="4"
                name="mota_kct" 
                class="form-control" 
              ></textarea>
              <label class="form-label" for="mota_kct">Mô tả</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="add_kct" class="btn btn-primary">Thêm</button>
            <div class="loader"></div>
          </div>
        </form>   
      </div>
    </div>
  </div>

<!-- Edit modal -->
  <div 
    class="modal fade" 
    id="editModal" 
    data-mdb-backdrop="static" 
    data-mdb-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="editModalLabel" 
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary" id="editModalLabel">Thay đổi khoản chi tiêu</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" class="needs-validation" novalidate>
          
          <div class="modal-body">
            <!--  -->
            <input type="hidden" id="maKct" name="ma_kct_edit">
            <input type="hidden" id="maKcc" name="ma_kcc_edit">
            <!-- Tên kc -->
            <div class="form-outline mb-3">
              <input 
                type="text" 
                id="tenKct"
                name="ten_kct_edit" 
                class="form-control form-control-lg" 
                value=""
                required
              />
              <label class="form-label" for="ten_kct_edit">Tên khoản chi</label>
            </div>
            <!-- Số tiền -->
            <div class="form-outline input-group mb-3">
              <input
                type="text"
                id="tienKct"
                name="tien_kct_edit" 
                aria-describedby="basic-addon"
                class="form-control number-separator-edit" 
                required 
                style="height: 45px;"
              />
              <input type="hidden" id="trueResult_edit" name="true_tien_kct_edit">
              <span class="input-group-text" id="basic-addon" style="height: 45px;">000đ</span>
              <label class="form-label" for="tien_kct_edit">Số tiền</label>
            </div>
                    
            <!-- Mô tả -->
            <div class="form-outline mb-0">
              <textarea 
                type="textarea" 
                rows="4"
                id="motaKct"
                name="mota_kct_edit" 
                class="form-control" 
              ></textarea>
              <label class="form-label" for="mota_kct_edit">Mô tả</label>
            </div>
          </div>
          
          <div class="modal-footer justify-content-between">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="updateTime" name="updateTime" />
              <label class="form-check-label" for="updateTime"> Cập nhật thời gian </label>
            </div>
            <button type="submit" name="edit_kct" class="btn btn-primary">Thay đổi</button>
          </div>
        </form>   
      </div>
    </div>
  </div>

<!-- Delete modal -->
  <div 
    class="modal fade" 
    id="deleteModal" 
    data-mdb-backdrop="static" 
    data-mdb-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="deleteModalLabel" 
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary" id="deleteModalLabel">Xóa khoản chi tiêu</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST">
          
          <div class="modal-body">
            <!--  -->
            <input type="hidden" id="maKctXoa" name="ma_kct_delete">
            <input type="hidden" id="maKccXoa" name="ma_kcc_delete">
            <!-- Tên kc -->
            <div class="form-outline mb-3">
              <input 
                type="text" 
                id="tenKctXoa"
                class="form-control form-control-lg" 
                value=""
                disabled
              />
              <label class="form-label" for="tenKctXoa">Tên khoản chi</label>
            </div>
            <!-- Số tiền -->
            <div class="form-outline input-group mb-3">
              <input
                type="text"
                id="tienKctXoa"
                aria-describedby="basic-addon"
                class="form-control number-separator" 
                disabled 
                style="height: 45px;"
              />
              <span class="input-group-text" id="basic-addon" style="height: 45px;">000đ</span>
              <label class="form-label" for="tienKctXoa">Số tiền</label>
            </div>
                    
            <!-- Mô tả -->
            <div class="form-outline mb-3">
              <textarea 
                type="textarea" 
                rows="4"
                id="motaKctXoa"
                class="form-control" 
                disabled
              ></textarea>
              <label class="form-label" for="motaKctXoa">Mô tả</label>
            </div>
            <!-- Ngày chi -->
            <div class=" mb-0">
              Ngày chi: <span id="ngayChiKct"></span> 
            </div>
          </div>          
          
          <div class="modal-footer justify-content-center">
            <button type="submit" name="delete_kct" class="btn btn-danger">Xác nhận xóa</button>
          </div>
        </form>   
      </div>
    </div>
  </div>

<!-- Fix KCC modal  -->
  <div 
    class="modal fade" 
    id="fixModal" 
    data-mdb-backdrop="static" 
    data-mdb-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="fixModalLabel" 
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary" id="fixModalLabel">Điều chỉnh tỷ lệ&nbsp;</h5>
          <i 
            class='fa fa-info-circle' 
            style='color: rgb(76, 76, 76, 0.5)'
            data-mdb-toggle="tooltip"
            title="Điểu chỉnh lần lượt từ trên xuống"
          ></i>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" class="needs-validation" novalidate>
          
          <div class="modal-body">
            
            <div id="KCC1-frame" class="form-outline mb-4 p-2 d-flex border border-primary border-2 rounded-5 text-primary">
              <div 
                class="w-100" 
                data-mdb-toggle="tooltip"
                data-mdb-placement="left" 
                title="Tối thiểu 30% mức thu nhập"
              >
                <label class="form-label text-primary font-weight-bold" for="slider1">Khoản chi thiết yếu</label>
                <div class="range">
                  <input class="form-range" id='slider1' name="tyLe1" type='range' min='1' max='100' value=''/>            
                </div>
              </div>
              <span id="rangeValue1" style="width: 2rem;"><i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i></span>%
            </div>
            
            <div id="KCC2-frame" class="form-outline mb-4 p-2 d-flex  border border-success border-2 rounded-5 text-success">
              <div 
                class="w-100" 
              >
                <label class="form-label text-success font-weight-bold" for="slider2">Khoản chi linh hoạt</label>
                <div class="range">
                  <input class="form-range" id='slider2' name="tyLe2" type='range' min='1' max='100' value=''/>            
                </div>
              </div>
              <span id="rangeValue2" style="width: 2rem;"><i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i></span>%
            </div>
            
            <div id="KCC3-frame" class="form-outline mb-4 p-2 d-flex border border-info border-2 rounded-5 text-info">
              <div 
                class="w-100" 
              >
                <label class="form-label text-info font-weight-bold" for="slider3">Khoản tiết kiệm, đầu tư</label>
                <div class="range">
                  <input class="form-range" id='slider3' name="tyLe3" type='range' min='1' max='100' value=''/>            
                </div>
              </div>
              <span id="rangeValue3" style="width: 2rem;"><i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i></span>%
            </div>

            <input type="hidden" id="thuNhap" name="thuNhap">
            <input type="hidden" id="tongChi1">
            <input type="hidden" id="tongChi2">
            <input type="hidden" id="tongChi3">
            <input type="hidden" id="tyLe1">
            <input type="hidden" id="tyLe2">
            <input type="hidden" id="tyLe3">

          <div class="d-flex justify-content-center">
            <span id="fix-alert"></span>
          </div>
          <div class="modal-footer justify-content-around">
            <button id="tuDieuChinh" type="button" name="fix_tyLe" class="btn btn-info">Tự điều chỉnh</button>
            <button type="submit" name="fix_tyLe" class="btn btn-primary">Thay đổi</button>
          </div>
        </form>   
      </div>
    </div>
  </div>