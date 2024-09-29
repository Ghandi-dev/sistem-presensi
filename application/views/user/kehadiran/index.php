<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('user/templates/head')?>
    <style>
    .page-item.active .page-link {
        color: #fff;
        border: none;
        /* Tambahkan gradien latar belakang */
        background-image: var(--gradient-<?php echo $this->session->userdata('sidebar_color') ?>);
        /* Contoh gradien dari warna utama ke hitam */
    }
    </style>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $this->load->view('user/templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <!-- Navbar -->
        <div class="container-fluid px-4">
            <?php $this->load->view('user/templates/navbar')?>
            <div class="card p-3 mt-4">
                <div class="row justify-content-end align-items-end">
                    <div class="col-12 col-lg-2 d-flex flex-row justify-content-end align-items-center gap-2 mb-3">
                        <h5 class="mb-0" style="flex-shrink: 0;">Cari data:</h5>
                        <input type="date" id="searchDate" class="form-control" placeholder="Cari berdasarkan tanggal">
                    </div>
                </div>

                <div class="table-responsive mt-3">
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
                                    <span class="badge <?php echo $row->badge; ?>" data="<?php echo $row->status; ?>"
                                        onclick="changeStatus(this)" style="cursor: pointer;">
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
        <!-- Navbar -->
        <!-- Footer -->
        <?php $this->load->view('user/templates/footer')?>
    </main>
    <?php $this->load->view('user/templates/script')?>
    <?php $this->load->view('user/templates/data-table')?>
</body>

</html>