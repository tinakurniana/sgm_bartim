<?php
// mengkonekkan ke file functions-admin.php
include 'function-show.php';

// select data dari tabel
$query_pengurus = "SELECT * FROM pengurus";
$query_galeri = "SELECT * FROM galeri";
$query_kontak = "SELECT * FROM kontak";
$query_profil = "SELECT * FROM profil";
$query_pengumuman = "SELECT * FROM pengumuman";

// menampilkan data dengan memanggil function tampilData dan parameternya diisi dengan select diatas
$pengurus = tampilData($query_pengurus);
$galeri = tampilData($query_galeri);
$kontak = tampilData($query_kontak);
$profil = tampilData($query_profil);
$pengumuman = tampilData($query_pengumuman);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Koperasi Plasma PT Sawit Graha Manunggal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="pengunjung/assets-pengunjung/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="pengunjung/assets-pengunjung/lib/animate/animate.min.css" rel="stylesheet">
    <link href="pengunjung/assets-pengunjung/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="pengunjung/assets-pengunjung/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="pengunjung/assets-pengunjung/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="pengunjung/assets-pengunjung/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <!-- <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@example.com</small> -->
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i><?= $kontak[0]['telp']; ?></small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i><?= $kontak[0]['email']; ?></small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h3 class="text-primary m-0">PT Sawit Graha Manunggal</h3>
                <!-- <img src="pengunjung/assets-pengunjung/img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="#" class="nav-item nav-link">Home</a>
                    <a href="#profil" class="nav-item nav-link">Profil</a>
                    <a href="#struktur" class="nav-item nav-link">Struktur Organisasi</a>
                    <a href="#galeri" class="nav-item nav-link">Galeri</a>
                    <a href="#kontak" class="nav-item nav-link">Kontak</a>
                    <a href="#pengumuman" class="nav-item nav-link">Pengumuman</a>
                </div>
                <a href="login.php" class="btn btn-primary rounded-pill py-2 px-4">Login Anggota</a>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Koperasi Plasma PT Sawit Graha Manunggal</h1>
                        <!-- <p class="fs-4 text-white mb-4 animated slideInDown">Tempor erat elitr rebum at clita diam amet diam et eos erat ipsum lorem sit</p> -->
                        <div class="position-relative w-75 mx-auto animated slideInDown">
                            <!-- <a href="" class="btn btn-primary rounded-pill py-2 px-4">Login Anggota</a> -->
                            <!-- <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Eg: Thailand">
                            <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Profil Start -->
    <div class="container-xxl py-5" id="profil">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="pengunjung/assets-pengunjung/img/about-1.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Profil</h6>
                    <!-- Menampilkan data profil di index 0 (karena datanya cuman 1) -->
                    <?= $profil[0]['keterangan'] ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Profil End -->

    <!-- Struktur Organisasi Start -->
    <div class="container-xxl py-5" id="struktur">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Struktur Organisasi</h6>
                <h1 class="mb-5">Struktur Organisasi Koperasi</h1>
            </div>
            <div class="row g-4 d-flex justify-content-center">
                <!-- looping untuk menampilkan data pengurus -->
                <?php foreach ($pengurus as $pg) : ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="admin/assets-admin/images/<?= $pg["foto"]; ?>" style="width: 100%; height:300px; object-fit:cover;" alt="">
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0"><?= $pg['nama']; ?></h5>
                                <small><?= $pg['jabatan']; ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Struktur Organisasi End -->

    <!-- Galeri Start -->
    <div class="container-xxl py-5" id="galeri">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
                <h1 class="mb-5">Dokumentasi</h1>
            </div>

            <div class="row g-4 d-flex justify-content-center">
                <!-- Looping untuk menampilkan data galeri -->
                <?php foreach ($galeri as $gr) : ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="#galeriModal-<?= $gr['id_galeri'] ?>" data-toggle="modal">
                            <div class="package-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="admin/assets-admin/images/<?= $gr["foto"]; ?>" style="width: 100%; height:300px; object-fit:cover;" alt="">
                                </div>
                                <div class="text-center p-4">
                                    <h3 class="mb-3"><?= $gr['judul']; ?></h3>
                                    <p><?= $gr['keterangan']; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="galeriModal-<?= $gr['id_galeri'] ?>" tabindex="-1" role="dialog" aria-labelledby="galeriModal-<?= $gr['id_galeri'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="package-item">
                                        <div class="overflow-hidden">
                                            <img class="img-fluid" src="admin/assets-admin/images/<?= $gr["foto"]; ?>" style="width: 100%; height:300px; object-fit:cover;" alt="">
                                        </div>
                                        <div class="text-center p-4">
                                            <h3 class="mb-3"><?= $gr['judul']; ?></h3>
                                            <p><?= $gr['keterangan']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Galeri End -->

    <!-- Pengumuman Start -->
    <div class="container-xxl py-5" id="pengumuman">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Pengumuman</h6>
                <h1 class="mb-5">Pengumuman</h1>
            </div>
            <div class="row g-4 d-flex justify-content-center">
                <?php
                foreach ($pengumuman as $p) {
                ?>
                    <div class="col-3">
                        <div class="card gap-1 wow fadeInUp" data-wow-delay="0.1s" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $p['judul'] ?></h5>
                                <p class="card-text"><?= substr($p['pengumuman'], 0, 50) . '...' ?></p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-<?= $p['id'] ?>">
                                    Detail
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal-<?= $p['id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal-<?= $p['id'] ?>Label"><?= $p['judul'] ?></h5>
                                            </div>
                                            <div class="modal-body">
                                                <?= $p['pengumuman'] ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Pengumuman End -->

    <!-- Kontak Start -->
    <div class="container-xxl py-5" id="kontak">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Kontak</h6>
                <h1 class="mb-5">Kontak dan Lokasi Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>PT Sawit Graha Manunggal</h5>
                    <p class="mb-4">Berikut alamat kantor kami dan kontak yang bisa dihubungi :</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Alamat</h5>
                            <p class="mb-0"><?= $kontak[0]['alamat']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Telp</h5>
                            <p class="mb-0"><?= $kontak[0]['telp']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0"><?= $kontak[0]['email']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15948.801474745153!2d115.0831671!3d-2.075705!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfadab013c5048f%3A0xc77540d8f57a50f5!2sPT.%20Sawit%20Graha%20Manunggal!5e0!3m2!1sid!2sid!4v1684563585256!5m2!1sid!2sid" frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Kontak End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Menu</h4>
                    <a class="btn btn-link" href="#">Home</a>
                    <a class="btn btn-link" href="#profil">Profil</a>
                    <a class="btn btn-link" href="#struktur">Struktur Organisasi</a>
                    <a class="btn btn-link" href="#galeri">Galeri</a>
                    <a class="btn btn-link" href="#kontak">Kontak</a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Kontak</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $kontak[0]['alamat']; ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $kontak[0]['telp']; ?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $kontak[0]['email']; ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">PT Sawit Graha Manunggal</a>, All Right Reserved.
                        Designed By <a class="border-bottom" href="#">Pirdha Cahayani</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/wow/wow.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/easing/easing.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/waypoints/waypoints.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/tempusdominus/js/moment.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="pengunjung/assets-pengunjung/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="pengunjung/assets-pengunjung/js/main.js"></script>
</body>

</html>