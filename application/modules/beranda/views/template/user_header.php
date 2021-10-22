<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon.png') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/src/jquery.horizontalmenu.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/responsive.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/main.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css') ?>">
  <!-- <link rel="stylesheet" href="<?//= //base_url('assets/dist/css/select2.min.css') ?>"> -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/kolomproduk.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/BackToTop.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/table.scrolldown.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: rgba(255, 255, 255, 0.8);
    }

    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font: 14px arial;
    }
  </style>
</head>

<body>

  <!----------- NAVBAR ----------->
  <div id="home"></div>
  <div class="row mx-auto p-2 bg-Light" style="width:100%;">
    <div class="row col-md-2 mx-auto">
      <h5 class="text-dark font-weight-light" style="font-size:13px;margin:auto;">✉ minorkopi1@gmail.com</h5>
    </div>
    <div class="row col-md-3 mx-auto">
      <h5 class="text-dark font-weight-light" style="font-size:13px;margin:auto;">☎ 0858-6505-8006</h5>
      <h5 class="text-dark font-weight-light" style="font-size:13px;margin:auto;">◷ 13:00–22:00</h5>
    </div>
    <div class="row col-md-4"></div>
    <div class="row col-md-1 mx-auto">

    </div>
    <div class="row col-md ml-5">
      <a href="https://www.instagram.com/minor.coffee.b/" target="blank" class="fa fa-instagram text-warning bg-dark text-center p-2 rounded mr-2" style="width:30px;"></a>
      <a href="https://food.grab.com/id/id/restaurant/minor-kopi-burger-nganguk-delivery/6-CZKZAKMFRVDXV2" target="blank" class="text-warning rounded mr-2 bg-dark">
        <img alt="foto" width="30" height="30" src="<?= base_url('assets/dist/img/grab.png') ?>">
      </a>
      <a href="mailto:minorcoffee1@gmail.com" target="blank" class="fa fa-google text-warning bg-dark text-center p-2 rounded mr-2" style="width:30px;"></a>
    </div>
  </div>
  <nav id="navbarku" class="navbar-expand-lg navbar navbar-light sticky-top bg-dark">
    <nav class="sidebar-menu pr-3">
      <a href="#menu"><span class="navbar-toggler-icon"></span></a>
    </nav>
    <!-----------NAV TITLE------->
    <!-- <button class="navbar-toggler bg-light rounded" type="button">
    <a href="#menu"><span class="navbar-toggler-icon"></span></a>
  </button> -->
    <!-- <h1 id="nav-head" class="font-weight-bold text-white" style="font-size:24px;" href="<?= site_url('beranda') ?>">MINORCOFFEE</h1> -->

    <a href="<?= site_url('beranda') ?>">
      <h3 class="font-weight-bold text-white" id="nav-head">
      MINOR</h3> 
      </a>
    </a>
    <!-----------NAV TITLE------->
    <div class="collapse navbar-collapse" style="font-size:12px;" id="navbarSupportedContent">
      <div class="col-lg-4">
        <ul class="navbar-nav mr-auto ah-tab-wrapper">
          <li class="nav-item ah-tab ml-5">
            <a class="ah-tab-item" href="<?= base_url('beranda') ?>">Beranda</a>
          </li>
          <li class="nav-item ah-tab">
            <a class="ah-tab-item" href="<?= base_url('produk') ?>">Produk</a>
          </li>
          <li class="nav-item ah-tab">
            <a class="ah-tab-item" href="<?= base_url('beranda/about') ?>">Tentang</a>
          </li>
          <li class="nav-item ah-tab">
            <a class="ah-tab-item" href="<?= base_url('beranda/pemesanan') ?>">Pemesanan</a>
          </li>
        </ul>
      </div>

        <!-- cari -->
        <div class="navbar-nav ml-auto">
        </div>
      <div class="col-lg-4">
        <form id="form_search" action="<?= site_url('beranda/search'); ?>" method="post">
          <div class="ml-5 input-group">
            <div id="prefetch">
            <div class="input-group-append">
              <input type="text" name="caridata" class="form-control input-lg typeahead" id="caridata" placeholder="Cari Produk" autocomplete="on" style="width:280px;border-radius:5px 0 0 5px;">
              <button class="btn btn-light" type="submit" name="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
          </div>
        </form>
      </div>

      <div class="navbar-nav ml-auto">
        <!-- <div class="input-group-append" style="cursor:pointer;">
            <a class="btn btn-sm ml-3 text-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>
            <div class="dropdown-menu dropdown-menu-right p-0 pb-1 mr-3" style="margin-top:-15px">
              <div class="card-body card-warning card-outline p-0">
                <form id="form_search" action="<?= site_url('beranda/search'); ?>" method="post">
		          <div class="ml-5 input-group">
		            <div id="prefetch">
		            <div class="input-group-append">
		              <input type="text" name="caridata" class="form-control input-lg typeahead" id="caridata" placeholder="Cari Produk" autocomplete="on" style="width:280px;border-radius:5px 0 0 5px;">
		              <button class="btn btn-light" type="submit" name="submit"><i class="fas fa-search"></i></button>
		            </div>
		        	</div>
		          </div>
		        </form>
              </div>
            </div>
          </div> -->
        <div class="dropdown">
          <a class="btn btn-dark btn-sm mr-2 dropdown-toggle" role="button" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
            <i class="fas fa-shopping-cart mt-1 mr-1"></i>
            <span class="badge badge-warning navbar-badge ml-2 p-1 font-weight-bold" style="margin-right:-5px;"><?= $sum_jumlah->jumlah; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right p-0 mr-2" aria-labelledby="cart">
            <?php if (!$cart->result()) { ?>
              <div class="row col-md-12 p-2 mx-auto card-body card-dark card-outline">
                <small class="text-danger">Keranjang belanjamu kosong!</small>
                <small class="">Ayo segera belanja...</small>
              </div>
            <?php } else { ?>
              <div class="card-body card-warning card-outline p-0" style="width:250px;">
                <table class="table table-hover table-bordered table-fixed">
                  <tbody>
                    <?php
                    $no = 1;
                    $total_bayar = 0;
                    foreach ($cart->result() as $row) { ?>
                      <tr>
                        <td class="p-2">
                          <div class="row col-md-12">
                            <div class="col-md-10">
                              <span class="font-weight-bold badge badge-warning"><?= $row->prod_name; ?></span>
                            </div>
                            <div class="col-md-2">
                              <?= anchor('cart/delete_cart/' . $row->prod_id, '<div class="ml-5 text-danger mx-auto" style="border-radius: 50%;">
                                <button class="close text-danger">
                                    <span aria-hidden="true">×</span>
                                </button>
                                </div>') ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <span style="font-size:13px;"><?= $row->qty; ?> x </span>
                            <span style="font-size:13px;">Rp. <?= number_format($row->price, 0, ',', '.') ?>,-</span>
                            <span style="font-size:13px;">| Rp. <?= number_format($row->total_harga, 0, ',', '.') ?>,-</span>
                          </div>
                        </td>
                      </tr>
                    <?php $total_bayar += $row->total_harga;
                    } ?>
                  </tbody>
                </table>

                <span class="ml-2" style="font-size:13px;">Total bayar : Rp. </span>
                <span class="font-italic" style="font-size:13px;"><?= number_format($total_bayar, 0, ',', '.') ?>,-</span><br>
              </div>
              <div class="m-0 row col-md-12 card-footer p-1 bg-white">
                <div class="col-md-6">
                  <a href="<?= base_url('cart') ?>" class="btn btn-dark btn-sm btn-block">Detail Cart</a>
                </div>
                <div class="col-md-6 mx-auto">
                  <a href="<?= base_url('cart/transaction') ?>">
                    <div class="btn btn-sm btn-success btn-block"> Transaksi</div>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <?php
        if ($data['users'] = $this->db->get_where('users', ['username' =>
        $this->session->userdata('username')])->row_array()) {
        ?>
          <div class="input-group-append" style="cursor:pointer;">
            <a class="btn btn-light btn-sm mr-3 text-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $users['username']; ?></a>
            <div class="dropdown-menu dropdown-menu-right p-0 pb-1 mr-3" style="margin-top:-15px">
              <div class="card-body card-warning card-outline p-0">
                <?php if ($users['role'] == 'user') { ?>
                  <a class="dropdown-item" href="<?= base_url('login') ?>">
                    <div class="row col-md-12">
                      <div class="col-md-3"><i class="fas fa-user"></i></div>
                      <div class="col-md-9">My Account</div>
                    </div>
                  </a>
                <?php } else { ?>
                  <a class="dropdown-item" href="<?= base_url('vendor') ?>">
                    <div class="row col-md-12">
                      <div class="col-md-3"><i class="fas fa-user"></i></div>
                      <div class="col-md-9">My Account Mitra</div>
                    </div>
                  </a>
                <?php } ?>
                <a class="dropdown-item" href="<?= base_url('beranda/vendor') ?>">
                  <div class="row col-md-12">
                    <div class="col-md-3"><i class="fas fa-users"></i></div>
                    <div class="col-md-9">Coba Menjadi Mitra ?</div>
                  </div>
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                  <div class="row col-md-12">
                    <div class="col-md-3"><i class="fas fa-sign-out-alt"></i></div>
                    <div class="col-md-9">Logout</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm mr-3">Masuk</a>
        <?php } ?>

      </div>
    </div>
  </nav>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white" id="exampleModalLabel">Logout My Account</h5>
          <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda yakin keluar dari <b class="text-dark">MINOR COFFEE</b> | My Account ?</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('login/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Nonaktif Akun Modal-->
  <div class="modal fade" id="nonaktif" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white" id="exampleModalLabel">Nonaktif My Account</h5>
          <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda yakin untuk me-Nonaktifkan akun <b class="text-dark">MINOR COFFEE</b> ?</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('user_dashboard/nonaktif/' . $users['username']); ?>">Nonaktif</a>
        </div>
      </div>
    </div>
  </div>