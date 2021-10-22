<!------- WELCOME ------->
<div class="row mx-auto pl-5 pb-5 pt-5 bg-white" style="width:100%;background:url(<?=base_url()?>assets/dist/img/menu.jpg);">
<div class="col-md-4 mx-auto m-3 mb-5 mt-5">
  <div class="card">
    <div class="card-body register-card-body bg-light">
    <div class="font-weight-bold login-box-msg" href="beranda"> SELAMAT DATANG DI MINOR COFFEE SILAHKAN LOGIN</div>
        <?= $this->session->flashdata('message');?>
        <form method="post" action="<?= base_url('login');?>">
        <div class="input-group mb-4">
          <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username');?>">
          <div class="input-group-append">
            <div class="bg-white input-group-text">
              <span class="text-dark fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <?= form_error('username','<small class="text-danger pl-3" style="margin-top:-25px;">','</small>');?>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="bg-white input-group-append">
            <div class="input-group-text">
              <span class="text-dark fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <?= form_error('password','<small class="text-danger pl-3" style="margin-top:-25px;">','</small>');?>
        </div>
        <div class="row">
          <div class="col-4">
            <input type="submit" class="btn btn-warning btn-block" name="btnSubmit" value="Login" />
          </div>
        </div>
      </form><br>
      <div class="row">
          <span>Belum mempunyai akun?, silahkan <a href="<?php echo base_url('login/register');?>" class="font-weight-bold text-warning font-underline">Daftar</a></span>
        </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

	
</div>
</div>
