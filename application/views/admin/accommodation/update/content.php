        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขที่พัก</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                    <form id=workplace-form>
                        <div class="row">
                                <div class="form-group col-md-4">
                                    <label>ชื่อที่พัก</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="accommodation_name" id="accommodation_name" placeholder="กรุณากรอกชื่อที่พัก" value="<?=$accommodations->accommodation_name?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ชื่อผู้ติดต่อ</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="กรุณากรอกชื่อผู้ติดต่อ" value="<?=$accommodations->contact_name?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>เบอโทรศัพท์</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="กรุณากรอกเบอร์โทรศัพท์" value="<?=$accommodations->tel?>">
                                </div>
                            </div>

                            <div class="form-row">  
                                <div class="form-group col-md-2">
                                    <label>ที่อยู่</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="กรุณากรอกที่อยู่" value="<?=$accommodations->address?>">
                                </div> 
                                <div class="form-group col-md-2">
                                    <label>ตำบล</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="sub_district" id="district"placeholder="กรุณากรอกตำบล" value="<?=$accommodations->district?>">
                                </div> 
                                <div class="form-group col-md-2">
                                    <label>อำเภอ</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="district" id="amphoe"placeholder="กรุณากรอกอำเภอ"  value="<?=$accommodations->district?>">
                                </div> 
                                <div class="form-group col-md-2">
                                    <label>จังหวัด</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="province" id="province"placeholder="กรุณากรอกจังหวัด" value="<?=$accommodations->province?>">
                                </div> 
                                <div class="form-group col-md-2">
                                    <label>รหัสไปรษณีย์</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode"placeholder="กรุณากรอกรหัสไปรษรีย์" value="<?=$accommodations->zipcode?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label>รายละเอียด</label><span class="error">*</span>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="กรุณากรอกรายละเอียด" value="<?=$accommodations->description?>">
                                </div>
                            </div>
                          


                            <input type="hidden" name="accommodation_id" value="<?=$accommodations->accommodation_id?>">

                
                        
                    
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        </button><a href="<?php echo base_url('admin/accommodation?workplace_id='.$accommodations->workplace_id);?>"​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>                 
                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->