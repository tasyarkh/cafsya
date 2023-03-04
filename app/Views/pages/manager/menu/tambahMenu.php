  <?= $this->include('layout/manager/header') ?>
<div class="main-panel">
<div class="content-wrapper">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambahkan Menu</h4>
                    <p class="card-description"> Menambahkan Menu Cafsya </p>
                    <?php if ($validasi->hasError('gambar')) { ?>
                      <div div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> Gambar Gagal Disimpan karena <strong><?= $validasi->getError('gambar'); ?></strong>
                            <i type="button" class="btn-close mdi mdi-close-box" data-bs-dismiss="alert" aria-label="Close"></i>
                      </div>
                      <?php } ?>
                    <form class="forms-sample" method="POST" role="form" action="<?= base_url('menu/create'); ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Menu</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="namaMenu" name="namaMenu">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="harga" name="harga">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gambar Menu</label>
                        <input type="file" name="gambar" id="gambar" class="file-upload-default">
                        <div class="input-group col-sm-9">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Menu" name="gambar" id="gambar">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Menu</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Stok</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="harga" name="stok">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="status">
                                <option>Pilih Status</option>
                                <option>Tersedia</option>
                        </select>
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button href="<?=base_url('/menuMan');?>" class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              <?= $this->include('layout/footer') ?>