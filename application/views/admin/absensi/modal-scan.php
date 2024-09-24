<div class="modal fade" id="modal-scan" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                        <h1>QR Code Scanner</h1>
                        <div id="reader"
                            style="width: 100%; height: auto; border: 2px solid #ccc; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); padding: 20px;">
                        </div>
                        <p id="qr-result">Hasil scan: <span id="result">Belum ada hasil</span></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
