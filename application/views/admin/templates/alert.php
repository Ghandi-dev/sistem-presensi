<script src="<?php echo base_url('assets/sweet-alert/sweetalert2.all.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($this->session->flashdata('success')): ?>
    Swal.fire({
        title: 'Success!',
        text: '<?php echo $this->session->flashdata('success'); ?>',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    <?php elseif ($this->session->flashdata('error')): ?>
    Swal.fire({
        title: 'Error!',
        text: '<?php echo $this->session->flashdata('error'); ?>',
        icon: 'error',
        confirmButtonText: 'OK'
    });
    <?php endif;?>
});

$('.delete').on('click', function(e) {
    e.preventDefault();
    let id = $(this).data('id');

    Swal.fire({
        title: "Anda yakin?",
        text: "Apakah anda yakin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus data ini!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `<?php echo site_url('pegawai/delete/'); ?>${id}<?php echo '?type=' . $title ?>`,
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Data Berhasil dihapus',
                        icon: 'success'
                    }).then(() => {
                        // Optionally reload or update the page content
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an issue deleting the item.',
                        icon: 'error'
                    });
                }
            });
        }
    });
});
</script>