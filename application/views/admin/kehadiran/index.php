<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/templates/head')?>
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
    <?php $this->load->view('admin/templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg mb-5">
        <div class="container-fluid px-4 ">
            <?php $this->load->view('admin/templates/navbar')?>
            <!-- Content -->
            <div class="card p-3 mt-3">
                <div class="row justify-content-between align-items-end">
                    <div class="col-sm-12 col-lg-6 d-flex justify-content-center justify-content-lg-start gap-2">
                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal"
                            data-bs-target="#modal-status"><i class="fa fa-plus">&nbsp;</i>Tambah</button>
                        <button id="btnPrint" type="button" class="btn bg-gradient-primary"><i
                                class="fa fa-print">&nbsp;</i>Print</button>
                        <a href="<?php echo base_url('kehadiran') ?>">
                            <button type="button" class="btn bg-gradient-dark" data-bs-toggle="modal"
                                data-bs-target="#modal-scan"><i class="fa fa-qrcode">&nbsp;</i>Scan</button>
                        </a>
                    </div>
                    <div
                        class="col-sm-12 col-lg-6 d-flex flex-column flex-sm-row justify-content-center justify-content-lg-end align-items-center gap-2 mb-3">
                        <h5 class="mb-0" style="flex-shrink: 0;">Filter data:</h5>
                        <input type="date" id="dateInput" class="form-control w-100 w-sm-auto" placeholder="Tahun mulai"
                            value="<?php echo $date ?>">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-items-center mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                    No
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama
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
foreach ($kehadiran as $a): ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $no++ ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $a['nama'] ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $a['tanggal'] ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $a['waktu_datang'] ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $a['waktu_pulang'] ?>
                                </td>
                                <td class="text-center">
                                    <!-- Tampilkan badge dengan warna yang sesuai -->
                                    <span class="badge <?php echo $a['badge']; ?>" data="<?php echo $a['status']; ?>"
                                        onclick="changeStatus(this)" style="cursor: pointer;">
                                        <?php echo $a['status']; ?>
                                    </span>
                                </td>

                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>


            <?php $this->load->view('admin/templates/footer')?>
        </div>
        <!-- Navbar -->
        <!-- Footer -->
    </main>
    <?php $this->load->view('admin/templates/script')?>
    <script src="<?php echo base_url() ?>assets/js/html5-qrcode.min.js"></script>
    <?php $this->load->view('admin/templates/data-table')?>
    <?php $this->load->view('admin/templates/alert')?>
    <?php $this->load->view('admin/kehadiran/modal')?>

    <script>
    function changeStatus(element) {
        var status = $(element).attr('data');
        if (status == 'SAKIT' || status == 'IZIN' || status == 'DINAS LUAR' || status == 'CUTI') {
            {
                $('#status-modal').modal('show');
            }
        }

    };
    let dateInput = document.getElementById("dateInput");

    dateInput.addEventListener("change", function() {
        let dateValue = dateInput.value;
        window.location.href = "<?php echo base_url('admin/kehadiran/'); ?>" + dateValue;
    });

    $('#btnPrint').on('click', function() {
        let dateInput = document.getElementById("dateInput"); // Pastikan elemen input sudah didefinisikan

        console.log(dateInput.value);

        // Gunakan window.open untuk membuka di tab baru
        window.open("<?php echo base_url('admin/print_kehadiran/') ?>" + dateInput.value, '_blank');
    });
    </script>

</body>

</html>