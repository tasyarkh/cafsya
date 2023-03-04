<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemPesananModel;
use App\Models\MenuModel;
use App\Models\MejaModel;
use App\Models\PesananModel;
use App\Models\TransaksiModel;

class Kasir extends BaseController
{
    protected $menuModel;
    protected $mejaModel;
    protected $pesanModel;
    protected $transModel;
    protected $itemPesananModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->mejaModel = new MejaModel();
        $this->pesanModel = new PesananModel();
        $this->transModel = new TransaksiModel();
        $this->itemPesananModel = new ItemPesananModel();
    }

    //section dashboard
    public function index()
    {
        if (session('level') != 'KASIR') {
            session()->setFlashdata('belum', "Kamu Belum Melakukan Login");
            return redirect()->to(base_url('/'));
        }

        $orders = $this->pesanModel->where('status', 'Dibuat')->findAll();
        $historyOrders = $this->pesanModel->findAll();
        $data = [
            'title' => 'Kasir | Cafsya',
            'validation' => \Config\Services::validation(),
            'orders' => $orders,
            'historyOrders' => $historyOrders
        ];

        return view('pages/kasir/index', $data);
    }


    //section transaksi
    public function transaksi()
    {
        $trans = $this->transModel->getData();
        $data = [
            'title' => 'Data Transaksi | Cafsya',
            'trans' => $trans
        ];

        $search_date = $this->request->getPost('search_date');

        return view('pages/kasir/transaksi/transaksi', $data);
    }

    public function tambahTrans()
    {
        $data = [
            'title' => 'Tambah Transaksi | Cafsya'
        ];

        return  view('pages/kasir/transaksi/tambahTrans', $data);
    }

    //section pemesanan
    public function pemesanan()
    {
        $meja = $this->mejaModel->findAll();
        $data = [
            'title' => 'Pemesanan Makanan | cafsya',
            'meja' => $meja,
        ];

        return view('pages/kasir/pemesanan/pemesanan', $data);
    }

    public function pesan()
    {
        $menu = $this->menuModel->findAll();

        $data = [
            'title' => 'Pesan Menu | cafsya',
            'menu' => $menu,
            'namaPelanggan' => $this->request->getVar('namaPelanggan'),
            'meja' => $this->request->getVar('meja'),
        ];

        // Kalo nama pelanggan sudah terinput, baru bisa akses view pesanMenu
        if ($this->request->getVar('namaPelanggan') !== '') return view('pages/kasir/pemesanan/pesanMenu', $data);

        return redirect()->back();
    }

    public function keranjang($id)
    {
        $model = $this->menuModel;
        $menu = $model->find($id);

        if (!$menu) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu tidak ditemukan.');
        }

        // tanda ?? itu maksudnya, kalo sessionnya null, maka nilai default adalah array kosong
        $keranjang = session()->get('keranjang') ?? [];

        // mari kita check item keranjangnya ada pesanan yang sama ga
        if (isset($keranjang[$id])) {
            // kalo true, jumlah pada item keranjang menyesuaikan sebanyak input kita
            $keranjang[$id]['jumlah'] += $this->request->getVar('jumlah');
        } else {
            // kalo false, kita buat item keranjang yang baru
            $keranjang[$id] = [
                'gambar' => $menu['gambar'],
                'namaMenu'  => $menu['namaMenu'],
                'harga' => $menu['harga'],
                'jumlah' => $this->request->getVar('jumlah'),
            ];
        }

        // memperbarui nilai pada session keranjang
        session()->set('keranjang', $keranjang);
        return redirect()->back();
    }

    public function create()
    {
        // btw, ini tuh di ambil dari input hidden ya ges
        $nama = $this->request->getVar('namaPelanggan');
        $meja = $this->request->getVar('idMeja');

        $carts = session()->get('keranjang');
        $jumlah = 0;
        $total = 0;
        $order = null;

        foreach ($carts as $id => $cart) {
            $item = $this->menuModel->find($id);
            // var_dump($item);
            // die;
            if ($item['status'] != 'Tersedia') {
                session()->setFlashdata('failed', 'Pesanan gagal, Menu ' . $item->nama . ' tidak tersedia!!');
                return redirect()->back();
            }
        }



        // ini tuh kita looping supaya dapet data total sama jumlah
        foreach ($carts as $cart) {
            $total += $cart['jumlah'] * $cart['harga'];
            $jumlah += $cart['jumlah'];
        }

        // terus semua data yang udah kita bikin variable kita create
        // ini kita jadiin sebuah variable order, karena akan mereturn sebuah id, oke
        $order = $this->pesanModel->insert([
            'namaPelanggan' => $nama,
            'idMeja' => $meja,
            'jumlah' => $jumlah,
            'total' => $total,
        ]);

        // kita looping, supaya dapat digunakan untuk menampung
        // banyak pesanan
        foreach ($carts as $id => $cart) {
            $this->itemPesananModel->insert([
                'idPesanan' => $order,
                'idMenu' => $id,
                'jumlah' => $cart['jumlah'],
                'total' => $cart['jumlah'] * $cart['harga'],
            ]);
        }


        // ambil id meja
        $meja = $this->mejaModel->find($meja);
        // kite ubah status mejanye
        $meja['status'] = 'Terisi';
        $this->mejaModel->update($meja['idMeja'], $meja);

        $this->transModel->insert([
            'idPesan' => $order,
            'total' => 0,
            'status' => 'Tertunda',
        ]);



        // trus apus session keranjang
        session()->remove(['keranjang']);

        // kasih notif
        session()->setFlashdata('notif', 'Pesanan berhasil ditambahkan!!');

        // balik ke halaman kasir
        return redirect()->to(base_url('kasir'));
    }

    // section bayar
    public function bayar($id)
    {
        $pesanModel = $this->pesanModel;
        $itemPesananModel = $this->itemPesananModel;
        $item = $pesanModel->find($id);
        // $pesanan = $itemPesananModel->where('idPesanan', $item['idPesan'])->get()->getResultArray();
        $orders = $itemPesananModel->where('idPesanan', $item['idPesan'])->getData();
        $data = [
            'title' => 'Bayar | cafsya',
            'idPesan' => $id,
            'orders' => $orders,
            'item' => $item,
        ];

        // dd($orders);

        return view('pages/kasir/bayar', $data);
    }

    public function bayaranMasuk($id)
    {
        $transaksi = $this->transModel->getById($id);

        if ($transaksi) {
            $pemesan = $transaksi['namaPelanggan'];
            $meja = $transaksi['idMeja'];
            $total = $transaksi['total'];
            

            if ($this->request->getVar('bayar') - $total >= 0) {
                $lunas = [
                    'total' => $this->request->getVar('bayar'),
                    'status' => 'Lunas',
                ];
                $this->transModel->update($transaksi['idTrans'], $lunas);
                $this->pesanModel->update($id, ['status' => 'Diantar']);
                $meja = $this->mejaModel->find($meja);
                if ($meja) {
                    $this->mejaModel->update($meja['idMeja'], [
                        'status' => 'Kosong',
                    ]);
                }
                return redirect()->to(base_url('transaksi'));
            } else {
                return redirect()->back();
            }
        } else {
            // Return an error message or redirect to an error page
            echo 'Transaksi tidak ditemukan';
        }
    }
}
