<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Kategorilaporan extends basis
{

    protected $base;
    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table('kategori_laporan');
    }

    function getAllkategoriSurat()
    {
        $data = $this->base->get();
        return $data->getResult();
    }
}
