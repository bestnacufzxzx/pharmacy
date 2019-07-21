<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">กำหนดผู้ตรวจรายงาน</h3>  
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
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