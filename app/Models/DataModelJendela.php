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

    public function getTotalSekolah($kodewilayah)
    {
        $sql = "SELECT sum(akreditasi_a) as t_akreditasi_a,
        sum(akreditasi_b) as t_akreditasi_b, 
        sum(akreditasi_c) as t_akreditasi_c, 
        sum(akreditasi_tidak_terakreditasi) as t_tidak_terakreditasi, 
        sum(akreditasi_belum_terakreditasi) as t_belum_terakreditasi, 
        sum(akreditasi_terakreditasi) as t_terakreditasi,
        sum (akreditasi_a+akreditasi_b+akreditasi_c+akreditasi_tidak_terakreditasi
        +akreditasi_belum_terakreditasi+akreditasi_terakreditasi) as total_sekolah,
        sum([ruang_kelas_baik]) as kelas_baik,
        sum([ruang_kelas_rusak_ringan]) as kelas_r_ringan,
        sum([ruang_kelas_rusak_sedang]) as kelas_r_sedang,
        sum([ruang_kelas_rusak_berat]) as kelas_r_berat,
        sum([ruang_kelas_baik]+[ruang_kelas_rusak_ringan]+[ruang_kelas_rusak_sedang]
        +[ruang_kelas_rusak_berat]) as total_ruang_kelas 
        from dataprocess.jendela.sekolah where kode_wilayah = :kodewilayah: ";

        // where (bentuk_pendidikan = 'SPS' OR bentuk_pendidikan = 'TK' OR 
        // bentuk_pendidikan = 'KB' OR bentuk_pendidikan = 'MA' OR
        // bentuk_pendidikan = 'Nava Dhammasekha' OR bentuk_pendidikan = 'PKBM' OR
        // bentuk_pendidikan = 'Pratama W P' OR bentuk_pendidikan = 'SD' OR
        // bentuk_pendidikan = 'SDLB' OR bentuk_pendidikan = 'SDTK' OR
        // bentuk_pendidikan = 'SKB' OR bentuk_pendidikan = 'SLB' OR
        // bentuk_pendidikan = 'SMA' OR bentuk_pendidikan = 'SMAg.K' OR
        // bentuk_pendidikan = 'SMAK' OR bentuk_pendidikan = 'SMK' OR
        // bentuk_pendidikan = 'SMLB' OR bentuk_pendidikan = 'SMP' OR
        // bentuk_pendidikan = 'SMPTK' OR bentuk_pendidikan = 'SMTK' OR
        // bentuk_pendidikan = 'SPK KB' OR bentuk_pendidikan = 'SPK PG' OR
        // bentuk_pendidikan = 'SPK SD' OR bentuk_pendidikan = 'SPK SMA' OR
        // bentuk_pendidikan = 'SPK SMP' OR bentuk_pendidikan = 'SPK TK' OR
        // bentuk_pendidikan = 'SPS' OR bentuk_pendidikan = 'TK' OR
        // bentuk_pendidikan = 'TKLB' OR bentuk_pendidikan = 'TPA') 

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function getTotalSiswa($kodewilayah)
    {
        $sql = "SELECT sum([jenis_kelamin_laki_laki]) as t_siswa_laki, 
        sum([jenis_kelamin_perempuan]) as t_siswa_perempuan, 
        sum([jenis_kelamin_laki_laki] + [jenis_kelamin_perempuan]) as total_siswa, 
        sum([islam]) as t_islam,
        sum([kristen]) as t_kristen,
        sum([katholik]) as t_katholik,
        sum([hindu]) as t_hindu,
        sum([budha]) as t_budha,
        sum([khonghucu]) as t_khonghucu,
        sum([kepercayaan]) as t_kepercayaan,
        sum([lainnya]) as t_lainnya,sum([islam]+[kristen]+[katholik]+[hindu]
        +[budha]+[khonghucu]+[kepercayaan]+[lainnya]) as total_agama,
        sum([usia_siswa_kurang_4]) as t_k4,
        sum([usia_siswa_4_6]) as t_46,
        sum([usia_siswa_7_12]) as t_712,
        sum([usia_siswa_13_15]) as t_1315,
        sum([usia_siswa_16_18]) as t_1618,
        sum([usia_siswa_lebih_18]) as t_l18,
        sum([usia_siswa_kurang_4]+[usia_siswa_4_6]+[usia_siswa_7_12]+[usia_siswa_13_15]
        +[usia_siswa_16_18]+[usia_siswa_lebih_18]) as total_usia 
        FROM [Dataprocess].[jendela].[siswa] 
        where kode_wilayah = :kodewilayah:
        group by kode_wilayah";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function getTotalGuru($kodewilayah)
    {
        $sql = "select sum([jenis_kelamin_laki_laki]), 
                sum([jenis_kelamin_perempuan]), 
                sum([jenis_kelamin_laki_laki]+[jenis_kelamin_perempuan]) as total_tendik 
                FROM [Dataprocess].[jendela].[tendik] 
                where kode_wilayah = :kodewilayah:";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
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