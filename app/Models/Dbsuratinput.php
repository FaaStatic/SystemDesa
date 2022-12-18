<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Dbsuratinput extends basis
{
    protected $suratan;
    function __construct()
    {
        $this->db = db_connect();
        $this->suratan = $this->db->table('surat');
    }

    function tambahsurat($data)
    {
        return $this->suratan->insert($data);
    }
}
