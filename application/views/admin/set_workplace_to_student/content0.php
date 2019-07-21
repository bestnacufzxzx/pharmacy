<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">จัดการแหล่งฝึกนักศึกษา ปีการศึกษา<?= $next_year+543 ?></h3>  
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <small class="text-success">เครื่องหมาย<i class="fa fa-check" aria-hidden="true"></i>คือนักศึกษาทุกคนมีแหล่งฝึก</small>
            </div>
            <div class="col-3" style="padding-right: 0px">
                <small class="text-warning" >เครื่องหมาย<i class="fa fa-exclamation" aria-hidden="true"></i>คือมีการเลือกนักศึกษาเกินจำนวนรับ</small>
            </div>
            <div class="col-3">
                <small class="text-danger">เครื่องหมาย<i class="fa fa-times" aria-hidden="true"></i>คือมีนักศึกษาตกค้าง</small>
            </div>
            <div class="col-3">
                <small class="text-dark">เครื่องหมาย<i class="fa fa-minus" aria-hidden="true"></i>คือไม่มีนักศึกษา</small>
            </div>
        </div>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">รหัสวิชา</th>
                    <?php foreach($schedules as $schedule): ?>
                        <th >ผลัดที่<?= $schedule['schedule'] ?></option>
                    <?php endforeach; ?>
                </tr>
            </thead>
                <?php foreach($subject_teachs as $subject_teach): ?>
                <tr>
                    <td><?= $subject_teach['subject_code'] ?></td>
                    <?php foreach($schedules as $schedule): ?>
                        <td>
                            <?php 
                                $subject_teach_id = $subject_teach['subject_teach_id'];
                                $schedule_time = $schedule['schedule'];
                                $count_enroll = $map_data[$subject_teach_id][$schedule_time]['count_enroll'] ;
                                $count_student = $map_data[$subject_teach_id][$schedule_time]['count_student'] ;
                                $is_over_workplace = $map_data[$subject_teach_id][$schedule_time]['is_over_workplace'] ;
                                // var_dump($is_over_workplace );
                                if($count_enroll == 0){ ?>
                                    <a class="btn btn-dark disabled">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </a>
                                <?php } else if($is_over_workplace){ ?>
                                    <a class="btn btn-warning" href="<?=base_url('admin/set_workplace_to_student/select?subject_teach_id='.$subject_teach['subject_teach_id'].'&schedule='.$schedule['schedule'].'&training_type_id='.$subject_teach['training_type_id'].'&course_id='.$course_id)?>">
                                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                                    </a>
                                <?php } else if($count_student == 0){ ?>
                                    <a class="btn btn-success" href="<?=base_url('admin/set_workplace_to_student/select?subject_teach_id='.$subject_teach['subject_teach_id'].'&schedule='.$schedule['schedule'].'&training_type_id='.$subject_teach['training_type_id'].'&course_id='.$course_id)?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php }else {?>
                                    <a class="btn btn-danger" href="<?=base_url('admin/set_workplace_to_student/select?subject_teach_id='.$subject_teach['subject_teach_id'].'&schedule='.$schedule['schedule'].'&training_type_id='.$subject_teach['training_type_id'].'&course_id='.$course_id)?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                <?php }
                            ?>  
                        </td>
                    <?php endforeach; ?>
                </tr> 
                <?php endforeach; ?>
        </table>
        
    </div>
</div>
