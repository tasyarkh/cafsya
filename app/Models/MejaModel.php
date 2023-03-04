<?php

namespace App\Models;

use CodeIgniter\Model;

class MejaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'meja';
    protected $primaryKey       = 'idMeja';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["idMeja", "status"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //insert query meja
    public function saveMeja($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //mengambil seluruh data meja
    public function getMeja($idMeja = false)
    {
        if ($idMeja === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idMeja' => $idMeja]);
        }
    }

    //mengeksekusi query update meja
    public function updateMeja($data, $idMeja)
    {
        $query = $this->db->table($this->table)->update($data, array('idMeja' => $idMeja));
        return $query;
    }

    //query builder menghitung jumlah meja
    public function countMeja()
    {
        $builder = $this->db->table('meja');
        $query = $builder->countAllResults();
        return $query;
    }
}
