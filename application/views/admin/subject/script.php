<script>
    $(document).ready(function () {
        $('#add').click(function (e) { 
        e.preventDefault();
        var isValid = $("#addSubject").valid();
        if(isValid){
            var subjectData = $("#addSubject").serialize();
            $.post("<?=base_url('api/Subject/create')?>",subjectData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/subject?course_id='.$course_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    });

    var subject_id = null
    var subject_name = null
    $(".deleteSubject").click( function() {
        subject_id = $(this).data('id'),
        subject_name = $(this).data('subject_name')

        
        $('#subject').html('คุณต้องการที่จะลบรายวิชา '+ subject_name +' ใช่หรือไม่' )
    })
    $('#confirm-delete').click(function(e) {
        // $('#delete-modal').modal('hide')
        if(true){
            $('#delete-modal').modal('hide')
            $.post("<?=base_url('api/Subject/delete')?>",{subject_id},
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/subject?course_id='.$course_id);?>");
                $('#subject-' + subject_id).remove();
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    })


    var subject_code = null
    var subject_name = null
    var subject_id = null
    var training_type_id = null
    $('.update').click(function (e) { 
        e.preventDefault();
        subject_code = $(this).data('subject-code')
        subject_name = $(this).data('subject-name')
        subject_id = $(this).data('id')
        training_type_id = $(this).data('training-type')
        $('#subject_code').val(subject_code)
        $('#subject_name').val(subject_name)
        $('#subject_id').val(subject_id)
        $('#training_type_id').val(training_type_id)
        subject_code = ''
        subject_name = ''
        subject_id = ''
        training_type_id = ''
    });
   
    $('#confirm-update').click(function (e) { 
        e.preventDefault();
        var isValid = $("#updateSubject").valid();
        if(isValid){
            var subjectData = $("#updateSubject").serialize();
            $.post("<?=base_url('api/Subject/create')?>",subjectData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/subject')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
        trainingTypeNameHistory = null
    });

    $("#updateSubject").validate({
            rules: {
                subject_code: {
                    required: true
                },
                subject_name: {
                    required: true
                },
                course_id: {
                    required: true
                },
                training_type_id: {
                    required: true
                }          
            },
            messages: {
                subject_code:{
                    required: "โปรดระบุรหัสวิชา"
                },
                subject_name:{
                    required: "โปรดระบุชื่อวิชา"
                },
                course_id:{
                    required: "โปรดเลือกหลักสูตร"
                },
                training_type_id:{
                    required: "โปรดเลือกประเภทการฝึก"
                }
            }
        })

        $("#addSubject").validate({
            rules: {
                subject_code: {
                    required: true
                },
                subject_name: {
                    required: true
                },
                course_id: {
                    required: true
                },
                training_type_id: {
                    required: true
                }          
            },
            messages: {
                subject_code:{
                    required: "โปรดระบุรหัสวิชา"
                },
                subject_name:{
                    required: "โปรดระบุชื่อวิชา"
                },
                course_id:{
                    required: "โปรดเลือกหลักสูตร"
                },
                training_type_id:{
                    required: "โปรดเลือกประเภทการฝึก"
                }
            }
        })
    });
    

    
</script>