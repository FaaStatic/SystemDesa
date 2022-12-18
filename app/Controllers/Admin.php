<?php

namespace App\Controllers;

use CodeIgniter\Controller as kontrol;
use App\Models\Dbadmin;
use App\Models\Dbpenduduk;
use App\Models\Dbberita;
use App\Models\Dbsurat;
use App\Models\Dblaporan;
use App\Models\Uploadslok;
use Fpdf\Fpdf;

$session = session();
helper('form');
helper('url');
helper('cookie');

class Admin extends kontrol
{

    function index()
    {
        $data = [
            'titel' => 'Login Admin'
        ];
        echo View('admin/login', $data);
    }

    function updatepassword()
    {
        $user = session()->get('user');
        $key = $this->request->getPost('newpass');
        $pass = md5($key);
        $data = [
            'password' => $pass
        ];
        $db = new Dbadmin();
        $status = $db->updateData($user, $data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }
    function cekAdmin()
    {
        $user = $this->request->getPost('user');
        $pass = $this->request->getPost('pass');
        $pass = md5($pass);
        $dbs = new Dbadmin();
        $data = $dbs->getData($user);
        if (count($data->getResult()) > 0) {
            $item = $data->getRow();
            if ($item->password == $pass) {
                $sesiku = [
                    'user' => $item->username,
                    'pass' => $item->password,
                ];
                $kuki = [
                    'name' =>  $item->username,
                    'value' =>   $item->password,
                    'expire' => 7200,
                ];
                session()->set($sesiku);
                set_cookie($kuki);
                return redirect()->to('/Admin/mainPage');
            } else {
                session()->setFlashdata("notif", "Password yang anda masukan salah!");
                return redirect()->to('/Admin/index');
            }
        } else {
            session()->setFlashdata('notif', 'Username tidak di temukan');
            return redirect()->to('/Admin/index');
        }
    }


    function mainPage()
    {

        $user = session()->get('user');
        if ($user == null) {
            return redirect()->to('/Admin/index');
        } else {
            $databa = new Dbadmin();
            $penduduk = new Dbpenduduk();
            $news = new Dbberita();
            $surat = new Dbsurat();
            $laporan = new Dblaporan();

            $dataku = $databa->getData($user);
            $jumlah2 = $news->jumlahBerita();
            $jumlah = $penduduk->countfield();
            $jumlah3 = $surat->itunganmasuk();
            $jumlah4 = $laporan->itunganmasuk();

            if (count($dataku->getResult()) > 0) {
                $list = $dataku->getRow();
                $data = [
                    'pengguna' => $list->username,
                    'foto' => $list->foto,
                    'content' => 'Admin/contentLanding',
                    'jumlah' => $jumlah,
                    'jumlah2' => $jumlah2,
                    'jumlah3' => $jumlah3,
                    'jumlah4' => $jumlah4,
                    'titel' => 'Dashboard Admin Desa'

                ];

                echo View('Admin/landing', $data);
            }
        }
    }


    function penduduk()
    {
        $user = session()->get('user');
        $pass = session()->get('pass');
        if ($user != null) {
            $databa = new Dbadmin();
            $dataku = $databa->getData($user);
            if (count($dataku->getResult()) > 0) {
                $list = $dataku->getRow();
                $data = [
                    'pengguna' => $list->username,
                    'foto' => $list->foto,
                    'titel' => 'Data Penduduk',
                ];
            }

            return view('admin/indexpenduduk', $data);
        } else {
            session()->setFlashdata('notif', "login Ulang! sesi anda habis");
            return redirect()->to('/Admin/index');
        }
    }

    function GetPenduduk()
    {
        $citizen = new Dbpenduduk();
        $list =  $citizen->listData();
        $data = array();
        $json = array();
        foreach ($list as $item) {
            $data[] = [
                'nik' =>    $item->nik,
                'nama' =>  $item->nama,
                'tempat_lahir' =>   $item->tempat_lahir,
                'tgl_lahir' =>  $item->tgl_lahir,
                'jenis' =>   $item->jenis,
                'pekerjaan' => $item->pekerjaan,
                'status' =>  $item->status,
                'foto' => base64_encode($item->foto_diri),
                'aksi' => '<button type="button" tooltip="Update Data " data-id="' . $item->nik . '" id="btn-update" class="btn btn-sm btn-primary" >U</button>|<button id="btn-hapus"  type="button" class="btn btn-sm btn-danger" tooltip="Delete Data " data-id="' . $item->nik . '">X</button>'
            ];
        }
        $json = [
            'data' => $data,
        ];
        echo json_encode($json);
    }

    function tambahpenduduk()
    {
        $db = new Dbpenduduk();
        $foto = $_FILES['foto_diri']['tmp_name'];
        $data = file_get_contents($foto);
        $data = [
            'nokk' => $this->request->getPost('nokk'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis' => $this->request->getPost('jenis'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'kelurahan' => $this->request->getPost('kelurahan'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kab' => $this->request->getPost('kab'),
            'prov' => $this->request->getPost('prov'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'status' => $this->request->getPost('status'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'foto_diri' => $data,
        ];

        $hasil = $db->simpanData($data);
        if ($hasil) {
            $pesan = true;
            echo json_encode($pesan);
        } else {
            $pesan = false;
            echo json_encode($pesan);
        }
    }

    function editpenduduk()
    {
        $nik = service('uri')->getSegment('3'); //base/contorller/method/get
        $db = new Dbpenduduk();
        $dbs = $db->GetData($nik);
        $data = [
            'id' => $dbs->id,
            'nokk' => $dbs->nokk,
            'nik' => $dbs->nik,
            'nama' => $dbs->nama,
            'tempat_lahir' => $dbs->tempat_lahir,
            'tgl_lahir' => $dbs->tgl_lahir,
            'jenis' => $dbs->jenis,
            'agama' => $dbs->agama,
            'alamat' => $dbs->alamat,
            'kelurahan' => $dbs->kelurahan,
            'kecamatan' => $dbs->kecamatan,
            'kab' => $dbs->kab,
            'prov' => $dbs->prov,
            'pekerjaan' => $dbs->pekerjaan,
            'kewarganegaraan' => $dbs->kewarganegaraan,
            'status' => $dbs->status,
            'pendidikan' => $dbs->pendidikan,
            'foto_diri' => base64_encode($dbs->foto_diri),
        ];

        echo json_encode($data);
    }

    function updatependuduk()
    {
        $kode = $this->request->getPost('nik');
        $db = new Dbpenduduk();
        if ($_FILES['foto_diri']['size'] == 0) {
            $data = [
                'nokk' => $this->request->getPost('nokk'),
                'nama' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'jenis' => $this->request->getPost('jenis'),
                'agama' => $this->request->getPost('agama'),
                'alamat' => $this->request->getPost('alamat'),
                'kelurahan' => $this->request->getPost('kelurahan'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kab' => $this->request->getPost('kab'),
                'prov' => $this->request->getPost('prov'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
                'status' => $this->request->getPost('status'),
                'pendidikan' => $this->request->getPost('pendidikan'),
            ];
            $status = $db->updateData($kode, $data);
        } else {
            $foto = $_FILES['foto_diri']['tmp_name'];
            $data = file_get_contents($foto);
            $data = [
                'nokk' => $this->request->getPost('nokk'),
                'nama' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'jenis' => $this->request->getPost('jenis'),
                'agama' => $this->request->getPost('agama'),
                'alamat' => $this->request->getPost('alamat'),
                'kelurahan' => $this->request->getPost('kelurahan'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kab' => $this->request->getPost('kab'),
                'prov' => $this->request->getPost('prov'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
                'status' => $this->request->getPost('status'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'foto_diri' => $data,
            ];
            $status = $db->updateData($kode, $data);
        }
        if ($status) {
            $pesan = true;
            echo json_encode($pesan);
        } else {
            $pesan = false;
            echo json_encode($pesan);
        }
    }

    function hapuspenduduk()
    {
        $nik = service('uri')->getSegment('3');
        $db = new Dbpenduduk();
        $status = $db->DeleteData($nik);
        if ($status) {
            $pesan = true;
            echo json_encode($pesan);
        } else {
            $pesan = false;
            echo json_encode($pesan);
        }
    }


    function indexBerita()
    {
        $user = session()->get('user');
        $pass = session()->get('pass');
        if ($user != null) {
            $databa = new Dbadmin();
            $dataku = $databa->getData($user);
            if (count($dataku->getResult()) > 0) {
                $list = $dataku->getRow();
                $data = [
                    'pengguna' => $list->username,
                    'foto' => $list->foto,
                    'titel' => 'Data Berita',
                ];
            }

            echo view('admin/indexberita', $data);
        }
    }

    function getberita()
    {
        $data = array();
        $json = array();
        $db = new Dbberita();
        $list = $db->tampilData();
        foreach ($list as $item) {
            $data[] = [
                'judul_berita' => $item->judul_berita,
                'isi_berita' => $item->isi_berita,
                'gambar_berita' => base64_encode($item->gambar_berita),
                'slug_berita' => $item->slug_berita,
                'thumbnail' => $item->thumbnail,
                'create_berita' => $item->create_berita,
                'aksi' => '<button class="btn btn-success btn-sm" id="btn-update" data-id="' . $item->slug_berita . '">U</button>|<button class="btn btn-danger btn-sm" id="btn-hapus" data-id="' . $item->id . '">X</button>',
            ];
        }
        $json = [
            'data' => $data
        ];
        echo json_encode($json, JSON_PRETTY_PRINT);
    }

    function tambahberita()
    {
        $db = new Dbberita();
        $foto = $_FILES['gambar_berita']['tmp_name'];
        $fotos = file_get_contents($foto);
        $data = [
            'judul_berita' => $this->request->getPost('judul_berita'),
            'isi_berita' => $this->request->getPost('isi_berita'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'gambar_berita' => $fotos,
            'slug_berita' => $this->request->getPost('slug_berita'),
        ];
        $status = $db->tambahBerita($data);
        if ($status) {
            $psn = true;
            echo json_encode($psn);
        } else {
            $psn = false;
            echo json_encode($psn);
        }
    }

    function updateberita()
    {
        $kode = $this->request->getPost('slug_berita');
        $db = new Dbberita();
        $foto = $_FILES['gambar_berita']['tmp_name'];
        if ($_FILES['gambar_berita']['size'] == 0) {
            $data = [
                'judul_berita' => $this->request->getPost('judul_berita'),
                'isi_berita' => $this->request->getPost('isi_berita'),
                'thumbnail' => $this->request->getPost('thumbnail'),

            ];
            $status = $db->updateBerita($kode, $data);
        } else {
            $fotos = file_get_contents($foto);
            $data = [
                'judul_berita' => $this->request->getPost('judul_berita'),
                'isi_berita' => $this->request->getPost('isi_berita'),
                'thumbnail' => $this->request->getPost('thumbnail'),
                'gambar_berita' => $fotos,

            ];
            $status = $db->updateBerita($kode, $data);
        }

        if ($status) {
            $psn = true;
            echo json_encode($psn);
        } else {
            $psn = false;
            echo json_encode($psn);
        }
    }

    function editberita()
    {
        $judul = service('uri')->getSegment('3');
        $db = new Dbberita();
        $item = $db->GetBerita($judul);
        $data = [
            'judul_berita' => $item->judul_berita,
            'isi_berita' => $item->isi_berita,
            'thumbnail' => $item->thumbnail,
            'gambar_berita' => base64_encode($item->gambar_berita),
            'slug_berita' => $item->slug_berita,
            'create_berita' => $item->create_berita,
        ];
        echo json_encode($data);
    }
    function hapusberita()
    {
        $id = service('uri')->getSegment('3');
        $db = new Dbberita();
        $status = $db->deleteBerita($id);
        if ($status) {
            $psn = true;
            echo json_encode($psn);
        } else {
            $psn = false;
            echo json_encode($psn);
        }
    }

    function indexsurat()
    {
        $user = session()->get('user');
        $pass = session()->get('pass');
        if ($user != null) {
            $databa = new Dbadmin();
            $dataku = $databa->getData($user);
            if (count($dataku->getResult()) > 0) {
                $list = $dataku->getRow();
                $data = [
                    'pengguna' => $list->username,
                    'foto' => $list->foto,
                    'titel' => 'Data Surat',
                ];
            }
        }
        echo view('admin/surat', $data);
    }




    function listsurat()
    {
        $db = new Dbsurat();
        $data = array();
        $list = $db->ListSuratneed();
        foreach ($list as $item) {
            $data[] = [
                'id' => $item->id_surat,
                'nik' => $item->nik,
                'nama' => $item->nama,
                'kategori' => $item->kategori,
                'tujuan' => $item->tujuan,
                'keterangan' => $item->keterangan,
                'status_surat' => $item->status_surat,
                'aksi' => "<button id='setuju' class='btn btn-success btn-md' data-id='" . $item->id_surat . "'>setuju</button>|<button id='tolakan' class='btn btn-danger btn-md' data-id='" . $item->id_surat . "'>Tolak</button>",
                'cetak' => "<a href=" . site_url('Admin/cetaksurat/' . $item->id_surat . '') . " id='cetak' class='btn btn-success btn-md' data-id='" . $item->id_surat . "'>Cetak</a>",
            ];
        }
        $json = [
            'data' => $data
        ];

        echo json_encode($json);
    }
    function listsuratterima()
    {
        $db = new Dbsurat();
        $data = array();
        $list = $db->listApprove();
        foreach ($list as $item) {
            $data[] = [
                'id' => $item->id_surat,
                'nik' => $item->nik,
                'nama' => $item->nama,
                'kategori' => $item->kategori,
                'tujuan' => $item->tujuan,
                'keterangan' => $item->keterangan,
                'status_surat' => '<h3>Diterima</h3>',
                'upload' => '<button id="uploadfile" data-id="' . $item->id_surat . '" class="btn btn-success btn-md">upload</button>'

            ];
        }
        $json = [
            'data' => $data,
        ];

        echo json_encode($json);
    }

    function listsurattolak()
    {
        $db = new Dbsurat();
        $data = array();
        $list = $db->listReject();
        foreach ($list as $item) {
            $data[] = [
                'id' => $item->id_surat,
                'nik' => $item->nik,
                'nama' => $item->nama,
                'kategori' => $item->kategori,
                'tujuan' => $item->tujuan,
                'keterangan' => $item->keterangan,
                'status_surat' => $item->status_surat,
                'status' => "Ditolak",
            ];
        }
        $json = [
            'data' => $data
        ];

        echo json_encode($json);
    }
    function suratditerima()
    {
        $id = service('uri')->getSegment('3');
        $db = new Dbsurat();
        $data = [
            'status_surat' => 1,
            'disetujui' => session()->get('user'),
        ];
        $status = $db->updateSurat($id, $data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }


    function suratditolak()
    {
        $id = service('uri')->getSegment('3');
        $db = new Dbsurat();
        $data = [
            'status_surat' => 2,
            'disetujui' => session()->get('user'),
        ];
        $status = $db->updateSurat($id, $data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }

    function uploddata()
    {
        $insrt = new uploadslok();
        $id = $this->request->getPost('idupload');

        $file =  $_FILES['uploadsurat']['tmp_name'];
        $file_name =  $_FILES['uploadsurat']['name'];
        $path = "./lokasidone";
        $data = [
            'surat_id' => $id,
            'filename' => $file_name,
            'location' => $path,
        ];
        move_uploaded_file($file, "$path/$file_name");

        $status = $insrt->inputdata($data);
        if ($status) {
            $msg = true;
            echo json_encode($msg);
        } else {
            $msg = false;
            echo json_encode($msg);
        }
    }

    function cekupload()
    {
        $status = false;
        $id = service('uri')->getSegment('3');
        $db = new Uploadslok();
        $cek = $db->cekdata();
        foreach ($cek as $item) {
            if ($item->surat_id === $id) {
                $status = true;
                break;
            }
        }
        $json = [
            'data' => $status,
        ];
        echo json_encode($json);
    }

    function statusnotif()
    {
        $db = new Dbsurat();
        $dataku = $db->ListSurat();
        $data = array();
        foreach ($dataku as $item) {
            $data[] = [
                'pengirim' => $item->nama,
                'kategori' => $item->kategori
            ];
        }


        $json = [
            'data' => $data
        ];
        echo json_encode($json);
    }

    function statuslapornotif()
    {
        $db = new Dblaporan();
        $data = array();
        $dataku = $db->list_data();
        foreach ($dataku as $item) {
            $data[] = [
                'pengirim' => $item->nama,
                'kategori_lapor' => $item->kategori_laporan
            ];
        }

        $json = [
            'data' => $data
        ];
        echo json_encode($json);
    }


    function cetaksurat()
    {
        $id = service('uri')->getSegment('3');
        $db = new Dbsurat();
        $data = $db->listallsuratid($id);
        $bln = date("m");
        $thn = date("Y");
        $surat = "02." . $data->id_surat . "/DHLSB//" . $bln . "/'" . $thn . "'";
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
        $pdf->Cell(100, 20, "Data Permohonan Surat", 0, 1, 'C');
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(50);
        $pdf->Cell(100, 5, $surat, 0, 1, 'C');
        $pdf->Cell(100, 5, "", 0, 1, 'C');
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 10, "Data Pemohon Surat Sebagai Berikut :", 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 8, "Nama : " . $data->nama, 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 8, "NIK : " . $data->nik, 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 8, "Kategori : " . $data->kategori, 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 8, "Tujuan: " . $data->tujuan, 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(20);
        $pdf->Cell(100, 8, "Tujuan: " . $data->keterangan, 0, 1, "L");
        $pdf->SetFont('Times', "", 12);
        $pdf->Cell(100, 8, "Demikian Data Pemohon Surat Berikan,Mohon Untuk Di Verifikasi.", 0, 1, "L");
        $pdf->Cell(100, 10, "", 0, 1, "L");
        $pdf->Cell(150);
        $pdf->Cell(25, 10, "Yang Bertanda tangan,", 0, 1, "C");
        $pdf->Cell(100, 25, "", 0, 1, "L");
        $pdf->Cell(150);
        $pdf->Cell(25, 10, session()->get('user'), 0, 1, "C");
        $pdf->Output();
        $pdf->Close();
    }


    function laporanindex()
    {
        $user = session()->get('user');
        $pass = session()->get('pass');
        if ($user != null) {
            $databa = new Dbadmin();
            $dataku = $databa->getData($user);
            if (count($dataku->getResult()) > 0) {
                $list = $dataku->getRow();
                $data = [
                    'pengguna' => $list->username,
                    'foto' => $list->foto,
                    'titel' => 'Data Laporan',
                ];
            }
        }
        echo view('admin/laporan', $data);
    }

    function listlaporan()
    {
        $db = new Dblaporan();
        $item = $db->list_data();
        foreach ($item as $list) {
            $data[] = [
                'kategori' => $list->kategori_laporan,
                'pelapor' => $list->nama,
                'tujuan' => $list->tujuan,
                'keterangan' => $list->keterangan,
            ];
        }
        $json = [
            'data' => $data
        ];
        echo json_encode($json);
    }

    function logout()
    {
        session()->remove('user');
        return redirect()->to('/Admin/index');
    }
}
