<?= $this->include('layout/manager/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Pegawai</h4>
                    <p class="card-description"> Data Pegawai Yang Tersedia
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Nama Pegawai</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                           $no = 1;
                           foreach ($pegawai as $row) :
                        ?>
                          <tr>
                          <td><?= $row['namaUser']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><label class="badge badge-<?php if ($row['level'] == 'ADMIN') {
                                                                    echo 'primary';
                                                                } elseif ($row['level'] == 'MANAGER'){
                                                                    echo 'info';
                                                                } else {
                                                                    echo 'success';
                                                                } ?> me-1"><?= $row['level']; ?></label></td>
                            <td><label class="badge badge-outline-<?php if ($row['status'] == 'Aktif') {
                                                                    echo 'warning';
                                                                } else {
                                                                    echo 'info';
                                                                } ?> me-1"><?= $row['status']; ?></label></td>
                            <td><button type="button" class="btn btn-danger btn-sm" href="#" data-href="<?= base_url('manager/deleteUser') . '/' . $row['idUser']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus"><i class="mdi mdi-account-remove mdi-18px"></i></button> </td></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi_hapus">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus User ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="manager/deleteUser/<?= $row['idUser'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>
              <?= $this->include('layout/footer') ?>