<script>
     $(document).ready(function () {

        $('#addModal').click(function (e) { 
            e.preventDefault();
            $('#add-modal').modal()
        });
            $("#addType").validate({

            rules: {
                trainingType: {
                    required: true
                }    
            },
            messages: {
                trainingType:{
                    required: "กรุณาระบุประเภทการฝึก"
                }
            }
        })

    
    $('#add').click(function (e) { 
        e.preventDefault();
        var isValid = $("#addTrainingType").valid();
        if(isValid){
            var trainingTypeData = $("#addTrainingType").serialize();
            trainingTypeData += '&training_type_id=' + trainingTypeId
            $.post("<?=base_url('api/Training_type/create')?>",trainingTypeData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/training_type?course_id='.$course_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    });

    var trainingTypeId = null
    var courseId = null
    var training_type_name = null
    $(".deleteTrainingType").click( function() {
        trainingTypeId = $(this).data('id')
        courseId = $(this).data('courseid')
        $('#training_type').html('คุณต้องการที่จะลบประเภทการฝึกที่ '+trainingTypeId+' ใช่หรือไม่')
    })
    
    $('#confirm-delete').click(function(e) {
        // $('#delete-modal').modal('hide')
        if(true){
            $('#delete-modal').modal('hide')
            $.post("<?=base_url('api/Training_type/delete')?>",{trainingTypeId: trainingTypeId, course_id: <?=$course_id?>},
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/training_type?course_id='.$course_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    })

    $('.update').click(function (e) { 
        e.preventDefault();
        trainingTypeId = $(this).data('id')
        training_type_name = $(this).data('training-type-name')
        $('#trainingType').val(training_type_name)
        console.log(trainingTypeId+training_type_name)
    });
    

    $("#updateTrainingType").validate({
            rules: {
                trainingTypeUpdate: {
                    required: true
                }    
            },
            messages: {
                trainingTypeUpdate:{
                    required: "กรุณาระบุประเภทการฝึก"
                }
            }
        })

        $("#addTrainingType").validate({
            rules: {
                trainingType: {
                    required: true
                }    
            },
            messages: {
                trainingType:{
                    required: "กรุณาระบุประเภทการฝึก"
                }
            }
        })
     });

    
</script>