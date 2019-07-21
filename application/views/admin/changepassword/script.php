<script>
    $("#update").click(function(){
        event.preventDefault();
        var isValid = $("#changepassword-form").valid();   
        if(isValid){
            var passFormData = $("#changepassword-form").serialize();
            $.post("<?=base_url("api/Admin/updateAdminPassword"); ?>",passFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/changepassword');?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })

    $("#changepassword-form").validate({
        rules: {
            password:{
                required: true,
                minlength: 4
            }
        },
        messages: {
            password:{
                required: "กรุณากรอกรหัสผ่าน",
                minlength: "กรุณากรอกรหัสอย่างน้อย 4 ตัว"
            }
        },
    });
</script>
