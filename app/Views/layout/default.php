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
        <link href="<?=site_url().'template/css';?>/gentongstyle.css?v1.3" rel="stylesheet">
        <link href="<?=base_url()?>/leaflet/leaflet.css?v1.0" rel="stylesheet" >
    </head>
    
    <body>

        <header>
            <div class="header1">
                <img height="60" width="60" src="<?=site_url().'template/images/';?>logotutwuri.png" alt="Pusdatin">
                <img height="50" src="<?=site_url().'template/images/';?>logoteks.png?v1.0" alt="Pusdatin">
            </div>
            <div class="menu1">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">HOME</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Menu</a>
                    </li> -->
                </ul>
            </div>
        </header>

        <main>

            <?=$this->renderSection('section')?>

        </main>

        <footer>
            <div class="footer1">
                <div class="kontakkami">
                    <h5>Hubungi Kami</h5>
                    Layanan Terpadu Kemendikbudristek<br>
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
        <script src="<?=base_url()?>/leaflet/leaflet.js?v1.0"></script>
        <?=$this->renderSection('scriptpeta')?>

    </body>
</html>