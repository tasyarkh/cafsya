<?= $this->include('layout/admin/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Meja</h4>
                       <button type="submit" class="btn btn-outline-primary btn-md mt-2 mb-4" data-bs-toggle="modal" data-bs-target="#tambahMeja">Tambah Meja</button>
                    <div class="dropdown-divider"></div>
                    <div class="col-md-12 mt-3 row">
                    <?php 
                           $no = 1;
                           foreach ($meja as $row) :
                     ?>
                    <div class="col-md-3 col-3 mb-3">
                                <div class="card shadow p-4 text-center bg-<?php if ($row['status'] == 'Kosong') {
                                                                    echo 'success';
                                                                } else {
                                                                    echo 'warning';
                                                                } ?>">
                                   <div class="card-body">
                                    <h1><?= $row['idMeja']; ?></h1>
                                    
                                    <button type="edit" class="btn btn-danger btn-rounded btn-icon shadow-lg editMej" style="padding: 8px;" data-bs-toggle="modal" data-bs-target="#editMeja" data-idMeja="<?= $row['idMeja']; ?>" data-status="<?= $row['status']; ?>" href="#">
                                      <i class="mdi mdi-table-remove mdi-24px"></i>
                                    </button>
                                    
                                   </div>
                                </div>
                                
                        </div>
                        <?php endforeach; ?>
                  </div>
                                </div>
                </div>
              </div>
              
                <!-- section tambah meja -->
                <div class="modal fade" id="tambahMeja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Meja</h5>
                        </div>
                        <div class="modal-body">
                        <form action="<?= base_url('meja/create'); ?>" method="POST">
                                <?= csrf_field(); ?>
                                <div class="form-group row">
                                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                                  <div class="col-sm-9">
                                  <select class="form-control rounded-lg" name="status">
                                          <option>Pilih Status</option>
                                          <option>Kosong</option>
                                  </select>
                                  </div>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="simpan">
                        </div>
                      </form>
                    </div>
                </div>
             </div>                
             
             <div class="modal fade" id="editMeja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ubah Status Meja</h5>
                        </div>
                        <div class="modal-body">
                        <form action="<?= base_url('meja/edit'); ?>" method="POST">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="idMeja" class="form-label">No Meja</label>
                                    <input type="text" class="form-control" id="idMeja_u" name="idMeja" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Status</label>
                                    <select class="form-control" aria-label="Default select example" name="status" id="status_u" required>
                                        <option>Pilih</option>
                                        <option value="Terisi">Terisi</option>
                                        <option value="Kosong">Kosong</option>
                                    </select>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="updateMeja" value="Simpan">
                        </div>
                      </form>
                    </div>
                </div>
             </div>            
             
<?= $this->include('layout/footer') ?>