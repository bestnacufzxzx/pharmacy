        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการประเภทการฝึก <?= ($course_id==1)?'(SCI)':'(CARE)'?></h1>
          </div>

          <p class="mb-4">
            <div class="d-flex flex-row-reverse">
              <div class="p-2">
                  <button type="button" class="btn btn-primary" id="addModal">เพิ่มประเภทการฝึก</button>
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
                                <th scope="col">ประเภทที่</th>
                                <th scope="col">ประเภทการฝึก</th>
                                <td></td>
                            </tr>
                        </thead>
                    <?php
                        foreach ($trainingTypes as $trainingTypes) :?>
                            <tr id="trainingType-<?php echo $trainingTypes['training_type_id'];?>">
                                <td><?php echo $trainingTypes['training_type_id']; ?></td>
                                <td><?php echo $trainingTypes['training_type_name'];?></td>
                                <td>
                                    <button class="btn btn-primary update" type="button"  name="update" data-id="<?php echo $trainingTypes['training_type_id'];?>" data-training-type-name="<?= $trainingTypes['training_type_name'];?>" data-toggle="modal" data-target="#add-modal"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger deleteTrainingType" data-id="<?php echo $trainingTypes['training_type_id'];?>" data-courseid="<?php echo $trainingTypes['course_id'];?>"  data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
                <form id="addTrainingType">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ประเภทการฝึก</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" class="form-control" id="course_id" name="course_id" value="<?= $course_id ?>">
                                    <input type="text" class="form-control" id="trainingType" name="trainingType" placeholder="โปรดระบุประเภทการฝึก" required autofocus>
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
                            <div id="training_type"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
