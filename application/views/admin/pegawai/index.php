<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head')?>
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
    <?php $this->load->view('templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg mb-5">
        <div class="container-fluid px-4 ">
            <?php $this->load->view('templates/navbar')?>
            <!-- Content -->
            <div class="card p-3 mt-3">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal"
                            data-bs-target="#modal-form"><i class="fa fa-plus">&nbsp;</i>Tambah</button>
                        <button type="button" class="btn bg-gradient-primary"><i
                                class="fa fa-print">&nbsp;</i>Print</button>
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
                                    Jabatan</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No telp</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-3">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;foreach ($pegawai as $row): ?>
                            <tr>
                                <td class="align-middle text-center text-md"><?php echo $no; ?></td>
                                <td>
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
                                <td>
                                    <p class="text-md font-weight-bold mb-0"><?php echo $row->jabatan; ?></p>
                                </td>
                                <td class="align-middle text-center text-md">
                                    <?php echo $row->no_telepon; ?>
                                </td>
                                <td class="d-flex justify-content-center align-items-center text-center gap-2">
                                    <span><?php echo anchor('admin/pegawai_edit/' . $row->id, '<i class="fa fa-pencil-square-o">&nbsp;</i>', 'class="btn bg-gradient-warning mb-0"'); ?></span>
                                    <span>
                                        <div class="btn bg-gradient-danger mb-0 delete"
                                            data-id="<?php echo $row->id; ?>">
                                            <i class=" fa fa-trash"></i>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                            <?php $no++;endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>


            <?php $this->load->view('templates/footer')?>
        </div>
        <!-- Navbar -->
        <!-- Footer -->
    </main>
    <?php $this->load->view('templates/script')?>
    <?php $this->load->view('admin/pegawai/modal')?>
    <?php $this->load->view('templates/data-table')?>
    <?php $this->load->view('templates/alert')?>

</body>

</html>