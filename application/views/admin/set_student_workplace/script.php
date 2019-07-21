<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#course_id').change(function (e) { 
            e.preventDefault();
            window.location.replace("<?= base_url('admin/set_student_workplace?course_id=')?>"+$('#course_id').val());
        });



        var lastScrollTop = $.cookie('last-scroll-top');
        if (lastScrollTop) {
            console.log(lastScrollTop)
            $(window).scrollTop(lastScrollTop);
            $.removeCookie('last-scroll-top');
        }
        $('#example').DataTable({
            "paging":   false,
            "info":     false,
            "searching": false,
            // "scrollY": "150px",
            // "scrollCollapse": true,
            "columnDefs": [
                { "orderable": false, "targets": 2 },
                { "orderable": false, "targets": 3 },
                { "orderable": false, "targets": 4 },
                { "orderable": false, "targets": 5 },
                { "orderable": false, "targets": 6 },
                { "orderable": false, "targets": 7 },
                { "orderable": false, "targets": 1 }
            ],
        })

        $('.subject').change(function (e) { 
            let subject_teach_id = this.value
            let student_id = $(this).data('student-id')
            let schedule = $(this).data('schedule')
            let year = <?= $year ?>;
            $.post("<?=base_url('api/enroll/setWorkplaceToStudent')?>",{
                subject_teach_id: subject_teach_id, 
                student_id: student_id, 
                schedule: schedule, 
                year: year
            },
            function(data){
                $.cookie('last-scroll-top', $(window).scrollTop());
                showMessage(200,data.message,"<?= base_url('admin/set_student_workplace?course_id='.$course_id)?>");
            }).fail(function(data) {
                showMessage(data.status,data.responseJSON.message)
            })
        });
    } );
 </script>