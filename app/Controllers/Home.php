<?php

namespace App\Controllers;
use App\Models\DataModelJendela;

class Home extends BaseController
{
    function __construct() {
        $this->datamodeljendela = new DataModelJendela();
    }

    public function index()
    {
        // home/data/286300/2
        $this->data("286300","2");
    }

    public function tes()
    {
        $getsekolah=$this->datamodeljendela->getSekolah('286300');
        print_r($getsekolah->getResult());
    }

    public function data($kode='000000', $level=0, $status="all")
    {
        $data['tingkat'] = "semua";
        $data['kode'] = $kode;
        $data['level'] = $level;
        $data['status'] = $status;

        if ($level==0) {
            $data['namapilihan'] = "PROVINSI";
        }
        else {
            $namapilihan = $this->datamodeljendela->getNamaPilihan($kode);
            $resultquery = $namapilihan->getResult();
            $data['namapilihan'] = strToUpper($resultquery[0]->nama);
        }

        $namalevel1 = $this->datamodeljendela->getNamaPilihan(substr($kode,0,2)."0000");
        $result1 = $namalevel1->getResult();
        $data['namalevel1'] = $result1[0]->nama;
        $namalevel2 = $this->datamodeljendela->getNamaPilihan(substr($kode,0,4)."00");
        $result2 = $namalevel2->getResult();
        $data['namalevel2'] = $result2[0]->nama;
        $namalevel3 = $this->datamodeljendela->getNamaPilihan(substr($kode,0,6));
        $result3 = $namalevel3->getResult();
        $data['namalevel3'] = $result3[0]->nama;

        
        if ($level<2) {
            $query = $this->datamodeljendela->getSemuaTotalSekolah($kode,$level);
            $dafsekolah=$query->getResult();
            $query2 = $this->datamodeljendela->getSemuaTotalSiswa($kode,$level);
            $dafsiswa=$query2->getResult();
            $query3 = $this->datamodeljendela->getSemuaTotalPendidik($kode,$level);
            $dafpendidik=$query3->getResult();
            $query4 = $this->datamodeljendela->getSemuaTotalTendik($kode,$level);
            $daftendik=$query4->getResult();
            $query5 = $this->datamodeljendela->getSemuaTotalKepsek($kode,$level);
            $dafkepsek=$query5->getResult();
            
            
            $datanas = array();
            foreach ($dafsekolah as $row){
                $rowclear = trim($row->nama);
                $rowclear = str_replace(".","",$rowclear);
                $rowclear = str_replace(" ","",$rowclear);
                $rowclear = strtoLower($rowclear);
                $datanas[$rowclear] = ["nama"=>$row->nama, "kode_wilayah"=>$row->kode_wilayah, "jml_sekolah_negeri" =>$row->jml_sekolah_negeri, "jml_sekolah_swasta" =>$row->jml_sekolah_swasta];
            }

            foreach ($dafsiswa as $row){
                $rowclear = trim($row->nama);
                $rowclear = str_replace(".","",$rowclear);
                $rowclear = str_replace(" ","",$rowclear);
                $rowclear = strtoLower($rowclear);
                $datanas[$rowclear] = array_merge($datanas[$rowclear],["jml_siswa_negeri" =>$row->jml_siswa_negeri, "jml_siswa_swasta" =>$row->jml_siswa_swasta]);
            }

            foreach ($dafpendidik as $row){
                $rowclear = trim($row->nama);
                $rowclear = str_replace(".","",$rowclear);
                $rowclear = str_replace(" ","",$rowclear);
                $rowclear = strtoLower($rowclear);
                $datanas[$rowclear] = array_merge($datanas[$rowclear],["jml_pendidik_negeri" =>$row->jml_pendidik_negeri, "jml_pendidik_swasta" =>$row->jml_pendidik_swasta]);
            }

            foreach ($daftendik as $row){
                $rowclear = trim($row->nama);
                $rowclear = str_replace(".","",$rowclear);
                $rowclear = str_replace(" ","",$rowclear);
                $rowclear = strtoLower($rowclear);
                $datanas[$rowclear] = array_merge($datanas[$rowclear],["jml_tendik_negeri" =>$row->jml_tendik_negeri, "jml_tendik_swasta" =>$row->jml_tendik_swasta]);
            }

            foreach ($dafkepsek as $row){
                $rowclear = trim($row->nama);
                $rowclear = str_replace(".","",$rowclear);
                $rowclear = str_replace(" ","",$rowclear);
                $rowclear = strtoLower($rowclear);
                $datanas[$rowclear] = array_merge($datanas[$rowclear],["jml_kepsek_negeri" =>$row->jml_kepsek_negeri, "jml_kepsek_swasta" =>$row->jml_kepsek_swasta]);
            }

            // echo var_dump($datanas);
            // die();

            $data['datanas'] = $datanas;
            echo view('data_nasional', $data);
        }
        else
        {
            $this->profil($kode); 
        }
    }
    
    public function profil($kodewilayah=null, $opsi=null)
    {
        if ($kodewilayah==null)
        $kodewilayah = $_GET['kode_wilayah'];
        
        $getkecamatan = $this->datamodeljendela->getKecamatan($kodewilayah);
        $getkelurahan = $this->datamodeljendela->getKelurahan($kodewilayah);
        $getkabkot = $this->datamodeljendela->getKabKot($kodewilayah)->getRow();
        $getguru = $this->datamodeljendela->getTotalGuru($kodewilayah);
        $gettendik = $this->datamodeljendela->getTotalTendik($kodewilayah);
        $getkepsek = $this->datamodeljendela->getTotalKepsek($kodewilayah);
        $getcagarbudaya = "0";//$this->datamodeljendela->getGuru($kodewilayah);
        $getmuseum = "0";//$this->datamodeljendela->getGuru($kodewilayah);
        $get_sekolah_akreditasi = $this->datamodeljendela->get_sekolah_akreditasi($kodewilayah);
        $get_sekolah_status = $this->datamodeljendela->get_sekolah_status($kodewilayah);
        
        $getkoordinat = $this->datamodeljendela->getkoordinatgeo($kodewilayah);
        
        $datakebupaten=[];
        $datakebupaten['nama'] = $getkabkot->nama;
        $datakebupaten['jumlah_kecamatan'] = sizeof($getkecamatan->getResult());
        $datakebupaten['jumlah_kelurahan'] = sizeof($getkelurahan->getResult());
        $datakebupaten['jumlah_guru'] = $getguru->total_guru+$gettendik->total_tendik;
        $datakebupaten['jumlah_kepsek'] = $getkepsek->total_kepsek;
        $datakebudayaan=[];
        $datakebudayaan['jumlah_cagarbudaya'] = $getcagarbudaya;//sizeof($getsiswa->getResult());
        $datakebudayaan['jumlah_museum'] = $getmuseum;//sizeof($getsiswa->getResult());
        
        $getsekolah = $this->datamodeljendela->getTotalSekolah($kodewilayah);

        $bentukspaud = array('TK','KB','TPA','SPS','RA','Taman Seminari','SPK KB','PAUDQ','SPK PG','SPK TK','Pratama W P','Nava Dhammasekha');
        $bentukspendidikan = array('TK','KB','TPA','SPS','SD','SMP','SDLB','SMPLB','MI','MTs',
        'Paket A','Paket B','SMA','SMLB','SMK','MA','MAK','Paket C','Akademik','Politeknik',
        'Sekolah Tinggi','Institut','Universitas','Kursus','Keaksaraan','TBM','PKBM','Life Skill',
        'SLB','Satap TK SD','Satap SD SMP','Satap TK SD SMP','Satap SD SMP SMA','RA','SMP',
        'SMPTK','SMTK','SDTK','SMAg.K','SKB','Taman Seminari','TKLB','SPK KB','SMAK','PAUDQ',
        'SPK PG','SPK TK','SPK SD','SPK SMP','SPK SMA','Pondok Pesantren','Pratama W P','Adi W P',
        'Madyama W P','Utama W P','Nava Dhammasekha','Mula Dhammasekha','Muda Dhammasekha','Uttama Dhammasekha','Uttama Dhammasekha Kejuruan','Akademi Komunitas','PDF Ula',
        'PDF Wustha','PDF Ulya','SPM Ula','SPM Wustha','SPM Ulya');
        $fields_akreditasi = array ('akreditasi_a','akreditasi_b','akreditasi_c','akreditasi_tidak_terakreditasi','akreditasi_belum_terakreditasi','akreditasi_terakreditasi');

        // $getsekolahbentuk_akreditasi = $this->datamodeljendela->getTotalSekolahBentuk($kodewilayah,$bentukspendidikan,$fields_akreditasi,$entitas);
       
        // $getsekolahbentuk_akreditasidikdas = $this->datamodeljendela->getTotalSekolahBentuk($kodewilayah,$bentuksdikdas,$fields_akreditasi);
        
        $getsiswa = $this->datamodeljendela->getTotalSiswa($kodewilayah);

        // echo var_dump($getsiswa);

        $data['lintang'] = $getkoordinat['lintang'];
        $data['bujur'] = $getkoordinat['bujur'];
        $data['akreditasi'] = $get_sekolah_akreditasi;
        $data['status_sekolah'] = $get_sekolah_status;
        $data['status_peta'] = $getkoordinat['status'];
        $data['datakabupaten'] = $datakebupaten;
        $data['datakebudayaan'] = $datakebudayaan;
        $data['datasekolahan'] = $getsekolah;
        // $data['datasekolahanbentuk'] = $getsekolahbentuk_akreditasi;
        // $data['datasekolahanbentukdikdas'] = $getsekolahbentuk_akreditasidikdas;
        $data['datasiswa'] = $getsiswa;
        $data['dataguru'] = $getguru;
        $data['datatendik'] = $gettendik;
        $data['kodewilayah'] = $kodewilayah;
        $data['bentuks'] = $bentukspendidikan;
        $data['kode'] = $kodewilayah;
        $data['level'] = 2;
        // $data['namakota'] = "Tangerang Selatan";

        // echo "CEK000:".$getsekolah->total_sekolah;
        // die();
        
        if ($opsi!=null)
        echo view('profil_layout2_bentuk', $data);
        else
        echo view('profil_layout2_bentuk_2', $data);
    }

    public function getAuto()
    {		
		$request = service('request');
		$postData = $request->getPost();
  
		$response = array();
        $response['token'] = csrf_hash();

		$data = array();
  
		if(isset($postData['search']))
		{
		   	$search = $postData['search'];
			$wer = "nama like '%".$search."%'";
			
			$query1 = "select top 10 nama, kode_wilayah from 
			Referensi.ref.mst_wilayah where id_level_wilayah=2 AND mst_kode_wilayah<>350000  AND ".$wer; 

			$query = $this->db->query($query1);
			$hasil = $query->getResult();
			$data = array();

			foreach ($hasil as $row){
				$data[] = array(
					"value" => $row->kode_wilayah,
					"label" => $row->nama
				);
			}
		}
  
		$response['data'] = $data;
  
		return $this->response->setJSON($response);
  
    }

    public function tesfixed()
    {
        echo view('v_fixed');
    }

    public function grabdata($kodewilayah,$jenjang=null,$entitas=null)
    {
        // $kodewilayah = '286300';
        // $entitas = "siswa";

        $jendral = $_GET['total'];
        
        if ($entitas=="sekolah" || $entitas==null)
        {
            $bawal=1;
            $bakhir=5;
        }
        else if ($entitas=="siswa")
        {
            $bawal=6;
            $bakhir=11;
        }
        else if ($entitas=="pendidik")
        {
            $bawal=12;
            $bakhir=17;
        }

        $datanya = array();
        $datanya['jumlahdata'] = ($bakhir - $bawal)+1;

        $stokjudul = [];
        $judul = [];
        $adaresidu = [];

        $urutan=1;
        $stokjudul[$urutan] = 'Akreditasi';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "AKREDITASI";
        $judultabel[$urutan][1][1] = "Status";
        $judultabel[$urutan][1][2] = 'A';
        $judultabel[$urutan][1][3] = 'B';
        $judultabel[$urutan][1][4] = 'C';
        $judultabel[$urutan][1][5] = 'Terakreditasi';
        $judultabel[$urutan][1][6] = 'Belum Terakreditasi';
        $judultabel[$urutan][1][7] = 'Tidak Terakreditasi';
        $judultabel[$urutan][1][8] = 'Sertifikat Kadaluarsa';
        // $judultabel[$urutan][1][9] = 'Residu';
        $fields[$urutan][1] = array ('akreditasi_a','akreditasi_b','akreditasi_c','akreditasi_tidak_terakreditasi','akreditasi_belum_terakreditasi','akreditasi_terakreditasi','akreditasi_sertifikat_kadaluarsa');
        
        $urutan=2;
        $stokjudul[$urutan] = 'Ruang Kelas dan Lab';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "KONDISI RUANG KELAS";
        $judultabel[$urutan][1][1] = "Kondisi";
        $judultabel[$urutan][1][2] = "Baik";
        $judultabel[$urutan][1][3] = "Rusak Ringan";
        $judultabel[$urutan][1][4] = "Rusak Sedang";
        $judultabel[$urutan][1][5] = "Rusak Berat";
        $fields[$urutan][1] = array ('ruang_kelas_baik','ruang_kelas_rusak_ringan','ruang_kelas_rusak_sedang','ruang_kelas_rusak_berat');

        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][0] = "KONDISI LAB IPA";
        $judultabel[$urutan][2][1] = "Kondisi";
        $judultabel[$urutan][2][2] = "Baik";
        $judultabel[$urutan][2][3] = "Rusak Ringan";
        $judultabel[$urutan][2][4] = "Rusak Sedang";
        $judultabel[$urutan][2][5] = "Rusak Berat";
        $fields[$urutan][2] = array ('laboratorium_ipa_baik','laboratorium_ipa_rusak_ringan','laboratorium_ipa_rusak_sedang','laboratorium_ipa_rusak_berat');

        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][0] = "KONDISI LAB KIMIA";
        $judultabel[$urutan][3][1] = "Kondisi";
        $judultabel[$urutan][3][2] = "Baik";
        $judultabel[$urutan][3][3] = "Rusak Ringan";
        $judultabel[$urutan][3][4] = "Rusak Sedang";
        $judultabel[$urutan][3][5] = "Rusak Berat";
        $fields[$urutan][3] = array ('laboratorium_kimia_baik','laboratorium_kimia_rusak_ringan','laboratorium_kimia_rusak_sedang','laboratorium_kimia_rusak_berat');

        $adaresidu[$urutan][4] = "no";
        $judultabel[$urutan][4][0] = "KONDISI LAB FISIKA";
        $judultabel[$urutan][4][1] = "Kondisi";
        $judultabel[$urutan][4][2] = "Baik";
        $judultabel[$urutan][4][3] = "Rusak Ringan";
        $judultabel[$urutan][4][4] = "Rusak Sedang";
        $judultabel[$urutan][4][5] = "Rusak Berat";
        $fields[$urutan][4] = array ('laboratorium_fisika_baik','laboratorium_fisika_rusak_ringan','laboratorium_fisika_rusak_sedang','laboratorium_fisika_rusak_berat');

        $adaresidu[$urutan][5] = "no";
        $judultabel[$urutan][5][0] = "KONDISI LAB BIOLOGI";
        $judultabel[$urutan][5][1] = "Kondisi";
        $judultabel[$urutan][5][2] = "Baik";
        $judultabel[$urutan][5][3] = "Rusak Ringan";
        $judultabel[$urutan][5][4] = "Rusak Sedang";
        $judultabel[$urutan][5][5] = "Rusak Berat";
        $fields[$urutan][5] = array ('laboratorium_biologi_baik','laboratorium_biologi_rusak_ringan','laboratorium_biologi_rusak_sedang','laboratorium_biologi_rusak_berat');

        $adaresidu[$urutan][6] = "no";
        $judultabel[$urutan][6][0] = "KONDISI LAB BAHASA";
        $judultabel[$urutan][6][1] = "Kondisi";
        $judultabel[$urutan][6][2] = "Baik";
        $judultabel[$urutan][6][3] = "Rusak Ringan";
        $judultabel[$urutan][6][4] = "Rusak Sedang";
        $judultabel[$urutan][6][5] = "Rusak Berat";
        $fields[$urutan][6] = array ('laboratorium_bahasa_baik','laboratorium_bahasa_rusak_ringan','laboratorium_bahasa_rusak_sedang','laboratorium_bahasa_rusak_berat');

        $adaresidu[$urutan][7] = "no";
        $judultabel[$urutan][7][0] = "KONDISI LAB IPS";
        $judultabel[$urutan][7][1] = "Kondisi";
        $judultabel[$urutan][7][2] = "Baik";
        $judultabel[$urutan][7][3] = "Rusak Ringan";
        $judultabel[$urutan][7][4] = "Rusak Sedang";
        $judultabel[$urutan][7][5] = "Rusak Berat";
        $fields[$urutan][7] = array ('laboratorium_ips_baik','laboratorium_ips_rusak_ringan','laboratorium_ips_rusak_sedang','laboratorium_ips_rusak_berat');

        $adaresidu[$urutan][8] = "no";
        $judultabel[$urutan][8][0] = "KONDISI LAB KOMPUTER";
        $judultabel[$urutan][8][1] = "Kondisi";
        $judultabel[$urutan][8][2] = "Baik";
        $judultabel[$urutan][8][3] = "Rusak Ringan";
        $judultabel[$urutan][8][4] = "Rusak Sedang";
        $judultabel[$urutan][8][5] = "Rusak Berat";
        $fields[$urutan][8] = array ('laboratorium_komputer_baik','laboratorium_komputer_rusak_ringan','laboratorium_komputer_rusak_sedang','laboratorium_komputer_rusak_berat');

        $adaresidu[$urutan][9] = "no";
        $judultabel[$urutan][9][0] = "KONDISI RUANG PERPUSTAKAAN";
        $judultabel[$urutan][9][1] = "Kondisi";
        $judultabel[$urutan][9][2] = "Baik";
        $judultabel[$urutan][9][3] = "Rusak Ringan";
        $judultabel[$urutan][9][4] = "Rusak Sedang";
        $judultabel[$urutan][9][5] = "Rusak Berat";
        $fields[$urutan][9] = array ('ruang_perpustakaan_baik','ruang_perpustakaan_rusak_ringan','ruang_perpustakaan_rusak_sedang','ruang_perpustakaan_rusak_berat');

        $adaresidu[$urutan][10] = "no";
        $judultabel[$urutan][10][0] = "KONDISI RUANG UKS";
        $judultabel[$urutan][10][1] = "Kondisi";
        $judultabel[$urutan][10][2] = "Baik";
        $judultabel[$urutan][10][3] = "Rusak Ringan";
        $judultabel[$urutan][10][4] = "Rusak Sedang";
        $judultabel[$urutan][10][5] = "Rusak Berat";
        $fields[$urutan][10] = array ('ruang_uks_baik','ruang_uks_rusak_ringan','ruang_uks_rusak_sedang','ruang_uks_rusak_berat');

        $urutan=3;
        $stokjudul[$urutan] = 'Sarana dan Prasarana';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "SUMBER LISTRIK";
        $judultabel[$urutan][1][1] = "Status";
        $judultabel[$urutan][1][2] = "Ada";
        $judultabel[$urutan][1][3] = "Tidak Ada";
        $judultabel[$urutan][1][4] = "Residu";
        $fields[$urutan][1] = array ('sumber_listrik_ada','sumber_listrik_tidak_ada','sumber_listrik_residu');

        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][0] = "AKSES INTERNET";
        $judultabel[$urutan][2][1] = "Status";
        $judultabel[$urutan][2][2] = "Ada";
        $judultabel[$urutan][2][3] = "Tidak Ada";
        $judultabel[$urutan][2][4] = "Residu";
        $fields[$urutan][2] = array ('akses_internet_ada','akses_internet_tidak_ada','akses_internet_residu');

        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][0] = "SUMBER AIR";
        $judultabel[$urutan][3][1] = "Sumber";
        $judultabel[$urutan][3][2] = "Kemasan";
        $judultabel[$urutan][3][3] = "PAM";
        $judultabel[$urutan][3][4] = "Pompa";
        $judultabel[$urutan][3][5] = "Hujan";
        $judultabel[$urutan][3][6] = "Sumur Terlindungi";
        $judultabel[$urutan][3][7] = "Mata Air Terlindungi";
        $judultabel[$urutan][3][8] = "Sungai";
        $judultabel[$urutan][3][9] = "Lainnya";
        $judultabel[$urutan][3][10] = "Residu";
        $fields[$urutan][3] = array ('sumber_air_kemasan','sumber_air_PAM','sumber_air_pompa','sumber_air_hujan','sumber_air_sumur_terlindungi','sumber_air_mata_air_terlindungi','sumber_air_sungai','sumber_air_lainnya','sumber_air_residu');

        $adaresidu[$urutan][4] = "no";
        $judultabel[$urutan][4][0] = "KECUKUPAN AIR";
        $judultabel[$urutan][4][1] = "Kondisi";
        $judultabel[$urutan][4][2] = "Cukup Sepanjang Waktu";
        $judultabel[$urutan][4][3] = "Tidak Cukup Sepanjang Waktu";
        $judultabel[$urutan][4][4] = "Belum Mengisi Data";
        $judultabel[$urutan][4][5] = "Residu";
        $fields[$urutan][4] = array ('kecukupan_air_cukup_sepanjang_waktu','kecukupan_air_tidak_cukup_sepanjang_waktu','kecukupan_air_blm_mengisi','kecukupan_air_residu');

        $adaresidu[$urutan][5] = "no";
        $judultabel[$urutan][5][0] = "KONDISI WC GURU";
        $judultabel[$urutan][5][1] = "Kondisi";
        $judultabel[$urutan][5][2] = "Baik";
        $judultabel[$urutan][5][3] = "Rusak Ringan";
        $judultabel[$urutan][5][4] = "Rusak Sedang";
        $judultabel[$urutan][5][5] = "Rusak Berat";
        $fields[$urutan][5] = array ('wc_guru_baik','wc_guru_rusak_ringan','wc_guru_rusak_sedang','wc_guru_rusak_berat');

        $adaresidu[$urutan][6] = "no";
        $judultabel[$urutan][6][0] = "KONDISI WC SISWA";
        $judultabel[$urutan][6][1] = "Kondisi";
        $judultabel[$urutan][6][2] = "Baik";
        $judultabel[$urutan][6][3] = "Rusak Ringan";
        $judultabel[$urutan][6][4] = "Rusak Sedang";
        $judultabel[$urutan][6][5] = "Rusak Berat";
        $fields[$urutan][6] = array ('wc_siswa_baik','wc_siswa_rusak_ringan','wc_siswa_rusak_sedang','wc_siswa_rusak_berat');

        $urutan=4;
        $stokjudul[$urutan] = 'Waktu Penyelenggaraan';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "PENYELENGGARAAN";
        $judultabel[$urutan][1][1] = "Waktu";
        $judultabel[$urutan][1][2] = "Pagi 6 hari";
        $judultabel[$urutan][1][3] = "Siang 6 hari";
        $judultabel[$urutan][1][4] = "Doubleshift 6 hari";
        $judultabel[$urutan][1][5] = "Sore 6 hari";
        $judultabel[$urutan][1][6] = "Malam 6 hari";
        $judultabel[$urutan][1][7] = "Sehari penuh 5 hari";
        $judultabel[$urutan][1][8] = "Sehari penuh 6 hari";
        $judultabel[$urutan][1][9] = "Sehari penuh 3 hari";
        $judultabel[$urutan][1][10] = "Residu";
        $fields[$urutan][1] = array ('waktu_penyelenggaraan_pagi_6_hari','waktu_penyelenggaraan_siang_6_hari','waktu_penyelenggaraan_double_shift_6_hari','waktu_penyelenggaraan_sore_6_hari','waktu_penyelenggaraan_malam_6_hari','waktu_penyelenggaraan_sehari_penuh_5_hari','waktu_penyelenggaraan_sehari_penuh_6_hari','waktu_penyelenggaraan_sehari_penuh_3_hari','waktu_penyelenggaraan_residu');

        $urutan=5;
        $stokjudul[$urutan] = 'Status';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "STATUS SEKOLAH";
        $judultabel[$urutan][1][1] = "Status";
        $judultabel[$urutan][1][2] = "Negeri";
        $judultabel[$urutan][1][3] = "Swasta";
        $fields[$urutan][1] = array ('sekolah_negeri','sekolah_swasta');

        $urutan=6;
        $stokjudul[$urutan] = 'Jenis Kelamin';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "JENIS KELAMIN";
        $judultabel[$urutan][1][1] = "Jenis";
        $judultabel[$urutan][1][2] = "Laki-laki";
        $judultabel[$urutan][1][3] = "Perempuan";
        $fields[$urutan][1] = array ('jenis_kelamin_laki_laki','jenis_kelamin_perempuan');

        $urutan=7;
        $stokjudul[$urutan] = 'Agama';
        $adaresidu[$urutan][1] = "yes";
        $judultabel[$urutan][1][0] = "AGAMA";
        $judultabel[$urutan][1][1] = "Agama";
        $judultabel[$urutan][1][2] = "Islam";
        $judultabel[$urutan][1][3] = "Kristen";
        $judultabel[$urutan][1][4] = "Katholik";
        $judultabel[$urutan][1][5] = "Hindu";
        $judultabel[$urutan][1][6] = "Budha";
        $judultabel[$urutan][1][7] = "Khonghucu";
        $judultabel[$urutan][1][8] = "Kepercayaan";
        $judultabel[$urutan][1][9] = "Lainnya";
        $fields[$urutan][1] = array ('islam','kristen','katholik','hindu','budha','khonghucu','kepercayaan','lainnya');
        
        $urutan=8;
        $stokjudul[$urutan] = 'Usia';
        $adaresidu[$urutan][1] = "yes";
        $judultabel[$urutan][1][0] = "USIA";
        $judultabel[$urutan][1][1] = "Rentang Usia";
        $judultabel[$urutan][1][2] = "< 4 tahun";
        $judultabel[$urutan][1][3] = "4 - 6 tahun";
        $judultabel[$urutan][1][4] = "7 - 12 tahun";	
        $judultabel[$urutan][1][5] = "13 - 15 tahun";	
        $judultabel[$urutan][1][6] = "16 - 18 tahun";	
        $judultabel[$urutan][1][7] = "> 18 tahun";
        $fields[$urutan][1] = array ('usia_siswa_kurang_4','usia_siswa_4_6','usia_siswa_7_12','usia_siswa_13_15','usia_siswa_16_18','usia_siswa_lebih_18');

        $urutan=9;
        $stokjudul[$urutan] = 'Status';
        $adaresidu[$urutan][1] = "yes";
        $judultabel[$urutan][1][0] = "STATUS";
        $judultabel[$urutan][1][1] = "Status";
        $judultabel[$urutan][1][2] = "Negeri";
        $judultabel[$urutan][1][3] = "Swasta";
        $fields[$urutan][1] = array ('siswa_negeri','siswa_swasta');
        
        $urutan=10;
        $stokjudul[$urutan] = 'Tingkat Pendidikan';
        $adaresidu[$urutan][1] = "yes";
        $judultabel[$urutan][1][0] = "Tingkat Pendidikan";
        $judultabel[$urutan][1][1] = "Tingkat";
        $judultabel[$urutan][1][2] = "Kelompok A";
        $judultabel[$urutan][1][3] = "Kelompok B";
        $judultabel[$urutan][1][4] = "Tingkat KB";
        $judultabel[$urutan][1][5] = "Tingkat TPA";
        $judultabel[$urutan][1][6] = "Tingkat SPS";
        $judultabel[$urutan][1][7] = "Tingkat 1";
        $judultabel[$urutan][1][8] = "Tingkat 2";
        $judultabel[$urutan][1][9] = "Tingkat 3";
        $judultabel[$urutan][1][10] = "Tingkat 4";
        $judultabel[$urutan][1][11] = "Tingkat 5";
        $judultabel[$urutan][1][12] = "Tingkat 6";
        $judultabel[$urutan][1][13] = "Tingkat 7";
        $judultabel[$urutan][1][14] = "Tingkat 8";
        $judultabel[$urutan][1][15] = "Tingkat 9";
        $judultabel[$urutan][1][16] = "Tingkat 10";
        $judultabel[$urutan][1][17] = "Tingkat 11";
        $judultabel[$urutan][1][18] = "Tingkat 12";
        $judultabel[$urutan][1][19] = "Tingkat 13";
        $fields[$urutan][1] = array ('tingkat_kelompok_a','tingkat_kelompok_b','tingkat_kb','tingkat_tpa','tingkat_sps','tingkat_1','tingkat_2','tingkat_3','tingkat_4','tingkat_5','tingkat_6','tingkat_7','tingkat_8','tingkat_9','tingkat_10','tingkat_11','tingkat_12','tingkat_13');

        $urutan=11;
        $stokjudul[$urutan] = 'Jenis Ketunaan';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "Jenis Ketunaan";
        $judultabel[$urutan][1][1] = "Ketunaan";
        $judultabel[$urutan][1][2] = "Tunanetra";
        $judultabel[$urutan][1][3] = "Tunarungu";
        $judultabel[$urutan][1][4] = "Tunagrahita";
        $judultabel[$urutan][1][5] = "Tunadaksa";
        $judultabel[$urutan][1][6] = "Autis";
        $judultabel[$urutan][1][7] = "Tunaganda";
        $fields[$urutan][1] = array ('tunanetra','tunarungu','tunagrahita','tunadaksa','autis','tunaganda');

        $urutan=12;
        $stokjudul[$urutan] = 'Jenis Kelamin';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "JENIS KELAMIN PENDIDIK";
        $judultabel[$urutan][1][1] = "Jenis";
        $judultabel[$urutan][1][2] = "Laki-laki";
        $judultabel[$urutan][1][3] = "Perempuan";
        $fields[$urutan][1] = array ('jenis_kelamin_laki_laki','jenis_kelamin_perempuan');
        $judultabel[$urutan][2][0] = "JENIS KELAMIN TENAGA PENDIDIK";
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][1] = "Jenis";
        $judultabel[$urutan][2][2] = "Laki-laki";
        $judultabel[$urutan][2][3] = "Perempuan";
        $fields[$urutan][2] = array ('jenis_kelamin_laki_laki','jenis_kelamin_perempuan');
        $judultabel[$urutan][3][0] = "JENIS KELAMIN KEPALA SEKOLAH";
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][1] = "Jenis";
        $judultabel[$urutan][3][2] = "Laki-laki";
        $judultabel[$urutan][3][3] = "Perempuan";
        $fields[$urutan][3] = array ('jenis_kelamin_laki_laki','jenis_kelamin_perempuan');

        $urutan=13;
        $stokjudul[$urutan] = 'Usia';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "USIA GURU";
        $judultabel[$urutan][1][1] = "Rentang Usia";
        $judultabel[$urutan][1][2] = "< 31 tahun";
        $judultabel[$urutan][1][3] = "31 - 35 tahun";
        $judultabel[$urutan][1][4] = "36 - 40 tahun";	
        $judultabel[$urutan][1][5] = "41 - 45 tahun";	
        $judultabel[$urutan][1][6] = "46 - 50 tahun";	
        $judultabel[$urutan][1][7] = "51 - 55 tahun";	
        $judultabel[$urutan][1][8] = "> 55 tahun";
        $fields[$urutan][1] = array ('usia_guru_kurang_31','usia_guru_31_35','usia_guru_36_40','usia_guru_41_45','usia_guru_46_50','usia_guru_51_55','usia_guru_lebih_55');

        $judultabel[$urutan][2][0] = "USIA TENAGA PENDIDIK";
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][1] = "Rentang Usia";
        $judultabel[$urutan][2][2] = "< 31 tahun";
        $judultabel[$urutan][2][3] = "31 - 35 tahun";
        $judultabel[$urutan][2][4] = "36 - 40 tahun";	
        $judultabel[$urutan][2][5] = "41 - 45 tahun";	
        $judultabel[$urutan][2][6] = "46 - 50 tahun";	
        $judultabel[$urutan][2][7] = "51 - 55 tahun";	
        $judultabel[$urutan][2][8] = "> 55 tahun";
        $fields[$urutan][2] = array ('usia_tendik_kurang_31','usia_tendik_31_35','usia_tendik_36_40','usia_tendik_41_45','usia_tendik_46_50','usia_tendik_51_55','usia_tendik_lebih_55');

        $judultabel[$urutan][3][0] = "USIA KEPALA SEKOLAH";
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][1] = "Rentang Usia";
        $judultabel[$urutan][3][2] = "< 31 tahun";
        $judultabel[$urutan][3][3] = "31 - 35 tahun";
        $judultabel[$urutan][3][4] = "36 - 40 tahun";	
        $judultabel[$urutan][3][5] = "41 - 45 tahun";	
        $judultabel[$urutan][3][6] = "46 - 50 tahun";	
        $judultabel[$urutan][3][7] = "51 - 55 tahun";	
        $judultabel[$urutan][3][8] = "> 55 tahun";
        $fields[$urutan][3] = array ('usia_kepsek_kurang_31','usia_kepsek_31_35','usia_kepsek_36_40','usia_kepsek_41_45','usia_kepsek_46_50','usia_kepsek_51_55','usia_kepsek_lebih_55');

        $urutan=14;
        $stokjudul[$urutan] = 'Status';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "STATUS GURU";
        $judultabel[$urutan][1][1] = "Status";
        $judultabel[$urutan][1][2] = "PNS";
        $judultabel[$urutan][1][3] = "Yayasan";
        $judultabel[$urutan][1][4] = "Honorer Daerah";
        $judultabel[$urutan][1][5] = "Bantu";
        $judultabel[$urutan][1][6] = "Tidak Tetap";
        $fields[$urutan][1] = array ('guru_PNS','guru_yayasan','guru_honor_daerah','guru_bantu','guru_tidak_tetap');
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][0] = "STATUS TENAGA PENDIDIK";
        $judultabel[$urutan][2][1] = "Status";
        $judultabel[$urutan][2][2] = "PNS";
        $judultabel[$urutan][2][3] = "Yayasan";
        $judultabel[$urutan][2][4] = "Honorer Daerah";
        $judultabel[$urutan][2][5] = "Bantu";
        $judultabel[$urutan][2][6] = "Tidak Tetap";
        $fields[$urutan][2] = array ('tendik_PNS','tendik_yayasan','tendik_honor_daerah','tendik_bantu','tendik_tidak_tetap');
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][0] = "STATUS KEPALA SEKOLAH";
        $judultabel[$urutan][3][1] = "Status";
        $judultabel[$urutan][3][2] = "PNS";
        $judultabel[$urutan][3][3] = "Yayasan";
        $judultabel[$urutan][3][4] = "Honorer Daerah";
        $judultabel[$urutan][3][5] = "Bantu";
        $judultabel[$urutan][3][6] = "Tidak Tetap";
        $fields[$urutan][3] = array ('kepsek_PNS','kepsek_yayasan','kepsek_honor_daerah','kepsek_bantu','kepsek_tidak_tetap');

        $urutan=15;
        $stokjudul[$urutan] = 'Golongan';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "GOLONGAN GURU";
        $judultabel[$urutan][1][1] = "Golongan";
        $judultabel[$urutan][1][2] = "Gol. 1";
        $judultabel[$urutan][1][3] = "Gol. 2";
        $judultabel[$urutan][1][4] = "Gol. 3";
        $fields[$urutan][1] = array ('gol_1','gol_2','gol_3','gol_4');
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][0] = "GOLONGAN TENAGA PENDIDIK";
        $judultabel[$urutan][2][1] = "Golongan";
        $judultabel[$urutan][2][2] = "Gol. 1";
        $judultabel[$urutan][2][3] = "Gol. 2";
        $judultabel[$urutan][2][4] = "Gol. 3";
        $fields[$urutan][2] = array ('gol_1','gol_2','gol_3','gol_4');
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][0] = "GOLONGAN KEPALA SEKOLAH";
        $judultabel[$urutan][3][1] = "Golongan";
        $judultabel[$urutan][3][2] = "Gol. 1";
        $judultabel[$urutan][3][3] = "Gol. 2";
        $judultabel[$urutan][3][4] = "Gol. 3";
        $fields[$urutan][3] = array ('gol_1','gol_2','gol_3','gol_4');

        $urutan=16;
        $stokjudul[$urutan] = 'Ijazah dan Sertifikat';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "IJAZAH GURU";
        $judultabel[$urutan][1][1] = "Ijazah";
        $judultabel[$urutan][1][2] = "Ijazah kurang dari S1";
        $judultabel[$urutan][1][3] = "Ijazah S1 ke atas";
        $judultabel[$urutan][1][2] = "Sudah Sertifikasi";
        $judultabel[$urutan][1][3] = "Belum Sertifikasi";
        $fields[$urutan][1] = array ('ijazah_kurang_dari_s1','ijazah_lebih_dari_s1','sudah_sertifikasi','belum_sertifikasi');
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][0] = "IJAZAH TENAGA PENDIDIK";
        $judultabel[$urutan][2][1] = "Ijazah";
        $judultabel[$urutan][2][2] = "Ijazah kurang dari S1";
        $judultabel[$urutan][2][3] = "Ijazah S1 ke atas";
        $judultabel[$urutan][2][2] = "Sudah Sertifikasi";
        $judultabel[$urutan][2][3] = "Belum Sertifikasi";
        $fields[$urutan][2] = array ('ijazah_kurang_dari_s1','ijazah_lebih_dari_s1','sudah_sertifikasi','belum_sertifikasi');
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][0] = "IJAZAH KEPALA SEKOLAH";
        $judultabel[$urutan][3][1] = "Ijazah";
        $judultabel[$urutan][3][2] = "Ijazah kurang dari S1";
        $judultabel[$urutan][3][3] = "Ijazah S1 ke atas";
        $judultabel[$urutan][3][2] = "Sudah Sertifikasi";
        $judultabel[$urutan][3][3] = "Belum Sertifikasi";
        $fields[$urutan][3] = array ('ijazah_kurang_dari_s1','ijazah_lebih_dari_s1','sudah_sertifikasi','belum_sertifikasi');

        $urutan=17;
        $stokjudul[$urutan] = 'Masa Kerja';
        $adaresidu[$urutan][1] = "no";
        $judultabel[$urutan][1][0] = "MASA KERJA GURU";
        $judultabel[$urutan][1][1] = "Masa Kerja";
        $judultabel[$urutan][1][2] = "< 5 tahun";
        $judultabel[$urutan][1][3] = "5 - 9 tahun";
        $judultabel[$urutan][1][4] = "10 - 14 tahun";
        $judultabel[$urutan][1][5] = "15 - 19 tahun";
        $judultabel[$urutan][1][6] = "20 - 24 tahun";
        $judultabel[$urutan][1][7] = "> 24 tahun";
        $fields[$urutan][1] = array ('Guru_mk_kurang_5','Guru_mk_5_9','Guru_mk_10_14','Guru_mk_15_19','Guru_mk_20_24','Guru_mk_lebih_24');
        $judultabel[$urutan][2][0] = "MASA KERJA TENAGA PENDIDIK";
        $adaresidu[$urutan][2] = "no";
        $judultabel[$urutan][2][1] = "Masa Kerja";
        $judultabel[$urutan][2][2] = "< 5 tahun";
        $judultabel[$urutan][2][3] = "5 - 9 tahun";
        $judultabel[$urutan][2][4] = "10 - 14 tahun";
        $judultabel[$urutan][2][5] = "15 - 19 tahun";
        $judultabel[$urutan][2][6] = "20 - 24 tahun";
        $judultabel[$urutan][2][7] = "> 24 tahun";
        $fields[$urutan][2] = array ('tendik_mk_kurang_5','tendik_mk_5_9','tendik_mk_10_14','tendik_mk_15_19','tendik_mk_20_24','tendik_mk_lebih_24');
        $judultabel[$urutan][3][0] = "MASA KERJA KEPALA SEKOLAH";
        $adaresidu[$urutan][3] = "no";
        $judultabel[$urutan][3][1] = "Masa Kerja";
        $judultabel[$urutan][3][2] = "< 5 tahun";
        $judultabel[$urutan][3][3] = "5 - 9 tahun";
        $judultabel[$urutan][3][4] = "10 - 14 tahun";
        $judultabel[$urutan][3][5] = "15 - 19 tahun";
        $judultabel[$urutan][3][6] = "20 - 24 tahun";
        $judultabel[$urutan][3][7] = "> 24 tahun";
        $fields[$urutan][3] = array ('kepsek_mk_kurang_5','kepsek_mk_5_9','kepsek_mk_10_14','kepsek_mk_15_19','kepsek_mk_20_24','kepsek_mk_lebih_24');
  
        $paud = array('TK','KB','TPA','SPS','RA','Taman Seminari','SPK KB','PAUDQ','SPK PG','SPK TK','Pratama W P','Nava Dhammasekha');
        $dikdas = array('SD','SMP','MI','MTs','SMPTK','SDTK','SPK SD','SPK SMP','Adi W P','Madyama W P','Mula Dhammasekha','Muda Dhammasekha');
        $dikmen = array('SMA','SMK','MA','MAK','SLB','SMTK','SMAg.K','SMAK','SPK SMA','Utama W P','Uttama Dhammasekha','Uttama Dhammasekha Kejuruan');
        $dikti = array('Akademik','Politeknik','Sekolah Tinggi','Institut','Universitas');
        $dikmas = array('Kursus','TBM','PKBM','SKB','Pondok Pesantren');

        $dafjenjang = array('PAUD','DIKDAS','DIKMEN','DIKTI','DIKMAS');

        $m=0;
        for ($a=$bawal;$a<=$bakhir;$a++)
        {
            $m++;
            $judul [$m] = $stokjudul[$a];
        }

        if ($jenjang==null || $jenjang==0)
        {
            $bentuks = "semua";
        }
        else if ($jenjang==1)
        {
            $bentuks = $paud;
        }
        else if ($jenjang==2)
        {
            $bentuks = $dikdas;
        }
        else if ($jenjang==3)
        {
            $bentuks = $dikmen;
        }
        else if ($jenjang==4)
        {
            $bentuks = $dikti;
        }
        else if ($jenjang==5)
        {
            $bentuks = $dikmas;
        }

        $stringnav = "";

        $jendraljenjang = $jendral;

        if ($bentuks!="semua")
        {
            $gettotaljenjang = $this->datamodeljendela->gettotaljenjang($bentuks,$kodewilayah);
            $gettotaljenjang = $gettotaljenjang->getRow();
            $totalsekolah = $gettotaljenjang->totalsekolah;
            $jendraljenjang = $totalsekolah;
        }

        ////////////////////////////////////////////////////
        $m=0;
        for ($a=$bawal;$a<=$bakhir;$a++)
        {
            $m++;
            $aktif = "";
            if ($a==$bawal)
                $aktif = " active";
            
            $stringnav = $stringnav . "<a class=\"nav-item nav-link ". $aktif."\" " .
            "id=\"nav".$m."-tab\" " .
            "data-toggle=\"tab\" href=\"#nav".$m."\" " .
            "role=\"tab\" " .
            "aria-controls=\"nav".$m."\" " .
            "aria-selected=\"true\">".$judul[$m]."</a>";
        }
        ////////////////////////////////////////////////////

        $stringkonten = "";
        
        $baristabel = "";
        $b=$bawal-1;
        $nn=0;
        $idtabel = 0;
        
        ////////////////////////////////////////////////////
        foreach ($judul as $row)
        {
            $tabeltabel = "";
            $bentukbentuk = "";
            $b++;
            $nn++;
            $aktif = "";
            if ($b==$bawal)
                $aktif = "show active";

            $totalakreditasi_a=0;
            $nilai = 0;
            $kolom=array();
    
            if (is_array($bentuks))
            foreach ($bentuks as $bentuk)
            {
                if ($bentuk=="Akademik")
                $bentuk = "Akademi";
                $bentukbentuk = $bentukbentuk. "<td style=\"text-align:right;\" width=\"100px\"><b>".$bentuk."</b></td>";
            };

           
            /////////////// hitung per tabel ///////////////////////
            for ($b2=1;$b2<=sizeof($fields[$b]);$b2++)
            {
                $idtabel++;

                if ($entitas=="pendidik" && $b2==2)
                    $entitas="tendik";
                if ($entitas=="pendidik" && $b2==3)
                    $entitas="kepsek";
                if ($entitas=="tendik" && $b2==1)
                    $entitas="pendidik";
                if ($entitas=="tendik" && $b2==3)
                    $entitas="kepsek";
                if ($entitas=="kepsek" && $b2==1)
                    $entitas="pendidik";
                if ($entitas=="kepsek" && $b2==2)
                    $entitas="tendik";

                if ($bentuks=="semua")
                {
                    $getsekolahbentuk = $this->datamodeljendela->getTotalSekolahBentukAll($kodewilayah,$paud,$dikdas,$dikmen,$dikti,$dikmas,$fields[$b][$b2],$entitas);
                }
                else
                {
                    $getsekolahbentuk = $this->datamodeljendela->getTotalSekolahBentuk($kodewilayah,$bentuks,$fields[$b][$b2],$entitas);
                }
                
                $totalbentukperbaris = [];
                $totalbarispaud = [];
                $totalbarisdikdas = [];
                $totalbarisdikmen = [];
                $totalbarisdikti = [];
                $totalbarisdikmas = [];

                $ce=1;
                $jmlkol=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
                $totaljendralall = 0;
                foreach ($fields[$b][$b2] as $field)
                {
                    $ce++;
                    $totalbaris[$ce] = 0;
                    $totalbarispaud[$ce] = 0;
                    $totalbarisdikdas[$ce] = 0;
                    $totalbarisdikmen[$ce] = 0;
                    $totalbarisdikti[$ce] = 0;
                    $totalbarisdikmas[$ce] = 0;
                    $nilaibentukperbaris[$ce] = "";
                    $kol=0;
                    
                    if ($bentuks=="semua")
                    {
                        foreach ($dafjenjang as $jnjng)
                        {
                            $kol++;
                            $namakecil = strtolower($jnjng);
                            $jmlkol[$kol] = $jmlkol[$kol] + $getsekolahbentuk[$namakecil.'_'.$field];
                            $nilai = $nilai ."<td align='right'>".number_format($getsekolahbentuk[$namakecil.'_'.$field],0,',','.')."&nbsp;&nbsp;&nbsp;</td>";
                            $nilaibaris = intval($getsekolahbentuk[$namakecil.'_'.$field]);
                            $totalbaris[$ce]=$totalbaris[$ce]+$nilaibaris;
                            $nilaibentukperbaris[$ce] = $nilaibentukperbaris[$ce] . "<td align=\"right\">" .number_format($nilaibaris,0,',','.') . "&nbsp;&nbsp;&nbsp;</td>";
                        }
                    }
                    else
                    {
                        if (is_array($bentuks))
                        foreach ($bentuks as $bentuk)
                        {
                            $kol++;
                            $namakecil = strtolower($bentuk);
                            $namakecil = str_replace(" ","",$namakecil);
                            $namakecil = str_replace(".","",$namakecil);
                            $jmlkol[$kol] = $jmlkol[$kol] + $getsekolahbentuk[$namakecil.'_'.$field];
                            $nilai = $nilai ."<td align='right'>".number_format($getsekolahbentuk[$namakecil.'_'.$field],0,',','.')."&nbsp;&nbsp;&nbsp;</td>";
                            $nilaibaris = intval($getsekolahbentuk[$namakecil.'_'.$field]);
                            $totalbaris[$ce]=$totalbaris[$ce]+$nilaibaris;
                            $nilaibentukperbaris[$ce] = $nilaibentukperbaris[$ce] . "<td align=\"right\">" .number_format($nilaibaris,0,',','.') . "&nbsp;&nbsp;&nbsp;</td>";
        
                        }
                        else
                        {
                            $nilaibaris = intval($getsekolahbentuk['t_'.$field]);
                            $totalbaris[$ce]=$totalbaris[$ce]+$nilaibaris;
                            $totaljendralall = $totaljendralall + $nilaibaris;
                        }
                    }
                    
                    
                };
    
                ///////////////// hitung per kolom /////////////
                $kol=0;
                $totalperkolom = "";
                $totalperkolomresidu = "";
                $totsemuakolom = 0;
                if ($bentuks=="semua")
                {
                    foreach ($dafjenjang as $jnjng)
                    {
                        $kol++;
                        $totsemuakolom = $totsemuakolom + $jmlkol[$kol];
                        $totalperkolom = $totalperkolom . "<td align=\"right\">" . number_format($jmlkol[$kol] ,0,",","."). "&nbsp;&nbsp;&nbsp;</td>";
                        $totalperkolomresidu = $totalperkolomresidu . "<td align=\"right\">-&nbsp;&nbsp;&nbsp;</td>";
                    }
                   
                }
                else
                {
                    if (is_array($bentuks))
                    foreach ($bentuks as $bentuk)
                    {
                        $kol++;
                        $totsemuakolom = $totsemuakolom + $jmlkol[$kol];
                        $totalperkolom = $totalperkolom . "<td align=\"right\">" . number_format($jmlkol[$kol] ,0,",","."). "&nbsp;&nbsp;&nbsp;</td>";
                        $totalperkolomresidu = $totalperkolomresidu . "<td align=\"right\">-&nbsp;&nbsp;&nbsp;</td>";
                    }
                    else
                    {
                        $totsemuakolom = $totaljendralall;
                    }
                }

                $baristabel = "";
                for($c=2;$c<sizeof($judultabel[$b][$b2]);$c++)
                {
                    if ($judultabel[$b][$b2][$c]=="Residu")
                    $judultabel[$b][$b2][$c]="<b>Residu</b>";

                    if ($bentuks=="semua")
                        {
                            $baristabel = $baristabel.'<tr>
                                <td>
                                    '.$judultabel[$b][$b2][$c].'
                                </td>
                                <td align="right">'.number_format($totalbaris[$c],0,",",".").'&nbsp;&nbsp;&nbsp;</td>'.$nilaibentukperbaris[$c].'
                            </tr>';
                        }
                        else
                        {
                            $baristabel = $baristabel.'<tr>
                                <td>
                                    '.$judultabel[$b][$b2][$c].'
                                </td>
                                <td align="right">'.number_format($totalbaris[$c],0,",",".").'&nbsp;&nbsp;&nbsp;</td>'.$nilaibentukperbaris[$c].'
                            </tr>';
                        }
                }
                ////////////////    hitung jumlah   -----------------
                if ($adaresidu[$b][$b2]=="yes")
                {
                    $totaljendral = '<td align="right">'.number_format($jendraljenjang,0,",",".").'&nbsp;&nbsp;&nbsp;</td>';
                }
                else
                {
                    $totaljendral = '<td align="right">'.number_format($totsemuakolom,0,",",".").'&nbsp;&nbsp;&nbsp;</td>';
                }

                if ($jendraljenjang!=$totsemuakolom && $adaresidu[$b][$b2]=="yes")
                {
                    $residu = $jendraljenjang-$totsemuakolom;
                    $totalresidu = '<td align="right">'.number_format($residu,0,",",".").'&nbsp;&nbsp;&nbsp;</td>';
                    
                    $baristabel = $baristabel.'<tr>
                    <td>
                    <b>Residu</b>
                    </td>'.$totalresidu.$totalperkolomresidu.'</tr>';
                }

                $baristabel = $baristabel.'<tr>
                <td>
                    <b>Total</b>
                </td>'.$totaljendral.$totalperkolom.'</tr>';

                $namatabel="id=\"table".$idtabel."\"";

                if ($bentuks == "semua")
                {
                    // $namatabel="id=\"table1\"";
                    $tabeltabel = $tabeltabel .
                '<div style="border:0px solid gray;border-radius:10px;padding:5px;margin:5px;margin-top:10px;margin-bottom:10px;">
                <div><span style="margin-left:10px;padding-bottom: 2px;
                border-bottom: 0px solid gray;
                line-height: 48px;"><b> '.$judultabel[$b][$b2][0].'</b></span></div>
                <table style="width:100%" class="table table-striped" '.$namatabel.'>
                    <thead>
                        <tr>
                            <td><b>'.$judultabel[$b][$b2][1].'</b></td>
                            <td style="text-align:right;" align="right">
                                <b>Jumlah</b>
                            </td>
                            <td style="text-align:right;"><b>PAUD</b></td>
                            <td style="text-align:right;"><b>DIKDAS</b></td>
                            <td style="text-align:right;"><b>DIKMEN</b></td>
                            <td style="text-align:right;"><b>DIKTI</b></td>
                            <td style="text-align:right;"><b>DIKMAS</b></td>
                        </tr>
                    </thead>
                    <tbody>'.$baristabel.'</tbody>
                </table></div>';
            }
                else
                {
                    $tabeltabel = $tabeltabel .
                    '<div style="border:0px solid gray;border-radius:10px;padding:5px;margin:5px;margin-top:10px;margin-bottom:10px;">
                    <div><span style="margin-left:10px;padding-bottom: 2px;
                    border-bottom: 0px solid gray;
                    line-height: 48px;"><b> '.$judultabel[$b][$b2][0].'</b></span></div>
                    <table style="width:100%" class="table table-striped" '.$namatabel.'>
                        <thead>
                            <tr>
                                <td>
                                    <b>'.$judultabel[$b][$b2][1].'</b>
                                </td>
                                <td style="text-align:right;" align="right">
                                    <b>Jumlah</b>
                                </td>'.$bentukbentuk.'</tr>
                        </thead>
                        <tbody>'.$baristabel.'</tbody>
                    </table></div>';
                }
            }
          
            $stringkonten = $stringkonten.'<div class="tab-pane fade '.$aktif.' "
                id="nav'.$nn.'"
                role="tabpanel"
                aria-labelledby="nav'.$nn.'-tab">'.$tabeltabel.'
            </div>
            
            ';
        };

        ////////////////////////////////////////////////////

        $datanya['nav'] = $stringnav;
        $datanya['konten'] = $stringkonten;
        $datanya['jmltabel'] = $idtabel;

        // $dataku=[];
        // $dataku['nav'] = $stringnav;
        // $dataku['konten'] = $tesstring;
        // echo json_encode($dataku);

        // echo "<pre>";
        // echo $stringkonten;
        // echo "</pre>";

		echo json_encode($datanya);
    }

    public function tesgrab()
    {
        $paud = array('TK','KB','TPA','SPS','RA','Taman Seminari','SPK KB','PAUDQ','SPK PG','SPK TK','Pratama W P','Nava Dhammasekha');
        $bentuks=$paud;
        $gettotaljenjang = $this->datamodeljendela->gettotaljenjang($bentuks);
        $gettotaljenjang = $gettotaljenjang->getRow();
        $totalsekolah = $gettotaljenjang->totalsekolah;
        // $gettotaljenjang = $gettotaljenjang->getResult();
        // print_r($gettotaljenjang->getResult());
        //$jendraljenjang = $gettotaljenjang->totalsekolah;
    }

}
