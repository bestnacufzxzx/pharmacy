        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">นำเข้าข้อมูลอาจารย์</h1>
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
                                <a href="<?=base_url("public/upload/file/lecturer.csv")?>" download>
                                <button type="button" class="btn btn-warning"><i class="fa fa-download"></i> ดาวน์โหลดไฟล์ตัวอย่าง .csv</button></a>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    แสดงข้อมูล
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->