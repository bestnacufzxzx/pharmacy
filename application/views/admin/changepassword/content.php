        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="page-wrapper">
                  <body>    
                      <form id="changepassword-form" >
                      <div class="form-row">
                          <div class="form-group col-md-4">
                          </div>  
                          <div class="form-group col-md-5">
                              <div class="card container col-md-8">
                                  <br><h4 class="text-center">แก้ไขรหัสผ่าน</h4>
                                  <div class="form-group md-6"><br>
                                      <label>ชื่อผู้ใช้งาน</label>
                                      <input type="text" class="form-control" name="username" id="username" readonly  value="<?=$user->username ?>">
                                  </div>
                                  <div class="form-group md-6">
                                      <label>รหัสผ่านใหม่</label>
                                      <input type="password" class="form-control" name="password" id="password" placeholder="กรุณากรอกรหัสผ่านใหม่" >
                                  </div>
                                  <button type="submit"  id="update"class="btn btn-info">บันทึก</button>
                                  <button type="submit" class="btn btn-cancle"> <a href="<?php echo base_url("admin/changepassword");?>" ​​​​​>ยกเลิก</button><br>
                              </div>    
                          </div>
                          <div class="form-group col-md-3">
                          </div>
                      </div>
                      </form>
                  </body> 
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->