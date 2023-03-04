<?= $this->include('layout/admin/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambah Pegawai</h4>
                    <p class="card-description"> Isi Data Pegawai </p>
                    <form class="forms-sample" method="POST" action="<?= base_url('pegawai/create'); ?>" role="form">
                    <?= csrf_field(); ?>
                      <div class="form-group row">
                        <label for="namaUser" class="col-sm-3 col-form-label" name="namaUser">Nama Pegawai</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control rounded-lg rounded-lg" id="namaUser" name="namaUser">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control rounded-lg" id="username" name="username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control rounded-lg rounded-lg" id="password" name="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                        <select class="form-control rounded-lg" name="level">
                                <option>Pilih Jabatan</option>
                                <option>ADMIN</option>
                                <option>MANAGER</option>
                                <option>KASIR</option>
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                        <select class="form-control rounded-lg" name="status">
                                <option>Pilih Status</option>
                                <option>Aktif</option>
                                <option>Pasif</option>
                        </select>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
<?= $this->include('layout/footer') ?>