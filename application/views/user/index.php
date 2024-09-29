<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('user/templates/head')?>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $this->load->view('user/templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid px-4">
            <?php $this->load->view('user/templates/navbar')?>
            <div class="row mt-md-4">
                <div class="col-12 col-md-6">
                    <div class="card card-pricing mt-3">
                        <div class="card-header bg-gradient-dark text-center pt-4 pb-5 position-relative">
                            <div class="z-index-1 position-relative">
                                <h3 class="text-white mt-2 mb-0">
                                    <?php echo $hari . ', ' . date('d F Y', strtotime($tanggal)); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="position-relative mt-n5" style="height: 50px;">
                            <div class="position-absolute w-100">
                                <svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40"
                                    preserveAspectRatio="none" shape-rendering="auto">
                                    <defs>
                                        <path id="card-wave"
                                            d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                                        </path>
                                    </defs>
                                    <g class="moving-waves">
                                        <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                        <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                        <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                        <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                        <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                        <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-6">
                                    <h1 class="text-gradient text-dark mb-0">
                                        <?php echo $kehadiran_hari_ini->waktu_datang; ?>
                                    </h1>
                                    <h5 class="mt-3">Jam Masuk</h5>
                                </div>
                                <div class="col-6">
                                    <h1 class="text-gradient text-dark mb-0">
                                        <?php echo $kehadiran_hari_ini->waktu_pulang; ?>
                                    </h1>
                                    <h5 class="mt-3">Jam Pulang</h5>
                                </div>
                            </div>
                            <a href="<?php echo base_url('user/scan') ?>" class="btn bg-gradient-dark w-100 mt-4 mb-0">
                                Scan Kehadiran
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card p-3 mt-3">
                        <h3>Kehadiran 5 hari terakhir</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                            No
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Masuk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Jam Keluar</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
foreach ($kehadiran as $row): ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $no++ ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row->tanggal ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row->waktu_datang ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $row->waktu_pulang ?>
                                        </td>
                                        <td class="text-center">
                                            <!-- Tampilkan badge dengan warna yang sesuai -->
                                            <span class="badge <?php echo $row->badge; ?>"
                                                data="<?php echo $row->status; ?>" onclick="changeStatus(this)"
                                                style="cursor: pointer;">
                                                <?php echo $row->status; ?>
                                            </span>
                                        </td>

                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar -->


        <!-- Content -->

        <!-- Footer -->
        <?php $this->load->view('user/templates/footer')?>
    </main>
    <?php $this->load->view('user/templates/script')?>
</body>

</html>