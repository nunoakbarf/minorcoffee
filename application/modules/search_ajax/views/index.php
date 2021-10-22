<html>
<head>
  <title><?= $judul ?></title>
  <!-- Icon -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/dist/img/favicon.png')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css')?>">
</head>

<body>
  <div class="col-md-7 mx-auto m-3">
    <h1 class="text-center font-weight-bold">Pencarian Menggunakan AJAX</h1><hr>
  </div>
  <div class="col-md-7 mx-auto">
    <div class="input-group">
      <input class="form-control" type="text" id="keyword" placeholder="Cari Produk">
      <button class="btn btn-warning" type="button" id="btn-search">Search</button>
      <a class="btn btn-outline-danger ml-2" href="<?php echo base_url(); ?>">Reset</a>
    </div>
  </div>

  
  <br>
  <div class="col-md-7 mx-auto" id="view">
    <?php $this->load->view('view', array('products'=>$products)); ?>
  </div>

</body>

  <!-- Java Script -->
  <script>
    var baseurl = "<?php echo base_url("index.php/"); ?>";
  </script>
  <script src="<?php echo base_url('assets/dist/js/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/dist/js/config.js')?>"></script>
</html>