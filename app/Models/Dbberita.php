<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model as basisdata;


class Dbberita extends basisdata
{
    protected $base;

    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table('berita');
    }

    function tampilData()
    {
        $data = $this->base->get();
        return $data->getResult();
    }

    function tambahBerita($data)
    {
        return $this->base->insert($data);
    }

    function deleteBerita($id)
    {
        return $this->base->delete(['id' => $id]);
    }

    function updateBerita($id, $data)
    {
        return $this->base->update($data, ['slug_berita' => $id]);
    }

    function GetBerita($kode)
    {
        return $this->base->getWhere(['slug_berita' => $kode])->getRow();
    }

    function jumlahBerita()
    {
        return $this->db->table('berita')->countAll();
    }


    function searchberita($cari = null)
    {
        if ($cari == null) {
            $cari = "";
        } else {

            $this->base->like('judul_berita', $cari);
            $this->base->orlike('isi_berita', $cari);
            $data = $this->base->get();
            return $data->getResult();
        }
    }
    function itung($cari = null)
    {
        if ($cari == null) {
            $cari = "";
        } else {
            $this->base->like('judul_berita', $cari);

            return $this->base->countAllResults();
        }
    }
}
