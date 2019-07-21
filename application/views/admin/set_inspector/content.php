        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">กำหนดผู้ตรวจรายงาน</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="d-flex flex-row-reverse">
                  </div>
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th scope="col">รหัสวิชา</th>
                              <th scope="col">ชื่อวิชา</th>
                              <th scope="col">เลือก</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach($subjects as $subject):?>
                          <tr>
                              <td><?= $subject['subject_code'] ?></td>
                              <td><?= $subject['subject_name']?></td>
                              <td>
                                  <a class="btn btn-success" href="<?= base_url('admin/set_inspector/select_lecturer?subject_teach_id='.$subject['subject_teach_id'].'&subject_id='.$subject['subject_id']) ?>" ><i class="fa fa-check" aria-hidden="true"></i></a>
                              </td>
                          </tr>       
                          <?php endforeach; ?>
                      </tbody>
                    
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->