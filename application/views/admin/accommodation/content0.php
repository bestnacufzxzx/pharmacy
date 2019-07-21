<div class = "page-wrapper">

<div class="row page-titles">
    <div class="align-self-center">
        <h3 class="text-primary">จัดการที่พักใกล้แหล่งฝึกของ <?php echo $workplace->workplace_name; ?>  </h3>  
    </div>
</div>              
    
    <div class="container-fluid">
    <div class="row p-30">  
        <div class="col-lg-6">
            <form action="<?=base_url("admin/accommodation/?workplace_id=").$workplace->workplace_id?>" method="post">
                <div class="input-group input-group-flat">
                    <label class="col-lg-3 col-form-label">ค้นหาที่พัก : </label>
                    <input type="text" name="search" class="form-control input-default" id="accommodation-search" placeholder="ค้นหาที่พัก...">
                    <span class="input-group-btn"><button class="btn btn-success" type="submit" id="btn-search" style="height: 42px"><i class="ti-search" ></i></button></span>
                </div>
            </form>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" href="<?=base_url("admin/accommodation/add?workplace_id=$workplace->workplace_id")?>" ​​​​​>เพิ่มที่พัก</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
            <th></th>
            <th scope="col">ชื่อที่พัก</th>
            <th scope="col">ผู้ประสานงาน</th>
            <th scope="col">เบอโทรศัพท์</th>
            <th scope="col">แก้ไข</th>
            <th></th>
           
            </tr>
        </thead>
        <?php foreach ($accommodations as $accommodation):?>
            <tr>
                <td></td>
                <td><?php echo $accommodation['accommodation_name']; ?></td>
                <td><?php echo $accommodation['contact_name']; ?></td>
                <td><?php echo $accommodation['tel']; ?></td>
                <td> 
                    <form action="<?=base_url("admin/accommodation/update?accommodation_id=".$accommodation['accommodation_id']); ?>" method="post">
                     <input type="hidden" name="accommodationId" value="<?php echo $accommodation['accommodation_id']; ?>" >
                         <button type="submit" class="btn btn-primary"  value="submit" name="submit" ><i class="fa fa-edit" ></i></button>

                         <button type="button" class="btn btn-danger delete"  data-workplace_id="<?php echo $accommodation['workplace_id']; ?>" data-id="<?php echo $accommodation['accommodation_id']; ?>" data-name="<?php echo $accommodation['accommodation_name']; ?>" data-toggle="modal" data-target="#delete-modal">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>

                   
                </td> 
            </tr> 
           
            <?php endforeach;?>
    </table>
</div>
</form>
</div>
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
                    <div id="accommodation_delete"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                </div>
            </div>
        </form>
    </div>
</div>


