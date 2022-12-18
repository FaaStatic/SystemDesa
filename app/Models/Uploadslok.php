<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Uploadslok extends basis
{
    protected $bsd;
    function __construct()
    {
        $this->db = db_connect();
        $this->bsd = $this->db->table('surat_upload');
    }



    function inputdata($data)
    {
        return $this->bsd->insert($data);
    }

    function cekdata()
    {

        $data =  $this->bsd->get();
        return $data->getResult();
    }

    function getDataId($id)
    {

        $data = $this->bsd->where('surat_id', $id)->get();
        return $data->getRow();
    }
}
