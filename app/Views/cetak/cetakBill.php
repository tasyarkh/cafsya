<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" type="text/css" href="<?= base_url().'assets/images/favicon.png'?>">
    <title>Bill</title>
    <style>
      body{
        font-family:calibri; 
        font-size:14px;
      }
      .judul{font-size: 20px;}
      .jalan{font-size: 12px;}
      hr.hr1{
        margin-top: 0px;
        border: 0;
        border-top: 3px double black;
      }
      hr.hr2{
        text-align: center;
        width: 500px;
        margin-top: 20px;
      }
      hr.hr3{
        margin-top: 5px;
      }

      .table1{
        width:350px; 
        border-collapse:collapse; 
        margin-bottom: -12px;
      }

      .table2{
        width:500px;
        margin-top: 0px; 
        padding: '0'; 
        border-collapse: collapse;
      }
    </style>
  </head>
  <body onload="window.print(); window.onafterprint = window.close; ">
    <center>
      <!-- seharusnya data transaksi -->
      <?php 
      foreach ($pesan as $i){
        $idPesan = $i['idPesan'];
        $namaPelanggan = $i['namaPelanggan'];
        $tanggal      = date_format(date_create($i['tanggal']), "d M Y");
        $idMeja   = $i['idMeja'];
        $status   = $i['status'];
      }?>

      <table class="table1">
        <tr>
          <td align="center" colspan='4'>
            <span class="judul">Cafsya (Caffe Tasya)</span><br>
            <span class="jalan">Jl.SMK Prestasi Prima</span>
          </td>
        </tr>
        <tr>
          <td colspan="4"><hr class="hr1"></td>
        </tr>

        <tr>
          <td width="110px">No Transaksi</td>
          <td width="10px" align="center">:</td>
          <td><?= $idPesan; ?></td>
        </tr>
        
        <tr>
          <td >Nama Pelanggan</td>
          <td align="center">:</td>
          <td><?= $namaPelanggan; ?></td>
        </tr>

        <tr>
          <td >Tanggal</td>
          <td align="center">:</td>
          <td><?= $tanggal; ?></td>
        </tr>
        
        <tr>
          <td>No Meja</td>
          <td align="center">:</td>
          <td><?= $idMeja; ?></td>
        </tr>

      </table>

      <hr class="hr2">
      
      <table class="table2">
        <tr>
          <th width="40px">No.</th>
          <th>Nama Menu</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Sub</th>
        </tr>
        <tr>
          <td colspan='5'><hr class="hr3"></td>
        </tr>
        <!-- seharusnya hanya menampilkan 1 data -->
        <?php
          $no=1;
          foreach ($item as $j):
            $idMenu = $j['idMenu'];
            $total    = $j['total'];
            $qty      = $j['jumlah'];?>
            </tr>
              <td align="center"><?= $no++; ?>.</td>
              <td><?= $idMenu; ?></td>
              <td align="right"><?= number_format($total); ?></td>
              <td align="center"><?= number_format($qty); ?></td>
              <td align="right"><?= number_format($total*$qty); ?></td>
              <td></td>
            <tr>
            <?php 
          endforeach;
        ?>

        <tr>
          <td colspan='5'><hr class="hr4"></td>
        </tr>

        <tr>
          <td align="right" colspan='4'>Total</td>
          <td style='text-align:right; font-size:13pt;'><?= number_format($j['total']); ?></td>
        </tr>

        <tr>
          <td align="right" colspan='4'>Total Bayar</td>
          <td style='text-align:right; font-size:13pt;'></td>
        </tr>

        <tr>
          <td align="right" colspan='4'>Kembali</td>
          <td style='text-align:right; font-size:13pt;'></td>
        </tr>

        <tr>
          <td colspan='5' align="center" height="40px">====== TERIMAKASIH ATAS KUNJUNGAN NYA ======</td>
        </tr>
      </table>
    </center>   
  </body>
</html>
