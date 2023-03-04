<?= $this->include('layout/kasir/header') ?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Kasir</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">Selamat Datang Kasir <span class="text-info"><?= session('namaUser'); ?></span></h2>
                </div>

              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-credit-card-multiple text-primary ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Pesanan Masuk</h4>
            <div class="col-lg-12 grid-margin stretch-card">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nama Pelanggan</th>
                    <th>Meja</th>
                    <th>Status</th>
                    <th>Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($orders as $order) :
                  ?>
                    <tr>
                      <td><?= $order['namaPelanggan']; ?></td>
                      <td><?= $order['idMeja']; ?></td>
                      <td class="text-danger"> <?= $order['status']; ?> <i class="mdi mdi-arrow-down"></i></td>
                      <td><a class="btn btn-warning btn-sm" href="<?= base_url(); ?>/bayar/<?= $order['idPesan']; ?>"><i class="mdi mdi-ticket-confirmation mdi-18px"></i></a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Riwayat Pesanan</h4>
            <p class="card-description"> Riwayat Pemesanan Cafsya
            </p>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Pelanggan </th>
                    <th> Meja </th>
                    <th> Waktu </th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($historyOrders as $order) :
                  ?>
                    <tr>
                      <td> <?= $no++; ?> </td>
                      <td> <?= $order['namaPelanggan']; ?> </td>
                      <td><?= $order['idMeja']; ?></td>
                      <td><?= $order['tanggal']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if (session()->getFlashdata('berhasil')) { ?>
        Swal.fire({
          icon: 'success',
          title: 'Login Berhasil',
          text: 'Selamat datang, <?= session('namaUser') ?>',
          timer: 3500,
          showConfirmButton: false,

        })

      <?php } ?>
    </script>
    <?= $this->include('layout/footer') ?>