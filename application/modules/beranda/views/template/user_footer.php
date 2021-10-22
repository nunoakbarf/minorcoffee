<!------- FOOTER ------->
<div class="row mx-auto bg-light pb-5">
  <div class="col-lg-4 text-right">
    <a href="<?= base_url('beranda') ?>"><img class="img-footer mr-5 mt-5" alt="foto" width="35%" src="<?= base_url('assets/dist/img/favicon.png') ?>"></a>
  </div>
  <div class="col-lg-3 pt-5 d-flex">
    <div class="col-footer">
      <h4 class="font-weight-bold text-dark">MINOR COFFEE OFFICIAL</h4>
      <p class="card-text text-dark">
        <a href="<?= base_url('beranda/vendor') ?>" class="text-dark" style="cursor:pointer;">Apa Itu Mitra ?</a><br>
        <a href="<?= base_url('beranda/about') ?>" class="text-dark" style="cursor:pointer;">Tentang Kami</a><br>
      <p class="card-text text-dark">
        <a href="mailto:minorcoffee1@gmail.com" class="text-dark" style="cursor:pointer;">Layanan Pelanggan</a><br>
        <a href="<?= base_url('beranda/about') ?>" class="text-dark" style="cursor:pointer;">Cara Pemesanan</a><br>
    </div>
  </div>
  <div class="col-lg-4 pt-5 d-flex">
    <div class="col-footer">
      <h4 class="font-weight-bold text-dark">KONTAK</h4>
      <div class="col-footer">
        <a class="card-text text-dark">Jl. Pucangkerep No.211, Nganguk</a><br>
        <a class="card-text text-dark">Kec. Kota Kudus, Kabupaten Kudus</a><br>
        <pa class="card-text text-dark">Jawa Tengah 59312</a><br>
      </div>
      <a href="https://www.instagram.com/minor.coffee.b/" target="blank" class="fa fa-instagram text-dark text-center p-2 rounded" style="font-size:30px;"></a>
      <a href="mailto:minorcoffee1@gmail.com" target="blank" class="fa fa-google text-dark text-center p-2 rounded mt-2" style="font-size:30px;"></a>
    </div>
  </div>
</div>
<div class="row col-md-12 p-3 m-0" style="background-color:black;">
  <div class="col-md-1"></div>
  <div class="col-md-4 ml-5 text-white">Copyright © 2020 | Powered by MINOR COFFEE</div>
  <div class="col-md-6 text-right">
  </div>
  <div class="col-md-1 text-right"></div>
</div>

<a href="javascript:void(0);" id="scroll" title="Back To Top" style="display: none;">TOP<span></span></a>




<!------- Optional JavaScript ------->
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $(".preloader").fadeOut();
  })
</script>
<script src="<?= base_url('assets/dist/js/code.jquery.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/cdn.jsdelivr.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/stackpath.bootstrapcdn.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/ScrollSmooth.js') ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="<?= base_url('assets/dist/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/jquery.scrolly.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/skel.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/util.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/main.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------- BACK TO TOP ------->
<script type="text/javascript">
  $(document).ready(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        $('#scroll').fadeIn();
      } else {
        $('#scroll').fadeOut();
      }
    });
    $('#scroll').click(function() {
      $("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  });
</script>

<!------- POP OVER ------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();
  });
</script>


<!------- AJAX SEARCH AUTOCOMPLETE ------->
<script src="<?= base_url('assets/dist/js/autocomplete/handlebars.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/autocomplete/typeahead.bundle.js') ?>"></script>
<script>
  $(document).ready(function() {
    var sample_data = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: '<?= base_url(); ?>beranda/fetch',
      remote: {
        url: '<?= base_url(); ?>beranda/fetch/%QUERY',
        wildcard: '%QUERY'
      }
    });


    $('#prefetch .typeahead').typeahead(null, {
      name: 'sample_data',
      display: 'name',
      source: sample_data,
      limit: 10,
      templates: {
        suggestion: Handlebars.compile(
          '<div id="search-show" class="row mx-auto p-2 shadow"><div class="col-md-3" style="padding-right:5px; padding-left:5px;"><img src="<?= base_url() ?>gambar/{{image}}" class="img-thumbnail" width="48" /></div><div class="col-md-9"><span class="font-weight-bold text-dark">{{name}}</span><br><small class="font-italic text-dark">Rp. {{price}},-</small></div></div>'
        )
      }
    });
  });
</script>

<!------- AJAX SEARCH CART ------->
<script>
  $(document).ready(function() {

    load_data();

    function load_data(query) {
      $.ajax({
        url: "<?= base_url(); ?>cart/fetch",
        method: "POST",
        data: {
          query: query
        },
        success: function(data) {
          $('#result').html(data);
        }
      })
    }

    $('#search_text').keyup(function() {
      var search = $(this).val();
      if (search != '') {
        load_data(search);
      } else {
        load_data();
      }
    });
  });
</script>

<script>
  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    //WELCOME TO MINOR COFFEE
    if (document.body.scrollTop > 550 || document.documentElement.scrollTop > 250) {
      document.getElementById("welcome").style.opacity = "1";
      document.getElementById("welcome").style.paddingTop = "0";
    } else {
      document.getElementById("welcome").style.opacity = "0";
      document.getElementById("welcome").style.paddingTop = "80px";
    }

    //PRODUK KITA
    if (document.body.scrollTop > 850 || document.documentElement.scrollTop > 850) {
      document.getElementById("produk-kita").style.opacity = "1";
      document.getElementById("produk-kita").style.paddingTop = "0";
    } else {
      document.getElementById("produk-kita").style.opacity = "0";
      document.getElementById("produk-kita").style.paddingTop = "80px";
    }
  }
</script>

<script>
  $(document).ready(function() {
    $("#message-center").modal('show');
  });
</script>

<script>
  $(document).ready(function() {
    $('#jasakirim').change(function() {
      $('#cod').click(function() {
        $('#bukti').hide();
      })
      $('#tf').click(function() {
        $('#bukti').show();
      })
      // var a = $(this).find('#tf');
      // var b = $(this).find('#cod');
      // if (b) {
      //   $('#bukti').hide();
      // }else if(a){
      //   $('#bukti').show();
      // }else{
      //   $('#bukti').show();
      // }
      // var a = $('option').find('#cod');
      // if (a === 1) {
      //   $('#bukti').hide();
      // }else{
      //   $('#bukti').show();
      // }
    })
  });
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2();
  })
</script>