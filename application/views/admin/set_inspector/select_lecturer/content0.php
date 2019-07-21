<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">กำหนดผู้ตรวจรายงาน วิชา <?= $subject->subject_code.' '.$subject->subject_name ?></h3>  
        </div>
    </div>
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