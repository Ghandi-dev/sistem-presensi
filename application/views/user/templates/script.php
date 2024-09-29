<script src="<?php echo base_url('assets/jquery/jquery-3.7.1.js') ?>"></script>
<script src="<?php echo base_url('assets/') ?>js/core/popper.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/plugins/chartjs.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url('assets/') ?>js/soft-ui-dashboard.min.js"></script>

<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>

<script>
$(document).ready(function() {
    // Cek apakah <a> tidak memiliki class 'active'
    $('.nav-link').each(function() {
        if (!$(this).hasClass('active')) {
            // Jika tidak memiliki class 'active', tambahkan class 'text-dark' pada elemen <i>
            $(this).find('i').addClass('text-dark');
        }
    });
});
</script>

<script>
$(document).ready(function() {
    // Tangkap event klik pada elemen span dengan data-color
    $('.change-colors').on('click', function() {
        var selectedColor = $(this).attr('data-color'); // Ambil nilai data-color
        $('#sidenav-main').attr('data-color', selectedColor);
        // Tambahkan class baru ke elemen aside
        $('ul.pagination').removeClass(function(index, className) {
            // Hanya hapus kelas yang dimulai dengan 'bg-gradient-'
            return (className.match(/(^|\s)pagination-\S+/g) || []).join(
                ' ');
        });

        $('ul.pagination').addClass(
            `pagination pagination-${selectedColor}`
        );
        // Kirim permintaan AJAX ke server untuk menyimpan warna
        $.ajax({
            url: '<?php echo base_url('setting/save_sidebar_color'); ?>', // URL menuju controller
            method: 'POST',
            data: {
                color: selectedColor
            }, // Data yang dikirim ke server
            success: function(response) {
                console.log('Warna sidebar disimpan di session: ' + response);
            },
            error: function() {
                console.log('Gagal menyimpan warna.');
            }
        });
        localStorage.setItem('sidebarColor', selectedColor);
    });

    $('.btn-color-sidenav').on('click', function() {
        var selectedType = $(this).attr('data-class'); // Ambil nilai data-color
        $('#sidenav-main').removeClass(function(index, className) {
            // Hanya hapus kelas yang dimulai dengan 'bg-gradient-'
            return (className.match(/(^|\s)bg-\S+/g) || []).join(' ');
        });
        $('#sidenav-main').addClass(selectedType);

        $.ajax({
            url: '<?php echo base_url('setting/save_sidebar_type'); ?>', // URL menuju controller
            method: 'POST',
            data: {
                color: selectedType
            }, // Data yang dikirim ke server
            success: function(response) {
                console.log('Type sidebar disimpan di session: ' + response);

            },
            error: function() {
                console.log('Gagal menyimpan warna.');
            }
        });
        localStorage.setItem('sidebarColor', selectedType);
    });

    $('#iconNavbarSidenav').on('click', function() {
        $('body').toggleClass('g-sidenav-pinned');
    });
});
</script>

<script>

</script>