        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการปีการศึกษา <small>(ปีการศึกษาปัจจุบัน <?=$now_year+543?>)</small></h1>
          </div>

          <p class="mb-4">
            <a href="#" class="btn btn-success btn-icon-split" id="add_year">
              <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
              </span>
              <span class="text">เพิ่มปีการศึกษา</span>
            </a>
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#setNow-modal">
              <span class="icon text-white-50">
                <i class="fas fa-wrench"></i>
              </span>
              <span class="text">กำหนดปีการศึกษาปัจจุบัน</span>
            </a>
          </p>

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="table-responsive-lg">
                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ปีการศึกษา(พ.ศ.)</th>
                                <th scope="col">วันเริ่มต้น</th>
                                <th scope="col">วันสิ้นสุด</th>
                                <th scope="col"></th>
                                <th scope="col">แก้ไข</th>
                                <td scope="col"></td>
                            </tr>
                        </thead>
                        <?php foreach ($years as $i => $year) :?>
                            <tr id="year-<?php echo $year['year'];?>">
                            <input type="hidden" name="year" value="<?php echo $year['year']; ?>">
                                <td><?=$year['year']+543;?> <?=($year['set_now']=='1')?"<small>(ปีการศึกษาปัจจุบัน)</small>":""?> </td>
                                <td><?=date_db_2_thai($year['start_date']);?></td>
                                <td><?=date_db_2_thai($year['end_date']);?></td>
                                <td></td>
                                <td>
                                    <?php if( $year['year'] > $now_year) :?>
                                        <button type="button" id="btn-update-year-<?php echo $year['year'];?>" class="btn btn-primary update_year" data-id="<?php echo $year['year'];?>" data-start="<?php echo $year['start_date'];?>" data-end="<?php echo $year['end_date'];?>" >
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if($page == 0 && $countYear >= 2  && $i == 0 ): ?>
                                        <button type="button" id="btn-del-year-<?php echo $year['year'];?>" class="btn btn-danger deleteYear" data-id="<?php echo $year['year'];?>">
                                        <i class="fas fa-trash-alt"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?=base_url('admin/scheduler/?search='.$year['year'])?>" class="btn btn-primary">จัดการผลัด</a>
                                    
                                </td>
                            </tr> 
                        <?php endforeach;?>
                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

  <div class="modal fade" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="add-year">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="next_year"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1">
                            
                        </div>
                        <div class="col-5">
                        <input type="hidden" id="year" name="year">
                            วันเริ่ม: <br>
                            <input type="date" class="form-control" id="from" name="startDate" data-date-language="th" autocomplete="off">
                        </div>
                        <div class="col-5">
                            วันสิ้นสุด: <br>
                            <input type="date" class="form-control" id="to" name="endDate" data-date-language="th" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-add">ยกเลิก</button>
                    <button type="button" id="create" name="create" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="year-display"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="delete" class="btn btn-primary">ลบ</button>
                </div>
            </div>

    </div>
</div>

<div class="modal fade" id="update-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="update-year">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขปีการศึกษา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row add-schedule">
                        <div class="col-4">
                            ปีการศึกษา(ค.ศ.): <br>
                            <input type="number" class="form-control" id="yearUpdate" name="yearUpdate" min="2000" placeholder="ปี ค.ศ." readonly>
                        </div>
                        <div class="col-4">
                            วันเริ่ม: <br>
                            <input type="date"  class="form-control" id="startDateUpdate" name="startDateUpdate">
                        </div>
                        <div class="col-4">
                            วันสิ้นสุด: <br>
                            <input type="date"  class="form-control" id="endDateUpdate" name="endDateUpdate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="update" name="update" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="setNow-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">กำหนดปีปัจจุบัน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" id="all-year">
                    <?php foreach($all_years as $all_year): ?>
                        <option value="<?= $all_year['year'] ?>" <?=($all_year['set_now']=='1')?"selected":""?> ><?= $all_year['year']+543 ?> <?=($all_year['set_now']=='1')?"<small>(ปีการศึกษาปัจจุบัน)</small>":""?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="set-now" name="set-now" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</div>