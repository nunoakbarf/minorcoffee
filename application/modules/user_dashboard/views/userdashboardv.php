<!------- MY ACCOUNT ------->
<div class="row col-md-9 ml-3 mt-3">
  <div class="col-md-12">
    <h4 class="alert alert-light font-weight-bold"><i class="fas fa-usd mr-2"></i>Transaksi</h4>
    <?php
    if (!$cart->result()) { ?>
      <div class="col-md-12 mt-5 mb-5">
        <div class="col-md-12">
          <center><strong class="text-danger">Keranjang belanja kosong!</strong> silahkan memilih produk terlebih dahulu.</center>
        </div>
        <center><img class="mt-3" alt="foto" src="<?php echo base_url('assets/dist/img/box-null.png') ?>" style="width:150px;"></center><br>
        <center><a class="mt-5" href="<?php echo base_url('produk') ?>">
            <div class="btn btn-warning btn-md">
              <i class="fas fa-cart-plus"></i> Belanja Sekarang
            </div>
          </a></center>
      </div>
    <?php } else { ?>
      <div class="row col-md-12">
        <div class="col-md-6">
          <table class="table table-bordered">
            <thead class="bg-light">
              <tr>
                <th class="text-center" width="1px">NO</th>
                <th class="text-center">Pesanan Anda</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center" width="120px">Hapus</th>
              </tr>
            </thead>
            <?php
            $no = 1;
            $total_bayar = 0;
            foreach ($cart->result() as $row) { ?>
              <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $row->prod_name; ?></td>
                <td align="center" |><?php echo $sum_jumlah->jumlah; ?></td>
                <td align="center"><?php echo anchor('cart/delete_cart_transaction/' . $row->prod_id, '<div class="btn btn-sm btn-danger mx-auto"><i class="fas fa-trash"></i></div>') ?></td>
              </tr>
            <?php
              $total_bayar += $row->total_harga;
              $count      = $total_bayar * 0.2;
              $final_total  = $count + $total_bayar;
            }
            ?>
          </table>
          <div class="row">
            <a href="<?php echo base_url('cart') ?>">
              <div class="btn btn-dark btn-sm"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</div>
            </a>
          </div>
        </div>
        <div class="row col-md-1">
        </div>
        <!-- <div class="container"> -->
        <div class="row col-md-5">
          <table class="table">
            <?php echo form_open_multipart('cart/order_now'); ?>
            <tr>
              <td class="p-1">Jenis Pembayaran</td>
              <td class="p-1">:</td>
              <td>
                <select name="jasakirim" id="jasakirim" required>
                  <option value="">Pilih Jenis Pembayaran</option>
                  <option id="tf" value="tranfer">Transfer</option>
                  <option id="cod" value="bayar di tempat">Bayar di Tempat</option>
                </select><br>
                <span style="font-size:12px;"><a class="font-italic" target="blank">NB : Jika memilih jenis pembayaran tranfer maka anda harus menyertakan bukti pembayaran</a></span>
              </td>
            </tr>
            <tr id="bukti">
              <td class="p-1">Bukti Pembayaran</td>
              <td class="p-1">:</td>
              <td class="p-1">
                <input type="file" id="buktitf" name="buktitf" />
              </td>
            <tr>
              <td class="p-1">Nomer Rekening</td>
              <td class="p-1">:</td>
              <td class="p-1">
                1840001264777 Nuno Akbar
              </td>
            </tr>
            </tr>
            <tr>
              <td class="p-1">Kota Tujuan</td>
              <td class="p-1">:</td>
              <td>
                <select name="kota_tujuan" id="kota_tujuan" class="form-control select2" required>
                  <option value="" disabled selected>Pilih Kota Tujuan</option>
                  <?php
                  for ($i = 0; $i < count($ongkir['rajaongkir']['results']); $i++) {
                    echo "<option></option>";
                    echo "<option value='" . $ongkir['rajaongkir']['results'][$i]['city_id'] . "'>" . $ongkir['rajaongkir']['results'][$i]['city_name'] . "</option>";
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td class="p-1">Alamat lengkap</td>
              <td class="p-1">:</td>
              <td class="p-1" collspan="3">
                <textarea type="text" name="alamat_kirim" class="form-control" id="alamat_kirim" placeholder="Alamat Lengkap"></textarea>
              </td>
            </tr>
            <tr>
              <td class="p-1">Total Bayar</td>
              <td class="p-1">:</td>
              <td class="font-weight-bold text-success p-1">Rp. <?php echo number_format($final_total, 0, ',', '.') ?>,-</td>
            </tr>
            <tr>
              <td class="p-1">Biaya Administrasi</td>
              <td class="p-1">:</td>
              <td class="font-weight-bold text-success p-1">Rp. <?php echo number_format($count, 0, ',', '.') ?>,-
              <td>

            </tr>
          </table>
          <div class="text-right">
            <a href="<?php echo base_url('produk') ?>">
              <div class="btn btn-warning btn-sm"><i class="fas fa-cart-plus"></i> Lanjutkan Belanja</div>
            </a>
            <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-money"></i> Checkout</button>
          </div>
          </form>
          <div class="alert alert-light mt-2" role="alert">
            <b class="text-danger">Peringatan!</b> total bayar, belum termasuk dengan <b class="text-dark">Ongkos Kirim</b>
          </div>
        </div>
      </div>
  </div>
<?php } ?>
</div>
</div>