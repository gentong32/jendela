<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModelJendela extends Model
{
    public function getKecamatan($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,6);

        $sql = "SELECT * FROM [Referensi].[ref].[mst_wilayah] 
                WHERE [mst_kode_wilayah]=:kodewilayah:";
        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function getKelurahan($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = "SELECT * FROM [Referensi].[ref].[mst_wilayah] 
                WHERE LEFT(kode_wilayah,4) = :kodewilayah: 
                AND id_level_wilayah=4";
        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function getKabKot($kodewilayah) {
        $sql = "SELECT * FROM [Referensi].[ref].[mst_wilayah] 
                WHERE kode_wilayah = :kodewilayah: ";
        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function getSekolah($kodewilayah) {
        // $this->db = \Config\Database::connect("dbnpsn");
        
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = "SELECT COUNT (sekolah_id) as jml_sekolah FROM Datamart.datamart.sekolah 
                WHERE soft_delete_sekolah = 0 AND LEFT(kode_wilayah,4) = :kodewilayah: ";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function getGuru($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = "SELECT * FROM Datamart.datamart.sekolah_ptk g
                LEFT JOIN Datamart.datamart.sekolah s ON g.sekolah_id=s.sekolah_id 
                WHERE soft_delete_sekolah = 0 AND LEFT(kode_wilayah,4) = :kodewilayah: ";
        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function get_sekolah_akreditasi($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = " SELECT SUM(CASE WHEN akreditasi='A' THEN 1 ELSE 0 END) total_a,
        SUM(CASE WHEN akreditasi='B' THEN 1 ELSE 0 END) total_b,
        SUM(CASE WHEN akreditasi='C' THEN 1 ELSE 0 END) total_c,
        SUM(CASE WHEN akreditasi='Terakreditasi' THEN 1 ELSE 0 END) total_ter,
        SUM(CASE WHEN akreditasi='Tidak Terakreditasi' THEN 1 ELSE 0 END) total_tidak,
        SUM(CASE WHEN akreditasi='Belum Terakreditasi' THEN 1 ELSE 0 END) total_belum,
        SUM(CASE WHEN akreditasi IS NULL THEN 1 ELSE 0 END) total_null
        FROM Datamart.datamart.sekolah g
        WHERE soft_delete_sekolah=0 AND LEFT(kode_wilayah,4) = :kodewilayah: ";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function get_sekolah_status($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = " SELECT SUM(CASE WHEN status_sekolah='NEGERI' THEN 1 ELSE 0 END) total_negeri,
        SUM(CASE WHEN status_sekolah='SWASTA' THEN 1 ELSE 0 END) total_swasta, 
        SUM(CASE WHEN status_sekolah='Aktif' THEN 1 ELSE 0 END) total_aktif 
        FROM Datamart.datamart.sekolah g
        WHERE soft_delete_sekolah=0 AND LEFT(kode_wilayah,4) = :kodewilayah: ";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function getAreaWilayah($kodewilayah) {
        $kodewilayah = substr($kodewilayah,0,4);

        $sql = "SELECT * FROM Dataprocess.dev.areamapkota 
                WHERE LEFT(kode_wilayah,4) = :kodewilayah: ";
        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query;
    }

    public function getkoordinatgeo($kodewilayah)
    {
        $baris = 0;
        $myFile = base_url()."/geojson/".$kodewilayah.".geojson";
        $hasil=[];

        if($line = @file_get_contents($myFile))
            $hasil['status'] = "Sukses";
        else
            $hasil['status'] = "Gagal menampilkan peta.";
        
        $line = str_replace("[ [ [","[",$line);
        $line = str_replace("[ [","[",$line);
        $line = str_replace("] ] ]","]",$line);
        $line = str_replace("] ]","]",$line);
        $line = str_replace(" ","",$line);
        $pos = strpos($line, 'coordinates')+13;
        $line2 = substr($line,$pos,-7);
        $batasakhir = strrpos($line2,"[");
        $mulai=0;
        $pos1=0;
        $barisvalue=0;

        $bujurkiri = 0;
        $bujurkanan = 0;
        $lintangatas = 0;
        $lintangbawah= 0;
        
        while ($pos1<$batasakhir)
        {
            $pos1=strpos($line2, "[", $mulai);
            $poskoma=strpos($line2, ",", $pos1);
            $pos2=strpos($line2, "]", $poskoma);
            $panjangkekoma=$poskoma-$pos1-1;
            $panjangkepos2=$pos2-$poskoma-1;
      
            $lintang=substr($line2,$pos1+1,$panjangkekoma);
            $bujur=substr($line2,$poskoma+1,$panjangkepos2);
            $mulai=$pos2;

            if ($bujurkiri==0)
            $bujurkiri = $bujur;
            if ($bujurkiri>$bujur)
            $bujurkiri = $bujur;
            if ($bujurkanan==0)
            $bujurkanan = $bujur;
            if ($bujurkanan<$bujur)
            $bujurkanan = $bujur;

            if ($lintangatas==0)
            $lintangatas = $lintang;
            if ($lintangatas>$lintang)
            $lintangatas = $lintang;
            if ($lintangbawah==0)
            $lintangbawah = $lintang;
            if ($lintangbawah<$lintang)
            $lintangbawah = $lintang;

        }

        $bujurtengah=($bujurkiri+$bujurkanan)/2;
        $lintangtengah=($lintangatas+$lintangbawah)/2;

        

        $hasil['bujur'] = $bujurtengah;
        $hasil['lintang'] = $lintangtengah;

        return $hasil;
    }
}