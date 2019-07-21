        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">กำหนดผู้ตรวจรายงาน วิชา <?= $subject->subject_code.' '.$subject->subject_name ?></h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4"></div>
                  </div>
                  <div class="container-fluid">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th scope="col">ชื่อ-นามสกุล</th>
                                  <th scope="col" class="d-flex justify-content-center">จำนวนนักศึกษาที่รัยผิดชอบ</th>
                                  <th scope="col">เลือก</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach($lecturers as $lecturer): ?>
                              <tr>
                                  <td><?= $lecturer['name_title'].$lecturer['firstname'].' '.$lecturer['lastname'] ?></td>
                                  <td class="d-flex justify-content-center"><?= $lecturer['responsible'] ?> คน</td>
                                  <td><a class="btn btn-success" href="<?= base_url('admin/set_inspector/choose_student_lecturer?subject_teach_id='.$subject_teach_id.'&lecturer_responsible_id='.$lecturer['lecturer_responsible_id'].'&subject_id='.$subject->subject_id) ?>"><i class="fa fa-address-card-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>    
                  </div>
                  <span class="d-flex justify-content-around">จำนวนนักศึกษาที่ยังไม่มีผู้ตรวจรายงาน <?= $residue ?> คน </span>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->