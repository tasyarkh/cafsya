<?= $this->include('layout/manager/header') ?>
<div class="main-panel">
<div class="content-wrapper">
            <div class="row">
            <div class="col-sm-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Manager</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">Selamat Datang Manager <span class="text-danger"><?= session('namaUser'); ?></span></h2>
                        </div>
                       
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-certificate text-info ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Menu</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= $menu; ?></h2>
                          
                        </div>
                        <h6 class="text-muted font-weight-normal">jumlah menu</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-food-variant text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= $trans; ?></h2>
                          
                        </div>
                        <h6 class="text-muted font-weight-normal"> jumlah transaksi</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-cash text-warning ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div> 
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Laporan Pendapatan</h4>
                    <button type="button" class="btn btn-primary btn-icon-text"> Cetak Laporan <i class="mdi mdi-printer btn-icon-append"></i></button>
                    <div class="table-responsive" style="margin-top: 30px;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Nama Menu </th>
                            <th> Jumlah Terjual </th>
                            <th> Harga Satuan </th>
                            <th> Total </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 77.99 </td>
                            <td> $ 77.99  </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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