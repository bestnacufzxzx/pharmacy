<script>
	
	var id = null
	var firstname = null
	var lastname = null
	$('.delete').click(function (e) { 
		e.preventDefault();
		id = $(this).data('id')
		name = $(this).data('name')
        workplace_id = $(this).data('workplace_id')
		$('#accommodation_delete').html('คุณต้องการลบที่พัก ' + name +' หรือไม่')
	});

	$('#confirm-delete').click(function(e) {
		$('#delete-modal').modal('hide')
		$.post("<?=base_url('api/Accommodation/delete')?>",'accommodation_id='+ id,
		function(data){
			// showMessage(200,data.message,"accommodation?workplace_id="+workplace_id);
            showMessage(200,data.message,"<?=base_url('admin/accommodation?workplace_id=');?>"+ workplace_id);
			$('#accommodation-' + id).remove();
		}).fail(function(data) {
			showMessage(data.status,data.responseJSON.message)
		})
  })

</script>
