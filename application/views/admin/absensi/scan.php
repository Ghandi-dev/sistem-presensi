<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head')?>
    <style>
    #reader__dashboard_section {
        background-color: #f9f9f9;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    #reader__header_message {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 10px;
    }

    .html5-qrcode-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .html5-qrcode-button:hover {
        background-color: #0056b3;
    }

    .html5-qrcode-anchor {
        color: #007bff;
    }

    #reader__scan_region {
        border-radius: 15px;
        overflow: hidden;
    }

    #reader__scan_region canvas {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.4);
        }

        100% {
            box-shadow: 0 0 0 20px rgba(0, 123, 255, 0);
        }
    }
    </style>

</head>

<body class="g-sidenav-show bg-gray-200">
    <!-- End Navbar -->
    <section class="min-vh-100">
        <div class="page-header align-items-start min-vh-50 pt-2 pb-11 m-3 border-radius-lg"
            style="background-image: url('<?php echo base_url('assets/img/curved0.jpg') ?>')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-6">Selamat Datang!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n12 mt-md-n11 mt-n10">
                <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4 pb-0">
                            <h5>Silahkan Scan QR Code Anda</h5>
                        </div>
                        <div class="card-body py-0">
                            <div id="reader"
                                style="width: 100%; height: auto; border: 2px solid #ccc; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                            </div>
                            <div class="row d-flex justify-content-center align-item-center text-center mt-2">
                                <p id="qr-result"><span id="result">&nbsp;</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php $this->load->view('templates/footer')?>
    </div>
    <!-- Navbar -->
    <!-- Footer -->
    </main>
    <?php $this->load->view('templates/script')?>
    <script src=" <?php echo base_url() ?>assets/js/html5-qrcode.min.js">
    </script>
    <?php $this->load->view('templates/data-table')?>
    <?php $this->load->view('templates/alert')?>

    <script>
    let scanEnabled = true; // variabel untuk mengontrol apakah pemindaian diperbolehkan

    function onScanSuccess(decodedText, decodedResult) {
        if (scanEnabled) {
            // Buat objek audio baru untuk memutar suara beep
            const beepSound = new Audio("<?=base_url('assets/sounds/beep.wav')?>");

            // Mainkan suara beep
            beepSound.play().catch((error) => {
                console.error('Gagal memutar suara:', error);
            });

            $.ajax({
                url: '<?=base_url('/kehadiran/scan_kehadiran')?>',
                type: 'POST',
                data: {
                    username: decodedText
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    try {
                        document.getElementById('result').innerText = `${decodedText} ${data.message}`;
                    } catch (e) {
                        console.error('Parsing error:', e);
                        alert('Gagal memproses respons dari server.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    alert('Terjadi kesalahan saat mengirim permintaan.');
                }
            });

            // Nonaktifkan pemindaian sementara
            scanEnabled = false;

            // Tambahkan jeda sebelum memungkinkan scan berikutnya
            setTimeout(() => {
                scanEnabled = true;
                // console.log('Scan enabled again');
            }, 3000); // 3000 milidetik = 3 detik
        }
    }


    function onScanError(errorMessage) {
        // console.warn(`Scan error = ${errorMessage}`);
    }

    $(document).ready(function() {
        // Cek apakah <a> tidak memiliki class 'active'
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 60,
                qrbox: 300
            });

        html5QrcodeScanner.render(onScanSuccess, onScanError);
    });
    </script>

</body>

</html>