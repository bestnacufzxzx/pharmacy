<div class = "page-wrapper">

    <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">ข้อมูลแหล่งฝึก</h3>  
    </div>
</div>

<div class="container-fluid">
        <div class="row p-30">  
            <div class="col-lg-4">
                <form>
                    <div class="input-group input-group-flat">
                        <label class="col-lg-5 col-form-label">ค้นหาแหล่งฝึก : </label>
                        <input type="text" class="form-control input-default" id="lecturer-search" name="search" value="<?=$s?>" placeholder="ค้นหา...">
                        <span class="input-group-btn"><button class="btn btn-success" type="submit" id="btn-search" style="height: 42px"><i class="ti-search" ></i></button></span>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-flat">
                    <label class="col-lg-3 col-form-label">จัดเรียง: </label>
                    <select class="form-control input-default" name="column" id="column">
                        <option value="1">เรียงลำดับจาก ก-ฮ</option>
                        <option value="2">เรียงลำดับจาก ฮ-ก</option>
                        <option value="3">เรียงลำดับจาก สถานะ</option>
                    </select>
                </div>
            </div>
        </div>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ชื่อแหล่งฝึก</th>
                <th scope="col">เบอโทรศัพท์</th>
                <th scope="col" class="d-flex justify-content-center">จัดการเปิดรับ</th>
                <th scope="col"></th>
                <th></th>
                </tr>
            </thead>
        <?php
            foreach ($workplaces as $workplace) :?>
                <tr>
                    
                    <td>
                        <?php echo $workplace['workplace_name']; ?>
                    </td>

                    <td>
                        <?php echo $workplace['phone']; ?>
                    </td>
                    <td class="d-flex justify-content-around">
                        <a href="<?=base_url("admin/set_receive_detail/receive_detail?workplace_id=".$workplace['workplace_id']."&schedule=1&course_id=1"); ?>" class="btn btn-success" >SCI</a>
                        <a href="<?=base_url("admin/set_receive_detail/receive_detail?workplace_id=".$workplace['workplace_id']."&schedule=1&course_id=2"); ?>" class="btn btn-success" >CARE</i></a>
                    </td>
                    <td></td>
                    <td></td>
                </tr> 
                <form class="form-horizontal" action="<?=base_url("admin/workplace/deleteWorkplace"); ?>" method="post" id="deleteWorkplaces">
                        <input type="hidden" id="workplaceId" name="workplaceIds" value="" >
                </form>
                                     
        <?php endforeach;?>
        </table>
    </div>
</div>
