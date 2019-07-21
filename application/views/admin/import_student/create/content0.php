<div class="page-wrapper">
    <div class="card card-outline">
    <div class="container-fluid">
        <form id="student-form">
            <div class="card-header">
                <h4>
                    <?php
                        if($isCreate){
                            echo "เพิ่มข้อมูลนักศึกษา";
                        }else{
                            echo "แก้ไขข้อมูลนักศึกษา";
                        }
                    ?>
                </h4>
            </div><br>
        <form id="student-form">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>คำนำหน้าชื่อ</label><span class="error">*</span>
                    <div class="form-inline">
                        <select class="form-control col-md-12" name="name_title" id="name_title" >
                            <option value="">คำนำหน้าชื่อ</option>
                            <option value="นาย" <?=(isset($student) && $student->name_title =='นาย')?'selected':''?>>นาย</option>
                            <option value="นางสาว" <?=(isset($student) && $student->name_title =='นางสาว')?'selected':''?>>นางสาว</option>
                            <option value="นาง" <?=(isset($student) && $student->name_title =='นาง')?'selected':''?>>นาง</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label>ชื่อ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="กรุณากรอกชื่อ" value="<?=(isset($student))?$student->firstname:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>นามสกุล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="กรุณากรอกนามสกุล" value="<?=(isset($student))?$student->lastname:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>ชื่อเล่น</label><span class="error">*</span>
                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="กรุณากรอกชื่อเล่น" value="<?=(isset($student))?$student->nickname:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>รหัสประจำตัวนักศึกษา</label><span class="error">*</span>
                    <input type="number" class="form-control" name="student_id" id="student_id"  placeholder="กรุณากรอกรหัสนักศึกษา" value="<?=(isset($student))?$student->student_id:''?>">
                </div>

                 <div class="form-group col-md-3">
                    <label>เลขที่บัตรประชาชน</label><span class="error">*</span>
                    <input type="number" class="form-control" name="id_card" id="id_card" placeholder="กรุณากรอกเลขที่บัตรประชาชน" value="<?=(isset($student))?$student->id_card:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>วัน เดือน ปี เกิด</label><span class="error">*</span>
                    <input type="date" name="date_of_birth" id="date_of_birth" max="" min="1000-01-01" class="form-control" value="<?=(isset($student))?$student->date_of_birth:''?>">
                </div>

                <div class="form-group col-md-2">
                    <label>เป็นบุตรคนที่</label><span class="error">*</span>
                    <input type="text" class="form-control" name="member_in_family" id="member_in_family" placeholder="เป็นบุตรคนที่" value="<?=(isset($student))?$student->member_in_family:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>จากจำนวน</label><span class="error">*</span>
                    <input type="text" class="form-control" name="member_all_family" id="member_all_family" placeholder="จากจำนวนพี่น้องทั้งหมด" value="<?=(isset($student))?$student->member_all_family:''?>">
                </div>
            </div>
            <div class="form-row">
               
                 <div class="form-group col-md-4">
                    <label>โรคประจำตัว</label><span class="error">*</span>
                    <textarea name="congenital_disease" id="congenital_disease" rows="4" cols="80" class="form-control" style="height:60px" placeholder="กรุณากรอกโรคประจำตัว"><?=(isset($student))?$student->congenital_disease:''?></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label>ประวัติการแพ้ยา</label><span class="error">*</span>
                    <textarea name="allergy_history" id="allergy_history" rows="4" cols="80" class="form-control" style="height:60px"  placeholder="กรุณากรอกประวัติการแพ้ยา"><?=(isset($student))?$student->allergy_history:''?></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label>งานอดิเรก</label><span class="error">*</span>
                    <textarea name="hobbies" id="hobbies" rows="4" cols="80" class="form-control" style="height:60px"  placeholder="กรุณากรอกงานอดิเรก"><?=(isset($student))?$student->hobbies:''?></textarea>
                </div>
            </div>

            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ความสามารถพิเศษ</label><span class="error">*</span>
                    <textarea name="talent" id="talent" rows="4" cols="80" class="form-control" style="height:60px"  placeholder="กรุณากรอกความสามารถพิเศษ"><?=(isset($student))?$student->talent:''?></textarea>
                </div>

                <div class="form-group col-md-4">
                    <label>อุปนิสัยส่วนตัว</label><span class="error">*</span>
                    <textarea name="trait" id="trait" rows="4" cols="80" class="form-control" style="height:60px" placeholder="กรุณากรอกอุปนิสัยส่วนตัว"><?=(isset($student))?$student->trait:''?></textarea>
                </div>
                
            
            </div>

            <div class="card-header">
                <h4>ข้อมูลติดต่อ</h4>
            </div><br>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ที่อยู่</label><span class="error">*(บ้านเลขที่ , หมู่ที่ , ถนน , ซอย)</span>
                    <input type="text" class="form-control" name="address" id="address" placeholder="กรุณากรอกที่อยู่" value="<?=(isset($student))?$student->address:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>ตำบล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="sub_district" id="district" placeholder="กรุณากรอกตำบล" value="<?=(isset($student))?$student->sub_district:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>อำเภอ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="district" id="amphoe" placeholder="กรุณากรอกอำเภอ" value="<?=(isset($student))?$student->district:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>จังหวัด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="province" id="province" placeholder="กรุณากรอกจังหวัด" value="<?=(isset($student))?$student->province:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>รหัสไปรษณีย์</label><span class="error">*</span>
                    <input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="กรุณากรอกรหัสไปรษณีย์" value="<?=(isset($student))?$student->zipcode:''?>">
                </div>
             </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>เบอร์โทรศัพท์มือถือ</label><span class="error">*</span>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="กรุณากรอกเบอร์โทรศัพท์มือถือ" value="<?=(isset($student))?$student->phone:''?>">
                </div>

                <div class="form-group col-md-3">
                    <label>อีเมล์</label><span class="error">*</span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="กรุณากรอกอีเมล์" value="<?=(isset($student))?$student->email:''?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ชื่อและที่อยู่ของผู้ที่จะติดต่อกรณีฉุกเฉิน</label><span class="error">*</span>
                    <input type="text" class="form-control" name="address_emergency" id="address_emergency" placeholder="ชื่อและที่อยู่ของผู้ที่จะติดต่อกรณีฉุกเฉิน" value="<?=(isset($student))?$student->phone:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>ตำบล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="sub_district_emergency" id="district1" placeholder="กรุณากรอกตำบล" value="<?=(isset($student))?$student->sub_district_emergency:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>อำเภอ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="district_emergency" id="amphoe1" placeholder="กรุณากรอกอำเภอ" value="<?=(isset($student))?$student->district_emergency:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>จังหวัด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="province_emergency" id="province1" placeholder="กรุณากรอกจังหวัด" value="<?=(isset($student))?$student->province_emergency:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>รหัสไปรษณีย์</label><span class="error">*</span>
                    <input type="number" class="form-control" name="zipcode_emergency" id="zipcode1" placeholder="กรุณากรอกรหัสไปรษณีย์" value="<?=(isset($student))?$student->zipcode_emergency:''?>">
                </div>
            </div>


            <div class="card-header">
                <h4>ข้อมูลผู้ปกครอง</h4>
            </div><br>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>ชื่อ-นามสกุลบิดา</label><span class="error">*</span>
                    <input type="text" class="form-control" name="father_name" id="father_name" placeholder="กรุณากรอกชื่อ-นามสกุลบิดา" value="<?=(isset($student))?$student->father_name:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>อาชีพบิดา</label><span class="error">*</span>
                    <input type="text" class="form-control" name="father_job" id="father_job" placeholder="กรุณากรอกอาชีพบิดา" value="<?=(isset($student))?$student->father_job:''?>">
                </div>
                <div class="form-group col-md-1"></div>      
                <div class="form-group col-md-3">
                    <label>ชื่อ-นามสกุลมารดา</label><span class="error">*</span>
                    <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="กรุณากรอกชื่อ-นามสกุลมารดา" value="<?=(isset($student))?$student->mother_name:''?>">
                </div>

                <div class="form-group col-md-2">
                    <label>อาชีพมารดา</label><span class="error">*</span>
                    <input type="text" class="form-control" name="mother_job" id="mother_job" placeholder="กรุณากรอกอาชีพมารดา" value="<?=(isset($student))?$student->mother_job:''?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ที่อยู่</label><span class="error">*(บ้านเลขที่ , หมู่ที่ , ถนน , ซอย)</span>
                    <input type="text" class="form-control" name="address_parent" id="address_parent" placeholder="กรุณากรอกที่อยู่" value="<?=(isset($student))?$student->address_parent:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>ตำบล</label><span class="error">*</span>
                    <input type="text" class="form-control" name="sub_district_parent" id="district2"placeholder="กรุณากรอกตำบล" value="<?=(isset($student))?$student->sub_district_parent:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>อำเภอ</label><span class="error">*</span>
                    <input type="text" class="form-control" name="district_parent" id="amphoe2"placeholder="กรุณากรอกอำเภอ" value="<?=(isset($student))?$student->district_parent:''?>">
                </div> 
                <div class="form-group col-md-2">
                    <label>จังหวัด</label><span class="error">*</span>
                    <input type="text" class="form-control" name="province_parent" id="province2"placeholder="กรุณากรอกจังหวัด" value="<?=(isset($student))?$student->province_parent:''?>">
                </div>
                <div class="form-group col-md-2">
                    <label>รหัสไปรษณีย์</label><span class="error">*</span>
                    <input type="number" class="form-control" name="zipcode_parent" id="zipcode2"placeholder="กรุณากรอกรหัสไปรษณีย์" value="<?=(isset($student))?$student->zipcode_parent:''?>">
                </div>
             </div>
            <div class="form-row">
               <div class="form-group col-md-2">
                   <label>เบอร์โทรศัพท์บิดา</label><span class="error">*</span>
                   <input type="number" class="form-control" name="phone_father" id="phone_father" placeholder="กรุณากรอกเบอร์โทรศัพท์บิดา" value="<?=(isset($student))?$student->phone_father:''?>">
               </div>

               <div class="form-group col-md-2">
                   <label>เบอร์โทรศัพท์มารดา</label><span class="error">*</span>
                   <input type="number" class="form-control" name="phone_mother" id="phone_mother" placeholder="กรุณากรอกเบอร์โทรศัพท์มารดา" value="<?=(isset($student))?$student->phone_mother:''?>">
               </div>
           </div>
            <input type="hidden" name="yearId" id="yearId" value="2" >                        
            <div class="row">
                <div class="col-6">
                    <div class="card-header mb-2">
                        <h4>กำหนดสิทธิ์ผู้ใช้งาน</h4>
                    </div>
                    <div class="form-row">  
                        <div class="form-group col-md-6">
                            <label>ชื่อผู้ใช้งาน</label><span class="error">*</span>
                            <input type="text" class="form-control" name="username"  id="username" placeholder="กรุณากรอกชื่อผู้ใช้งาน" value="<?=(isset($user))?$user->username:''?>">
                        </div> 
                        <div class="form-group col-md-6">
                            <label>รหัสผ่าน</label><span class="error">*</span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" value="">
                        </div> 
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-header mb-2">
                        <h4>กำหนดรูปโปรไฟล์</h4>
                    </div>
                    <div class="form-row">  
                        <div class="form-group col-md-8">
                            <label>รูปโปรไฟล์</label><span class="error">*</span>
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

            <button type="button" id="save" class="btn btn-success">บันทึก</button>
            </button><a href="<?php echo base_url("admin/import_student");?>" ​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>
        
        </form>
    </div>
    </div>
   
</div>