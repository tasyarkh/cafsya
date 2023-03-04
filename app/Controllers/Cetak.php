<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\PesananModel;
use App\Models\ItemPesananModel;

class Cetak extends BaseController
{
    protected $transModel;
    protected $pesanModel;
    protected $itemModel;
    public function __construct(){
        $this->transModel = new TransaksiModel();
        $this->pesanModel = new PesananModel();
        $this->itemModel = new ItemPesananModel();
    }

    public function cetak_bill()
    {
        $trans = $this->transModel->findAll();
        $pesan = $this->pesanModel->findAll();
        $item = $this->itemModel->findAll();
        $data = [
            'title' => 'Bill | Cafsya',
            'trans' => $trans,
            'pesan' => $pesan,
            'item' => $item
        ];
        return view('cetak/cetakBill', $data);
    }
}
