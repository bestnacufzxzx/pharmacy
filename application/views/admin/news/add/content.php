        <?php $user = get_user_session(); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">เพิ่มข่าวประกาศ</h1>
          </div>

          <p class="mb-4">
           
          </p>
          <!-- Content Row -->
          <form id="news-form">
            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <br>
                    <div class="form-group col-md-8">
                      <label>ประเภทข่าวประกาศ</label><span class="error">*</span>
                        <div class="form-inline">
                            <select  name="news_type_id" id="news_type_id" class="form-control">
                                <option value="" >ประเภทข่าวประกาศ</option>
                                <?php foreach($newstypes as $newstype):?>
                                <option value="<?= $newstype['news_type_id']?>"><?=$newstype['news_type']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                            <label>ชื่อข่าวประกาศ</label><span class="error">*</span>
                            <input type="text" class="form-control" name="news_title" id="news_title" placeholder="กรุณากรอกชื่อข่าว">
                    </div>
                    <div class="form-group ">
                      <label class="col-sm-2" >รายละเอียด<span class="error">*</span></label>
                      <div class="col-sm-9" >
                        <textarea name="news_detail" id="news_detail" cols="69" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="form-group ">
                      <div class="col-sm-2">ไฟล์แนบ</div>
                        <div class="col-sm-7">
                          <input type="file" name="file" id="file" >
                        </div>
                    </div>

                    <div class="form-group col-md-8">
                            <label>ประกาศถึง</label><span class="error">*</span>
                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="">
                    </div>
                    <input type="hidden" name="staff_id" id="staff_id" value="<?=$user->staff_id?>"/>
                    
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-success" id="save">บันทึก</button>
                      <button type="button" class="btn btn-cancle">ยกเลิก</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.container-fluid -->