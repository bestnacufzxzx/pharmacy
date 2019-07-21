<div class = "page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">ข้อมูลพนักงานที่ปรึกษา</h3>  
            </div>
            <div class="col-md-7 align-self-center d-flex flex-row-reverse">
                <a class="btn btn-primary" href="<?=base_url('admin/trainer/deleted?workplace_id='.$workplace_id)?>">พนักงานที่ถูกลบจากระบบ</a> 
            </div>
        </div>

<div class="container-fluid">

    <form class="input-group">
        <input type="text" name="search" class="form-control input-default" id="trainer-search" value="<?=$search?>" placeholder="ค้นหาชื่อพนักงานที่ปรึกษา">
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit"><i class="ti-search" ></i></button>
            <a class="btn btn-success" href="<?php echo base_url('admin/trainer/create?workplace_id='.$workplace_id)?>" ​​​​​>เพิ่ม</a>
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
                <th>ปิดสถานะการใช้งาน</th>
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
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete" data-id="<?php echo $trainer['trainer_id']; ?>" data-firstname="<?php echo $trainer['firstname']; ?>" data-lastname="<?php echo $trainer['lastname']; ?>"  data-toggle="modal" data-target="#delete-modal">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
        </table>
        <small>แหล่งฝึกทั้งหมด <?=$total_rows?> คน</small>
        <?=$links?>
        
    </div>
</div> 
   

<!-- Delete Modal -->
<div class="modal" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการปิดการใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="trainer_delete"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ปิดการใช้งาน</button>
                </div>
            </div>
        </form>
    </div>
</div>
