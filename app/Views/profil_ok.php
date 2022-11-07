<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Jendela Data Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('section'); 

$total_all_akreditasi=$akreditasi->total_null+$akreditasi->total_belum+$akreditasi->total_tidak+$akreditasi->total_ter+$akreditasi->total_c+$akreditasi->total_b+$akreditasi->total_a;

?>
<section>
    <div class="kontainer">
        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div style="height:300px;width:100%;" id="maps"></div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="custom-text-block">
                    <h2 class="mb-0"><?=$datakabupaten['nama']?></h2>

                    <p class="text-muted mb-lg-4 mb-md-4">Kota Anggrek</p>
                        <table class="table table-bordered">
                            <tr>
                                <td width="160px">
                                    Total Kecamatan
                                </td>
                                <td><?=number_format($datakabupaten['jumlah_kecamatan'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td>
                                Total Kelurahan
                                </td>
                                <td><?=number_format($datakabupaten['jumlah_kelurahan'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td>
                                Total Sekolah
                                </td>
                                <td><?=number_format($datakabupaten['jumlah_sekolah'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td>
                                Total Siswa
                                </td>
                                <td><?=number_format($datakabupaten['jumlah_siswa'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td>
                                Total Guru
                                </td>
                                <td> <?=number_format($datakabupaten['jumlah_guru'],0,",",".");?></td>
                            </tr>
                        </table>

                </div>
            </div>

        </div>

        <div style="margin-top:20px;">
            <h5>PENDIDIKAN</h5>
            <div class="accordion" id="accordionExample">
                <div class="panel">
                    <div class="panel-header" id="headingOne">
                        <button
                            class="btn btn-utama text-left"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapseOne"
                            aria-expanded="false"
                            aria-controls="collapseOne">
                            <img
                                style="padding-bottom:3px;"
                                width="20px"
                                height="20px"
                                src="<?=site_url('/template/images/logosekolah.svg')?>"
                                alt="">
                            Sekolah ( total:
                            <?=number_format($datakabupaten['jumlah_sekolah'],0,",",".");?>
                            )
                        </button>
                    </div>

                    <div
                        id="collapseOne"
                        class="collapse"
                        aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="panel-body">
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
                                        aria-selected="true">Status</a>
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
                                                <td>
                                                    <b>Akreditasi</b>
                                                </td>
                                                <td>
                                                    <b>Jumlah</b>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    A
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_a,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    B
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_b,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    C
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_c,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Terakreditasi
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_ter,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Tidak Terakreditasi
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_tidak,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Belum Terakreditasi
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_belum,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Residu
                                                </td>
                                                <td>
                                                <?=number_format($akreditasi->total_null,0,",",".")?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Total</b>
                                                </td>
                                                <td style="padding-left:100px;" align="right">
                                                <b><?=number_format($total_all_akreditasi,0,",",".")?></b>
                                                </td>
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
                                                <td>
                                                    <b>Status</b>
                                                </td>
                                                <td>
                                                    <b>Jumlah</b>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Negeri
                                                </td>
                                                <td>
                                                <?=$status_sekolah->total_negeri?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Swasta
                                                </td>
                                                <td>
                                                <?=$status_sekolah->total_swasta?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Aktif
                                                </td>
                                                <td>
                                                <?=$status_sekolah->total_aktif?>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header" id="headingThree">
                       
                            <button
                                class="btn btn-utama text-left"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree">
                                <img
                                    style="padding-bottom:3px;"
                                    width="20px"
                                    height="15px"
                                    src="<?=site_url('/template/images/logocowok.svg')?>"
                                    alt="">
                                Siswa ( total:
                                <?=number_format($datakabupaten['jumlah_siswa'],0,",",".");?>
                                )
                            </button>
                    </div>
                    <div
                        id="collapseThree"
                        class="collapse"
                        aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="panel-body">
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
                                        aria-selected="false">Status</a>
                                </div>
                            </nav>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div
                                class="tab-pane fade show active"
                                id="nav-3-1"
                                role="tabpanel"
                                aria-labelledby="nav-3-1-tab">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>
                                                <b>Jenis Kelamin</b>
                                            </td>
                                            <td>
                                                <b>Jumlah</b>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Laki-laki
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Perempuan
                                            </td>
                                            <td>
                                                0
                                            </td>
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
                                            <td>
                                                <b>Agama</b>
                                            </td>
                                            <td>
                                                <b>Jumlah</b>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Islam
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kristen
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Katholik
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Hindu
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Budha
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-3-3"
                                role="tabpanel"
                                aria-labelledby="nav-3-3-tab">
                                Data Status
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header" id="headingTwo">
                            <button
                                class="btn btn-utama text-left"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo">
                                <img
                                    style="padding-bottom:3px;"
                                    width="17px"
                                    height="20px"
                                    src="<?=site_url('/template/images/logouser.svg')?>"
                                    alt="">
                                Guru ( total:
                                <?=number_format($datakabupaten['jumlah_guru'],0,",",".");?>
                                )
                            </button>
                    </div>
                    <div
                        id="collapseTwo"
                        class="collapse"
                        aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="panel-body">
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
                                                    <td>
                                                        <b>Status</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        PNS
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        GTT
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        GTY
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Honor
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
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
                                                    <td>
                                                        <b>Golongan</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Gol I
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol II
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol III
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol IV
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
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
                                                    <td>
                                                        <b>Sertifikasi</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Sertifikasi A
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi B
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi C
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi D
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
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
                                            aria-selected="false">Ijazah</a>
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
                                                    <td>
                                                        <b>Status</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        PNS
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        GTT
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        GTY
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Honor
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
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
                                                    <td>
                                                        <b>Golongan</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Gol I
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol II
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol III
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gol IV
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
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
                                                    <td>
                                                        <b>Sertifikasi</b>
                                                    </td>
                                                    <td>
                                                        <b>Jumlah</b>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Sertifikasi A
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi B
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi C
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Sertifikasi D
                                                    </td>
                                                    <td>
                                                        0
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div style="margin-top:20px;">
            <h5>KEBUDAYAAN</h5>
            <div class="accordion" id="accordionExample">
                <div class="panel">
                    <div class="panel-header" id="headingBud1">
                        <button
                            class="btn btn-utama text-left"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapseBud1"
                            aria-expanded="false"
                            aria-controls="collapseBud1">
                            <img
                                style="padding-bottom:3px;"
                                width="20px"
                                height="20px"
                                src="<?=site_url('/template/images/logopohon.svg')?>"
                                alt="">
                            Cagar Budaya ( total:
                            <?=number_format($datakebudayaan['jumlah_cagarbudaya'],0,",",".");?>
                            )
                        </button>
                    </div>

                    <div
                        id="collapseBud1"
                        class="collapse"
                        aria-labelledby="headingBud1"
                        data-parent="#accordionExample">
                        <div class="panel-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a
                                        class="nav-item nav-link active"
                                        id="nav-bud1_1-tab"
                                        data-toggle="tab"
                                        href="#nav-bud1_1"
                                        role="tab"
                                        aria-controls="nav-bud1_1"
                                        aria-selected="true">Kategori</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-bud1_1Content">
                                <div
                                    class="tab-pane fade show active"
                                    id="nav-bud1_1"
                                    role="tabpanel"
                                    aria-labelledby="nav-bud1_1-tab">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <b>Kategori</b>
                                                </td>
                                                <td>
                                                    <b>Jumlah</b>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Benda
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Bangunan
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Situs
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Struktur
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Kawasan
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel">
                    <div class="panel-header" id="headingBud3">
                        <button
                            class="btn btn-utama text-left"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapseBud3"
                            aria-expanded="false"
                            aria-controls="collapseBud3">
                            <img
                                style="padding-bottom:3px;"
                                width="20px"
                                height="20px"
                                src="<?=site_url('/template/images/logokampus.svg')?>"
                                alt="">
                            Museum ( total:
                            <?=number_format($datakebudayaan['jumlah_museum'],0,",",".");?>
                            )
                        </button>
                    </div>

                    <div
                        id="collapseBud3"
                        class="collapse"
                        aria-labelledby="headingBud3"
                        data-parent="#accordionExample">
                        <div class="panel-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a
                                        class="nav-item nav-link active"
                                        id="nav-bud3_1-tab"
                                        data-toggle="tab"
                                        href="#nav-bud3_1"
                                        role="tab"
                                        aria-controls="nav-bud3_1"
                                        aria-selected="true">Jenis</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div
                                    class="tab-pane fade show active"
                                    id="nav-bud3_1"
                                    role="tabpanel"
                                    aria-labelledby="nav-bud3_1-tab">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <b>Jenis</b>
                                                </td>
                                                <td>
                                                    <b>Jumlah</b>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                Umum
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                Khusus
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scriptpeta') ?>
<script>
    var latlngs = [];
<?php

$myFile = site_url('template/js/geojson_kabkot_indonesia.js');
$lines = file($myFile);//file in to an array
$baris=0;
$bujurkiri = 0;
$bujurkanan = 0;
$lintangatas = 0;
$lintangbawah= 0;
$hitung=1;
foreach ($lines as $lineNumber => $line) {
    if (strpos($line, $namakota) !== false) {
        $line = str_replace("[ [ [","[",$line);
        $line = str_replace("[ [","[",$line);
        $line = str_replace("] ] ]","]",$line);
        $line = str_replace("] ]","]",$line);
        $line = str_replace(" ","",$line);
        $pos = strpos($line, 'coordinates')+13;
        $line2 = substr($line,$pos,-4);
        $batasakhir = strrpos($line2,"[");
        $mulai=0;
        $pos1=0;
        echo $line2;
        while ($pos1<$batasakhir)
        {
            $hitung++;
            $pos1=strpos($line2, "[", $mulai);
            $poskoma=strpos($line2, ",", $pos1);
            $pos2=strpos($line2, "]", $poskoma);
            $panjangkekoma=$poskoma-$pos1-1;
            $panjangkepos2=$pos2-$poskoma-1;
            $mulai=$pos2;
            $lintang=substr($line2,$pos1+1,$panjangkekoma);
            $bujur=substr($line2,$poskoma+1,$panjangkepos2);

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

            // $lat2[$baris][0]=$row[1];
            // $lat2[$baris][1]=$row[0];
            if ($hitung>18)
            echo "latlngs.push([".$bujur.",".$lintang."]); \n \r";
        }
        break;
    }
}
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";
echo "latlngs.pop();";


$bujurtengah=(($bujurkiri)+($bujurkanan))/2;
$lintangtengah=(($lintangatas)+($lintangbawah))/2;

?>

// latlngs[0][0]=-6.35718012; latlngs[0][1]=106.77106476; 
// latlngs[1][0]=-6.35715914; latlngs[1][1]=106.77086639; 
// latlngs[2][0]=-6.35714102; latlngs[2][1]=106.77072906;

//var latlngs = [[-6.35718012,106.77106476],[-6.35715914,106.77086639],[-6.35714102,106.77072906]];
// var polygon = L.polygon(latlngs, {color: 'red'});
var map = L
    .map('maps')
    .setView({
        lat: <?=$bujurtengah?>, lon:<?=$lintangtengah?>}, 11); L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map); 
        // L.marker({lat: <?=$datakabupaten['lintang']?>, lon:<?=$datakabupaten['bujur']?>}).bindPopup('<?=$datakabupaten['nama']?>').addTo(map);
        L.polygon(latlngs, {color: 'red'}).addTo(map);
</script>

<?= $this->endSection() ?>