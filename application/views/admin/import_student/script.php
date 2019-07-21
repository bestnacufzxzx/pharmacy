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
	var firstname = null
	var lastname = null
	$('.delete').click(function (e) { 
		e.preventDefault();
		id = $(this).data('id')
		firstname = $(this).data('firstname')
		lastname = $(this).data('lastname')
        $('#student_delete').html('คุณต้องการลบ ' + firstname + " " + lastname + ' หรือไม่')
        console.log("id: " + id)
	});

	$('#confirm-delete').click(function(e) {
		$('#delete-modal').modal('hide')
		$.post("<?=base_url('api/Student/delete')?>",'student_id='+ id,
		function(data){
			showMessage(200,data.message);
			$('#student-' + id).remove();
		}).fail(function(data) {
			showMessage(data.status,data.responseJSON.message)
		})
    })

</script>

