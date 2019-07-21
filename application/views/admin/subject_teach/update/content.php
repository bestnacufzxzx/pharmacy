        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขรายวิชาของปีการศึกษา</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <form id="subject_teach-form">
            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h4>แก้ไขรายวิชาของปีการศึกษา <h4> 
                    <h5><?= $subject_for_update->subject_code.' '.$subject_for_update->subject_name?></h5>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <input type="hidden" name="subject_id" value="<?= $subject_for_update->subject_id?>">    
                        <div class="row">
                          <div class="col-3">
                          คะแนนการนำเสนอ:
                              <input type="number" name="percent_present" id="sum1"  class="form-control" value="<?= $subject_teachs->percent_present?>" placeholder="กรุณากรอกคะแนนการนำเสนอ" onkeyup="sum();">
                          </div> 
                          <div class="col-3">
                          คะแนนรายงาน:
                              <input type="number" name="percent_report" id="sum2" class="form-control" value="<?= $subject_teachs->percent_report?>" placeholder="กรุณากรอกคะแนนรายงาน" onkeyup="sum();">
                          </div> 
                          <div class="col-3">
                          คะแนนจากแหล่งฝึก:
                              <input type="number" name="percent_trainer" id="sum3" class="form-control" value="<?= $subject_teachs->percent_trainer?>" placeholder="กรุณากรอกคะแนนจากแหล่งฝึก" onkeyup="sum();">
                          </div> 

                          <div class="col-3">
                          คะแนนรวม (100 คะแนน)
                              <input type="text" id="textthree" class="form-control"  name="sumout" placeholder="" readonly>
                          </div>  
                        </div>                                             
                      </div>
                      <br>

                      <div class="card" style="width: -webkit-fill-available;">
                          <h5 class="card-title">เลือกอาจารย์</h5>
                          <div class="row">
                              <?php foreach ($lecturers as $lecturer) :
                                  $checked = '';?>
                                  <?php foreach($lecurer_responsibles as $lecurer_responsible):
                                      if($lecturer['lecturer_id'] ===  $lecurer_responsible['lecturer_id']){
                                          $checked = 'checked';
                                      }
                                      ?>
                                  <?php endforeach;?>
                              <div class="col-3"><input type="checkbox" name="lecturer[]" value="<?php echo $lecturer['lecturer_id'];?>" <?=$checked?> ><?php echo $lecturer['name_title'];?> <?php echo $lecturer['firstname'];?> <?php echo $lecturer['lastname'];?></div>                                       
                              <?php endforeach;?>
                          </div>
                      </div>
                      <br>
                  
                      <div class="row">
                          <input type="hidden" name="subject_teach_id" id="subject_teach_id"  value="<?php echo $subject_teachs->subject_teach_id;?>">
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

        <script>
            function sum() {
                var txtFirstNumberValue = document.getElementById('sum1').value;
                var txtSecondNumberValue = document.getElementById('sum2').value;
                var txtThirdNumberValue = document.getElementById('sum3').value;
                var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue);
                if (!isNaN(result)) {
                    document.getElementById('textthree').value = result;
                }
            }
            sum()
        </script>