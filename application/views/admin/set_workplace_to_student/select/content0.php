<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">เลือกแหล่งฝึกนักศึกษา ผลัดที่<?= $schedule?></h3>  
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">จัดการแหล่งฝึกนักศึกษา</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div>
            <table class="table table-striped">
                <thead>
                    <th>แหล่งฝึก</th>
                    <th>จำนวนรับชาย</th>
                    <th>จำนวนรับหญิง</th>
                    <th>จำนวนรับไม่ระบุเพศ</th>
                </thead>
                <tbody>
                <?php foreach($workplaces as $workplace): ?>
                <?php $isOver = $workplace['receive_female'][0] > $workplace['receive_female'][1] || $workplace['receive_male'][0] > $workplace['receive_male'][1] || $workplace['receive_unknow'][0] > $workplace['receive_unknow'][1] ?>
                <tr class="<?=$isOver?'bg-danger':''?>">
                    <td><?= $workplace['workplace_name']?></td>
                    <td><?= join('/',$workplace['receive_male'])?></td>
                    <td><?= join('/',$workplace['receive_female'])?></td>
                    <td><?= join('/',$workplace['receive_unknow'])?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <table class="table table-striped">
            <thead>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เลือกแหล่งฝึก</th>
            </thead>
            <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    
                    <td><?= $student['student_id'] ?></td>
                    <td><?= $student['name_title'].$student['firstname'].' '.$student['lastname'] ?></td>
                    <td>
                        <select class="form-control workplace" data-enroll-id="<?=$student['enroll_id']?>">
                            <option value="-1">กรุณาเลือกแหล่งฝึก</option>
                            <?php foreach($workplaces as $workplace): ?>
                            <option value="<?= $workplace['workplace_subject_id'] ?>" <?=($workplace['workplace_subject_id'] == $student['workplace_subject_id'])?'selected':''?>><?= $workplace['workplace_name'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        
    </div>
</div>