<script>
    $(document).ready(function () {
        $('.check-min').off('wheel');
        var default_val = 0
        $('.check_s').change(function (e) { 
            e.preventDefault();
            $('#save').attr("disabled", false);
        });

        $('.check-min').click(function (e) { 
            e.preventDefault();
            if($('#'+this.id).val() > 0){
                default_val = $('#'+this.id).val()
            }
        });

        $('.check-min').change(function (e) { 
            e.preventDefault();
            if($('#'+this.id).val() < 0){
                alert('กรุณากรอกจำนวนการรับไม่ต่ำกว่า 0')
                $('#'+this.id).val(default_val)
            }
        });

        $('.check-min').keyup(function (e) { 
            e.preventDefault();
            if($('#'+this.id).val() < 0){
                alert('กรุณากรอกจำนวนการรับไม่ต่ำกว่า 0')
                $('#'+this.id).val(default_val)
            }
        });


       $('.training_type').click(function (e) { 
           console.log(this.id,this.checked)
           if(this.checked){
               $('#card-'+this.id).show()
           }else{
               $('#card-'+this.id).hide()
           }
       });


       $('.schedule-form').submit(function (e) { 
            e.preventDefault();
            console.log(this)
            let workplace_id = "<?=$workplace_id?>"
            let schedule = "<?=$schedule?>"
            let course_id = "<?=$course_id?>"
            var schedule_data = $(this).serialize();
            console.log(schedule_data)
            schedule_data += `&workplace_id=${workplace_id}&schedule=${schedule}&course_id=${course_id}`
            $.post("<?=base_url('api/workplace_subject/create')?>",schedule_data,
            function(data){
                showMessage(200,data.message);
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
       });


    });
</script>