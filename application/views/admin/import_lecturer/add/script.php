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
        var isValid = $("#add-lecturer").valid();
        var lecturerFormData = $("#add-lecturer").serialize();
        if(isValid){
            var lecturerFormData = $("#add-lecturer").serialize();
            var files = $("#profile").prop('files')
            var base64
            if(files && files[0]){
               let base64 = await imgToBase64(files[0])
               lecturerFormData += '&picture='+base64;
            }
            $.post("<?=base_url("api/lecturer/create"); ?>",lecturerFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/import_lecturer')?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })

    function createLecturer(){
        
    }

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

    $("#add-lecturer").validate({
        rules: {
            name_title: {
                required: true
            },
            lecturer_id: {
                required: true
            },
            firstname:{
                required: true
            },
            lastname:{
                required: true
            },
            date_of_birth:{
                required: true
            },
            email:{
                required: true,
                email: true
            },
            department:{
                required: true
            },
            phone:{
                required: true,
                minlength:10
            },
            phone2:{
                required: true,
                minlength:10
            },
            address:{
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
            date_of_birth:{
                required: "กรุณาเลือกวัน เดือน ปี เกิด"
            },
            email:{
                required: "กรุณากรอก email"
            },
            department:{
                required: "กรุณากรอกสาขา"
            },
            address:{
                required: "กรุณากรอกที่อยู่"
            },
            phone:{
                required: "เบอร์โทรศัพท์ที่ติดต่อได้",
                minlength: "กรุณากรอกเบอร์โทรศัพท์ที่ติดต่อได้ห้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์ที่ติดต่อได้ให้ครบ 10 หลัก"
            },
            phone2:{
                required: "กรุณากรอกเบอร์โทรศัพท์มือถือ",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
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
            }
        },
    });
</script>