<div class  ="page-wrapper">            
    <div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="p-0 pl-2">รหัสวิชา</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <?php foreach($schedules as $schedule): ?>
                        <th class="p-0">ผลัดที่<?= $schedule['schedule'] ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($subject_teachs as $subject_teach): ?>
                    <tr>
                        <td class="p-0 pl-2"><?= $subject_teach['subject_code'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <?php foreach($schedules as $schedule): ?>
                            <?php $isOver = 
                                $count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_male'][0] > $count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_male'][1] || 
                                $count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_female'][0] > $count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_female'][1]
                            ; ?>
                            <td class="p-0 <?=($isOver)?'bg-danger text-white':''?>">
                                <?=join("/",$count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_male'])?>
                                <?=join("/",$count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_female'])?>
                                <?=join("/",$count_student[$subject_teach['training_type_id']][$schedule['schedule']]['receive_unknow'])?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <table id="example" class="display" style="width:100%; font-size: medium;" >
            <thead>
                <tr>
                    <!-- <th>รหัส น.ศ.</th> -->
                    <th>ชื่อ-นามสกุล</th>
                    <?php foreach($schedules as $schedule): ?>
                        <th>ผลัดที่<?= $schedule['schedule'] ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach($student_enrolls as $student_enroll): ?>
                <tr>
                    <!-- <td><?= $student_enroll['student_id'] ?></td> -->
                    <td><?= $student_enroll['name_title'].$student_enroll['firstname'].' '.$student_enroll['lastname'] ?></td>
                    <?php foreach($schedules as $schedule): ?>
                    <td>
                        <select class="form-control subject" style="font-size: x-small;"  data-student-id="<?=$student_enroll['student_id']?>"  data-schedule="<?=$schedule['schedule']?>">
                            <option value="-1">กรุณาเลือกวิชา</option>
                            <?php foreach($subject_teachs as $subject_teach):?>
                                <?php 
                                    $isSelected = $selected_subject[$student_enroll['student_id']][$schedule['schedule']] == $subject_teach['subject_teach_id'];
                                    $subject_teach_id = $subject_teach['subject_teach_id'];
                                    $array_subject_teach_id = $selected_subject[$student_enroll['student_id']]['selected'];
                                    if($isSelected || !in_array($subject_teach_id, $array_subject_teach_id)){
                                ?>
                                    <option value="<?= $subject_teach['subject_teach_id'] ?>" <?=($isSelected)?'selected':''?>><?= $subject_teach['subject_code'] ?></option>
                                <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <small class="text-danger">*เพศชายที่เลือกแล้ว/เพศชายที่รับ, เพศหญิงที่เลือกแล้ว/เพศหญิงที่รับ, ไม่ระบุเพศที่เลือกแล้ว/ไม่ระบุเพศที่รับ*</small>
            <tfoot>
                <tr>
                    <!-- <th>รหัสนักศึกษา</th> -->
                    <th>ชื่อ-นามสกุล</th>
                    <?php foreach($schedules as $schedule): ?>
                        <th>ผลัดที่<?= $schedule['schedule'] ?></th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
        <!-- <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <a class="btn btn-success" href="<?=base_url("admin/set_student_workplace/set_at_student"); ?>">บันทึก</a>
            </div>
        </div> -->
    </div>
   


</div>
