<div class="page-wrapper">
    <div class="card card-outline">
    <div class="container-fluid">
        <form id="add-workplace">
            <div class="card-header">
                <h4>
                <?php
                    if($isCreate){
                        echo "เพิ่มข้อมูลแหล่งฝึก";
                    }else{
                        echo "แก้ไขข้อมูลแหล่งฝึก";
                    }
                ?>
                </h4>
            </div><br>
            <div class="form-row">
                <div class="">
                <?php
                    if(!$isCreate):
                ?>
                    <input type="hidden" name="workplace_id" value="<?=$workplace->workplace_id?>">
                <?php                
                    endif
                ?></div>
                    <div class="form-group col-md-4">
                        <label>ชื่อแหล่งฝึก</label><span class="error">*</span>
                        <input type="text" class="form-control" name="workplace_name" id="workplace_name" placeholder="กรุณากรอกชื่อแหล่งฝึก" value="<?=(isset($workplace))?$workplace->workplace_name:''?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>เว็บไซต์ของบริษัท(ถ้ามี)</label>
                        <input type="text" class="form-control" name="website" id="website" placeholder="กรุณากรอกเว็บไซต์แหล่งฝึก" value="<?=(isset($workplace))?$workplace->website:''?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Email</label><span class="error">*</span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="กรุณากรอกอีเมล" value="<?=(isset($workplace))?$workplace->email:''?>">
                    </div>
                </div>
            
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>โทรศัพท์</label><span class="error">*</span>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="กรุณากรอกเบอร์โทรศัพท์" value="<?=(isset($workplace))?$workplace->phone:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>โทรสาร</label>
                    <input type="text" class="form-control" name="fax" id="fax" placeholder="กรุณากรอกหมายเลขโทรสาร" value="<?=(isset($workplace))?$workplace->fax:''?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ที่อยู่</label></label><span class="error">*</span>
                    <input type="text" class="form-control" name="address" id="address" placeholder="กรุณากรอกที่อยู่แหล่งฝึก" value="<?=(isset($workplace))?$workplace->address:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>ตำบล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="sub_district" id="district" placeholder="กรุณากรอกตำบล" value="<?=(isset($workplace))?$workplace->sub_district:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>อำเภอ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="district" id="amphoe" placeholder="กรุณากรอกอำเภอ" value="<?=(isset($workplace))?$workplace->district:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>จังหวัด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="province" id="province"placeholder="กรุณากรอกจังหวัด" value="<?=(isset($workplace))?$workplace->province:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>รหัสไปรษณีย์</label><span class="error">*</span>
                    <input type="text" class="form-control" name="zipcode" id="zipcode"placeholder="กรุณากรอกรหัสไปรษณีย์" value="<?=(isset($workplace))?$workplace->zipcode:''?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>ละติจูด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="latitude" id="latitude"placeholder="กรุณากรอกละติจูด" value="<?=(isset($workplace))?$workplace->latitude:''?>">  
                </div>
                <div class="form-group col-md-2">
                    <label>ลองติจูด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="longitude" id="longitude"placeholder="กรุณากรอกลองติจูด" value="<?=(isset($workplace))?$workplace->longitude:''?>">
                </div>
                <div class="form-group col-md-1">
                    <label>กดรับพิกัด</label><span class="error"></span>
                    <button type="button" class="btn btn-primary" id="coordinates" name="coordinates">พิกัด</button>
                </div>
                <!-- <input type="hidden" name="yearId" id="yearId" value="2" > -->
               
                <div class="form-group col-md-2">
                <label >เลือกชนิดแหล่งฝึก</label><span class="error">*</span>
                <div class="form-inline">
                        <select class="form-control col-md-12" name="workplace_type_id" id="workplace_type_id">
                            <option value="">เลือกชนิดแหล่งฝึก</option>
                            <?php foreach ($workplace_types as $workplace_type) :?>
                                <?php if ($workplace_type['workplace_type_id'] == $workplace->workplace_type_id) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                echo '<option value="' . $workplace_type['workplace_type_id'] . '" '.$selected.'>' . $workplace_type['workplace_type_name'] . '</option>';?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div> 
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ชื่อผู้บริหารสำหรับอนุญาต</label><span class="error">*</span>
                    <input type="text" class="form-control" name="manager_name" id="manager_name"placeholder="กรุณากรอกชื่อผู้บริหาร" value="<?=(isset($workplace))?$workplace->manager_name:''?>">
                </div>
                <div class="form-group col-md-4">
                    <label>ตำแหน่ง</label><span class="error">*</span>
                    <input type="text" class="form-control" name="job_position" id="job_position"placeholder="กรุณากรอกตำแหน่ง" value="<?=(isset($workplace))?$workplace->job_position:''?>">
                </div>     
                
                <div class="col-6">
                <div class="card-header mb-2">
                        <h4>อัพโหลดรูปสถานที่แหล่งฝึก</h4>
                    </div>
                    <div class="form-row">  
                        <div class="form-group col-md-8">
                            <label>รูปสถานที่แหล่งฝึก</label><span class="error">*</span>
                            <input type="file" class="form-control" name="profile"  id="profile" placeholder="อัพโหลด" accept="image/jpg, image/jpeg, image/png">
                        </div> 
                        <div class="form-group col-md-4">
                            <div style="width: 100%;">
                                <img class="card-img-top" id="preview" src="<?=(isset($user->picture) && trim($user->picture) != '' ?base_url($user->picture):'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png')?>" alt="Card image cap">
                            </div>
                        </div> 
                </div>
            </div>
            </div>


           

            <button type="button" id="save" class="btn btn-success"> 
            บันทึก
            </button><a href="<?php echo base_url("admin/workplace");?>" ​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>
        


        </form>
    
    </div>
    </div>
</div>