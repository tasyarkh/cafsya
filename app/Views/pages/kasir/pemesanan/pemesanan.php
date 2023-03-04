<?= $this->include('layout/kasir/header') ?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Masukan Pemesanan</h4>
          <p class="card-description"> Data Pemesanan </p>
          <form class="forms-sample" action="/pesanMenu">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Pelanggan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" placeholder="Nama Pelanggan">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meja</label>
              <div class="col-sm-9">
                <select class="form-control rounded-md" name="meja" id="Meja" require>
                  <?php
                  $no = 1;
                  foreach ($meja as $m) :
                  ?>
                    <option class="<?= $m['status'] == 'Terisi' ? 'text-danger' : ''; ?>" value="<?= $m['idMeja']; ?>" <?php if ($m['status'] == 'Terisi') {
                                                                                                                          echo 'disabled';
                                                                                                                        } ?>><?= $m['idMeja']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Pilih Menu</button>
            <button class="btn btn-dark" href="/kasir" type="reset">Cancel</button>
          </form>
        </div>
      </div>
    </div>
    <?= $this->include('layout/footer') ?>