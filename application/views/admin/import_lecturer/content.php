        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลอาจารย์</h1>
          </div>

          <p class="mb-4">
            <form class="input-group">
                <input type="text" name="search" class="form-control input-default" id="lecturer-search" value="<?=$search?>" placeholder="ค้นหาชื่อหรือนามสกุลอาจารย์">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search" ></i></button>
                    <a class="btn btn-success" href="<?php echo base_url("admin/import_lecturer/create");?>" ​​​​​>เพิ่ม</a>
                </div>
            </form>
            <br>
              <a class="btn btn-success" href="<?php echo base_url("admin/import_lecturer/import");?>" ​​​​​>นำเข้าข้อมูล</a>
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
                                <th scope="col">คำนำหน้าชื่อ</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">นามสกุล</th>
                                <th scope="col">อีเมล์</th>
                                <th scope="col">แก้ไข</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lecturers as $lecturer) :?>
                                <tr id="lecturer-<?=$lecturer['lecturer_id']?>">
                                    <td><?php echo $lecturer['name_title'];?></td>
                                    <td><?php echo $lecturer['firstname'];?></td>
                                    <td><?php echo $lecturer['lastname'];?></td>
                                    <td><?php echo $lecturer['email'];?></td>
                                    <td>
                                        <a href="<?=base_url('admin/import_lecturer/update?id='.$lecturer['lecturer_id'])?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger delete" data-id="<?php echo $lecturer['lecturer_id']; ?>" data-firstname="<?php echo $lecturer['firstname']; ?>" data-lastname="<?php echo $lecturer['lastname']; ?>"  data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td></td>
                                </tr> 
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                            <div id="lecturer_delete"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>