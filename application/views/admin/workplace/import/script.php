<script src="<?php echo base_url("public/assets/papaparse/papaparse.min.js") ?>"></script>
<script>var base_url = "<?=base_url();?>";</script>
<script>
        var csvData = [];

        function save(){
            if(csvData.length > 0){
                $.post(base_url+"api/Workplace/saveImport", {"csvData":csvData},
                    function (data, textStatus, jqXHR) {
                        if(data.duplicateData.length > 0){
                            showMessage(200,data.message);
                            var html = "มีข้อมูลซ้ำ <br>";
                            $.each(data.duplicateData, function (i, v) { 
                                html += "ชื่อแหล่งฝึก : "+v.workplace_name+" ชื่อ : "+v.firstname+" นามสกุล : "+v.lastname+"<br>";
                            });
                            $("#alertDuplicate").show();
                            $('html, body').animate({ scrollTop: $('#alertDuplicate').offset().top }, 'slow');
                            $("#duplicate").html(html);
                        }else{
                            showMessage(200,data.message,"<?=base_url('admin/import_student')?>");
                        }
                    }).fail(function(data) {
                        showMessage(data.status,data.responseJSON.message)
                    }
                )
            }
        }

        $(function(){

            $("#form").submit(function (e) { 
                e.preventDefault();
                $("#response").attr("class", "");
                $("#response").html("");
                var fileType = ".csv";
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
                        + fileType + ")$");
                if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                    $("#response").html(
                            "ชนิดไฟล์ไม่ถูกต้อง : ไฟล์ <b>" + fileType
                                    + "</b>");
                    clearTableAndData();
                    return false;
                }                
                renderTable();
            });

            function renderTable(){
                $('#file').parse({
                    config: {
                        delimiter: "auto",
                        complete: displayHTMLTable,
                    }
                });
            }

            $('#import-form').on('submit',function(e){
                e.preventDefault();
                var $btn = $(this).find('button[type="submit"]');
                var formdata = new FormData(this);
                $.ajax({
                    url: base_url+'admin/import_student/saveimport',
                    type: 'POST',
                    dataType: 'JSON',
                    data:formdata,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $btn.button('loading');
                    },
                    success:function(response){
                        $('.form-group.has-error').removeClass('has-error').find('span.text-danger').remove();
                        switch(response.status){
                            case 'form-incomplete':
                                $.each(response.errors, function(key,val){
                                    if(val.error!=''){
                                        $(val.field).closest('.form-group').addClass('has-error').append(val.error);
                                    }
                                })
                            break;
                            case 'success':
                                window.location.reload(true);
                            break;
                            case 'error':
                                console.log(response.message);
                            break;
                        }
                    },
                    error: function(jqXHR,textStatus,error){
                        console.log('Unable to send request!');
                    }
                }).always(function(){
                    $btn.button('reset');
                });
            })
            
            
            function displayHTMLTable(results){
                console.log(results);
                var header = "no,student_id,name_title,firstname,lastname,username,password,year";
                
                var isValid = header == results.data[0];
                if(isValid){
                    var table = "<table class='table table-striped'>";
                    var data = results.data;
                    
                    for(i=0;i<data.length-1;i++){
                        table+= "<tr>";
                        var row = data[i];
                        var cells = row.join(",").split(",");
                        if(i > 0){
                            csvData.push(cells);
                        }
                        for(j=0;j<cells.length;j++){
                            table+= "<td>";
                            table+= cells[j];
                            table+= "</td>";
                        }
                        table+= "</tr>";
                    }
                    table+= "</table>";

                    table += "<div>"
                            +"<button type='button' class='btn btn-success' onclick='save()'>บันทึก</button>"
                            +"</div>";
                    $("#parsed_csv_list").html(table);
                }else{
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                    $("#response").html("รูปแบบไฟล์ไม่ถูกต้อง");
                    clearTableAndData();
                }
            }

            function clearTableAndData(){
                csvData = [];
                $("#parsed_csv_list").html("");
            }
            
        })
    </script>