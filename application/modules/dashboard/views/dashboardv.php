<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3 mt-3">
                <!-- Profile Image -->
                <div class="card-header bg-yellow">
                    <h3 class="card-title">Tentang Saya</h3>
                </div>
                <div class="card card-outline">
                <div class="card-body box-profile pt-4">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?php echo base_url('assets/dist/img/admin.png')?>"
                        alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?= $users['nama'];?></h3>
                    <p class="text-muted text-center p-0"><?= $users['role'];?></p>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9 mt-3">
                <div class="card">
                <div class="card-header p-2 ">
                    <ul class="nav nav-pills ">
                    <li class="nav-item"><a class="nav-link active" href="#education" data-toggle="tab">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#notes" data-toggle="tab">Notes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                    <div class="active tab-pane" id="education">
                        <strong>Email</strong>
                        <p class="text-muted"><?= $users['email'];?></p>
                        <hr>
                        <strong>Alamat</strong>
                        <p class="text-muted"><?= $users['alamat'];?></p>
                        <hr>
                        <strong>No Telepon</strong>
                        <p class="text-muted"><?= $users['nohp'];?></p>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="notes">
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                    <div class="row col-md-12 ml-1 mt-1">
                        <div class="col-md-15">
                            <h4 class="alert alert-light font-weight-bold"><i class="fas fa-cog fa-spin mr-2"></i>Pengaturan Akun</h4>
                            <div class="row col-md-12">
                                <h3 class="mx-auto mt-3 mb-4">Edit data akun</h3>
                                <table class="table col-md-12">
                                <form action="<?php echo base_url('Dashboard'); ?>" method="post">
                                <div class="input-group">
                                    <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label">Nama Lengkap</label>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" name="id_user" value="<?= $users['id_user'];?>"/>
                                            <input class="form-control" name="nama" value="<?= $users['nama'];?>"/>
                                            <?= form_error('nama','<small class="text-danger pl-3">','</small>');?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label class="col-md-12  control-label">Email</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="email" value="<?= $users['email'];?>">
                                            <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label">Alamat</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="alamat"><?= $users['alamat'];?></textarea>
                                        <?= form_error('alamat','<small class="text-danger pl-3">','</small>');?>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="form-group col-md-6">
                                        <label class="col-md-12 control-label">No HP</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="nohp" value="<?= $users['nohp'];?>">
                                                <?= form_error('nohp','<small class="text-danger pl-3">','</small>');?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="col-md-12  control-label">Username</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="username" value="<?= $users['username'];?>" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" type="submit"> Simpan</button>
                                    <a href="<?= base_url('dashboardv');?>" type="button" class="btn btn-danger" data-dismiss="modal"> Batal</a>
                                </div>
                                </form>
                                </table>
                            </div>
                        </div>

                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>