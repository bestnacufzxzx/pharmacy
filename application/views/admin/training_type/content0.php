<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">จัดการประเภทการฝึก <?= ($course_id==1)?'(SCI)':'(CARE)'?></h3>  
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <button type="button" class="btn btn-primary" id="addModal">เพิ่มประเภทการฝึก</button>
            </div>
        </div>
        
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
                        <button type="button" class="btn btn-danger deleteTrainingType" data-id="<?php echo $trainingTypes['training_type_id'];?>" data-courseid="<?php echo $trainingTypes['course_id'];?>"  data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
                </tr> 
            <?php endforeach;?>
        </table>
        
    </div>
</div>

<div class="modal" id="add-modal" tabindex="-1" role="dialog">
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

<div class="modal" id="delete-modal" tabindex="-1" role="dialog">
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



