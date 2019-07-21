<script type="text/javascript">
	$(document).ready(function() {
		var sumLecturer = <?= $total_rows ?>;
		$('#sum_lecturer').html('อาจารย์ทั้งหมด'+ sumLecturer + 'คน')
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
		$('#lecturer_delete').html('คุณต้องการลบ ' + firstname + " " + lastname + ' หรือไม่')
	});

	$('#confirm-delete').click(function(e) {
		$('#delete-modal').modal('hide')
		$.post("<?=base_url('api/Lecturer/delete')?>",'lecturer_id='+ id,
		function(data){
			showMessage(200,data.message,"<?=base_url('admin/import_lecturer')?>");
			// $('#lecturer-' + id).remove();
			// sumLecturer--
			// var res = $('#sum_lecturer').replace(sumLecturer, this.sumLecturer);
			// $('#sum_lecturer').html(res)
		}).fail(function(data) {
			showMessage(data.status,data.responseJSON.message)
		})
  	})

  $("#import_csv").validate({
        rules: {
            test: {
                required: true
            },          
        },
        messages: {
            test:{
                required: "กรุณาเลือกไฟล์อาจารย์ที่จะนำเข้า"
            },
        },
    });


</script>
