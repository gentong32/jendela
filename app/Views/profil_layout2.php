<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Jendela Data Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('section'); 

$total_all_akreditasi=$akreditasi->total_null+$akreditasi->total_belum+$akreditasi->total_tidak+$akreditasi->total_ter+$akreditasi->total_c+$akreditasi->total_b+$akreditasi->total_a;

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
                        aria-selected="true">Ruang Kelas</a>
                </div>
            </nav>
            
            <div class="tab-content" id="nav-tabContent">
                <div
                    class="tab-pane fade show active"
                    id="nav-sek_akreditasi"
                    role="tabpanel"
                    aria-labelledby="nav-sek_akreditasi-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td width="30%">
                                    <b>Akreditasi</b>
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
                                    A
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_akreditasi_a,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    B
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_akreditasi_b,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    C
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_akreditasi_c,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Terakreditasi
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_terakreditasi,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Tidak Terakreditasi
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_tidak_terakreditasi,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    Belum Terakreditasi
                                </td>
                                <td align="right">
                                <?=number_format($datasekolahan->t_belum_terakreditasi,0,",",".")?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td style="padding-left:100px;" align="right">
                                <b><?=number_format($datasekolahan->total_sekolah,0,",",".")?></b>
                                </td>
                                <td></td>
                            </tr>

                        </tbody>

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
                                    Total
                                </td>
                                <td align="right">
                                <b><?=number_format($datasekolahan->total_ruang_kelas,0,",",".")?></b>
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

    var map = L
        .map('maps')
        .setView({
            lat: <?=$bujur?>, lon:<?=$lintang?>}, 10); L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 15,
                attribution: '© OpenStreetMap'
            }).addTo(map); $.getJSON("<?php echo base_url();?>/geojson/<?php echo $kodewilayah;?>.geojson",function(result){
                L
                    .geoJson(result, {
                        onEachFeature: function (feature, peta) {
                            var style = {
                                color: "#273746",
                                fillColor: "#ff8080",
                                weight: 1,
                                opacity: 0.9,
                                fillOpacity: 0.4
                            };
                            peta.setStyle(style);
                        }
                    })
                    .addTo(map);
            }); 
            
    function gantikota() {
        var cleanString = kodewilayah;
        // alert (cleanString);
        window.open('<?=site_url()?>home/profil/' + cleanString, '_self');
    }

    $('#idata').on('change', function () {
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
    });

    function tampilkan()
    {
        for (a=1;a<=1;a++)
        {
            for (b=1;b<=3;b++)
            {
                $('#tampil_'+a+'_'+b).hide();
            }
        }
        
        $('#tampil_'+$('#idata').val()+'_'+$('#idata2').val()).show();
    };

</script>

<?= $this->endSection() ?>