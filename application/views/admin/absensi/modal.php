<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 d-flex flex-row justify-content-between">
                        <div class="text-left ">
                            <h3 class="font-weight-bolder text-info text-gradient">Tambah Data Kehadiran</h3>
                            <p class="mb-0">Silahkan Inputkan Data Kehadiran</p>
                        </div>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="h3">×</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="formTambahKehadiran" role="form text-left"
                            action="<?php echo base_url('pegawai/insert') ?>" method="post"
                            enctype="multipart/form-data"
                            oninput='password_confirm.setCustomValidity(password_confirm.value != password.value ? "Passwords tidak sama" : "")'>
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
$(document).ready(function() {
    $('#formTambahKehadiran').on('submit', function(event) {
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
                    $('#formTambahKehadiran')[0]
                .submit(); // Submit form jika username valid
                }
            }
        });
    });

});
</script>