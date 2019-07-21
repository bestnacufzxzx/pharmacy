<script>
    function addModal(){
        $("#add-modal").modal()
    //     $("#addType").validate({
    //         rules: {
    //             trainingType: {
    //                 required: true
    //             }    
    //         },
    //         messages: {
    //             trainingType:{
    //                 required: "กรุณาระบุประเภทการฝึก"
    //             }
    //         }
    //     })
    // }
    }
    
    $('#add').click(function (e) { 
        e.preventDefault();
        var isValid = $("#addWorkplaceType").valid();
        if(isValid){
            var workplaceTypeData = $("#addWorkplaceType").serialize();
            $.post("<?=base_url('api/workplace_type/create')?>",workplaceTypeData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/workplace/WorkplaceType')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    });


    var workplaceTypeId = null
    var workplaceTypeName = null
    $(".deleteWorkplaceType").click( function() {
        workplaceTypeId = $(this).data('id')
        workplaceTypeName = $(this).data('name')
        $('#workplace_type').html('คุณต้องการที่จะลบประเภทแหล่งผึก '+workplaceTypeName+' ใช่หรือไม่')
    })
    
    $('#confirm-delete').click(function(e) {
        if(true){
            $('#delete-modal').modal('hide')
            $.post("<?=base_url('api/workplace_type/delete')?>",{workplaceTypeId: workplaceTypeId},
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/workplace/WorkplaceType')?>");
                $('#workplace_type-' + workplaceTypeId).remove();
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    })

    function updateModal(workplaceTypeId, workplaceTypeName){
        $("#update-modal").modal()
        $("#workplaceTypeName").val(workplaceTypeName)
        $("#workplaceTypeId").val(workplaceTypeId)
    }
    
    $('#confirm-update').click(function (e) { 
        e.preventDefault();
        var isValid = $("#updateWorkplaceType").valid();
        if(isValid){
            var workplaceTypeData = $("#updateWorkplaceType").serialize();
            $.post("<?=base_url('api/workplace_type/create')?>",workplaceTypeData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/workplace/WorkplaceType')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
        trainingTypeNameHistory = null
    });

    $("#addWorkplaceType").validate({
            rules: {
                workplace_type_name: {
                    required: true
                }          
            },
            messages: {
                workplace_type_name:{
                    required: "โปรดระบุประเภทแหล่งผึก"
                }
            }
        })

    $("#updateWorkplaceType").validate({
        rules: {
                workplace_type_name: {
                    required: true
                }          
            },
            messages: {
                workplace_type_name:{
                    required: "โปรดระบุประเภทแหล่งผึก"
                }
            }
        })

      

    </script>