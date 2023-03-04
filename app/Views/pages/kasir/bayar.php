<?= $this->include('layout/kasir/header') ?>
<style>
    .image {
        width: 80px;
        height: 80px;
        border-radius: 10px;

        background-size: cover;
        background-position: center;
    }

    .nama-menu {
        font-size: 20px;
        text-overflow: ellipsis;
    }

    .jumlah {
        font-size: 20px;
        font-weight: bolder;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Vino | Meja 2</h4>
                    <hr>
                    <h4>List Menu</h4>
                    <ul class="list-group list-group-flush mt-3 table-responsive">
                        <?php foreach ($orders as $order) : ?>
                            <li class="list-group-item d-flex align-items-center justify-content-between" style="background: #191C24;">
                                <div class="d-flex align-items-center">
                                    <div class="image" style="background-image: url('<?= base_url('img/' . $order['gambar']); ?>')"></div>
                                    <div class="ml-3 mr-5">
                                        <strong class="nama-menu"><?= $order['namaMenu']; ?></strong> <br>
                                        <!-- Rp.15,000 -->
                                        <?= 'Rp.' . number_format($order['harga']); ?>
                                    </div>
                                    <?= $order['jumlah'] . 'x'; ?>
                                </div>
                                <p class="jumlah"> <?= 'Rp.' . number_format($order['total']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Masukan Pembayaran</h4>
                    <p class="card-description">Rincian</p>
                    <form class="forms-sample" action="/kasir/bayaranMasuk/<?= $idPesan; ?>">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="kembalian" class="col-sm-3 col-form-label">Total</label>
                            <div class="col-sm-9">
                                <p id="total" style="display: none;">
                                    <?= $item['total']; ?>
                                </p>
                                <p>
                                    Rp.<?= number_format($item['total']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bayar" class="col-sm-3 col-form-label">Bayar</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="bayar" name="bayar" placeholder="Bayar" min="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                            <div class="col-sm-9">
                                <p id="kembalian"></p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" id="button">Konfirmasi</button>
                        <button class="btn btn-dark" href="/kasir" type="reset">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <?= $this->include('layout/footer') ?>