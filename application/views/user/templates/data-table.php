<link href="<?php echo base_url('assets/') ?>data-tables/datatables.min.css" rel="stylesheet">
<script src="<?php echo base_url('assets/') ?>data-tables/datatables.min.js"></script>
<script>
$(document).ready(function() {

    // Inisialisasi DataTables
    let table = $('#myTable').DataTable({
        'dom': 't<"d-md-flex justify-content-between mt-2"i<p>>',
        'paging': true,
        'info': true,
        'language': {
            'info': "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data"
        },
    });

    // Fungsi pencarian berdasarkan tanggal
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var searchDate = $('#searchDate').val(); // Ambil nilai dari input tanggal
        var columnDate = data[
        1]; // Ambil data dari kolom ke-2 (sesuaikan dengan kolom yang berisi tanggal)

        if (searchDate === '' || columnDate === searchDate) {
            return true; // Jika input kosong atau tanggal cocok
        }
        return false; // Jika tidak cocok
    });

    // Event listener untuk input tanggal
    $('#searchDate').on('change', function() {
        table.draw(); // Perbarui tabel setelah nilai input berubah
    });

});
</script>