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
                            action="<?php echo base_url('kehadiran/insert') ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <select multiple class="form-control" id="id_pegawai" name="id_pegawai">
                                    <?php $no = 1;foreach ($pegawai as $pg): ?>
                                    <option value=<?php echo $pg->id ?>><?php echo $no . '.&nbsp;' . $pg->nama ?>
                                    </option>
                                    <?php $no++;endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <select class="form-control" id="keterangan" name="keterangan">
                                    <option value="SAKIT">SAKIT</option>
                                    <option value="IZIN">IZIN</option>
                                    <option value="CUTI">CUTI</option>
                                    <option value="DINAS LUAR">DINAS LUAR</option>
                                </select>
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
// Fungsi untuk mengecek apakah select pegawai memiliki opsi
function checkPegawaiOptions() {
    const pegawaiSelect = document.getElementById('id_pegawai');
    const submitButton = document.getElementById('submitButton');

    // Cek apakah ada opsi dalam select pegawai
    if (pegawaiSelect.options.length === 0) {
        submitButton.disabled = true; // Nonaktifkan tombol submit jika tidak ada opsi
    } else {
        checkPegawaiSelected(); // Cek apakah ada pilihan yang dipilih
    }
}

// Fungsi untuk mengecek apakah opsi pegawai telah dipilih
function checkPegawaiSelected() {
    const pegawaiSelect = document.getElementById('id_pegawai');
    const submitButton = document.getElementById('submitButton');

    // Cek apakah ada opsi yang dipilih
    if (pegawaiSelect.selectedIndex === -1) {
        submitButton.disabled = true; // Nonaktifkan tombol jika tidak ada yang dipilih
    } else {
        submitButton.disabled = false; // Aktifkan tombol jika ada pilihan
    }
}

// Event listener ketika halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    checkPegawaiOptions(); // Jalankan saat halaman dimuat
});

// Event listener ketika ada perubahan pada select pegawai
document.getElementById('id_pegawai').addEventListener('change', function() {
    checkPegawaiSelected(); // Cek ulang ketika user memilih opsi
});
</script>