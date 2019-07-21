<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dependencies/JQL.min.js") ?>"></script>
<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dependencies/typeahead.bundle.js") ?>"></script>
<link rel="stylesheet" href="<?=base_url("/public/assets/jquery.Thailand.js/dist/jquery.Thailand.min.css") ?>">
<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dist/jquery.Thailand.min.js") ?>"></script>
<script>

    $(document).ready(function () {
        $("#profile").change(function() {
            let input = this
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    $.Thailand({
        database: '<?=base_url("/public/assets/jquery.Thailand.js/database/db.json") ?>', // path หรือ url ไปยัง database
        $district: $('#district'), // input ของตำบล
        $amphoe: $('#amphoe'), // input ของอำเภอ
        $province: $('#province'), // input ของจังหวัด
        $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
    });
    const imgToBase64 = (file) => {
        return new Promise((resolve, reject) => {
           var reader = new FileReader();
            reader.onload = function(e) {
                resolve(e.target.result)
            }
            reader.readAsDataURL(file);
        })
    }

    $("#save").click(async function(){
        event.preventDefault();
        var isValid = $("#add-workplace").valid();
        var workplaceFormData = $("#add-workplace").serialize();
        if(isValid){
            var workplaceFormData = $("#add-workplace").serialize();
            var files = $("#profile").prop('files')
            var base64
            if(files && files[0]){
               let base64 = await imgToBase64(files[0])
               workplaceFormData += '&picture='+base64;
            }
            $.post("<?=base_url("api/workplace/create"); ?>",workplaceFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/workplace')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })
    function createWorkplace(){
        // event.preventDefault();
        // var isValid = $("#workplace-form").valid();
        // var workplaceFormData = $("#workplace-form").serialize();
        // if(isValid){
        //     var myform = document.getElementById("workplace-form");
        //     var formData = new FormData(myform);
        //     var file = document.querySelector('#workplace-form input[type="file"]').files[0];
        //     getBase64(file).then(
        //         data => {
        //             formData.append('picture64', data);
        //             $.ajax({
        //                 url: base_url+"api/workplace/create", 
        //                 type: "POST",             
        //                 data: formData,
        //                 cache: false,
        //                 contentType: false,
        //                 processData: false,
        //                 success: function(data){
        //                     if(data.message == 200){
        //                         showMessage(data.message,"admin/workplace");
        //                     }else{
        //                         showMessage(data.message);
        //                     }
        //                 }
        //             });
        //         }
        //     );   
        // }
    }
    function getBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }

    $("#coordinates").click(function(){
        console.log("#coordinates")
        navigator.geolocation.getCurrentPosition((location) => {
            console.log(location.coords.latitude);
            console.log(location.coords.longitude);
            console.log(location.coords.accuracy);
            document.getElementById("latitude").value = (location.coords.latitude);
            document.getElementById("longitude").value = (location.coords.longitude);
        });
    });
    $("#add-workplace").validate({
        rules: {
            workplace_id: {
                required: true
            },
            workplace_name:{
                required: true
            },
            email:{
                required: true,
                email: true
            },
            address:{
                required: true
            },
            phone:{
                required: true,
                minlength:10
            },
            managerName:{
                required: true
            },
            job_position:{
                required: true
            },
            latitude:{
                required: true
            },
            longitude:{
                required: true
            },
            sub_district :{
                required: true
            },
            district :{
                required: true
            },
            province :{
                required: true
            },
            zipcode :{
                required: true
            },
            // yearId :{
            //     required: true
            // },
            // picture :{
            //     required: true
            // },
            workplace_type_id :{
                required: true
            },
            manager_name :{
                required: true
            }

            
         
        },
        messages: {
            workplace_name:{
                required: "กรุณากรอกชื่อสถานที่"
            },
            email:{
                required: "กรุณากรอก email"
            },
            address:{
                required: "กรุณากรอกที่อยู่"
            },
            phone:{
                required: "กรุณากรอกเบอร์โทรศัพท์มือถือ",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            managerName:{
                required: "กรุณากรอกชื่อผู้บริหารสำหรับอนุญาต"
            },
            job_position:{
                required: "กรุณากรอกตำแหน่ง"
            },
            latitude:{
                required: "กรุณากรอกละติจูด"
            },
            longitude:{
                required: "กรุณากรอกลองจิจูด"
            },
            workplace_typeId:{
                required: "กรุณาเลือกชนิดแหล่งฝึก"
            },
            workplaceId:{
                required: "กรุณากรอกไอดี"
            },
            sub_district:{
                required: "กรุณากรอกตำบล"
            },
            district:{
                required: "กรุณากรอกอำเภอ"
            },
            province:{
                required: "กรุณากรอกจังหวัด"
            },
            zipcode:{
                required: "กรุณากรอกรหัสไปรษณีย์"
            },
            // yearId:{
            //     required: "กรุณาเลือกปีการศึกษา"
            // },
            // picture:{
            //     required: "กรุณาเลือกรูป"
            // },
            workplace_type_id :{
                required: "กรุณาเลือกชนิดแหล่งฝึก"
            },
            manager_name :{
                required: "กรุณาชื่อผู้บริหาร"
            }    
                
        },
    });
</script>

