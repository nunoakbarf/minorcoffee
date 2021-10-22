<body class="hold-transition sidebar-mini pace-primary sidebar-collapse">
<!-- NAVBAR LIGHT -->
<nav class="bg-white main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item toggled">
        <a class="nav-link toggled" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="breadcrumb-item text-weight-bold">
            <li class="nav-item mr-2">
                <form id="form_search" action="<?= site_url('dashboard/search');?>" method="post">
                    <div class="ml-5 input-group">
                    <div id="prefetch">
                        <input type="text" name="caridata" class="form-control input-lg typeahead" id="caridata" placeholder="Cari Produk" autocomplete="on" style="width:280px;border-radius:5px 0 0 5px;">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="submit" name="submit"><i class="fas fa-search"></i></button>
                    </div>
                    </div>
                </form>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="<?php echo base_url('cart_beli/detail_cart')?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-danger navbar-badge"><?php echo $sum_jumlah->jumlah; ?></span>
                </a>
            </li>
            
            <a class="btn btn-light mr-3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:17px;cursor:pointer;"><b><?= $users['username'];?></b> <i class="fas fa-caret-down"></i></a>
            <div class="mr-3 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-dark" href="" data-toggle="modal" data-target="#logoutModal"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>

<!-------- SIDE BAR ------->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed;">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('beranda')?>" class="bg-light brand-link">
      <img src="<?php echo base_url('assets/dist/img/favicon.png')?>"
           alt="KOPIKU" class="brand-image img-square">
      <span class="brand-text text-dark font-weight-bold">Minor Coffee</span>
    </a>

    <div class="sidebar">
        <!-- USER ADMIN -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/dist/img/admin.png')?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <div class="text-white"><?= $users['nama'];?></div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo base_url('dashboard')?>" class="nav-link" style="cursor:pointer;">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Produk Jual<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="background:#2b2f33;">
                        <li class="nav-item" style="cursor:pointer;">
                            <a href="<?php echo base_url('dataproduk')?>" class="nav-link">
                            <i class="fas fa-caret-right nav-icon"></i>
                            <p>Semua Produk</p>
                            </a>
                        </li>
                        <li class="nav-item" style="cursor:pointer;">
                            <a href="<?php echo base_url('category/produk')?>" class="nav-link">
                            <i class="fas fa-caret-right nav-icon"></i>
                            <p>Berdasarkan Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item" style="cursor:pointer;">
                            <a href="<?php echo base_url('beliproduk')?>" class="nav-link">
                            <i class="fas fa-caret-right nav-icon"></i>
                            <p>Beli Produk</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Data<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="background:#2b2f33;">
                        <li class="nav-item" style="cursor:pointer;">
                            <a href="<?php echo base_url('order')?>" class="nav-link">
                            <i class="fas fa-caret-right nav-icon"></i>
                            <p>Data Order</p>
                            </a>
                        </li>
                        <li class="nav-item" style="cursor:pointer;">
                            <a href="#" class="nav-link">
                            <i class="fas fa-caret-right nav-icon"></i>
                            <p>Data Beli</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('category')?>" class="nav-link" style="cursor:pointer;">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('customer')?>" class="nav-link" style="cursor:pointer;">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Customer</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin keluar, dan mengakhiri sesi ini.</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('login/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<?php }else{
    redirect('user_dashboard'); 
    } ?>