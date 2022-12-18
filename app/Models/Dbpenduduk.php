<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Dbpenduduk extends basis
{

    protected $base;
    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table("penduduk");
    }

    function DeleteData($kode)
    {
        return $this->base->delete(['nik' => $kode]);
    }

    function listData()
    {
        $data = $this->base->get();
        return $data->getResult();
    }

    function simpanData($data)
    {
        return $this->base->insert($data);
    }

    function countfield()
    {
        return $this->base->countAll();
    }

    function GetData($kode)
    {
        $data =  $this->base->getWhere(['nik' => $kode]);
        return $data->getRow();
    }

    function updateData($kode, $data)
    {
        return $this->base->update($data, ['nik' => $kode]);
    }
}
