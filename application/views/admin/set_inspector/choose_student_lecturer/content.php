        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">กำหนดผู้ตรวจรายงาน</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                      <div class="col-4"></div>
                      <div class="col-6 d-flex flex-row-reverse">
                      </div>
                      <div class="col-2">
                          <button class="btn btn-success" id="save">บันทึก</button>
                      </div>
                  </div>
                  <div class="container-fluid">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th scope="col">เลือก</th>
                                  <th scope="col">รหัสนักศึกษา</th>
                                  <th scope="col">ชื่อ-นามสกุล</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <form id="save_student">
                              <?php foreach($students as $student):?>
                                  <tr>
                                      <td>
                                          <input type="checkbox" name="enroll_id[]" style="width: 35px; height: 25px;" class="check" id="check-<?= $student['enroll_id'] ?>" value="<?= $student['enroll_id'] ?>">
                                      </td>
                                      <td><?= $student['student_id']?></td>
                                      <td><?= $student['firstname'].' '.$student['lastname']?></td>
                                  </tr>
                              <?php endforeach; ?>
                          </form>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->