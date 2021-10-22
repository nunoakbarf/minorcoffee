<div style="width:100%;background:url(<?=base_url()?>assets/dist/img/bg.jpg);background-attachment:fixed;">

<!----------- HEADER ----------->
<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?= base_url('assets/dist/img/header/header1.jpg')?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url('assets/dist/img/header/header2.png')?>" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url('assets/dist/img/header/header3.png')?>" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url('assets/dist/img/header/header4.png')?>" alt="Third slide">
    </div>
  </div>
</div> -->


<!------- WELCOME ------->
<div class="row mx-auto pl-5 pt-5 bg-white" style="width:100%;">
	<div class="row col-md-12 m-0">
    <div class="row col-md-12 mx-auto ml-3">
      <h1 class="text-black font-weight-bold ml-2">SELAMAT DATANG DI MINOR COFFEE</h1>
    </div>
    <div class="row col-md-12 mx-auto">
      <div class="text-black font-weight-bold bg-dark ml-2" style="width:5%;height:5px;margin-top:0;"></div>
    </div>
    <div class="row col-md-6 mx-auto mt-3">
      <h3 class="text-black font-weight-light">"SAYA BANGGA ATAS KOMITMEN KAMI UNTUK PERTANIAN BERKELANJUTAN DAN ORGANIK. KAMI BERUSAHA MEMPERTAHANKAN KESEIMBANGAN ALAM SELAMA MEMPRODUKSI KOPI DENGAN RASA KAYA, BOLD UNTUK ORANG DI SELURUH DUNIA UNTUK MENIKMATI SETIAP HARI.”</h3>
    </div>
    <div class="row col-md-6">
      <img id="img-welcome" src="<?= base_url('assets/dist/img/coffee.png')?>">
    </div>
  </div>
  <!------- KATEGORI ------->
  <div class="row col-md-12 mt-5 mx-auto">
    <div class="col-md-12">
      <h4 class="text-dark font-weight-bold ml-3">Kategori</h4>
    </div>
    <div class="row col-md-12 mb-5 mx-auto">
      <div class="col-md-8">
        <?php foreach($category as $p){ ?>
          <div class="col-list-3">
            <div class="recent-car-list rounded">
                <a id="callout" href="<?= base_url('produk/daftar/'), $p['cat_id']; ?>" target="blank" style="text-decoration:none">
                  <div id="callout" class="callout m-0 p-2">
                    <div class="row col-md-12">
                      <div class="col-md-3">
                        <img alt="foto" width="50px" src="<?= base_url('assets/dist/img/favicon.png')?>">
                      </div>
                      <div class="col-md-9">
                        <h6 class="font-weight-bold m-0"><?= $p['cat_name']; ?></h6>
                        <h6 class="font-weight-light m-0" style="font-size:10px;">Ngopi Digang</h6>
                      </div>
                    </div>
                  </div>
                </a>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</div>


<!------- MENU HERE ------->
<div class="bg-white col-md-12 p-0">
<div class="row mx-auto pb-5 pt-5" style="background-size:cover;background:url(<?=base_url()?>assets/dist/img/menu.jpg) repeat-x;">
	<div class="row col-md-12 mx-auto">
    <h1 class="mx-auto text-black font-weight-bold">MENU KITA</h1>
  </div>
	<div class="row col-md-12 mx-auto mb-3">
    <hr class="mx-auto" style="width:5%;height:5px;margin-top:0;background:black;">
  </div>

    <div id="menu-kita" class="row col-md-12 mx-auto">
      <div class="col-md-4 mx-auto">
        <div class="card mb-3" style="background-color:rgb(255,255,255, .8)">
          <div class="card-header bg-dark"><h3 class="m-0 text-white font-weight-bold">COFFEEE</h3></div>
          <div class="card-body p-2">
            <table class="table">
              <?php foreach($menukopi as $mk){ ?>
              <tbody>
                <tr>
                  <td><b class="text-dark"><?= $mk['prod_name']; ?></b></td>
                  <td class="font-weight-bold" align="right">Rp. <?= number_format($mk['prod_price']); ?>,-</td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4 mx-auto">
        <div class="card mb-3" style="background-color:rgb(255,255,255, .8)">
        <div class="card-header bg-dark"><h3 class="m-0 text-white font-weight-bold">NON COFFEEE</h3></div>
          <div class="card-body p-2">
            <table class="table">
              <?php foreach($tidakkopi as $tk){ ?>
              <tbody>
                <tr>
                  <td><b class="text-dark"><?= $tk['prod_name']; ?></b></td>
                  <td class="font-weight-bold" align="right">Rp. <?= number_format($tk['prod_price']); ?>,-</td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>

    </div>

</div>
</div>

<!------- GAMBAR MENU ------->
<div id="produk" class="carousel slide bg-light" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#produk" data-slide-to="0" class="active"></li>
    <li data-target="#produk" data-slide-to="1"></li>
    <li data-target="#produk" data-slide-to="2"></li>
  </ol>
</div>


    
    
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
<script>
function openPills(cityName) {
  var i;
  var x = document.getElementsByClassName("pills");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";
}
</script>