<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Dblaporan extends basis
{
    protected $base;
    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table('laporan');
        $this->base->select('laporan_id,nik,nama,kategori_laporan,tujuan,keterangan');
        $this->base->join('penduduk', 'laporan.id_laporan = penduduk.id', 'left');
    }

    function list_data()
    {
        $data =  $this->base->get();
        return $data->getResult();
    }

    function getReportUser($id)
    {
        $data = $this->base->getWhere(['nik' => $id]);
        return $data->getResult();
    }


    function simpanLaporan($data)
    {
        return $this->base->insert($data);
    }

    function updatelaporan($nik, $data)
    {
        return $this->base->update(['nik' => $nik], $data);
    }

    function itunganmasuk()
    {
        return $this->base->countAll();
    }

    function deleteLaporan($id)
    {
        return $this->base->delete(['laporan_id' => $id]);
    }
}
