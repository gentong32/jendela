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
        $this->profil('286300');
    }

    public function tes()
    {
        $getsekolah=$this->datamodeljendela->getSekolah('286300');
        print_r($getsekolah->getResult());
    }

    public function profil($kodewilayah=null)
    {
        if ($kodewilayah==null)
        $kodewilayah = $_GET['kode_wilayah'];

        $getkecamatan = $this->datamodeljendela->getKecamatan($kodewilayah);
        $getkelurahan = $this->datamodeljendela->getKelurahan($kodewilayah);
        $getkabkot = $this->datamodeljendela->getKabKot($kodewilayah)->getRow();
        $getsekolah = "0000";//$this->datamodeljendela->getSekolah($kodewilayah);
        $getguru = "00000";//$this->datamodeljendela->getGuru($kodewilayah);
        $getsiswa = "0000000";//$this->datamodeljendela->getGuru($kodewilayah);
        $getcagarbudaya = "0";//$this->datamodeljendela->getGuru($kodewilayah);
        $getmuseum = "0";//$this->datamodeljendela->getGuru($kodewilayah);
        $get_sekolah_akreditasi = $this->datamodeljendela->get_sekolah_akreditasi($kodewilayah);
        $get_sekolah_status = $this->datamodeljendela->get_sekolah_status($kodewilayah);

        $getkoordinat = $this->datamodeljendela->getkoordinatgeo($kodewilayah);

        $datakebupaten=[];
        $datakebupaten['nama'] = $getkabkot->nama;
        $datakebupaten['jumlah_kecamatan'] = sizeof($getkecamatan->getResult());
        $datakebupaten['jumlah_kelurahan'] = sizeof($getkelurahan->getResult());
        $datakebupaten['jumlah_sekolah'] = $getsekolah;//sizeof($getsekolah->getResult());
        $datakebupaten['jumlah_guru'] = $getguru;//sizeof($getguru->getResult());
        $datakebupaten['jumlah_siswa'] = $getsiswa;//sizeof($getsiswa->getResult());
        $datakebudayaan=[];
        $datakebudayaan['jumlah_cagarbudaya'] = $getcagarbudaya;//sizeof($getsiswa->getResult());
        $datakebudayaan['jumlah_museum'] = $getmuseum;//sizeof($getsiswa->getResult());
        
        
        //$data['lat1'] = $getdatalat1->getResult();
        $data['lintang'] = $getkoordinat['lintang'];
        $data['bujur'] = $getkoordinat['bujur'];
        $data['akreditasi'] = $get_sekolah_akreditasi;
        $data['status_sekolah'] = $get_sekolah_status;
        $data['datakabupaten'] = $datakebupaten;
        $data['datakebudayaan'] = $datakebudayaan;
        $data['kodewilayah'] = $kodewilayah;
        // $data['namakota'] = "Tangerang Selatan";
        
        echo view('profil', $data);
    }

    public function getAuto()
    {		
		// $request = service('request');
		// $postData = $request->getPost();
  
		$response = array();
        $response['token'] = csrf_hash();

		$data = array();
  
		// if(isset($postData['search']))
		{
		   	$search = 'semarang';//$postData['search'];
			$wer = "nama like '%".$search."%'";
			
			$query1 = "select top 10 nama, kode_wilayah from 
			Referensi.ref.mst_wilayah where ".$wer;

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

}
