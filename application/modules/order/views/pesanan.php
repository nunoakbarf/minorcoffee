<div class="content-wrapper">
    <div class="container-pills">
        <div id="list" class="w3-container pills">
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Pemesanan</h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Update Pemesanan</h3>
                    </div>
                    <div class="card-body">
                    <?php foreach ($edit as $p) : ?>
                        <form class="user" method="POST" action="<?= base_url('order/update'); ?>" enctype="multipart/form-data">
                        <div class="form-group row mb-5">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-7">
                                    <?php if($p['bukti_img'] != null){ ?>
                                            <div>
                                                <img class="brand-image rounded" width="300px" src="<?= base_url()?>bukti/<?php echo $p['bukti_img'];?>" alt="foto">
                                            </div>
                                        <?php
                                    }?>
                                </div>
                                </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Pembeli</label>
                                <div class="col-sm-2">
                                    <input type="text" name="nama" class="form-control form-control-user" placeholder="Nama Pembeli" value="<?= $p['nama']; ?>" readonly>
                                    <input type="text" name="order_num" class="form-control form-control-user" placeholder="Vendor" value="<?= $p['order_num']; ?>" hidden>
                                    <input type="text" name="order_id" class="form-control form-control-user" placeholder="ID" value="<?= $p['order_id']; ?>" hidden>
                                    <input type="text" name="id_user" class="form-control form-control-user" placeholder="Harga Jual" value="<?= $p['id_user']; ?>" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Order</label>
                                <div class="col-sm-2">
                                    <input type="text" name="order_date" class="form-control form-control-user" placeholder="Tanggal Order" value="<?= $p['order_date']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat Tujuan</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="5" id="alamat_pengiriman" name="alamat_pengiriman" readonly><?php echo $p['alamat_pengiriman']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kurir</label>
                                <div class="col-sm-3">
                                    <input type="text" name="kurir" class="form-control form-control-user" placeholder="Kurir" value="<?= $p['kurir']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ongkos kirim</label>
                                <div class="col-sm-3">
                                    <input type="text" name="ongkos_kirim" class="form-control form-control-user" placeholder="ongkos kirim" value="<?= $p['ongkos_kirim']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="status" id="status">
                                        <option value="Belum dibayar">- Belum dibayar -</option>
                                        <option value="Sudah dibayar">- Sudah dibayar -</option>
                                        <option value="Batal">- Batal -</option>
                                    </select>
                                    <!-- <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="Belum dibayar">
                                        <label for="customRadio1" class="custom-control-label">Belum dibayar</label>
                                    </div>
                                    <div class="ml-3 custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="Sudah dibayar">
                                        <label for="customRadio2" class="custom-control-label">Sudah dibayar</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nomer Resi</label>
                                <div class="col-sm-3">
                                    <input type="text" name="no_resi" class="form-control form-control-user" placeholder="No Resi" value="<?= $p['no_resi']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <input class="btn btn-info btn-md" type="submit" name="btnSubmit" value="Update Pesanan" />
                                    <a href="<?php echo base_url('order/detail'); ?>" class="btn bg-danger btn-md">Batal</a>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    </div>
                    <div class="card-footer text-right">Minor Coffee © 2020 - by Nuno Akbar</div>
                </div>
            </section>
        </div>
    </div>
</div>