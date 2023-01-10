<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModelJendela extends Model
{
    protected $paudall = "sum (case when bentuk_pendidikan='TK' then akreditasi_a else 0) as tk_akreditasi_a, 
    sum (case when bentuk_pendidikan='KB' then akreditasi_a else 0) as kb_akreditasi_a
    s.bentuk_pendidikan='KB' OR 
    s.bentuk_pendidikan='TPA' OR 
    s.bentuk_pendidikan='SPS' OR 
    s.bentuk_pendidikan='RA' OR 
    s.bentuk_pendidikan='Taman Seminari' OR 
    s.bentuk_pendidikan='SPK KB' OR 
    s.bentuk_pendidikan='SPK TK' OR 
    s.bentuk_pendidikan='Pratama W P' OR 
    s.bentuk_pendidikan='Nava Dhammasekha'";

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

    public function getTotalSekolahBentuk($kodewilayah,$bentuks,$fields,$entitas)
    {
        // $bentuks = array('TK','KB','TPA','SPS','RA','Taman Seminari','SPK KB','PAUDQ','SPK PG','SPK TK','Pratama W P','Nava Dhammasekha');
        // $fields = array ('akreditasi_a','akreditasi_b','akreditasi_c','akreditasi_tidak_terakreditasi','akreditasi_belum_terakreditasi','akreditasi_terakreditasi');
        $thesum = "";
        foreach ($fields as $field)
        {
            if (is_array($bentuks))
            {
                foreach($bentuks as $bentuk)
                {
                    $namakecil = strtolower($bentuk);
                    $namakecil = str_replace(" ","",$namakecil);
                    $namakecil = str_replace(".","",$namakecil);
                    if ($bentuk=="Akademik")
                    $thesum = $thesum." sum (case when (bentuk_pendidikan='Akademik' OR bentuk_pendidikan='Akademi') then ".$field." else 0 end) as ".$namakecil."_".$field.",";
                    else
                    $thesum = $thesum." sum (case when bentuk_pendidikan='".$bentuk."' then ".$field." else 0 end) as ".$namakecil."_".$field.",";
                }
            }
            else
            {
                $thesum = $thesum." sum (".$field.") as t_".$field.",";
            }
        }

        $sql = "SELECT ".$thesum." max(kode_wilayah) as kode_wilayah  
        from dataprocess.jendela.".$entitas." where kode_wilayah = :kodewilayah: ";

        // echo $sql;

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);


        return $query->getRowArray();
    }

    public function getTotalSekolahBentukAll($kodewilayah,$paud,$dikdas,$dikmen,$dikti,$dikmas,$fields,$entitas)
    {
        $thesum="";
        foreach ($fields as $field)
        {
            $oror = "";
            foreach($paud as $bentuk)
            {
                $namakecil = strtolower($bentuk);
                $namakecil = str_replace(" ","",$namakecil);
                $namakecil = str_replace(".","",$namakecil);
                $oror = $oror."'".$bentuk."',";
            }
            $oror = $oror."'".$bentuk."'";
            $thesum = $thesum." sum (case when bentuk_pendidikan in (".$oror.") then ".$field." else 0 end) as paud_".$field.",";

            $oror = "";
            foreach($dikdas as $bentuk)
            {
                $namakecil = strtolower($bentuk);
                $namakecil = str_replace(" ","",$namakecil);
                $namakecil = str_replace(".","",$namakecil);
                $oror = $oror."'".$bentuk."',";
            }
            $oror = $oror."'".$bentuk."'";
            $thesum = $thesum." sum (case when bentuk_pendidikan in (".$oror.") then ".$field." else 0 end) as dikdas_".$field.",";

            $oror = "";
            foreach($dikmen as $bentuk)
            {
                $namakecil = strtolower($bentuk);
                $namakecil = str_replace(" ","",$namakecil);
                $namakecil = str_replace(".","",$namakecil);
                $oror = $oror."'".$bentuk."',";
            }
            $oror = $oror."'".$bentuk."'";
            $thesum = $thesum." sum (case when bentuk_pendidikan in (".$oror.") then ".$field." else 0 end) as dikmen_".$field.",";

            $oror = "";
            foreach($dikti as $bentuk)
            {
                $namakecil = strtolower($bentuk);
                $namakecil = str_replace(" ","",$namakecil);
                $namakecil = str_replace(".","",$namakecil);
                $oror = $oror."'".$bentuk."',";
                if ($bentuk=="Akademik")
                $oror = $oror."'Akademi',";

            }
            $oror = $oror."'".$bentuk."'";
            $thesum = $thesum." sum (case when bentuk_pendidikan in (".$oror.") then ".$field." else 0 end) as dikti_".$field.",";

            $oror = "";
            foreach($dikmas as $bentuk)
            {
                $namakecil = strtolower($bentuk);
                $namakecil = str_replace(" ","",$namakecil);
                $namakecil = str_replace(".","",$namakecil);
                $oror = $oror."'".$bentuk."',";
            }
            $oror = $oror."'".$bentuk."'";
            $thesum = $thesum." sum (case when bentuk_pendidikan in (".$oror.") then ".$field." else 0 end) as dikmas_".$field.",";
        }

        $sql = "SELECT ".$thesum." max(kode_wilayah) as kode_wilayah  
        from dataprocess.jendela.".$entitas." where kode_wilayah = :kodewilayah: ";

        // echo $sql;

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);


        return $query->getRowArray();
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
        +[ruang_kelas_rusak_berat]) as total_ruang_kelas,
        sum([sumber_listrik_ada]) as t_listrikada,
        sum([sumber_listrik_tidak_ada]) as t_listriktakada,
        sum([akses_internet_ada]) as t_internetada,
        sum([akses_internet_tidak_ada]) as t_internettakada,
        sum([sumber_air_kemasan]) as t_airkemasan,
        sum([sumber_air_PAM]) as t_airpam,
        sum([sumber_air_pompa]) as t_airpompa,
        sum([sumber_air_hujan]) as t_airhujan,
        sum([sumber_air_sumur_terlindungi]) as t_airsumur,
        sum([sumber_air_mata_air_terlindungi]) as t_airmataair,
        sum([sumber_air_sungai]) as t_airsungai,
        sum([sumber_air_lainnya]) as t_airlain,
        sum([kecukupan_air_cukup_sepanjang_waktu]) as t_aircukup,
        sum([kecukupan_air_tidak_cukup_sepanjang_waktu]) as t_airtakcukup,
        sum([kecukupan_air_blm_mengisi]) as t_airbelum,
        sum([laboratorium_ipa_baik]) as t_lab_ipabaik,
        sum([laboratorium_ipa_rusak_ringan]) as t_lab_ipar_ringan,
        sum([laboratorium_ipa_rusak_sedang]) as t_lab_ipar_sedang,
        sum([laboratorium_ipa_rusak_berat]) as t_lab_ipar_berat,
        sum([laboratorium_kimia_baik]) as t_lab_kimbaik,
        sum([laboratorium_kimia_rusak_ringan]) as t_lab_kimr_ringan,
        sum([laboratorium_kimia_rusak_sedang]) as t_lab_kimr_sedang,
        sum([laboratorium_kimia_rusak_berat]) as t_lab_kimr_berat,
        sum([laboratorium_fisika_baik]) as t_lab_fisbaik,
        sum([laboratorium_fisika_rusak_ringan]) as t_lab_fisr_ringan,
        sum([laboratorium_fisika_rusak_sedang]) as t_lab_fisr_sedang,
        sum([laboratorium_fisika_rusak_berat]) as t_lab_fisr_berat,
        sum([laboratorium_biologi_baik]) as t_lab_biobaik,
        sum([laboratorium_biologi_rusak_ringan]) as t_lab_bior_ringan,
        sum([laboratorium_biologi_rusak_sedang]) as t_lab_bior_sedang,
        sum([laboratorium_biologi_rusak_berat]) as t_lab_bior_berat,
        sum([laboratorium_bahasa_baik]) as t_lab_bhsbaik,
        sum([laboratorium_bahasa_rusak_ringan]) as t_lab_bhsr_ringan,
        sum([laboratorium_bahasa_rusak_sedang]) as t_lab_bhsr_sedang,
        sum([laboratorium_bahasa_rusak_berat]) as t_lab_bhsr_berat,
        sum([laboratorium_ips_baik]) as t_lab_ipsbaik,
        sum([laboratorium_ips_rusak_ringan]) as t_lab_ipsr_ringan,
        sum([laboratorium_ips_rusak_sedang]) as t_lab_ipsr_sedang,
        sum([laboratorium_ips_rusak_berat]) as t_lab_ipsr_berat,
        sum([laboratorium_komputer_baik]) as t_lab_kombaik,
        sum([laboratorium_komputer_rusak_ringan]) as t_lab_komr_ringan,
        sum([laboratorium_komputer_rusak_sedang]) as t_lab_komr_sedang,
        sum([laboratorium_komputer_rusak_berat]) as t_lab_komr_berat,
        sum([ruang_perpustakaan_baik]) as t_perpusbaik,
        sum([ruang_perpustakaan_rusak_ringan]) as t_perpusr_ringan,
        sum([ruang_perpustakaan_rusak_sedang]) as t_perpusr_sedang,
        sum([ruang_perpustakaan_rusak_berat]) as t_perpusr_berat,
        sum([toilet_siswa_laki]) as t_toilet_laki,
        sum([toilet_siswa_perempuan]) as t_toilet_perempuan,
        sum([wc_guru_baik]) as t_wcgurubaik,
        sum([wc_guru_rusak_ringan]) as t_wcgurur_ringan,
        sum([wc_guru_rusak_sedang]) as t_wcgurur_sedang,
        sum([wc_guru_rusak_berat]) as t_wcgurur_berat,
        sum([wc_guru_laki_laki_baik]) as t_wcguru_lakibaik,
        sum([wc_guru_laki_laki_rusak_ringan]) as t_wcguru_lakir_ringan,
        sum([wc_guru_laki_laki_rusak_sedang]) as t_wcguru_lakir_sedang,
        sum([wc_guru_laki_laki_rusak_berat]) as t_wcguru_lakir_berat,
        sum([wc_guru_perempuan_baik]) as t_wcguru_perempuanbaik,
        sum([wc_guru_perempuan_rusak_ringan]) as t_wcguru_perempuanr_ringan,
        sum([wc_guru_perempuan_rusak_sedang]) as t_wcguru_perempuanr_sedang,
        sum([wc_guru_perempuan_rusak_berat]) as t_wcguru_perempuanr_berat,
        sum([wc_siswa_baik]) as t_wcsiswabaik,
        sum([wc_siswa_rusak_ringan]) as t_wcsiswar_ringan,
        sum([wc_siswa_rusak_sedang]) as t_wcsiswar_sedang,
        sum([wc_siswa_rusak_berat]) as t_wcsiswar_berat,
        sum([wc_siswa_laki_laki_baik]) as t_wcsiswa_lakibaik,
        sum([wc_siswa_laki_laki_rusak_ringan]) as t_wcsiswa_lakir_ringan,
        sum([wc_siswa_laki_laki_rusak_sedang]) as t_wcsiswa_lakir_sedang,
        sum([wc_siswa_laki_laki_rusak_berat]) as t_wcsiswa_lakir_berat,
        sum([wc_siswa_perempuan_baik]) as t_wcsiswa_perempuanbaik,
        sum([wc_siswa_perempuan_rusak_ringan]) as t_wcsiswa_perempuanr_ringan,
        sum([wc_siswa_perempuan_rusak_sedang]) as t_wcsiswa_perempuanr_sedang,
        sum([wc_siswa_perempuan_rusak_berat]) as t_wcsiswa_perempuanr_berat,
        sum([ruang_uks_baik]) as t_uksbaik,
        sum([ruang_uks_rusak_ringan]) as t_uksr_ringan,
        sum([ruang_uks_rusak_sedang]) as t_uksr_sedang,
        sum([ruang_uks_rusak_berat]) as t_uksr_berat,
        sum([waktu_penyelenggaran_pagi_6_hari]) as t_waktu_pagi_6hari,
        sum([waktu_penyelenggaran_siang_6_hari]) as t_waktu_siang_6hari,
        sum([waktu_penyelenggaran_double_shift_6_hari]) as t_waktu_dobel_6hari,
        sum([waktu_penyelenggaran_sore_6_hari]) as t_waktu_sore_6hari,
        sum([waktu_penyelenggaran_malam_6_hari]) as t_waktu_malam_6hari,
        sum([waktu_penyelenggaran_sehari_penuh_5_hari]) as t_waktu_penuh_5hari,
        sum([waktu_penyelenggaran_sehari_penuh_6_hari]) as t_waktu_penuh_6hari,
        sum([waktu_penyelenggaran_sehari_penuh_3_hari]) as t_waktu_penuh_3hari,
        sum([mbs_ya]) as t_mbs_ya,
        sum([mbs_tidak]) as t_mbs_tidak 
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
        +[usia_siswa_16_18]+[usia_siswa_lebih_18]) as total_usia,
        sum([tunanetra]) as t_tunanetra,
        sum([tunarungu]) as t_tunarungu,
        sum([tunagrahita]) as t_tunagrahita,
        sum([tunadaksa]) as t_tunadaksa,
        sum([autis]) as t_autis,
        sum([tunaganda] ) as t_tunaganda
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
        $sql = "select sum([jenis_kelamin_laki_laki]) as t_guru_laki, 
                sum([jenis_kelamin_perempuan]) as t_guru_perempuan, 
                sum([jenis_kelamin_laki_laki]+[jenis_kelamin_perempuan]) as total_guru,
                sum([guru_PNS]) as t_guru_pns,
                sum([guru_yayasan]) as t_guru_yayasan,
                sum([guru_honor_daerah]) as t_guru_honor,
                sum([guru_bantu]) as t_guru_bantu,
                sum([guru_tidak_tetap]) as t_guru_tidak_tetap,
                sum([guru_PNS]+[guru_yayasan]+[guru_honor_daerah]+[guru_bantu]
                +[guru_tidak_tetap]) as total_gurustatus, 
                sum([gol_1]) as t_gurugol1, sum([gol_2]) as t_gurugol2,
                sum([gol_3]) as t_gurugol3, sum([gol_4]) as t_gurugol4, 
                sum([gol_1]+[gol_2]+[gol_3]+[gol_4]) as total_gurugol,
                sum([sudah_sertifikasi]) as t_sertifikasi_sudah,
                sum([belum_sertifikasi]) as t_sertifikasi_belum, 
                sum([sudah_sertifikasi]+[belum_sertifikasi]) as total_sertifikasi
                FROM [Dataprocess].[jendela].[pendidik] 
                where kode_wilayah = :kodewilayah:";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function getTotalTendik($kodewilayah)
    {
        $sql = "select sum([jenis_kelamin_laki_laki]) as t_tendik_laki, 
                sum([jenis_kelamin_perempuan]) as t_tendik_perempuan, 
                sum([jenis_kelamin_laki_laki]+[jenis_kelamin_perempuan]) as total_tendik,
                sum([tendik_PNS]) as t_tendik_pns,
                sum([tendik_yayasan]) as t_tendik_yayasan,
                sum([tendik_honor_daerah]) as t_tendik_honor,
                sum([tendik_bantu]) as t_tendik_bantu,
                sum([tendik_tidak_tetap]) as t_tendik_tidak_tetap,
                sum([tendik_PNS]+[tendik_yayasan]+[tendik_honor_daerah]+[tendik_bantu]
                +[tendik_tidak_tetap]) as total_tendikstatus, 
                sum([gol_1]) as t_tendikgol1, sum([gol_2]) as t_tendikgol2,
                sum([gol_3]) as t_tendikgol3, sum([gol_4]) as t_tendikgol4, 
                sum([gol_1]+[gol_2]+[gol_3]+[gol_4]) as total_tendikgol,
                sum([sudah_sertifikasi]) as t_sertifikasi_sudah,
                sum([belum_sertifikasi]) as t_sertifikasi_belum, 
                sum([sudah_sertifikasi]+[belum_sertifikasi]) as total_sertifikasi 
                FROM [Dataprocess].[jendela].[tendik] 
                where kode_wilayah = :kodewilayah:";

        $query = $this->db->query($sql,[
            'kodewilayah' => $kodewilayah
        ]);

        return $query->getRow();
    }

    public function getTotalKepsek($kodewilayah)
    {
        $sql = "select sum([jenis_kelamin_laki_laki]) as t_kepsek_laki, 
                sum([jenis_kelamin_perempuan]) as t_kepsek_perempuan, 
                sum([jenis_kelamin_laki_laki]+[jenis_kelamin_perempuan]) as total_kepsek,
                sum([kepsek_PNS]) as t_kepsek_pns,
                sum([kepsek_yayasan]) as t_kepsek_yayasan,
                sum([kepsek_honor_daerah]) as t_kepsek_honor,
                sum([kepsek_bantu]) as t_kepsek_bantu,
                sum([kepsek_tidak_tetap]) as t_kepsek_tidak_tetap,
                sum([kepsek_PNS]+[kepsek_yayasan]+[kepsek_honor_daerah]+[kepsek_bantu]
                +[kepsek_tidak_tetap]) as total_kepsekstatus, 
                sum([gol_1]) as t_kepsekgol1, sum([gol_2]) as t_kepsekgol2,
                sum([gol_3]) as t_kepsekgol3, sum([gol_4]) as t_kepsekgol4, 
                sum([gol_1]+[gol_2]+[gol_3]+[gol_4]) as total_kepsekgol,
                sum([sudah_sertifikasi]) as t_sertifikasi_sudah,
                sum([belum_sertifikasi]) as t_sertifikasi_belum, 
                sum([sudah_sertifikasi]+[belum_sertifikasi]) as total_sertifikasi 
                FROM [Dataprocess].[jendela].[kepsek] 
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

    public function getNamaPilihan($kode)
    {
        $sql = 'SELECT nama FROM Referensi.ref.mst_wilayah w  
                WHERE kode_wilayah=:kodewilayah:';
        $query = $this->db->query($sql, [
            'kodewilayah'  => $kode
        ]);

        return $query;
    }

    public function getSemuaTotalSekolah($kode,$level) {

        $nkar = $level * 2;
        $nkar2 = $nkar + 2;
        $levelbaru = $level+1;
        $kodebaru = substr($kode,0,$nkar);
        
        $sql = "SELECT nama, kode_wilayah, sum (sekolah_negeri) as jml_sekolah_negeri,
        sum (sekolah_swasta) as jml_sekolah_swasta
        FROM [Dataprocess].[jendela].sekolah 
        where mst_kode_wilayah = :kode:
        group by nama,kode_wilayah 
        order by kode_wilayah";
                
        $query = $this->db->query($sql, [
            'kode' => $kode,
        ]);
        
        return $query;
    }

    public function getSemuaTotalSiswa($kode,$level) {

        $nkar = $level * 2;
        $nkar2 = $nkar + 2;
        $levelbaru = $level+1;
        $kodebaru = substr($kode,0,$nkar);
        
        $sql = "SELECT nama, sum (siswa_negeri) as jml_siswa_negeri,
        sum (siswa_swasta) as jml_siswa_swasta
        FROM [Dataprocess].[jendela].siswa 
        where mst_kode_wilayah = :kode:
        group by nama,kode_wilayah";
                
        $query = $this->db->query($sql, [
            'kode' => $kode,
        ]);
        
        return $query;
    }

    public function getSemuaTotalPendidik($kode,$level) {

        $nkar = $level * 2;
        $nkar2 = $nkar + 2;
        $levelbaru = $level+1;
        $kodebaru = substr($kode,0,$nkar);
        
        $sql = "SELECT nama, sum (pendidik_negeri) as jml_pendidik_negeri,
        sum (pendidik_swasta) as jml_pendidik_swasta
        FROM [Dataprocess].[jendela].pendidik 
        where mst_kode_wilayah = :kode:
        group by nama,kode_wilayah";
                
        $query = $this->db->query($sql, [
            'kode' => $kode,
        ]);
        
        return $query;
    }

    public function getSemuaTotalTendik($kode,$level) {

        $nkar = $level * 2;
        $nkar2 = $nkar + 2;
        $levelbaru = $level+1;
        $kodebaru = substr($kode,0,$nkar);
        
        $sql = "SELECT nama, sum (tendik_negeri) as jml_tendik_negeri,
        sum (tendik_swasta) as jml_tendik_swasta
        FROM [Dataprocess].[jendela].tendik 
        where mst_kode_wilayah = :kode:
        group by nama,kode_wilayah";
                
        $query = $this->db->query($sql, [
            'kode' => $kode,
        ]);
        
        return $query;
    }

    public function getSemuaTotalKepsek($kode,$level) {

        $nkar = $level * 2;
        $nkar2 = $nkar + 2;
        $levelbaru = $level+1;
        $kodebaru = substr($kode,0,$nkar);
        
        $sql = "SELECT nama, sum (kepsek_negeri) as jml_kepsek_negeri,
        sum (kepsek_swasta) as jml_kepsek_swasta
        FROM [Dataprocess].[jendela].kepsek 
        where mst_kode_wilayah = :kode:
        group by nama,kode_wilayah";
                
        $query = $this->db->query($sql, [
            'kode' => $kode,
        ]);
        
        return $query;
    }

    public function getSemuaDaftarSekolah($status,$kodebaru)
    {
        if ($status=="all")
            $wherestatus = "";
        else if ($status=="s1")
            $wherestatus = " AND status_sekolah = 1 ";
        else if ($status=="s2")
            $wherestatus = " AND status_sekolah = 2 ";

        $sql = "SELECT npsn, nama, alamat_jalan, desa_kelurahan, 
        kode_wilayah, kkni_level_1, kkni_level_2, kkni_level_3, kkni_level_4, kkni_level_5,
        kkni_level_6, kkni_level_7, kkni_level_8, kkni_level_9,
        CASE WHEN status_sekolah=1 THEN 'NEGERI' ELSE 'SWASTA' END AS status_skl
        FROM Arsip.dbo.sekolah s 
        JOIN Dataprocess.dbo.sekolah_jenis_layanan d on d.sekolah_id=s.sekolah_id 
        WHERE (".$this->trampilall.") AND 
         (d.kkni_level_1 > 0 OR d.kkni_level_2 > 0 OR d.kkni_level_3 > 0 OR
          d.kkni_level_4 > 0 OR d.kkni_level_5 > 0 OR d.kkni_level_6 > 0 OR
          d.kkni_level_7 > 0 OR d.kkni_level_8 > 0 OR d.kkni_level_9 > 0) 
        AND LEFT(kode_wilayah,6)=:kodebaru: AND soft_delete=0 
        ".$wherestatus." 
        ORDER BY nama";

        $query = $this->db->query($sql, [
            'kodebaru'  => $kodebaru
        ]);

        return $query;
    }

    public function gettotaljenjang($bentuks)
    {
        $kumpulanin = "";
        foreach ($bentuks as $row)
        {
            $kumpulanin = $kumpulanin . "'" . $row . "',";
        }
        $kumpulanin = substr($kumpulanin, 0, -1);

        $sql = "select sum(sekolah_negeri+sekolah_swasta) as totalsekolah 
        FROM [Dataprocess].[jendela].[sekolah]
        where kode_wilayah = '286300' AND bentuk_pendidikan in (".$kumpulanin.")";

        $query = $this->db->query($sql);

        return $query;
    }
}