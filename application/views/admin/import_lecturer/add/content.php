        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                  <?php
                      if($isCreate){
                          echo "เพิ่มข้อมูลอาจารย์";
                      }else{
                          echo "แก้ไขข้อมูลอาจารย์";
                      }
                  ?>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                    <form id="add-lecturer">
                      <div class="form-row">
                  
                        <div class="form-group col-md-2">
                          <?php
                              if(!$isCreate):
                          ?>
                              <input type="hidden" name="lecturer_id" value="<?=$lecturer->lecturer_id?>">
                          <?php                
                              endif
                          ?>
                          <label>คำนาหน้าชื่อ</label><span class="error">*</span>
                                <div class="form-inline">
                                  <select class="form-control col-md-12" name="name_title" id="name_title" >

                                  <option value="">คำนำหน้าชื่อ</option>
                                      <option value="อาจารย์" <?=(isset($lecturer) && $lecturer->name_title =='อาจารย์')?'selected':''?>>อาจารย์</option>
                                      <option value="อาจารย์ ดร." <?=(isset($lecturer) && $lecturer->name_title =='อาจารย์ ดร.')?'selected':''?>>อาจารย์ ดร.</option>
                                      <option value="รศ." <?=(isset($lecturer) && $lecturer->name_title =='รศ.')?'selected':''?> >รศ.</option>
                                      <option value="ผศ." <?=(isset($lecturer) && $lecturer->name_title =='ผศ.')?'selected':''?>>ผศ.</option>
                                      <option value="ผศ.ดร." <?=(isset($lecturer) && $lecturer->name_title =='ผศ.ดร.')?'selected':''?>>ผศ.ดร.</option>
                                      <option value="รศ.นพ. " <?=(isset($lecturer) && $lecturer->name_title =='รศ.นพ.')?'selected':''?>>รศ.นพ. </option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group col-md-2">
                              <label>ชื่อ</label><span class="error">*</span>
                              <input type="text" class="form-control" name="firstname" id="firstname" placeholder="กรุณากรอกชื่อ" value="<?=(isset($lecturer))?$lecturer->firstname:''?>">
                          </div>
                          <div class="form-group col-md-2">
                              <label>นามสกุล</label><span class="error">*</span>
                              <input type="text" class="form-control" name="lastname" id="lastname" placeholder="กรุณากรอกนามสกุล" value="<?=(isset($lecturer))?$lecturer->lastname:''?>">
                          </div>
                          <div class="form-group col-md-2">
                              <label>วัน/เดือน/ปี เกิด </label><span class="error">*</span>
                              <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="กรุณากรอก วัน/เดือน/ปี เกิด" value="<?=(isset($lecturer))?$lecturer->date_of_birth:''?>">
                          </div>
                          <div class="form-group col-md-2">
                              <label>Email  </label><span class="error">*</span>
                              <input type="text" class="form-control" name="email" id="email" placeholder="กรุณากรอก Email" value="<?=(isset($lecturer))?$lecturer->email:''?>">
                          </div>
                          
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>สาขา </label><span class="error">*</span>
                                <select class="form-control" name="course_id" id="course_id">
                                    <?php foreach ($courses as $course) : ?>
                                        <?php if($lecturer != null){ if ($course['course_id'] == $lecturer->course_id) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = 'selected';
                                                }
                                            }else{
                                                $selected = '';
                                            }
                                        echo '<option value="' . $course['course_id'] . '" '.$selected.'>' . $course['course_name'] . '</option>';?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>เบอร์โทรศัพท์ที่ติดต่อได้</label><span class="error">*</span>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="กรุณากรอกเบอร์โทรศัพท์ที่ติดต่อได้" value="<?=(isset($lecturer))?$lecturer->phone:''?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>เบอร์โทรศัพท์มือถือ </label><span class="error">*</span>
                                <input type="text" class="form-control" name="phone2"  id="phone2" placeholder="กรุณากรอกเบอร์โทรศัพท์มือถือ" value="<?=(isset($lecturer))?$lecturer->phone2:''?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>ที่อยู่ติดต่อ </label><span class="error">*</span>
                                <input type="text" class="form-control" name="address" id="address" placeholder="กรุณากรอกที่อยู่" value="<?=(isset($lecturer))?$lecturer->address:''?>">
                            </div>
                        </div>

                        <div class="form-row">  
                            <div class="form-group col-md-2">
                                <label>ตำบล</label><span class="error">*</span>
                                <input type="text" class="form-control" name="sub_district" id="district"placeholder="กรุณากรอกตำบล" value="<?=(isset($lecturer))?$lecturer->sub_district:''?>">
                            </div> 
                            <div class="form-group col-md-2">
                                <label>อำเภอ</label><span class="error">*</span>
                                <input type="text" class="form-control" name="district" id="amphoe"placeholder="กรุณากรอกอำเภอ" value="<?=(isset($lecturer))?$lecturer->district:''?>">
                            </div> 
                            <div class="form-group col-md-2">
                                <label>จังหวัด</label><span class="error">*</span>
                                <input type="text" class="form-control" name="province" id="province"placeholder="กรุณากรอกจังหวัด" value="<?=(isset($lecturer))?$lecturer->province:''?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>รหัสไปรษณีย์</label><span class="error">*</span>
                                <input type="text" class="form-control" name="zipcode" id="zipcode"placeholder="กรุณากรอกรหัสไปรษณีย์" value="<?=(isset($lecturer))?$lecturer->zipcode:''?>">
                            </div>
                        </div>

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
                                       
                      <button type="button" id="save" class="btn btn-success">
                      บันทึก
                      </button>
                      <a href="<?php echo base_url("admin/import_lecturer");?>" ​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->