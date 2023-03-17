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
                <!-- <center><i><?="( Data Tahun ".substr($tahunajar,0,4)."/".substr($tahunajar,4,1)." )"?></i></center> -->
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
                        <td width="180px">
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
                            <?php
                            if ($datasiswa)
                            echo number_format($datasiswa->total_siswa,0,",",".");
                            else 
                            echo number_format(0,0,",",".");
                            ?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Pendidik dan Tendik
                        </td>
                        <td>:
                            <?=number_format($datakabupaten['jumlah_guru'],0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Kepala Sekolah
                        </td>
                        <td>:
                            <?=number_format($datakabupaten['jumlah_kepsek'],0,",",".");?></td>
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
                        <option value="sekolah">Sekolah</option>
                        <option value="siswa">Siswa</option>
                        <option value="pendidik">Pendidik - Tendik - Kepsek</option>
                </select>
            </div>
            <div id="opsijenjang" class="copsi" style="display:none">
                <select style="padding:5px" name="ijenjang" id="ijenjang">
                        <option value="0">- Semua Jenjang -</option>
                        <option value="1">PAUD</option>
                        <option value="2">DIKDAS</option>
                        <option value="3">DIKMEN</option>
                        <!-- <option value="4">DIKTI</option> -->
                        <option value="5">DIKMAS</option>
                </select>
            </div>
        </div>

        <!-- //////////////////////////////////// -->
        <div id="tampil_1_1" class="tabeldata" style="display:none">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    
                </div>
            </nav>
            
            <div class="tab-content" id="nav-tabContent">
                
            </div>
        </div>

        <!-- //////////////////////////////////// -->
        <div id="tampil_1_2" class="tabeldata" style="display:none">
            <div style="margin-left:5px;border:solid 0.5px grey;max-width:320px;padding:5px;">
                <table class="tabeltotal">
                    <tr>
                        <td width="210px">
                            Total Cagar Budaya
                        </td>
                        <td>:
                            <?=number_format($datakebudayaan['jumlah_cagarbudaya'],0,",",".");?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Lembaga Kebudayaan
                        </td>
                        <td>:
                            <?=number_format($datakebudayaan['jumlah_lembaga'],0,",",".");?></td>
                    </tr>
                </table>
                <table class="tabeltotal">
                    <tr>
                        <td>
                            <ul style="padding-bottom:0px;padding-left:20px;">
                                <li>Museum (<?=number_format($datakebudayaan['jumlah_museum'],0,",",".");?>)</li>
                                <li>Taman Budaya (<?=number_format($datakebudayaan['jumlah_tamanbudaya'],0,",",".");?>)</li>
                                <li>Sanggar (<?=number_format($datakebudayaan['jumlah_sanggar'],0,",",".");?>)</li>
                                <li>Asosiasi Profesi (<?=number_format($datakebudayaan['jumlah_asosiasi'],0,",",".");?>)</li>
                                <li>Lembaga Adat (<?=number_format($datakebudayaan['jumlah_lembagaadat'],0,",",".");?>)</li>
                                <li>Organisasi Penghayat Kepercayaan (<?=number_format($datakebudayaan['jumlah_opk'],0,",",".");?>)</li>
                                <li>Padepokan (<?=number_format($datakebudayaan['jumlah_padepokan'],0,",",".");?>)</li>
                                <li>Komunitas Budaya (<?=number_format($datakebudayaan['jumlah_komunitas'],0,",",".");?>)</li>
                                <li>Dewan Kesenian (<?=number_format($datakebudayaan['jumlah_dewan'],0,",",".");?>)</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

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
            scrollY: "320px",
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
        $('#opsijenjang').hide();
        let sel = document.getElementById("idata");
        if ($('#idata option').length==3)
        sel.remove(0);
        if ($('#idata').val() == 1)
        {
            $('#tampil_1_2').hide();
            $('#idata2').show();
            $('#idata2')
            .empty()
            .append('<option selected="selected" value="0">-- Pilih --</option>')
            .append('<option value="sekolah">Sekolah</option>')
            .append('<option value="siswa">Siswa</option>')
            .append('<option value="pendidik">Pendidik - Tendik - Kepsek</option>');
        }
        else if ($('#idata').val() == 2)
        {
            // $('#idata2')
            // .empty()
            // .append('<option selected="selected" value="0">-- Pilih --</option>')
            // .append('<option value="cagar">Cagar Budaya</option>')
            // .append('<option value="museum">Museum</option>');
            $('#tampil_1_2').show();
            $('#tampil_1_1').hide();
            $('#idata2').hide();
        }
		
	}); 

    $('#idata2').on('change', function () {
        tampilkan($('#ijenjang').val(),$('#idata2').val());
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    $('#ijenjang').on('change', function () {
        tampilkan($('#ijenjang').val(),$('#idata2').val());
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    function tampilkan(idjenjang,entitas)
    {
        
        if (entitas=="sekolah")
        {
            piltotal = <?=$datasekolahan->total_sekolah?>;
        }
        else if (entitas=="siswa")
        {
            
            piltotal = <?php
            if ($datasiswa)
            echo $datasiswa->total_siswa;
            else
            echo "0";
            ?>;
        }
        else if (entitas=="pendidik")
        {
            piltotal = <?=$datakabupaten['jumlah_guru']?>;
        }
        var string = '';
        var config = {
                            // scrollY: "320px",
                            scrollX: true,
                            scrollCollapse: true,
                            searching: false, paging: false, info: false, sorting: false,
                            fixedColumns: {
                                left: 2
                            },
                            columnDefs: [
                                // {"className": "kanan10spasi", "target" : [1,2,3,4,5,6,7,8]},
                            // { "width": "150px", "targets": 0},
                            // { "width": "50px", "targets": [1,2,3,4]},
                            // { "visible": false, "targets": target2},
                            ]
                        };
        if ($('#idata').val() == 1)
        {

            $.ajax({
                        url: "<?=site_url().'home/grabdata/'.$kodewilayah?>/"+idjenjang+"/"+entitas,
                        type: 'get',
                        dataType: "json",
                        data: {
                            total: piltotal
                        },
                        success: function (result) {
                            // console.log(result.jmltabel); 
                            // alert (result.jmltabel);
                            // console.log(result.konten); 
                            $('#nav-tab').html(result.nav);
                            $('#nav-tabContent').html(result.konten);
                            for (aa=1;aa<=result.jmltabel;aa++)
                            {
                                $('#table'+aa).DataTable(config);
                            }
                           
                            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                            });
                            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    
                        },
                        error: function (result)
                        {
                            alert ("Sedang dalam perbaikan!");
                        }
                    });
                    $('#tampil_1_1').show();
                    $('#tampil_1_2').hide();
        }
        else
        {
            // alert ("nahloh");
            $('#tampil_1_2').show();
            $('#tampil_1_1').hide();
        }

        

        if ($('#idata').val()==1)
        $('#opsijenjang').show();
        else
        $('#opsijenjang').hide();

    };


</script>

<?= $this->endSection() ?>