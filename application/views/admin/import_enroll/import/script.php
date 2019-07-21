<script src="<?php echo base_url("public/assets/papaparse/papaparse.min.js") ?>"></script>
<script>var base_url = "<?=base_url();?>";</script>
<script>
        var csvData = [];

        function save(){
            if(csvData.length > 0){
                $.post(base_url+"api/enroll/saveImport", {"csvData":csvData},
                    function (data, textStatus, jqXHR) {
                        data = data.data;
                        if(data.duplicateData.length > 0 || data.errorData.length > 0){
                            showMessage(200,data.message);
                            var html = "";
                            if(data.duplicateData.length > 0){
                                html += "มีข้อมูลซ้ำ <br>";
                                $.each(data.duplicateData, function (i, v) { 
                                    html += "student_id: "+v.student_id+" subject_teach_id: "+v.subject_teach_id+" year: "+v.year+" schedule: "+v.schedule+"<br>";
                                });
                            }

                            if(data.errorData.length > 0){
                                html += "มีข้อมูลผิดพลาด <br>";
                                $.each(data.errorData, function (i, v) { 
                                    html += "student_id: "+v.student_id+" subject_teach_id: "+v.subject_teach_id+" year: "+v.year+" schedule: "+v.schedule+"<br>";
                                });
                            }

                            $("#alertDuplicate").show();
                            $('html, body').animate({ scrollTop: $('#alertDuplicate').offset().top }, 'slow');
                            $("#duplicate").html(html);
                        }else{
                            showMessage(200,data.message,"<?=base_url('admin/import_lecturer')?>");
                        }
                    }).fail(function(data) {
                        showMessage(data.status,data.responseJSON.message);
                        var html = "มีข้อมูลของนักศึกษารหัส "+data.data+" มากกว่า 7 ";
                        $("#alertDuplicate").show();
                        $('html, body').animate({ scrollTop: $('#alertDuplicate').offset().top }, 'slow');
                        $("#duplicate").html(html);
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
            
            
            function displayHTMLTable(results){
                console.log(results);
                var header = "no,student_id,subject_teach_id,year,schedule";
                
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