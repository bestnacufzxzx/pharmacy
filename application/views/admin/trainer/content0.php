<div class = "page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">ข้อมูลแหล่งฝึก</h3>  
            </div>
        </div>

<div class="container-fluid">
    <form class="input-group">
        <input type="text" name="search" class="form-control input-default" id="workplace-search" value="<?=$search?>" placeholder="ค้นหาชื่อแหล่งฝึก">
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit"><i class="ti-search" ></i></button>
        </div>
    </form>               
        
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ชื่อแหล่งฝึก</th>
                <th scope="col">อีเมล์</th>
                <th scope="col">ข้อมูลพนักงานที่ปรึกษา</th>
                <th></th>
                </tr>
            </thead>
        <tbody>
        <?php
            foreach ($workplaces as $workplace) :?>
                <tr id="workplace-<?=$workplace['workplace_id']?>">
                    <td><?php echo $workplace['workplace_name']; ?></td>
                    <td><?php echo $workplace['email']; ?></td>
                    <td>
                        <a href="<?=base_url('admin/trainer/info_trainer?workplace_id='.$workplace['workplace_id'])?>" class="btn btn-primary"><i class="fa fa-file-text-o"></i></a>        
                    </td>
                    <td></td>
                </tr>
            <?php endforeach;?>
        </tbody>
        </table>
        <small>แหล่งฝึกทั้งหมด <?=$total_rows?> แห่ง</small>
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
