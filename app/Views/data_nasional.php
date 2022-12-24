<?php
$totaldata = 0;
$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;

$link1 = site_url('home/data')."/".substr($kode, 0, 2)."0000"."/1/".$status;
$link2 = site_url('home/data')."/".substr($kode, 0, 4)."00"."/2/".$status;
$breadcrump1 = "";
$breadcrump2 = "";
$judulnama = "Nama Provinsi";

if ($level==1)
{
    $breadcrump1 = ">> ".$namalevel1;
    if (substr($kode,0,2)!='35')
        $judulnama = "Nama Kota/Kabupaten";
    else
        $judulnama = "Nama Negara";
}
else if ($level>1)
{
    $breadcrump1 = '>> <a href="'.$link1.'">'.$namalevel1.'</a>';
}

if ($level==2)
{
    $breadcrump2 = ">> ".$namalevel2;
    if (substr($kode,0,2)!='35')
        $judulnama = "Nama Kecamatan";
    else
        $judulnama = "Nama Kota";
}
else if ($level>2)
{
    $breadcrump2 = '>> <a href="'.$link2.'">'.$namalevel2.'</a>';
}


$piljalur1 = "";
$piljalur2 = "";
$piljalur3 = "";

$pilbentuk1 = "";

$piljalur1 = "selected";
$styletabel = "max-width:100%;";

$pilstatus1 = "";
$pilstatus2 = "";
$pilstatus3 = "";

if ($status=="all")
    $pilstatus1 = "selected";
else if ($status=="s1")
    $pilstatus2 = "selected";
else if ($status=="s2")
    $pilstatus3 = "selected";

?>

<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Jendela Data Induk Pendidikan Kemendikbudristek</title>
<?= $this->endSection() ?>

<?= $this->section('section') ?>


<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>

    <?php if($level>0) {?>
    <div class="breadcrumps"><a href="<?=site_url('home')?>">Indonesia</a> 
    <?=$breadcrump1;?>
    <?=$breadcrump2;?>
    </div>
    <?php }?>
    <div class="judulatas">JENDELA DATA INDUK PENDIDIKAN PER <?=$namapilihan?></div>
    <div class="card-body p-0">
        
        <div class="mytable">
           <div style="align:center;margin:auto;">
                <table class="table table-striped" id='table1'>
                <thead>
                <tr>
                    <th class="table1th" rowspan="2" width="10px">No</th>
                    <th class="table1th" rowspan="2" width="200px"><?=$judulnama?></th>
                    <th class="table1th" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sekolah</th>
                    <th class="table1th" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Siswa</th>
                    <th class="table1th" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pendidik</th>
                    <th class="table1th" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tendik</th>
                    <th class="table1th" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepsek</th>
                </tr>
                <tr>
                    <th class="table1th">Negeri</th>
                    <th class="table1th">Swasta</th>
                    <th class="table1th">Negeri</th>
                    <th class="table1th">Swasta</th>
                    <th class="table1th">Negeri</th>
                    <th class="table1th">Swasta</th>
                    <th class="table1th">Negeri</th>
                    <th class="table1th">Swasta</th>
                    <th class="table1th">Negeri</th>
                    <th class="table1th">Swasta</th>
                </tr>
                </thead>
                <tbody align="right">
                <?php 
                $nomor = 0;
                foreach ($datanas as $key => $value) :
                    $nomor++
                ?>
                <tr>
                    <td style="padding-right:0px;"><?=$nomor?></td>
                    <td align="left" class="link1"><a href="<?=site_url('home/data/'.
                    trim($value['kode_wilayah']).'/'.($level+1))?>"><?php
                    if ($level==0 && $value['nama']!="Luar Negeri")
                    {
                        echo substr($value['nama'],5);
                    }
                    else if ($level==2 && substr($kode,0,2)!='35')
                    {
                        echo substr($value['nama'],4);
                    }
                    else
                    {
                        echo $value['nama'];
                    }?></a></td>
                    <td><?=$value['jml_sekolah_negeri']?></td>
                    <td><?=$value['jml_sekolah_swasta']?></td>
                    <td><?=$value['jml_siswa_negeri']?></td>
                    <td><?=$value['jml_siswa_swasta']?></td>
                    <td><?=$value['jml_pendidik_negeri']?></td>
                    <td><?=$value['jml_pendidik_swasta']?></td>
                    <td><?=$value['jml_tendik_negeri']?></td>
                    <td><?=$value['jml_tendik_swasta']?></td>
                    <td><?=$value['jml_kepsek_negeri']?></td>
                    <td><?=$value['jml_kepsek_swasta']?></td>
                  
                </tr>
                
                <?php endforeach;?>
                </tbody>

                <tfoot align="right">
                <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                </tfoot>

                </table>
               
             </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scriptpeta') ?>
<script>
$(document).ready( function () {
    $('#table1').DataTable({
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                left: 2
            },
        bInfo: false,
        "bPaginate": true,
        "lengthChange": false,
        "showNEntries" : false,
        columnDefs: [
            {
                render: function (data, type, full, meta) {
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                    targets: [1],
            },
            { responsivePriority: 1, targets: -1 },
            { targets: 2, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 3, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 4, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 5, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 6, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 7, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 7, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 8, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 9, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 10, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { targets: 11, render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { className: 'text-right', targets: [2,3,4,5,6,7,8,9,10,11] },
            { width: '200px', targets: [1] },
            // { width: '100px', targets: [1,2] },
            
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // var monTotal = api
            //     .column( 1 )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );
				
	        var total1 = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            var total2 = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total3 = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total4 = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total5 = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total6 = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total7 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total8 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total9 = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var total10 = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            // Update footer by showing the total with the reference of the column index 
            var numFormat = $.fn.dataTable.render.number( '.', ',', 0, '' ).display;

	        $( api.column( 0 ).footer() ).html('');
            $( api.column( 1 ).footer() ).html('TOTAL SEMUA');
            $( api.column( 2 ).footer() ).html(numFormat(total1));
            $( api.column( 2 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 3 ).footer() ).html(numFormat(total2));
            $( api.column( 3 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 4 ).footer() ).html(numFormat(total3));
            $( api.column( 4 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 5 ).footer() ).html(numFormat(total4));
            $( api.column( 5 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 6 ).footer() ).html(numFormat(total5));
            $( api.column( 6 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 7 ).footer() ).html(numFormat(total6));
            $( api.column( 7 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 8 ).footer() ).html(numFormat(total7));
            $( api.column( 8 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 9 ).footer() ).html(numFormat(total8));
            $( api.column( 9 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 10 ).footer() ).html(numFormat(total9));
            $( api.column( 10 ).footer() ).css({'text-align':'right','padding-right':'15px'});
            $( api.column( 11 ).footer() ).html(numFormat(total10));
            $( api.column( 11 ).footer() ).css({'text-align':'right','padding-right':'15px'});

        },
        "processing": true,
    });

} );

function filterdata()
{
    window.open("<?=site_url('home/data')."/".$kode."/".$level?>"+
    "/"+$('#status_sekolah').val(), target="_self");
}

</script>
<?= $this->endSection() ?>