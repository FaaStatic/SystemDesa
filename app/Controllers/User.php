<?php

namespace App\Controllers;

use App\Models\Dbdatalogin;
use App\Models\Dbsuratinput;
use CodeIgniter\Controller as kontrol;
use App\Models\Dbuser;
use App\Models\Dblaporan;
use App\Models\Dbpenduduk;
use App\Models\Dbsurat;
use App\Models\Kategorilaporan;
use App\Models\kategorisurat;
use App\Models\Uploadslok;
use Google_Client;
use Google_Service_Oauth2;
use Fpdf\Fpdf;



$session = session();
helper('form');
helper('download');
helper('filesystem');
helper('url');
helper('cookie');
class User extends kontrol
{


    function index()
    {
        $db = new Dbpenduduk();
        $googleclient = new Google_Client();
        $googleclient->setClientId('872646835390-2bmtrvqpnujtskcj0daua1aou2107lr4.apps.googleusercontent.com');
        $googleclient->setClientSecret('gprhoRBWhy07LCdXgJL4Ppa4');
        $googleclient->setRedirectUri('http://localhost:8080/User/userdashboard');
        $googleclient->addScope('email');
        $googleclient->addScope('profile');
        $login_button = '<a href="' . $googleclient->createAuthUrl() . '"><img id="google" src="/assets/signingoogle.png" width="210px" height="40px"></a>';
        $button = [
            'list' => $db->listData(),
            'login_button' => $login_button,
            'titel' => 'Login Layanan Penduduk'
        ];
        return View('userlog/login', $button);
    }

    function tambahlog()
    {
        $status = "";
        $db = new Dbdatalogin();
        $cek = $db->getuser();
        foreach ($cek as $u) {
            if ($u->penduduk_id == $this->request->getPost('nik')) {
                $status = "sama";
                break;
            }
        }
        if ($status == "sama") {
            $psn = "sama";
            echo json_encode($psn);
        } else {
            $data = [
                'penduduk_id' => $this->request->getPost('nik'),
                'pass' => $this->request->getPost('pass'),
                'email_address' => $this->request->getPost('email')
            ];

            $status = $db->adduser($data);
            if ($status) {
                $psn = true;
                echo json_encode($psn);
            } else {
                $psn = false;
                echo json_encode($psn);
            }
        }
    }

    function authentifikasi()
    {
        $user = $this->request->getPost('nik');
        $pass = $this->request->getPost('pass');
        $db = new Dbuser();
        $status = $db->authentifikasi($user, $pass);
        if ($status) {
            $data = [
                'nik' => $user,
                'pass' => $pass,
            ];
            session()->set($data);
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }

    function userdashboard()
    {


        if ($_GET['code'] != null) {
            $db = new Dbdatalogin();
            $googleclient = new Google_Client();
            $googleclient->setClientId('872646835390-2bmtrvqpnujtskcj0daua1aou2107lr4.apps.googleusercontent.com');
            $googleclient->setClientSecret('gprhoRBWhy07LCdXgJL4Ppa4');
            $googleclient->setRedirectUri('http://localhost:8080/user/userdashboard');
            $googleclient->addScope('email');
            $googleclient->addScope('profile');

            if (isset($_GET['code'])) {
                $token =  $googleclient->fetchAccessTokenWithAuthCode($_GET['code']);

                if (!isset($token['error'])) {
                    $googleclient->setAccessToken($token['access_token']);
                    session()->set(['access_token' => $token['access_token']]);
                    $googleservice = new Google_Service_Oauth2($googleclient);
                    $data = $googleservice->userinfo->get();
                    $current_datetime = date('Y-m-d H:i:s');
                    if ($db->cek_google($data->email)) {

                        $user_data = [
                            'email_address' => $data->email,
                            'login_oauth_uid' => $data->id,
                            'first_name' => $data->givenName,
                            'last_name' => $data->familyName,
                            'profile_picture' => $data->picture,
                            'created_at' => $current_datetime,
                        ];
                        $db->updateuser($data->email, $user_data);
                        session()->set(['user_data' => $user_data]);
                    } else {
                        session()->setFlashdata('fail', 'email belum terdaftar!');
                        return redirect()->to('/User/index');
                    }
                }
            }

            if (session()->get('user_data')) {
                $user = session()->get('user_data');
                $db = new Dbuser();
                $dbp = new Dbpenduduk();
                $item = $db->getuseremail($user['email_address']);
                $item_id = $dbp->GetData($item->nik);
                $data = [
                    'id' => $item_id->id,
                    'nik' => $item->nik,
                    'foto_google' => $user['profile_picture'],

                    'nama' => $user['first_name'] . " " . $user['last_name'],
                    'foto_diri' => "null",
                    'titel' => 'User Dashboard',
                ];
                return view('userlog/landing', $data);
            } else {
                session()->setFlashdata('fail', 'sesi habis!');
                return redirect()->to('/User/index');
            }
        } else if (session()->get('user_data')) {

            if (session()->get('user_data')) {
                $user = session()->get('user_data');
                $db = new Dbuser();
                $dbp = new Dbpenduduk();
                $item = $db->getuseremail($user['email_address']);
                $item_id = $dbp->GetData($item->nik);
                $data = [
                    'id' => $item_id->id,
                    'nik' => $item->nik,
                    'foto_google' => $user['profile_picture'],

                    'nama' => $user['first_name'] . " " . $user['last_name'],
                    'foto_diri' => "null",
                    'titel' => 'User Dashboard',
                ];
                return view('userlog/landing', $data);
            } else {
                session()->setFlashdata('fail', 'sesi habis!');
                return redirect()->to('/User/index');
            }
        } else {
            if (session()->has('nik') && (session()->get('nik') != null)) {
                $db = new Dbuser();
                $dbp = new Dbpenduduk();
                $item = $db->getUser(session()->get('nik'));
                $item_id = $dbp->GetData(session()->get('nik'));
                $data = [
                    'id' => $item_id->id,
                    'nik' => $item->nik,
                    'nama' => $item->nama,
                    'foto_diri' => base64_encode($item->foto_diri),
                    'titel' => 'User Dashboard',
                ];

                return view('userlog/landing', $data);
            } else {
                session()->setFlashdata('fail', 'sesi habis!');
                return redirect()->to('/User/index');
            }
        }
    }



    function layanansurat()
    {
        if (session()->has('nik') && (session()->get('nik') != null)) {
            $db = new Dbuser();
            $dbp = new Dbpenduduk();
            $item = $db->getUser(session()->get('nik'));
            $item_id = $dbp->GetData(session()->get('nik'));
            $kategori_surat = new Kategorisurat();
            $data = [
                'id' => $item_id->id,
                'nik' => $item->nik,
                'kategori' => $kategori_surat->getAllkategoriSurat(),
                'nama' => $item->nama,
                'foto_diri' => base64_encode($item->foto_diri),
                'titel' => 'Layanan Surat',
            ];

            return view('userlog/surat', $data);
        } else if (session()->get('user_data')) {
            $user = session()->get('user_data');
            $db = new Dbuser();
            $dbp = new Dbpenduduk();
            $item = $db->getuseremail($user['email_address']);
            $item_id = $dbp->GetData($item->nik);
            $kategori_surat = new Kategorisurat();
            $data = [
                'id' => $item_id->id,
                'nik' => $item->nik,
                'foto_google' => $user['profile_picture'],
                'kategori' => $kategori_surat->getAllkategoriSurat(),
                'nama' => $user['first_name'] . " " . $user['last_name'],
                'foto_diri' => "null",
                'titel' => 'Layanan Surat',
            ];
            return view('userlog/surat', $data);
        } else {
            session()->setFlashdata('fail', 'sesi habis!');
            return redirect()->to('/User/index');
        }
    }
    function logout()
    {

        $arr = [
            'google' => session()->get('user_data'),
            'nik' => session()->get('nik'),
            'pass' => session()->get('pass'),
        ];

        session()->destroy($arr);

        return redirect()->to('/User/index');
    }

    function suratinput()
    {
        $db = new Dbsuratinput();
        $data = [
            'penduduk_id' => $this->request->getPost('id'),

            'tujuan' => $this->request->getPost('tujuan'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $status = $db->tambahsurat($data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }

    function status()
    {
        if (session()->get('nik')) {

            $kode = session()->get('nik');
            $db = new Dbsurat();
            $dataku = $db->getStatusSuratUser($kode);
            foreach ($dataku as $item) {
                $data[] = [
                    'status' => $item->status_surat,
                    'kategori' => $item->kategori
                ];
            }

            $json = [
                'data' => $data
            ];
            echo json_encode($json);
        } else if (session()->get('user_data')) {
            $user = session()->get('user_data');
            $db = new Dbuser();
            $item = $db->getuseremail($user['email_address']);
            $db = new Dbsurat();
            $kode = $item->nik;
            $dataku = $db->getStatusSuratUser($kode);
            foreach ($dataku as $item) {
                $data[] = [
                    'status' => $item->status_surat,
                    'kategori' => $item->kategori
                ];
            }

            $json = [
                'data' => $data
            ];
            echo json_encode($json);
        }
    }
    function layananlaporan()
    {
        if (session()->has('nik') && (session()->get('nik') != null)) {
            $db = new Dbuser();
            $dbp = new Dbpenduduk();
            $item = $db->getUser(session()->get('nik'));
            $item_id = $dbp->GetData(session()->get('nik'));
            $kategori_lapor = new Kategorilaporan();
            $data = [
                'id' => $item_id->id,
                'nik' => $item->nik,
                'kategori' => $kategori_lapor->getAllkategoriSurat(),
                'nama' => $item->nama,
                'foto_diri' => base64_encode($item->foto_diri),
                'titel' => 'Layanan Laporan',
            ];

            return view('userlog/laporan', $data);
        } else if (session()->get('user_data')) {
            $user = session()->get('user_data');
            $db = new Dbuser();
            $dbp = new Dbpenduduk();
            $item = $db->getuseremail($user['email_address']);
            $item_id = $dbp->GetData($item->nik);
            $kategori_lapor = new Kategorilaporan();
            $data = [
                'id' => $item_id->id,
                'nik' => $item->nik,
                'foto_google' => $user['profile_picture'],
                'kategori' => $kategori_lapor->getAllkategoriSurat(),
                'nama' => $user['first_name'] . " " . $user['last_name'],
                'foto_diri' => "null",
                'titel' => 'Layanan Laporan',
            ];
            return view('userlog/laporan', $data);
        } else {
            session()->setFlashdata('fail', 'sesi habis!');
            return redirect()->to('/User/index');
        }
    }

    function laporanInput()
    {
        $db = new Dblaporan();
        $data = [
            'id_laporan' => $this->request->getPost('id'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tujuan' => $this->request->getPost('tujuan'),
            'kategori_laporan' => $this->request->getPost('kategori_laporan'),
        ];
        $status = $db->simpanLaporan($data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }

    function suratready()
    {

        if (session()->get('nik')) {
            $surat = new Dbsurat();
            $item = $surat->getStatusSuratUser(session()->get('nik'));
            foreach ($item as $list) {
                if ($list->status_surat == 1) {

                    $data[] = [
                        'kategori' => $list->kategori,
                        'keterangan' => $list->keterangan,
                        'tujuan' => $list->tujuan,
                        'download' => '<a href="' .  site_url('User/unduhsurat/' . $list->id_surat . '') . '" class="btn btn-success btn-md">download</a>',
                    ];
                }
            }
            $json = [
                'data' => $data
            ];
            echo json_encode($json);
        } else if (session()->get('user_data')) {
            $user = session()->get('user_data');
            $db = new Dbuser();
            $item = $db->getuseremail($user['email_address']);
            $db = new Dbsurat();
            $kode = $item->nik;
            $item = $db->getStatusSuratUser($kode);
            foreach ($item as $list) {
                if ($list->status_surat == 1) {

                    $data[] = [
                        'kategori' => $list->kategori,
                        'keterangan' => $list->keterangan,
                        'tujuan' => $list->tujuan,
                        'download' => '<a href="' .  site_url('User/unduhsurat/' . $list->id_surat . '') . '" class="btn btn-success btn-md">download</a>',
                    ];
                }
            }
            $json = [
                'data' => $data
            ];
            echo json_encode($json);
        }
    }



    function unduhsurat()
    {
        $id = service('uri')->getSegment('3');
        $db = new Uploadslok();
        $data = $db->getDataId($id);
        $d = $data->location . "/" . $data->filename;
        return $this->response->download($d, NULL);
    }

    function cetakbio()
    {

        if (session()->get('nik')) {
            $db = new Dbpenduduk();
            $db2 = new Dbuser();
            $nik = $db->GetData(session()->get('nik'));
            $nik2 = $db2->getUser(session()->get('nik'));
            $bln = date("m");
            $thn = date("Y");
            $surat = "02." . $nik->id . "/DHLSB//" . $bln . "/'" . $thn . "'";
            $pdf = new Fpdf('P', "mm", 'letter');
            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 24);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Pemerintah Desa Hulusobo", 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 19);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Kecamatan Kaligesing", 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Kabupaten Purworejo", 0, 1, 'C');
            $pdf->Line(20, 45, 196, 45);
            $pdf->Cell(100, 3, "", 0, 1);
            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(50);
            $pdf->Cell(100, 20, "BIODATA ANDA", 0, 1, 'C');
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(50);
            $pdf->Cell(100, 5, $surat, 0, 1, 'C');
            $pdf->Cell(100, 5, "", 0, 1, 'C');
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 10, "Anda Memiliki Biodata Sebagai Berikut:", 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Nama : " . $nik->nama, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Nomor Kartu Keluarga : " . $nik->nokk, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "NIK : " . $nik->nik, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Email : " . $nik2->email_address, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Agama : " . $nik->agama, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Jenis Kelamin : " . $nik->jenis, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Alamat : " . $nik->alamat, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kelurahan : " . $nik->kelurahan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kecamatan : " . $nik->kecamatan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kabupaten : " . $nik->kab, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Provinsi : " . $nik->prov, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kewarganegaraan : " . $nik->kewarganegaraan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Pekerjaan : " . $nik->pekerjaan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Status : " . $nik->status, 0, 1, "L");
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Demikian Data Yang Kami Berikan Sesuai Dengan Data Yang Ada.", 0, 1, "L");
            $pdf->Cell(100, 10, "", 0, 1, "L");
            $pdf->Cell(150);
            $pdf->Cell(25, 10, "Yang Bertanda tangan,", 0, 1, "C");
            $pdf->Cell(100, 25, "", 0, 1, "L");
            $pdf->Cell(150);
            $pdf->Cell(25, 10, $nik->nama, 0, 1, "C");
            $pdf->Output();
            $pdf->Close();
        } else {
            $db = new dbpenduduk();
            $user = session()->get('user_data');
            $db2 = new dbuser();
            $item = $db2->getuseremail($user['email_address']);
            $nik = $db->GetData($item->nik);
            $bln = date("m");
            $thn = date("Y");
            $surat = "02." . $nik->id . "/DHLSB//" . $bln . "/'" . $thn . "'";
            $pdf = new Fpdf('P', "mm", 'letter');
            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 24);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Pemerintah Desa Hulusobo", 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 19);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Kecamatan Kaligesing", 0, 1, 'C');
            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(50);
            $pdf->Cell(100, 10, "Kabupaten Purworejo", 0, 1, 'C');
            $pdf->Line(20, 45, 196, 45);
            $pdf->Cell(100, 3, "", 0, 1);
            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(50);
            $pdf->Cell(100, 20, "BIODATA ANDA", 0, 1, 'C');
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(50);
            $pdf->Cell(100, 5, $surat, 0, 1, 'C');
            $pdf->Cell(100, 5, "", 0, 1, 'C');
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 10, "Anda Memiliki Biodata Sebagai Berikut:", 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Nama : " . $nik->nama, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Nomor Kartu Keluarga : " . $nik->nokk, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "NIK : " . $nik->nik, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Email : " . $user['email_address'], 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Agama : " . $nik->agama, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Jenis Kelamin : " . $nik->jenis, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Alamat : " . $nik->alamat, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kelurahan : " . $nik->kelurahan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kecamatan : " . $nik->kecamatan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kabupaten : " . $nik->kab, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Provinsi : " . $nik->prov, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Kewarganegaraan : " . $nik->kewarganegaraan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Pekerjaan : " . $nik->pekerjaan, 0, 1, "L");
            $pdf->SetFont('Times', "", 12);
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Status : " . $nik->status, 0, 1, "L");
            $pdf->Cell(20);
            $pdf->Cell(100, 8, "Demikian Data Yang Kami Berikan Sesuai Dengan Data Yang Ada.", 0, 1, "L");
            $pdf->Cell(100, 10, "", 0, 1, "L");
            $pdf->Cell(150);
            $pdf->Cell(25, 10, "Yang Bertanda tangan,", 0, 1, "C");
            $pdf->Cell(100, 25, "", 0, 1, "L");
            $pdf->Cell(150);
            $pdf->Cell(25, 10, $nik->nama, 0, 1, "C");
            $pdf->Output();
            $pdf->Close();
        }
    }





    function listsurat()
    {
        $surat = new Dbsurat();
        $item = $surat->getStatusSuratUser(session()->get('nik'));
        foreach ($item as $list) {
            $data[] = [
                'tujuan' => $list->tujuan,
                'Jenis' => $list->kategori,
                'status' => $list->status_surat,
                'print' => '<button class="btn btn-success btn-sm" data-id="' . $list->id_surat . '" id="btncetak">Cetak Surat</button>'
            ];
        }

        $json = [
            'data' => $data
        ];
        echo json_encode($json);
    }
}
