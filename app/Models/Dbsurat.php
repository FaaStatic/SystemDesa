<?php

namespace App\Models;


use CodeIgniter\Model as basis;



class Dbsurat extends basis
{
    protected $base;

    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table('surat');
        $this->base->select('id_surat,nik,nama,kategori,tujuan,keterangan,status_surat,disetujui');
        $this->base->join('penduduk', 'surat.penduduk_id = penduduk.id', 'left');
    }



    function ListSurat()
    {

        $data = $this->base->get();
        return $data->getResult();
    }
    function ListSuratneed()
    {

        $data = $this->base->getWhere('status_surat', 0);
        return $data->getResult();
    }

    function listSuratid($id)
    {
        $data =  $this->base->getWhere(['id_surat' => $id]);
        return $data->getRow();
    }

    function getStatusSuratUser($kode)
    {
        $data =  $this->base->GetWhere(['nik' => $kode]);
        return $data->getResult();
    }

    function updateSurat($id, $data)
    {
        return $this->base->update($data, ['id_surat' => $id]);
    }
    function listallsuratid($id)
    {
        $data =  $this->base->getWhere(['id_surat' => $id]);
        return $data->getRow();
    }



    function listApprove()
    {
        $data =  $this->base->Where('status_surat', 1)->get();
        return $data->getResult();
    }

    function listReject()
    {
        $data =  $this->base->where('status_surat', 2)->get();
        return $data->getResult();
    }

    function deleteSurat($id)
    {
        return $this->base->delete(['id_surat' => $id]);
    }

    function itunganmasuk()
    {
        return $this->base->countAll();
    }
}
