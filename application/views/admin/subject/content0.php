<div class = "page-wrapper">            
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">
                จัดการรายวิชา (<?=($course_id==1)?'SCI':'CARE'?>)
            </h3>  
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    จัดการรายวิชา 
                </li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">เพิ่มรายวิชา</button>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">รหัสวิชา</th>
                    <th scope="col">ชื่อวิชา</th>
                    <th scope="col">ประเภทการฝึก</th>   
                    <th scope="col">จัดการ</th>
                    <th></th>
                </tr>
            </thead>
        <?php
            foreach ($subjects as $subject) :?>
                <tr>
                    <td><?= $subject['subject_code']; ?></td>
                    <td><?= $subject['subject_name']; ?></td>
                    <td><?= $subject['training_type_name']; ?></td>
                    <td>
                        <button class="btn btn-primary update" data-toggle="modal" data-target="#add-modal" data-id="<?= $subject['subject_id'] ?>" data-subject-code="<?= $subject['subject_code']; ?>" data-subject-name="<?= $subject['subject_name']; ?>" data-training-type="<?= $subject['training_type_id']; ?>" type="button"  name="update"><i class="fa fa-edit"></i></button>

                        <button type="button" class="btn btn-danger deleteSubject" data-id="<?php echo $subject['subject_id'];?>" data-subject_name="<?php echo $subject['subject_name'];?>"  data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

                    </td>
                    
                </tr> 
            <?php endforeach;?>
        </table>
        
    </div>
</div>


<div class="modal" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="addSubject">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มรายวิชา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="subject_id" name="subject_id">
                        <div class="col-4">
                        รหัสวิชา:
                            <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="โปรดระบุรหัสวิชา" required autofocus>
                        </div>
                        <div class="col-8">
                        ชื่อวิชา:
                            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="โปรดระบุชื่อวิชา" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" name="course_id" id="course_id" value="<?=$course_id?>" /> 
                    <div class="row">
                        <div class="col-8">
                        ประเภทการฝึก:
                            <select class="form-control" name="training_type_id" id="training_type_id" >
                            <option value="">เลือกประเภทการฝึก</option>
                            <?php foreach($training_types as $training_type):?>
                                <option value="<?= $training_type['training_type_id']?>"><?= $training_type['training_type_name']?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="add" name="add" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="subject"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="update-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="updateSubject" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขรายวิชา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                        รหัสวิชา:
                            <input type="text" class="form-control" id="subjectcodeUpdate" name="subject_code" placeholder="โปรดระบุรหัสวิชา" required autofocus>
                        </div>
                        <div class="col-8">
                        ชื่อวิชา:
                            <input type="text" class="form-control" id="subjectnameUpdate" name="subject_name" placeholder="โปรดระบุชื่อวิชา" required autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                        ระบุหลักสูตร:
                            <select class="form-control" name="course_id" id="courseidUpdate">
                            <?php foreach($courses as $course):?>
                                <option value="<?= $course['course_id']?>"><?= $course['course_name']?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-8">
                        ประเภทการฝึก:
                            <select class="form-control" name="training_type_id" id="trainingtypeidUpdate" >
                            <?php foreach($training_types as $training_type):?>
                                <option value="<?= $training_type['training_type_id']?>"><?= $training_type['training_type_name']?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <input type="hidden" name="subject_id" value="<?=$subject['subject_id']?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-update" name="confirm-update" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>




