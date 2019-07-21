        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลแหล่งฝึก</h1>
          </div>

          <p class="mb-4">
            <form class="input-group">
                <input type="text" name="search" class="form-control input-default" id="workplace-search" value="<?=$search?>" placeholder="ค้นหาชื่อแหล่งฝึก">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search" ></i></button>
                </div>
            </form>   
          </p>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                          <th scope="col">ชื่อแหล่งฝึก</th>
                          <th scope="col">อีเมล์</th>
                          <th scope="col">ข้อมูลพนักงานที่ปรึกษา</th>
                          <th></th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                          foreach ($workplaces as $workplace) :?>
                              <tr id="workplace-<?=$workplace['workplace_id']?>">
                                  <td><?php echo $workplace['workplace_name']; ?></td>
                                  <td><?php echo $workplace['email']; ?></td>
                                  <td>
                                      <a href="<?=base_url('admin/trainer/info_trainer?workplace_id='.$workplace['workplace_id'])?>" class="btn btn-primary"><i class="fas fa-file-alt"></i></a>        
                                  </td>
                                  <td></td>
                              </tr>
                          <?php endforeach;?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->