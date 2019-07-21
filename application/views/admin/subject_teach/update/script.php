
<script>
    $("#save").click(function(){
        event.preventDefault();
        var isValid = $("#subject_teach-form").valid();   
        if(isValid){
            var subject_teachFormData = $("#subject_teach-form").serialize();
            $.post("<?=base_url("api/subject_teach/create"); ?>",subject_teachFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/subject_teach?course_id='.$course_id);?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })

    $("#subject_teach-form").validate({
        rules: {
                subject_id: {
                    required: true
                },
                percent_trainer: {
                    required: true,
                    maxlength : 2,
                    min: 1,
                    max: 99
                },
                percent_report: {
                    required: true,
                    maxlength : 2,
                    min: 1,
                    max: 99
                },
                percent_present: {
                    required: true,
                    maxlength : 2,
                    min: 1,
                    max: 99
                },
                sumout: {
                    max: 100
                }

            },
            messages: {
                subject_id:{
                    required: "กรุณาเลือกวิชา"
                },
                percent_trainer:{
                    required: "กรุณากรอกคะแนน",
                    maxlength : "กรุณากรอกคะแนนไม่เกิน 100 คะแนน",
                    min: "กรุณากรอกคะแนนไม่ต่ำกว่า 1 คะแนน",
                    max: "กรุณากรอกคะแนนไม่เกิน 100 คะแนน"
                },
                percent_report:{
                    required: "กรุณากรอกคะแนน",
                    maxlength : "กรุณากรอกคะแนนไม่เกิน 100 คะแนน",
                    min: "กรุณากรอกคะแนนไม่ต่ำกว่า 1 คะแนน",
                    max: "กรุณากรอกคะแนนไม่เกิน 100 คะแนน"
                },
                percent_present:{
                    required: "กรุณากรอกคะแนน",
                    maxlength : "กรุณากรอกคะแนนไม่เกิน 100 คะแนน",
                    min: "กรุณากรอกคะแนนไม่ต่ำกว่า 1 คะแนน",
                    max: "กรุณากรอกคะแนนไม่เกิน 100 คะแนน"
                },
                sumout: {
                    max: "กรุณากรอกคะแนนไม่เกิน 100 คะแนน"
                }
            },
        });
   
</script>