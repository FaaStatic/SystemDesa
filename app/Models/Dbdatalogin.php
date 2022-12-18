<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Dbdatalogin extends basis
{
    protected $basis;
    function __construct()
    {
        $this->db = db_connect();
        $this->basis = $this->db->table('login');
    }
    function getuser()
    {
        $data = $this->basis->get();
        return $data->getResult();
    }

    function adduser($data)
    {
        return $this->basis->insert($data);
    }


    function updateuser($id, $data)
    {
        return $this->basis->update($data, ['email_address' => $id]);
    }



    function cek_google($id)
    {

        $data =  $this->basis->where('email_address', $id)->get();
        if ($data->getRow() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
