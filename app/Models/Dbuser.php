<?php

namespace App\Models;

use CodeIgniter\Model as basis;

class Dbuser extends basis
{

    protected $sign;
    protected $base;

    function __construct()
    {
        $this->db = db_connect();
        $this->sign = $this->db->table('login');
        $this->sign->select('nik,pass,email_address,nama,tempat_lahir,tgl_lahir,jenis,agama,alamat,kelurahan,kecamatan,kab,prov,pekerjaan,kewarganegaraan,status,pendidikan,foto_diri');
        $this->sign->join('penduduk', 'login.penduduk_id=penduduk.id', 'left');
    }

    function getUser($nik)
    {
        $data =  $this->sign->getWhere(['nik' => $nik]);
        return $data->getRow();
    }

    function authentifikasi($nik, $pass)
    {
        $status = false;
        $data = $this->sign->get();
        $item = $data->getResult();
        foreach ($item as $tes) {
            if ($tes->nik == $nik && $tes->pass == $pass) {
                $status = true;
                break;
            }
        }

        return $status;
    }

    function getuseremail($id)
    {
        $data = $this->sign->where('email_address', $id)->get();
        return $data->getRow();
    }
}
