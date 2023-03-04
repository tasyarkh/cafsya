<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menu';
    protected $primaryKey       = 'idMenu';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['namaMenu', 'harga', 'gambar', 'stok', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //memasukan data ke tb menu
    public function saveMenu($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //mengambil data tb menu
    public function getMenu($idMenu = false)
    {
        if ($idMenu === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idMenu' => $idMenu]);
        }
    }

    //query builder menghitung jumlah menu
    public function countMenu()
    {
        $builder = $this->db->table('menu');
        $query = $builder->countAllResults();
        return $query;
    }

    //query update data menu
    public function updateMen($data, $idMenu)
    {
        $query = $this->db->table($this->table)->update($data, array('idMenu' => $idMenu));
        return $query;
    }
}
