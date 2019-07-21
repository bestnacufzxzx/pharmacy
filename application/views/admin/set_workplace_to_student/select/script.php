<script>
    $(document).ready(function () {
        $('.workplace').change(function (e) { 
            let enroll_id = $(this).data('enroll-id')
            let workplace_subject_id = this.value
            $.post("<?=base_url('api/enroll/selectWorkplace')?>",{
                enroll_id: enroll_id, 
                workplace_subject_id: workplace_subject_id
            },
            function(data){
                console.log(data)
                showMessage(200,data.message,"<?= base_url('admin/set_workplace_to_student/select?subject_teach_id='.$subject_teach_id.'&schedule='.$schedule.'&training_type_id='.$training_type_id.'&course_id='.$course_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        });
    });
</script>
