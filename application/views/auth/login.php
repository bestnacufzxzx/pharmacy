<html lang="en">
<style>
    .img-login{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        background-repeat: initial;
        background-image: url(https://www.ashworthcollege.edu/images/blog/pharmacy-technician-training-tools-in-the-lab.jpg);
    }
    .login-form{
        
    }
</style>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/themes/css/custom.css') ?>">
    
        <title>Login</title>

    </head>
    <body class="d-flex flex-column h-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?=base_url()?>" style="color: white !important;">
                    <img src="<?=base_url()?>/public/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Pharmacy
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link cwhite" href="<?=base_url()?>">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cwhite" href="#">ผลัด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cwhite" href="#">แหล่งฝึก</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <a href="#" class="cwhite" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-sign-in" aria-hidden="true"></i> เข้าสู่ระบบ</a>
                    </span>
                </div>
            </nav>
        </header>
        <br>
        <main role="main" class="flex-shrink-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">กิจกรรมศึกษา</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">ขอพบนักศึกษา</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">กิจกรรมอื่นๆ</span></a> </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active show" id="home" role="tabpanel">
                                        <div class="p-20">
                                            <ul class="list-group list-group-flush">
                                                <?php foreach ($newss1 as $news1) :?>
                                                <a class="list-group-item list-group-item-action" href="<?=base_url("auth/shownews?newsid={$news1['news_id']}") ?>" >
                                                <?php echo $news1['news_title'];?> 
                                                <small><font color="gray">ผู้ประกาศ <?php echo $news1['name_title'];?> <?php echo $news1['firstname'];?> <?php echo $news1['lastname'];?>  </font></small></a>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-20" id="profile" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <?php
                                                foreach ($newss2 as $news2) :?>
                                            <a class="list-group-item list-group-item-action" href="<?=base_url("auth/shownews?newsid={$news2['news_id']}") ?>" ><?php echo $news2['news_title'];?> <small><font color="gray">ผู้ประกาศ <?php echo $news2['firstname'];?>  <?php echo $news1['lastname'];?>  </font></small></a>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <div class="tab-pane p-20" id="messages" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <?php
                                                foreach ($newss3 as $news3) :?>
                                            <a class="list-group-item list-group-item-action" href="<?=base_url("auth/shownews?newsid={$news3['news_id']}") ?>"><?php echo $news3['news_title'];?> <small><font color="gray">ผู้ประกาศ <?php echo $news3['firstname'];?>  <?php echo $news1['lastname'];?>  </font></small></a>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                ผลัด
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                แหล่งฝึก
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal Shownews -->
                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1"  role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id=title></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="card card-body"  id="content">  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
                </div>
                <!-- modal Login -->
                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                <form id="form-login">
                    <div class="modal-content">
                        <div class="card">
                            <div class="container">
                            <div class="d-flex justify-content-center">
                                <img class="" src="<?=base_url('/public/images/logo.png')?>" style="height:80%;width: 70%;">
                            </div>
                            <div class="form-group md-6">
                                <br>
                                <input class="form-control" name="username" id="username" aria-describedby="" placeholder="ชื่อผู้ใช้งาน">
                                <div class="text-left error" id="username-error"></div>
                            </div>
                            <div class="form-group md-6">
                                <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน">
                                <div class="text-left error" id="password-error"></div>
                                <div class="text-left error" id="error-message"><span id="message"></span></div>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn btn-info" id="login">เข้าสู่ระบบ</button><br>
                            </div>
                            <br>       
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </main>
    
        <footer class="footer mt-auto py-3">
            <div class="container">
                <span class="text-muted">© Copyright 2019, Walailak University</span>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="<?= base_url('public/assets/jquery/jquery.validate.min.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script>
            $(document).ready(function() {

                $('#form-login').validate({
                    rules: {
                        username: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        username: {
                            required: "กรุณากรอกชื่อผู้ใช้งาน"
                        },
                        password: {
                            required: "กรุณากรอกรหัสผ่าน"
                        }
                    }
                });

                $('a#check').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#myModal').data('id', id).modal('show');
                    $("#title").html($(this).data("title"));
                    $("#content").html($(this).data("news-detail"));
                });		     


            $("#form-login").submit(function(e){
                e.preventDefault();
                // validator.resetForm();
                var isValid = $("#form-login").valid();
                if(isValid){
                    $("#error-message").hide();
                    var loginData = $("#form-login").serialize();
                    $.post("<?=base_url("api/auth/login")?>",loginData,
                    function(data){
                        window.location = data.url
                    }).fail(function(data) {
                        let message = data.responseJSON.message
                        Swal.fire({
                            type: 'error',
                            title: message,
                            text: 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
                        })
                    })
                }
            })
        });
        </script>
    </body>
</html>

