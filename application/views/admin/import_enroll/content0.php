<div class = "page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">ข้อมูลการลงทะเบียน</h3>  
            </div>
        </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row p-30">  
            <div class="col-lg-5">
                <div class="input-group input-group-flat">
                    <label class="col-lg-5 col-form-label">ค้นหา : </label>
                    <input type="text" class="form-control input-default" id="search" placeholder="ค้นหา...">
                    <span class="input-group-btn"><button class="btn btn-success" type="button" id="btn-search" style="height: 42px"><i class="ti-search" ></i></button></span>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="input-group input-group-flat">
                    <label class="col-lg-3 col-form-label">เลือกวิชา: </label>
                    <select class="form-control input-default" name="column" id="column">
                    <?php foreach($subjects as $subject):?>
                        <option value="1"><?= $subject['subject_code']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <a class="btn btn-success" href="<?php echo base_url("admin/import_enroll/import");?>" ​​​​​>นำเข้าข้อมูล</a>
            <br><br/>  
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">รหัสนักศึกษา</th>
                    <th scope="col">ชื่อ-นามสกุล</th>
                    <th scope="col">อีเมล์</th>
                    <th scope="col">จัดการ</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td><?= $student['student_id']?></td>
                    <td><?= $student['name_title']." ".$student['firstname']." ".$student['lastname']?></td>
                    <td><?= $student['email']?></td>
                    <td>
                        <!-- <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
                        <button type="button" class="btn btn-danger delete">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td></td>
                </tr> 
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
  


    
