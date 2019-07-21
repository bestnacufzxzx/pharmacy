<script>
	
    var id = null
    var name = null
    var code = null
    $(".deletesubject_teach").click( function() {
        id = $(this).data('id'),
        code = $(this).data('code')
        name = $(this).data('name')
        console.log(id)
        
        $('#subjectteach').html('คุณต้องการที่จะลบรายวิชา ' + code +' '+ name +' ใช่หรือไม่' )
    })
    $('#confirm-delete').click(function(e) {
        // $('#delete-modal').modal('hide')
        if(true){
            $('#delete-modal').modal('hide')
            $.post("<?=base_url('api/subject_teach/delete')?>",{id},
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/subject_teach?course_id='.$course_id);?>");
                $('#subjectteach-' + id).remove();
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    })
</script>
