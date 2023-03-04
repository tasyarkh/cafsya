<?= $this->include('layout/manager/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Laporan Transaksi</h4>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="date" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-primary" type="button">Cari</button>
                        </div>
                      </div>
                    </div>
                    
                    <div class="table-responsive" style="margin-top: 30px;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Nama Pelanggan </th>
                            <th> ID Pesan </th>
                            <th> Total </th>
                            <th> Status </th>
                            <th> Tanggal </th>
                          </tr>
                        </thead>
                        <tbody>
                <?php
                $no = 1;
                foreach ($trans as $t) :
                ?>
                  <tr>
                    <td> <?= $no++; ?> </td>
                    <td> <?= $t['namaPelanggan']; ?> </td>
                    <td> <?= $t['idPesan']; ?> </td>
                    <td> <?= $t['total']; ?> </td>
                    <td> <?= $t['status']; ?> </td>
                    <td> <?= $t['tanggal']; ?> </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <?= $this->include('layout/footer') ?>