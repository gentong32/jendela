<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?=$this->renderSection('titel')?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Jendela Data Pendidikan - Pusdatin Kemdikbudristek">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
        <meta name="author" content="Gentong">
        <meta name="generator" content="Gentong Theme">
        <meta name="Description" content="Pusdatin Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi">
        <meta name="Keywords" content="Pusdatin, Jendela Data Pendidikan">
        <link rel="icon" type="image/png" href="<?=site_url().'template/images/logotutwuri.png';?>">

        <link href="<?=site_url().'template/css';?>/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="<?=base_url()?>/leaflet/leaflet.css?v1.0" rel="stylesheet" >
        <link href="<?=site_url().'template/css';?>/gentongstyle.css?v2.4" rel="stylesheet">
         <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url()?>/template/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/template/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/template/css/fixedColumns.dataTables.min.css">
    </head>
    
    <body>

        <header>
            <div class="header1">
                <div class="dlogo">
                    <img class="imgtutwuri" src="<?=site_url().'template/images/';?>logotutwuri.png" alt="Tutwuri">
                    <img class="imgteks" src="<?=site_url().'template/images/';?>logoteks.png?v1.3" alt="Pusdatin">
                </div>
            </div>
            <div class="menu1">
                <ul class="nav">
                    <li class="nav-item">
                        <?php
                        if ($level<2)
                        {?>
                            <a class="nav-link" href="<?=site_url("home")?>">HOME</a>
                        <?php } else {?>
                            <a class="nav-link" href="<?=site_url('home/data/').substr($kode,0,2).'0000/1'?>">Kembali</a>
                        <?php } ?>
                        
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showinputkota();" tabindex="-1" aria-disabled="true">Ganti Kota</a>
                    </li> -->
                </ul>
            </div>
        </header>
        
        <?php
        if ($level<2)
        {?>
        <center>
         <?php } ?>
        <main style="margin-top:20px; margin-bottom:20px; margin-left:auto; margin-right:auto; max-width:98%;">

            <?=$this->renderSection('section')?>

        </main>
        <?php
        if ($level<2)
        {?>
        </center>
        <?php } ?>
        <footer>
            <div class="footer1">
                <div class="kontakkami">
                    <!-- <h5>Hubungi Kami</h5> -->
                    <b>Layanan Terpadu Kemendikbudristek</b><br>
                    Gedung C Lantai 1 Kompleks Kemendikbudristek<br>
                    Senayan Jakarta, 10270<br>
                    Contact Center : 177<br>
                    Live Chat via : ult.kemdikbud.go.id
                    <i class='fa fa-email'></i>pengaduan@kemdikbud.go.id
                </div>
                
            </div>

            <div class="footer2">
                 <p class="copyright-text mb-0">Copyright © 2022 Pusdatin Kemdikbudristek</p>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="<?=site_url().'template/js/';?>jquery.min.js"></script>
        <script src="<?=site_url().'template/js/';?>bootstrap.min.js"></script>
        <script src="<?=site_url().'template/js/';?>bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="<?=base_url()?>/leaflet/leaflet.js?v1.0"></script>
        <?=$this->renderSection('scriptpeta')?>

        <script src="<?=base_url()?>/template/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>/template/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url()?>/template/js/dataTables.fixedColumns.min.js"></script>
        <script src="<?=base_url()?>/template/js/dataTables.bootstrap.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>