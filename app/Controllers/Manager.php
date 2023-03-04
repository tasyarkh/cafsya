<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\UserModel;
use App\Models\TransaksiModel;
use CodeIgniter\Validation\Validation;

class Manager extends BaseController
{
    protected $menuModel;
    protected $userModel;
    protected $transModel;
    public function __construct(){
        $this->menuModel = new MenuModel();
        $this->userModel = new UserModel();
        $this->transModel = new TransaksiModel();
    }


    //section dashboard
    public function index()
    {
        if(session('level') != 'MANAGER'){
            session()->setFlashdata('belum', "Kamu Belum Melakukan Login");
            return redirect()->to(base_url('/'));
        }

        $menu = $this->menuModel->countMenu();
        $trans = $this->transModel->countTrans();
        $data = [
            'title' => 'Dashboard | Cafsya',
            'menu' => $menu,
            'trans' => $trans
        ];

        return view('pages/manager/index', $data);
    }


    //section menu
    public function menu(){
        $menu = $this->menuModel->findAll();
        $data = [
            'title' => 'Data Menu | Cafsya',
            'menu' => $menu,
            'validasi' => \Config\Services::validation()
        ];

        return view('pages/manager/menu/menu', $data);
    }


    //section tambah menu
    public function tambahMenu(){
        $data = [
            'title' => 'Tambah Menu | Cafsya',
            'validasi' => \Config\Services::validation()
        ];

        return view('pages/manager/menu/tambahMenu', $data);
    }

    //menambahkan data di tb menu
    public function createMenu(){
        if(!$this->validate(
            [
                'gambar' => [
                    'rules' => 'uploaded[gambar]|max_size[gambar,1024]|ext_in[gambar,png,jpg,gif]',
                    'errors' => [
                        'max_size' => 'Ukuran Gambar Terlalu Besar, Max 1024Kb',
                        'ext_in' => 'Format gambar tidak sesuai'
                    ]
                ]  
            ]
        )) {
            return redirect()->to(base_url('tambahMenu'))->withInput();
        }
        if (!empty($_FILES['gambar']['name'])) {
            // Image upload
            $varMenu = $this->request->getFile('gambar');
            $pictMenu = str_replace(' ', '-', $varMenu->getName());
            $varMenu->move(WRITEPATH . '../public/img/', $pictMenu);
            
        $data = array(
            'idMenu' => $this->request->getVar('idMenu'),
            'namaMenu' => $this->request->getVar('namaMenu'),
            'harga' => $this->request->getVar('harga'),
            'gambar' => $pictMenu,
            'stok' => $this->request->getVar('stok'),
            'status' => $this->request->getVar('status'),
        );

        $this->menuModel->saveMenu($data);
        session()->setFlashdata('menuSimpan', 'Menu Berhasil Ditambah');
        return redirect()->to(base_url('menuMan'));
    }
}

    //edit data di tb menu
    public function editMenu(){
        if (!$this->validate([
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|ext_in[gambar,png,jpg,gif]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Terlalu Besar, Max 1024Kb',
                    'ext_in' => 'Format gambar tidak sesuai'
                ]
            ]  
         ])) {
                return redirect()->to(base_url('menuMan'))->withInput();
            } if (!empty($_FILES['gambar']['name'])) {
                $varMenu = $this->request->getFile('gambar');
                $pictMenu = str_replace(' ', '-', $varMenu->getName());
                $varMenu->move(WRITEPATH . '../public/img/', $pictMenu);

                $idMenu = $this->request->getPost('idMenu');    
                $data = array(
                    'namaMenu' => $this->request->getPost('namaMenu'),
                    'harga' => $this->request->getPost('harga'),
                    'gambar' => $pictMenu,
                    'stok' => $this->request->getPost('stok'),
                    'status' => $this->request->getPost('status'),
                );
                $this->menuModel->updateMen($data, $idMenu);
                session()->setFlashdata('menuEdit', 'Menu Berhasil diedit');
                return redirect()->to(base_url('menuMan'));
            }
    }

    public function updateMenu($idMenu)
    {
        helper(['form', 'url']);

        $validation = $this->validate([
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|ext_in[gambar,png,jpg,gif]',
                    'errors' => [
                        'max_size' => 'Ukuran Gambar Terlalu Besar, Max 1024Kb',
                        'ext_in' => 'Format gambar tidak sesuai'
                    ]
            ]
        ]);

        if(!$validation) {

            //model initialize
            $menuModel = new MenuModel();

            //render view with error validation message
            return view('menuMan', [
                'edit' => $menuModel->find($idMenu),
                'validation' => $this->validator
            ]);

        } else {

            //model initialize
            $menuModel = new MenuModel();
            
            //insert data into database
            $menuModel->update($idMenu, [
                'idMenu'   => $this->request->getPost('idMenu'),
                'namaMenu' => $this->request->getPost('namaMenu'),
                'harga' => $this->request->getPost('harga'),
                'gambar' => $pictMenu,
                'stok' => $this->request->getPost('stok'),
                'status' => $this->request->getPost('status'),
            ]);

            //flash message
            session()->setFlashdata('userEdit', 'Pegawai Berhasil Diupdate');

            return redirect()->to(base_url('menuMan'));
                      }
        }
        
        //menghapus data di tb menu
        public function delete($idMenu) 
        {
            $this->menuModel->delete($idMenu);
            session()->setFlashdata('userHapus', 'Menu telah dihapus');
            return redirect()->to(base_url('menuMan'));
        }


    //section transaksi
    public function transaksi(){
        $trans = $this->transModel->getData();
        $data = [
            'title' => 'Data Transaksi | Cafsya',
            'trans' => $trans
        ];

        $search_date = $this->request->getPost('search_date');

        return view('pages/manager/transaksi/transaksi', $data);
    }


    //section pegawai
    public function pegawai(){

        $pegawai = $this->userModel->findAll();
        $data = [
            'title' => 'Data Pegawai | Cafsya',
            'pegawai' => $pegawai,
        ];

        return view('pages/manager/pegawai/pegawai', $data);
    }

    //menghapus data pegawai
    public function deleteUser($idUser) 
        {
            $this->userModel->delete($idUser);
            session()->setFlashdata('userHapus', 'Menu telah dihapus');
            return redirect()->to(base_url('pegawaiMan'));
        }
    
}
