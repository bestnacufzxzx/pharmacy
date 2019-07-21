<div class="page-wrapper">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  </head>
  <body><br>
    <div class="container">
            <div class="card">
                <div class="card-body">
                    <?php foreach ($newsdetails as $newsdetails1) :?>
                    <h1><?php echo $newsdetails1['news_title'];?></h1>
                    <p><?php echo $newsdetails1['news_detail'];?></p>
                        <?php endforeach;?>
                </div>
            </div>
        </div>
    </body>
</div>