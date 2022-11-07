<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Jendela Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('section') ?>
<section class="about-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div style="height:300px;width:100%;" id="maps">
                                 
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="custom-text-block">
                    <h2 class="mb-0"><?=$datakabupaten['nama']?></h2>

                    <p class="text-muted mb-lg-4 mb-md-4">Kota Anggrek</p>

                    <p> Jumlah Kecamatan : <?=$datakabupaten['jumlah_kecamatan']?><br>
                        Jumlah Kelurahan : <?=$datakabupaten['jumlah_kelurahan']?></p>


                </div>
            </div>

        </div>
        
        <div class="info">
            <table>
                <tr>
                    <td>
                        <img width="50px" height="50px" src="<?=site_url('template/images/logosekolah.svg')?>" alt="">
                    </td>
                    <td>
                        <span style="font-size:20px;">Sekolah</span>
                    </td>
                    <td>
                        <span class="infototal text1">1.500</span>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><hr></td>
                </tr>
            </table>

            <div class="inline" style="max-width:500px; margin-left:10px;">
                <table>
                    <tr>
                        <td>
                        Negeri
                        </td>
                        <td>
                            <div class="bar" style="width: 150px;">
                                <div class="percentage1" style="width:100%">1.000</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Swasta
                        </td>
                        <td>
                            <div class="bar" style="width: 150px;">
                                <div class="percentage2" style="width:50%">500</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>

        <div class="info">
            <table>
                <tr>
                    <td>
                        <img width="50px" height="50px" src="<?=site_url('template/images/logouser.svg')?>" alt="">
                    </td>
                    <td>
                        <span style="font-size:20px;">Jumlah Siswa</span>
                    </td>
                    <td>
                        <span class="infototal text1">100.000</span>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><hr></td>
                </tr>
            </table>

            <div class="inline" style="max-width:500px; margin-left:10px;">
                <table>
                    <tr>
                        <td>
                            <img width="20px" height="20px" 
                            src="<?=site_url('template/images/logocowok.svg')?>" alt="">Laki-laki
                        </td>
                    <td>
                        <div class="bar" style="width: 100px;">
                            <div class="percentage1" style="width:100%">46.000</div>
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <img width="20px" height="20px" 
                            src="<?=site_url('template/images/logocewek.svg')?>" alt="">Perempuan
                        </td>
                        <td>
                            <div class="bar" style="width: 100px;">
                                <div class="percentage2" style="width:50%">54.000</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="inline" style="max-width:500px; margin-left:10px;">
                <table>
                    <tr>
                        <td>
                            <img width="20px" height="20px" 
                            src="<?=site_url('template/images/logocowok.svg')?>" alt="">Laki-laki
                        </td>
                    <td>
                        <div class="bar" style="width: 100px;">
                            <div class="percentage1" style="width:100%">46.000</div>
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <img width="20px" height="20px" 
                            src="<?=site_url('template/images/logocewek.svg')?>" alt="">Perempuan
                        </td>
                        <td>
                            <div class="bar" style="width: 100px;">
                                <div class="percentage2" style="width:50%">54.000</div>
                            </div>
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
    var map = L.map('maps').setView({lat:<?=$datakabupaten['lintang']?>, 
        lon:<?=$datakabupaten['bujur']?>}, 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'}).addTo(map);
    L.marker({lat:<?=$datakabupaten['lintang']?>, 
        lon:<?=$datakabupaten['bujur']?>}).bindPopup('<?=$datakabupaten['nama']?>').addTo(map);
    
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],
                          ['Male',60],
                          ['Female',40],
                     ]);  
                var options = {  
                      title: 'Percentage of Male and Female Employee',  
                      is3D:false,
                      pieSliceText: 'value', 
                      slices: {0: {color: '#7eaffa'}, 1:{color: '#8be995'}, 2:{color: 'blue'}, 3: {color: 'red'}, 4:{color: 'grey'}},
                      pieHole: 0.0
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
<?= $this->endSection() ?>