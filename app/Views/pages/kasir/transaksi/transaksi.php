<?= $this->include('layout/kasir/header') ?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Transaksi</h4>
          <p class="card-description"> Data Transaksi Cafsya</code>
          </p>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Nama Pelanggan </th>
                  <th> Total </th>
                  <th> Status </th>
                  <th> Bill </th>
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
                    <td> <?= $t['total']; ?> </td>
                    <td> <?= $t['status']; ?> </td>
                    <td>  
                    <form action="<?= base_url('/cetak/cetak_bill'); ?>" method="post" target="_blank">
                      <input type="hidden" name="idPesan" value="<?= $t['idPesan']; ?>">
                      <button type="submit" class="btn btn-success btn-sm" href="#"><i class="mdi mdi-file-document-box mdi-18px"></i></button>
                    </form></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <?= $this->include('layout/footer') ?>