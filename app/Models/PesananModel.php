<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pesanan';
    protected $primaryKey       = 'idPesan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["idPesan", "idMeja", "namaPelanggan", "jumlah", "total", "status", "tanggal"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function savePesan($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this;
    }

    //mengambil data tb pesan
    public function getPesan($idPesan = false)
    {
        if ($idPesan === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idPesan' => $idPesan]);
        }
    }
}
