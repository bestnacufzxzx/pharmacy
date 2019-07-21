<script>
	
	var news_id = null
	var news_title = null
	$('.delete').click(function (e) { 
		e.preventDefault();
		news_id = $(this).data('news_id')
		news_title = $(this).data('news_title')
		$('#news_delete').html('คุณต้องการ ' + news_title +' หรือไม่')
	});

	$('#confirm-delete').click(function(e) {
		$('#delete-modal').modal('hide')
		$.post("<?=base_url('api/news/delete')?>",'news_id='+ news_id,
		function(data){
            showMessage(200,data.message,"<?=base_url('admin/news');?>");
			$('#news_delete-' + news_id).remove();
		}).fail(function(data) {
			showMessage(data.status,data.responseJSON.message)
		})
  })

</script>
