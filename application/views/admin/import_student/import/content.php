        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">นำเข้าข้อมูลนักศึกษา</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <form id="form">
                      <div class="row justify-content-md-center">
                          <div class="col-md-5">
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="file" required>
                                  <label class="custom-file-label" for="validatedCustomFile">เลือกไฟล์...</label>
                                  <small>เลือกไฟล์ .csv เท่านั้น</small>
                                  <small id="response"></small>
                              </div>         
                          </div>
                          <div class="col-md-3">
                              <a href="<?=base_url("public/upload/file/student.csv")?>" download>
                              <button type="button" class="btn btn-warning"><i class="fa fa-download"></i> ดาวน์โหลดไฟล์ตัวอย่าง .csv</button></a>
                          </div>
                          <div class="col-md-2">
                              <button type="submit" class="btn btn-success btn-block">
                                  แสดงข้อมูล
                              </button>
                          </div>
                      </div>
                  </form>
                  <br>

                  <div class="alert alert-success" role="alert" style="display:none" id="alertSuccess">
                      <span id="spanSuccess"></span>
                      <a href="<?=base_url("admin/import_lecturer")?>"><button type="button" class="btn btn-danger">กลับ</button></a>
                  </div>
                  <div class="alert alert-danger" role="alert" style="display:none" id="alertDuplicate">
                      <span id="duplicate"></span>
                      <br/>
                      <a href="<?=base_url("admin/import_student")?>"><button type="button" class="btn btn-danger">กลับ</button></a>
                  </div>
            
                  <br>
                  <div class="row">
                      <div class="col-md-12" id="parsed_csv_list">
                          
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->