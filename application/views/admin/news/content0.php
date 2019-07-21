<head>
    <!-- <link href="<?=base_url("/public/vendor/sweetAlert2/css/sweetalert2.css") ?>" rel="stylesheet">
    <script src="<?=base_url("/public/vendor/sweetAlert2/js/sweetalert2.js") ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <!-- <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> -->
    
</head>


<div class = "page-wrapper">

<div class="row page-titles">
<div class="col-md-5 align-self-center">
    <h3 class="text-primary">ข่าวประกาศ</h3>  
</div>

</div>
<!-- End Bread crumb -->
<!-- Container fluid  -->
<div class="container-fluid">

<!-- <input type="hidden" id="news_id" value="<?=$news_id?>"> -->
<div class="row p-30">  
    <div class="col-lg-5">
        <form>
            <div class="input-group input-group-flat">
                <label class="col-lg-5 col-form-label">ค้นหาข่าวประกาศ : </label>
                <input type="text" name="search" class="form-control input-default" id="news-search" value="" placeholder="ค้นหา...">
                <span class="input-group-btn"><button class="btn btn-success" type="submit" id="btn-search" style="height: 42px"><i class="ti-search" ></i></button></span>
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="input-group input-group-flat">
            <label class="col-lg-3 col-form-label">จัดเรียง: </label>
            <select class="form-control input-default" name="column" id="column">
                <option value="1">เรียงลำดับจาก ก-ฮ</option>
                <option value="2">เรียงลำดับจาก ฮ-ก</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <form action="<?php echo base_url("admin/news/add");?>">
            <button class="btn btn-success" type="submit" ​​​​​>เพิ่มข่าวประกาศ</button>
        </form>        
    </div>
    </div>
</div>
    <div class="container-fluid">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">หัวข้อข่าว</th>
                        <th></th>       
                        <th scope="col">วันที่ประกาศ</th>
                        <th scope="col">แก้ไข</th>        
                    </tr>
                </thead>
            <?php
                foreach ($newss as $news) :?>
                    <tr>
                        <td><?= $news['news_title']?></td>
                        <td></td>
                        <!-- <td><?= $news['news_detail']?></td> -->
                        <td><?= $news['end_date']?></td>
                        <td>  
                            <form action="<?=base_url("admin/news/update"); ?>" method="post">
                                <input type="hidden" name="newsId" value="<?php echo $news['news_id']; ?>" >
                                <button type="submit" class="btn btn-primary"  value="submit" name="submit" ><i class="fa fa-edit" ></i></button>

                                <button type="button" class="btn btn-danger delete"  data-news_id="<?php echo $news['news_id']; ?>" data-news_title="<?php echo $news['news_title']; ?>" data-toggle="modal" data-target="#delete-modal">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </form>  
                        </td> 
                        
                    </tr>
                    <input type="hidden" id="newsId" name="newsIds" value="" >
                    </form>
            <?php endforeach;?>
        </table>
    </div>

<!-- Delete Modal -->
<div class="modal" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="news_delete"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm-delete" name="confirm-delete" class="btn btn-danger">ลบ</button>
                </div>
            </div>
        </form>
    </div>
</div>




