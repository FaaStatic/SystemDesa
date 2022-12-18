<?php

namespace App\Models;

use CodeIgniter\Model as basis;


class Dbadmin extends basis
{
    protected $base;
    function __construct()
    {
        $this->db = db_connect();
        $this->base = $this->db->table('admin');
    }

    function getData($user)
    {
        return $this->base->getWhere(['username' => $user]);
    }
    function updateData($id, $data)
    {
        return $this->base->update($data, ['username' => $id]);
    }
}
