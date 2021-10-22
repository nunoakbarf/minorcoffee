<div class="content-wrapper">
    <div id="list-kat" class="w3-container pills">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produk Vendor</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <table class="table table-bordered">
                <thead class="bg-warning">
                    <tr>
                        <th class="text-center" style="width: 1%">
                            NO
                        </th>
                        <th class="text-center">
                            Nama
                        </th>
                        <th style="width: 10%" class="text-center">
                            Harga Mitra
                        </th>
                        <th style="width: 10%" class="text-center">
                            Kategori
                        </th>
                        <th style="width: 20%" class="text-center">
                            Nama Mitra
                        </th>
                        <th style="width: 10%" class="text-center">
                            Stok
                        </th>
                        <th class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    $no = 1;
                    foreach ($prod_vend as $key => $value) { ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td>
                                <a style="font-size:20px;"><b><?= $value['prod_name'] ?></b></a>
                            </td>
                            <td class="text-center">
                                Rp. <?= number_format($value['prod_price'], 0, ',', '.') ?>,-
                            </td>
                            <td class="text-center">
                                <span class="badge badge-success"><?= $value['join_cat_name'] ?></span>
                            </td>
                            <td class="text-center">
                                <?= $value['join_name_mitra'] ?>
                            </td>
                            <td class="text-center">
                                <?= $value['quantity'] ?>
                            </td>
                            <td class="project-actions text-center">
                                <a href="<?= site_url('beliproduk/edit_prod_vend/' . $value['prod_id']) ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo $this->pagination->create_links(); ?>
        </section>
    </div>
</div>