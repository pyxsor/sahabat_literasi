<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/lokasi.css">

    <title>Lokasi Kami</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <div class="container-md">
        <!-- Navbar Atas -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo-black.png" width="100" height="50" alt="" loading="lazy">
                Temukan Kami Dilokasi Yang Tersedia
                <a href="index.php" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Laman Awal</a>
            </a>
        </nav>
        </br>
        <!-- Papan Pengumuman -->
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Perhatian!</h4>
            <p>Selama Musim Pandemi Virus Corona Berlangsung, Kami Mewajibkan Para Perpustakawan Menggunakan Protokol Kesehatan Sesuai Standar WHO</p>
            <hr>
            <p class="mb-0">Terdapat Pengecekan Suhu Tubuh dan Cuci Tangan, Guna Meminimalisir Penyebaran Virus</p>
        </div>
        <!-- Info Lokesyen -->
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-center collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Lokasi Perpustakaan Utama
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <!-- Geo Location Untuk Perpus Fisik -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7996862219748!2d112.74325961472259!3d-7.263623694756974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f916a11b294d%3A0xd58286e95a95196e!2sPerpustakaan%20Umum%20Suroboyo!5e0!3m2!1sid!2sid!4v1608592255904!5m2!1sid!2sid" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-center collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Lokasi Mobil Keliling 1
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <!-- Geo Location Untuk Mobling 1 -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.678414540669!2d112.76420561472261!3d-7.277384794747263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa325f455213%3A0xa1d9275ec60f5a2c!2zQm9uY2Fmw6k!5e0!3m2!1sid!2sid!4v1608593067583!5m2!1sid!2sid" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-center collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Lokasi Mobil Keliling 2
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7014833480443!2d112.74777591472252!3d-7.274769094749089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbdb02c5452f%3A0x65a8384da12bb981!2sIgor&#39;s%20Pastry!5e0!3m2!1sid!2sid!4v1608593178159!5m2!1sid!2sid" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>