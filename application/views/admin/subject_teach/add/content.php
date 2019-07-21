        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">เพิ่มรายวิชาของปีการศึกษา</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <form id="subject_teach-form">
            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-4">
                  <div class="card-body">
                      
                    <div class="container">
                        <div class="form-row">
                          <div class="form-group col-5"> เลือกวิชา:
                              <select  name="subject_id" id="subject_id" class="form-control">
                                    <option value="">กรุณาเลือกวิชา</option>
                                    <?php foreach($subjects as $subject):?>
                                    <option value="<?= $subject['subject_id']?>" ><?= $subject['subject_code']?> <?= $subject['subject_name']?></option>
                                    <?php endforeach;?>
                              </select>
                          </div>
                        </div>
                          
                        <div class="form-row">
                              <div class="col-3">
                                คะแนนการนำเสนอ:
                                    <input type="number"   name="percent_present" id="sum1"  class="form-control percent" placeholder="กรุณากรอกคะแนนนำเสนอ" onkeyup="sum();">
                              </div> 
                              <div class="col-3">
                                คะแนนรายงาน:
                                    <input type="number" name="percent_report" id="sum2" class="form-control percent" placeholder="กรุณากรอกคะแนนรายงาน" onkeyup="sum();">
                              </div> 
                              <div class="col-3">
                                คะแนนจากแหล่งฝึก:
                                    <input type="number" name="percent_trainer" id="sum3" class="form-control percent" placeholder="กรุณากรอกคะแนนแหล่งฝึก" onkeyup="sum();">
                              </div> 
                              <div class="col-3">
                                คะแนนรวม (100 คะแนน)
                                <input type="text" id="textthree" class="form-control"  name="sumout" placeholder="" readonly>
                              </div>      
                        </div>

                        
                        <br>
                          <div class="card" style="width: -webkit-fill-available;">
                            <div class="container">
                              <h5 class="card-title">เลือกอาจารย์</h5>
                              <div class="row">
                                  <?php foreach ($lecturers as $lecturer) :?>
                                      <div class="col-3"><input type="checkbox" name="lecturer[]" value="<?php echo $lecturer['lecturer_id'];?>">  <?php echo $lecturer['name_title'];?> <?php echo $lecturer['firstname'];?> <?php echo $lecturer['lastname'];?></div>                                       
                                  <?php endforeach;?>
                              </div>
                            </div>
                          </div>
                        <br/>
                 

                        <div class="form-row">
                          <button type="button" id="save" class="btn btn-success">บันทึก</button>
                          </button><a href="<?php echo base_url('admin/subject_teach?course_id='.$course_id);?>" ​​​​​><button type="button" class="btn btn-cancle">ยกเลิก</button></a>       
                        </div>
                      </div>  
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.container-fluid -->