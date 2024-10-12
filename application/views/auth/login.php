<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('user/templates/head')?>
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang Kembali</h3>
                                    <p class="mb-0">Masukan Username dan Password</p>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?php echo base_url('auth/login'); ?>" role="form">
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Username"
                                                aria-label="Username" name="username" required>
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" aria-describedby="password-addon" name="password"
                                                required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('<?=base_url('assets/img/curved6.jpg')?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <?php $this->load->view('user/templates/script')?>
    <?php $this->load->view('admin/templates/alert')?>

</body>

</html>