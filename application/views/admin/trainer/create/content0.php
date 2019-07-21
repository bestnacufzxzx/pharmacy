<div class="page-wrapper">
    <div class="card card-outline">
    <div class="container-fluid">
        <form id="add-trainer">
            <div class="card-header">
                <h4>
                <?php
                    if($isCreate){
                        echo "เพิ่มข้อมูลพนักงานที่ปรึกษา";
                    }else{
                        echo "แก้ไขข้อมูลพนักงานที่ปรึกษา";
                    }
                ?>
                </h4>
            </div><br>
            <div class="form-row">
        
                <div class="form-group col-md-4">
                <?php
                    if(!$isCreate):
                ?>
                    <input type="hidden" name="trainer_id" value="<?=$trainer->trainer_id?>">
                <?php                
                    endif
                ?>
                <label>คำนาหน้าชื่อ</label><span class="error">*</span>
                      <div class="form-inline">
                        <select class="form-control col-md-12" name="name_title" id="name_title" >

                        <option value="">คำนำหน้าชื่อ</option>
                            <option value="นาย" <?=(isset($trainer) && $trainer->name_title =='นาย')?'selected':''?>>นาย</option>
                            <option value="นาง" <?=(isset($trainer) && $trainer->name_title =='นาง')?'selected':''?>>นาง</option>
                            <option value="นางสาว" <?=(isset($trainer) && $trainer->name_title =='นางสาว')?'selected':''?> >นางสาว</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>ชื่อ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="กรุณากรอกชื่อ" value="<?=(isset($trainer))?$trainer->firstname:''?>">
                </div>
                <div class="form-group col-md-4">
                    <label>นามสกุล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="กรุณากรอกนามสกุล" value="<?=(isset($trainer))?$trainer->lastname:''?>">
                </div>
                
                
                
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ตำแหน่งงาน</label><span class="error">*</span>
                    <input type="text" class="form-control" name="job_position" id="job_position" placeholder="กรุณากรอกตำแหน่งงาน" value="<?=(isset($trainer))?$trainer->job_position:''?>">
                </div> 
                <div class="form-group col-md-4">
                    <label>เบอร์โทรศัพท์มือถือ  </label><span class="error">*</span>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="กรุณากรอก เบอร์โทรศัพท์" value="<?=(isset($trainer))?$trainer->phone:''?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Email  </label><span class="error">*</span>
                    <input type="text" class="form-control" name="email" id="email" placeholder="กรุณากรอก Email" value="<?=(isset($trainer))?$trainer->email:''?>">
                </div>
                
            </div>

                <div class="card-header">
                <h4>กำหนดสิทธิ์ผู้ใช้งาน</h4>
                </div><br>

                <div class="form-row">  
                    <div class="form-group col-md-2">
                        <label>ชื่อผู้ใช้งาน</label><span class="error">*</span>
                        <input type="text" class="form-control" name="username"  id="username" placeholder="กรุณากรอกชื่อผู้ใช้งาน" value="<?=(isset($user))?$user->username:''?>">
                    </div> 
                    <div class="form-group col-md-2">
                        <label>รหัสผ่าน</label><span class="error">*</span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" value="">
                    </div>
                    
                    
                </div>

                                
            <button type="button" id="save" class="btn btn-success">
            บันทึก
            </button>
            <a href="<?php echo base_url("admin/trainer/info_trainer");?>" ​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>
        </form>
    </div>
    </div> 
</div>