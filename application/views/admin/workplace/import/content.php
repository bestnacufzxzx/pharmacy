<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">นำเข้าข้อมูลแหล่งฝึก</h3>  
        </div>
    </div>
    <div class="container">
        <form id="form">
            <div class="row justify-content-md-center">
                <div class="col-md-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" required>
                            <label class="custom-file-label" for="validatedCustomFile">เลือกไฟล์...</label>
                            <small>เลือกไฟล์ .csv เท่านั้น</small>
                            <small id="response"></small>
                        </div>
                                
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-block">
                        แสดงข้อมูล
                    </button>
                </div>
            </div>
        </form>
        <br>
       
        <div class="alert alert-danger" role="alert" style="display:none" id="alertDuplicate">
            <span id="duplicate"></span>
            <br/>
            <a href="<?=base_url("admin/workplace")?>"><button type="button" class="btn btn-danger">กลับ</button></a>
        </div>
  
        <br>
        <div class="row">
            <div class="col-md-12" id="parsed_csv_list">
                
            </div>
        </div>
    </div>
</div>
