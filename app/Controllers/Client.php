<?php

namespace App\Controllers;

use App\Models\beritapager;
use App\Models\Dbberita;
use CodeIgniter\Controller as kontrol;


helper('form');
helper('url');
helper('cookie');
class Client extends kontrol
{

    function __construct()
    {
        $pager = \Config\Services::pager();
        $this->beritapager = new beritapager();
    }


    function index()
    {

        $data = [
            'berita' => $this->beritapager->paginate(5, 'berita'),
            'pager' => $this->beritapager->pager,
            'titel' => 'Selamat Datang Di Wesbite Desa Hulusobo'
        ];

        return view('dashboard/home', $data);
    }

    function artikel()
    {
        $slug = service('uri')->getSegment('3');
        $db = new Dbberita();
        $list = $db->GetBerita($slug);
        $data = [
            'list' => $list,
            'titel' => $list->judul_berita
        ];

        return view('dashboard/artikel', $data);
    }


    function covid()
    {
        $url =  "https: //api.kawalcorona.com/indonesia/";
        $json = file_get_contents($url);
        $datax =  json_decode($json);

        $infect = $datax[0]->positif;
        $death = $datax[0]->meninggal;
        $health = $datax[0]->sembuh;

        $data = [
            'positif' => $infect,
            'meninggal' => $death,
            'sembuh' => $health,
        ];

        echo json_encode($data);
    }
    function search()
    {
        $search = $this->request->getPost('cari');
        if ($search != null) {


            $db = new Dbberita();
            $hasil = $db->searchberita($search);
            $data = [
                'data' => $hasil,
                'titel' => 'Hasil Pencarian...'
            ];



            return view('dashboard/hasilsearch', $data);
        } else {
            redirect()->to('/Client/index');
        }
    }
}
