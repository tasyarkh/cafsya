<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\MejaModel;
use App\Models\TransaksiModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $mejaModel;
    protected $menuModel;
    protected $transModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->mejaModel = new MejaModel();
        $this->transModel = new TransaksiModel();
    }

    //menampilkan halaman dashboard
    public function index()
    {
        if (session('level') != 'ADMIN') {
            session()->setFlashdata('belum', 'Kamu Belum Melakukan Login');
            return redirect()->to(base_url('/'));
        }

        $pegawai = $this->userModel->countUser();
        $admin = $this->userModel->countAdmin();
        $manager = $this->userModel->countManager();
        $kasir = $this->userModel->countKasir();
        $menu = $this->menuModel->countMenu();
        $meja = $this->mejaModel->countMeja();
        $trans = $this->transModel->countTrans();
        $db = \Config\Database::connect();

        $data = [
            'title' => 'Dashboard | Cafsya',
            'pegawai' => $pegawai,
            'level' => $this->userModel->findAll(),
            'menu' => $menu,
            'meja' => $meja,
            'admin' => $admin,
            'manager' => $manager,
            'kasir' => $kasir,
            'trans' => $trans,
            'connect' => \Config\Database::connect()
        ];
        return view('pages/admin/index', $data);
    }


    //menampilkan halaman pegawai
    public function pegawai()
    {
        $pegawai = $this->userModel->findAll();
        $data = [
            'title' => 'Data Pegawai | Cafsya',
            'pegawai' => $pegawai,
        ];

        return view('pages/admin/pegawai/pegawai', $data);
    }

    //page tambah pegawai
    public function tambahPeg()
    {
        $data = [
            'title' => 'Tambah Pegawai | Cafsya',
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/admin/pegawai/tambahPeg', $data);
    }

    //logic tambah user
    public function createPeg()
    {
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ]
            ]
        )) {
            return redirect()->to(base_url('pegawai'))->withInput();
        }

        $data = array(
            'idUser' => $this->request->getVar('idUser'),
            'namaUser' => $this->request->getVar('namaUser'),
            'username' => $this->request->getVar('username'),
            'password' => sha1($this->request->getVar('password')),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status'),
        );

        $this->userModel->saveUser($data);
        session()->setFlashdata('userSimpan', 'Register Berhasil');
        return redirect()->to(base_url('pegawai'));
    }

    //fungsi menampilkan update
    public function editPeg()
    {
        $idUser = $this->request->getPost('idUser');
        $data = array(
            'namaUser'        => $this->request->getPost('namaUser'),
            'username'        => $this->request->getPost('username'),
            'password'        => sha1($this->request->getPost('password')),
            'status' => $this->request->getPost('status'),

        );
        $this->userModel->updatePeg($data, $idUser);
        session()->setFlashdata('userEdit', 'Pegawai berhasil diubah');
        return redirect()->to(base_url('pegawai'));
    }

    //fungsi query update
    public function updatePeg($idUser)
    {
        helper(['form', 'url']);

        $validation = $this->validate([
            'namaUser' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama User'
                ]
            ],
        ]);

        if (!$validation) {

            //model initialize
            $userModel = new UserModel();

            //render view with error validation message
            return view('pegawai', [
                'edit' => $userModel->find($idUser),
                'validation' => $this->validator
            ]);
        } else {

            //model initialize
            $userModel = new UserModel();

            //insert data into database
            $userModel->update($idUser, [
                'idUser'   => $this->request->getPost('idUser'),
                'namaUser' => $this->request->getPost('namaUser'),
                'username' => $this->request->getPost('username'),
                'password' => sha1($this->request->getPost('password')),
                'status' => $this->request->getPost('status')
            ]);

            //flash message
            session()->setFlashdata('userEdit', 'Pegawai Berhasil Diupdate');

            return redirect()->to(base_url('pegawai'));
        }
    }

    //query delete
    public function delete($idUser)
    {
        $this->userModel->delete($idUser);
        session()->setFlashdata('userHapus', 'Pegawai telah dihapus');
        return redirect()->to(base_url('pegawai'));
    }


    //menampilkan halaman meja
    public function meja()
    {
        $meja = $this->mejaModel->findAll();
        $data = [
            'title' => 'Meja | Cafsya',
            'meja' => $meja,
        ];

        return view('pages/admin/meja/meja', $data);
    }

    //create meja
    public function createMeja()
    {
        $data = array(
            'idMeja' => $this->request->getVar('idMeja'),
            'status' => $this->request->getVar('status'),
        );

        $this->mejaModel->saveMeja($data);

        return redirect()->to(base_url('meja'));
    }

    public function editMeja()
    {
        $idMeja = $this->request->getPost('idMeja');
        $data = array(
            'status' => $this->request->getPost('status'),
        );
        $this->mejaModel->updateMeja($data, $idMeja);
        session()->setFlashdata('mejaEdit', 'Status Meja Berubah');
        return redirect()->to(base_url('meja'));
    }

    public function updateMeja($idMeja)
    {
        helper(['form', 'url']);

        $validation = $this->validate([
            'status' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Status Meja'
                ]
            ],
        ]);

        if (!$validation) {

            //model initialize
            $mejaModel = new MejaModel();

            //render view with error validation message
            return view('meja', [
                'edit' => $mejaModel->find($idMeja),
                'validation' => $this->validator
            ]);
        } else {

            //model initialize
            $mejaModel = new MejaModel();

            //insert data into database
            $mejaModel->update($idMeja, [
                'idMeja'   => $this->request->getPost('idMeja'),
                'status' => $this->request->getPost('status')
            ]);

            //flash message
            session()->setFlashdata('mejaEdit', 'Status Meja Berhasil Diupdate');

            return redirect()->to(base_url('meja'));
        }
    }

    //menampilkan halaman menu
    public function menu()
    {
        $menu = $this->menuModel->findAll();
        $data = [
            'title' => 'Menu | Cafsya',
            'menu' => $menu
        ];

        return view('pages/admin/menu/menu', $data);
    }
}
