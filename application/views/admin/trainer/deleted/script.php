<script type="text/javascript">
	$(document).ready(function () {
		var id = null
		var firstname = null
		var lastname = null
		$('.delete').click(function (e) { 
			e.preventDefault();
			id = $(this).data('id')
			firstname = $(this).data('firstname')
			lastname = $(this).data('lastname')
			$('#trainer_delete').html('คุณต้องการลบ ' + firstname + " " + lastname + ' หรือไม่')
		});

		$('#confirm-delete').click(function(e) {
			$('#delete-modal').modal('hide')
			$.post("<?=base_url('api/Trainer/setDeleted')?>",'trainer_id='+ id,
			function(data){
				showMessage(200,data.message,"<?=base_url('admin/trainer/info_trainer?workplace_id='.$workplace_id)?>");
				$('#trainer-' + id).remove();
			}).fail(function(data) {
				showMessage(data.status,data.responseJSON.message)
			})
		})	

        var recycle_id = null
        $('.recycle').click(function (e) { 
            e.preventDefault();
            recycle_id = $(this).data('id')
            firstname = $(this).data('firstname')
            lastname = $(this).data('lastname')
            $('#trainer_recycle').html('ยืนยันการนำ '+firstname+' '+lastname+' กลับเข้าสู่ระบบ')
        });

        $('#confirm-recycle').click(function (e) { 
            e.preventDefault();
            $('#delete-modal').modal('hide')
            $.post("<?=base_url('api/trainer/recycle')?>",'recycle_id='+ recycle_id,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/trainer/deleted?workplace_id='.$workplace_id)?>");
                // $('#lecturer-' + id).remove();
                // sumLecturer--
                // var res = $('#sum_lecturer').replace(sumLecturer, this.sumLecturer);
                // $('#sum_lecturer').html(res)
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        });
	
	});
</script>