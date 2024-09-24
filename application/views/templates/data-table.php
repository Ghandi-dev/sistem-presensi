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

});
</script>