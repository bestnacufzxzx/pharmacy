<script>
    $(document).ready(function () {
        var lecturer_responsible_id = <?= $lecturer_responsible_id ?>;
        $('#save').click(function (e) { 
            e.preventDefault();
            var student_data = $('#save_student').serialize();
            if(student_data == ''){
                Swal.fire({
                    title: 'กรุณาเลือกนักศึกษาก่อนกดบันทึก',
                    animation: false,
                    customClass: {
                        popup: 'animated tada'
                    }
                })
            }else{
                student_data = student_data +'&lecturer_responsible_id='+lecturer_responsible_id
                    console.log(student_data)
                    $.post("<?=base_url("api/assessment/create"); ?>",student_data,
                    function(data){
                        showMessage(200,data.message,"<?= base_url('admin/set_inspector/select_lecturer?subject_teach_id='.$subject_teach_id.'&subject_id='.$subject_id)?>");
                    }).fail(function(data) {
                        showMessage(data.status,data.responseJSON.message)
                })
            }
            
        });
    });
</script>