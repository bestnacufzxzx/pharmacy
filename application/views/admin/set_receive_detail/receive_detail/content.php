        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการข้อมูลการรับสหกิจ ปีการศึกษา <?=$next_year+543?></h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header">
                    จัดการข้อมูลการรับสหกิจ
                </div>
                <div class="card-body">
                  <div class="container-fluid">
                      <div class="container">
                          <?= $workplace_name ?> 
                          <div class="card" >
                              <div class="card-header">
                                  <ul class="nav nav-tabs card-header-tabs">
                                      <?php foreach($schedules as $s): ?>
                                          <li class="nav-item">
                                              <a class="nav-link <?= $s['schedule'] == $schedule ? 'active' : ''?>" href="<?=base_url('admin/set_receive_detail/receive_detail?workplace_id='.$workplace_id.'&schedule='.$s['schedule'].'&course_id='.$course_id)?>"><?= "ผลัดที่ ". $s['schedule']?></a>      
                                          </li>
                                      <?php endforeach; ?>
                                  </ul>
                              </div>
                              <div class="tab-content card-body mt-3">
                                  <div id="tab" class="tab-pane show active">
                                      <form class="schedule-form" id="form">
                                          <?php foreach($training_types as $training_type): ?>
                                              <?php 
                                                  $isWS = isset($workplace_subject[$training_type['training_type_id']]);
                                                  $ws = ($isWS)? $workplace_subject[$training_type['training_type_id']]: null;
                                              ?>
                                              <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input training_type check_s" name="training_type[]" id="<?= $training_type['training_type_id'] ?>" value="<?= $training_type['training_type_id'] ?>" <?=($isWS)?'checked':''?>>
                                                  <label class="custom-control-label" for="<?= $training_type['training_type_id'] ?>"><?= $training_type['training_type_name'] ?></label>
                                                  <div class="card" id="card-<?= $training_type['training_type_id'] ?>"  <?=$isWS?'':'style="display: none;"'?> >
                                                      <div class="card-body">
                                                          <div>
                                                              <div class="row">
                                                                  <div class="col-2 col-lg-3">
                                                                      <div class="input-group mt-3">
                                                                          <div class="input-group-prepend">
                                                                              <span class="input-group-text">ชาย</span>
                                                                          </div>
                                                                          <input type="number" class="form-control check-min check_s" name="male-<?= $training_type['training_type_id'] ?>" id="male-<?= $training_type['training_type_id'] ?>" value="<?=$ws['male']?>">
                                                                          <div class="input-group-append">
                                                                              <span class="input-group-text">คน</span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-2 col-lg-3">
                                                                      <div class="input-group mt-3">
                                                                          <div class="input-group-prepend">
                                                                              <span class="input-group-text">หญิง</span>
                                                                          </div>
                                                                          <input type="number" class="form-control check-min check_s" name="female-<?= $training_type['training_type_id'] ?>"  id="female-<?= $training_type['training_type_id'] ?>" value="<?=$ws['female']?>">
                                                                          <div class="input-group-append">
                                                                              <span class="input-group-text">คน</span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-2 col-lg-3">
                                                                      <div class="input-group mt-3">
                                                                          <div class="input-group-prepend">
                                                                              <span class="input-group-text">ไม่ระบุ</span>
                                                                          </div>
                                                                          <input type="number"  class="form-control check-min check_s" name="unknow-<?= $training_type['training_type_id'] ?>" id="unknow-<?= $training_type['training_type_id'] ?>" value="<?=$ws['unknow']?>">
                                                                          <div class="input-group-append">
                                                                              <span class="input-group-text">คน</span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-12 col-lg-5 mt-3">
                                                                      กรุณาเลือกพนักงานที่ปรึกษา<br>
                                                                      <select class="form-control check_s" name="trainer-<?= $training_type['training_type_id'] ?>" >
                                                                          <option value="-1">เลือกพนักงานที่ปรึกษา</option>
                                                                          <?php foreach($trainers as $trainer):?>
                                                                          <option value="<?= $trainer['trainer_id']?>" <?=($isWS && $ws['trainer_id'] == $trainer['trainer_id'])?'selected':''?>><?= $trainer['name_title'].$trainer['firstname'].' '.$trainer['lastname']?></option>
                                                                          <?php endforeach;?>
                                                                      </select>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          <?php endforeach; ?>
                                          <div class="d-flex justify-content-end">
                                              <button class="btn btn-success submit" id="save" type="submit" disabled>บันทึก</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->