<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        



        $("#update").click(function(){
            event.preventDefault();
            var isValid = $("#newsupdate-form").valid();   
            if(isValid){
                var newsFormData = $("#newsupdate-form").serialize();
                $.post("<?=base_url("api/news/create"); ?>",newsFormData,
                function(data){
                    showMessage(200,data.message,"<?=base_url('admin/news');?>");
                }).fail(function(data) {
                    showMessage(data.status,data.responseJSON.message)
                })
                
            }
        })

    // $("#newsupdate-form").validate({
    //         rules: {
    //             newstype: {
    //                 required: true
    //             },
    //             newsname:{
    //                 required: true
    //             },
    //             txtMessage:{
    //                 required: true
    //             },
    //             file:{
    //                 required: true
    //             },
    //             enddate:{
    //                 required: true
    //             },
    //             announcer:{
    //                 required: true
    //             }
            
    //         },
    //         messages: {
    //             newstype:{
    //                 required: "กรุณาระบุประเภทข่าวประกาศ"
    //             },
    //             newsname:{
    //                 required: "กรุณากรอกชื่อข่าวประกาศ"
    //             },
    //             txtMessage:{
    //                 required: "กรุณากรอกรายละเอียด"
    //             },
    //             file:{
    //                 required: "กรุณาเลือกไฟล์"
    //             },
    //             enddate:{
    //                 required: "กรุณาระบุวันที่สิ้นสุด"
    //             },
    //             announcer:{
    //                 required: "กรุณากรอกผู้ประกาศ"
    //             }
                    
    //         },
    //     });
    });
</script>