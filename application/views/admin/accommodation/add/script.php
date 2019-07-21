<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dependencies/JQL.min.js") ?>"></script>
<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dependencies/typeahead.bundle.js") ?>"></script>
<link rel="stylesheet" href="<?=base_url("/public/assets/jquery.Thailand.js/dist/jquery.Thailand.min.css") ?>">
<script type="text/javascript" src="<?=base_url("/public/assets/jquery.Thailand.js/dist/jquery.Thailand.min.js") ?>"></script>
<script>

    $.Thailand({
        database: '<?=base_url("/public/assets/jquery.Thailand.js/database/db.json") ?>', // path หรือ url ไปยัง database
        $district: $('#district'), // input ของตำบล
        $amphoe: $('#amphoe'), // input ของอำเภอ
        $province: $('#province'), // input ของจังหวัด
        $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
    });

    $("#save").click(function(){
        event.preventDefault();
        var isValid = $("#accommodation-form").valid();   
        if(isValid){
            var accommodationFormData = $("#accommodation-form").serialize();
            $.post("<?=base_url("api/accommodation/create"); ?>",accommodationFormData,
            function(data){
                showMessage(200,data.message,"<?=base_url('admin/accommodation?workplace_id='.$workplace_id);?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
            
        }
    })

    $("#accommodation-form").validate({
        rules: {
            accommodation_name: {
                required: true
            },
            description: {
                required: true
            },
            contact_name: {
                required: true
            },
            tel: {
                required: true,
                minlength:10,
                maxlength:10
            },
            address:{
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
            }
        },
        messages: {
            accommodation_name:{
                required: "กรุณากรอกชื่อที่พัก"
            },
            description:{
                required: "กรุณากรอกข้อมูลทั่วไป"
            },
            contact_name:{
                required: "กรุณากรอกชื่อผู้ติดต่อ"
            },
            tel:{
                required: "กรุณากรอกเบอโทรศัพท์",
                minlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก",
                maxlength: "กรุณากรอกเบอร์โทรศัพท์มือถือให้ครบ 10 หลัก"
            },
            address:{
                required: "กรุณากรอกที่อยู่"
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