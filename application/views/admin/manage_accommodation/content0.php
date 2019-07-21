<div class = "page-wrapper">

    <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">จัดการที่พักใกล้แหล่งฝึก</h3>  
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
                                <th scope="col"></th>
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col"></th>
                <th scope="col">ดูที่พักใกล้เคียง</th>
                <th></th>
                </tr>
            </thead>
        <?php
            foreach ($workplaces as $workplace) :?>
                <tr>
                    <td>
                        <?php echo $workplace['workplace_name']; ?>
                    </td>
                    <td></td>
                    <td>
                        <?php echo $workplace['phone']; ?>
                    </td>
                  
                    <td></td>
                    
                    <td>
                   <a  class="btn btn-primary" href="<?=base_url('admin/accommodation?workplace_id='.$workplace['workplace_id']);?>"><i class="fa fa-edit"> ดูที่พักใกล้เคียง</i></a>   
                    </td>
                   
                   
                </tr> 
               
        <?php endforeach;?>
        </table>
    </div>



