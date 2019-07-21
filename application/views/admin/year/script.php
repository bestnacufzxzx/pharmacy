<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    var last_year = <?=$last_year['year'] ?>;
    var end_date_ago = "<?=$last_year['end_date'] ?>";
    var next_year = (last_year+1)+543;

    var minDate = moment(end_date_ago).add(1, 'day')
    var setMin = minDate.format('YYYY-MM-DD')


    const clearMinMaxDateForm = () => {
        $('#from').attr({
            "min" : '',
            "max" : ''
        })
        $('#to').attr({
            "min" : '',
            "max" : ''
        })
        $('#from').val('')
        $('#to').val('')
        $('#to').prop("disabled", false)
    }
    $('#from').change(function (e) { 
        e.preventDefault();
        $('#to').attr({
            "min" : $('#from').val()
        })
        $('#to').prop("disabled", false)
    });
    $('#to').change(function (e) { 
        e.preventDefault();
        $('#from').attr({
            "max" : $('#to').val()
        })
    });
    $('#add_year').click(function (e) { 
        e.preventDefault();
        clearMinMaxDateForm();
        $('#to').prop("disabled", true)
        $('#next_year').html('เพิ่มปีการศึกษา ' + next_year)
        $('#year').val('')
        $('#from').attr({
            "min" : setMin
        })
        $('#add-modal').modal()
    });
    $('.update_year').click(function (e) { 
        e.preventDefault();
        clearMinMaxDateForm();
        min_start_date = ''
        max_end_date = ''
        var year_update = $(this).data('id')+543
        var start_date = $(this).data('start')
        var end_date = $(this).data('end')
        $('#year').val($(this).data('id'))
        $.get("<?=base_url('api/year/minmax')?>?year="+ $(this).data('id'),
        function(data){
            $('#next_year').html(year_update)
            $('#from').val(start_date)
            $('#from').attr({
                "max" : end_date
            })
            if(data.min_start_date){
                $('#from').attr({
                    "min" : data.min_start_date
                })
            }





            $('#to').val(end_date)
            $('#to').attr({
                "min" : start_date
            })
            if(data.max_end_date){
                $('#to').attr({
                    "max" : data.max_end_date
                })
            }
            $('#add-modal').modal()
        })
        
    });



    $("#create").click(function(){
        event.preventDefault();
        var isValid = $("#add-year").valid();
        var yearFormData = $("#add-year").serialize();
        var year = $('#year').val()
        if(isValid){
            $.post("<?=base_url('api/year/create')?>",yearFormData,
            function(data){
                // if(year == ''){
                    showMessage(200,data.message,"<?=base_url('admin/scheduler/?search=')?>" + (last_year + 1));
                // }else{
                    // showMessage(200,data.message,"<?=base_url('admin/edit_year')?>");
                // }
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        }
    })

    

    function checkID(id) {
            if(id.length != 13) return false;
            for(i=0, sum=0; i < 12; i++)
                sum += parseFloat(id.charAt(i))*(13-i);
            if((11-sum%11)%10!=parseFloat(id.charAt(12)))
                return false;
            return true;
        }

        jQuery.validator.addMethod("pid", function(value, element) {
          return checkID(value);
        }, 'กรุณากรอกเลขที่บัตรประชาชนให้ถูกต้อง');

    $("#add-year").validate({
        rules: {
            year: {
                required: true
            },
            startDate: {
                required: true
            },
            endDate:{
                required: true
            }         
        },
        messages: {
            year:{
                required: "กรุณากรอกปีการศึกษา"
            },
            startDate:{
                required: "กรุณากรอกวันเริ่มปีการศึกษา"
            },
            endDate:{
                required: "กรุณากรอกวันสิ้นสุดปีการศึกษา"
            }
        },
    });

    $('.deleteYear').click(function (e) { 
        e.preventDefault();
        let year = $(this).data('id')
        $('#year-display').html('ยืนยันการลบปี '+(year+543))
        $('#delete-modal').modal()
    });


    $('#confirm-delete').click(function(e) {
        $.post("<?=base_url('api/year/delete')?>",
        function(data){
            showMessage(200,data.message,"<?=base_url('admin/edit_year')?>");
        }).fail(function(data) {
            showMessage(data.status,data.responseJSON.message)
        })
    })

    $('#set-now').click(function (e) { 
        e.preventDefault();
        $set_now = $('#all-year').val()
        $.post("<?=base_url('api/year/setNow')?>",'set_now=' + $set_now,
        function(data){
            if(year == ''){
                showMessage(200,data.message,"<?=base_url('admin/edit_year')?>");
            }else{
                showMessage(200,data.message,"<?=base_url('admin/edit_year')?>");
            }
        }).fail(function(data) {
            showMessage(data.status,data.responseJSON.message)
        })
    });

</script>