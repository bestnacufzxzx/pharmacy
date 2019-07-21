        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลนักศึกษา</h1>
          </div>

          <p class="mb-4">
            <form class="input-group">
                <input type="text" name="search" class="form-control input-default" value="<?=$search?>" placeholder="ค้นหาชื่อหรือนามสกุลนักศึกษา">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search" ></i></button>
                    <!-- <a class="btn btn-success" href="<?php echo base_url("admin/import_student/create");?>" ​​​​​>เพิ่ม</a> -->
                </div>
            </form>
            <br>
              <a class="btn btn-success" href="<?php echo base_url("admin/import_student/import");?>" ​​​​​>นำเข้าข้อมูล</a>
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
                                      <th scope="col">รหัสประจำตัว</th>
                                      <th scope="col">ชื่อ-นามสกุล</th>
                                      <th scope="col"></th>
                                      <th scope="col">ดาวน์โหลด PDF</th>
                                      <th scope="col">แก้ไข</th>
                                      <th></th>
                                      <th></th>

                                      
                                  </tr>
                              </thead>
                          <?php
                              foreach ($students as $student) :?>
                                  <tr id="student-<?=$student['student_id']?>">
                                      <td><?php echo $student['student_id']; ?></td>
                                      <td><?php echo $student['name_title']; ?><?php echo $student['firstname'];?> <?php echo $student['lastname'];?></td>
                                      <td></td> 
                                      <td>        
                                          <form action="<?=base_url("admin/pdf"); ?>" method="post"> 
                                          <input type="hidden" name="studentId" value="<?php echo $student['student_id']; ?>" >
                                              <button type="submit" class="btn btn-success" value="submit" name="submit"><i class="fa fa-book"></i></button> 
                                          </form>
                                      </td>                    
                                    
                                      <td> 
                                          <a href="<?=base_url('admin/import_student/update?id='.$student['student_id'])?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                  
                                          <button type="button" class="btn btn-danger delete" data-id="<?php echo $student['student_id']; ?>" data-firstname="<?php echo $student['firstname']; ?>" data-lastname="<?php echo $student['lastname']; ?>"  data-toggle="modal" data-target="#delete-modal" >
                                              <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                          </button> 
                                      </td> 
                                  </tr> 
                                
                          <?php endforeach;?>
                          </table>
                          <small>นักศึกษาทั้งหมด <?=$total_rows?> คน</small>
                          <?=$links?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ยืนยันการลบ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="student_delete"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>