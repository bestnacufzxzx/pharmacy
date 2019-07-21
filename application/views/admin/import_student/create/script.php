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
    $.Thailand({
        database: '<?=base_url("/public/assets/jquery.Thailand.js/database/db.json") ?>', // path หรือ url ไปยัง database
        $district: $('#district1'), // input ของตำบล
        $amphoe: $('#amphoe1'), // input ของอำเภอ
        $province: $('#province1'), // input ของจังหวัด
        $zipcode: $('#zipcode1'), // input ของรหัสไปรษณีย์
    });

    $.Thailand({
        database: '<?=base_url("/public/assets/jquery.Thailand.js/database/db.json") ?>', // path หรือ url ไปยัง database
        $district: $('#district2'), // input ของตำบล
        $amphoe: $('#amphoe2'), // input ของอำเภอ
        $province: $('#province2'), // input ของจังหวัด
        $zipcode: $('#zipcode2'), // input ของรหัสไปรษณีย์
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
        var isValid = $("#student-form").valid();
        if(isValid){
            var studentFormData = $("#student-form").serialize();
            var files = $("#profile").prop('files')
            var base64
            if(files && files[0]){
               let base64 = await imgToBase64(files[0])
               studentFormData += '&picture='+base64;
            }
            $.post("<?=base_url("api/Student/create"); ?>",studentFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/import_student')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })


    // function updateUser(){
    //     event.preventDefault();
    //     var isValid = $("#student-form").valid();
    //     var studentFormData = $("#student-form").serialize();
    //     if(isValid){
    //         var myform = document.getElementById("student-form");
    //         var formData = new FormData(myform);
    //         var file = document.querySelector('#student-form input[type="file"]').files[0];
    //         getBase64(file).then(
    //             data => {
    //                 formData.append('picture64', data);
    //                 $.ajax({
    //                     url: base_url+"api/Student_Admin/create", 
    //                     type: "POST",             
    //                     data: formData,
    //                     cache: false,
    //                     contentType: false,
    //                     processData: false,
    //                     success: function(data){
    //                         if(data.message == 200){
    //                             showMessage(data.message,"admin/importstudent");
    //                         }else{
    //                             showMessage(data.message);
    //                         }
    //                     }
    //                 });
    //             }
    //         );
            
            
            
    //     }
    // }
    // function getBase64(file) {
    //     return new Promise((resolve, reject) => {
    //         const reader = new FileReader();
    //         reader.readAsDataURL(file);
    //         reader.onload = () => resolve(reader.result);
    //         reader.onerror = error => reject(error);
    //     });
    // }

    // var studentForm = $("#student-form");
    // studentForm.submit(function(){
    //     event.preventDefault();
    //     var isValid = $("#student-form").valid;
    //     if(isValid){
    //         var studentFormData = studentForm.serialize();
    //         $.post(base_url+"api/Student/update",studentFormData,
    //         function(data){
    //             console.log(data.message);
    //         });
    //     }
    // });

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

   

        $("#student-form").validate({
        rules: {
            name_title: {
                required: true
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            nickname:{
                required: true
            },
            student_id:{
                required: true,
                minlength:8,
                maxlength:8
            },
            id_card:{
                required: true,
                pid:true
            },
            date_of_birth:{
                required: true
            },
            level:{
                required: true
            },
            address:{
                required: true
            },
            phone:{
                required: true,
                minlength:10,
                maxlength:10
            },
            email:{
                required: true,
                email: true
            },
            address_emergency:{
                required: true
            },
            father_name:{
                required: true
            },
            father_job:{
                required: true
            },
            mother_name:{
                required: true
            },
            mother_job:{
                required: true
            },
            address_parent:{
                required: true
            },
            phone_father:{
                required: true,
                minlength:10,
                maxlength:10
            },
            phone_mother:{
                required: true,
                minlength:10,
                maxlength:10
            },
            hobbies:{
                required: true
            },
            talent:{
                required: true
            },
            trait:{
                required: true
            },
            member_in_family:{
                required: true
            },
            member_all_family:{
                required: true
            },
            congenital_disease:{
                required: true
            },
            allergy_history:{
                required: true
            },            
            sub_district:{
                required: true
            },
            district:{
                required: true
            },
            province:{
                required: true
            },
            zipcode:{
                required: true
            },            
            sub_district_emergency:{
                required: true
            },
            district_emergency:{
                required: true
            },
            province_emergency:{
                required: true
            },
            zipcode_emergency:{
                required: true
            },            
            sub_district_parent:{
                required: true
            },
            district_parent :{
                required: true
            },
            province_parent :{
                required: true
            },
            zipcode_parent :{
                required: true
            }                                      
        },
        messages: {
            name_title: {
                required: "กรุณาเลือกคำนำหน้าชื่อ"
            },
            firstname: {
                required: "กรุณากรอกชื่อนักศึกษา"
            },
            lastname: {
                required: "กรุณากรอกนามสกุลนักศึกษา"
            },
            nickname:{
                required: "กรุณากรอกชื่อเล่น"
            },
            student_id:{
                required: "กรุณากรอกรหัสนักศึกษา",
                minlength: "กรุณากรอกรหัสนักศึกษาให้ครบ 8 ตัว",
                maxlength: "กรุณากรอกรหัสนักศึกษาให้ครบ 8 ตัว"
            },
            id_card:{
                required: "กรุณากรอกเลขที่บัตรประชาชน",
            },
            date_of_birth:{
                required: "กรุณาเลือกวัน เดือน ปี เกิด"
            },
            level:{
                required: "กรุณากรอกชั้นปี"
            },
            lecturer_id:{
                required: "กรุณาเลือกอาจารย์ที่ปรึกษา"
            },
            phone:{
                required: "กรุณากรอกเบอร์โทรศัพท์มือถือ",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            email:{
                required: "กรุณากรอกอีเมล",
                email: "กรุณากรอกอีเมลให้ถูกต้อง"
            },
            address_emergency:{
                required: "กรุณากรอกชื่อและที่อยู่ของผู้ที่จะติดต่อกรณีฉุกเฉิน"
            },
            father_name:{
                required: "กรุณากรอกชื่อ-นามสกุลบิดา"
            },
            father_job:{
                required: "กรุณากรอกอาชีพบิดา"
            },
            mother_name:{
                required: "กรุณากรอกชื่อ-นามสกุลมารดา"
            },
            mother_job:{
                required: "กรุณากรอกอาชีพมารดา"
            },
            address_parent:{
                required: "กรุณากรอกที่อยู่ผู้ปกครอง"
            },
            phone_father:{
                required: "กรุณากรอกเบอร์โทรศัพท์มือถือ",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ  10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            phone_mother:{
                required: "กรุณากรอกเบอร์โทรศัพท์",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ  10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            hobbies:{
                required: "กรุณากรอกงานอดิเรก"
            },
            talent:{
                required: "กรุณากรอกความสามารถพิเศษ"
            },
            trait:{
                required: "กรุณากรอกอุปนิสัยส่วนตัว"
            },
            trait:{
                required: "กรุณากรอกอุปนิสัยส่วนตัว"
            },
            meumber_in_family:{
                required: "กรุณากรอกเป็นบุตรคนที่เท่าไหร"
            },
            member_all_family:{
                required: "กรุณากรอกเป็นบุตรคนที่เท่าไหรจากจำนวนทั้งหมด"
            },
            congenital_disease:{
                required: "กรุณากรอกโรคประจำตัว"
            },
            allergy_history:{
                required: "กรุณากรอกประวัติการแพ้ยา"
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
            sub_district_emergency:{
                required: "กรุณากรอกตำบล"
            },
            district_emergency:{
                required: "กรุณากรอกอำเภอ"
            },
            province_emergency:{
                required: "กรุณากรอกจังหวัด"
            },
            zipcode_emergency:{
                required: "กรุณากรอกรหัสไปรษณีย์"
            },
            sub_district_parent:{
                required: "กรุณากรอกตำบล"
            },
            district_parent:{
                required: "กรุณากรอกอำเภอ"
            },
            province_parent:{
                required: "กรุณากรอกจังหวัด"
            },
            zipcode_parent:{
                required: "กรุณากรอกรหัสไปรษณีย์"
            }
            
        },
    });
</script>