<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    $(document).ready(function () {
        var checkData = "<?=$checkData?>"
        var thisYear = "<?=$search?>"
        var ss = "<?=$min_date?>"
        var rankDate = 0
        $('#saveData').hide()
        $('#cancel').hide()
        $('#saveUpdateDate').hide()
        console.log("checkData: " + ss)

        if(checkData == 1){
            $('#showSchedules').show()
            $('#requireData').hide()
            $('#saveUpdateDate').show()
            $('#cancel').show()
            $('#saveData').hide()
        }else{
            $('#showSchedules').hide()
            $('#requireData').show()
            $('#saveUpdateDate').hide()
            $('#cancel').show()
            $('#saveData').show()
        }

        $('#end_date7').change(function (e) { 
            e.preventDefault();
            console.log($('#end_date7').val())
            if($('#end_date7').val() != ''){
                $('#saveData').attr({
                    "disabled" : false
                })
            }else{
                $('#saveData').attr({
                    "disabled" : true
                })
            }
        });

        $('.schedule').change(function (e) { 
            e.preventDefault();
            $('#saveUpdateDate').attr({
                'disabled' : false
            })
        });
        
        $('#start_date1').change(function (e) { 
            e.preventDefault();
            console.log("start_date: " + $('#start_date1').val())
        });




        $('#saveData').click(function (e) { 
            e.preventDefault();
            var isValid = true;
            var dataSchedule = $("#saveSchedule").serialize();
            dataSchedule+="&year="+thisYear
            console.log(dataSchedule)
            $.post("<?= base_url('api/schedule/create')?>",dataSchedule,
            function(data){
                console.log(data)
                showMessage(200,data.message,"<?= base_url('admin/scheduler?search='.$search)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        });



        $('#saveUpdateDate').click(function (e) { 
            e.preventDefault();
            $.post("<?=base_url("api/schedule/deleteByYear")?>",'year=' + thisYear,
            function(data){
                var dataSchedule = $("#updateSchedule").serialize();
                $.post("<?= base_url('api/schedule/update')?>",dataSchedule,
                function(data){
                    showMessage(200,data.message,"<?= base_url('admin/scheduler?search='.$search)?>");
                }).fail(function(data) {
                    showMessage(data.status,data.responseJSON.message)
                })
            });
        });

        var year = $('#yearSelect').val()
        $("#yearFilter").val($('#yearSelect').val()) 
        $("#yearSelect").change(function (e) { 
            e.preventDefault();
            console.log($('#yearSelect').val())
            $("#yearFilter").val($('#yearSelect').val()) 
            $('#filter-year').submit()
            // year = $("#yearSelect").val()
        });

        var setStartDateId = null
        function checkId(startDateId){
            setStartDateId = startDateId
            console.log("startId: " + $('#'+startDateId).val())
        }
        const setNextTime = (n) => {
            let calTime = moment($(`#start_date${n}`).val()).add(rankDate, 'day')
            $(`#end_date${n}`).val(calTime.format('YYYY-MM-DD'))
            $(`#start_date${n+1}`).attr({
                "min" : $(`#end_date${n}`).val(),
                "max" : "<?=$max_date?>",    
                "readonly": false
            });
            calDayDif(n)
        }
        const calDayDif = (n) => {
            let start = moment($(`#start_date${n}`).val());
            let end = moment($(`#end_date${n}`).val());
            rankDate = end.diff(start, 'days')
        }
        $('#start_date1').attr({    
            "min" : "<?=$min_date?>",
            "max" : "<?=$max_date?>"
        });

        $('#start_date1').change(function (e) { 
            e.preventDefault();
            let minDate = moment($('#start_date1').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date1').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $('#end_date1').change(function (e) { 
            e.preventDefault();
            calDayDif(1)
            let minDate = moment($('#end_date1').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date2').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $('#start_date2').change(function (e) { 
            e.preventDefault();
            setNextTime(2);
            let minDate = moment($('#start_date2').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date2').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $("#end_date2").change(function (e) { 
            e.preventDefault();
            calDayDif(2)
            let minDate = moment($('#end_date2').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date3').attr({
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            })
        });
        $('#start_date3').change(function (e) { 
            e.preventDefault();
            setNextTime(3);
            let minDate = moment($('#start_date3').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date3').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $("#end_date3").change(function (e) { 
            e.preventDefault();
            calDayDif(3)
            let minDate = moment($('#end_date3').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date4').attr({
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            })
        });
        $('#start_date4').change(function (e) { 
            e.preventDefault();
            setNextTime(4);
            let minDate = moment($('#start_date4').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date4').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $("#end_date4").change(function (e) { 
            e.preventDefault();
            calDayDif(4)
            let minDate = moment($('#end_date4').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date5').attr({
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            })
        });
        $('#start_date5').change(function (e) { 
            e.preventDefault();
            setNextTime(5);
            let minDate = moment($('#start_date5').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date5').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $("#end_date5").change(function (e) { 
            e.preventDefault();
            calDayDif(5)
            let minDate = moment($('#end_date5').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date6').attr({
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            })
        });
        $('#start_date6').change(function (e) { 
            e.preventDefault();
            setNextTime(6);
            let minDate = moment($('#start_date6').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date6').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
        $("#end_date6").change(function (e) { 
            e.preventDefault();
            calDayDif(6)
            let minDate = moment($('#end_date6').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#start_date7').attr({
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            })
        });
        $('#start_date7').change(function (e) { 
            e.preventDefault();
            setNextTime(7);
            let minDate = moment($('#start_date7').val()).add(1, 'day')
            let setMin = minDate.format('YYYY-MM-DD')
            $('#end_date7').attr({    
                "min" : setMin,
                "max" : "<?=$max_date?>",
                "readonly": false
            });
        });
    });

</script>


