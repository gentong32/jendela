<?php
$link1 = site_url('pendidikan/program/terampil/').substr($kode, 0, 2)."0000"."/1/".$status;
$link2 = site_url('pendidikan/program/terampil/').substr($kode, 0, 4)."00"."/2/".$status;
$breadcrump1 = "";
$breadcrump2 = "";
$breadcrump3 = "";

if ($level==1)
{
    $breadcrump1 = ">> ".$namalevel1;
}
else if ($level>1)
{
    $breadcrump1 = '>> <a href="'.$link1.'">'.$namalevel1.'</a>';
}

if ($level==2)
{
    $breadcrump2 = ">> ".$namalevel2;
}
else if ($level>2)
{
    $breadcrump2 = '>> <a href="'.$link2.'">'.$namalevel2.'</a>';
}

if ($level==3)
{
    $breadcrump3 = ">> ".$namalevel3;
}

$pilstatus1 = "";
$pilstatus2 = "";
$pilstatus3 = "";

$centang="&#10004";

if ($status=="all")
    $pilstatus1 = "selected";
else if ($status=="s1")
    $pilstatus2 = "selected";
else if ($status=="s2")
    $pilstatus3 = "selected";

?>

<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Data Pendidikan Kemendikbudristek</title>
<?= $this->endSection() ?>

<?= $this->section('section') ?>
    <div class="breadcrumps"><a href="<?=site_url('pendidikan/program/terampil')?>">Indonesia</a> 
        <?=$breadcrump1;?>
        <?=$breadcrump2;?>
        <?=$breadcrump3;?>
    </div>
    <div class="judulatas">DAFTAR PROGRAM / LAYANAN KETERAMPILAN KERJA PER <?=$namapilihan?></div>
    <div class="card-body p-0">
        <center>
            <div id="cbok2" style="display:inline-block;">
            <select class="combobox1" id="status_sekolah" name="status_sekolah">
                <option <?=$pilstatus1?> value="all">-Semua Status-</option>
                <option <?=$pilstatus2?> value="s1">Negeri</option>
                <option <?=$pilstatus3?> value="s2">Swasta</option>
            </select>
            </div>
            <button onclick="filterdata()" class="tb_utama" type="button">
                Terapkan
            </button>
        </center>
        <div style="margin:30px;">
            <div class="">
                <table class="table table-striped table-bordered" id='table1'>
                    <thead>
                    <tr>
                        <th rowspan="2" width="10px">No</th>
                        <th rowspan="2">NPSN</th>
                        <th rowspan="2">Nama Satuan Pendidikan</th>
                        <th colspan="9" id="kollevel">Level KKNI</th>
                        <th rowspan="2">Alamat</th>
                        <th rowspan="2"width='180px'>Kelurahan</th>
                        <th rowspan="2">Status</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($datanas as $key => $value) :
                        $level1 = "";
                        $level2 = "";
                        $level3 = "";
                        $level4 = "";
                        $level5 = "";
                        $level6 = "";
                        $level7 = "";
                        $level8 = "";
                        $level9 = "";
                        if ($value->kkni_level_1==1)
                        $level1=$centang;
                        if ($value->kkni_level_2==1)
                        $level2=$centang;
                        if ($value->kkni_level_3==1)
                        $level3=$centang;
                        if ($value->kkni_level_4==1)
                        $level4=$centang;
                        if ($value->kkni_level_5==1)
                        $level5=$centang;
                        if ($value->kkni_level_6==1)
                        $level6=$centang;
                        if ($value->kkni_level_7==1)
                        $level7=$centang;
                        if ($value->kkni_level_8==1)
                        $level8=$centang;
                        if ($value->kkni_level_9==1)
                        $level9=$centang;
                        ?>
                    <tr>
                        <td align="right"><?=$key + 1?></td>
                        <td class="link1"><a target="_blank" href="<?=site_url('pendidikan/npsn/'.trim($value->npsn))?>"><?=$value->npsn?></a></td>
                        <td><?=$value->nama?></td>
                        <td><?=$level1;?></td>
                        <td><?=$level2;?></td>
                        <td><?=$level3;?></td>
                        <td><?=$level4;?></td>
                        <td><?=$level5;?></td>
                        <td><?=$level6;?></td>
                        <td><?=$level7;?></td>
                        <td><?=$level8;?></td>
                        <td><?=$level9;?></td>
                        <td><?=$value->alamat_jalan?></td>
                        <td><?=$value->desa_kelurahan?></td>
                        <td><?=$value->status_skl?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered" id='table2' display='none'>
                    <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>NPSN</th>
                        <th>Nama Satuan Pendidikan</th>
                        <th>KKNI Level 1</th>
                        <th>KKNI Level 2</th>
                        <th>KKNI Level 3</th>
                        <th>KKNI Level 4</th>
                        <th>KKNI Level 5</th>
                        <th>KKNI Level 6</th>
                        <th>KKNI Level 7</th>
                        <th>KKNI Level 8</th>
                        <th>KKNI Level 9</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($datanas as $key => $value) :
                        $level1 = "";
                        $level2 = "";
                        $level3 = "";
                        $level4 = "";
                        $level5 = "";
                        $level6 = "";
                        $level7 = "";
                        $level8 = "";
                        $level9 = "";
                        if ($value->kkni_level_1==1)
                        $level1=$centang;
                        if ($value->kkni_level_2==1)
                        $level2=$centang;
                        if ($value->kkni_level_3==1)
                        $level3=$centang;
                        if ($value->kkni_level_4==1)
                        $level4=$centang;
                        if ($value->kkni_level_5==1)
                        $level5=$centang;
                        if ($value->kkni_level_6==1)
                        $level6=$centang;
                        if ($value->kkni_level_7==1)
                        $level7=$centang;
                        if ($value->kkni_level_8==1)
                        $level8=$centang;
                        if ($value->kkni_level_9==1)
                        $level9=$centang;
                        ?>
                    <tr>
                        <td align="right"><?=$key + 1?></td>
                        <td class="link1"><a target="_blank" href="<?=site_url('pendidikan/npsn/'.trim($value->npsn))?>"><?=$value->npsn?></a></td>
                        <td><?=$value->nama?></td>
                        <td><?=$level1;?></td>
                        <td><?=$level2;?></td>
                        <td><?=$level3;?></td>
                        <td><?=$level4;?></td>
                        <td><?=$level5;?></td>
                        <td><?=$level6;?></td>
                        <td><?=$level7;?></td>
                        <td><?=$level8;?></td>
                        <td><?=$level9;?></td>
                        <td><?=$value->alamat_jalan?></td>
                        <td><?=$value->desa_kelurahan?></td>
                        <td><?=$value->status_skl?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <a href="<?=site_url('pustaka/keterampilankerja/penyetaraan/link');?>"><span class="link1" style="padding-bottom:25px;"><i>*) informasi level KKNI</i></span></a><br><br>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scriptdata') ?>
<script>
$(document).ready( function () {
    if (detectMob()=="desktop")
    {
        $('#table1').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: [1,3,4,5] },
                { className: 'text-center', targets: [3,4,5,6,7,8,9,10,11] },
            ]
        });
    }
    else
    {
        $('#table2').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: [1,3,4,5] },
                { className: 'text-center', targets: [3,4,5,6,7,8,9,10,11] },
            ]
        });
    }
} );

$(document).on('change', '#jalur_pendidikan', function () {
        getdaftarbentuk();
    });

function getdaftarbentuk() {
    isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">.. tunggu ..</option>';
    isihtml3 = '</select>';
    $('#dbentukpendidikan').html(isihtml1 + isihtml3);
    $.ajax({
        type: 'GET',
        data: {jalurpendidikan: $('#jalur_pendidikan').val(),tingkat: '<?=strtoupper($tingkat)?>'},
        dataType: 'json',
        cache: false,
        url: '<?php echo base_url();?>/pendidikan/getbentukpendidikan',
        success: function (result) {
            // alert ($('#jalur_pendidikan').val());
            isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">-Semua Bentuk-</option>';
            isihtml2 = "";
            var total=0;
            $.each(result, function (i, result) {
                total++;
                isihtml2 = isihtml2 + "<option value='" + result.bentuk_pendidikan_id + "'>" + result.nama + "</option>";
            });

            $('.tb_utama').prop('disabled', false);
            if (total==0)
            {
                isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">-tidak ada-</option>';
               $('.tb_utama').prop('disabled', true);
            }

            $('#dbentukpendidikan').html(isihtml1 + isihtml2 + isihtml3);
        }
    });
}

function filterdata()
{
    window.open("<?=site_url('pendidikan/program/'.$tingkat)."/".$kode."/".$level?>"+
    "/"+$('#status_sekolah').val(), target="_self");
}

function detectMob() {
    if (window.innerWidth <= window.innerHeight)
    {
        $('#table1').hide();
        $('#table2').show();
        return "mobile";
    }
    else
    {
        $('#table2').hide();
        $('#table1').show();
        return "desktop";
    }
    // const toMatch = [
    //     /Android/i,
    //     /webOS/i,
    //     /iPhone/i,
    //     /iPad/i,
    //     /iPod/i,
    //     /BlackBerry/i,
    //     /Windows Phone/i
    // ];
    
    // return toMatch.some((toMatchItem) => {
    //     return navigator.userAgent.match(toMatchItem);
    // });
}

</script>
<?= $this->endSection() ?>