<?= $this->include('layout/manager/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Menu</h4>
                    <p class="card-description"> Data Menu Cafsya</p>
                    <?php if ($validasi->hasError('gambar')) { ?>
                      <div div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> Gambar Gagal Disimpan karena <strong><?= $validasi->getError('gambar'); ?></strong>
                            <i type="button" class="btn-close mdi mdi-close-box" data-bs-dismiss="alert" aria-label="Close"></i>
                      </div>
                      <?php } ?>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                           $no = 1;
                           foreach ($menu as $row) :
                        ?>
                          <tr>
                            <td> <?= $row['namaMenu']; ?> </td>
                            <td> <?= $row['harga']; ?> </td>
                            <td><img src="/img/<?= $row['gambar']?>"></td>
                            <td> <?= $row['stok']; ?> </td>
                            <td> <?= $row['status']; ?> </td>
                            <td><div class="dropdown">
                            <button type="button" class="btn btn-outline-warning dropdown-toggle" id="dropdownMenuIconButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton3">
                              <a class="dropdown-item updateMenu" data-bs-toggle="modal" data-bs-target="#updateMenu" data-idMenu="<?= $row['idMenu']; ?>" data-namaMenu="<?= $row['namaMenu']; ?>" data-harga="<?= $row['harga']; ?>" data-gambar="<?= $row['gambar']; ?>" data-stok="<?= $row['stok']; ?>" data-status="<?= $row['status']; ?>" href="#">Edit</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-href="<?= base_url('manager/delete') . '/' . $row['idMenu']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a>
                            </div>
                          </div></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="modal fade" id="updateMenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Menu</h5>
                        
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('menu/edit'); ?>" enctype="multipart/form-data"> 
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="idMenu" class="form-label">ID Menu</label>
                                    <input type="text" class="form-control" id="idMenu_u" name="idMenu" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="namaMenu" class="form-label">Nama Menu</label>
                                    <input type="text" class="form-control" id="namaMenu_u" name="namaMenu" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="harga_u" name="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="namaMenu" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="file-upload-default" hidden id="gambar_u">
                                    <div class="input-group col-xs-6">
                                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" >
                                      <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                      </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="stok_u" name="stok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Status</label>
                                    <select class="form-control" aria-label="Default select example" name="status" id="status_u" required>
                                        <option>Pilih</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Habis">Habis</option>

                                    </select>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="updateMenu">
                        </div>
                      </form>
                    </div>
                </div>
             </div>                                                  
             
              <!-- section hapus data -->
               <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi_hapus">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus Menu ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="manager/delete/<?= $row['idMenu'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>

<?= $this->include('layout/footer') ?>