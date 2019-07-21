        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลการลงทะเบียน</h1>
          </div>

          <p class="mb-4">
            <div class="row p-30">  
                <div class="col-lg-5">
                    <div class="input-group input-group-flat">
                        <label class="col-lg-5 col-form-label">ค้นหา : </label>
                        <input type="text" class="form-control input-default" id="search" placeholder="ค้นหา...">
                        <span class="input-group-btn"><button class="btn btn-success" type="button" id="btn-search" style="height: auto"><i class="fas fa-search" ></i></button></span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="input-group input-group-flat">
                        <label class="col-lg-3 col-form-label">เลือกวิชา: </label>
                        <select class="form-control input-default" name="column" id="column">
                        <?php foreach($subjects as $subject):?>
                            <option value="1"><?= $subject['subject_code']?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
              <a class="btn btn-success" href="<?php echo base_url("admin/import_enroll/import");?>" ​​​​​>นำเข้าข้อมูล</a>
            <br/>  
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th scope="col">รหัสนักศึกษา</th>
                              <th scope="col">ชื่อ-นามสกุล</th>
                              <th scope="col">อีเมล์</th>
                              <th scope="col">จัดการ</th>
                              <td></td>
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($students as $student): ?>
                          <tr>
                              <td><?= $student['student_id']?></td>
                              <td><?= $student['name_title']." ".$student['firstname']." ".$student['lastname']?></td>
                              <td><?= $student['email']?></td>
                              <td>
                                  <!-- <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
                                  <button type="button" class="btn btn-danger delete">
                                      <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                  </button>
                              </td>
                              <td></td>
                          </tr> 
                      <?php endforeach; ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->