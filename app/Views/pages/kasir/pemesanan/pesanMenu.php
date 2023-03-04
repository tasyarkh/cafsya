<?= $this->include('layout/kasir/header') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <style>
            .card-image {
                background-position: center;
                background-size: cover;
                height: 200px;
                width: 100%;
            }

            .cart-image {
                background-position: center;
                background-size: cover;
                height: 60px;
                width: 60px;
                border-radius: 10px;
            }

            .cls {
                top: 0;
                right: 0;
            }

            .cls .close {
                width: 30px;
                height: 30px;
                background-color: black !important;
                border-radius: 30px;

                color: white;
            }

            .nama-menu {
                width: 10px;
                text-overflow: ellipsis;
            }
        </style>
        <?php if (session()->has('keranjang')) { ?>
            <div class="col-md-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Keranjang
                            <div class="row">
                                <!-- TODO:Function tambah pesan -->
                                <form action="kasir/create" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="namaPelanggan" id="namaPelanggan" value="<?= $namaPelanggan ?>" class="namaPelanggan" required>
                                    <input type="hidden" name="idMeja" id="idMeja" value="<?= $meja; ?>" class="meja" required>
                                    <button type="submit" class="btn btn-primary">
                                        + Tambah Pesanan
                                    </button>
                                </form>
                                <a href="/pemesanan" class="btn btn-danger ml-2">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $no = 1;
                            foreach (session()->get('keranjang') as $k) :
                            ?>
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="cart-image" style="background-image: url('/img/<?= $k['gambar']; ?>');">
                                                </div>
                                                <div>
                                                    <strong class="nama-menu"><?= $k['namaMenu']; ?></strong><br>
                                                    Rp.<?= $k['harga']; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <strong class="mr-2">X</strong>
                                                    <?= $k['jumlah']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Pesan
                    <form class="row" action="#" method="POST">
                        <?= csrf_field(); ?>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Cari Menu..">
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="namaPelanggan">Nama Pelanggan</label>
                                <input type="text" id="namaPelanggan" class="form-control text-primary" required name="namaPelanggan" value="<?= $namaPelanggan ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="meja">Meja</label>
                                <select type="text" id="idMeja" class="form-control text-primary" required name="idMeja" disabled>
                                    <option value="<?= session('idMeja'); ?>" disabled selected><?= $meja; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h6 class="mt-2 mb-4">Daftar Menu</h6>
                    <!-- Menu -->
                    <div class="row">
                        <?php
                        $no = 1;
                        foreach ($menu as $m) :
                        ?>
                            <div class="col-md-3 col-6 mb-3">
                                <form action="kasir/keranjang/<?= $m['idMenu']  ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="idMenu" value="<?= $m['idMenu']; ?>" required>
                                    <input type="hidden" name="stok" value="<?= $m['stok']; ?>" class="form-control">
                                    <div class="card">
                                        <div class="card-header card-gambar" style="background-image: url('/img/<?= $m['gambar']; ?>'); height: 150px; background-size: cover; background-repeat: no-repeat;">
                                        </div>
                                        <div class="card-body">
                                            <strong><?= $m['namaMenu']; ?></strong> <br>
                                            <div class="d-flex justify-content-between" style="padding-top: 15px; padding-bottom: 15px;">
                                                Rp.<?= $m['harga']; ?>
                                                <i>Stok : <?= $m['stok']; ?></i>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <input type="number" class="form-control mr-3" placeholder="Jumlah" name="jumlah" required>
                                                <?php if ($m['stok'] == '0') {
                                                    echo '<button class="btn btn-success" disabled>Pesan</button>';
                                                } else {
                                                    echo '<button class="btn btn-primary">Pesan</button>';
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->include('layout/footer') ?>