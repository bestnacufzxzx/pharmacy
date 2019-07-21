        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">จัดการที่พักใกล้แหล่งฝึกของ <?php echo $workplace->workplace_name; ?></h1>
          </div>

          <p class="mb-4">
            <div class="row p-30">  
                <div class="col-lg-6">
                    <form action="<?=base_url("admin/accommodation/?workplace_id=").$workplace->workplace_id?>" method="post">
                        <div class="input-group input-group-flat">
                            <label class="col-lg-3 col-form-label">ค้นหาที่พัก : </label>
                            <input type="text" name="search" class="form-control input-default" id="accommodation-search" placeholder="ค้นหาที่พัก...">
                            <span class="input-group-btn"><button class="btn btn-success" type="submit" id="btn-search" ><i class="fas fa-search" ></i></button></span>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                  <a class="btn btn-success" href="<?=base_url("admin/accommodation/add?workplace_id=$workplace->workplace_id")?>" style="width: auto" ​​​​​>เพิ่มที่พัก</a>
                </div>
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
                          <th></th>
                          <th scope="col">ชื่อที่พัก</th>
                          <th scope="col">ผู้ประสานงาน</th>
                          <th scope="col">เบอโทรศัพท์</th>
                          <th scope="col">แก้ไข</th>
                          <th></th>
                        
                          </tr>
                      </thead>
                      <?php foreach ($accommodations as $accommodation):?>
                          <tr>
                              <td></td>
                              <td><?php echo $accommodation['accommodation_name']; ?></td>
                              <td><?php echo $accommodation['contact_name']; ?></td>
                              <td><?php echo $accommodation['tel']; ?></td>
                              <td> 
                                  <form action="<?=base_url("admin/accommodation/update?accommodation_id=".$accommodation['accommodation_id']); ?>" method="post">
                                  <input type="hidden" name="accommodationId" value="<?php echo $accommodation['accommodation_id']; ?>" >
                                      <button type="submit" class="btn btn-primary"  value="submit" name="submit" ><i class="fa fa-edit" ></i></button>

                                      <button type="button" class="btn btn-danger delete"  data-workplace_id="<?php echo $accommodation['workplace_id']; ?>" data-id="<?php echo $accommodation['accommodation_id']; ?>" data-name="<?php echo $accommodation['accommodation_name']; ?>" data-toggle="modal" data-target="#delete-modal">
                                      <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                      </button>
                                  </form>

                                
                              </td> 
                          </tr> 
                        
                          <?php endforeach;?>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->