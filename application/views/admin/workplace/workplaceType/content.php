        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการประเภทแหล่งฝึก</h1>
            
          </div>

          <p class="mb-4">
            <div class="d-flex flex-row-reverse">
              <div class="p-2">
                  <button type="button" class="btn btn-primary" onclick="addModal()">เพิ่มประเภทแหล่งฝึก</button>
              </div>
            </div>
          </p>

          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ลำดับที่</th>
                        <th scope="col">ประเภทแหล่งฝึก</th>
                        <th></th>
                        <th></th>
                        <th scope="col">แก้ไขประเภทแหล่งฝึก</th>
                        <th></th>
                      
                        </tr>
                    </thead>
                      <?php
                          foreach ($workplace_types as $key=>$workplace_type) :?>
                      
                                  <td><?php echo $key+1?></td>
                                  <td><?php echo $workplace_type['workplace_type_name'];?></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                      <button class="btn btn-primary" onclick="updateModal('<?php echo $workplace_type['workplace_type_id']; ?>','<?php echo $workplace_type['workplace_type_name']; ?>')" type="button" id="update"  name="update"><i class="fa fa-edit"></i></button>
                                      <button type="button" class="btn btn-danger deleteWorkplaceType" data-id="<?php echo $workplace_type['workplace_type_id'];?>" data-name="<?php echo $workplace_type['workplace_type_name'];?>"  data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                  </td>
                                  
                              </tr> 
                      <?php endforeach;?>
                    </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form id="addWorkplaceType">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เพิ่มประเภทการฝึก</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="workplace_type_name" name="workplace_type_name" placeholder="โปรดระบุประเภทการฝึก" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="add" name="add" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                            <div id="workplace_type"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form id="updateWorkplaceType" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">แก้ไขประเภทแหล่งฝึก</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control" id="workplaceTypeName" name="workplace_type_name" placeholder="โปรดระบุประเภทแหล่งฝึก" required autofocus>
                                </div>
                                <input type="hidden" id="workplaceTypeId" name="workplace_type_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-update" name="confirm-update" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>