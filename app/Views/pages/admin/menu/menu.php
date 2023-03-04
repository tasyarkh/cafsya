<?= $this->include('layout/admin/header') ?>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Menu</h4>
                    <p class="card-description"> Data Menu Cafsya
                    </p>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th>Status</th>
                           
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
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

<?= $this->include('layout/footer') ?>