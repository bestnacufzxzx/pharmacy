<div class = "page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">ข้อมูลพนักงานที่ปรึกษาที่นำออกจากระบบ</h3>  
            </div>
        </div>

<div class="container-fluid">

    <form class="input-group">
        <input type="text" name="search" class="form-control input-default" id="trainer-search" value="<?=$search?>" placeholder="ค้นหาชื่อพนักงานที่ปรึกษา">
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit"><i class="ti-search" ></i></button>
        </div>
    </form>          
        
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">คำนำหน้า</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">ตำแหน่งงาน</th>
                <th>แก้ไข</th>
                <th></th>
                </tr>
            </thead>
        <tbody>
        <?php
            foreach ($trainers as $trainer) :?>
                <tr id="trainer-<?=$trainer['firstname']?>">
                    <td><?php echo $trainer['name_title']; ?></td>
                    <td><?php echo $trainer['firstname']; ?></td>
                    <td><?php echo $trainer['lastname']; ?></td>
                    <td><?php echo $trainer['job_position']; ?></td>
                    <td>
                        <a href="<?=base_url('admin/trainer/update?id='.$trainer['trainer_id'])?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger delete" data-id="<?php echo $trainer['trainer_id']; ?>" data-firstname="<?php echo $trainer['firstname']; ?>" data-lastname="<?php echo $trainer['lastname']; ?>"  data-toggle="modal" data-target="#delete-modal">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>    
                        <button class="btn btn-success recycle" data-id="<?=$trainer['trainer_id']; ?>" data-firstname="<?=$trainer['firstname']; ?>" data-lastname="<?=$trainer['lastname']; ?>" data-toggle="modal" data-target="#recycle-modal" ><i class="fa fa-recycle" aria-hidden="true"></i></button>
                    </td>
                    <td></td>
                </tr>
            <?php endforeach;?>
        </tbody>
        </table>
        <small>พนักงานที่ปรึกษาทั้งหมด <?=$total_rows?> คน</small>
        <?=$links?>
        
    </div>
</div> 
   

<!-- Delete Modal -->
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
                    <div id="trainer_delete"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal" id="recycle-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการนำพนักงานเข้าสู่ระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="trainer_recycle"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-recycle" name="confirm-recycle" class="btn btn-success">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
</div>
