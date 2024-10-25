<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 d-flex flex-row justify-content-between">
                        <div class="text-left ">
                            <h3 class="font-weight-bolder text-info text-gradient">Tambah Pegawai</h3>
                            <p class="mb-0">Silahkan Inputkan Data Pegawai</p>
                        </div>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="h3">×</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="formTambahPegawai" role="form text-left"
                            action="<?php echo base_url('pegawai/insert') ?>" method="post"
                            enctype="multipart/form-data"
                            oninput='password_confirm.setCustomValidity(password_confirm.value != password.value ? "Passwords tidak sama" : "")'>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nama</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                    </div>
                                    <label>Jabatan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Jabatan" name="jabatan"
                                            required>
                                    </div>
                                    <label>No Telepon</label>
                                    <div class="input-group mb-3">
                                        <input type="text" pattern="[0-9]+" class="form-control"
                                            placeholder="No Telepon" name="no_telp" required>
                                    </div>
                                    <label>Alamat</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex flex-column justify-content-between">
                                    <div class="d-flex flex-column align-items-center">
                                        <img id="preview" src="<?php echo base_url('assets/img/foto/default.jpg') ?>"
                                            class="img-fluid border-radius-lg shadow" width="70%">
                                    </div>
                                    <div>
                                        <label>Foto</label>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" placeholder="" id="image"
                                                name="foto" onchange="previewImage()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="row">
                                <label>Username</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Username">
                                    <!-- Untuk pesan kesalahan -->
                                </div>
                                <div id="usernameFeedback" class="d-block text-danger"></div>
                                <label>Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <label>Konfirmasi Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirm" class="form-control"
                                        placeholder="Konfirmasi Password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="submitButton"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('submitButton').addEventListener('click', function() {
    // Ambil elemen form berdasarkan ID
    var form = document.getElementById('formTambahPegawai');
    if (form.checkValidity()) {
        form.submit();
    } else {
        event.preventDefault(); // Prevent form submission
        event.stopPropagation(); // Stop propagation
        form.reportValidity(); // Show validation errors
    }
});

function previewImage() {
    var file = document.getElementById("image").files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var preview = document.getElementById("preview");
        preview.src = e.target.result;
        preview.style.display = "block";
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute using the eye icon
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password_confirm = document.querySelector('#password_confirm');

    toggleConfirmPassword.addEventListener('click', function() {
        // Toggle the type attribute using the eye icon
        const type = password_confirm.getAttribute('type') === 'password' ? 'text' : 'password';
        password_confirm.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });
});
</script>

<script>
$(document).ready(function() {
    $('#formTambahPegawai').on('submit', function(event) {
        event.preventDefault(); // Cegah submit terlebih dahulu

        var username = $('#username').val(); // Ambil nilai username

        // Panggil AJAX untuk cek username
        $.ajax({
            url: '<?php echo base_url('user/check_username'); ?>', // Ganti dengan URL controller Anda
            type: 'POST',
            data: {
                username: username
            },
            dataType: 'json',
            success: function(response) {
                if (response.exists) {
                    // Jika username sudah ada, tampilkan feedback error
                    $('#username').removeClass('is-valid').addClass('is-invalid');
                    $('#usernameFeedback').text('Username sudah digunakan!');
                } else {
                    // Jika username tersedia, hapus feedback error
                    $('#username').removeClass('is-invalid').addClass('is-valid');
                    $('#usernameFeedback').text('');

                    // Submit form secara manual jika username valid
                    $('#formTambahPegawai')[0].submit(); // Submit form jika username valid
                }
            }
        });
    });

});
</script>