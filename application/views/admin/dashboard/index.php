<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/templates/head')?>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $this->load->view('admin/templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid px-4">
            <?php $this->load->view('admin/templates/navbar')?>
            <!-- Content -->
            <div class="row mt-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Pegawai</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?=$jumlah_pegawai?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah yang
                                            hadir hari ini</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?=$jumlah_kehadiran_hari_ini?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah yang tidak
                                            hadir hari ini</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?=$jumlah_tidak_hadir_hari_ini?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 ">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Belum Presensi Hari ini
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?=count($belum_presensi)?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4 pe-0">
                    <div class="col-lg-6 col-md-6 mb-md-0 mb-4 pe-0">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Belum Melalukan Presensi Hari ini</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                    Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;foreach ($belum_presensi as $row): ?>
                                            <tr>
                                                <td class="align-middle text-center text-md"><?php echo $no; ?></td>
                                                <td class="align-middle">
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="<?php echo base_url('assets/img/foto/') . $row->foto; ?>"
                                                                class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-md"><?php echo $row->nama; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++;endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-md-0 mb-4 pe-0">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Tidak Hadir Hari ini</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                    Nama</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                    KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;foreach ($tidak_hadir as $row): ?>
                                            <tr>
                                                <td class="align-middle text-center text-md"><?php echo $no; ?></td>
                                                <td class="align-middle">
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="<?php echo base_url('assets/img/foto/') . $row->foto; ?>"
                                                                class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-md"><?php echo $row->nama; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Tampilkan badge dengan warna yang sesuai -->
                                                    <span class="badge bg-gradient-secondary">
                                                        <?php echo $row->status; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php $no++;endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar -->
        <!-- Footer -->
        <?php $this->load->view('admin/templates/footer')?>
    </main>
    <?php $this->load->view('admin/templates/script')?>
</body>

</html>