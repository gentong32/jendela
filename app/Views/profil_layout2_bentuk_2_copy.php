<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Jendela Data Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('section'); 

$total_all_akreditasi=$akreditasi->total_null+$akreditasi->total_belum+$akreditasi->total_tidak+$akreditasi->total_ter+$akreditasi->total_c+$akreditasi->total_b+$akreditasi->total_a;

$totalsemua = 0;

$kolom=array();
foreach ($bentuks as $bentuk)
{
    $kolom[$bentuk] = 0;
}

?>
<section>
    <div class="kontainer">
        <input
            type="hidden"
            class="txt_csrfname"
            name="<?= csrf_token() ?>"
            value="<?= csrf_hash() ?>"/>

            <?php if ($status_peta!="Sukses")
            {?>
            <div>
                <span style="color:red;"><?=$status_peta?></span><br>
            </div>
            <?php } ?>

            <div class="inline vert-top" style="margin-right:50px;">
                <h2 class="mb-0"><?=$datakabupaten['nama']?></h2>
                <div id="dkota" class="ckota">
                    <div class="inline">
                        Ganti Kota:
                    </div>
                    <div class="inline" style="width:200px">
                        <input
                            type="text"
                            class="form-control"
                            name="isearch"
                            id="isearch"
                            placeholder="Nama kota/kabupaten">
                        <div class="position-absolute" id="form2_complete" style="z-index: 99;"></div>
                    </div>
                    <div onclick="return gantikota()" class="inline">
                        <button class="btn-dua">Ok</button>
                    </div>
                </div>

                <!-- <hr> -->
                <p class="text-muted mb-lg-4 mb-md-4"></p>
                <table class="tabeltotal">
                    <tr>
                        <td width="130px">
                            Total Kecamatan
                        </td>
                        <td>:
                            <?=number_format($datakabupaten['jumlah_kecamatan'],0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Kelurahan
                        </td>
                        <td>:
                            <?=number_format($datakabupaten['jumlah_kelurahan'],0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Sekolah
                        </td>
                        <td>:
                            <?=number_format($datasekolahan->total_sekolah,0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Siswa
                        </td>
                        <td>:
                            <?=number_format($datasiswa->total_siswa,0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Guru
                        </td>
                        <td>:
                            <?=number_format($datakabupaten['jumlah_guru'],0,",",".");?></td>
                    </tr>
                </table>
            </div>
            <div class="inline vert-top" style="margin-top:43px;">
                <div class="covermap">
                    <div style="height:300px;width:300px;" id="maps"></div>
                </div>
            </div>
       <hr style="border:0.5px dashed green">
    </div>
    
    <div class="kontainer">
        <div class="coveropsi">
            <div class="copsi">
                <select style="padding:5px" name="idata" id="idata">
                    <!-- <option value="0">-- Pilih Data --</option> -->
                    <option value="1">Pendidikan</option>
                    <option value="2">Kebudayaan</option>
                </select>
            </div>
            <div id="opsi2" class="copsi">
                <select style="padding:5px" name="idata2" id="idata2">
                        <option value="0">-- Pilih --</option>
                        <option value="1">Sekolah</option>
                        <option value="2">Siswa</option>
                        <option value="3">Guru</option>
                </select>
            </div>
            <div id="opsijenjang" class="copsi" style="display:none">
                <select style="padding:5px" name="ijenjang" id="ijenjang">
                        <option value="1">PAUD</option>
                </select>
            </div>
        </div>

        <!-- //////////////////////////////////// -->
        <div id="tampil_1_1" class="tabeldata" style="display:none">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a
                        class="nav-item nav-link active"
                        id="nav-sek_akreditasi-tab"
                        data-toggle="tab"
                        href="#nav-sek_akreditasi"
                        role="tab"
                        aria-controls="nav-sek_akreditasi"
                        aria-selected="true">Akreditasi</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-sek_status-tab"
                        data-toggle="tab"
                        href="#nav-sek_status"
                        role="tab"
                        aria-controls="nav-sek_status"
                        aria-selected="true">Ruang Kelas dan Lab</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-sek_sarpras-tab"
                        data-toggle="tab"
                        href="#nav-sek_sarpras"
                        role="tab"
                        aria-controls="nav-sek_sarpras"
                        aria-selected="true">Sarana & Prasarana</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-sek_jamkerja-tab"
                        data-toggle="tab"
                        href="#nav-sek_jamkerja"
                        role="tab"
                        aria-controls="nav-sek_sarpras"
                        aria-selected="true">Waktu Penyelengaraan</a>
                </div>
            </nav>
            
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active "
                id="nav1"
                role="tabpanel"
                aria-labelledby="nav1-tab">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <td>
                                <b>Akreditasi</b>
                            </td>
                            <td align="right">
                                <b>Jumlah</b>
                            </td><td width="100px"><b>TK</b></td><td width="100px"><b>KB</b></td><td width="100px"><b>TPA</b></td><td width="100px"><b>SPS</b></td><td width="100px"><b>RA</b></td><td width="100px"><b>Taman Seminari</b></td><td width="100px"><b>SPK KB</b></td><td width="100px"><b>PAUDQ</b></td><td width="100px"><b>SPK PG</b></td><td width="100px"><b>SPK TK</b></td><td width="100px"><b>Pratama W P</b></td><td width="100px"><b>Nava Dhammasekha</b></td></tr>
                    </thead>
                    <tbody><tr>
                            <td>
                                A
                            </td>
                            <td align="right">76</td><td>62</td><td>9</td><td>0</td><td>0</td><td>2</td><td>0</td><td>0</td><td>0</td><td>1</td><td>2</td><td>0</td><td>0</td>
                        </tr><tr>
                            <td>
                                B
                            </td>
                            <td align="right">76</td><td>55</td><td>8</td><td>0</td><td>3</td><td>10</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                        </tr><tr>
                            <td>
                                C
                            </td>
                            <td align="right">26</td><td>12</td><td>5</td><td>0</td><td>4</td><td>5</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                        </tr><tr>
                            <td>
                                Terakreditasi
                            </td>
                            <td align="right">2</td><td>0</td><td>1</td><td>0</td><td>1</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                        </tr><tr>
                            <td>
                                Belum Terakreditasi
                            </td>
                            <td align="right">823</td><td>390</td><td>265</td><td>3</td><td>47</td><td>89</td><td>0</td><td>0</td><td>29</td><td>0</td><td>0</td><td>0</td><td>0</td>
                        </tr><tr>
                            <td>
                                Tidak Terakreditasi
                            </td>
                            <td align="right">6</td><td>0</td><td>6</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                        </tr></tbody>
                </table>
            </div><div class="tab-pane fade  "
                id="nav2"
                role="tabpanel"
                aria-labelledby="nav2-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>
                                <b>Kondisi Ruang Kelas</b>
                            </td>
                            <td align="right">
                                <b>Jumlah</b>
                            </td><td width="100px"><b>TK</b></td><td width="100px"><b>KB</b></td><td width="100px"><b>TPA</b></td><td width="100px"><b>SPS</b></td><td width="100px"><b>RA</b></td><td width="100px"><b>Taman Seminari</b></td><td width="100px"><b>SPK KB</b></td><td width="100px"><b>PAUDQ</b></td><td width="100px"><b>SPK PG</b></td><td width="100px"><b>SPK TK</b></td><td width="100px"><b>Pratama W P</b></td><td width="100px"><b>Nava Dhammasekha</b></td><td width="100px"><b>TK</b></td><td width="100px"><b>KB</b></td><td width="100px"><b>TPA</b></td><td width="100px"><b>SPS</b></td><td width="100px"><b>RA</b></td><td width="100px"><b>Taman Seminari</b></td><td width="100px"><b>SPK KB</b></td><td width="100px"><b>PAUDQ</b></td><td width="100px"><b>SPK PG</b></td><td width="100px"><b>SPK TK</b></td><td width="100px"><b>Pratama W P</b></td><td width="100px"><b>Nava Dhammasekha</b></td></tr>
                    </thead>
                    <tbody><tr>
                            <td>
                                Kondisi Lab IPA
                            </td>
                            <td align="right">76</td><td>62</td><td>9</td><td>0</td><td>0</td><td>2</td><td>0</td><td>0</td><td>0</td><td>1</td><td>2</td><td>0</td><td>0</td>
                        </tr></tbody>
                </table>
            </div>
                <div
                    class="tab-pane fade"
                    id="nav-sek_status"
                    role="tabpanel"
                    aria-labelledby="nav-sek_status-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Ruang Kelas</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->kelas_baik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->kelas_r_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->kelas_r_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->kelas_r_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td align="right">
                                <b><?=number_format($datasekolahan->total_ruang_kelas,0,",",".")?></b>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium IPA</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipabaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipar_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipar_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipar_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium KIMIA</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_kimbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_kimr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_kimr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_kimr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium FISIKA</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_fisbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_fisr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_fisr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_fisr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium BIOLOGI</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_biobaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bior_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bior_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bior_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium BAHASA</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bhsbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bhsr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bhsr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_bhsr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium IPS</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipsbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipsr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipsr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_ipsr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Laboratorium KOMPUTER</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_kombaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_komr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_komr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_lab_komr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Ruang Perpustakaan</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_perpusbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_perpusr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_perpusr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_perpusr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi Ruang UKS</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_uksbaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_uksr_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_uksr_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_uksr_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="tab-pane fade"
                    id="nav-sek_sarpras"
                    role="tabpanel"
                    aria-labelledby="nav-sek_sarpras-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Sumber Listrik</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     Ada
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_listrikada,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tidak ada
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_listriktakada,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Akses Internet</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     Ada
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_internetada,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tidak ada
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_internettakada,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Sumber Air</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     Kemasan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airkemasan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    PAM
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airpam,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Pompa
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airpompa,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Hujan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airhujan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sumur Terlindungi
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airsumur,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Mata Air Terlindungi
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airmataair,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sungai
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airsungai,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Lainnya
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airlain,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kecukupan Air</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     Cukup Sepanjang Waktu
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_aircukup,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tidak Cukup Sepanjang Waktu
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airtakcukup,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Belum mengisi data
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_airbelum,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi WC Guru</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     WC Guru Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcgurubaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Guru Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcgurur_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Guru Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcgurur_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Guru Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcgurur_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Kondisi WC Siswa</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     WC Siswa Baik
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcsiswabaik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Siswa Rusak Ringan
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcsiswar_ringan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Siswa Rusak Sedang
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcsiswar_sedang,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    WC Siswa Rusak Berat
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_wcsiswar_berat,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>
                </div>
                <div
                    class="tab-pane fade"
                    id="nav-sek_jamkerja"
                    role="tabpanel"
                    aria-labelledby="nav-sek_jamkerja-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Waktu Penyelenggaraan</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     Pagi 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_pagi_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Siang 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_siang_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Doubleshift 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_dobel_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sore 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_sore_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Malam 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_malam_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sehari penuh 5 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_penuh_5hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sehari penuh 6 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_penuh_6hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Sehari penuh 3 hari
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_waktu_penuh_3hari,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ------------------------------------ -->

        <!-- //////////////////////////////////// -->
        <div id="tampil_1_2" class="tabeldata" style="display:none">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a
                        class="nav-item nav-link active"
                        id="nav-3-1-tab"
                        data-toggle="tab"
                        href="#nav-3-1"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true">Jenis Kelamin</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-3-2-tab"
                        data-toggle="tab"
                        href="#nav-3-2"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false">Agama</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-3-3-tab"
                        data-toggle="tab"
                        href="#nav-3-3"
                        role="tab"
                        aria-controls="nav-contact"
                        aria-selected="false">Usia</a>
                    <a
                        class="nav-item nav-link"
                        id="nav-3-4-tab"
                        data-toggle="tab"
                        href="#nav-3-4"
                        role="tab"
                        aria-controls="nav-contact"
                        aria-selected="false">Jenis Ketunaan</a>
                </div>
            </nav>
        
            <div class="tab-content" id="nav-tabContent">
                <div
                    class="tab-pane fade show active"
                    id="nav-3-1"
                    role="tabpanel"
                    aria-labelledby="nav-3-1-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Jenis Kelamin</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Laki-laki
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_siswa_laki,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Perempuan
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_siswa_perempuan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td align="right">
                                <b><?=number_format($datasiswa->total_siswa,0,",",".")?></b>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div
                    class="tab-pane fade"
                    id="nav-3-2"
                    role="tabpanel"
                    aria-labelledby="nav-3-2-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Agama</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%">
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Islam
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_islam,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Kristen
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_kristen,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Katholik
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_katholik,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Hindu
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_hindu,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Budha
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_budha,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Khonghucu
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_khonghucu,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Kepercayaan
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_kepercayaan,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Lainnya
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_lainnya,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td align="right">
                                <b><?=number_format($datasiswa->total_agama,0,",",".")?></b>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div
                    class="tab-pane fade"
                    id="nav-3-3"
                    role="tabpanel"
                    aria-labelledby="nav-3-3-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Rentang Usia</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%">
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    < 4 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_k4,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    4 - 6 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_46,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    7 - 12 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_712,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    13 - 15 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_1315,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    16 - 18 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_1618,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    > 18 tahun
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_l18,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td align="right">
                                <b><?=number_format($datasiswa->total_usia,0,",",".")?></b>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
          
                <div
                    class="tab-pane fade"
                    id="nav-3-4"
                    role="tabpanel"
                    aria-labelledby="nav-3-4-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Jenis Ketunaan</b>
                                </td>
                                <td align="right" width="30%">
                                    <b>Jumlah</b>
                                </td>
                                <td align="right" width="30%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Tunanetra
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_tunanetra,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tunarungu
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_tunarungu,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tunagrahita
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_tunagrahita,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tunadaksa
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_tunadaksa,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Autis
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_autis,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tunaganda
                                </td>
                                <td align="right">
                                <?=number_format($datasiswa->t_tunaganda,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- ------------------------------------ -->

        <!-- //////////////////////////////////// -->
        <div id="tampil_1_3" class="tabeldata" style="display:none">
            <div id="guru">
                <h5>Guru</h5>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a
                            class="nav-item nav-link active"
                            id="nav-2-1-tab"
                            data-toggle="tab"
                            href="#nav-2-1"
                            role="tab"
                            aria-controls="nav-2-1"
                            aria-selected="true">Status</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2-2-tab"
                            data-toggle="tab"
                            href="#nav-2-2"
                            role="tab"
                            aria-controls="nav-2-2"
                            aria-selected="false">Golongan</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2-3-tab"
                            data-toggle="tab"
                            href="#nav-2-3"
                            role="tab"
                            aria-controls="nav-2-3"
                            aria-selected="false">Jenis Kelamin</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2-4-tab"
                            data-toggle="tab"
                            href="#nav-2-4"
                            role="tab"
                            aria-controls="nav-2-4"
                            aria-selected="false">Sertifikasi</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="nav-2-1"
                        role="tabpanel"
                        aria-labelledby="nav-2-1-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Status</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Guru PNS
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_pns,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Guru Yayasan
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_yayasan,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Guru Honor Daerah
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_honor,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Guru Bantu
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_bantu,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($dataguru->total_gurustatus,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2-2"
                        role="tabpanel"
                        aria-labelledby="nav-2-2-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Golongan</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Gol I
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_gurugol1,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol II
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_gurugol2,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol III
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_gurugol3,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol IV
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_gurugol4,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($dataguru->total_gurugol,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2-3"
                        role="tabpanel"
                        aria-labelledby="nav-2-3-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Jenis Kelamin</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                       Laki-laki
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_laki,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Perempuan
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_guru_perempuan,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($dataguru->total_guru,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2-4"
                        role="tabpanel"
                        aria-labelledby="nav-2-4-tab">
                        <table class="table table-striped">
                        <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Sertifikasi</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Sudah Sertifikasi
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_sertifikasi_belum,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Belum Sertifikasi
                                    </td>
                                    <td align="right">
                                    <?=number_format($dataguru->t_sertifikasi_sudah,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($dataguru->total_sertifikasi,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="tenagakependidikan">
                <h5>Tenaga Kependidikan</h5>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a
                            class="nav-item nav-link active"
                            id="nav-2b-1-tab"
                            data-toggle="tab"
                            href="#nav-2b-1"
                            role="tab"
                            aria-controls="nav-2b-1"
                            aria-selected="true">Status</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2b-2-tab"
                            data-toggle="tab"
                            href="#nav-2b-2"
                            role="tab"
                            aria-controls="nav-2b-2"
                            aria-selected="false">Golongan</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2b-3-tab"
                            data-toggle="tab"
                            href="#nav-2b-3"
                            role="tab"
                            aria-controls="nav-2b-3"
                            aria-selected="false">Jenis Kelamin</a>
                        <a
                            class="nav-item nav-link"
                            id="nav-2b-4-tab"
                            data-toggle="tab"
                            href="#nav-2b-4"
                            role="tab"
                            aria-controls="nav-2b-4"
                            aria-selected="false">Sertifikasi</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-bud1_1Content">
                    <div
                        class="tab-pane fade show active"
                        id="nav-2b-1"
                        role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <table class="table table-striped">
                        <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Status</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Tenaga Pendidik PNS
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_pns,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Tenaga Pendidik Yayasan
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_yayasan,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Tenaga Pendidik Honor Daerah
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_honor,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Tenaga Pendidik Bantu
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_bantu,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Tenaga Pendidik Tidak Tetap
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_tidak_tetap,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($datatendik->total_tendikstatus,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2b-2"
                        role="tabpanel"
                        aria-labelledby="nav-2b-2-tab">
                        <table class="table table-striped">
                        <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Golongan</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Gol I
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendikgol1,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol II
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendikgol2,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol III
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendikgol3,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Gol IV
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendikgol4,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($datatendik->total_tendikgol,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2b-3"
                        role="tabpanel"
                        aria-labelledby="nav-2b-3-tab">
                        <table class="table table-striped">
                        <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Jenis Kelamin</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                       Laki-laki
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_laki,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Perempuan
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_tendik_perempuan,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($datatendik->total_tendik,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-2b-4"
                        role="tabpanel"
                        aria-labelledby="nav-2b-4-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="30%">
                                        <b>Sertifikasi</b>
                                    </td>
                                    <td align="right" width="30%">
                                        <b>Jumlah</b>
                                    </td>
                                    <td align="right" width="30%"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Sudah Sertifikasi
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_sertifikasi_belum,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        Belum Sertifikasi
                                    </td>
                                    <td align="right">
                                    <?=number_format($datatendik->t_sertifikasi_sudah,0,",",".")?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td align="right">
                                    <b><?=number_format($datatendik->total_sertifikasi,0,",",".")?></b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- ------------------------------------ -->

    </div>


    

</section>

<?= $this->endSection() ?>

<?= $this->section('scriptpeta') ?>
<script>
    $(document).ready(function () {

        // $('#table1').DataTable({
        //     responsive: true,
        //     columnDefs: [
        //         { responsivePriority: 1, targets: 1 },
        //     ]
        // });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });

        $('#table1').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            searching: false, paging: false, info: false,
            fixedColumns: {
                left: 2
            },
            columnDefs: [
            { "width": "80px", "targets": 0},
            { "width": "50px", "targets": [1,2,3,4,5,6,7,8,9,10,11,12]},
            ]
        });

        

        $("#isearch").autocomplete({
            source: function (request, response) {
                // Fetch data
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                $.ajax({
                    url: "<?=site_url('home/getAuto')?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        [csrfName]: csrfHash
                    },
                    success: function (data) {
                        // Update CSRF Token
                        $('.txt_csrfname').val(data.token);
                        response(data.data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#isearch').val(ui.item.label); // display the selected text
                kodewilayah = ui.item.value; // save selected id to input
                return false;
            },
            focus: function (event, ui) {
                $("#isearch").val(ui.item.label);
                kodewilayah = ui.item.value;
                return false;
            }
        });
    });

    var latlngs = [];
    var kodewilayah;

    // var map = L
    //     .map('maps')
    //     .setView({
    //         lat: <?=$bujur?>, lon:<?=$lintang?>}, 10); L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //             maxZoom: 15,
    //             attribution: '© OpenStreetMap'
    //         }).addTo(map); $.getJSON("<?php echo base_url();?>/geojson/<?php echo $kodewilayah;?>.geojson",function(result){
    //             L
    //                 .geoJson(result, {
    //                     onEachFeature: function (feature, peta) {
    //                         var style = {
    //                             color: "#273746",
    //                             fillColor: "#ff8080",
    //                             weight: 1,
    //                             opacity: 0.9,
    //                             fillOpacity: 0.4
    //                         };
    //                         peta.setStyle(style);
    //                     }
    //                 })
    //                 .addTo(map);
    //         }); 
            
    function gantikota() {
        var cleanString = kodewilayah;
        // alert (cleanString);
        window.open('<?=site_url()?>home/profil/' + cleanString, '_self');
    }

    $('#idata').on('change', function () {
        $('#opsijenjang').hide();
        let sel = document.getElementById("idata");
        if ($('#idata option').length==3)
        sel.remove(0);
        if ($('#idata').val() == 1)
        {
            $('#idata2')
            .empty()
            .append('<option selected="selected" value="0">-- Pilih --</option>')
            .append('<option value="1">Sekolah</option>')
            .append('<option value="2">Siswa</option>')
            .append('<option value="3">Guru</option>');
        }
        else if ($('#idata').val() == 2)
        {
            $('#idata2')
            .empty()
            .append('<option selected="selected" value="0">-- Pilih --</option>')
            .append('<option value="1">Cagar Budaya</option>')
            .append('<option value="2">Museum</option>');
        }
		
	}); 

    $('#idata2').on('change', function () {
        tampilkan();
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    function tampilkan()
    {
        var string = '';
        $.ajax({
                    url: "<?=site_url('home/grabdata')?>",
                    type: 'get',
                    dataType: "json",
                    data: {
                        id: 1
                    },
                    success: function (result) {
                        console.log(result.konten); 
                        $('#nav-tab').html(result.nav);
                        $('#nav-tabContent').html(result.konten);
                        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                    }
                });

        $('#tampil_1_1').show();

    };


</script>

<?= $this->endSection() ?>