<?php $user = get_user_session(); ?>
<head>
  <!-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> -->
</head>
<div class="page-wrapper">
    <div class="card card-outline">
    <div class="container-fluid">
    <form id="newsupdate-form">
            <div class="card-header">
                <h4>แก้ไขข่าวประกาศ</h4>
            </div><br> 
            <?php foreach ($newss as $news) :?>
            <input type="hidden" name="news_id" id="news_id" value="<?php echo $news['news_id']; ?>">
            <form id="newsupdate-form">             
              <div class="form-group col-md-8">
                      <label>ประเภทข่าวประกาศ</label><span class="error">*</span>
                      <div class="form-inline">
                          <select  name="news_type_id" id="news_type_id" class="form-control">
                                <option value="" >กรุณาเลือกประเภทข่าวประกาศ</option>
                                <?php foreach($newstypes as $newstype):?>
                                <option value="<?= $newstype['news_type_id']?>" <?=( $news['news_type_id'] == $newstype['news_type_id'])?'selected':''?>><?=$newstype['news_type']?></option>
                                <?php endforeach;?>
                           </select>
                      </div>
               </div>
              <div class="form-group col-md-8">
                      <label>ชื่อข่าวประกาศ</label><span class="error">*</span>
                      <input type="text" class="form-control" name="news_title" id="news_title" placeholder="กรุณากรอกชื่อข่าว" value="<?php echo $news['news_title']; ?>">
              </div>
              <div class="form-group ">
              <label class="col-sm-2" >รายละเอียด<span class="error">*</span></label>
                <div class="col-sm-9" >
                  <textarea name="news_detail" id="news_detail" class="ckeditor" cols="69" rows="5"><?php echo $news['news_detail']; ?></textarea>
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
                      <input type="date" class="form-control" name="end_date" id="end_date" placeholder="" value="<?php echo $news['end_date']; ?>">
              </div>
              <!-- <div class="hide form-group col-md-8">
                      <label>ผู้ประกาศ</label><span class="error">*</span>
                      <input type="text" class="form-control" name="staffId" id="staffId" placeholder=""value="<?php echo $news['staff_id']; ?> ">
              </div> -->
            <?php endforeach;?>
            <input type="hidden" name="staff_id" id="staff_id" value="<?=$user->staff_id?>"/>

            
          <div class="form-group col-md-3">
            <button type="button" id="update" class="btn btn-success">บันทึก</button>
            <button type="button" class="btn btn-cancle">ยกเลิก</button>
          </div>
        </form>
    </div>
    </div>
   
</div>

