<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head')?>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $this->load->view('templates/sidebar')?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg mb-5">
        <div class="container-fluid px-4">
            <?php $this->load->view('templates/navbar')?>
            <!-- Content -->
            <div class="page-header min-height-200 border-radius-xl mt-2"
                style="background-image: url('<?php echo base_url('assets/img/curved0.jpg') ?>'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="<?php echo base_url('assets/img/foto/') . $pegawai->foto ?>" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?php echo $pegawai->nama ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <?php echo $pegawai->jabatan ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Informasi Profile</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pt-0 d-flex flex-column justify-content-between">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 text-sm">
                                    <strong class="text-dark">QR code</strong>
                                    <div class="d-flex flex-column align-items-center">
                                        <img id="preview"
                                            src="<?php echo base_url('assets/img/qr-code/') . $pegawai->qr_code ?>"
                                            class="img-fluid border-radius-lg shadow w-lg-50 w-sm-100" alt="QR Code">
                                    </div>
                                </li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama
                                        Lengkap:</strong> &nbsp; <?php echo $pegawai->nama ?></li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Jabatan:</strong> &nbsp; <?php echo $pegawai->jabatan ?>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No
                                        Telepon:</strong> &nbsp; <?php echo $pegawai->no_telepon ?></li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Alamat:</strong> &nbsp; <?php echo $pegawai->alamat ?> Lorem
                                    ipsum, dolor sit amet consectetur adipisicing elit. Voluptate at, distinctio quo
                                    officiis modi, ducimus sunt praesentium veniam neque maxime aut quibusdam velit.
                                    Maiores cumque necessitatibus in porro sunt tenetur.</li>
                            </ul>
                            <a href="<?php echo base_url('admin/pegawai') ?>">
                                <div class="btn btn-round bg-gradient-secondary btn-lg mb-0 w-100">Kembali</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mt-2 mt-xl-0">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Edit Profile</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Profile"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <form id="formUpdatePegawai" role="form text-left"
                                action="<?php echo base_url('pegawai/update/') . $pegawai->id ?>" method="post"
                                enctype="multipart/form-data"
                                oninput='password_confirm.setCustomValidity(password_confirm.value != password.value ? "Passwords tidak sama" : "")'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nama</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nama" name="nama"
                                                value="<?php echo $pegawai->nama ?>" required>
                                        </div>
                                        <label>Jabatan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan"
                                                value="<?php echo $pegawai->jabatan ?>" required>
                                        </div>
                                        <label>No Telepon</label>
                                        <div class="input-group mb-3">
                                            <input type="text" pattern="[0-9]+" class="form-control"
                                                value="<?php echo $pegawai->no_telepon ?>" placeholder="No Telepon"
                                                name="no_telp" required>
                                        </div>
                                        <label>Alamat</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                                value="<?php echo $pegawai->alamat ?>" required>

                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column justify-content-between">
                                        <div class="d-flex flex-column align-items-center">
                                            <img id="preview"
                                                src="<?php echo base_url('assets/img/foto/') . $pegawai->foto ?>"
                                                class="img-fluid border-radius-lg shadow" width="70%">
                                        </div>
                                        <div>
                                            <label>Foto</label>
                                            <input type="text" class="form-control" name="old_foto"
                                                value="<?php echo $pegawai->foto ?>" hidden>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" placeholder="" id="image"
                                                    name="foto" onchange="previewImage()">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div class="text-center">
                                <button type="submit" id="submitButton"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mt-2 mt-xl-0">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Ubah Password</h6>
                        </div>
                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <form id="formUpdatePassword" role="form text-left"
                                action="<?php echo base_url('admin/change_password_by_admin/') . $pegawai->id ?>"
                                method="post" enctype="multipart/form-data"
                                oninput='password_confirm.setCustomValidity(password_confirm.value != new_password.value ? "Passwords tidak sama" : "")'>
                                <div class="row">
                                    <label>Username</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="username" name="username" class="form-control"
                                            placeholder="Username" value="<?php echo $user->username ?>" disabled>
                                        <!-- Untuk pesan kesalahan -->
                                    </div>
                                    <div id="usernameFeedback" class="d-block text-danger"></div>
                                    <label>Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="new_password" class="form-control"
                                            placeholder="Password" required>
                                    </div>
                                    <label>Konfirmasi Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password_confirm" class="form-control"
                                            placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center">
                                <button type="submit" id="passwordSubmitButton"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar -->
        <!-- Footer -->
        <?php $this->load->view('templates/footer')?>
    </main>
    <?php $this->load->view('templates/script')?>
    <script>
    document.getElementById('passwordSubmitButton').addEventListener('click', function() {
        // Ambil elemen form berdasarkan ID
        var form = document.getElementById('formUpdatePassword');

        if (form.checkValidity()) {
            form.submit();
        } else {
            event.preventDefault(); // Prevent form submission
            event.stopPropagation(); // Stop propagation
            form.reportValidity(); // Show validation errors
        }
    });
    document.getElementById('submitButton').addEventListener('click', function() {
        // Ambil elemen form berdasarkan ID
        var form = document.getElementById('formUpdatePegawai');

        if (form.checkValidity()) {
            form.submit();
        } else {
            event.preventDefault(); // Prevent form submission
            event.stopPropagation(); // Stop propagation
            form.reportValidity(); // Show validation errors
        }
    });
    </script>
    <?php $this->load->view('templates/alert')?>
</body>

</html>