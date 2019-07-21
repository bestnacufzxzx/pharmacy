<script>
    var workplace_id = <?= $workplace_id?>;
    $("#save").click(function(){
        event.preventDefault();
        var isValid = $("#add-trainer").valid();
        // var trainerFormData = $("#add-trainer").serialize();
        if(isValid){
            var trainerFormData = $("#add-trainer").serialize();
            trainerFormData = trainerFormData+"&workplace_id=" + workplace_id
            $.post("<?=base_url("api/trainer/create"); ?>",trainerFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/trainer/info_trainer?workplace_id='.$workplace_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })

    $("#add-trainer").validate({
        rules: {
            name_title: {
                required: true
            },
            trainer_id: {
                required: true
            },
            firstname:{
                required: true
            },
            lastname:{
                required: true
            },
            email:{
                required: true,
                email: true
            },
            phone:{
                required: true,
                minlength:10
            },
            job_position:{
                required: true
            }          
        },
        messages: {
            name_title:{
                required: "กรุณาเลือกคำนำหน้าชื่อ"
            },
            firstname:{
                required: "กรุณากรอกชื่อ"
            },
            lastname:{
                required: "กรุณากรอกนามสกุล"
            },
            email:{
                required: "กรุณากรอก email"
            },
            phone:{
                required: "เบอร์โทรศัพท์มือถือ",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            job_position:{
                required: "กรุณากรอกตำแหน่งงาน"
            }
        },
    });
</script>