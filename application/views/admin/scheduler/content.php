        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการผลัด</h1>
          </div>

          <p class="mb-4">
            <div class="row p-30">  
              <div class="col-lg-6">
                  <form method="get" >
                      <div class="input-group input-group-flat">
                          <label class=" col-form-label">ปีการศึกษา : </label>
                          <select class="form-control input-default ml-3" name="column" id="yearSelect">
                              <?php foreach ($years as $year): ?>
                                  <option value="<?=$year['year']?>" <?= ( $year['year'] == $search )?'selected':''?> ><?=$year['year']+543?> (<?=$year['year']?> )</option>
                              <?php endforeach;?>
                          </select>
                          <br>
                      </div>
                  </form>
              </div>
              <!-- filter year -->
              <div class="col-lg-1">
                  <form id="filter-year">
                      <input type="hidden" class="form-control" style="width: 80px" name="search" id="yearFilter" readonly>
                  </form>
              </div>
              <div class="col-lg-4">
                  <div class="d-flex flex-row-reverse">
                      <div class="row">
                          <div class="col-12">
                              <button class="btn btn-success" id="saveData" disabled>บันทึก</button>
                              <button class="btn btn-success" id="saveUpdateDate" disabled>บันทึกการเปลี่ยนแปลง</button>
                              <button class="btn btn-primary" id="cancel" onclick="location.reload()">ยกเลิก</button>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </p>

          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header">
                  ปีการศึกษาปัจจุบัน พ.ศ. <?= $this_year+543?>
                </div>
                <div class="card-body">
                  <div id="showSchedules" class="table-responsive-lg">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ผลัดที่</th>
                                <th scope="col">วันเริ่ม</th>
                                <th scope="col">วันสิ้นสุด</th>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <form id="updateSchedule">
                            <?php foreach ($schedules as $schedule) :?>
                                <tr id="schedule-<?php echo $schedule['schedule'].$schedule['year'];?>">
                                    <td><?php echo $schedule['schedule'];?><input class="form-control" style="width: 40px; text-align: center" name="schedule_update[]" type="hidden" id="schedule<?php echo $schedule['schedule'];?>" value="<?php echo $schedule['schedule'];?>"></td>
                                    <td><input type="date" class="form-control schedule" name="start_date_update[]" id="start_date<?php echo $schedule['schedule'];?>" value="<?php echo $schedule['start_date'];?>" onchange="checkId(this.id)"></td>
                                    <td><input type="date" class="form-control schedule" name="end_date_update[]" value="<?php echo $schedule['end_date'];?>"></td>
                                    <input type="hidden" name="year_update[]" value="<?php echo $search?>">
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php endforeach;?>    
                        </form>
                    </table>
                  </div>
                  <div id="requireData" class="table-responsive-lg">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th scope="col">ผลัดที่</th>
                                  <th scope="col">วันเริ่ม</th>
                                  <th scope="col">วันสิ้นสุด</th>
                                  <td></td>
                              </tr>
                          </thead>
                              <form id="saveSchedule">
                                  <tr id="schedule-1">
                                      <td>1<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="1"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date1" name="start_dates[]" <?=($search <= $this_year)?'readonly':''?>></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date1" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year1" value="<?php echo $search?>">
                                  </tr>  
                                  <tr id="schedule-2">
                                      <td>2<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="2"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date2" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date2" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year2" value="<?php echo $search?>">
                                  </tr>  
                                  <tr id="schedule-3">
                                      <td>3<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="3"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date3" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date3" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year3" value="<?php echo $search?>">
                                  </tr> 
                                  <tr id="schedule-4">
                                      <td>4<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="4"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date4" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date4" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year4" value="<?php echo $search?>">
                                  </tr> 
                                  <tr id="schedule-5">
                                      <td>5<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="5"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date5" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date5" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year5" value="<?php echo $search?>">
                                  </tr> 
                                  <tr id="schedule-6">
                                      <td>6<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="6"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date6" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date6" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year6" value="<?php echo $search?>">
                                  </tr> 
                                  <tr id="schedule-7">
                                      <td>7<input class="form-control" style="width: 40px; text-align: center" type="hidden" name="schedules[]" value="7"></td>
                                      <td><input type="date" class="form-control newSchedule" id="start_date7" name="start_dates[]" readonly></td>
                                      <td><input type="date" class="form-control newSchedule" id="end_date7" name="end_dates[]" readonly></td>
                                      <input type="hidden" name="years[]" id="year7" value="<?php echo $search?>">
                                  </tr> 
                              </form>
                      </table>                    
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->