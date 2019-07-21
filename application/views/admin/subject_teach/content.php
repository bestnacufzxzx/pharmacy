        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการรายวิชาของปีการศึกษา<?= ($course_id == 1)?'(SCI)':'(CARE)'?></h1>
          </div>

          <p class="mb-4">
            <div class="d-flex flex-row-reverse">             
                <a class="btn btn-primary" href="<?=base_url("admin/subject_teach/add?course_id=".$course_id)?>" ​​​​​>เพิ่มรายวิชาของปีการศึกษา</a>
            </div>
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">รหัสวิชา</th>
                                <th scope="col">ชื่อวิชา</th> 
                                <th scope="col">คะแนนนำเสนอ(%)</th>
                                <th scope="col">คะแนนรายงาน(%)</th>
                                <th scope="col">คะแนนจากแหล่งสหกิจ(%)</th>
                                <th scope="col">จัดการ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php foreach($subject_teachs as $subject_teach): ?>
                            <tr>
                                <td><?= $subject_teach['subject_code']?></td>
                                <td><?= $subject_teach['subject_name']?></td>
                                <td><?= $subject_teach['percent_present']?>%</td>
                                <td><?= $subject_teach['percent_report']?>%</td>
                                <td><?= $subject_teach['percent_trainer']?>%</td>
                                <td>
                                    <a class="btn btn-primary" href="<?=base_url("admin/subject_teach/update?subject_teach_id=".$subject_teach['subject_teach_id'].'&subject_id='.$subject_teach['subject_id'].'&course_id='.$course_id); ?>"  value="submit" name="submit" ><i class="fa fa-edit" ></i></a>
                                    
                                    <button type="button" class="btn btn-danger deletesubject_teach"  data-id="<?= $subject_teach['subject_teach_id']?>"  data-name="<?= $subject_teach['subject_name']?>"  data-code="<?= $subject_teach['subject_code']?>"data-toggle="modal" data-target="#delete-modal">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </td>
                                <td></td>
                            </tr> 
                        <?php endforeach; ?>
                    </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Delete Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ยืนยันการลบ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="subjectteach"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
