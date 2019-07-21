        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลแหล่งฝึก</h1>
          </div>

          <p class="mb-4">
            <form class="input-group">
                <input type="text" name="search" class="form-control input-default" id="workplace-search" value="<?=$search?>" placeholder="ค้นหาชื่อแหล่งฝึก">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search" ></i></button>
                    <a class="btn btn-success" href="<?php echo base_url("admin/workplace/create");?>" ​​​​​>เพิ่ม</a>
                </div>
                <div class="col-lg-3">
                    <a class="btn btn-success" href="<?php echo base_url("admin/workplace/workplaceType");?>" ​​​​​>จัดการประเภทแหล่งฝึก</a>
                </div>
            </form>
          </p>

        <!-- Content Row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ชื่อแหล่งฝึก</th>
                        <th scope="col">เบอร์โทรศัพท์</th>
                        <th scope="col">แก้ไขแหล่งฝึก</th>
                        <th></th>
                        </tr>
                    </thead>
                      <tbody>
                        <?php foreach ($workplaces as $workplace) :?>
                            <tr id="workplace-<?=$workplace['workplace_id']?>">
                                <td><?php echo $workplace['workplace_name']; ?></td>
                                <td><?php echo $workplace['phone']; ?></td>
                            
                                <td>
                                    <a href="<?=base_url('admin/workplace/update?id='.$workplace['workplace_id'])?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger delete" data-id="<?php echo $workplace['workplace_id']; ?>" data-workplace_name="<?php echo $workplace['workplace_name']; ?>"  data-toggle="modal" data-target="#delete-modal">
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

        <!-- Delete Modal -->
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
                            <div id="workplace_delete"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- /.container-fluid -->