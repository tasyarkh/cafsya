<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'idTrans';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idPesan', 'total', 'status', 'tanggal'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    protected $createdField  = 'tanggal';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getData()
    {
        return $this->select('transaksi.*, pesanan.namaPelanggan')
            ->join('pesanan', 'transaksi.idTrans = pesanan.idPesan')
            ->get()
            ->getResultArray();
    }

    public function getById($id)
    {
        $transaksi = $this->db->table('transaksi')
            ->select('transaksi.idTrans, transaksi.status, transaksi.idPesan as pesanId, pesanan.namaPelanggan, pesanan.idMeja, pesanan.total')
            ->join('pesanan', 'transaksi.idTrans = pesanan.idPesan', 'left')
            ->where('transaksi.idTrans', $id)
            ->get()
            ->getRowArray();

        if (!empty($transaksi)) {
            return $transaksi;
        } else {
            return null;
        }
    }

    public function whereDate($search_date)
    {
        return $this->db->table('transaksi')
            ->select('transaksi.*, pesanan.namaPelanggan')
            ->join('pesanan', 'transaksi.idTrans = pesanan.idPesan')
            ->where('tanggal', $search_date)
            ->get()
            ->getResult();
    }

    public function countTrans(){
        $builder = $this->db->table('transaksi');
        $query = $builder->countAllResults();
        return $query;
    }
}
