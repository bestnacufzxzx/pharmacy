<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">กำหนดผู้ตรวจรายงาน</h3>  
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
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