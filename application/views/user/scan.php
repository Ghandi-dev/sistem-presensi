<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('user/templates/head')?>
</head>

<body class="g-sidenav-show bg-gray-200">
    <section class="min-vh-100 ">
        <div class="page-header align-items-start min-vh-50 pt-2 pb-11 m-3 border-radius-lg"
            style="background-image: url('<?php echo base_url('assets/img/curved0.jpg') ?>')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <!-- <h1 class="text-white mb-2 mt-6">Selamat Datang!</h1> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n12 mt-md-n11 mt-n10">
                <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4 pb-0">
                            <h5><?=$pegawai->nama?></h5>
                        </div>
                        <div class="card-body py-0 d-flex flex-column justify-content-center align-item-center">
                            <div class="text-center mb-3 ">
                                <img src="<?php echo base_url('assets/img/qr-code/') . $pegawai->qr_code ?>"
                                    alt="QR Code" class="img-fluid border-radius-lg shadow w-lg-50 w-sm-100">
                                <a href="<?php echo base_url('user/') ?>">
                                    <div class="btn btn-round bg-gradient-secondary btn-lg mb-0 w-100 mt-3">Kembali
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('user/templates/script')?>
</body>

</html>