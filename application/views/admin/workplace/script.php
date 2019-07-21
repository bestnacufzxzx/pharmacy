<script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});

	var id = null
	var workplace_name = null
	var email = null
	$('.delete').click(function (e) { 
		e.preventDefault();
		id = $(this).data('id')
		workplace_name = $(this).data('workplace_name')
		email = $(this).data('email')
		$('#workplace_delete').html('คุณต้องการลบ ' + workplace_name + ' หรือไม่')
	});

	$('#confirm-delete').click(function(e) {
		$('#delete-modal').modal('hide')
		$.post("<?=base_url('api/workplace/delete')?>",'workplace_id='+ id,
		function(data){
			showMessage(200,data.message);
			$('#workplace-' + id).remove();
		}).fail(function(data) {
			showMessage(data.status,data.responseJSON.message)
		})
  })

</script>
